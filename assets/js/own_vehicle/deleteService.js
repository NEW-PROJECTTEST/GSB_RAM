$(document).ready(function(){
    jQuery(document).on("click", ".deleteService", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteService",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Service Details ?");
		
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
				if(data.status = true) { alert("Service Details successfully deleted"); }
				else if(data.status = false) { alert("Service Details deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
});