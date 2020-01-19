<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Admin;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if(empty(Session::has('adminSession'))){
			return redirect('/admin');
		}else{
			$adminDetail = Admin::where('username',Session::get('adminSession'))->first();
			$adminDetail = json_decode(json_encode($adminDetail));
			if($adminDetail->type =="Admin"){
				$adminDetail->products_access =1;
				$adminDetail->categories_access =1;
				$adminDetail->orders_access =1;
				$adminDetail->users_access =1;
			}
			Session::put('adminDetail',$adminDetail);
			$currentPath = Route::getFacadeRoot()->current()->uri();
			//can't access category parts
			if($currentPath =="admin/category" && $currentPath =="admin/view-category" && Session::get('adminDetail')->categories_access ==0){
				return redirect('/admin/dashboard')->with('flush_message_error','You can not access of category module !');
			}
			//can't access products parts
			if($currentPath =="admin/add-products" && $currentPath =="admin/view-products" && Session::get('adminDetail')->products_access ==0){
				return redirect('/admin/dashboard')->with('flush_message_error','You can not access of the product module !');
			}
			//can't access orders details parts
			if($currentPath =="admin/order-view" && Session::get('adminDetail')->orders_access ==0){
				return redirect('/admin/dashboard')->with('flush_message_error','You can not access of the order module !');
			}
			
			//can't access users details parts
			if($currentPath =="admin/add-admin" && $currentPath =="admin/admin-view" && Session::get('adminDetail')->users_access ==0){
				return redirect('/admin/dashboard')->with('flush_message_error','You can not access of the user admin module !');
			}
		}
        return $next($request);
    }
}
