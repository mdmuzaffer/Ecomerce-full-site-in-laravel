@extends('layouts.frontendLayout.front_design')
@section('content')
<?php use App\products;?>
<section>
	<div class="container">
		<div class="row">
		
		@if(Session::has('flush_message_success'))
			<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>{{Session::get('flush_message_success')}}</strong>
			</div>
		@endif
		
		@if(Session::has('flush_message_error'))
			<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>{{Session::get('flush_message_error')}}</strong>
			</div>
		@endif
			@include('layouts.frontendLayout.front_sidebarMenu')
			
			<div class="col-sm-9 padding-right">
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5">
						<div class="easyzoom easyzoom--overlay">
							<div class="view-product">
								<a href="{{asset('images/backend_image/products/medium/'.$productDetails->image)}}">
									<img id="change_images" src="{{asset('images/backend_image/products/medium/'.$productDetails->image)}}" alt="" width="640" height="360" />
								</a>
								<h3>Zoome</h3>
							</div>
						</div>
											
						<div id="similar-product" class="carousel slide" data-ride="carousel">
							
							  <!-- Wrapper for slides -->
								<div class="carousel-inner">
									<div class="item active">
									@foreach($slider as $image)
									  <a href=""><img id="slider{{$image->id}}" height="85" width="85" src="{{asset('images/frontend_image/products/small/'.$image->product_image)}}" alt=""></a>
									@endforeach
									</div>
									<div class="item">
									@foreach($slider as $image)
									  <a href=""><img id="slider{{$image->id}}" height="85" width="85" src="{{asset('images/frontend_image/products/small/'.$image->product_image)}}" alt=""></a>
									@endforeach
									</div>
									<div class="item">
									@foreach($slider as $image)
									  <a href=""><img id="slider{{$image->id}}" height="85" width="85" src="{{asset('images/frontend_image/products/small/'.$image->product_image)}}" alt=""></a>
									@endforeach
									</div>
								</div>

							  <!-- Controls -->
							  <a class="left item-control" href="#similar-product" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right item-control" href="#similar-product" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>
						</div>

					</div>
					<div class="col-sm-7">
					<!-- cart products form start -->
						<form action="{{url('/products/add_cart')}}" method="post">
							{{csrf_field()}}
							<input type="hidden" name="product_name" value="{{$productDetails->product_name}}" id="product_name" />
							<input type="hidden" name="product_image" value="{{$productDetails->image}}" id="product_image" />
							<input type="hidden" name="product_code" value="{{$productDetails->product_code}}" id="product_code" />
							<input type="hidden" name="product_price" value="{{$productDetails->price}}" id="product_price_hidden"/>
							<input type="hidden" name="product_id" value="{{$productDetails->id}}" id="product_id"/>
							<input type="hidden" name="product_color" value="{{$productDetails->product_color}}" id="product_color"/>
							<input type="hidden" name="user_email" value="None" id="user_email"/>
							<input type="hidden" name="session_id" value="{{md5(uniqid(rand(), true))}}" id="session_id"/>
							
							<div class="product-information"><!--/product-information-->
							<img src="{{asset('frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
							<h2>{{$productDetails->product_name}}</h2>
							<p>SKU: <span id="attribute_sku"> {{$productDetails->product_code}}</span></p>
							<p>SIZE :
								<select name="sizeId" id="sizeId" style="width:120px; color:#000;" required>
									<option value="">Select</option>
									@foreach($productDetails->attributes as $attributes)
									<option value="{{$attributes->id}}-{{$attributes->size}}">{{$attributes->size}}</option>
									@endforeach
								</select>
							</p>
							<span>
								<?php $currencyratechange = Products::currencyratechange($productDetails->price);?>
								<span id="attribute_price">
								INR {{$productDetails->price}}
								</span>
								<label>Quantity:</label>
								<input type="text" name="quantity" value="1"  required/>
								<button type="button" id="add_cart" class="btn btn-fefault cart">
									<i class="fa fa-shopping-cart"></i>
									<input type="submit" value="Add to cart" class="cart-sub"/>
								</button>
								<br>
								<button type="button" class="btn btn-primary" style="margin-top:45px;">
									<i class="fa fa-shopping-cart" style='font-size:21px;color:red'></i>
									<input type="submit" name ="wishlist" value="wish list" class="cart-sub"/>
								</button>
								<div class="curr_result">
									<div id="currDoller">
										<h4>USD {{$currencyratechange['USD_rate']}}</h4>
									</div>
									<div id="currDoller1">
										<h4>GBP {{$currencyratechange['GBP_rate']}}</h4>
									</div>
									<div id="currDoller2">
										<h4>EUR {{$currencyratechange['EUR_rate']}}</h4>
									</div>
								</div>
								
							</span>
							<p id="availability"><b>Availability:</b> In Stock <span id="attribute_stock" style="color:#FE980F;">1</span></p>
							<p><b>Condition:</b> New</p>
							<p><b>Brand:</b> E-SHOPPER</p>
							
							<p><b>Delivery:</b><input type="text" name="pincode" id="pincode" placeholder="Check pincode" class="form-control" required/>
							<input type="button" id="pinCheck" value="go" class="btn btn-info" onclick="return checkPin()"/></p>
							<div id="pinResult"></div>
			
						</div><!--/product-information-->
						</form>
						<!-- end cart form-->
					</div>
				</div><!--/product-details-->
				
				<div class="category-tab shop-details-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
							<li><a href="#care" data-toggle="tab">Material & Care</a></li>
							<li><a href="#tag" data-toggle="tab">Tag</a></li>
							<li><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="description" >
							<div class="col-sm-10">
								<p>{{$productDetails->description}}</p>	
							</div>
						</div>
						
						<div class="tab-pane fade" id="care" >
							<div class="col-sm-10">
								<p>{{$productDetails->product_care}}</p>
							</div>
						</div>
						
						<div class="tab-pane fade" id="tag" >
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('frontend/images/home/gallery1.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition 1</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="tab-pane fade" id="reviews" >
							<div class="col-sm-12">
								<ul>
									<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
									<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
									<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
								</ul>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
								<p><b>Write Your Review</b></p>
								
								<form action="#">
									<span>
										<input type="text" placeholder="Your Name"/>
										<input type="email" placeholder="Email Address"/>
									</span>
									<textarea name="" ></textarea>
									<b>Rating: </b> <img src="{{asset('frontend/images/product-details/rating.png')}}" alt="" />
									<button type="button" class="btn btn-default pull-right">
										Submit
									</button>
								</form>
							</div>
						</div>
						
					</div>
				</div><!--/category-tab-->
				
				<div class="recommended_items"><!--recommended_items-->
					<h2 class="title text-center">recommended items</h2>
					
					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active">
							@foreach($recomendateItem as $recItem)
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{asset('images/backend_image/products/medium/'.$recItem->image)}}" alt="" />
												<h2>INR{{$recItem->price}}</h2>
												<p>{{$recItem->product_name}}</p>
												<button type="button" class="btn btn-default add-to-cart"><a href="{{url('/products/'.$recItem->id)}}"><i class="fa fa-shopping-cart"></i>Add to cart</a></button>
											</div>
										</div>
									</div>
								</div>
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