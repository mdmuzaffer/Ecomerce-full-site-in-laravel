@extends('layouts.frontendLayout.front_design')
@section('content')


<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Shopping Cart</li>
			</ol>
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
			
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Order Details</h5>
				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Product</th>
								<th>Code</th>
								<th>Size</th>
								<th>Color</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
						@foreach($userOrders as $order)
							<tr>
								<td>{{$order->product_name}}</td>
								<td>{{$order->product_code}}</td>
								<td>{{$order->product_size}}</td>
								<td>{{$order->product_color}}</td>
								<td>{{$order->product_price}}</td>
								<td>{{$order->product_quantity}}</td>
								<td>{{$order->created_at}}</td>
							</tr>
						@endforeach
						<tr>
							
							<td colspan="7">
							<div class="orderPagination" style="margin-left: 404px; margin-top: 10px;">{{ $userOrders->links() }}</div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>
		</div>
	</div>
</section><!--/#do_action-->


@endsection()