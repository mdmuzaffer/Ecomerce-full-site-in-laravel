jQuery(document).ready(function(){
	$("#add_category").on('click',function(){
		var category = $("#category").val();
		var url = $("#url").val();
		var description = $("#description").val();
		if(category =="" || url=="" || description==""){
			$(".error_message").html('please required all field mandaterory !');
			//alert('please required');
			return false;
		}else{
			//alert('Now it is ok');
			$(".error_message").html('Your category submited!');
		}
	});
	
});

function updateCategory(id){
		var id = id;
		var rowid = $("#"+id).closest("tr"); 
		var upid = rowid.find("td:eq(0)").text(); 
		var ctegory = rowid.find("td:eq(1)").text(); 
		var updesc = rowid.find("td:eq(2)").text(); 
		var url = rowid.find("td:eq(3)").text(); 
		var catLevel = rowid.find("td:eq(4)").text(); 
		var status = rowid.find("td:eq(5)").text(); 
		$('#catlevel > option').each(function(){
		 if($(this).val()==catLevel) $(this).parent('select').val($(this).val())
		 })
	 
		$("#catlevel > option").each(function(){
		if ($(this).val() == catLevel)
		$(this).attr("selected","selected");
		});
		if(status ==1){
			$('#enable').prop('checked', true);
		}
		
		$("#upid").val(upid);
		$("#upcategory").val(ctegory);
		$("#updesc").val(updesc);
		$("#upurl").val(url);
		
	}

function ajaxupdateCategory(){
	var upid = $("#upid").val();
	var category = $("#upcategory").val();
	var url = $("#upurl").val();
	var updesc = $("#updesc").val();
	
	var enable =[];
	if($("#enable").is(':checked')){
		var checked = 1;
		enable.push(checked);
	}else{
		var unchecked = 0;
		enable.push(unchecked);
	}

	//var enable = $("#enable").val();
	//alert(enable);
	var catLevel = $('#catlevel').find(":selected").val();
	var siteUrl = window.location.origin;
	if(category=="" || url=="" || updesc==""){
		$("#exampleModalLabel").html('please required all field mandaterory !');
	}else{
		
		$.ajaxSetup({
		headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
		});
		
		$.ajax({
			url:siteUrl+'/ecommerce/public/admin/update-category',
			data:{'id':upid,'category':category,'url':url,'updesc':updesc,'catLevel':catLevel,'enable':enable},
			type:'POST',
			success:function(response){
				//showcategoryData();
				if(response['success'] == '1'){		
				$(".success_message").html('category update successfully'+' <i class="mdi mdi-check"></i>');
				}
			}
			
		});
	}
}

function showcategoryData(){
	location.reload();	
}


function deleteCategory(id){
	//alert(id);
	  var del = confirm("Are you sure want to delete ?");
	if (del == true) {
		var siteUrl = window.location.origin;
		$.ajaxSetup({
			headers:{ 'X-CSRF-Token': $('input[name="_token"]').val() }
			});
		$.ajax({
				url:siteUrl+'/ecommerce/public/admin/delete-category',
				data:{'id':id},
				type:'POST',
				success:function(response){
					showcategoryData();
					if(response['success'] == '1'){		
					$(".success_message").html('Delete update successfully'+' <i class="mdi mdi-check"></i>');
					}
				}
				
			});
			
	}else{
		alert("Ok not Delete your Category");
	}	

}