$(document).ready(function(){
    jQuery(document).on("click", ".deleteWheel", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteWheel",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Wheel Details ?");
		
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
				if(data.status = true) { alert("Wheel Details successfully deleted"); }
				else if(data.status = false) { alert("Wheel Details deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
});