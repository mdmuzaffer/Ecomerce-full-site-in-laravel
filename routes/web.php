<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function (){
    return view('welcome');
}); */
// frontend ecommerce routes
Route::get('/', 'IndexController@index');
//category page =>changed url 14-06-2019
Route::get('/product/{url}', 'ProductsController@listing');
//cart page details 
Route::get('/products/{id}', 'ProductsController@product');
// User cart form details
Route::match(['get','post'],'/products/add_cart', 'ProductsController@productCart');
//user selected item in cart page
Route::match(['get','post'],'/cart_items', 'ProductsController@cartItems');
//user selected item in cart delete
Route::get('/cart_items_delete/{id}', 'ProductsController@cartItemsDelete');
// wishlist items delete
Route::get('/wislis_items_delete/{id}', 'ProductsController@wishlistItemsDelete');
//user selected item in cart quentity update
Route::get('/cart/update-quentity/{id}/{quentity}', 'ProductsController@cartUpdateQuentity');
//cart page atttribute details
Route::get('/price', 'ProductsController@porductPrice');
//coupon applay 
Route::get('/coupon-apply', 'ProductsController@couponApply');
//check out after select item
Route::get('/check-out', 'ProductsController@checkOut');
//checkout billing form
Route::post('/check_out_blling', 'ProductsController@checkOutBilling');
//products order review
Route::match(['get','post'],'/order-review', 'ProductsController@orderReview');

//user login register
Route::match(['get','post'],'/login-register', 'UsersController@register');
//user sign up for shoping
Route::match(['get','post'],'/users-register', 'UsersController@usersRegister');

// user password forget
Route::match(['get','post'],'/forget-password', 'UsersController@forgetPassword');
//check email through jquery validation remote function
Route::match(['get','post'],'/check-email', 'UsersController@checkEmail');
//user login 
Route::post('/user-login', 'UsersController@userLogin');
//login user logout
Route::get('/user-logout', 'UsersController@userLogout');
//Confirm active email link
Route::get('/confirm/{code}', 'UsersController@confirmEmail');
//frontent end account login page 
Route::match(['get','post'],'/account', 'UsersController@usersAccount');
//products seach frontend header 
Route::match(['get','post'],'/product/search/filter','ProductsController@productSearch');
//Pincode code
Route::match(['get','post'],'/pincode-check','ProductsController@pincodCheck');

//frontend cms pages in footer
Route::match(['get','post'],'/page/{url}', 'cmspageController@pageUrl');
Route::match(['get','post'],'/pages/contact-us', 'cmspageController@contactUs');

//products filter with color
Route::match(['get','post'],'/product-filter', 'ProductsController@productFilter');
// Newsletter subscriber
Route::post('/subscribe-newsletter', 'NewsletterController@subscribeNewsletter');


//frontend auth middleware
Route::group(['middleware' =>['frontlogin']], function(){
//Route::match(['get','post'],'/account', 'UsersController@usersAccount');
Route::match(['get','post'],'/user-password-update', 'UsersController@usersPasswordUp');
Route::match(['get','post'],'/check-password', 'UsersController@checkPassword');
//check out place order
Route::match(['get','post'],'/place-order', 'ProductsController@placeOrder');
//thank you page show after order replace order
Route::get('/thank-you', 'ProductsController@thankYou');
//Make paypal method page show after order replace order
Route::get('/paypal', 'ProductsController@payPal');
//user own order view products
Route::get('/orders', 'ProductsController@userOrders');
//user's every single order products view
Route::match(['get','post'],'/order-view/{id}','ProductsController@orderView');
//payPal thanks page after complete payment
Route::get('/paypal/thanks','ProductsController@paypalThanks');
//payPal cancletion page redirect
Route::get('/paypal/cancle','ProductsController@paypalCancle');
//users all order products
Route::get('/product-order','ProductsController@productOrder');
// users wish list products
Route::match(['get','post'],'/wish-list', 'ProductsController@wishList');
});



