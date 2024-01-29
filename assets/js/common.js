/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "deleteUser",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this user ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteRole", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteRole",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Role?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Role successfully deleted"); }
				else if(data.status = false) { alert("Role deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteRelation", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteRelation",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Relation?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Relation successfully deleted"); }
				else if(data.status = false) { alert("Relation deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteAsset", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteAsset",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Asset?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Asset successfully deleted"); }
				else if(data.status = false) { alert("Asset deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteAssetInfo", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteAssetInfo",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Asset?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Asset successfully deleted"); }
				else if(data.status = false) { alert("Asset deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	
	jQuery(document).on("click", ".deleteYearInfo", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteYearInfo",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Year?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Year successfully deleted"); }
				else if(data.status = false) { alert("Year deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	
	jQuery(document).on("click", ".deleteSubscriptionInfo", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteSubscriptionInfo",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Amount?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Amount successfully deleted"); }
				else if(data.status = false) { alert("Amount deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	jQuery(document).on("click", ".deleteDepreciationInfo", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteDepreciationInfo",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Depreciation?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Depreciation successfully deleted"); }
				else if(data.status = false) { alert("Depreciation deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	jQuery(document).on("click", ".deleteIncomeType", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteIncomeType",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Income Type?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Income Type successfully deleted"); }
				else if(data.status = false) { alert("Income Type deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});



// //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	jQuery(document).on("click", ".deleteGothra", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteGothra",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Gothra?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Gothra successfully deleted"); }
				else if(data.status = false) { alert("Gothra deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteNakshathra", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteNakshathra",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Nakshathra?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Nakshathra successfully deleted"); }
				else if(data.status = false) { alert("Nakshathra deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteMasa", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteMasa",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Masa?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Masa successfully deleted"); }
				else if(data.status = false) { alert("Masa deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteTithi", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteTithi",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Tithi?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Tithi successfully deleted"); }
				else if(data.status = false) { alert("Tithi deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteRashi", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteRashi",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Rashi?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Rashi successfully deleted"); }
				else if(data.status = false) { alert("Rashi deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteCommittetype", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteCommittetype",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Committetype?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Committetype successfully deleted"); }
				else if(data.status = false) { alert("Committetype deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteEventtype", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteEventtype",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Event?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Event successfully deleted"); }
				else if(data.status = false) { alert("Event deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});


	jQuery(document).on("click", ".deleteExpenseName", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteExpenseName",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Expense Name?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Expense Name successfully deleted"); }
				else if(data.status = false) { alert("Expense Name deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteOccation", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteOccation",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Occation?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Occation successfully deleted"); }
				else if(data.status = false) { alert("Occation deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deletePaksha", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deletePaksha",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Paksha?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Paksha successfully deleted"); }
				else if(data.status = false) { alert("Paksha deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});



	jQuery(document).on("click", ".deleteDonationDetail", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteDonationDetail",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Donation Detail?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Donation Detail successfully deleted"); }
				else if(data.status = false) { alert("Donation Detail deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deletePurpose", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deletePurpose",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Purpose Detail?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Purpose Detail successfully deleted"); }
				else if(data.status = false) { alert("Purpose Detail deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});


	jQuery(document).on("click", ".deleteSevaDetail", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteSevaDetail",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Seva Detail?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Seva Detail successfully deleted"); }
				else if(data.status = false) { alert("Seva Detail deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});



	jQuery(document).on("click", ".deleteDonationType", function(){
		var row_id = $(this).data("row_id"),
			hitURL = baseURL + "deleteDonationType",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Donation Type?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { row_id : row_id } 
			}).done(function(data){
					
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Donation Type successfully deleted"); }
				else if(data.status = false) { alert("Donation Type deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
});
