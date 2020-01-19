@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Setting</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">setting</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10">
			<div class="card">
			<div class="result"></div>
				<form class="form-horizontal" method="Post">{{csrf_field()}}
					<div class="card-body">
						<h4 class="card-title">Personal Admin Info</h4>
						
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">User Name</label>
							<div class="col-sm-9">
								<input type="text" id="username" class="form-control" value="{{$adminDetail->username}}" placeholder="User name" name="username">
							</div>
						</div>
						
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Current Password</label>
							<div class="col-sm-9">
								<input type="hidden" name="url" id="site_url" value="{{ url('/') }}">
								<input type="password" class="form-control" id="current_password" placeholder="Current Password" name="current_password">
							</div>
						</div>

						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">New Password</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" id="new_password" placeholder="New Password" name="new_password">
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Conform Password</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" id="conform_password" placeholder="Conform Password" name="conform_password">
							</div>
						</div>
					</div>
					<div class="border-top">
						<div class="card-body">
							<button type="button" class="btn btn-primary" id="password_update">Update Password</button>
						</div>
					</div>
				</form>
				
			</div>
		</div>
	</div>
</div>
@endsection()