<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use Session;
use App\Order;
use App\User;
use Auth;
use DB;

use Softon\Indipay\Facades\Indipay; 

class PayumoneyController extends Controller
{
   public function payumoneyOrder(){
		$order_id = Session::get('order_id');
		$grand_total = Session::get('grand_total');
		$orderDetails = Order::where('id',$order_id)->first()->toArray();
		/* All Required Parameters by your Gateway */
      $parameters = [
        'txnid' => $order_id,
        'order_id' => $order_id,
        'amount' => $grand_total,
		'firstname'=> $orderDetails['name'],
		'lastname'=> $orderDetails['name'],
		'email'=> $orderDetails['user_email'],
		'phone'=> $orderDetails['mobile'],
		'productinfo'=> $orderDetails['id'],
		'service_provider'=>'',
		'zipcode'=> $orderDetails['pincode'],
		'city'=> $orderDetails['city'],
		'state'=> $orderDetails['state'],
		'country' => $orderDetails['country'],
		'address1'=> $orderDetails['address'],
		'address2'=> $orderDetails['address'],
		'curl' => url('payumoney/response'),
      ];
      $order = Indipay::prepare($parameters);
      return Indipay::process($order);
   }
   public function payumoneyResponse(Request $request){
	     // For default Gateway
        $response = Indipay::response($request);
 		/*echo"<pre>";
		print_r($response);
		die; */
		if($response['status'] =='failure' && $response['unmappedstatus'] =='failed'){
			//echo "Your oder status fail";
			$user_email = Auth::user()->email;
			$order_id = Session::get('order_id');
			DB::table('cart')->where('user_email', $user_email)->delete();
			DB::table('orders')->where('id',$order_id)->update(['order_status' =>'Fail']);
			return view('order.payumoney_cancle');
		}else{
			//echo "Your oder placed successfully";
			//mail after order replace
			// order detail send mail
			$email = Auth::user()->email;
			$user_id = Auth::user()->id;
			$order_id = Session::get('order_id');
			$grand_total = Session::get('grand_total');
			
			$shippingDetails = DB::table('delivery_address')->where(['user_email'=>$email])->first();
			$orderDetail = Order::with('orders')->where('id',$order_id)->first();
			$orderDetail = json_decode(json_encode($orderDetail),true);
			
			$userDetail = User::where('id',$user_id)->first();
			$userDetail = json_decode(json_encode($userDetail),true);
			$messageData = [
			'email'=>$email,
			'name'=>$shippingDetails->name,
			'order_id'=>$order_id,
			'amount'=>$orderDetail['grand_total'],
			'paymentMethod'=>$orderDetail['payment_method'],
			'orderDetail'=>$orderDetail,
			'userDetail'=>$userDetail
			];
			Mail::send('mail.place_order',$messageData,function($message) use($email){
				$message->to($email)->subject('Shopping order with Muzaffer E-com Website');
			}); 
			DB::table('cart')->where('user_email', $email)->delete();
			return view('order.payumoney_thank');
		}
	   
   }
	public function payumoneyStatus(){
		//get last 30 payment order
		$oderData = Order::where('payment_method','payumoney')->orderBy('id', 'desc')->take(5)->get()->toArray();
		foreach($oderData as $order){
			$key = "gtKFFx";
			$salt = "eCwWELxi";
			$command = "verify_payment";
			$var1 = $order['id'];
			
			//$var1 = "6500011";
			//hash formaula
			
			$hash_str = $key  . '|' . $command . '|' . $var1 . '|' . $salt ;
			$hash = strtolower(hash('sha512', $hash_str));
			$r = array('key' => $key , 'hash' =>$hash , 'var1' => $var1, 'command' => $command);
			$qs= http_build_query($r);
			$wsUrl = "https://test.payu.in/merchant/postservice.php?form=2";
			
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, $wsUrl);
			curl_setopt($c, CURLOPT_POST, 1);
			curl_setopt($c, CURLOPT_POSTFIELDS, $qs);
			curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
			$o = curl_exec($c);
			if (curl_errno($c)) {
			  $sad = curl_error($c);
			  throw new Exception($sad);
			}
			curl_close($c);

			$valueSerialized = @unserialize($o);
			if($o === 'b:0;' || $valueSerialized !== false) {
			  print_r($valueSerialized);
			}
			$o = json_decode($o);
			foreach($o->transaction_details as $key=>$val){
				if(($val->status=='success') && ($val->unmappedstatus=='captured')){
					if(($order['order_status'] =='Fail')){
						// here add code for status update in cron job
						echo "Right";
						die;
					}else{
						// here also add code
						echo "Wrong";
						die;
					}
					
				}
				
			}
		}
   
	}
}
