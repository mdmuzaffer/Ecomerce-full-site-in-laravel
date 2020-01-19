@extends('layouts.frontendLayout.front_design')
@section('content')
<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					@if(empty(Auth::check()))
					<h2>Login to your account</h2>
					@else
					<h2>Hello <span style="color:red">{{Auth::user()->name}}</span> login your account again</h2>
					@endif
					@if(Session::has('flush_message_error_login'))
					<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>{{Session::get('flush_message_error_login')}}</strong>
					</div>
					@endif
					<form action="{{url('/user-login')}}" method="post" id="userLogin">
						{{csrf_field()}}
						<input type="email" placeholder="Email Address" name="userEmail" autocomplete="email"/>
						<input type="password" placeholder="Password" name="userPassword" class="userShow"/>
						<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
						<input type="submit" class="btn btn-primary user-md" value="Login" name="user_login" />
						<span><a href="{{url('/forget-password')}}">Forget password ?</a></span>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">OR</h2>
			</div>
			<div class="col-sm-4">
			
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
				
				<div class="signup-form"><!--sign up form-->
					<h2>New User Signup!</h2>
					<form id="signup" action="{{url('/users-register')}}" method="post">
						{{csrf_field()}}
						<input type="text" name="name" placeholder="Name" required/>
						<span class="text-danger">{{ $errors->first('name') }}</span>
						
						<input type="email" name="email" placeholder="Email Address" required/>
						<span class="text-danger">{{ $errors->first('email') }}</span>
						
						<input type="password" name="password" placeholder="Password" required/>
						<input type="hidden" name="status" value="0"/>
						<span class="text-danger">{{ $errors->first('password') }}</span>
						
						<input type="submit" class="btn btn-primary user-md" name="signup" value="Sign up"/>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->
@endsection()