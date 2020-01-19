
<?php 
use App\Products; 
?>

@extends('layouts.frontendLayout.front_design')
@section('content')

@if(Session::has('flush_message_success'))
	<div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong>{{Session::get('flush_message_success')}}</strong>
	</div>
@endif
<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
						<li data-target="#slider-carousel" data-slide-to="3"></li>
					</ol>
					
					<div class="carousel-inner">
						<?php echo $i='';?>
						@foreach($banner as $banners)
						<div class="item <?php if($i ==1){echo"active";}?>">
							<div class="col-sm-12">
								<img src="http://localhost/ecommerce/public/frontend/images/home/pricing.png"  class="pricing" alt="" />
								<img style="width:1520" src="{{asset('images/frontend_image/banner/'.$banners->image)}}" class="girl img-responsive" alt="" />
							</div>
						</div>
						<?php $i++;?>
						@endforeach()
					</div>
					
					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
				
			</div>
		</div>
	</div>
</section><!--/slider-->

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<?php 
					//echo"<pre>";
					//print_r($subcategory);
				
					?>
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
			</div>
			
			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">Features Items</h2>
					<!-- Products feach all data-->
					@foreach($Allproduct as $products)
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<a href="{{url('/products/'.$products->id)}}"><img src="{{asset('images/backend_image/products/medium/'.$products->image)}}" alt="" /></a>
									<h2>INR {{$products->price}}</h2>
									<p>{{$products->product_name}}</p>
									<a href="{{url('/products/'.$products->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
							</div>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
								</ul>
							</div>
						</div>
					</div>
					@endforeach
					
				</div><!--features_items-->
				<div class="paginate">{{ $Allproduct->links() }}</div>
				
				<div class="recommended_items"><!--recommended_items-->
					<h2 class="title text-center">recommended items</h2>
					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active">
							<?php $i =1;?>
								@foreach($Allproduct as $allproductsItem)
								<?php if($i<=3){?>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<a href="{{url('/products/'.$allproductsItem->id)}}"><img src="{{asset('images/backend_image/products/medium/'.$allproductsItem->image)}}" alt="" /></a>
												<h2>INR{{$allproductsItem->price}}</h2>
												<p>{{$allproductsItem->product_name}}</p>
												<a href="{{url('/products/'.$allproductsItem->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<?php } $i++;?>
							@endforeach
							
							</div>
							
							<div class="item">
								@foreach($Allproduct as $key=>$allproductsItem)
								<?php if($key>=3){?>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{asset('images/backend_image/products/medium/'.$allproductsItem->image)}}" alt="" />
												<h2>INR{{$allproductsItem->price}}</h2>
												<p>{{$allproductsItem->product_name}}</p>
												<a href="{{url('/products/'.$allproductsItem->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<?php }?>
							@endforeach
							
							</div>
						</div>
						 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						  </a>
						  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
							<i class="fa fa-angle-right"></i>
						  </a>			
					</div>
				</div><!--/recommended_items-->
				
			</div>
		</div>
	</div>
</section>
@endsection()