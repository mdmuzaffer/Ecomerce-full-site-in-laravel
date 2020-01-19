
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Currency &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{url('/admin/add-products')}}">Currency</a></li>
						<li class="breadcrumb-item active" aria-current="page">Currency view</li>
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
				<h5 class="card-title">Currency View</h5>
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
								<th>Name</th>
								<th>Email</th>
								<th>Address</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($CorrencyView as $corrency)
							<tr>
								<td>{{$corrency->id}}</td>
								<td>{{$corrency->currency_code}}</td>
								<td>{{$corrency->exchange_rate}}</td>
								<td>{{$corrency->status}}</td>
								<td>
								<div class="comment-footer">
									<button type="button" class="btn btn-cyan btn-sm" title="Update"><a href="{{url('/admin/upadte-currency/'.$corrency->id)}}">Edit</a></button>
									<button type="button" class="btn btn-danger btn-sm cmsPage"><a href="{{url('/admin/delete-currency/'.$corrency->id)}}">Delete</a></button>
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
