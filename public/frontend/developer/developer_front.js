$("#sizeId").change(function(){
	var sizeId = $(this).val();
	var siteUrl = window.location.origin;
	var urls = siteUrl+'/ecommerce/public/price';

	$.ajax({
		type:'GET',
		url:urls,
		data:{'sizeIds':sizeId},
		success:function(response){
			if(response.success =='1'){
			$("#attribute_price").html('INR '+response.price);
			$("#currDoller").html('USD '+response.price1);
			$("#currDoller1").html('GBP '+response.price2);
			$("#currDoller2").html('EUR '+response.price3);
			var price = $("#attribute_price").html();
			$("#product_price_hidden").val(price);
			$("#attribute_stock").html(response.stock);
			$("#attribute_sku").html(response.sku);
			var sku = $("#attribute_sku").html();
			$("#product_code").val(sku);
			console.log(response.price1);
			}
		var stockValue = $("#attribute_stock").text()
		//alert(stockValue);
			if(stockValue<=0){
				$("#add_cart").css("display","none");
				$("#availability").html('<b>Availability: </b><span id="attribute_stock" style="color:#FE980F;">Out of stock');
			}else{
				$("#add_cart").css("display","block");
				$("button#add_cart").css("float","right");
			}
		}
		
	});
	
});
// mouse hover change images
$(document).ready(function(){
	$(".carousel").mouseover(function(e){
	var target = $(e.target);
    var elId = target.attr('id');
	var imgsrc = $('#'+elId).attr('src');
	$('#change_images').attr('src', imgsrc);
		//alert(imgsrc);
	});
			// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});

		// Setup toggles example
		var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

		$('.toggle').on('click', function() {
			var $this = $(this);

			if ($this.data("active") === true) {
				$this.text("Switch on").data("active", false);
				api2.teardown();
			} else {
				$this.text("Switch off").data("active", true);
				api2._init();
			}
		});
	//get all total value of the cart.

	var totalPrise=0;
	$('.table-condensed tr').each(function() {
		var customerId = $(this).find(".cart_total_price").html();
		
		if(customerId!=null){
			totalPrise+= parseInt(customerId);
		}
	});
	$("#show_totalPrice").html("INR "+totalPrise);
	//alert(totalPrise);
	
	
	//user register validation jquery
	$("#signup").validate({
		rules:{
			name:{
				required:true,
				minlength:6,
				accept:"[a-zA-Z]+"
			},
			email:{
				required:true,
				email:true,
				minlength:10,
				remote:"/ecommerce/public/check-email"
			},
			password:{
				required:true,
				minlength:8
			}
		
		},
messages:{
			name:{
				required:"Please enter your name", 
				minlength:"Minimum value 6 character",
				accept:"Please enter only character"
				
			},
			email:{
				required:"Please enter your email",
				email:"Please enter valide email",
				minlength:"Minimum 10 character email",
				remote:"Your enter email already exists"
			},
			password:{
				required:"Please enter your password",
				minlength:"Minimum 8 character password required"
			}
		}
	});
	
	//user login validation jquery
	$("#userLogin").validate({
		rules:{
			userEmail:{
				required:true,
				email:true
			},
			userPassword:{
				required:true
			}
		
		},
messages:{
			userEmail:{
				required:"Please enter your email Id !",
				email:"Please enter valide email Id !"
			},
			userPassword:{
				required:"Please enter your password"
			}
		}
	});
	
	
	//user password update validation jquery
	$("#PasswordUpdate").validate({
		rules:{
			oldpass:{
				required:true,
				remote:"/ecommerce/public/check-password"
			},
			newpass:{
				required:true
			},
			confpass:{
				required:true,
				equalTo:"#newpass"
			}
		
		},
messages:{
			oldpass:{
				required:"Please enter your old password",
				remote:"Your current password not match"
			},
			newpass:{
				required:"Please enter your new password"
			},
			confpass:{
				required:"Please enter your confirm password",
				equalTo:"Please enter your confirm same as new password"
			}
		}
	});
	
	
	
});

