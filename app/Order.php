<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orders(){
		return $this->hasMany('App\OrdersProduct','order_id');
	}
	public static function getOrderDetail($order_id){
		$getOrderDetail = Order::where('id',$order_id)->first();
		return $getOrderDetail;
	}
	
	public static function getOrderCountry($country){
		$getCountryCode = Country::where('country_name',$country)->first();
		return $getCountryCode;
	}
}
