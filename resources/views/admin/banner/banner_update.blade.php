@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			@if(Session::has('flush_message_success'))
			<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>{{Session::get('flush_message_success')}}</strong>
			</div>
			@endif
			<div class="card">
				<form class="form-horizontal" method="post" enctype='multipart/form-data' action="{{url('admin/banner-change')}}">
					{{csrf_field()}}
					<div class="card-body">
						<h4 class="card-title">Personal Info</h4>
						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
							<div class="col-sm-9">
								<input type="hidden" name="id" value="{{$bannerUpdate->id}}">
								<input type="text" class="form-control" id="title" name="title" placeholder="Title Here" value="{{$bannerUpdate->title}}">
							</div>
						</div>
						<div class="form-group row">
							<label for="lname" class="col-sm-3 text-right control-label col-form-label">Link</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="link" name="link" placeholder="Link" value="{{$bannerUpdate->link}}">
							</div>
						</div>
						
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Content</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="content">{{$bannerUpdate->content}}</textarea>
							</div>
						</div>
					   <div class="form-group row">
							<label for="file" class="col-sm-3 text-right control-label col-form-label">Banner Image</label>
							<div class="col-md-9">
								<div class="custom-file">
									<input type="file" class="custom-file-input" name="image" id="validatedCustomFile" required>
									<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
									
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="cono1" class="col-sm-3 text-right control-label col-form-label" style="margin-top:-5px;">Status</label>
							<div class="col-sm-9">
								<div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input"  name="status" <?php if($bannerUpdate->status==1){echo "checked";}?> id="customControlAutosizing1">
                                    <label class="custom-control-label" for="customControlAutosizing1"></label>
                                </div>
							</div>
						</div>
					</div>
					<div class="border-top">
						<div class="card-body">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection();