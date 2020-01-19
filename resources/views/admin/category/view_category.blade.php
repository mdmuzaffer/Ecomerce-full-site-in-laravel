@extends('Layouts.adminLayout.admin_design');
@section('content')

<!-- Page wrapper  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Category</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Category</a></li>
						<li class="breadcrumb-item active" aria-current="page">View Category</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->

<!-- Modal -->
<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title alert-success" id="exampleModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
		        <div class="row">
                    <div class="col-md-12">
						<div class="success_message text-success"></div>
                        <div class="card">  
                            <form class="form-horizontal">
							{{csrf_field()}}
                                <div class="card-body">
                                    <h4 class="card-title">Update Category</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" class="form-control" id="upid" placeholder="Category name">
                                            <input type="text" class="form-control" id="upcategory" placeholder="Category name">
                                        </div>
                                    </div>
									
									
									 <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Category Leavel</label>
                                        <div class="col-sm-9">
                                            <select name="parent_id" id="catlevel">
												<option value="0" class="form-control">Main Category</option>
											
												@foreach($levels as $val)
													<option value="{{ $val->id}}" class="form-control">{{$val->name}}</option>
												@endforeach
											</select>
                                        </div>
                                    </div>
									 <div class="form-group row">
                                        <label for="lname_d" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="updesc" placeholder="Enter Description">
                                        </div>
                                    </div>
									
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Url</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="upurl" placeholder="Enter Url">
                                        </div>
                                    </div>
									
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Enable</label>
										<div class="col-sm-1">
											<input class="form-control" type="checkbox" name="enable" id="enable" value="1" />
										</div>
									</div>
						
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="button" class="btn btn-primary" onclick="ajaxupdateCategory();">Update</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->

<!-- Container fluid  -->
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
					<h5 class="card-title m-b-0">View Category</h5>
				</div>
				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
					  <thead>
						<tr>
						  <th scope="col">Category Id</th>
						  <th scope="col">Category Name</th>
						  <th scope="col">Category Description</th>
						  <th scope="col">Category Url</th>
						  <th scope="col">Category Leavel</th>
						  <th scope="col">status</th>
						  <th scope="col">Action</th>
						</tr>
					  </thead>
					  <tbody>
					@foreach($category as $categories)
						<tr>
							<td scope="row" id="{{$categories->id}}">{{$categories->id}}</td>
							<td data-target="{{$categories->name}}">{{$categories->name}}</td>
							<td data-target="{{$categories->name}}">{{$categories->description}}</td>
							<td data-target="{{$categories->url}}">{{$categories->url}}</td>
							<td data-target="{{$categories->url}}">{{$categories->parent_id}}</td>
							<td data-target="{{$categories->url}}">{{$categories->status}}</td>
							<td><button type="button" onclick="updateCategory('{{$categories->id}}');" class="btn btn-success margin-5 text-white" data-toggle="modal" data-target="#Modal2" data-toggle="tooltip" data-placement="top" title="View">
                                    View
                               </button>|<button type="button" onclick="deleteCategory('{{$categories->id}}');" class="btn btn-danger margin-5" data-toggle="tooltip" data-placement="top" title="Delete">
                                  Delete
                                </button>
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
<!-- End Page wrapper  -->
@endsection