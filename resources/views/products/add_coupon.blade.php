
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Coupan &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Coupan</a></li>
						<li class="breadcrumb-item active" aria-current="page">Coupan Products</li>
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
				<form  id="add-coupon" class="form-horizontal" method="post" action="{{url('/admin/save-coupons')}}">
					{{csrf_field()}}
					<div class="card-body">
						<h4 class="card-title">Product Info<span class="validation_error text-danger"></span></h4>
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
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Coupon Code</label>
							<div class="col-sm-9">
								<input type="text" required="true" maxlength="10" minlength="5" class="form-control" name="coupon_code" id="coupon_code" placeholder="Coupon Code">
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Amount</label>
							<div class="col-sm-9">
								<input type="number" required="true" class="form-control" name="amount" id="amount" placeholder="Amount">
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Amount Type</label>
							
						<div class="col-md-9">
							<select class="select2 form-control custom-select" name="amount_type" id="amount_type" style="width: 100%; height:36px;">
								<option>Select</option>
								<optgroup label="In Persentage">
									<option value="persent">15%</option>
								</optgroup>
								<optgroup label="Fixed">
									<option value="fixed">Fixed offer</option>
								</optgroup>
							</select>
						</div>
							
							
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Expiry Date</label>
							<div class="col-sm-9">
								<div class="input-group">
									<input type="text" class="form-control" name="expiry" id="datepicker-autoclose" placeholder="mm/dd/yyyy">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Status</label>
							<div class="col-sm-9">
								<div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" name="status" class="custom-control-input" id="customControlAutosizing3" value="1">Active
                                    <label class="custom-control-label" for="customControlAutosizing3"></label>
                                </div>
							</div>
							
						</div>
					</div>
					<div class="border-top">
						<div class="card-body">
							<button type="submit" class="btn btn-primary">Add Coupan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection