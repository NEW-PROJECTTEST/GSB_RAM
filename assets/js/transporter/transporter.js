$(document).ready(function(){
	
       var addTransporterForm = $("#addTransporter");
	     var validator = addTransporterForm.validate({
		rules:{
           
			transporter_name : { required : true},
			transporter_account_number: { required : true},
			email : {  email : true },
			transporter_address :{ required : true },
            contact_number : { required : true, digits : true }
           
		},
		messages:{
			
			transporter_name : { required : "This field is required" },
			transporter_account_number : { required : "This field is required" },
			email : { email : "Please enter valid email address" },
			transporter_address :{ required : "This field is required" },
            contact_number : { required : "This field is required", contact_number : "Please enter valid mobile number"}
          
           
		}
	});
	
			var updateTransporterForm = $("#updateTransporter");
			var validator = updateTransporterForm.validate({
				rules:{
					
					transporter_name : { required : true},
					transporter_account_number: { required : true},
					email : {  email : true },
					transporter_address :{ required : true },
					contact_number : { required : true, digits : true }
				   
				},
				messages:{
				
					transporter_name : { required : "This field is required" },
					transporter_account_number : { required : "This field is required" },
					email : { email : "Please enter valid email address" },
					transporter_address :{ required : "This field is required" },
					contact_number : { required : "This field is required", contact_number : "Please enter valid mobile number"}
				  
				   
				}
			});

      jQuery(document).on("click", ".deleteTransporter", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteTransporter",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Transporter ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Transporter successfully deleted"); }
				else if(data.status = false) { alert("Transporter deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
});
