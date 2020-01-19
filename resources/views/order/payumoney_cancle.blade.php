@extends('layouts.frontendLayout.front_design')
@section('content')

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Pay UMoney Cancle</li>
			</ol>
		</div><!--/breadcrums-->
		
		<div class="review-payment_thank">
			<h2>YOUR PAY UMONEY ORDER CANCLED</h2>
			<P style="color:red">Please contact us if there any query !</P>
		</div>

		</div>

	</div>
</section>

@endsection()
<?php
Session::forget('grand_total');
Session::forget('order_id');
?>