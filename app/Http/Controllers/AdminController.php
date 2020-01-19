<?php
namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Admin;
use Hash;
use DB;
use Validator;
class AdminController extends Controller
{
	
	public function __construct()
    {
        //$this->middleware('auth',['only' => 'dashboard']);
    }
	/*Login function */
     public function login(Request $request){
		if($request->isMethod('post')){
			$data = $request->input();
			//echo $data['username'];
			//echo $data['password'];
			$Admincount = Admin::where(['username'=>$data['username'],'password'=>md5($data['password']),'status'=>1])->count();
			if($Admincount >0){
				Session::put('adminSession',$data['username']);
				return redirect('/admin/dashboard');
			}else{
				return redirect('/admin')->with('flush_message_error','Invalid UserName and Password');
				//echo "Not Successfull";
			}
		}
        return view('admin/admin_login');
    }
	
	public function dashboard(){
		if(Session::has('adminSession')){
			//code here 
		}else{
			return redirect('/admin')->with('flush_message_error','First Login to access !');
		}
		return view('admin.dashboard')->with(array('controller'=>'login','page'=>'inner','page_type'=>'admin_inner'));
	}
	/*Log out and redirect admin page again*/
	public function logout(){
		Session::flush();
		return redirect('/admin')->with('flush_message_success','Successfull Logout');
	}
	/*Setting page load with session*/
	public function settings(){
		$adminDetail = Admin::where(['username'=>Session::get('adminSession')])->first();
		$adminDetail = json_decode(json_encode($adminDetail));
		if(!Session::has('adminSession')){
			return redirect('/admin')->with('flush_message_error','First Login to access setting page!');
		}else{
			return view('admin.setting')->with(array('adminDetail'=>$adminDetail,'controller'=>'admin','page_type'=>'admin_inner'));
		}
	}
	
	/* password change by fist check current password */
	public function passwordChange(Request $request){
		$current_password = $request->input('current_password');
		$new_password = $request->input('new_password');
		$conform_password = $request->input('conform_password');
		$check_password = Admin::where(['username'=>Session::get('adminSession'),'status'=>'1'])->first();
		
		$password = md5($new_password);
		$current_password = md5($current_password);
		$validator = Validator::make($request->all(),[
			'current_password' =>'required',
			'new_password' =>'required|min:5',
			'conform_password' =>'required|same:new_password',
		]);
		if($validator->fails()){             
            return response()->json(['success'=>0, 'message'=>$validator->messages()->first()], 200);
		}else{
			
			$Admincount = Admin::where(['username'=>Session::get('adminSession'),'password'=>$current_password,'status'=>1])->count();
			if($Admincount >0){
				Admin::where(['username'=>Session::get('adminSession'),'status'=>'1'])->update(['password'=>$password]);
				return response()->json(['success'=>1, 'message'=>'Your password successfully changed'], 200);
			}else{
			  return response()->json(['success'=>2, 'message'=>'Your Current password does not match'], 200);
			}
			
		}
	}
	//All admin view in table
	public function adminView(){
		$admin = Admin::get();
		$admin = json_decode(json_encode($admin));
		return view('admin.admin.admin_view')->with(array('admin'=>$admin,'controller'=>'AdminController','page_type'=>'admin_inner'));
	}
	//admin data insert
	public function adminAdd(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			/*  echo"<pre>";
			print_r($data);
			die;  */
			$validatedData = Validator::make($request->all(),[
				'username' => 'required|min:3|max:18|unique:admins,username',
				'password' => 'required',
			]);
			 if ($validatedData->fails()){
				 return back()->withErrors($validatedData)->withInput();
			 }else{
				if(empty($data['status'])){
					$data['status'] ='0';
				}
				if(empty($data['products_access'])){
					$data['products_access'] ='0';
				}
				if(empty($data['categories_access'])){
					$data['categories_access'] ='0';
				}
				if(empty($data['orders_access'])){
					$data['orders_access'] ='0';
				}
				if(empty($data['users_access'])){
					$data['users_access'] ='0';
				}
				if(empty($data['status'])){
					$data['status'] ='0';
				}
				$admin = new Admin();
				$admin->username = $data['username'];
				$admin->password = md5($data['password']);
				$admin->type = $data['type'];
				$admin->products_access = $data['products_access'];
				$admin->categories_access = $data['categories_access'];
				$admin->orders_access = $data['orders_access'];
				$admin->users_access = $data['users_access'];
				$admin->status = $data['status'];
				$admin ->save();
				return back()->with('flush_message_success','Successfully added new Admin/sub admin !');
			 }

		}
		return view('admin.admin.admin_add')->with(array('controller'=>'AdminController','page_type'=>'admin_inner'));
	}
	
	public function adminEdit($id){
		$admin = DB::table('admins')->where('id', $id)->first();
		return view('admin.admin.admin_edit')->with(array('adminDetail'=>$admin,'controller'=>'AdminController','page_type'=>'admin_inner'));
	}
	// admin update 
	public function adminUpdate(Request $request){
	if($request->isMethod('post')){
			$data = $request->all();
			/*echo "<pre>";
			print_r($data);
			die;  */
			
			$validatedData = Validator::make($request->all(),[
				'username' => 'required|min:3',
				'password' => 'required',
			]);
			 if ($validatedData->fails()){
				 return back()->withErrors($validatedData)->withInput();
			 }else{
				if(empty($data['status'])){
				$data['status'] ='0';
				}
				if(empty($data['products_access'])){
					$data['products_access'] ='0';
				}
				if(empty($data['categories_access'])){
					$data['categories_access'] ='0';
				}
				if(empty($data['orders_access'])){
					$data['orders_access'] ='0';
				}
				if(empty($data['users_access'])){
					$data['users_access'] ='0';
				}
				if(empty($data['status'])){
					$data['status'] ='0';
				}
				DB::table('admins')
					->where('id',$data['id'])
					->update([
					'username'=> $data['username'],
					'password'=> md5($data['password']),
					'type'=> $data['type'],
					'products_access'=> $data['products_access'],
					'categories_access'=> $data['categories_access'],
					'orders_access'=> $data['orders_access'],
					'users_access'=> $data['users_access'],
					'status'=> $data['status'],
					]);
				return back()->with('flush_message_success','Successfully updated your admin/ sub admin !');
				}
			
		}
	}
	
	//admin delete
	public function adminDelete($urlId){
		DB::table('admins')->where('id', $urlId)->delete();
		return back()->with('flush_message_success','Successfully deleted your admin/ sub admin !');
	}
}

