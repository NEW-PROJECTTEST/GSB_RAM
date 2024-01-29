jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteEmployee", function(){
		var employee_id = $(this).data("employee_id"),
			hitURL = baseURL + "deleteEmployee",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Employee ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { employee_id : employee_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Employee successfully deleted"); }
				else if(data.status = false) { alert("Employee deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	

	
});
