
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Admin &nbsp;&nbsp;</h4>
			
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
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{url('/admin/admin-view')}}">Admin</a></li>
						<li class="breadcrumb-item active" aria-current="page">Admin View</li>
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
				<h5 class="card-title">Admin/sub-admin View</h5>
				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>User Id</th>
								<th>Name</th>
								<th>Type</th>
								<th>Role</th>
								<th>Status</th>
								<th>Registar on</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($admin as $user)
							<?php 
							if($user->type =="Admin"){
								$role = "All";
							}else{
								$role ="";
								if($user->products_access ==1){
									$role.= "Products ,";
								}
								if($user->categories_access ==1){
									$role.= "Categories ,";
								}
								if($user->orders_access ==1){
									$role.= "Orders ,";
								}
								if($user->users_access ==1){
									$role.= "Users ,";
								}
							}
							
							
							?>
							
							<tr>
								<td>{{$user->id}}</td>
								<td>{{$user->username}}</td>
								<td>{{$user->type}}</td>
								<td>{{$role}}</td>
								<td>
								@if($user->status ==1)
								<span style="color:#2962FF">Active</span>	
								@else
								<span style="color:red">Inactive</span>	
								@endif
								</td>
								<td><?php $date =  new DateTime($user->created_at);
								echo $date->format('d/m/y');?></td>
								<td>
								<button type="submit" class="btn btn-info"><a href="{{ url('/admin/admin-edit/'.$user->id)}}">Edit</a></button>
								<button type="submit" class="btn btn-danger"><a href="{{ url('/admin/admin-delete/'.$user->id)}}">Delete</a></button>
					
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
