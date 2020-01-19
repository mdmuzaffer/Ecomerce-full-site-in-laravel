
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
						<li class="breadcrumb-item"><a href="{{url('/admin/add-products')}}">Orders Chart</a></li>
						<li class="breadcrumb-item active" aria-current="page">Orders View Chart</li>
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
				<h5 class="card-title">Orders View</h5>
				<?php
					$current_month = date('M');
					$last_month = date('M',strtotime("-1 month"));
					$last_tolast_month = date('M',strtotime("-2 month"));
					$last_tothree_month = date('M',strtotime("-3 month"));
					$last_tofour_month = date('M',strtotime("-4 month"));
					
					$dataPoints = array( 
						array("y" => $lastto4Month, "label" => $last_tofour_month ),
						array("y" => $lastto3Month, "label" => $last_tothree_month ),
						array("y" => $lasttolastMonth, "label" => $last_tolast_month ),
						array("y" => $lastMonth, "label" => $last_month ),
						array("y" => $currentMonth, "label" => $current_month )
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
		theme: "light2",
		title:{
			text: "Order Reporting"
		},
		axisY: {
			title: "No Of Orders"
		},
		data: [{
			type: "column",
			yValueFormatString: "#,##0.## tonnes",
			dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
		}]
	});
	chart.render();
}
</script>
@endsection
