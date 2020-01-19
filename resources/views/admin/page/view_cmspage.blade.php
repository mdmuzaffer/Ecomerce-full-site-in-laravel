
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">View Cms Page &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"> view CMS Page</a></li>
						<li class="breadcrumb-item active" aria-current="page">View Page</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">CMS Page View</h5>
				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Prod Id</th>
								<th>Title</th>
								<th>Description</th>
								<th>Url</th>								
								<th>Date</th>								
								<th>Status</th>								
								<th>Action</th>								
							</tr>
						</thead>
						<tbody>
						
							<?php 
							/* echo "<pre>";
							print_r($cmspageData);
							die(); */
							?>
							@foreach($cmspageData as $pagedata)
							<tr id="{{$pagedata->id}}">
								<td>{{$pagedata->id}}</td>
								<td>{{$pagedata->title}}</td>
								<td>{{$pagedata->description}}</td>
								<td>{{$pagedata->url}}</td>
								<td><?php echo date('d/m/y',strtotime($pagedata->created_at));?></td>
								<td>@if($pagedata->status ==1) Active @else Inactive @endif</td>
								<td>
								
								<div class="comment-footer">
									<button type="button" class="btn btn-cyan btn-sm" title="Update product"><a href="{{url('/admin/edit-page/'.$pagedata->id)}}">Edit</a></button>
									<button type="button" class="btn btn-info btn-sm" data-toggle="modal" title="View Product" data-target="#Modal12" onclick="pageView({{$pagedata->id}})">View</button>
									<button type="button" class="btn btn-danger btn-sm cmsPage"><a href="{{url('/admin/delete-page/'.$pagedata->id)}}">Delete</a></button>
                                </div>
								</td>
								
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
<div class="modal fade" id="Modal12" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Product View</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="cmspage_result">
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection