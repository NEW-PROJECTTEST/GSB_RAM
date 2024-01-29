$(document).ready(function(){
	
       var addOwnVehicleForm = $("#addOwnVehicle");
	     var validator = addOwnVehicleForm.validate({
		rules:{
            vehicle_number : { required : true}
			// fc_date : { required : true},
			// road_tax_date : { required : true},
			// insurance_date : { required : true},
			// karnataka_permit_date : { required : true},
			// national_permit_date : { required : true},
			// emission_date : { required : true}
           
		},
		messages:{
			vehicle_number : { required : "This field is required" }
			// fc_date :{ required : "This field is required" },
			// road_tax_date :{ required : "This field is required" },
			// insurance_date :{ required : "This field is required" },
			// karnataka_permit_date :{ required : "This field is required" },
			// national_permit_date :{ required : "This field is required" },
			// emission_date :{ required : "This field is required" }
          
           
		}
	});
	
		var updateOwnVehicleForm = $("#updateOwnVehicle");
			var validator = updateOwnVehicleForm.validate({
				rules:{
					vehicle_number : { required : true}
					// fc_date : { required : true},
					// road_tax_date : { required : true},
					// insurance_date : { required : true},
					// karnataka_permit_date : { required : true},
					// national_permit_date : { required : true},
					// emission_date : { required : true}
				   
				},
				messages:{
					vehicle_number : { required : "This field is required" }
					// fc_date :{ required : "This field is required" },
					// road_tax_date :{ required : "This field is required" },
					// insurance_date :{ required : "This field is required" },
					// karnataka_permit_date :{ required : "This field is required" },
					// national_permit_date :{ required : "This field is required" },
					// emission_date :{ required : "This field is required" }
				  
				}
			});

      jQuery(document).on("click", ".deleteOwnVehicle", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteOwnVehicle",
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

	jQuery(document).on("click", ".deleteFuel", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteFuel",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Fuel Details ?");
		
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
				if(data.status = true) { alert("Fuel Details successfully deleted"); }
				else if(data.status = false) { alert("Fuel Details deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	// jQuery(document).on("click", ".deleteService", function(){
	// 	var row_id = $(this).data("row_id"),
	// 		hitURL = baseURL + "deleteService",
	// 		currentRow = $(this);
		
	// 	var confirmation = confirm("Are you sure to delete this Service Details ?");
		
	// 	if(confirmation)
	// 	{
	// 		jQuery.ajax({
	// 		type : "POST",
	// 		dataType : "json",
	// 		url : hitURL,
	// 		data : { row_id2 : row_id2 } 
	// 		}).done(function(data){
	// 			console.log(data);
	// 			currentRow.parents('tr').remove();
	// 			if(data.status = true) { alert("Service Details successfully deleted"); }
	// 			else if(data.status = false) { alert("Service Details deletion failed"); }
	// 			else { alert("Access denied..!"); }
	// 		});
	// 	}
	// });
});
