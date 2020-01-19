@extends('layouts.frontendLayout.front_design')
@section('content')

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Thank</li>
			</ol>
		</div><!--/breadcrums-->
		
		<div class="review-payment_thank">
			<h2 class="thank_1">YOUR COD ORDER HAS BEEN REPLACED <span class="thank_11"> {{Auth::user()->name}}</span></h2>
			<P class="thank_2">Your order no is <span class="thank_21">{{Session::get('order_id')}}</span> and total amount is INR <span class="thank_21">{{Session::get('grand_total')}}</span></P>
		</div>

		</div>

	</div>
</section>

@endsection()
<?php
Session::forget('grand_total');
Session::forget('order_id');
?>