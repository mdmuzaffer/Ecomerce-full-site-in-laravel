<?php 
use App\Products; 
?>
<div class="col-sm-3">
	<div class="left-sidebar">
		<h2>Category</h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
			@foreach($categories as $mainCat)
			<div class="panel panel-default">
			@if($mainCat->status =='1')
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordian" href="#{{$mainCat->id}}">
							<span class="badge pull-right"><i class="fa fa-plus"></i></span>
							{{$mainCat->name}}
						</a>
					</h4>
				</div>
				@endif
				<div id="{{$mainCat->id}}" class="panel-collapse collapse">
					<div class="panel-body">
						<ul>
							@foreach($mainCat->categories as $subCat)
							<?php $productCcount = Products::productCount($subCat->id);?>
								@if($subCat->status =='1')
								<li><a href="{{asset('product/'.$subCat->url)}}">{{$subCat->name}} ({{$productCcount}})</a></li>
								@endif
						@endforeach
						</ul>
					</div>
				</div>
			</div>
			@endforeach

		</div><!--/category-products-->
		
	</div>
	<!-- filter form sidebar -->
	<form method="post" action="{{url('/product-filter')}}">
		{{csrf_field()}}
		<input type="hidden" value="{{$url}}" name="url">
		<div class="left-sidebar">
			<h2>Color</h2>
			@if(!empty($_GET['color']))
			<?php 
			$colorArray = explode('-',$_GET['color']);
			//echo"<pre>"; print_r($colorArray); die;
			?>
			@endif
			<div class="panel-group color-products" id="accordian">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
						<span class="pull-right"><input name="color[]" value="black" type="checkbox" onchange="javascript:this.form.submit()" @if(!empty($colorArray) && in_array('black',$colorArray)) checked="" @endif></span>
							Black
						</h4>
					</div>
					
					<div class="panel-heading">
						<h4 class="panel-title">
							<span class="pull-right"><input name="color[]" value="white" type="checkbox" onchange="javascript:this.form.submit()"  @if(!empty($colorArray) && in_array('white',$colorArray)) checked="" @endif></span>
							White
						</h4>
					</div>
					<div class="panel-heading">
						<h4 class="panel-title">
							<span class="pull-right"><input name="color[]" value="gray" type="checkbox" onchange="javascript:this.form.submit()" @if(!empty($colorArray) && in_array('gray',$colorArray)) checked="" @endif></span>
							Gray
						</h4>
					</div>
					
					<div class="panel-heading">
						<h4 class="panel-title">
							<span class="pull-right"><input name="color[]" value="blue" type="checkbox" onchange="javascript:this.form.submit()"  @if(!empty($colorArray) && in_array('blue',$colorArray)) checked="" @endif></span>
							Blue
						</h4>
					</div>
					
					<div class="panel-heading">
						<h4 class="panel-title">
							<span class="pull-right"><input name="color[]" value="red" type="checkbox" onchange="javascript:this.form.submit()"  @if(!empty($colorArray) && in_array('red',$colorArray)) checked="" @endif></span>
							Red
						</h4>
					</div>
					<div class="panel-heading">
						<h4 class="panel-title">
							<span class="pull-right"><input name="color[]" value="green" type="checkbox" onchange="javascript:this.form.submit()"  @if(!empty($colorArray) && in_array('green',$colorArray)) checked="" @endif></span>
							Green
						</h4>
					</div>
					<div class="panel-heading">
						<h4 class="panel-title">
							<span class="pull-right"><input name="color[]" value="olive" type="checkbox" onchange="javascript:this.form.submit()"  @if(!empty($colorArray) && in_array('olive',$colorArray)) checked="" @endif></span>
							Olive
						</h4>
					</div>
					<div class="panel-heading">
						<h4 class="panel-title">
							<span class="pull-right"><input name="color[]" value="orange" type="checkbox" onchange="javascript:this.form.submit()"  @if(!empty($colorArray) && in_array('orange',$colorArray)) checked="" @endif></span>
							Orange
						</h4>
					</div>
					
				</div>
			</div>
		</div>
		<div>&nbsp;</div>
		<div class="left-sidebar">
			<h2>Size</h2>
			@if(!empty($_GET['size']))
			<?php 
			$sizeArray = explode('-',$_GET['size']);
			//echo"<pre>"; print_r($SizeArr); die;
			$SizeArr = json_decode(json_encode($SizeArr));
			?>
			@endif
			<div class="panel-group color-products" id="accordian">
				<div class="panel panel-default">
				@foreach($SizeArr as $key=>$size)
					<div class="panel-heading">
						<h4 class="panel-title">
						<span class="pull-right">
						<input name="size[]" value="{{$size->size}}" type="checkbox" onchange="javascript:this.form.submit()" @if(!empty($sizeArray) && in_array($size->size,$sizeArray)) checked="" @endif></span>
							{{$size->size}}
						</h4>
					</div>
				@endforeach	
				</div>
			</div>
		</div>
	</form>
	
</div>