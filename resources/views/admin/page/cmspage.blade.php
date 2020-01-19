
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">CMS Page &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">CMS Page</a></li>
						<li class="breadcrumb-item active" aria-current="page">Add Page</li>
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
				<form  id="add-cms-page" class="form-horizontal" method="post" action="{{url('/admin/add-cms-page')}}">
					{{csrf_field()}}
					<div class="card-body">
						<h4 class="card-title">CMS Page Add<span class="validation_error text-danger"></span></h4>
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
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="page_title" id="page_title" placeholder="Page title" required>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Description</label>
							<div class="col-sm-9">
								<textarea id="page_description" class="form-control" name="page_description" placeholder="Description" required ></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Page Url</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="page_url" id="page_url" placeholder="Page url" required>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Meta title</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Title" required>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Meta keywords</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="meta_keywords" id="meta_keywords" placeholder="Meta Keywords" required>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Meta Content</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="Meta Content" required>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Enable</label>
							<div class="col-sm-9">
								<div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" name="enable" value="1" class="custom-control-input" id="pageenable">
                                    <label class="custom-control-label" for="pageenable"></label>
                                </div>
							</div>
						</div>
						
					</div>
					<div class="border-top">
						<div class="card-body">
							<button type="submit" class="btn btn-primary">Add Page</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection