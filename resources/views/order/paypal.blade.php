@extends('layouts.frontendLayout.front_design')
@section('content')
<?php use App\Order;?>
<?php use App\Country;?>
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">PayPal</li>
			</ol>
		</div><!--/breadcrums-->
		<?php 
		$orderDetails = Order::getOrderDetail(Session::get('order_id'));
		$orderDetails = json_decode(json_encode($orderDetails));
		$orderCountry = Order::getOrderCountry($orderDetails->country);
		//echo $orderCountry->country_code;
		//echo"<pre>";
		//print_r($orderCountry);
		//die;
		?>
		<div class="review-payment_thank">
			<h2 class="thank_1">YOUR COD ORDER HAS BEEN REPLACED</h2>
			<P class="thank_2">Your order no is <span class="thank_21">{{Session::get('order_id')}}</span> and total amount is INR 
			<span class="thank_21">{{Session::get('grand_total')}}</span></P>
			<p>Plese Make payment by clicking on below payment Method</p>
			<!-- Using payPal for pament-->
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

			  <!-- Saved buttons use the "secure click" command -->
				<input type="hidden" name="cmd" value="_xclick">
			  <!-- Saved buttons are identified by their button IDs -->
				<input type="hidden" name="business" value="developer1994@gmail.com">
				<input type="hidden" name="item_name" value="{{Session::get('order_id')}}">
				<input type="hidden" name="item_number" value="{{Session::get('order_id')}}">
				<input type="hidden" name="amount" value="{{Session::get('grand_total')}}">
				<input type="hidden" name="currency_code" value="INR">
			
				<input type="hidden" name="first_name" value="{{$orderDetails->name}}">
				<input type="hidden" name="last_name" value="{{$orderDetails->name}}">
				<input type="hidden" name="email" value="{{$orderDetails->user_email}}">
				<input type="hidden" name="address1" value="{{$orderDetails->address}}">
				<input type="hidden" name="address2" value="{{$orderDetails->address}}">
				<input type="hidden" name="city" value="{{$orderDetails->city}}">
				<input type="hidden" name="zip" value="{{$orderDetails->pincode}}">
				<input type="hidden" name="day_phone_a" value="{{$orderDetails->mobile}}">
				<input type="hidden" name="night_phone_a" value="{{$orderDetails->mobile}}">
				<input type="hidden" name="night_phone_a" value="{{$orderDetails->mobile}}">
				<input type="hidden" name="return" value="{{url('paypal/thanks')}}">
				<input type="hidden" name="cancel_return" value="{{url('paypal/cancle')}}">

			  <!-- Saved buttons display an appropriate button image. -->
				<input type="image" name="submit"
				src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif"
				alt="PayPal - The safer, easier way to pay online">
				<img alt="" width="1" height="1"
				src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

			</form>
		</div>

		</div>

	</div>
</section>

@endsection()
<?php
//Session::forget('grand_total');
//Session::forget('order_id');
?>