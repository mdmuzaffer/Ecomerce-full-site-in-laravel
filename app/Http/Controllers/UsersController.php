<?php
namespace App\Http\Controllers;
use App\Repositories\Contracts\addPostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Country;
use Hash;
use DB;
use Validator;
use Auth;
use Session;
use App\Exports\usersExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function register(Request $request){
		return view('users.login-register')->with(['controller'=>'users','page_type'=>'front']);
	}
	
	public function usersRegister(Request $request){
			//$reqeust = new \Illuminate\Http\Request;
			$data = $request->all();
			//echo"<pre>";
			//print_r($data);
			//die;
			 $validateRule = Validator::make($request->all(), [
				'name' => 'required|max:15|unique:users|min:6',
				'email' => 'required|max:35|unique:users|email',
				'password' => 'required|max:20|min:8',
			],[
				'name.min' => 'The name must be at least 6 characters',
				'name.max'=>'The name may not be greater than 15 characters',
				'name.unique'=>$request->input('name').' name already taken !',
				'email.max'=>'The email may not be greater than 25 characters',
				'email.unique'=>$request->input('email').' name already taken !',
				'password.min' => 'The password must be at least 8 characters',
				'password.max' => 'The password may not be greater than 20 characters',
			
			]); 

			if($validateRule->fails()){
				return redirect()->back()->withErrors($validateRule->errors());
				}else{
				$users = new User;
				$users->name = $request->input('name');
				$users->email = $request->input('email');
				$users->password = bcrypt($request->input('password'));
				$users->admin = $request->input('status');
				$users->save();
				
				//send off line email on user register
				
				/* $email = $data['email'];
				$messageData = ['email'=>$data['email'],'name'=>$data['name']];
				Mail::send('mail.register',$messageData,function($message) use($email){
					$message->to($email)->subject('Registraction with Muzaffer E-com Website');
				}); */
				
				// send register email link confirm for active email
				
				$email = $data['email'];
				$messageData = ['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
				Mail::send('mail.confirmation',$messageData,function($message) use($email){
					$message->to($email)->subject('Confirmation account with Muzaffer E-com Website');
				});
				
				if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password'),'status'=>'0'])){
				Session::put('session_email',$request->input('email'));
				
				//check if user register then already selected products by users in cart table update email fiels
				if(Auth::check()){
					$Usersession_id = Session::get('session_id');
					$userCart = DB::table('cart')->where(['session_id'=>$Usersession_id])->get();
					if(count($userCart)>0){
						foreach($userCart as $useritem){
						DB::table('cart')->where(['id'=>$useritem->id])->update(['user_email' =>$request->input('email')]);
						}
						return redirect('/cart_items');
					}else{
						return redirect('/cart_items');
						//echo"Empty";
					}
				
				}else{
					echo"Not Login";
				}
				
				return redirect('/account');
				}
			} 
			
	}
	// checking email exist by jquery remote method check in developer_front.js file
	public function checkEmail(Request $request){
		$data = $request->all();
			$count = User::where('email',$data['email'])->count();
			if($count >0){
				echo"false";
			}else{
				echo"true";
				die;
			}
	}
	//user login
	public function userLogin(Request $request){
		if($request->isMethod('post')){
			$usersLogin = $request->all();
			if(Auth::attempt(['email'=>$usersLogin['userEmail'],'password'=>$usersLogin['userPassword']])){
				//check user ststus email varification
				$userStatus = User::where('email',$usersLogin['userEmail'])->first();
				if($userStatus->status ==0){
					Session::forget('session_id');
					Session::flush();
					return redirect()->back()->with('flush_message_error_login','Your account is dactive please contact to admin or / Confirm mail link !');
				}
					Session::put('frontSession',$usersLogin['userEmail']);
					Session::put('session_email',$usersLogin['userEmail']);
					//check if auth login then already selected products by users in cart table update email fiels
					if(!empty(Session::get('session_id'))){
						$Usersession_id = Session::get('session_id');
						$userCart = DB::table('cart')->where(['session_id'=>$Usersession_id])->get();
						if(count($userCart)>0){
							foreach($userCart as $useritem){
							DB::table('cart')->where(['id'=>$useritem->id])->update(['user_email' =>$usersLogin['userEmail']]);
							}
							//return redirect('/cart_items');
						}
						//return redirect('/cart_items');
					}
					return redirect('/cart_items');
			}else{
				return redirect()->back()->with('flush_message_error_login','Your Email or Password is Wrong !');
			}
			
			
		}
	}
	
	//forget password
	public function forgetPassword(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			//echo"<pre>";
			//print_r($data);
			$userEmail = User::where('email',$data['userEmail'])->count();
			//email check count
			if($userEmail == 0){
				return redirect()->back()->with('flush_message_error_password','Your Enter email does not exist');
			}else{
				//get user details
				$userDetail = User::where('email',$data['userEmail'])->first();
				//generate random password
				//echo $random_password = str_random(8);
				$random_password = Str::random(8);
				//random password dcrypt
				$new_password = bcrypt($random_password);
				//update new password in table
				 User::where('email',$data['userEmail'])->update(['password'=>$new_password]);
				//send forget password in mail
				$email = $data['userEmail'];
				$name = $userDetail->name;
				$messageData = [
				'email'=>$email,
				'name'=>$name,
				'password'=>$random_password,
				];
				Mail::send('mail.forgetPsaaword',$messageData,function($message)use($email){
					$message->to($email)->subject('New Password Muzaffer E-com Website');
				});
				return redirect('login-register')->with('flush_message_success','Your password successfully updated check your mail');
			}
		}
		return view('users.forget-password');
	}
	
	
	// user logout 
	public function userLogout(){
		Auth::logout();
		//Session::forget('frontlogin');
		Session::forget('session_id');
		Session::flush();
		return redirect('/');
	}
	
	// users Account page
	public function usersAccount(Request $request){
		//get all country fron contry table
		$country = Country::get();
		//get login user Id
		$user_id = Auth::user()->id;
		//get all details of users
		$userDetail = User::find($user_id);
		if($request->isMethod('post')){
			$userUpdate = $request->all();
			//update user table
			//echo"<pre>"; print_r($userUpdate); die;
			
			 $UservalidateRule = Validator::make($request->all(), [
				'name' => 'required',
				'address' => 'required',
				'city' => 'required',
				'state' => 'required',
				'country' => 'required',
				'pincode' => 'required',
				'mobile' => 'required'
			],[
				'name.required' => 'Please Enter name',
				'address.required' => 'Please Enter address',
				'city.required' => 'Please Enter city',
				'state.required' => 'Please Enter state',
				'country.required' => 'Please Enter country',
				'pincode.required' => 'Please Enter pincode',
				'mobile.required' => 'Please Enter mobile'
			]); 
			
			if($UservalidateRule->fails()){
				return redirect()->back()->withErrors($UservalidateRule->errors());
				}else{
					DB::table('users')->where('id', $userDetail['id'])->update([
					'name'=> $userUpdate['name'],
					'address'=> $userUpdate['address'],
					'city'=> $userUpdate['city'],
					'state'=> $userUpdate['state'],
					'country'=> $userUpdate['country'],
					'pincode'=> $userUpdate['pincode'],
					'mobile'=> $userUpdate['mobile']
					
					]);
					return redirect()->back()->with('flush_message_success','Your account has been successfully update');
					}
		}
		
		return view('users.account')->with(['country'=>$country,'userDetail'=>$userDetail,'page_type'=>'front']);
		
	}
	
	public function usersPasswordUp(Request $request){
		$UPserPass = $request->all();
		$currentpass = $UPserPass['oldpass'];
		$newpassword = bcrypt($UPserPass['newpass']);
		$user_id = Auth::user()->id;
		//get all details of users
		$checkPass = User::where('id',$user_id)->first();
		//echo "<pre>"; print_r($checkPass);
		
		if(Hash::check($currentpass,$checkPass->password)){
			//echo "found password";;
			//echo $newpassword;
			DB::table('users')->where('id', $user_id)->update([
				'password'=> $newpassword
				]);
			return response()->json(['success'=>0,'message'=>'Your Password Changed successfully'],200); 
			//return redirect()->back()->with('flush_message_success','Your Password Changed successfully');
			//return redirect('/user-logout');

			
		}else{
			//echo"Not found";
			return response()->json(['success'=>0,'message'=>'Your Password Not Match'],200); 
		}
		
		
	}
	
	// checking current password currect exist by jquery remote method check in developer_front.js file
	public function checkPassword(Request $request){
		$UPserPass = $request->all();
		$currentpass = $UPserPass['oldpass'];
		$user_id = Auth::user()->id;
		//get all details of users
		$checkPass = User::where('id',$user_id)->first();
		//echo "<pre>"; print_r($checkPass);
		
		if(Hash::check($currentpass,$checkPass->password)){
			echo"true";
		}else{
			echo"false";
			die;
		}
	}
	
	// Email link confirm activtion
	public function confirmEmail($email){
		$email = base64_decode($email);
		$userCount = User::where('email',$email)->count();
		//$userCount = json_decode(json_encode($userCount));
		if($userCount >0){
			$userCount = User::where('email',$email)->first();
			if($userCount->status ==1){
				return redirect('login-register')->with('flush_message_success','Your account already actived Please login !');
			}else{
				DB::table('users')->where('email',$email)->update(['status'=>1]);

				//welcome mail after acount acvited
				
				$messageData = ['email'=>$email,'name'=>$userCount->name];
				Mail::send('mail.welcome',$messageData,function($message) use($email){
					$message->to($email)->subject('Welcome in Muzaffer E-com Website');
				});
				return redirect('login-register')->with('flush_message_success','Your account successfully actived now you can login !');
			}
			
		}else{
			return abort(404);
		}
		//echo"<pre>";
		//print_r($userCount);
		//die;
		
	}
	
	//all frontend users show in admin panale backend
	public function userView(){
		$Users = User::get();
		$Users = json_decode(json_encode($Users));
		return view('admin.users.user_view')->with(compact('Users'));
	}
	
	public function userExport(){
		return Excel::download(new usersExport, 'user.xlsx');
		return redirect()->back()->with('flush_message_success','Success fully downloaded users excel file !');
		
	}
	// users view with chart
	public function userViewChart(){
		$currentMonth = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
		$lastMonth = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
		$lasttolastMonth = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
		return view('admin.users.user_view_chart')->with(compact('currentMonth','lastMonth','lasttolastMonth'));
	}
	
	// users register view country chart
	public function userViewChartCountry(){
		$userCount = User::select('country', DB::raw('count(country) as count'))->groupBy('country')->get();
		$user = json_decode(json_encode($userCount));
		return view('admin.users.user_view_countrychart')->with(compact('user'));
	}
}
