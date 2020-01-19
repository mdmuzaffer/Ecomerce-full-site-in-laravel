@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Dashboard</h4> &nbsp;&nbsp; &nbsp; &nbsp;
			
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
			
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Sales Cards  -->
	<!-- ============================================================== -->
	<div class="row">
		<!-- Column -->
		<div class="col-md-6 col-lg-2 col-xlg-3">
			<div class="card card-hover">
				<a href="{{url('/admin/dashboard')}}">
					<div class="box bg-cyan text-center">
						<h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
						<h6 class="text-white">Welcome {{Session::get('adminDetail')->type}}</h6>
					</div>
				</a>
			</div>
		</div>
		<!-- Column -->
		@if(Session::get('adminDetail')->categories_access ==1)
		<div class="col-md-6 col-lg-4 col-xlg-3">
			<div class="card card-hover">
				<a href="{{url('/admin/category')}}">
					<div class="box bg-success text-center">
						<h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
						<h6 class="text-white">Category</h6>
					</div>
				</a>
			</div>
		</div>
		@endif
		 <!-- Column -->
		@if(Session::get('adminDetail')->products_access ==1)
		<div class="col-md-6 col-lg-2 col-xlg-3">
			<a href="{{url('/admin/add-products')}}">
				<div class="card card-hover">
					<div class="box bg-warning text-center">
						<h1 class="font-light text-white"><i class="fa fa-product-hunt"></i></h1>
						<h6 class="text-white">products</h6>
					</div>
				</div>
			</a>
		</div>
		@endif
		<!-- Column -->
		@if(Session::get('adminDetail')->orders_access ==1)
		<div class="col-md-6 col-lg-2 col-xlg-3">
			<div class="card card-hover">
				<a href="{{url('/admin/order-view')}}">
					<div class="box bg-danger text-center">
						<h1 class="font-light text-white"><i class="fa fa-first-order"></i></h1>
						<h6 class="text-white">Order</h6>
					</div>
				</a>
			</div>
		</div>
		@endif
		<!-- Column -->
		@if(Session::get('adminDetail')->users_access ==1)
		<div class="col-md-6 col-lg-2 col-xlg-3">
			<div class="card card-hover">
				<a href="{{url('/admin/add-admin')}}">
					<div class="box bg-info text-center">
						<h1 class="font-light text-white"><i class="fa fa-user"></i></h1>
						<h6 class="text-white">Admin</h6>
					</div>
				</a>
			</div>
		</div>
		@endif
		<!-- Column -->
		<!-- Column -->
		@if(Session::get('adminDetail')->type =="Admin")
		<div class="col-md-6 col-lg-4 col-xlg-3">
			<div class="card card-hover">
				<a href="{{url('/admin/add_coupon')}}">
					<div class="box bg-danger text-center">
						<h1 class="font-light text-white"><i class="fa fa-bullhorn"></i></h1>
						<h6 class="text-white">Coupan</h6>
					</div>
				</a>
			</div>
		</div>
		<!-- Column -->
		<div class="col-md-6 col-lg-2 col-xlg-3">
			<div class="card card-hover">
				<a href="{{url('/admin/user-view')}}">
					<div class="box bg-info text-center">
						<h1 class="font-light text-white"><i class="fa fa-users"></i></h1>
						<h6 class="text-white">Users</h6>
					</div>
				</a>
			</div>
		</div>
		 <!-- Column -->
		<div class="col-md-6 col-lg-2 col-xlg-3">
			<div class="card card-hover">
				<a href="{{url('/admin/banner-add')}}">
					<div class="box bg-cyan text-center">
						<h1 class="font-light text-white"><i class="mdi mdi-pencil"></i></h1>
						<h6 class="text-white">Banner</h6>
					</div>
				</a>
			</div>
		</div>
		<!-- Column -->
		<div class="col-md-6 col-lg-2 col-xlg-3">
			<div class="card card-hover">
				<a href="{{url('/admin/cms-page')}}">
					<div class="box bg-success text-center">
						<h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
						<h6 class="text-white">CMS Page</h6>
					</div>
				</a>
			</div>
		</div>
		<!-- Column -->
		<div class="col-md-6 col-lg-2 col-xlg-3">
			<div class="card card-hover">
				<a href="{{url('/admin/add-currency')}}">
					<div class="box bg-warning text-center">
						<h1 class="font-light text-white"><i class="fa fa-money"></i></h1>
						<h6 class="text-white">Currency</h6>
					</div>
				</a>
			</div>
		</div>
		<!-- Column -->
		<!-- Column -->
		<div class="col-md-6 col-lg-2 col-xlg-3">
			<div class="card card-hover">
				<a href="{{url('/admin/shipping')}}">
					<div class="box bg-info text-center">
						<h1 class="font-light text-white"><i class="fas fa-shipping-fast"></i></h1>
						<h6 class="text-white">shipping</h6>
					</div>
				</a>
			</div>
		</div>
		<!-- Column -->
		@endif
				<!-- Column -->
		<div class="col-md-6 col-lg-2 col-xlg-3">
			<div class="card card-hover">
				<a href="#">
					<div class="box bg-warning text-center">
						<h1 class="font-light text-white"><i class="mdi mdi-alert"></i></h1>
						<h6 class="text-white">Errors</h6>
					</div>
				</a>
			</div>
		</div>
		<!-- Column -->
		
	</div>
	<!-- ============================================================== -->
	<!-- Sales chart -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center">
						<div>
							<h4 class="card-title">Site Analysis</h4>
							<h5 class="card-subtitle">Overview of Latest Month</h5>
						</div>
					</div>
					<div class="row">
						<!-- column -->
						<div class="col-lg-9">
							<div class="flot-chart">
								<div class="flot-chart-content" id="flot-line-chart"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="row">
								<div class="col-6">
									<div class="bg-dark p-10 text-white text-center">
									   <i class="fa fa-user m-b-5 font-16"></i>
									   <h5 class="m-b-0 m-t-5">2540</h5>
									   <small class="font-light">Total Users</small>
									</div>
								</div>
								 <div class="col-6">
									<div class="bg-dark p-10 text-white text-center">
									   <i class="fa fa-plus m-b-5 font-16"></i>
									   <h5 class="m-b-0 m-t-5">120</h5>
									   <small class="font-light">New Users</small>
									</div>
								</div>
								<div class="col-6 m-t-15">
									<div class="bg-dark p-10 text-white text-center">
									   <i class="fa fa-cart-plus m-b-5 font-16"></i>
									   <h5 class="m-b-0 m-t-5">656</h5>
									   <small class="font-light">Total Shop</small>
									</div>
								</div>
								 <div class="col-6 m-t-15">
									<div class="bg-dark p-10 text-white text-center">
									   <i class="fa fa-tag m-b-5 font-16"></i>
									   <h5 class="m-b-0 m-t-5">9540</h5>
									   <small class="font-light">Total Orders</small>
									</div>
								</div>
								<div class="col-6 m-t-15">
									<div class="bg-dark p-10 text-white text-center">
									   <i class="fa fa-table m-b-5 font-16"></i>
									   <h5 class="m-b-0 m-t-5">100</h5>
									   <small class="font-light">Pending Orders</small>
									</div>
								</div>
								<div class="col-6 m-t-15">
									<div class="bg-dark p-10 text-white text-center">
									   <i class="fa fa-globe m-b-5 font-16"></i>
									   <h5 class="m-b-0 m-t-5">8540</h5>
									   <small class="font-light">Online Orders</small>
									</div>
								</div>
							</div>
						</div>
						<!-- column -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection()