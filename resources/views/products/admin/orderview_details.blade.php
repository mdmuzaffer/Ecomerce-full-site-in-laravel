
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
						<li class="breadcrumb-item"><a href="{{url('/admin/add-products')}}">Order</a></li>
						<li class="breadcrumb-item active" aria-current="page">View Order</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>


@if(Session::has('flush_message_success'))
	<div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong>{{Session::get('flush_message_success')}}</strong>
	</div>
@endif

<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-md-6">
		
			<div class="card">
				<div class="card-body">
					<h5 class="card-title m-b-0">Order Details</h5>
				</div>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th scope="col">Order date</th>
							<th scope="col">Total Amount</th>
							<th scope="col">Payment Method</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{$UsersOrderview->created_at}}</td>
							<td class="text-success">{{$UsersOrderview->grand_total}}</td>
							<td class="text-success">{{$UsersOrderview->payment_method}}</td>
						</tr>
					</tbody>
				</table>
			</div>
			
		<!-- accoridan part -->
			<div class="accordion" id="accordionExample">
				<div class="card m-b-0">
					<div class="card-header" id="headingOne">
					  <h5 class="mb-0">
						<a  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							
							<span>Billing Address</span>
						</a>
					  </h5>
					</div>
					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					  <div class="card-body">
					    <lable>Name: </lable>{{$UserDetail->name}}<br>
					    <lable>Email: </lable>{{$UserDetail->email}}<br>
					    <lable>Address: </lable>{{$UserDetail->address}}<br>
					    <lable>City: </lable>{{$UserDetail->city}}<br>
					    <lable>State: </lable>{{$UserDetail->state}}<br>
					    <lable>Country: </lable>{{$UserDetail->country}}<br>
					    <lable>Pincode: </lable>{{$UserDetail->pincode}}<br>
					    <lable>Mobile: </lable>{{$UserDetail->mobile}}
					  </div>
					</div>
				</div>
			</div>
			<!-- toggle part -->
		</div>
		
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title m-b-0">Customer Details</h5>
				</div>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th scope="col">Customer Name</th>
							<th scope="col">Customer Email</th>
							<th scope="col">Order status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{$UsersOrderview->name}}</td>
							<td class="text-success">{{$UsersOrderview->user_email}}</td>
							<td class="text-danger">{{$UsersOrderview->order_status}}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- Order status update-->
			
			<div class="accordion">
				<div class="card m-b-0">
					<div class="card-header" id="headingOne">
					  <h5 class="mb-0">
						<a  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<span>Order Status</span>
						</a>
					  </h5>
					</div>
					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						<div class="form-group row" data-select2-id="12">
							<label class="col-md-3 m-t-15">Select Status</label>
							<div class="col-md-9" data-select2-id="11">
							<form method="post" action="{{url('/admin/order-update')}}">
								{{csrf_field()}}
								<input type="hidden" name="id" value="{{$UsersOrderview->id}}" />
								<select name="option" class="select2 form-control custom-select select2-hidden-accessible" style="width: 70%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">
									<option data-select2-id="3">Select</option>
									<option value="New">New</option>
									<option value="On hold">On hold</option>
									<option value="Pending">Pending</option>
									<option value="Processing">Processing</option>
									<option value="Shipping">Shipping</option>
									<option value="Completed">Completed</option>
									<option value="Cancle">Cancle</option>
								</select>
                                <button type="submit" class="btn btn-primary">Submit</button>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			
			<!-- Order status update-->
			
			<!-- accoridan part -->
			<div class="accordion" id="accordionExample">
				<div class="card m-b-0">
					<div class="card-header" id="headingOne">
					  <h5 class="mb-0">
						<a  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							
							<span>Shipping Address</span>
						</a>
					  </h5>
					</div>
					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						<div class="card-body">
						<lable>Name: </lable>{{$UsersOrderview->name}}<br>
					    <lable>Email: </lable>{{$UsersOrderview->user_email}}<br>
					    <lable>Address: </lable>{{$UsersOrderview->address}}<br>
					    <lable>City: </lable>{{$UsersOrderview->city}}<br>
					    <lable>State: </lable>{{$UsersOrderview->state}}<br>
					    <lable>Country: </lable>{{$UsersOrderview->country}}<br>
					    <lable>Pincode: </lable>{{$UsersOrderview->pincode}}<br>
					    <lable>Mobile: </lable>{{$UsersOrderview->mobile}}
						</div>
					</div>
				</div>
			</div>
			<!-- toggle part -->
		</div>
	</div>	
	</div>	
</div>



<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
		<div class="review-payment_orderView" style="color:red; margin-top:10px;">
		<h4>Ordered Products of {{$UserDetail->name}}</h4>
		</div>
			<div class="card">
				<table class="table">
					<thead>
						<tr>
						   <th scope="col">Code</th>
						   <th scope="col">Products name</th>
						   <th scope="col">Size</th>
						   <th scope="col">Color</th>
						   <th scope="col">Price</th>
						   <th scope="col">Quantity</th>
						   <th scope="col">Total</th>
						   <th scope="col">Discount</th>
						   <th scope="col">Shipping charge</th>
						   <th scope="col">Coupan</th>
						</tr>
					</thead>
					<tbody>
						@foreach($UsersOrderview->orders as $order)
						<tr>
						   <th scope="row">{{$order->product_code}}</th>
						   <td>{{$order->product_name}}</td>						   
						   <td>{{$order->product_size}}</td>						   
						   <td>{{$order->product_color}}</td>						   
						   <td>{{$order->product_price}}</td>						   
						   <td>{{$order->product_quantity}}</td>						   
						   <td>{{$UsersOrderview->grand_total}}</td>						   
						   <td>{{$UsersOrderview->coupon_amount}}</td>						   
						   <td>{{$UsersOrderview->shipping_charges}}</td>						   
						   <td>{{$UsersOrderview->coupon_code}}</td>						   
						</tr>
						@endforeach
						<tr>
					  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
