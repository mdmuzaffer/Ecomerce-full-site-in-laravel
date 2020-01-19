@extends('layouts.frontendLayout.front_design')
@section('content')
<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				@if(Session::has('flush_message_success'))
					<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>{{Session::get('flush_message_success')}}</strong>
					</div>
				@endif
				@if(Session::has('flush_message_error'))
					<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>{{Session::get('flush_message_error')}}</strong>
					</div>
				@endif
			
				<div class="login-form"><!--login form-->
					<h2>Update your account</h2>
					<form action="{{url('/account')}}" method="post">
						{{csrf_field()}}
						<input type="text" value="{{$userDetail->name}}" placeholder="Name" name="name"/>
						<span class="text-danger">{{ $errors->first('name') }}</span>
						<input type="text" value="{{$userDetail->address}}" placeholder="Address" name="address"/>
						<span class="text-danger">{{ $errors->first('address') }}</span>
						<input type="text" value="{{$userDetail->city}}" placeholder="City" name="city"/>
						<span class="text-danger">{{ $errors->first('city') }}</span>
						<input type="text" value="{{$userDetail->state}}" placeholder="State" name="state"/>
						<span class="text-danger">{{ $errors->first('state') }}</span>
						<select name="country">
							<option value="" required>Select country</option>
							@foreach($country as $countries)
							<option value="{{$countries->country_name}}">{{$countries->country_name}}</option>
							@endforeach()				
						</select>
						<span class="text-danger">{{ $errors->first('country') }}</span>
						<input style="margin-top:10px;" type="text" value="{{$userDetail->pincode}}" placeholder="Pin code" name="pincode"/>
						<span class="text-danger">{{ $errors->first('pincode') }}</span>
						<input type="text" value="{{$userDetail->mobile}}"  placeholder="Mobile" name="mobile"/>
						<span class="text-danger">{{ $errors->first('mobile') }}</span>
						<input type="submit" class="btn btn-primary user-md" value="Update"/>
					</form>
				</div>
			</div>
			<div class="col-sm-1">
				<h2 class="or">OR</h2>
			</div>
			<div class="col-sm-4">
				<div class="signup-form">
					<h2>User Password update!</h2>
					
					<div id="curr_passUpdate"></div>
					
					<form method="post" id="PasswordUpdate">
						{{csrf_field()}}
						<input type="password"  placeholder="Current Password" name="oldpass" id="oldpass"/>
						<input type="password"  placeholder="New Password" name="newpass" id="newpass"/>
						<input type="password"  placeholder=" Confirm Password" name="confpass" id="confpass"/>
						<button class="btn btn-primary user-md" id="userPasswordUpdate1">Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section><!--/form-->
@endsection()