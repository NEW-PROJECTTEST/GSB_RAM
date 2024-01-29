$(document).ready(function(){
    jQuery(document).on("click", ".deleteTrip", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteTrip",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Trip Details ?");
		
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
				if(data.status = true) { alert("Trip Details successfully deleted"); }
				else if(data.status = false) { alert("Trip Details deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
});