// backend auth middleware
Route::group(['middleware' => ['adminlogin']], function(){
	Route::get('/admin/dashboard', 'AdminController@dashboard');	
	Route::post('/admin/passwordChange', 'AdminController@passwordChange');	
	// ctegories Route for (admin)
	Route::match(['get','post'],'/admin/add-category', 'CategoryController@addCategory');
	Route::match(['get','post'],'/admin/category', 'CategoryController@category');
	Route::get('/admin/view-category', 'CategoryController@viewCategory');
	Route::post('/admin/update-category', 'CategoryController@updateCategory');
	Route::post('/admin/delete-category', 'CategoryController@deleteCategory');
	// Products Route for damin
	Route::match(['get','post'],'/admin/add-products', 'ProductsController@addProducts');
	Route::match(['get','post'],'/admin/save-products', 'ProductsController@saveProducts');
	Route::match(['get','post'],'/admin/view-products', 'ProductsController@viewProducts');
	Route::get('/admin/edit-products/{id}', 'ProductsController@editProducts');
	Route::post('/admin/update-products', 'ProductsController@updateProducts');
	Route::get('/admin/view-products-popup', 'ProductsController@viewProductspopup');
	Route::get('/admin/delete-products/{id}', 'ProductsController@DeleteProducts');
	Route::get('/admin/delete-image/{id}', 'ProductsController@DeleteImage');
	// products atttribute Routes
	Route::match(['get','post'],'/admin/products-attributes/{id}','ProductsController@productsAttributes');
	Route::match(['get','post'],'/admin/products-attributes-update/{id}','ProductsController@productsAttributesUpdate');
	Route::match(['get','post'],'/admin/products-images/{id}','ProductsController@productsImages');
	Route::match(['get','post'],'/admin/products-addimages/{id}','ProductsController@productsAddimages');
	Route::match(['get','post'],'/admin/products-deleteimages/{id}','ProductsController@productsDeleteimages');
	Route::post('/admin/products-attribute-delete/','ProductsController@productsAttributesDelete');
	Route::post('/admin/products-attribute-deletes/','ProductsController@productsAttributesMultdelete');
	//add coupan 
	Route::match(['get','post'],'/admin/add_coupon/','CouponController@index');
	Route::match(['get','post'],'/admin/save-coupons/','CouponController@saveCoupons');
	Route::get('/admin/view-coupons/','CouponController@viewCoupons');
	Route::match(['get','post'],'/admin/edite_coupon/{id}','CouponController@editeCoupons');
	Route::match(['get','post'],'/admin/update_coupon/{id}','CouponController@updateCoupon');
	Route::match(['get','post'],'/admin/delete_coupon/{id}','CouponController@deleteCoupons');
	//home page banner chanhe or show dynamically
	Route::get('/admin/banner-add','BannerController@index');
	Route::get('/admin/banner-edit','BannerController@edit');
	Route::post('/admin/banner-save','BannerController@bannerSave');
	Route::get('/admin/banner-update/{id}','BannerController@bannerUpdate');
	Route::get('/admin/banner-delete/{id}','BannerController@bannerDelete');
	Route::post('admin/banner-change','BannerController@bannerChangeupdate');
	//all order view in admin section in a table
	Route::get('/admin/order-view','ProductsController@orderViewadmin');
	//all order view in chart
	Route::get('/admin/order-view-chart','ProductsController@orderViewChart');
	// order invoice details
	Route::get('/admin/order-invoice/{id}','ProductsController@orderInvoice');
	// order pdf invoice
	Route::get('/admin/order-pdf-invoice/{id}','ProductsController@orderPdfInvoice');
	//Order view details in a singale page
	Route::get('/admin/order-details/{id}','ProductsController@orderDetails');
	//order status update
	Route::post('/admin/order-update','ProductsController@orderUpdate');
	//show all frontend users detail in backend admin panal
	Route::get('/admin/user-view','UsersController@userView');
	// user view chart
	Route::get('/admin/user-view-chart','UsersController@userViewChart');
	// users register chart country
	Route::get('/admin/user-view-country','UsersController@userViewChartCountry');
	//show all admin/sub admin users detail in backend admin panal
	Route::get('/admin/admin-view','AdminController@adminView');
	//add admin /sub admin in backend
	Route::match(['get','post'],'/admin/add-admin','AdminController@adminAdd');
	//admin edit 
	Route::get('/admin/admin-edit/{id}','AdminController@adminEdit');
	//delete admin
	Route::get('/admin/admin-delete/{id}','AdminController@adminDelete');
	//admin update 
	Route::post('/admin/admin-update','AdminController@adminUpdate');
	
	//cms page controller for the footer
	Route::get('/admin/cms-page', 'cmspageController@cmsPage');
	//add cms page form
	Route::match(['get','post'],'/admin/add-cms-page', 'cmspageController@addcmsPage');
	//delete cms page
	Route::match(['get','post'],'/admin/view-cms-page', 'cmspageController@viewcmsPage');
	//update cms page form
	Route::match(['get','post'],'/admin/edit-page/{id}', 'cmspageController@editPage');
	// update cms page into database
	Route::match(['get','post'],'/admin/update-page/{id}', 'cmspageController@updatePage');
	//delete cms page
	Route::match(['get','post'],'/admin/delete-page/{id}', 'cmspageController@deletePage');
	
	//currency page 
	Route::match(['get','post'],'/admin/add-currency', 'CurrencyController@addCurrency');
	//view curency
	Route::match(['get','post'],'/admin/view-currency', 'CurrencyController@viewCurrency');
	//update currency form
	Route::match(['get','post'],'/admin/upadte-currency/{id}', 'CurrencyController@updateCurrency');
	
	//currency upadte 
	Route::match(['get','post'],'/admin/currency-currency', 'CurrencyController@currencyUpdate');
	//delete curency
	Route::match(['get','post'],'/admin/delete-currency/{id}', 'CurrencyController@DeleteCurrency');
	//shipping view add in backend dashboard
	Route::get('/admin/shipping','ShippingController@shippingView');
	//shipping update
	Route::match(['get','post'],'/admin/shipping-update/{id}','ShippingController@shippingUpdate');
	// Newsletter views
	Route::get('/admin/news-letter', 'NewsletterController@newsLetter');
	//News Letter status 
	Route::get('/admin/news-letter-status/{id}/{status}', 'NewsletterController@newsLetterStatus');
	//News Letter delete
	Route::get('/admin/news-letter-delete/{id}', 'NewsletterController@newsLetterDelete');
	//News letter exort
	Route::get('/admin/news-letter-export', 'NewsletterController@newsletterExport');
	//all users export
	Route::get('/admin/user-export', 'UsersController@userExport');
	// payumoney
	Route::match(['get','post'],'/payumoney', 'PayumoneyController@payumoneyOrder');
	Route::match(['get','post'],'/payumoney/response', 'PayumoneyController@payumoneyResponse');
	Route::match(['get','post'],'/payumoney/status', 'PayumoneyController@payumoneyStatus');
	

});
Route::match(['get','post'],'/admin', 'AdminController@login');
Route::get('/logout', 'AdminController@logout');
Route::get('/admin/settings', 'AdminController@settings');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');




