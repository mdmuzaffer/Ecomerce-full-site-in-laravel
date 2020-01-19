
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
						<li class="breadcrumb-item"><a href="{{url('/admin/add-products')}}">Products</a></li>
						<li class="breadcrumb-item active" aria-current="page">View Products</li>
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
				<h5 class="card-title">Product View</h5>
				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Prod Id</th>
								<th>Cate Id</th>
								<th>Cate Name</th>
								<th>Prod Nane</th>
								<th>SKU</th>
								<th>Color</th>
								<th>Price</th>
								<th>Feature</th>
								<th>Images</th>
								<th>weight</th>
								<th>Actons View</th>
								
							</tr>
						</thead>
						<tbody>
						
							<?php 
							//echo "<pre>";
							//print_r($category);
							//die();
							?>
						@foreach($category as $category)
							<tr>
								<td>{{$category->id}}</td>
								<td>{{$category->category_id}}</td>
								<td>{{$category->Category->name}}</td>
								<td>{{$category->product_name}}</td>
								<td>{{$category->product_code}}</td>
								<td>{{$category->product_color}}</td>
								<td>{{$category->price}}</td>
								<td>@if($category->feature_item ==1)Yes @else No @endif</td>
								<td><img src="{{url('images/backend_image/products/small').'/'.$category->image}}" style="height:50px; width:60px;"/></td>
								<td>{{$category->weight}}</td>
								<td>
								<div class="comment-footer">
									<button type="button" class="btn btn-cyan btn-sm" title="Update product"><a href="{{url('/admin/edit-products/'.$category->id)}}">Edit</a></button>
									 <button type="button" class="btn btn-success btn-sm" title="Add Images"><a href="{{url('/admin/products-images/'.$category->id)}}">Add</a></button>
									<button type="button" class="btn btn-info btn-sm" data-toggle="modal" title="View Product" data-target="#Modal1" onclick="productView({{$category->id}})">View</button><br></br>
									<button type="button" class="btn btn-success btn-sm" title="Add attribute"><a href="{{url('/admin/products-attributes/'.$category->id)}}">Add</a></button>
									<button type="button" onclick="productDelet({{$category->id}},'delete-products')" title="Delete product" rel1="delete-products" class="btn btn-danger btn-sm DeleteRecord">Delete</button>
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
<!-- Modal -->
<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Product View</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="popup_result">

			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection
