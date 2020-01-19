
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Shipping Page &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Shipping</a></li>
						<li class="breadcrumb-item active" aria-current="page">Update</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

    <!-- ============================================================== -->
<div class="container-fluid">
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
	<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<form  id="Shipping_page" class="form-horizontal" method="post" action="{{url('/admin/shipping-update/'.$shippingCharge->id)}}">
					{{csrf_field()}}
					<div class="card-body">
						<h4 class="card-title">Shipping Update<span class="validation_error text-danger"></span></h4>
						@if(Session::has('flush_message_error'))
						<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>{{Session::get('flush_message_error')}}</strong>
						</div>
						@endif
						@if(Session::has('flush_message_success'))
						<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>{{Session::get('flush_message_success')}}</strong>
						</div>
						@endif
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Shipping Code</label>
							<div class="col-sm-9">
								<input type="hidden" class="form-control" value="{{$shippingCharge->id}}" name="shipping_Id" id="shipping_Id">
								<input type="text" readonly="" class="form-control" value="{{$shippingCharge->shipping_code}}" name="shipping_code" id="shipping-code" placeholder="Shipping Code" required>
							</div>
						</div>
						
						
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Shipping Country</label>
							<div class="col-sm-9">
								<input type="text" readonly="" class="form-control" value="{{$shippingCharge->shipping_country}}" name="shipping_country" id="shipping_country" placeholder="Shipping Country" required>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Shipping Charge</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" value="{{$shippingCharge->shipping_charge}}" name="shipping_charge" id="shipping_charge" placeholder="Shipping Charge" required>
							</div>
						</div>
						
						
						
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Shipping 0 to 500</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" value="{{$shippingCharge->shipping_charge0_500}}" name="shipping_charge0_500" id="shipping_charge" placeholder="Shipping Charge 0 to 500g" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Shipping 501 to 1000</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" value="{{$shippingCharge->shipping_charge501_1000}}" name="shipping_charge501_1000" id="shipping_charge" placeholder="Shipping Charge 501 to 1000g" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Shipping 1001 to 2000</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" value="{{$shippingCharge->shipping_charge1001_2000}}" name="shipping_charge1001_2000" id="shipping_charge" placeholder="Shipping Charge 1001 to 2000g" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Shipping 2001 to 5000</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" value="{{$shippingCharge->shipping_charge2001_5000}}" name="shipping_charge2001_5000" id="shipping_charge" placeholder="Shipping Charge 2001 to 5000g" required>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Enable</label>
							<div class="col-sm-9">
								<div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" name="enable" value="1" class="custom-control-input" id="pageenable">
                                    <label class="custom-control-label" for="pageenable"></label>
                                </div>
							</div>
						</div>
						
					</div>
					<div class="border-top">
						<div class="card-body">
							<button type="submit" class="btn btn-primary">Add Shipping Charge</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection