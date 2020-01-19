@extends('layouts.frontendLayout.front_design')
@section('content')

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Wish List</li>
			</ol>
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
			
		</div>
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Image</td>
						<td class="image">Item</td>
						<td class="price">Price</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
						<td>Cart</td>
						<td>Remove</td>
					</tr>
				</thead>
				<tbody>
				
				<?php 
				//echo"<pre>";
				//echo $productImage->image;
				//print_r($productImage);
				//die;
				?>
					<?php $i = 0;?>
					@foreach($userCart as $userItem)
					<tr>
						<td class="cart_product">
							<a href=""><img width="60px" height="50px" src="{{asset('images/backend_image/products/small/'.$userItem['image'])}}" alt=""></a>
						</td>
						<td class="cart_description">
							<h4><a href="">{{$userItem['product_name']}}</a></h4>
							<p>{{$userItem['product_code']}}&nbsp;|&nbsp;{{$userItem['size']}}</p>
						</td>
						<td class="cart_price">
							<p>INR {{$userItem['price']}}</p>
						</td>
						<td class="cart_quantity">
							<div class="cart_quantity_button">
								<a class="cart_quantity_up" href="{{url('/cart/update-quentity/'.$userItem['id'].'/1')}}"> + </a>
								<input class="cart_quantity_input" type="text" name="quantity" value="{{$userItem['quantity']}}" autocomplete="off" size="2">
								@if($userItem['quantity'] >1)
								<a class="cart_quantity_down" href="{{url('/cart/update-quentity/'.$userItem['id'].'/-1')}}"> - </a>
								@endif()
							</div>
						</td>
						<td class="cart_total">
							<p class="cart_total_price" value="{{$totals = $userItem['price'] * $userItem['quantity']}}">{{$userItem['price'] * $userItem['quantity']}}</p>
						</td>
						
						<td class="cart_add">
							<div class="cart_quantity_cart">
							<form action="{{url('/products/add_cart')}}" method="post">
							   {{csrf_field()}}
							<input type="hidden" name="product_name" value="{{$userItem['product_name']}}" id="product_name" />
							<input type="hidden" name="product_image" value="{{$userItem['image']}}" id="product_image" />
							<input type="hidden" name="product_code" value="{{$userItem['product_code']}}" id="product_code" />
							<input type="hidden" name="product_price" value="{{$userItem['price']}}" id="product_price_hidden"/>
							<input type="hidden" name="product_id" value="{{$userItem['product_id']}}" id="product_id"/>
							<input type="hidden" name="product_color" value="{{$userItem['product_color']}}" id="product_color"/>
							<input type="hidden" name="user_email" value="None" id="user_email"/>
							<input type="hidden" name="session_id" value="{{md5(uniqid(rand(), true))}}" id="session_id"/>
							<input type="hidden" name="sizeId" value="{{$userItem['product_id']}}-{{$userItem['size']}}" id="sizeId"/>
							<input type="hidden" name="quantity" value="{{$userItem['quantity']}}" id="quantity"/>
							<input class="btn btn-default check_out" type="submit" name="addtocart" value="Add to Cart" style="margin-top:0px" />
							</form>
							
							</div>
						</td>
						
						<td class="cart_delete">
							<a class="cart_quantity_delete" href="{{url('/wislis_items_delete/'.$userItem['product_id'])}}"><i class="fa fa-times"></i></a>
						</td>
					</tr>
					<?php $i++;?>
					@endforeach()
				</tbody>
			</table>
		</div>
	</div>
</section> <!--/#cart_items-->
@endsection()