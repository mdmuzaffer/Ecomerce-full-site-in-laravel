
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Products &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{url('/admin/add-products')}}">Products</a></li>
						<li class="breadcrumb-item active" aria-current="page">View Products</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- ============================================================== -->
<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->

	<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Product View</h5>
				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Order Id</th>
								<th>Order date</th>
								<th>Customer Name</th>
								<th>Customer Email</th>
								<th>Order Products</th>
								<th>Order Amount</th>
								<th>Order Status</th>
								<th>Payment Method</th>
								<th>Actons</th>
							</tr>
						</thead>
						<tbody>
						
							<?php 
							/* echo"<pre>";
							print_r($UsersOrder);
							die(); */
							?>
							@foreach($UsersOrder as $order)
							<tr>
								<td>{{$order->id}}</td>
								<td><?php $date =  new DateTime($order->created_at);
								echo $date->format('d/m/y');?></td>
								<td>{{$order->name}}</td>
								<td>{{$order->user_email}}</td>
								<td style="font-size:11px;">
								@foreach($order->orders as $pro)
								{{$pro->product_code}}<br>
								@endforeach
								</td>
								<td>{{$order->grand_total}}</td>
								<td>{{$order->order_status}}</td>
								<td>{{$order->payment_method}}</td>
								<td><a class="btn btn-primary" href="{{url('admin/order-details/'.$order->id)}}" target="_blank">View</a> || 
									<a class="btn btn-success" href="{{url('admin/order-invoice/'.$order->id)}}" target="_blank">Invoice</a> || 
									@if($order->order_status =='Shipping' || $order->order_status =='Completed' || $order->order_status =='Processing')
									<a class="btn btn-warning" href="{{url('admin/order-pdf-invoice/'.$order->id)}}" target="_blank">PDF</a>
									@endif
								</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>
    </div>
</div>

@endsection
