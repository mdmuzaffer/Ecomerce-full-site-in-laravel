
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">News Letter &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{url('/admin/add-products')}}">News</a></li>
						<li class="breadcrumb-item active" aria-current="page">News Letter</li>
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
				<h5 class="card-title"><a href="{{url('/admin/news-letter-export')}}"><button type="button" class="btn btn-cyan btn-sm">Export Email</button></a></h5>
				@if(Session::has('flush_message_success'))
					<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>{{Session::get('flush_message_success')}}</strong>
					</div>
				@endif
				
				
				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>User Id</th>
								<th>Email</th>
								<th>Status</th>
								<th>Created on</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($newsData as $news)
							<tr>
								<td>{{$news->id}}</td>
								<td>{{$news->email}}</td>
								<td>
								@if($news->status ==1)
								<span style="color:#2962FF"><a href="{{url('/admin/news-letter-status/'.$news->id.'/0')}}">Active</a></span>	
								@else
								<span><a style="color:red;" href="{{url('/admin/news-letter-status/'.$news->id.'/1')}}">Inactive</a></span>	
								@endif
								</td>
								<td><?php $date =  new DateTime($news->created_at);
								echo $date->format('d/m/y');?></td>
								<td><a href="{{url('/admin/news-letter-delete/'.$news->id)}}">Delete</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
</div>
@endsection
