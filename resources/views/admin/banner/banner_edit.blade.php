@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-12">
		
		@if(Session::has('flush_message_success'))
			<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>{{Session::get('flush_message_success')}}</strong>
			</div>
		@endif
		
			<div class="card">
				<div class="card-body">
					<h5 class="card-title m-b-0">Static Table</h5>
				</div>
				<table class="table">
					  <thead>
						<tr>
						  <th scope="col">id</th>
						  <th scope="col">Title</th>
						  <th scope="col">Link</th>
						  <th scope="col">content</th>
						  <th scope="col">Image</th>
						  <th scope="col">Status</th>
						  <th scope="col">action</th>
						</tr>
					  </thead>
					  <tbody>
					  @foreach($banner as $banners)
						<tr>
						  <th scope="row">{{$banners->id}}</th>
						  <td>{{$banners->title}}</td>
						  <td>{{$banners->link}}</td>
						  <td>{{$banners->content}}</td>
						  <td><img width="60" height="60" src="{{asset('images/frontend_image/banner/'.$banners->image)}}"/></td>
						  <td>{{$banners->status}}</td>
						  <td><a class="btn btn-primary" href="{{url('admin/banner-update/'.$banners->id)}}">Edit</a>|<a class="btn btn-info" href="{{url('admin/banner-delete/'.$banners->id)}}">Delete</a></td>
						</tr>
						@endforeach()
					  </tbody>
				</table>
			</div>
		</div>		
	
	
	</div>
</div>


@endsection()