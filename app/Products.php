<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Session;
class Products extends Model
{
      protected $fillable = [
	   'category_id', 'product_name', 'product_code', 'product_color', 'description', 'price','image',

    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at','updated_at',
    ];
	
	public function category(){
		return $this->belongsTo(Category::class);
	}
	public function attributes(){
		return $this->hasMany('App\ProductsAttribute','product_id');
	}
	// cart added item show in cart 
	public static function cartCount(){
		if(Auth::check()){
			$user_email = Auth::user()->email;
			$cartCount = DB::table('cart')->where('user_email',$user_email)->sum('quantity');
		}else{
			$session_id = Session::get('session_id');
			$cartCount = DB::table('cart')->where('session_id',$session_id)->sum('quantity');
		}
		return $cartCount;
	}
	// category's products count
	public static function productCount($cat_id){
		$catCount = Products::where(['category_id'=>$cat_id,'Status'=>1])->count();
		return $catCount;
	}
	//get currency rate 
	public static function currencyratechange($price){
		$getcurrency = Currency::where('status',1)->get();
		foreach($getcurrency as $currency){
			if($currency->currency_code =="USD"){
			$USD_rate = round($price/$currency->exchange_rate,2);
			}else if($currency->currency_code =="GBP"){
			$GBP_rate = round($price/$currency->exchange_rate,2);
			}else if($currency->currency_code =="EUR"){
			$EUR_rate = round($price/$currency->exchange_rate,2);
			}
		}
		$currencyArr = array('USD_rate'=>$USD_rate,'GBP_rate'=>$GBP_rate,'EUR_rate'=>$EUR_rate);
		return $currencyArr;
	}
	public static function getProductStock($product_id,$product_size){
		$productStock = ProductsAttribute::select('stock')->where(['product_id'=>$product_id,'size'=>$product_size])->first();
		return $productStock->stock;
	}
	public static function cartProductDelete($product_id,$user_email){
		DB::table('cart')->where(['product_id'=>$product_id,'user_email'=>$user_email])->delete();
	}
	public static function getProductStatus($product_id){
		$productStatus = Products::select('status')->where('id',$product_id)->first();
		return $productStatus->status;
	}
	public static function getShippingCharge($total_weight,$country){
		//$shippingDetails = Shippings::select('shipping_charge')->where('shipping_country',$country)->first();
		$shippingDetails = Shippings::where('shipping_country',$country)->first();
		
		if($total_weight >0){
			if($total_weight >0 && $total_weight<=500){
				$shippingDetails = $shippingDetails->shipping_charge0_500;
			}else if($total_weight >501 && $total_weight<=1000){
				$shippingDetails = $shippingDetails->shipping_charge501_1000;
			}else if($total_weight >1001 && $total_weight<=2000){
				$shippingDetails = $shippingDetails->shipping_charge1001_2000;
			}
			else if($total_weight >2000 && $total_weight<=5000){
				$shippingDetails = $shippingDetails->shipping_charge2001_5000;
			}else{
				$shippingDetails =0;
			}
		}else{
			$shippingDetails =0;
		}
		return $shippingDetails;

	}
}
