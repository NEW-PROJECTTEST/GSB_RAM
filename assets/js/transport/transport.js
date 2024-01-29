$(document).ready(function(){
	
       var addTransportForm = $("#addTransport");
	     var validator = addTransportForm.validate({
		rules:{
			vehicle_number : { required : true, selected : true},
			party_name : {  required : true, selected : true },
			invoice_number :{ required : true },
			LR_no :{ required : true },
			bags :{ required : true },
			mt :{ required : true },
			destination :{ required : true },
			rate :{ required : true },
			amount :{ required : true },
			// loading_charge :{ required : true },
			// unloading_charge :{ required : true },
			// roro :{ required : true },
			ponch_amount :{ required : true },
			// narration :{ required : true },
			ponch_pending :{ required : true,selected : true },

		},
		messages:{
			vehicle_number : { required : "This field is required", selected : "Please select Vehicle" },
			party_name : { required : "This field is required" , selected : "Please select Party" },
			invoice_number :{ required : "This field is required" },
			LR_no :{ required : "This field is required" },
			bags :{ required : "This field is required" },
			mt :{ required : "This field is required" },
			destination :{ required : "This field is required" },
			rate :{ required : "This field is required" },
			amount :{ required : "This field is required" },
			// loading_charge :{ required : "This field is required" },
			// unloading_charge :{ required : "This field is required" },
			// roro :{ required : "This field is required" },
			ponch_amount :{ required : "This field is required" },
			// narration :{ required : "This field is required" },
			ponch_pending :{ required : "This field is required", selected : "Please select any option" }

		}
	});
	
			var updateTransportForm = $("#updateTransport");
			var validator = updateTransportForm.validate({
				rules:{
					vehicle_number : { required : true, selected : true},
					party_name : {  required : true, selected : true },
					invoice_number :{ required : true },
					LR_no :{ required : true },
					bags :{ required : true },
					mt :{ required : true },
					destination :{ required : true },
					rate :{ required : true },
					amount :{ required : true },
					// loading_charge :{ required : true },
					// unloading_charge :{ required : true },
					// roro :{ required : true },
					ponch_amount :{ required : true },
					// narration :{ required : true },
					ponch_pending :{ required : true,selected : true },
				   
				},
				messages:{
					vehicle_number : { required : "This field is required", selected : "Please select Vehicle" },
					party_name : { required : "This field is required" , selected : "Please select Party" },
					invoice_number :{ required : "This field is required" },
					LR_no :{ required : "This field is required" },
					bags :{ required : "This field is required" },
					mt :{ required : "This field is required" },
					destination :{ required : "This field is required" },
					rate :{ required : "This field is required" },
					amount :{ required : "This field is required" },
					// loading_charge :{ required : "This field is required" },
					// unloading_charge :{ required : "This field is required" },
					// roro :{ required : "This field is required" },
					ponch_amount :{ required : "This field is required" },
					// narration :{ required : "This field is required" },
					ponch_pending :{ required : "This field is required", selected : "Please select any option" }
				   
				}
			});

      jQuery(document).on("click", ".deleteTransport", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteTransport",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Transport ?");
		
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
				if(data.status = true) { alert("Transport successfully deleted"); }
				else if(data.status = false) { alert("Transport deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
});
