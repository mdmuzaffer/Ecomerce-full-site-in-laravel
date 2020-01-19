@extends('layouts.frontendLayout.front_design')
@section('content')

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">PayPal thank</li>
			</ol>
		</div><!--/breadcrums-->
		
		<div class="review-payment_thank">
			<h2>YOUR paypal ORDER HAS BEEN PLACED</h2>
			<p>Thanks for the payment we will process your order very soon</p>
			<P class="thank_2">Your order no is <span class="thank_21">{{Session::get('order_id')}}</span> and total amount pable is INR <span class="thank_21">{{Session::get('grand_total')}}</span></P>
		</div>

		</div>

	</div>
</section>

@endsection()
<?php
Session::forget('grand_total');
Session::forget('order_id');
?>