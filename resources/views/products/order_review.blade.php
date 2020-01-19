@extends('layouts.frontendLayout.front_design')
@section('content')

<section id="cart_items">
	<div class="container">
	@if(Session::has('flush_message_success'))
		<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>{{Session::get('flush_message_success')}}</strong>
		</div>
	@endif
	<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Order Review</li>
				</ol>
			</div><!--/breadcrums-->
		<div class="row checkOut_row shopper-informations_review">
			<div class="shoper_center">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
					
					<p class="billing-title_review">Bill Details</p>
					===============================
						<div class="form-group">
							<label for="email">Email:</label>
							{{$billingDetail->email}}
						</div>
						<div class="form-group">
							<label for="email">Name:</label>
							{{$billingDetail->name}}
						</div>
						<div class="form-group">
							<label for="email">City:</label>
							{{$billingDetail->city}}
						</div>
						<div class="form-group">
							<label for="email">State:</label>
							{{$billingDetail->state}}
						</div>
						<div class="form-group">
							<label for="email">Pincode:</label>
							{{$billingDetail->pincode}}
						</div>
				
						<div class="form-group">
							<label for="email">Country:</label>
							{{$billingDetail->country}}
						</div>
		
						<div class="form-group">
							<label for="email">Address:</label>
							{{$billingDetail->address}}
						</div>
						
						<div class="form-group">
							<label for="email">Mobile:</label>
							{{$billingDetail->mobile}}
						</div>							
					</div>
				</div>
				
				<div class="col-sm-4">
					<div class="signup-form">
					<p class="billing-title_review">Shipping details</p>
						============================
						<div class="form-group">
							<label for="email">Email:</label>
							{{$shippingDetail->user_email}}
						</div>
						<div class="form-group">
							<label for="email">Name:</label>
							{{$shippingDetail->name}}
						</div>
						<div class="form-group">
							<label for="email">City:</label>
							{{$shippingDetail->city}}
						</div>
						<div class="form-group">
							<label for="email">State:</label>
							{{$shippingDetail->state}}
						</div>
						<div class="form-group">
							<label for="email">Pincode:</label>
							{{$shippingDetail->pincode}}
						</div>
				
						<div class="form-group">
							<label for="email">Country:</label>
							{{$shippingDetail->country}}
						</div>
						
						<div class="form-group">
							<label for="email">Address:</label>
							{{$shippingDetail->address}}
						</div>
						
						<div class="form-group">
							<label for="email">Mobile:</label>
							{{$shippingDetail->mobile}}
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="review-payment">
				<h2>Review & Payment</h2>
		</div>
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Item</td>
						<td class="description"></td>
						<td class="price">Price</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
				<?php $total =0;?>
				@foreach($userViewCart_Products as $viewProducts)
					<tr>
						<td class="cart_product">
							<a href=""><img style="width:55px; height:65px;" src="{{asset('images/backend_image/products/small/'.$viewProducts->product_image)}}" alt=""></a>
						</td>
						<td class="cart_description">
							<h4><a href="">{{$viewProducts->product_name}}</a></h4>
							<p>{{$viewProducts->product_code}}</p>
						</td>
						<td class="cart_price">
							<p>{{$viewProducts->price}}</p>
						</td>
						<td class="cart_quantity">
							<div class="cart_quantity_button">
								<a class="cart_quantity_up" href=""> + </a>
								<input class="cart_quantity_input" type="text" name="quantity" value="{{$viewProducts->quantity}}" autocomplete="off" size="2">
								<a class="cart_quantity_down" href=""> - </a>
							</div>
						</td>
						<td class="cart_total">
							<p class="cart_total_price">{{$viewProducts->quantity*$viewProducts->price}}</p>
						</td>
						<td class="cart_delete">
							<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
						</td>
					</tr>
					<?php $total = $total +$viewProducts->quantity*$viewProducts->price;?>
					@endforeach()
					<tr>
						<td colspan="4">&nbsp;</td>
						<td colspan="2">
							<table class="table table-condensed total-result">
								<tr>
									<td>Cart Sub Total</td>
									<td>INR {{$total}}</td>
								</tr>
								<tr class="shipping-cost">
									<td>Shipping Cost (+)</td>
									<td>INR {{$shippingCharge}}</td>										
								</tr>
								
								<tr class="shipping-cost">
									<td>Discount Amount (-)</td>
									<td>
									@if(empty(Session::get('couponAmount')))
									0
									@else
									{{Session::get('couponAmount')}}
									@endif
									</td>										
								</tr>
								
								<tr>
									<td>Total</td>
									<td><span>{{ $grandTotal = $total + $shippingCharge - Session::get('couponAmount')}}</span></td>
								</tr>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<form name="paymentForm" id="paymentForm" method="post" action="{{url('place-order')}}">
			{{csrf_field()}}
			<div class="payment-options">
				<input type="hidden" name="grandTotal" value="{{$grandTotal}}">
				<input type="hidden" name="coupon" value="{{Session::get('coupon')}}">
				<input type="hidden" name="shipping_charges" value="{{$shippingCharge}}">
				<input type="hidden" name="couponAmount" value="{{Session::get('couponAmount')}}">
				<span>
					<label><strong>Select Payment Method</strong></label>
				</span>
				<span>
					<label><input type="checkbox" name="paymentMethod" id="cod" value="COD"><strong>COD</strong></label>
				</span>
				<span>
					<label><input type="checkbox" name="paymentMethod" id="paypal" value="paypal"><strong>Paypal</strong></label>
				</span>
				<span>
					<label><input type="checkbox" name="paymentMethod" id="payumoney" value="payumoney"><strong>pay Umoney</strong></label>
				</span>
				<span>
					<input style="float:right;" type="submit" value="Place Order" class="btn btn-primary add-to-cart" onclick="return placeOrder()">
				</span>
			</div>
		</form>
	</div>
</section>

@endsection()