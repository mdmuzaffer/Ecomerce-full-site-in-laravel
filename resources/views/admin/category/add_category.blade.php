@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Category &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Category</a></li>
						<li class="breadcrumb-item active" aria-current="page">Add Category</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<form class="form-horizontal" method="post" action="{{url('/admin/add-category')}}">
					{{ csrf_field() }}
					<div class="card-body">
						<h4 class="card-title">Category Info</h4>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Category Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="category" placeholder="Category Name" name="category">
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Url</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="url" placeholder="Url here" name="url">
							</div>
						</div>
						
						<div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Under Category</label>
                                <div class="col-md-9">
								<select name="category_name" class="select2 form-control custom-select" style="width: 100%; height:36px;">
									<option value="0">Select</option>
									@foreach($levels as $category)
									<option value="{{$category->id}}">{{$category->name}}</option>
									@endforeach
                                </select>
                            </div>
                        </div>
						 
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
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
							<button type="submit" id="add_category" class="btn btn-primary">Add Category</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection