$(document).ready(function(){
	
       var updateCashLedgerForm = $("#updateCashLedger");
	     var validator = updateCashLedgerForm.validate({
		rules:{
            party_name : { required : true},
            cash_amount :{ required : true },
           
		},
		messages:{
            party_name : { required : "This field is required" },
            cash_amount :{ required : "This field is required" },
          
           
		}
    });
      

      
});
