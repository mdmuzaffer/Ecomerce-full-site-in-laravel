
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Images of Products &nbsp;&nbsp;</h4>
			<div class="result_message" style="color:red">
			</div>
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
						<li class="breadcrumb-item"><a href="#">Products Images</a></li>
						<li class="breadcrumb-item active" aria-current="page">Add Products</li>
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
				<form  id="add-attributes" class="form-horizontal" enctype="multipart/form-data" method="post" action="{{url('/admin/products-addimages/'.$productDetails->id)}}">
					{{csrf_field()}}
					<div class="card-body">
						<h4 class="card-title">Product Images <span class="validation_error text-danger"></span></h4>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Product Name</label>
							<div class="col-sm-9">
								<label for="fname" class="col-sm-3 text-right control-label col-form-label">{{$productDetails->product_name}}</label>
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Product Code</label>
							<div class="col-sm-9">
								<label for="lname" class="col-sm-3 text-right control-label col-form-label">{{$productDetails->product_code}}</label>
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Price</label>
							<div class="col-sm-9">
								<label for="lname" class="col-sm-3 text-right control-label col-form-label">{{$productDetails->price}}</label>
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Image</label>
							<div class="col-sm-4">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="image" name="image[]" multiple="multiple" required>
										<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
								</div>
							</div>
						</div> 
						
					</div>
					<div class="border-top">
						<div class="card-body">
							<button type="submit" id="add-attribute" class="btn btn-primary">Add Image</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
		<!-- Table of Attribute -->
		
			<?php 
			//echo"<pre>";
			//print_r($productAttribute);
			//echo"</pre>";
			?>
	<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
			<div class="delResult" styel="float:right !important"></div>
				<h5 class="card-title">Basic Datatable</h5>
				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Id</th>
								<th>Product Id</th>
								<th>Image</th>
								<th><button type="button" onclick="MultipletDelet()" class="btn btn-danger btn-sm DeleteRecord" >Delete</button></th>
							</tr>
						</thead>
						<tbody>
						<tr>
						@foreach($productImage as $image)
							<td>{{$image->id}}</td>
							<td>{{$image->product_id}}</td>
							<td><img width="40" height="50" src="{{asset('images/frontend_image/products/small/'.$image->product_image)}}"/></td>
							<td><button type="button" class="btn btn-outline-secondary"><a href="{{url('/admin/products-deleteimages/'.$image->id)}}">Delete</a></button></td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
        </div>
	</div>
	</div>
</div>

@endsection