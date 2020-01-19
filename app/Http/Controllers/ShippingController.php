<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Shippings;
class ShippingController extends Controller
{
	//shipping view
   public function shippingView(){
	   //$shippingDetails = Shippings::get();
	   $shippingDetails = DB::table('shippings')->get();
	  /*  echo"<pre>";
	   print_r($shippingDetails);
	   die; */
	   return view('admin.shipping.shipping')->with(['controller'=>'shipping','shippingDetails'=>$shippingDetails]);
   }
   public function shippingUpdate($id,Request $request){
	   if($request->isMethod('post')){
		    $data = $request->all();
			/* echo"<pre>";
			print_r($data);
			die; */
			$data['shipping_Id'];
			$data['shipping_code'];
			$data['shipping_country'];
			$data['shipping_charge'];
			DB::table('shippings')->where('id',$data['shipping_Id'])->update([
			'shipping_charge0_500'=>$data['shipping_charge0_500'],
			'shipping_charge501_1000'=>$data['shipping_charge501_1000'],
			'shipping_charge1001_2000'=>$data['shipping_charge1001_2000'],
			'shipping_charge2001_5000'=>$data['shipping_charge2001_5000']
			]);
			return redirect()->back()->with('flush_message_success','Shipping charge update successfully');

	   }
	  $shippingCharge = Shippings::where('id',$id)->first();
	  return view('admin.shipping.shipping_update')->with(compact('shippingCharge'));
   }
   
}
