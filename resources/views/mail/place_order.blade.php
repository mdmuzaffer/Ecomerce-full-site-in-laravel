<html>
<header>
<title>Website Muzaffer E-com Website</title>
</header>
<body>
	<table width="750px">
		<tr><td>&nbsp;</td></tr>
		<tr><td><img src="{{asset('frontend/images/home/logo.png')}}"/></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Hello {{$name}},</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thank you for shopping with us Your order detail are as below.<br></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Order No:{{$order_id}}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
			<table width="100%" cellpadding="5" cellspacing="5" bgcolor="#e0d9d9">
				<tr bgcolor="#cccccc">
					<td>Product Name</td>
					<td>Product Code</td>
					<td>Size</td>
					<td>Color</td>
					<td>Quantity</td>
					<td>Unit Price</td>
				</tr>
				@foreach($orderDetail['orders'] as $product)
				<tr>
					<td>{{$product['product_name']}}</td>
					<td>{{$product['product_code']}}</td>
					<td>{{$product['product_size']}}</td>
					<td>{{$product['product_color']}}</td>
					<td>{{$product['product_quantity']}}</td>
					<td>{{$product['product_price']}}</td>
				</tr>
				@endforeach
				<tr>
					<td colspan="5" align="right">Shipping Charge</td>
					<td>INR {{$orderDetail['shipping_charges']}}</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Discount Coupon</td>
					<td>INR {{$orderDetail['coupon_amount']}}</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Grand Total</td>
					<td>INR {{$orderDetail['grand_total']}}</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Payment Method:</td>
					<td>{{$paymentMethod}}</td>
				</tr>
			</table>
		</td></tr>
		
		<tr><td>
			<table width="100%">
				<tr>
					<td width="50%">
						<table>
							<tr><td>Billing To:-</td></tr>	
							<tr><td>{{$userDetail['name']}}</td></tr>
							<tr><td>{{$userDetail['email']}}</td></tr>
							<tr><td>{{$userDetail['address']}}</td></tr>
							<tr><td>{{$userDetail['city']}}</td></tr>
							<tr><td>{{$userDetail['state']}}</td></tr>
							<tr><td>{{$userDetail['country']}}</td></tr>
							<tr><td>{{$userDetail['pincode']}}</td></tr>
							<tr><td>{{$userDetail['mobile']}}</td></tr>
						</table>
					</td>
					<td width="50%">
						<table>
							<tr><td>Shipping To:-</td></tr>	
							<tr><td>{{$orderDetail['name']}}</td></tr>
							<tr><td>{{$orderDetail['user_email']}}</td></tr>
							<tr><td>{{$orderDetail['address']}}</td></tr>
							<tr><td>{{$orderDetail['city']}}</td></tr>
							<tr><td>{{$orderDetail['state']}}</td></tr>
							<tr><td>{{$orderDetail['country']}}</td></tr>
							<tr><td>{{$orderDetail['pincode']}}</td></tr>
							<tr><td>{{$orderDetail['mobile']}}</td></tr>
						</table>
					</td>
				</tr>
			</table>
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thanks & Regards</td></tr>
		<tr><td>Muzaffer E-com Website</td></tr>
	</table>
</body>
</html>