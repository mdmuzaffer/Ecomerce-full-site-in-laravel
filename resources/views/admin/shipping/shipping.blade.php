
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Shipping &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{url('/admin/add-products')}}">Shipping</a></li>
						<li class="breadcrumb-item active" aria-current="page">Shipping view</li>
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
				<h5 class="card-title">Shipping View</h5>
				<div class="table-responsive">
				
				
					@if(Session::has('flush_message_success'))
						<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>{{Session::get('flush_message_success')}}</strong>
						</div>
					@endif
				
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Id</th>
								<th>Country code</th>
								<th>Country</th>
								<th>shipping charge</th>
								<th>0g to 500g</th>
								<th>501g to 1000g</th>
								<th>1001g to 2000g</th>
								<th>2001g to 5000g</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($shippingDetails as $shipping)
							<tr>
								<td>{{$shipping->id}}</td>
								<td>{{$shipping->shipping_code}}</td>
								<td>{{$shipping->shipping_country}}</td>
								<td>=></td>
								<td>{{$shipping->shipping_charge0_500}}</td>
								<td>{{$shipping->shipping_charge501_1000}}</td>
								<td>{{$shipping->shipping_charge1001_2000}}</td>
								<td>{{$shipping->shipping_charge2001_5000}}</td>
								<td>{{$shipping->created_at}}</td>
								<td>
								<div class="comment-footer">
									<button type="button" class="btn btn-cyan btn-sm" title="Update"><a href="{{url('/admin/shipping-update/'.$shipping->id)}}">Edit</a></button>
									<button type="button" class="btn btn-danger btn-sm cmsPage"><a href="{{url('/admin/shipping-delete/'.$shipping->id)}}">Delete</a></button>
                                </div>
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
