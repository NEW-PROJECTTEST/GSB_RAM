$(document).ready(function(){
	
       var addLeaseVehicleForm = $("#addLeaseVehicle");
	     var validator = addLeaseVehicleForm.validate({
		rules:{
            vehicle_number : { required : true},
			transporter_name : { required : true},
			email : {  email : true },
            contact_number_one : { required : true, digits : true }
           
		},
		messages:{
			vehicle_number : { required : "This field is required" },
			transporter_name : { required : "This field is required" },
			email : { email : "Please enter valid email address" },
            contact_number_one : { required : "This field is required", contact_number : "Please enter valid mobile number"}
          
           
		}
	});
	
			var updateLeaseVehicleForm = $("#updateLeaseVehicle");
			var validator = updateLeaseVehicleForm.validate({
				rules:{
					vehicle_number : { required : true},
					transporter_name : { required : true},
					email : {  email : true },
					contact_number_one : { required : true, digits : true }
				   
				},
				messages:{
					vehicle_number : { required : "This field is required" },
					transporter_name : { required : "This field is required" },
					email : { email : "Please enter valid email address" },
					contact_number_one : { required : "This field is required", contact_number : "Please enter valid mobile number"}
				  
				   
				}
			});

      jQuery(document).on("click", ".deleteLeaseVehicle", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteLeaseVehicle",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Vehicle ?");
		
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
				if(data.status = true) { alert("Vehicle successfully deleted"); }
				else if(data.status = false) { alert("Vehicle deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
});
