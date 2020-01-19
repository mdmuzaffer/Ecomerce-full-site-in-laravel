@extends('layouts.frontendLayout.front_design')
@section('content')

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">ORDERS</li>
			</ol>
		</div><!--/breadcrums-->
		
		<div class="review-payment_orderView" style="color:red">
			<h4>YOUR ORDERED ALL PRODUCTS</h4>
		</div>
		
		<?php 
		//echo"<pre>";
		//print_r($UsersOrder);
		?>
			<div class="card">
				<table class="table">
					<thead>
						<tr>
						   <th scope="col">Order ID</th>
						   <th scope="col">Ordered Products</th>
						   <th scope="col">Payment Method</th>
						   <th scope="col">Grand Total</th>
						   <th scope="col">Created on</th>
						   <th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
					@foreach($UsersOrder as $order)
						<tr>
						   <th scope="row">{{$order->id}}</th>
						   <td>
							@foreach($order->orders as $products)
							   {{$products->product_code}} <br>
							@endforeach
							</td>
						   <td>{{$order->payment_method}}</td>
						   <td>{{$order->grand_total}}</td>
						   <td>{{$order->created_at}}</td>
						   <td><a href="{{url('/order-view/'.$order->id)}}">View Details</a></td>
						</tr>
					@endforeach
						<tr>
					  </tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@endsection