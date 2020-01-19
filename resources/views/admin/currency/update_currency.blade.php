
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Currency Page &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Currency</a></li>
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
				<form  id="add-cms-page" class="form-horizontal" method="post" action="{{url('/admin/currency-currency')}}">
					{{csrf_field()}}
					<div class="card-body">
						<h4 class="card-title">Currency Update<span class="validation_error text-danger"></span></h4>
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
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Currency Code</label>
							<div class="col-sm-9">
								<input type="hidden" class="form-control" value="{{$currData->id}}" name="currency_id" id="currency_id" required>
							</div>
						</div>
						
						
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Currency Code</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" value="{{$currData->currency_code}}" name="currency_code" id="currency_code" placeholder="currency code" required>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Exchange rate</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" value="{{$currData->exchange_rate}}" name="exchange_rate" id="exchange_rate" placeholder="exchange rate" required>
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
							<button type="submit" class="btn btn-primary">Add Currency</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection