<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Coupons;

class CouponController extends Controller
{
    public function index(Request $request){
		
		return view('products.add_coupon');
	}
	public function saveCoupons(Request $request){
		$data = $request->all();
		//echo"<pre>";
		//print_r($data);
		
		$expiry_date = strtotime($data['expiry']);
		
		if(isset($data['status'])){
			echo $status =1;
		}else{
			echo $status =0;
		}
		DB::table('coupon')->insert([
		'coupon_code' =>$data['coupon_code'],
		'amount' =>$data['amount'],
		'amount_type' =>$data['amount_type'],
		'expiry_date' =>$expiry_date,
		'status' =>$status,
		]);
		
		return redirect()->back()->with('flush_message_success','Product Coupon Successfully');
	}
	public function viewCoupons(){
		$coupon = DB::table('coupon')->get();
		return view('products.view_coupon')->with(['coupon'=>$coupon,'controller'=>'coupon','page_type'=>'front']);
	}
	
	public function editeCoupons($id = null){
		$couponEdite = DB::table('coupon')->where(['id'=>$id])->first();
		return view('products.edite_coupon')->with(['couponEdite'=>$couponEdite,'controller'=>'coupon','page_type'=>'front']);
	}
	public function updateCoupon(Request $request){
		$dataUpdate = $request->all();
		
		/* echo"<pre>";
		print_r($dataUpdate);
		die; */
		$expiry_date = strtotime($dataUpdate['expiry']);
		$status ='';
		if(isset($dataUpdate['status'])){
			$status =1;
		}else{
			$status =0;
		}
		$couponUpdate = DB::table('coupon')
		->where(['id'=>$dataUpdate['id']])->update([
		'coupon_code'=>$dataUpdate['coupon_code'],
		'amount'=>$dataUpdate['amount'],
		'amount_type'=>$dataUpdate['amount_type'],
		'expiry_date'=>$expiry_date,
		'status'=>$status
		]); 
		return redirect()->back()->with('flush_message_success','Coupon update Successfully');
	}
	public function deleteCoupons($id = null){
		DB::table('coupon')->where(['id'=>$id])->delete();
		return redirect()->back()->with('flush_message_success','Coupon delete Successfully');
	}
}
