jQuery(document).ready(function(){
	$("#password_update").on('click',function(){
		//alert('Hello122'); 
		var username = $("#username").val();
		var current_password = $("#current_password").val();
		var new_password = $("#new_password").val();
		var conform_password = $("#conform_password").val();
	    var site_url = $('#site_url').val();
	    var site_url = site_url+'/admin/passwordChange';
		 $.ajaxSetup({
           headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
        });
		$.ajax({
	    	url: site_url, 
	    	type: "POST",             
	    	data: {current_password:current_password,new_password:new_password,conform_password:conform_password},
            dataType: "json",
	    	success: function(data){
				console.log(data);
	      		if(data.success =='0'){
					//$(".result").html(data.message);
		        	$(".result").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text denger" style="color:#ef1d08;">'+data.message+'</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
				}
				if(data.success =='1'){
				  $(".result").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text" style="color:#ef1d08;">'+data.message+'</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
				}
				if(data.success =='2'){
				  $(".result").html('<div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text" style="color:#ef1d08;">'+data.message+'</div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div>');
				}
	    	}
	  	});
		
	});
	
// add attribute  dynamically on click
	var maxField = 4; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="sku[]" id="sku" placeholder="Sku" style="width:120px;"/>'+
	' <input type="text" name="size[]" id="size" placeholder="Size" style="width:120px;"/>'+
	' <input type="text" name="price[]" id="price" placeholder="Price" style="width:120px;"/>'+
	' <input type="text" name="stock[]" id="stock" placeholder="Stock" style="width:120px;"/>'+
	' <a href="javascript:void(0);" class="remove_button">'+
	' <i class="fa fa-close" style="font-size:18px;color:red"></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
		//alert("Hello");
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
	
	// admin type change jQuery
	$('#access').hide();
	$('#type').change(function(){
		var adminType = $('#type').val();
		if(adminType =='Admin'){
			$('#access').hide();
		}else{
			$('#access').show();
		}
	  //alert(adminType);
	});
	
	// admin edit change select option
	$('#typeEdit').change(function(){
		var adminType = $('#typeEdit').val();
		if(adminType =='Admin'){
			$('#accessEdit').hide();
		}else{
			$('#accessEdit').show();
		}
	});
	
});

//add product form validation.
function addProducts(){
	var category_name = $("#category_name").val();
	var product_name = $("#product_name").val();
	var product_code = $("#product_code").val();
	var product_color = $("#product_color").val();
	var product_price = $("#product_price").val();
	var file = $("#file").val();
	var product_description = $("#product_description").val();
	
	if(category_name=="" || product_name=="" || product_code=="" ||product_color=="" || product_price=="" || file=="" || product_description==""){
		$(".validation_error").html(",All fields are Mandatory !");
	}
	
}

// product view on popup 
	function productView(id){
	var id = id;
	var url = window.location.href;
	var siteUrl = url.substr(0,url.lastIndexOf('/') + 1);
	//alert(siteUrl);
		 $.ajaxSetup({
           headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
        });
		$.ajax({
			type:'GET',
			url:siteUrl+'view-products-popup',
			dataType: 'json',
			data:{id:id},
			success:function(response){
			//console.log(response);
				if(response.success =='1'){
					$('#popup_result').html(response.message);
				}
			
			}
		});
	}
	
// product delete by sweet alert
	function productDelet(id,products){
	var id = id;
	var deleteFunction = products;
	//alert(products);
	swal({
	  title: "Are you sure?",
	  text: "You will not be able to recover this product!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Yes, delete it!",
	  cancelButtonText: "No, cancel plx!",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm){
	if (isConfirm) {
	var url = window.location.href;
	var siteUrl = url.substr(0,url.lastIndexOf('/') + 1);
	//window.location.href=siteUrl+deleteFunction+'/'+id;
	$.ajaxSetup({
           headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
    });
		$.ajax({
			type:'GET',
			url:siteUrl+deleteFunction+'/'+id,
			dataType: 'json',
			data:{id:id},
			success:function(response){
			
			}
		});
	
    swal("Deleted!", "Your imaginary product has been deleted.", "success");
	}else {
		swal("Cancelled", "Your product file is safe :)", "error");
	  }
	});
 }
 // validation for attribute dynamically product
 $("#add-attribute").click(function(e){
	var sku = $("#sku").val();
	var size = $("#size").val();
	var price = $("#price").val();
	var stock = $("#stock").val();
	if(sku=="" || size=="" || price=="" || stock==""){
	$(".result_message").html('All fields are mandatery !');
	return false;
	}
 });
// delete products attribur 
  function attributetDelet(DelId){
	var DelId = DelId;
	//alert(DelId);
	var del = confirm("Are you sure want to delete attribute?");
	if (del == true) {
	var url = window.location.href;
	var siteUrl = url.substr(0,url.lastIndexOf('/') -19);
	var siteUrl = siteUrl+'products-attribute-delete';
	//alert(siteUrl);
		$.ajaxSetup({
			   headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
		});
		$.ajax({
			type:'POST',
			url:siteUrl,
			dataType: 'json',
			data:{DelId:DelId},
			success:function(response){
			//console.log(response);
			$(".delResult").html('<span style="color:#7460ee">'+response.message+'</span>');
			 attributeData();
			}
		});
	}else{
		alert('Ok not Delete your product attribute !')
	}
 }
 
 function attributeData(){
	location.reload();	
}
 
 //Multiple  Delete Attribute
function MultipletDelet(){
	var multId = [];
        $.each($("input[name='delId[]']:checked"), function(){            
            multId.push($(this).val());
        });
	swal({
	  title: "Are you sure?",
	  text: "You will not be able to recover selected attribute!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Yes, delete it!",
	  cancelButtonText: "No, cancel plx!",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm){
	if (isConfirm) {
	var url = window.location.href;
	var siteUrl = url.substr(0,url.lastIndexOf('/') -19);
	var siteUrl = siteUrl+'products-attribute-deletes';
	//alert(siteUrl);
	$.ajaxSetup({
           headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
    });
	$.ajax({
		type:'POST',
		url:siteUrl,
		dataType: 'json',
		data:{multId:multId},
		success:function(response){
		//console.log(response);
		$(".delResult").html('<span style="color:#7460ee">'+response.message+'</span>');
		setInterval(function(){ attributeData(); }, 5000);
		}
	});
	    swal("Deleted!", "Your selected attribute deleted.", "success");
	}else {
		swal("Cancelled", "Your selected attribute is safe :)", "error");
	  }
	});
}
// CMS page view in table row with popup
function pageView(id){
	var id = id;
	var rowid = $("#"+id).closest("tr"); 
	var pageid = rowid.find("td:eq(0)").text(); 
	var title = rowid.find("td:eq(1)").text();
	var descrption = rowid.find("td:eq(2)").text();
	var url = rowid.find("td:eq(3)").text();
	var status = rowid.find("td:eq(4)").text();
	var data=  'ID:'+id+"<br>"+'TITLE:'+title+"<br>"+'DESCRIPTION:'+descrption+"<br>"+'URL:'+url+"<br>"+'STATUS:'+status;
	$("#cmspage_result").html(data);
}


