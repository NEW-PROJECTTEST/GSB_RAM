jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteDevotee", function(){
		var devotee_id = $(this).data("devotee_id"),
			hitURL = baseURL + "deleteDevotee",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Devotee ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { devotee_id : devotee_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Devotee successfully deleted"); }
				else if(data.status = false) { alert("Devotee deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	

	
});
