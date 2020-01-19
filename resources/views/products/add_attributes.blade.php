
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Attributes of Products &nbsp;&nbsp;</h4>
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
				<form  id="add-attributes" class="form-horizontal" method="post" action="{{url('/admin/products-attributes/'.$productDetails->id)}}">
					{{csrf_field()}}
					<div class="card-body">
						<h4 class="card-title">Product Attribute <span class="validation_error text-danger"></span></h4>
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
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Color</label>
							<div class="col-sm-9">
								<label for="lname" class="col-sm-3 text-right control-label col-form-label">{{$productDetails->product_color}}</label>
							</div>
						</div> 
						
						<div class="field_wrapper">
							<div>
								<input type="text" required name="sku[]" id="sku" placeholder="Sku" style="width:120px;"/>
								<input type="text" required name="size[]" id="size" placeholder="Size" style="width:120px;"/>
								<input type="text" required  name="price[]" id="price" placeholder="Price" style="width:120px;"/>
								<input type="text" required name="stock[]" id="stock" placeholder="Stock" style="width:120px;"/>
								<a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus"></i></a>
							</div>
						</div>
					</div>
					<div class="border-top">
						<div class="card-body">
							<button type="submit" id="add-attribute" class="btn btn-primary">Add Attribute</button>
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
					<form action="{{url('/admin/products-attributes-update/'.$productDetails->id)}}" method="post">
						{{csrf_field()}}
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Attribute Id</th>
								<th>SKU</th>
								<th>Size</th>
								<th>Price</th>
								<th>Stock</th>
								<th>Action</th>
								<th><button type="button" onclick="MultipletDelet()" class="btn btn-danger btn-sm DeleteRecord" >Delete</button></th>

							</tr>
						</thead>
						<tbody>
						@foreach($productDetails['attributes'] as $attribute)
							<tr>
								<td><input type="hidden" value="{{$attribute->id}}" name="AttrId[]"/>{{$attribute->id}}</td>
								<td>{{$attribute->sku}}</td>
								<td>{{$attribute->size}}</td>
								<td><input type="text" name="price[]" value="{{$attribute->price}}" /></td>
								<td><input type="text" name="stock[]" value="{{$attribute->stock}}"/></td>
								<td><input type="submit" class="btn btn-info btn-sm"/>
								<button type="button" onclick="attributetDelet({{$attribute->id}})" class="btn btn-danger btn-sm DeleteRecord" >Delete</button></td>
								<td><input name="delId[]" id="delId[]" type="checkbox" value="{{$attribute->id}}"></td>
							</tr>
						@endforeach
						</tbody>
					</table>
					</form>
				</div>
			</div>
        </div>
	</div>
	</div>
</div>

@endsection