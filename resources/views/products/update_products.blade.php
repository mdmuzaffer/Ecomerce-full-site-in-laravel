
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Update Products &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Update Products</a></li>
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
				<form  id="add-product" class="form-horizontal" enctype="multipart/form-data" method="post" action="{{url('/admin/update-products')}}">
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
						<?php
						//echo"<pre>";
						//print_r($Productsdata);
						?>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Product Name</label>
							<div class="col-sm-9">
								<input type="hidden" class="form-control" name="product_id" id="product_id" value="{{$Productsdata->id}}">
								<input type="text" class="form-control" name="product_name" id="product_name" value="{{$Productsdata->product_name}}">
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Product Code</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="product_code" id="product_code" value="{{$Productsdata->product_code}}">
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Product Color</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="product_color" id="product_color" value="{{$Productsdata->product_color}}">
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Price</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="product_price" id="product_price" value="{{$Productsdata->price}}">
							</div>
						</div>
						
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">weight(Gm)</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="product_weight" id="product_weight" value="{{$Productsdata->weight}}">
							</div>
						</div>
						
						<div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Image</label>
                            <div class="col-md-5">
								<div class="custom-file">
								<input type="file" class="custom-file-input" name="file" id="file">
								<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                </div>
                            </div>
							<div class="col-md-2">
								<img width="60px" height="50px" src="{{url('images/backend_image/products/small').'/'.$Productsdata->image}}">
                            </div>
							<div class="col-md-2">
							 <button type="button" style="color:white" class="btn btn-cyan btn-sm"><a href="{{url('/admin/delete-image/'.$Productsdata->id)}}">Delete</a></button>
                            </div>
                        </div>
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Metarial & care</label>
							<div class="col-sm-9">
								<textarea id="product_care" class="form-control" name="product_care" required>{{$Productsdata->product_care}}</textarea>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Description</label>
							<div class="col-sm-9">
								<textarea id="product_description" class="form-control" name="product_description">{{$Productsdata->description}}</textarea>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Enable</label>
							<div class="col-sm-9">
								<div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" name="enable" class="custom-control-input" id="customControlAutosizing3" @if($Productsdata->status ==1) checked  @endif >
                                    <label class="custom-control-label" for="customControlAutosizing3"></label>
                                </div>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Feature Item</label>
							<div class="col-sm-9">
								<div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" name="feature_item" class="custom-control-input" id="feature_item" @if($Productsdata->feature_item ==1) checked  @endif>
                                    <label class="custom-control-label" for="feature_item"></label>
                                </div>
							</div>
						</div>
						
					</div>
					<div class="border-top">
						<div class="card-body">
							<button type="submit" onclick="addProducts()" class="btn btn-primary">Update Product</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection