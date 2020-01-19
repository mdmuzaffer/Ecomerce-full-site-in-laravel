
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Admin &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{url('/admin/admin-add')}}">Admin/sub-admin</a></li>
						<li class="breadcrumb-item active" aria-current="page">Admin Add</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- ============================================================== -->
<div class="container-fluid">

	@if(Session::has('flush_message_success'))
	<div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong>{{Session::get('flush_message_success')}}</strong>
	</div>
	@endif
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="col-md-6">
						<form class="form-horizontal" method="post" action="{{url('admin/add-admin')}}">
						{{ csrf_field() }}
							<div class="card-body">
								<h4 class="card-title">Add Admin /sub Admin</h4>						
								<div class="form-group row">						
									<label for="fname" class="col-sm-3 text-right control-label col-form-label">Admin Type</label>
									<div class="col-sm-9">
										<select class="select2 form-control" name="type" id="type">
											<option value="Admin" data-select2-id="93">Admin</option>
											<option value="Sub Admin" data-select2-id="94">Sub Admin</option>
										</select>
									</div>
								</div>

								<div class="form-group row">
									<label for="fname" class="col-sm-3 text-right control-label col-form-label">Username</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="username" name="username" placeholder="Username">
										
										<div style="color:red">
										{!! $errors->first('username', '<p class="help-block">:message</p>') !!}
										</div>
									</div>
									 
								</div>
								<div class="form-group row">
									<label for="lname" class="col-sm-3 text-right control-label col-form-label">Password</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" id="password" name="password" placeholder="Password">
										<div style="color:red">
										{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
										</div>
									</div>
								</div>
								<div class="form-group row" id="access">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Access</label>
                                    <div class="col-md-9">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing1" name="products_access" value="1">
                                            <label class="custom-control-label" for="customControlAutosizing1">Products</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing2" name="categories_access" value="1">
                                            <label class="custom-control-label" for="customControlAutosizing2">Categories</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing3" name="orders_access" value="1">
                                            <label class="custom-control-label" for="customControlAutosizing3">Orders</label>
                                        </div>
										<div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing4" name="users_access" value="1">
                                            <label class="custom-control-label" for="customControlAutosizing4">Users</label>
                                        </div>
                                    </div>
                                </div>
								
								<div class="form-group row">
									<label for="lname" class="col-sm-3 text-right control-label col-form-label">Status</label>
									<div class="col-sm-9">
										<div class="custom-control custom-checkbox mr-sm-2">
											<input type="checkbox" class="custom-control-input" id="customControlAutosizing5" name="status" value="1">
											<label class="custom-control-label" for="customControlAutosizing5">Enable</label>
										</div>
									</div>
								</div>
					  
							</div>
							<div class="border-top">
								<div class="card-body">
									<input type="submit" class="btn btn-primary" name="btn" value="Submit"/>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
