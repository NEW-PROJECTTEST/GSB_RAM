jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteExpense", function(){
		var expense_id = $(this).data("expense_id"),
			hitURL = baseURL + "deleteExpense",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Expense ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { expense_id : expense_id } 
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
