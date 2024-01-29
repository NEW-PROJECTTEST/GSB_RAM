$(document).ready(function(){
	
			var updateCashAccountForm = $("#updateCashAccount");
			var validator = updateCashAccountForm.validate({
				rules:{
					cash_account_name :{ required : true,selected : true },
					cash_account_type :{ required : true,selected : true }
				   
				},
				messages:{
					cash_account_name :{ required : "This field is required", selected : "Select Cash Account Name" },
					cash_account_type :{ required : "This field is required", selected : "Please Cash Account Type" }
				  
				   
				}
			});


			var transferCashDetailsForm = $("#transferCashDetails");
			var validator = transferCashDetailsForm.validate({
				rules:{
					transfer_cash_amount :{ required : true},
					from_cash_account_rowid :{ required : true,selected : true },
					to_cash_account_rowid :{ required : true,selected : true }
				   
				},
				messages:{
					transfer_cash_amount :{ required : "Amount is required"},
					from_cash_account_rowid :{ required : "Select from Cash Account", selected : "Select from Cash Account" },
					to_cash_account_rowid :{ required : "Select To Cash Account", selected : "Select To Cash Account" }
				  
				   
				}
			});


      jQuery(document).on("click", ".deleteTransferDetails", function(){
		var row_id = $(this).data("row_id");
		// var from_cash_account_rowid = $(this).data("from_cash_account_rowid");
		// var to_cash_account_rowid = $(this).data("to_cash_account_rowid"),
			hitURL = baseURL + "deleteTransferDetails",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Cash Transfer ?");
		
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
				if(data.status = true) { alert("Cash Transfer successfully deleted"); }
				else if(data.status = false) { alert("Cash Transfer deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});


	jQuery(document).on("click", ".deleteCashDetails", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteCashDetails",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Cash Details ?");
		
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
				if(data.status = true) { alert("Cash Details successfully deleted"); }
				else if(data.status = false) { alert("Cash Details deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	
	jQuery(document).on("click", ".deleteCashAccount", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteCashAccount",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Cash Account ?");
		
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
				if(data.status = true) { alert("Cash Account successfully deleted"); }
				else if(data.status = false) { alert("Cash Account deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

});
