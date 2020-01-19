@extends('layouts.frontendLayout.front_design')
@section('content')

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">ORDERS VIEW</li>
			</ol>
		</div><!--/breadcrums-->
		
		<div class="review-payment_orderView" style="color:red">
			<h4>YOUR ORDERED PRODUCTS</h4>
		</div>
			<div class="card">
				<table class="table">
					<thead>
						<tr>
						   <th scope="col">Porduct code</th>
						   <th scope="col">product name</th>
						   <th scope="col">product size</th>
						   <th scope="col">product color</th>
						   <th scope="col">product price</th>
						   <th scope="col">product quantity</th>
						</tr>
					</thead>
					<tbody>
						@foreach($UsersOrders->orders as $order)
						<tr>
						   <th scope="row">{{$order->product_code}}</th>
						   <td>{{$order->product_name}}</td>						   
						   <td>{{$order->product_size}}</td>						   
						   <td>{{$order->product_color}}</td>						   
						   <td>{{$order->product_price}}</td>						   
						   <td>{{$order->product_quantity}}</td>						   
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