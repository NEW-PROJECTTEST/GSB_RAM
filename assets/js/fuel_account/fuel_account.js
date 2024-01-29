$(document).ready(function(){
	
 


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


jQuery(document).on("click", ".deleteFuelAccountCashInfo", function(){
var fuel_id = $('#fuel_account_id').val();
var row_id = $(this).data("row_id"),
    hitURL = baseURL + "deleteFuelAccountCashInfo",
    currentRow = $(this);

var confirmation = confirm("Are you sure to delete this Cash Details ?");

if(confirmation)
{
    jQuery.ajax({
    type : "POST",
    dataType : "json",
    url : hitURL,
    data : { row_id : row_id,
        fuel_id : fuel_id } 
    }).done(function(data){
        console.log(data);
        currentRow.parents('tr').remove();
        if(data.status = true) { alert("Cash successfully deleted"); }
        else if(data.status = false) { alert("Cash deletion failed"); }
        else { alert("Access denied..!"); }
    });
}
});


jQuery(document).on("click", ".deleteFuelAccount", function(){
    var row_id = $(this).data("row_id"),
        hitURL = baseURL + "deleteFuelAccount",
        currentRow = $(this);
    
    var confirmation = confirm("Are you sure to delete this Fuel Account ?");
    
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
            if(data.status = true) { alert("Fuel Account successfully deleted"); }
            else if(data.status = false) { alert("Fuel Account deletion failed"); }
            else { alert("Access denied..!"); }
        });
    }
    });

    
});
