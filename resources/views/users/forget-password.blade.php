@extends('layouts.frontendLayout.front_design')
@section('content')
<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>forget your password ?</h2>
					@if(Session::has('flush_message_error_password'))
					<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>{{Session::get('flush_message_error_password')}}</strong>
					</div>
					@endif
					
					@if(Session::has('flush_message_success_forgetpassword'))
					<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>{{Session::get('flush_message_success_forgetpassword')}}</strong>
					</div>
					@endif
					<form action="{{url('/forget-password')}}" method="post" id="forgetPassword">
						{{csrf_field()}}
						<input type="email" placeholder="Email Address" name="userEmail" autocomplete="email"/>
						<input type="submit" class="btn btn-primary user-md" value="Send" name="user_login" />
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
						
						<input type="email" name="email" placeholder="Email Address" required />
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