// use coupan code in cart page
	$(".answer").hide();
	function valueChanged(){
		if($('.coupon_question').is(":checked"))   
			$(".answer").show();
		else
			$(".answer").hide();
	}
	
	//coupon apply by ajax 
	$("#coupon_btn").on('click',function(e){
		var coupanName = $("#coupon_field").val();
		//alert(coupanName);
		var siteUrl = window.location.origin;
		var couponUrl = siteUrl+'/ecommerce/public/coupon-apply';
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type:'GET',
			url:couponUrl,
			data:{'coupon_name':coupanName},
			success:function(response){
				if(response.success =='1'){
					//alert(response.couponMessage);
					$(".coupon_message").html('<div class="alert alert-danger" style="margin-top:-72px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+response.couponMessage+'</strong></div>');
				}
				if(response.error =='1'){
					//alert(response.couponMessage);
					$(".coupon_message").html('<div class="alert alert-danger" style="margin-top:-72px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong style="color:green">'+response.errorMessage+'</strong></div>');
				}
				if(response.error =='2'){
					//alert(response.couponMessage);
					$(".coupon_message").html('<div class="alert alert-danger" style="margin-top:-72px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong style="color:green">'+response.errorMessage+'</strong></div>');
				}
				
				if(response.error =='3'){
					
					$(".coupon_message").html('<div class="alert alert-danger" style="margin-top:-72px;"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong style="color:green">Your coupon code is active applied ! INR '+response.errorMessage+'</strong></div>');
					window.setTimeout(function(){location.reload()},1000)
				}
			}
		});
	});
	
	
// user frontent login user password show jquery
	$('.toggle-password').click(function(e){
		var type = $(".userShow").attr("type");
			if (type == "password") {
			$('.userShow').attr("type", "text");
			}else {
			$('.userShow').attr("type", "password");
			}
	});
	
	
//user password update validation is above with ID PasswordUpdate
 $('#PasswordUpdate').submit(function(e){
        e.preventDefault();
		var oldpass = $("#oldpass").val();
		var newpass = $("#newpass").val();
		var confpass = $("#confpass").val();
		var siteUrl = window.location.origin;
		var urls_uppass = siteUrl+'/ecommerce/public/user-password-update';
		 $.ajaxSetup({
           headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
        });
		$.ajax({
			type:"POST",
			url:urls_uppass,
			dataType: 'json', 
			data:{oldpass:oldpass,newpass:newpass,confpass:confpass},
				success:function(response){
					//console.log(response);
					if(response.success =='0'){
						//$("#curr_passUpdate").html(response.message);
						$("#curr_passUpdate").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+response.message+'</strong></div>');
					}
				}
		
		});
		
 });
 
 //Billing checkout from check box 
 $(".shipping-checkoutbox").click(function() {
	  if(this.checked) {
          var name =  $("#billing_name").val();
		  $("#shipping_name").val(name);
		  
		   var address =  $("#billing_address").val();
		  $("#shipping_address").val(address);
		  
		   var city =  $("#billing_city").val();
		  $("#shipping_city").val(city);
		  
		   var state =  $("#billing_state").val();
		  $("#shipping_state").val(state);
		  
		   var country =  $("#billing_country option:selected").text();
		  $("#shipping_country").val(country);
		  $("#shipping_country").text(country);
		  
		   var pincode =  $("#billing_pincode").val();
		  $("#shipping_pincode").val(pincode);
		  
		   var mobile =  $("#billing_mobile").val();
		  $("#shipping_mobile").val(mobile);
		  
        }
 });
 
 // place oder button click and place oder of selected products 
 function placeOrder(){
	 if($("#cod").is(':checked') || $("#paypal").is(':checked') ||$("#payumoney").is(':checked')){
		alert("Are you ready to palace order ?"); 
	 }else{
		 alert("Your are not selected payment method");
		 return false;
	 }
	 return true;
 }
 
 //check pincode avalibility in detail.blade products page 
 function checkPin(){
	var pincode = $("#pincode").val();
	var siteUrl = window.location.origin;
	var url_pincode = siteUrl+'/ecommerce/public/pincode-check';
	 if(pincode ==""){
		 alert("Pin code reqired");
		 return fale;
	 }else{
		$.ajaxSetup({
           headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
        });
		$.ajax({
			type:"POST",
			url:url_pincode, 
			data:{'pincode':pincode},
				success:function(response){
					if(response.success =='1'){
						$("#pinResult").html('<span style="color:green">'+response.pinMessage+'</span>');
					}
					
					if(response.error =='1'){
						$("#pinResult").html('<span style="color:red">'+response.pinMessage+'</span>');
					}
				}
		});
	 }
	 
 }
 // Newsletter
 $("#newsletterForm").click(function(){
	var emailUser = $('#neswletter').val();
	
	var siteUrl = window.location.origin;
	var newsletterUrl = siteUrl+'/ecommerce/public/subscribe-newsletter';
	$.ajaxSetup({
    headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
	});
	$.ajax({
        type: "POST",
		url: newsletterUrl,
        data: { email : emailUser},
        success: function(response){
			if(response.success =='1'){
				$("#newsletterMsg").html('<span style="color:green">'+response.message+'</span>');
			}
			if(response.success =='2'){
				$("#newsletterMsg").html('<span style="color:red">'+response.message+'</span>');
			}
        }
    });
 });