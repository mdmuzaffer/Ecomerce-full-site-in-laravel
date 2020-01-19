<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Dompdf\Dompdf;
use Dompdf\Options;
use Image;
use DB;
use Auth;
use Session;
use App\User;
use Hash;
use App\Products;
use App\Coupons;
use App\ProductsAttribute;
use App\ProductsImage;
use App\Category;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use App\Wishlist;
use Carbon\Carbon;
class ProductsController extends Controller
{
    public function addProducts(Request $request){
		$category = Category::where(['parent_id'=>0])->get();
		$category_dropdown ="<option value='' selected disabled>Select Category</option>";
		foreach($category as $cat){
			$category_dropdown.= "<option value='".$cat->id."'>".$cat->name."</option>";
			$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
			foreach($sub_categories as $sub_cat){
			$category_dropdown.= "<option value='".$sub_cat->id."'>>".$sub_cat->name."</option>";
			}
		}
		return view('products.add_product')->with(['category_dropdown'=>$category_dropdown,'category'=>$category,'controller'=>'products','page_type'=>'admin_inner']);
		
		
	}
	
	public function saveProducts(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			/* echo "<pre>";
			print_r($data);
			die; */
			$Products = new Products;
			$Products->category_id = $data['category_id'];
			$Products->product_name = $data['product_name'];
			$Products->product_code = $data['product_code'];
			$Products->product_color = $data['product_color'];
			$Products->price = $data['product_price'];
			$Products->weight = $data['product_weight'];
			$Products->product_care = $data['product_care'];
			$Products->description = $data['product_description'];
			// image upload
			//$Products->image ="";
			if($request->hasFile('file')){
				$image_temp = $request->file('file');
				if($image_temp->isValid()){
					//echo "Test";
					$extension = $image_temp->getClientOriginalExtension();
					$image_name = $request->file('file')->getClientOriginalName();
				    $filename = rand(111,99999).'_'.$image_name;
					$large_image_path = 'images/backend_image/products/large/'.$filename;
					$medium_image_path = 'images/backend_image/products/medium/'.$filename;
					$small_image_path = 'images/backend_image/products/small/'.$filename;
					
					Image::make($image_temp)->save($large_image_path);
					Image::make($image_temp)->resize(600,600)->save($medium_image_path);
					Image::make($image_temp)->resize(300,300)->save($small_image_path);
					$Products->image =$filename;
				}
				
			}
			
			if(empty($data['product_weight'])){
				$weight = 0;
			}else{
				$weight = $data['product_weight'];
			}
			if(empty($data['enable'])){
				$enable = 0;
			}else{
				$enable = 1;
			}
			if(empty($data['feature_item'])){
				$feature_item = 0;
			}else{
				$feature_item = 1;
			}
			$Products->weight = $weight;
			$Products->status = $enable;
			$Products->feature_item = $feature_item;
			$Products->save();
			return redirect()->back()->with('flush_message_success','Product save Successfully');
		}
		
	}
	
	public function viewProducts(){
		//$product = Category::find(3)->Products;
		$category = Products::with('Category')->get();
		//echo "<pre>";
		//print_r($category);
		//die;
		//$product = Products::get();
		return view('products.view_product')->with(['category'=>$category,'controller'=>'products','page_type'=>'admin_inner']);
	}
	
	// update products view blade
	public function editProducts($id){
		//echo $id;
		$editProducts = Products::find($id);
		return view('products.update_products')->with(['Productsdata'=>$editProducts,'controller'=>'products']);
	}
	//update products query
	public function updateProducts(Request $request){
		$updateData = $request->all();
		$update_id = $request->input('product_id');
		//echo "<pre>";
		//print_r($updateData);
		$update_date = date('Y-m-d,h:i:s');
		//image update
		if(empty($updateData['enable'])){
				$enable = 0;
			}else{
				$enable = 1;
			}
			
		if(empty($updateData['feature_item'])){
				$feature_item = 0;
			}else{
				$feature_item = 1;
			}
			
		if($request->hasFile('file')){
			$image_temp = $request->file('file');
			if($image_temp->isValid()){
				$extension = $image_temp->getClientOriginalExtension();
				$image_name = $request->file('file')->getClientOriginalName();
				$filename = rand(111,99999).'_'.$image_name;
				$large_image_path = 'images/backend_image/products/large/'.$filename;
				$medium_image_path = 'images/backend_image/products/medium/'.$filename;
				$small_image_path = 'images/backend_image/products/small/'.$filename;
				
				Image::make($image_temp)->save($large_image_path);
				Image::make($image_temp)->resize(600,600)->save($medium_image_path);
				Image::make($image_temp)->resize(300,300)->save($small_image_path);
				
			}
				
		}

		if(empty($updateData['file'])){
			DB::table('products')->where('id', $update_id)->update([
			'product_name'  => $updateData['product_name'],
			'product_code'  => $updateData['product_code'],
			'product_color' => $updateData['product_color'],
			'product_care'  => $updateData['product_care'],
			'price'         => $updateData['product_price'],
			'weight'        => $updateData['product_weight'],
			'description'   => $updateData['product_description'],
			'updated_at'    => $update_date,
			'status'        => $enable,
			'feature_item'  => $feature_item
				]);
			}else{
				DB::table('products')->where('id', $update_id)->update([
				'product_name'  => $updateData['product_name'],
				'product_code'  => $updateData['product_code'],
				'product_color' => $updateData['product_color'],
				'product_care'  => $updateData['product_care'],
				'price'         => $updateData['product_price'],
				'weight'        => $updateData['product_weight'],
				'description'   => $updateData['product_description'],
				'image'         => $filename,
				'updated_at'    => $update_date,
				'status'        => $enable,
				'feature_item'  => $feature_item
				]);
			}
		return redirect()->back()->with('flush_message_success','Product Update Successfully');
	}
	
	// view product on popup
	public function viewProductspopup(Request $request){
		$ProductId = $request->input('id');
		$product = Products::find($ProductId);
		$product['image'];
		
		$html ="";
			
		$html.='<img src="http://localhost/ecommerce/public/images/backend_image/products/small/'.$product['image'].'" width="50%">';
		$html.='<div class="card">';
		$html.='<ul class="nav nav-tabs" role="tablist">';
		$html.='<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#Name" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Product Name</span></a> </li>';
		$html.='<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Description" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Description</span></a> </li>';
		$html.='<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Price" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Price</span></a> </li>';
		$html.='<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Color" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Color</span></a> </li></ul>';
			$html.='<div class="tab-content tabcontent-border">
				<div class="tab-pane active" id="Name" role="tabpanel">
					<div class="p-20">
						<p>'.$product['product_name'].'</p>
					</div>
				</div>
				<div class="tab-pane" id="Description" role="tabpanel">
					<div class="p-20">
						<p>'.$product['description'].'</p>
					</div>
				</div>
				<div class="tab-pane" id="Price" role="tabpanel">
					<div class="p-20">
						<p>'.$product['price'].'</p>
					</div>
				</div>
				<div class="tab-pane" id="Color" role="tabpanel">
					<div class="p-20">
						<p>'.$product['product_color'].'</p>
					</div>
				</div>
			</div>
		</div>';
		 return response()->json(['success'=>1,"message"=>$html],200);  
		}
	public function DeleteProducts(Request $request){
		$deleteId = $request->input('id');
		Products::where('id',$deleteId)->delete();
		return response()->json(['success'=>1,'message'=>'Your Products Record Deleted!'],200); 
	}
	public function productsAttributes(Request $request,$id=null){
		//$productDetails = Products::where(['id'=>$id])->first();
		$productDetails = Products::with('attributes')->where(['id'=>$id])->first();
		//$productAttribute = json_decode(json_encode($productDetails));
		if($request->isMethod('post')){
			$data = $request->all();
			foreach($data['sku'] as $key=>$val){
				 if(!empty($val)){
					 $attskucount = ProductsAttribute::where('sku',$val)->count();
					if($attskucount >0){
					return redirect()->back()->with('flush_message_success','Attribute save already with same name');
					}
					$attribute = new ProductsAttribute;
					$attribute->product_id = $id;
					$attribute->sku = $data['sku'][$key];
					$attribute->size = $data['size'][$key];
					$attribute->price = $data['price'][$key];
					$attribute->stock = $data['stock'][$key];
					$attribute->save();
				} 
			} 
			Session::flash('flush_message_success','Product Attribute save Successfully');
		}
		return view('products.add_attributes')->with(['productDetails'=>$productDetails,'controller'=>'products','page_type'=>'admin_inner']);
		
	}
	public function productsAttributesDelete(Request $request){
		if($request->isMethod('post')){
		$DelId = $request->input('DelId');
		ProductsAttribute::where('id',$DelId)->delete();
		return response()->json(['success'=>1,'message'=>'Products Attribute Record Deleted!'],200); 
			
		}
	}
	
	public function productsAttributesMultdelete(Request $request){
		if($request->isMethod('post')){
		$MdelId = $request->all();
		if(!empty($MdelId)){
		foreach($MdelId['multId'] as $keys=>$ids){
			if(!empty($ids)){
			ProductsAttribute::where('id',$ids)->delete();
			}
		}
		}else{
		return response()->json(['success'=>0,'message'=>'Please select more than one attribute'],200); 
		}
		return response()->json(['success'=>1,'message'=>'Your Selected Products Record Deleted!'],200); 
			
		}
	}
	// Listing page
	public function listing($url = null){
		$categoryDetails = Category::where(['url'=>$url,'status'=>1])->count();
		if($categoryDetails == 0){
			abort(404);
		}
		
		$categories = Category::with('categories')->where(['parent_id'=>0])->get();
		$categoryDetails = Category::where(['url'=>$url])->first();
		if($categoryDetails->parent_id ==0){
			$subcategory = Category::where(['parent_id'=>$categoryDetails->id])->get();
			
			$cat_ids = array();
			foreach($subcategory as $subcat){
				$cat_ids[]= $subcat->id;
			}
			
			$productsAll = Products::whereIn('category_id', $cat_ids);
			
		}else{
		$productsAll = Products::where(['category_id'=>$categoryDetails->id]);
		}
		//color filter products
		if(!empty($_GET['color'])){
		$colorArray = explode('-',$_GET['color']);
		$productsAll = $productsAll->whereIn('product_color',$colorArray);
		}
		//size filter products
		if(!empty($_GET['size'])){
		$sizeArray = explode('-',$_GET['size']);
		$productsAll = $productsAll->join('products_attributes',
		'products_attributes.product_id','=','products.id')
		->select('products.*','products_attributes.product_id','products_attributes.size')
		->groupBy('products_attributes.product_id')
		->whereIn('products_attributes.size',$sizeArray);
		}
		$productsAll = $productsAll->paginate(6);
		
		//size get from table for filter sidebar
		//$SizeArr = array('Small','Medium','Large','Xl');
		$SizeArr = ProductsAttribute::select('size')->groupBy('size')->get();
		/*$SizeArr = array_flatten(json_decode(json_encode($SizeArr),true));
		print_r($SizeArr);
		die;*/
		
		return view('products.listing')->with(compact('categoryDetails','productsAll','categories','url','SizeArr'));
	}
	
	public function DeleteImage($id){
		$productImage = Products::where(['id'=>$id])->first();
		$productImage->image;
		$smallImage_path ='images/backend_image/products/small/';
		$mediumImage_path ='images/backend_image/products/medium/';
		$largeImage_path ='images/backend_image/products/large/';
		
		if(file_exists($smallImage_path.$productImage->image)){
			unlink($smallImage_path.$productImage->image);
		}
		
		if(file_exists($mediumImage_path.$productImage->image)){
			unlink($mediumImage_path.$productImage->image);
		}
		
		if(file_exists($largeImage_path.$productImage->image)){
			unlink($largeImage_path.$productImage->image);
		}
		
		return redirect()->back()->with('flush_message_success','Product image delete Successfully');
	}
	
	// product details function
	public function product($id){
		$categories = Category::with('categories')->where(['parent_id'=>0])->get();
		$productDetails = Products::with('attributes')->where(['id'=>$id])->first();
		$productslider = ProductsImage::where(['product_id'=>$id])->get();
		$recomendateItem = Products::where('id','!=',$id)->where(['category_id'=>$productDetails->category_id])->get();
		$SizeArr = ProductsAttribute::select('size')->groupBy('size')->get();
		/*$SizeArr = array_flatten(json_decode(json_encode($SizeArr),true));
		echo "<pre>";
		print_r($recomendateItem);
		echo"</pre>";
		die; */
		
		return view('products.details')->with(['productDetails'=>$productDetails,'slider'=>$productslider,'categories'=>$categories,'recomendateItem'=>$recomendateItem,'url'=>$id,'SizeArr'=>$SizeArr,'controller'=>'products','page_type'=>'front']);
	}
	//select product size and get price stock
	public function porductPrice(){
		$attprice = $_GET;
		$string = implode($attprice);
		$price = explode('-',$string);
		$ids = $price['0'];
		$size = $price['1'];
		$productsAttr = ProductsAttribute::where(['id'=>$ids])->first();
		$currencyratechange = Products::currencyratechange($productsAttr->price);
		$price1 = $currencyratechange['USD_rate'];
		$price2 = $currencyratechange['GBP_rate'];
		$price3 = $currencyratechange['EUR_rate'];
		
		//echo"<pre>";
		//print_r($currencyratechange);
		//die;
		$productsAttr->price;
		return response()->json(['success'=>1,'price1'=>$price1,'price2'=>$price2,'price3'=>$price3,'price'=>$productsAttr->price,'stock'=>$productsAttr->stock,'sku'=>$productsAttr->sku],200); 
		
	}
	
	// Add multiple Images of a product view
	public function productsImages(Request $request,$id = null){
		$productImage = ProductsImage::where(['product_id'=>$id])->get();
		$productDetails = Products::with('attributes')->where(['id'=>$id])->first();
		return view('products.add_images')->with(['productDetails'=>$productDetails,'productImage'=>$productImage,]);
	}
	//Add multiple Images of a product function
	public function productsaddimages(Request $request,$id = null){
		$productImage = ProductsImage::where(['product_id'=>$id])->get();
		if($request->isMethod('post')){
		$image = $request->all();
		if($request->hasFile('image')){
		$files = $request->file('image');
			foreach($files as $file){
				$extension = $file->getClientOriginalExtension();
				$image_name = $file->getClientOriginalName();
				$filename = rand(111,99999).'_'.$image_name;
				$large_image_path = 'images/frontend_image/products/large/'.$filename;
				$medium_image_path = 'images/frontend_image/products/medium/'.$filename;
				$small_image_path = 'images/frontend_image/products/small/'.$filename;
				
				Image::make($file)->save($large_image_path);
				Image::make($file)->resize(600,600)->save($medium_image_path);
				Image::make($file)->resize(300,300)->save($small_image_path);
				$ProductsImage = new ProductsImage;
				$ProductsImage->product_image =$filename;
				$ProductsImage->product_id = $id;
				$ProductsImage->save();
			}
			
		}
		return redirect()->back()->with('flush_message_success','Product image upload Successfully');
		}
		return view('products.add_images')->with(['controller'=>'products','page_type'=>'front']);
	}
	//delete multiple added images
	public function productsDeleteimages(Request $request){
		$id = $request['id'];
		$productImage = ProductsImage::where(['id'=>$id])->first();
		$productImage->product_image;
		$smallImage_path ='images/frontend_image/products/small/';
		$mediumImage_path ='images/frontend_image/products/medium/';
		$largeImage_path ='images/frontend_image/products/large/';
		
		if(file_exists($smallImage_path.$productImage->product_image)){
			unlink($smallImage_path.$productImage->product_image);
		}
		if(file_exists($mediumImage_path.$productImage->product_image)){
			unlink($mediumImage_path.$productImage->product_image);
		}
		if(file_exists($largeImage_path.$productImage->product_image)){
			unlink($largeImage_path.$productImage->product_image);
		}
		ProductsImage::where('id',$id)->delete();
		return redirect()->back()->with('flush_message_success','Product image delete Successfully');
	}
	
	// product attribute delete
	public function productsAttributesUpdate(Request $request){
		$data = $request->all();
		if($request->isMethod('post')){
			foreach($data['AttrId'] as $key=>$attr){
				ProductsAttribute::where(['id'=>$data['AttrId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
			}
		}
		return redirect()->back()->with('flush_message_success','Product attribute save Successfully');
	}
	
	// ueser cart product details()
	public function productCart(Request $request){
		$cartData = $request->all();
		
		if(!empty($cartData['wishlist']) && $cartData['wishlist'] =="wish list"){
			if (Auth::check()){
				$authId = Auth::user()->id;
				$userDetail = User::find($authId)->toArray();	
				$size = explode('-', $cartData['sizeId']);
				$size = $size['1'];
				$price = explode(' ', $cartData['product_price']);
				$price = $price['1'];
				
				$countWishlist = Wishlist::where([
				'product_id'=>$cartData['product_id'],
				'user_email'=>$userDetail['email'],
				'product_name' =>$cartData['product_name'],
				'product_code' =>$cartData['product_code'], 
				'product_color' =>$cartData['product_color']
				])->count();
				if($countWishlist >0){
					return redirect()->back()->with('flush_message_error','Product already exists in you wish list!');
				}else{
					//save selected wish list products
					DB::table('wishlists')->insert([
					'product_id' => $cartData['product_id'], 
					'product_name' =>$cartData['product_name'],
					'product_code' =>$cartData['product_code'], 
					'product_color' =>$cartData['product_color'],  
					'user_email' =>$userDetail['email'], 
					'size' =>$size,
					'price' =>$price,
					'quantity' =>$cartData['quantity'],
					'created_at' =>date('Y-m-d')
					]);
					return redirect()->back()->with('flush_message_success','Product has been added in you wish list!');
				}
			}else{
				return redirect()->back()->with('flush_message_error','Please login to add wish list of products !');
			}
		}else{
			//check products quentity if selected products more quantity more from available shoe error message
			$size = explode('-', $cartData['sizeId']);
			$product_size = $size['1'];
			$Prostock = ProductsAttribute::where(['product_id'=>$cartData['product_id'],'size'=>$product_size])->first();
			$Prostocks = json_decode(json_encode($Prostock));
			if($Prostocks->stock < $cartData['quantity']){
				return redirect()->back()->with('flush_message_success','Your selected quentity not available !');
			}
			Session::forget('total_amount');
			Session::forget('couponAmount');
			
			$product_price = $request->input('product_price');
			$product_price_length = strlen($product_price);
			
			if($product_price_length>=5){
			$product_price = substr($product_price,4);	
			}else{
			$product_price = $request->input('product_price');
			}
			
			$size = $cartData['sizeId'];
			$size_length = strlen($size);
			if($size_length>=4){
			$size = substr($size,3);
				if($size =='arge') {
				$size ='Large';
				}
				if($size =='edium') {
				$size ='Medium';
				}
				if($size =='mall') {
				$size ='Small';
				}
				if($size =='mall') {
				$size ='Small';
				}
				if($size =='L') {
				$size ='XL';
				}
				if($size =='XL') {
				$size ='XXL';
				}
			}else{
			 $size = $cartData['sizeId'];
			}
			//check and create session id
			$session_id = Session::get('session_id');
			$session_email = Session::get('session_email');
			if(empty($session_id)){
				$session_id = $cartData['session_id'];
				session::put('session_id',$session_id);
			}
			if(empty($session_email)){
				$session_email = "None";
			}
			//check dublicate add products
			
			$countProduct = DB::table('cart')->where([
			'product_id' => $cartData['product_id'], 
			'product_name' =>$cartData['product_name'], 
			'product_color' =>$cartData['product_color'], 
			'session_id' =>$session_id, 
			'size' =>$size,
			])->count();
			
			if($countProduct>=1){
			return redirect()->back()->with('flush_message_success','Selected product already exists in your cart!');
			}else{
			//save selected products
			DB::table('cart')->insert([
			'product_id' => $cartData['product_id'], 
			'product_name' =>$cartData['product_name'],
			'product_code' =>$cartData['product_code'], 
			'product_color' =>$cartData['product_color'], 
			'product_image' =>$cartData['product_image'], 
			'user_email' =>$session_email, 
			'session_id' =>$session_id, 
			'size' =>$size,
			'price' =>$product_price,
			'quantity' =>$cartData['quantity'],
			'created_at' =>date('Y-m-d'),
			'updated_at' =>date('Y-m-d')		
			]);
			//echo "successfull add to cart saved";
			}
			return redirect('cart_items')->with('flush_message_success','Product hass been added in Cart!');
			//return view('products.cart')->with(['controller'=>'product','page_type'=>'front']);
		}
	}
	// user selected cart item show
	public function cartItems(){
		$session_id = Session::get('session_id');
		$userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
		foreach($userCart as $key=>$cartIteam){
			$product_id = $cartIteam->product_id;
			$productImage = Products::where('id',$product_id)->first();
			$userCart[$key]->image = $productImage->image;
		}
		//echo"<pre>";
		//print_r($userCart);
		//die;
	return view('products.cart')->with(['userCart'=>$userCart,'controller'=>'product','page_type'=>'front']);
	}
	//
	public function cartItemsDelete($id = null){
		Session::forget('total_amount');
		Session::forget('couponAmount');
		Session::forget('coupon');
		DB::table('cart')->where(['id'=>$id])->delete();
		return redirect()->back()->with('flush_message_success','Product hass been delete in Cart!');

	}
	
	//Cart Item update quentity
	public function cartUpdateQuentity($id = null,$quentity = null){
		Session::forget('total_amount');
		Session::forget('couponAmount');
		Session::forget('coupon');
		$getCartDetails = DB::table('cart')->where('id',$id)->first();
		$productStock = DB::table('products_attributes')->where('sku',$getCartDetails->product_code)->first();
		$countQuentity = $getCartDetails->quantity + $quentity;
		$stockAvality = $productStock->stock;
		if($stockAvality>=$countQuentity){
			DB::table('cart')->where('id',$id)->increment('quantity',$quentity);
			return redirect()->back()->with('flush_message_success','Product quentity hass been update in Cart!');
		}else{

			return redirect()->back()->with('flush_message_error','Product quentity not in stock!');
		}
		
		
	}
	// coupon apply 
	public function couponApply(){
		$coupon = $_GET['coupon_name'];
		$couponDetails = DB::table('coupon')->where('coupon_code',$coupon)->count();
		if($couponDetails ==0){
		return response()->json(['success'=>1,'couponMessage'=>'Your coupon code not exists !'],200); 
		}else{
			$couponCount = DB::table('coupon')->where('coupon_code',$coupon)->first();
			
			if($couponCount->status ==0){
				return response()->json(['error'=>1,'errorMessage'=>'Your coupon code is not active !'],200);
			}
			$couponCount->expiry_date;
			$expiryDate = date('Y-m-d',$couponCount->expiry_date);
			$currentDate = date('Y-m-d');
			
			if($expiryDate < $currentDate){
				return response()->json(['error'=>2,'errorMessage'=>'Your coupon code is expired !'],200);
			}
			
			// put discount in session
			
			$session_id = Session::get('session_id');
			$couponCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
			$total_amount = 0;
			foreach($couponCart as $cartIteam){
				$total_amount = $total_amount +($cartIteam->price*$cartIteam->quantity);
			}
			
			if($couponCount->amount_type=='fixed'){
				$couponAmount = $couponCount->amount;
				Session::put('couponAmount',$couponAmount);
				Session::put('coupon',$coupon);
				Session::put('total_amount',$total_amount);
				return response()->json(['error'=>3,'errorMessage'=>$couponAmount],200);
			}else{
				//persentage price
				$couponAmount = $total_amount *($couponCount->amount/100);
				Session::put('couponAmount',$couponAmount);
				Session::put('coupon',$coupon);
				Session::put('total_amount',$total_amount);
				
				return response()->json(['error'=>3,'errorMessage'=>$couponAmount],200);
			}
			
			return response()->json(['error'=>3,'errorMessage'=>'Your coupon code is active apply !'],200);
			
		}
		
		
	}
	
	public function checkOut(){
		if(Auth::check()){
			$authId = Auth::user()->id;
			$currentuserDetail = User::find($authId);
			$country = Country::get();
			return view('products.check_out')->with(['currentuserDetail'=>$currentuserDetail,'country'=>$country,'page_type'=>'front']);
		}else{
			 //return redirect()->intended('/login-register');
			 return redirect()->action('UsersController@register');
		}
	}
	
	
	
	public function checkOutBilling(Request $request){
		//billing data save if already not or update
		if($request->isMethod('post')){
			$billingData = $request->all();
			//check billing pincode available for delivery
			$pinCount = DB::table('pincodes')->where('pincode',$billingData['billing_pincode'])->count();
			
			if($pinCount<=0){
				return redirect()->back()->with('flush_message_error','Your delivery address pincode '.$billingData['billing_pincode'].' is not available!');
			}
			$Deliverydata = DB::table('delivery_address')->where(['user_id'=>$billingData['billing_userid'],'user_email'=> $billingData['billing_useremail']])->first();;

			if (empty($Deliverydata)){
				DB::table('delivery_address')->insert([
				'user_id'	 => $billingData['billing_userid'], 
				'user_email' => $billingData['billing_useremail'], 
				'name' => $billingData['billing_name'], 
				'address' => $billingData['billing_address'], 
				'city' => $billingData['billing_city'], 
				'state' => $billingData['billing_state'], 
				'country' => $billingData['billing_country'], 
				'pincode' => $billingData['billing_pincode'], 
				'mobile' => $billingData['billing_mobile']
				]);
			}else{
				DB::table('delivery_address')
				->where(['user_id'=>$billingData['billing_userid'],'user_email'=> $billingData['billing_useremail']])
				->update([  
				'name' => $billingData['billing_name'], 
				'address' => $billingData['billing_address'], 
				'city' => $billingData['billing_city'], 
				'state' => $billingData['billing_state'], 
				'country' => $billingData['billing_country'], 
				'pincode' => $billingData['billing_pincode'], 
				'mobile' => $billingData['billing_mobile']
				
				]);
			}
			return redirect()->action('ProductsController@orderReview');
			
		}	
	}
	public function orderReview(){
		$authId = Auth::user()->id;
		$authEmail = Auth::user()->email;
		$billingDetail = User::where('id',$authId)->first();
		$shippingDetail = DB::table('delivery_address')->where(['user_id'=>$authId])->first();
		$User_session_id = Session::get('session_id');
		$userViewCart_Products = DB::table('cart')->where(['session_id'=>$User_session_id,'user_email'=>$authEmail])->get();
		$total_weight =0;
		foreach($userViewCart_Products as $product){
			$productWeight = Products::where('id',$product->product_id)->first(); 
			$total_weight = $total_weight +  $productWeight->weight;
		}
	
		$shippingCharge = Products::getShippingCharge($total_weight,$shippingDetail->country);
		//echo $shippingCharge;
		return view('products.order_review')->with(['billingDetail'=>$billingDetail,'shippingDetail'=>$shippingDetail,'userViewCart_Products'=>$userViewCart_Products,'shippingCharge'=>$shippingCharge,'page_type'=>'front']);
	}
	
	// place order form
	public function placeOrder(Request $request){
		$placeOrder = $request->all();
		$user_id = Auth::user()->id;
		$user_email = Auth::user()->email;
		$coponAmount = Session::get('couponAmount');
		$couponCode = Session::get('coupon');
		
		//prevent out of stock products during at time checkout not add to cart
		$userCart =  DB::table('cart')->where('user_email',$user_email)->get();
		foreach($userCart as $cart){
			$product_stock = Products::getProductStock($cart->product_id,$cart->size);
			if($product_stock ==0){
			Products::cartProductDelete($cart->product_id,$user_email);
			return redirect('cart_items')->with('flush_message_error','One of the product is sould out! Please chose another product.');
			}
			//echo "cart products:".$cart->quantity;
			//echo "stock products:".$product_stock;
			if($cart->quantity >$product_stock){
				return redirect('cart_items')->with('flush_message_error','Reduce product quantity! Please try again.');
			}
			
			$productsStatus = Products::getProductStatus($cart->product_id);
			if($productsStatus ==0){
				Products::cartProductDelete($cart->product_id,$user_email);
				return redirect('cart_items')->with('flush_message_error','One of the product is not available! Please try another');
			}
		}
		
		$shippingDetails = DB::table('delivery_address')->where(['user_email'=>$user_email])->first();
		// save oder data in order table
		if(empty($placeOrder['coupon'])){
			$placeOrder['coupon']= "";
		}
		if(empty($placeOrder['couponAmount'])){
			$placeOrder['couponAmount']= "";
		}
		$order = new Order;
		$order->user_id = $user_id;
		$order->user_email = $user_email;
		$order->name = $shippingDetails->name;
		$order->address = $shippingDetails->address;
		$order->city = $shippingDetails->city;
		$order->state = $shippingDetails->state;
		$order->country = $shippingDetails->country;
		$order->pincode = $shippingDetails->pincode;
		$order->mobile = $shippingDetails->mobile;
		$order->shipping_charges =$placeOrder['shipping_charges'];
		$order->coupon_code = $placeOrder['coupon'];
		$order->coupon_amount = $placeOrder['couponAmount'];;
		$order->order_status = "new";
		$order->payment_method = $placeOrder['paymentMethod'];
		$order->grand_total = $placeOrder['grandTotal'];
		$order->save();
		//return redirect()->back()->with('flush_message_success','Your order successfully replace!');
		
		$order_id = DB::getPdo()->lastInsertId();
		$cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
		
		foreach($cartProducts as $pro){
			$cartPro = new OrdersProduct;
			$cartPro->order_id = $order_id;
			$cartPro->user_id = $user_id;
			$cartPro->product_id = $pro->product_id;
			$cartPro->product_code = $pro->product_code;
			$cartPro->product_name = $pro->product_name;
			$cartPro->product_size = $pro->size;
			$cartPro->product_color = $pro->product_color;
			$cartPro->product_price = $pro->price;
			$cartPro->product_quantity = $pro->quantity;
			$cartPro->save(); 
			$proQuenty = ProductsAttribute::where('sku', $pro->product_code)->first();
			$leftQuenty = $proQuenty->stock -$pro->quantity;
			if($leftQuenty <0){
				$leftQuenty =0;
			}
			ProductsAttribute::where('sku',$pro->product_code)->update(['stock'=>$leftQuenty]);
			
		}
		
		Session::put('order_id',$order_id);
		Session::put('grand_total',$placeOrder['grandTotal']);
		
		//redirect user after replace order
		if($placeOrder['paymentMethod'] =="COD"){
			
			//mail after order replace
			// order detail send mail
			$user_id = Auth::user()->id;
			$orderDetail = Order::with('orders')->where('id',$order_id)->first();
			$orderDetail = json_decode(json_encode($orderDetail),true);
			
			$userDetail = User::where('id',$user_id)->first();
			$userDetail = json_decode(json_encode($userDetail),true);
			//echo"<pre>";
			//print_r($orderDetail);
			//print_r($userDetail);
			//die;
			$email = Auth::user()->email;
			$messageData = [
			'email'=>$email,
			'name'=>$shippingDetails->name,
			'order_id'=>$order_id,
			'amount'=>$placeOrder['grandTotal'],
			'paymentMethod'=>$placeOrder['paymentMethod'],
			'orderDetail'=>$orderDetail,
			'userDetail'=>$userDetail
			];
			Mail::send('mail.place_order',$messageData,function($message) use($email){
				$message->to($email)->subject('Shopping order with Muzaffer E-com Website');
			}); 
			
			//if COD order then show thank you page
			return redirect('/thank-you');
		}else if($placeOrder['paymentMethod'] =="payumoney"){
			// checked if pay ment method payumoney redirect in payumoneyController
			return redirect('/payumoney');
		}else{
			//mail after order replace by payPal method
			$email = Auth::user()->email;
			$user_id = Auth::user()->id;
			
			$orderDetail = Order::with('orders')->where('id',$order_id)->first();
			$orderDetail = json_decode(json_encode($orderDetail),true);
			
			$userDetail = User::where('id',$user_id)->first();
			$userDetail = json_decode(json_encode($userDetail),true);
			$messageData = [
			'email'=>$email,
			'name'=>$shippingDetails->name,
			'order_id'=>$order_id,
			'amount'=>$placeOrder['grandTotal'],
			'paymentMethod'=>$placeOrder['paymentMethod'],
			'orderDetail'=>$orderDetail,
			'userDetail'=>$userDetail
			];
			Mail::send('mail.place_order',$messageData,function($message) use($email){
				$message->to($email)->subject('Shopping order with Muzaffer E-com Website');
			}); 
			return redirect('/paypal');
		}		
	}
	//thank you page show after order replace order
	public function thankYou(){
		$user_email = Auth::user()->email;
		DB::table('cart')->where('user_email', $user_email)->delete();
		return view('order.thank');
	}
	//Make paypal method page show after order replace order
	public function payPal(){
		$user_email = Auth::user()->email;
		DB::table('cart')->where('user_email', $user_email)->delete();
		return view('order.paypal');
	}
	
	public function userOrders(){
		$user_id = Auth::user()->id;
		$UsersOrder = Order::with('orders')->where('user_id',$user_id)->get();
		$UsersOrder = json_decode(json_encode($UsersOrder));
		//echo"<pre>";
		//print_r($UsersOrder);
		return view('order.users_order')->with(compact('UsersOrder'));
	}
	
	public function orderView($orderId){
		$user_id = Auth::user()->id;
		
		$UserOrders = Order::with('orders')->where('id',$orderId)->first();
		$UsersOrders = json_decode(json_encode($UserOrders));
		//echo"<pre>";
		//print_r($UsersOrders);
	
		return view('order.order_view')->with(['UsersOrders'=>$UsersOrders]);
	}
	//paypal thank you page after pament redirect this page
	public function paypalThanks(){
		return view('order.paypal_thank');
	}
	// if paypal cancle then redirect this page
	public function paypalCancle(){
		return view('order.paypal_cancle');
	}
	
	// all products view in admin section
	public function orderViewadmin(){
		$UserOrders = Order::with('orders')->get();
		$UsersOrder = json_decode(json_encode($UserOrders));
		return view('products.admin.order_view')->with(['UsersOrder'=>$UsersOrder]);
	}
	
	//products order invoice 
	public function orderInvoice($order_id){
		$OrdersView = Order::with('orders')->where('id',$order_id)->first();
		$UsersOrderview = json_decode(json_encode($OrdersView));
		
		$UserDetail = User::where('id',$UsersOrderview->user_id)->first();
		$UserDetail = json_decode(json_encode($UserDetail));
		
		return view('products.admin.orderview_invoice')->with(['UsersOrderview'=>$UsersOrderview,'UserDetail'=>$UserDetail]);
	}
	
	//order pdf invoice
	public function orderPdfInvoice($order_id){
		$OrdersView = Order::with('orders')->where('id',$order_id)->first();
		$UsersOrderview = json_decode(json_encode($OrdersView));
		
		$UserDetail = User::where('id',$UsersOrderview->user_id)->first();
		$UserDetail = json_decode(json_encode($UserDetail));
	/* 	echo"<pre>";
		print_r($UsersOrderview);
		die; */
		
		$outPut1 ='<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<div class="invoice-title">
								<h2>Invoice</h2><h3 class="pull-right">Order # '.$UsersOrderview->id.'</h3>
							</div>
							<hr>
							<div class="row">
								<div class="col-xs-6">
									<address>
									<strong>Billed To:</strong><br>
										'.$UserDetail->name.'<br>
										'.$UserDetail->email.'<br>
										'.$UserDetail->address.'<br>
										'.$UserDetail->city.'<br>
										'.$UserDetail->state.'<br>
										'.$UserDetail->country.'<br>
										'.$UserDetail->pincode.'<br>
										'.$UserDetail->mobile.'
										
									</address>
								</div>
								<div class="col-xs-6 text-right" style="float:right;margin-top:-170px;">
									<address>
									<strong>Shipped To:</strong><br>
										'.$UsersOrderview->name.'<br>
										'.$UsersOrderview->user_email.'<br>
										'.$UsersOrderview->address.'<br>
										'.$UsersOrderview->city.'<br>
										'.$UsersOrderview->state.'<br>
										'.$UsersOrderview->country.'<br>
										'.$UsersOrderview->pincode.'<br>
										'.$UsersOrderview->mobile.'
										
									</address>
								</div>
							</div>
							<br><br><br><br><br><br><br><br><br><br><br>
							<div class="row">
								<div class="col-md-6">
									<address>
										<strong>Payment Method:</strong><br>
										'.$UsersOrderview->payment_method.'
									</address>
								</div>
								<div class="col-md-6 text-right">
									<address>
										<strong>Order Date:</strong><br>
										'.$UsersOrderview->created_at.'<br><br>
									</address>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title"><strong>Order summary</strong></h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-condensed">
											<thead>
												<tr>
													<td><strong>Item</strong></td>
													<td class="text-center"><strong>Coupan</strong></td>
													<td class="text-center"><strong>Size</strong></td>
													<td class="text-center"><strong>Color  </strong></td>
													<td class="text-center"><strong>Price  </strong></td>
													<td class="text-center"><strong>Quantity</strong></td>
													<td class="text-right"><strong>Totals</strong></td>
												</tr>
											</thead>
											<tbody>';
												
												$Subtotal = 0;
												foreach($UsersOrderview->orders as $order){
												$outPut2 ='<tr>
													<td>'.$order->product_code.'('.$order->product_name.')</td>
													<td class="text-center">'.$UsersOrderview->coupon_code.' </td>
													<td class="text-center">'.$order->product_size.' </td>
													<td class="text-center">'.$order->product_color.' </td>
													<td class="text-center">INR '.$order->product_price.' </td>
													<td class="text-center">'.$order->product_quantity.' </td>
													<td class="text-right">'.$order->product_quantity * $order->product_price.' </td>
												</tr>';
												 $Subtotal = $Subtotal + ($order->product_quantity * $order->product_price);
												 }
												$outPut3 ='<tr>
													<td class="thick-line"></td>
													<td class="thick-line"></td>
													<td class="thick-line"></td>
													<td class="thick-line"></td>
													<td class="thick-line"></td>
													<td class="thick-line text-center"><strong>Subtotal</strong></td>
													<td class="thick-line text-right">'.$Subtotal.'</td>
												</tr>
												<tr>
													<td class="no-line"></td>
													<td class="no-line"></td>
													<td class="no-line"></td>
													<td class="no-line"></td>
													<td class="no-line"></td>
													<td class="no-line text-center"><strong>Shipping (+)</strong></td>
													<td class="no-line text-right">INR '.$UsersOrderview->shipping_charges.'</td>
												</tr>
												
												<tr>
													<td class="no-line"></td>
													<td class="no-line"></td>
													<td class="no-line"></td>
													<td class="no-line"></td>
													<td class="no-line"></td>
													<td class="no-line text-center"><strong>Discount (-)</strong></td>
													@if(!empty($UsersOrderview->coupon_amount))
													<td class="no-line text-right">INR '.$UsersOrderview->coupon_amount.'</td>
													$couponAmount = $UsersOrderview->coupon_amount;
												    @else
													$couponAmount =0;
													@endif	
												</tr>
												<tr>
													<td class="no-line"></td>
													<td class="no-line"></td>
													<td class="no-line"></td>
													<td class="no-line"></td>
													<td class="no-line"></td>
													<td class="no-line text-center"><strong>Total</strong></td>
													<td class="no-line text-right">'.$Subtotal.'</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>';
			// instantiate and use the dompdf class
			$outPut = $outPut1.$outPut2.$outPut3;
			$dompdf = new Dompdf();
			$dompdf->loadHtml($outPut);

			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('A4', 'landscape');

			// Render the HTML as PDF
			$dompdf->render();

			// Output the generated PDF to Browser
			$dompdf->stream();
					
	}
	
	public function orderDetails($order_id){
		$OrdersView = Order::with('orders')->where('id',$order_id)->first();
		$UsersOrderview = json_decode(json_encode($OrdersView));
		
		$UserDetail = User::where('id',$UsersOrderview->user_id)->first();
		$UserDetail = json_decode(json_encode($UserDetail));
		//$UsersOrderview->user_id;
		//echo"<pre>";
		//print_r($UsersOrderview);
		//die;
		return view('products.admin.orderview_details')->with(compact('UsersOrderview','UserDetail'));
	}
	
	//order status update backend
	public function orderUpdate(Request $request){
		$data = $request->all();
		//echo"<pre>";
		//print_r($data);
		DB::table('orders')->where('id',$data['id'])->update([
		'order_status' => $data['option']
		]);
		return redirect()->back()->with('flush_message_success','Product order status update successfull');
	}
	
	//products search fortend heasder 
	public function productSearch(Request $request){
		$prosearch = $request->all();
		//echo "<pre>";
		//print_r($prosearch);
		$categories = Category::with('categories')->where(['parent_id'=>0])->get();
		$search_product = $prosearch['prosearch'];
		//die;
		$url ="search/filter";
		$SizeArr = ProductsAttribute::select('size')->groupBy('size')->get();
		$SizeArr = array_flatten(json_decode(json_encode($SizeArr),true));
		
		$productsAll = Products::where('product_name','like','%'.$search_product.'%')->orwhere('product_code',$search_product)->where('status',1)->paginate(6);
		return view('products.listing')->with(compact('search_product','productsAll','categories','url','SizeArr'));
	}
	
	// products filter with color
	public function productFilter(Request $request){
		$filterData = $request->all();
		$colorUrl ="";
		if(!empty($filterData['color'])){
			foreach($filterData['color'] as $color){
				if(empty($colorUrl)){
				$colorUrl= "&color=".$color;
				}else{
				$colorUrl.= "-".$color;
				}
			}
		
		}
		
		$sizeUrl ="";
		if(!empty($filterData['size'])){
			foreach($filterData['size'] as $size){
				if(empty($sizeUrl)){
				$sizeUrl= "&size=".$size;
				}else{
				$sizeUrl.= "-".$size;
				}
			}
		
		}
		
		$currentUrl = url()->previous();
		$endUrl = explode('/', $currentUrl);
		if(end($endUrl) =='filter'){
			return redirect::to('product/C-Shirt');
		}
		$currentUrl2 = explode("/",$currentUrl);
		if (in_array("products", $currentUrl2)) 
		  { 
		  $finalUrl= "products/".$filterData['url']."?".$colorUrl.$sizeUrl; 
		  } 
		else
		  { 
		  $finalUrl= "product/".$filterData['url']."?".$colorUrl.$sizeUrl;
		  } 
		return redirect::to($finalUrl);
	}
	
	
	public function pincodCheck(Request $request){
		$pinData = $request->all();
		$pinCount = DB::table('pincodes')->where('pincode',$pinData['pincode'])->count();
		if($pinCount>0){
		$pincode = DB::table('pincodes')->where('pincode',$pinData['pincode'])->first();
		return response()->json(['success'=>1,'pinMessage'=>'Your delevery address '.$pincode->city.' is available !'],200);
		//echo"Your delevery address ".$pincode->city." is available !";
		}else{
			return response()->json(['error'=>1,'pinMessage'=>'Your delevery address not available !'],200);
		//echo"Your delevery address not available !";
		}
		
	}

	//users all order products
	public function productOrder(){
	$userId =  Auth::user()->id;
	$userOrders = OrdersProduct::with('User')->where(['user_id'=>$userId])->orderBy('id', 'DESC')->paginate(10);;
	//$userOrders =json_decode(json_encode($userOrders));
	return view('products.user_orders')->with(compact('userOrders'));
	}
	
	// users wish list products
	public function wishList(){
		if (Auth::check()){
			$authEmail = Auth::user()->email;
			$userCart = Wishlist::where('user_email',$authEmail)->get()->toArray();
			foreach($userCart as $key=>$cartIteam){
				$product_id = $cartIteam['product_id'];
				$productImage = Products::where('id',$product_id)->first()->toArray();
				$userCart[$key]['image'] = $productImage['image'];
			}
			return view('products.wishlist')->with(['userCart'=>$userCart,'controller'=>'product','page_type'=>'front']);
		}else{
			return redirect()->back()->with('flush_message_error','Please login to view wish list of products !');
		}
	}
	
	// wish list item delete
	public function wishlistItemsDelete($id){
		Wishlist::where('product_id',$id)->delete();
		return redirect()->back()->with('flush_message_success','Wish list product deleted successfully');
	}
	// order view in chart
	public function orderViewChart(){
		$currentMonth = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
		$lastMonth = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
		$lasttolastMonth = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
		$lastto3Month = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(3))->count();
		$lastto4Month = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(4))->count();
		return view ('products.admin.order_view_chart')->with(compact('currentMonth','lastMonth','lasttolastMonth','lastto3Month','lastto4Month'));
	}
}

