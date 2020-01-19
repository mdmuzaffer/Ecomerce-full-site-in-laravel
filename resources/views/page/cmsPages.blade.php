@extends('layouts.frontendLayout.front_design')
@section('content')


<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<div class="panel-group category-products" id="accordian"><!--category-productsr-->
					@foreach($maincategory as $mainCat)
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
										@if($subCat->status =='1')
										<li><a href="{{asset('product/'.$subCat->url)}}">{{$subCat->name}}</a></li>
										@endif
									@endforeach
									</ul>
								</div>
							</div>
						</div>
					@endforeach
					</div><!--/category-products-->
				
				</div>
			</div>
			
			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">{{$pageUrldata->title}}</h2>
					<!-- Products feach all data-->
					<div class="col-sm-12">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<span><b>{{$pageUrldata->title}}</b></span>
									<p>{{$pageUrldata->description}}</p>
								</div>
							</div>
						</div>
					</div>
					
				</div><!--features_items-->
				
			</div>
		</div>
	</div>
</section>
@endsection()