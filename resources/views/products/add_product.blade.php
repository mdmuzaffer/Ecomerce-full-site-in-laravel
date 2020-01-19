
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Products &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Products</a></li>
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
				<form  id="add-product" class="form-horizontal" enctype="multipart/form-data" method="post" action="{{url('/admin/save-products')}}">
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
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Under Category</label>
							<div class="col-md-9">
							<select id="category_id" name="category_id" class="select2 form-control custom-select" style="width: 100%; height:36px;">
							<?php 
								echo $category_dropdown;
							?>
							</select>
                            </div>
                        </div>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Product Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name">
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Product Code</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="product_code" id="product_code" placeholder="Product Code">
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Product Color</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="product_color" id="product_color" placeholder="Product Color">
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Price(Gm)</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="product_price" id="product_price" placeholder="Product Price">
							</div>
						</div>
						
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Weight</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="product_weight" id="product_weight" placeholder="Product weight">
							</div>
						</div>
						
						<div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Image</label>
                            <div class="col-md-9">
								<div class="custom-file">
								<input type="file" class="custom-file-input" name="file" id="file" required>
								<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                </div>
                            </div>
                        </div>
						
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Material & Care</label>
							<div class="col-sm-9">
								<textarea id="product_care" class="form-control" name="product_care" placeholder="care" required ></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Description</label>
							<div class="col-sm-9">
								<textarea id="product_description" class="form-control" name="product_description" placeholder="Description"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Enable</label>
							<div class="col-sm-9">
								<div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" name="enable" class="custom-control-input" id="customControlAutosizing3">
                                    <label class="custom-control-label" for="customControlAutosizing3"></label>
                                </div>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Feature Item</label>
							<div class="col-sm-9">
								<div class="custom-control custom-checkbox mr-sm-2">
									<input type="checkbox" name="feature_item" class="custom-control-input" id="feature_item">
									<label class="custom-control-label" for="feature_item"></label>
								</div>
							</div>
						</div>
					</div>
					<div class="border-top">
						<div class="card-body">
							<button type="submit" onclick="addProducts()" class="btn btn-primary">Add Product</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection