jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteFamily", function(){
		var family_id = $(this).data("family_id"),
			hitURL = baseURL + "deleteFamily",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Family ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { family_id : family_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Family successfully deleted"); }
				else if(data.status = false) { alert("Family deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	

	
});
