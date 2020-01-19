@extends('layouts.frontendLayout.front_design')
@section('content')


<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Shopping Cart</li>
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
						<td class="description"></td>
						<td class="price">Price</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
						<td></td>
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
							<a href=""><img width="60px" height="50px" src="{{asset('images/backend_image/products/small/'.$userItem->image)}}" alt=""></a>
						</td>
						<td class="cart_description">
							<h4><a href="">{{$userItem->product_name}}</a></h4>
							<p>{{$userItem->product_code}}&nbsp;|&nbsp;{{$userItem->size}}</p>
						</td>
						<td class="cart_price">
							<p>INR {{$userItem->price}}</p>
						</td>
						<td class="cart_quantity">
							<div class="cart_quantity_button">
								<a class="cart_quantity_up" href="{{url('/cart/update-quentity/'.$userItem->id.'/1')}}"> + </a>
								<input class="cart_quantity_input" type="text" name="quantity" value="{{$userItem->quantity}}" autocomplete="off" size="2">
								@if($userItem->quantity >1)
								<a class="cart_quantity_down" href="{{url('/cart/update-quentity/'.$userItem->id.'/-1')}}"> - </a>
								@endif()
							</div>
						</td>
						<td class="cart_total">
							<p class="cart_total_price" value="{{$totals = $userItem->price * $userItem->quantity}}">{{$userItem->price * $userItem->quantity}}</p>
						</td>
						<td class="cart_delete">
							<a class="cart_quantity_delete" href="{{url('/cart_items_delete/'.$userItem->id)}}"><i class="fa fa-times"></i></a>
						</td>
					</tr>
					<?php $i++;?>
					@endforeach()
				</tbody>
			</table>
		</div>
	</div>
</section> <!--/#cart_items-->

<section id="do_action">
	<div class="container">
		<div class="heading">
			<h3>What would you like to do next?</h3>
			<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="chose_area">
					<ul class="user_option">
						<li>						
							<fieldset class="question">
							   <label for="coupon_question" style="color:#0910e7">Do you have a coupon ?</label>
							   <input class="coupon_question" type="checkbox" name="coupon_question" value="1" onchange="valueChanged()"/>
							   <span class="item-text" style="color:#f33f08">Yes</span>
							</fieldset>

						   <fieldset class="answer">
						   <form action="{{url('/coupon-apply')}}">
							   {{csrf_field()}}
							   <label for="coupon_field">Your coupon apply :</label>
							   <input type="text" name="coupon_value" id="coupon_field" placeholder="Type your coupon"/>
							   <input type="button" id="coupon_btn" class="btn btn-default check_out" nane="btn" value="Apply" style="margin-top:0px"/>
							   </form>
						   </fieldset>

						</li>
					</ul>
				</div>
				<div class="coupon_message">
					<!--<div class="alert alert-danger" style="margin-top:-72px;">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Not found coupon code</strong>
					</div> -->
				</div>
			</div>
			<div class="col-sm-6">
				<div class="total_area">
					<ul>
					@if(!empty(Session::get('couponAmount')))
						<li>Sub Total<span>INR <?php echo Session::get('total_amount');?></span></li>
						<li>Coupon Discount<span>INR <?php echo Session::get('couponAmount');?></span></li>
						<li>Cart Sub Total<span>INR <?php echo Session::get('total_amount') - Session::get('couponAmount');?></span></li>
						
					@else
						<li>Cart Sub Total<span id="show_totalPrice">INR 59</span></li>
					@endif
					</ul>
						<a class="btn btn-default update" href="">Update</a>
						<a class="btn btn-default check_out" href="{{url('/check-out')}}">Check Out</a>
				</div>
			</div>
		</div>
	</div>
</section><!--/#do_action-->


@endsection()