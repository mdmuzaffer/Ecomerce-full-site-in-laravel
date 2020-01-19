
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Users &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{url('/admin/add-products')}}">Users</a></li>
						<li class="breadcrumb-item active" aria-current="page">Users View</li>
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
		
	@if(Session::has('flush_message_success'))
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>{{Session::get('flush_message_success')}}</strong>
		</div>
	@endif
		
			<div class="card-body">
				<h5 class="card-title">Users View</h5>
				<h5 class="card-title" style="float:right;"><a href="{{url('/admin/user-export')}}"><button type="button" class="btn btn-cyan btn-sm">Export Users</button></a></h5>
				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>User Id</th>
								<th>Name</th>
								<th>Email</th>
								<th>Address</th>
								<th>City</th>
								<th>State</th>
								<th>Country</th>
								<th>Pincode</th>
								<th>Mobile</th>
								<th>Status</th>
								<th>Registar on</th>
							</tr>
						</thead>
						<tbody>
							@foreach($Users as $user)
							<tr>
								<td>{{$user->id}}</td>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->address}}</td>
								<td>{{$user->city}}</td>
								<td>{{$user->state}}</td>
								<td>{{$user->country}}</td>
								<td>{{$user->pincode}}</td>
								<td>{{$user->mobile}}</td>
								<td>
								@if($user->status ==1)
								<span style="color:#2962FF">Active</span>	
								@else
								<span style="color:red">Inactive</span>	
								@endif
								</td>
								<td><?php $date =  new DateTime($user->created_at);
								echo $date->format('d/m/y');?></td>
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
