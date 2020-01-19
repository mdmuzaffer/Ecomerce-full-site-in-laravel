<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # {{$UsersOrderview->id}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{$UserDetail->name}}<br>
					    {{$UserDetail->email}}<br>
					    {{$UserDetail->address}}<br>
					    {{$UserDetail->city}}<br>
					    {{$UserDetail->state}}<br>
					    {{$UserDetail->country}}<br>
					    {{$UserDetail->pincode}}<br>
					    {{$UserDetail->mobile}}
						
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					
						{{$UsersOrderview->name}}<br>
					    {{$UsersOrderview->user_email}}<br>
					    {{$UsersOrderview->address}}<br>
					    {{$UsersOrderview->city}}<br>
					    {{$UsersOrderview->state}}<br>
					    {{$UsersOrderview->country}}<br>
					    {{$UsersOrderview->pincode}}<br>
					    {{$UsersOrderview->mobile}}
						
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					{{$UsersOrderview->payment_method}}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{$UsersOrderview->created_at}}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Coupan</strong></td>
        							<td class="text-center"><strong>Size</strong></td>
        							<td class="text-center"><strong>Color</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<?php
								$Subtotal =0;
								?>
								@foreach($UsersOrderview->orders as $order)
								<tr>
    								<td>{{$order->product_code}} ({{$order->product_name}})</td>
									@if(!empty($UsersOrderview->coupon_code))
    								<td class="text-center">{{$UsersOrderview->coupon_code}}</td>
									@else
									<td class="text-center">No</td>
									@endif
    								<td class="text-center">{{$order->product_size}}</td>
    								<td class="text-center">{{$order->product_color}}</td>
    								<td class="text-center">INR {{$order->product_price}}</td>
    								<td class="text-center">{{$order->product_quantity}}</td>
    								<td class="text-right">{{$order->product_quantity * $order->product_price}}</td>
    							</tr>
								<?php $Subtotal = $Subtotal + ($order->product_quantity * $order->product_price);?>
								@endforeach
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">{{$Subtotal}}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping (+)</strong></td>
    								<td class="no-line text-right">INR {{$UsersOrderview->shipping_charges}}</td>
    							</tr>
								
								<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Discount (-)</strong></td>
									
									@if(!empty($UsersOrderview->coupon_amount))
    								<td class="no-line text-right">INR {{$UsersOrderview->coupon_amount}}</td>
									<?php $couponAmount = $UsersOrderview->coupon_amount;?>
									@else
										<td class="no-line text-right">INR 0</td>
										<?php $couponAmount = 0;?>
									@endif
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">INR {{$Subtotal + $UsersOrderview->shipping_charges - $couponAmount}}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>