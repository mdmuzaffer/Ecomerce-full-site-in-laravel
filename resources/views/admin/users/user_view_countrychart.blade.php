
@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Users &nbsp;&nbsp;</h4>
			<span class="error_message" style="color:green;"></span>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{url('/admin/add-products')}}">Users Chart</a></li>
						<li class="breadcrumb-item active" aria-current="page">Users View Country</li>
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
		
	@if(Session::has('flush_message_success'))
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>{{Session::get('flush_message_success')}}</strong>
		</div>
	@endif
		
			<div class="card-body">
				<h5 class="card-title">Users View</h5>
				<?php
					$current_month = date('M');
					$last_month = date('M',strtotime("-1 month"));
					$last_tolast_month = date('M',strtotime("-2 month"));
					
					$dataPoints = array( 
						array("label"=>$user[0]->country, "y"=>$user[0]->count),
						array("label"=>$user[1]->country, "y"=>$user[1]->count),
						array("label"=>$user[2]->country, "y"=>$user[2]->count)
					);
				?>
				<div id="chartContainer" style="height: 370px; width: 100%;"></div>
			</div>
		</div>
    </div>
</div>
<script>

window.onload = function() {
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Users in Country"
	},
	subtitles: [{
		text: "November 2019"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
@endsection