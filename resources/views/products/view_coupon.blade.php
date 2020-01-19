@extends('layouts.adminLayout.admin_design')
@section('content')
<div class="card">
	<div class="card-body">
		<h5 class="card-title m-b-0">Coupon details view</h5>
		
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
	</div>
		<div class="table-responsive">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Coupon Code</th>
						<th scope="col">Amount</th>
						<th scope="col">Amount type</th>
						<th scope="col">Expiry Date</th>
						<th scope="col">Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody class="customtable">
				@foreach($coupon as $coupons)
					<tr>
						<td>{{$coupons->id}}</td>
						<td>{{$coupons->coupon_code}}</td>
						<td>{{$coupons->amount}}
						@if($coupons->amount_type =='persentage') % @else INR @endif
						</td>
						<td>{{$coupons->amount_type}}</td>
						<td>{{date('d/m/Y', $coupons->expiry_date)}}</td>
						<td> @if($coupons->status ==1){{"Active"}}@else{{"Inactive"}}@endif </td>
						<td><button type="submit" class="btn btn-info"><a href="{{url('/admin/edite_coupon/'.$coupons->id)}}">Edit</a></button>
						| <button type="submit" class="btn btn-danger"><a href="{{url('/admin/delete_coupon/'.$coupons->id)}}">Delete</a></button></td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
</div>
@endsection