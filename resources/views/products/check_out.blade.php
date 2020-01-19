@extends('layouts.frontendLayout.front_design')
@section('content')
<section id="cart_items">
	<div class="container">
	<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			@if(Session::has('flush_message_error'))
				<div class="alert alert-danger" id="pinMessage">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>{{Session::get('flush_message_error')}}</strong>
				</div>
			@endif
			
		<div class="row checkOut_row shopper-informations">
			<div class="shoper_center">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
					
					<p class="billing-title">Bill To</p>
					<form method="post" action="{{url('/check_out_blling')}}">
					{{csrf_field()}}
						<input type="hidden" name="billing_userid" id="billing_id" value="{{$currentuserDetail->id}}">
						<input type="hidden" name="billing_useremail" id="billing_email" value="{{$currentuserDetail->email}}">
						
						<input type="text" placeholder="Billing Name" name="billing_name" id="billing_name" value="{{$currentuserDetail->name}}" required>
						<input type="text" placeholder="Billing Address" name="billing_address" id="billing_address" value="{{$currentuserDetail->address}}" required>
						<input type="text" placeholder="Billing City" name="billing_city" id="billing_city" value="{{$currentuserDetail->city}}" required>
						<input type="text" placeholder="Billing State" name="billing_state" id="billing_state" value="{{$currentuserDetail->state}}" required>
						<select name="billing_country" id="billing_country" required>
							<option value="">Select country</option>
							@foreach($country as $countries)
							<option value="{{$countries->country_name}}">{{$countries->country_name}}</option>
							@endforeach()				
						</select><br><br>
						<input type="text" placeholder="Billing Pin cord" name="billing_pincode" id="billing_pincode" value="{{$currentuserDetail->pincode}}" required minlength=6>
						<input type="text" placeholder="Billing Mobile" name="billing_mobile" id="billing_mobile" value="{{$currentuserDetail->mobile}}" required>
						<ul class="nav">
							<li>
								<label><input type="checkbox" class="shipping-checkoutbox"><p class="shipping-checkout">Shipping Address as Billing address</p></label>
							</li>
						</ul>		
					</div>
				</div>
				
				<div class="col-sm-4">
					<div class="signup-form">
					<p class="billing-title">Shipping To</p>
						<input type="hidden" name="shipping_id" id="shipping_id" value="{{$currentuserDetail->id}}">
						<input type="hidden" name="shipping_email" id="shipping_email" value="{{$currentuserDetail->email}}">
						
						<input type="text" placeholder="Shipping Name" name="shipping_name" id="shipping_name">
						<input type="text" placeholder="Shipping Address" name="shipping_address" id="shipping_address">
						<input type="text" placeholder="Shipping City" name="shipping_city" id="shipping_city">
						<input type="text" placeholder="Shipping State" name="shipping_state" id="shipping_state">
						
						<select name="shipping_country">
							<option value="" id="shipping_country">Select Country</option>			
						</select><br><br>
						
						<input type="text" placeholder="Shipping Pin cord" name="shipping_pincode" id="shipping_pincode">
						<input type="text" placeholder="Shipping Mobile" name="shipping_mobile" id="shipping_mobile">
						<input type="submit" class="btn btn-primary check_out" value="Checkout">
					
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> <!--/#cart_items-->
@endsection()