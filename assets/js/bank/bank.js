$(document).ready(function(){
	
       var updateBankForm = $("#updateBank");
	     var validator = updateBankForm.validate({
		rules:{
			bank_name : { required : true},
			bank_account_number :{ required : true }, 
			branch_name :{ required : true },          
            IFSC_code :{ required : true },
			bank_contact : { required : true, digits : true },
			account_type : { required : true, selected : true}
           
		},
		messages:{
			bank_name : { required : "This field is required" },
			bank_account_number :{ required : "This field is required" },
			branch_name :{ required : "This field is required" },
            IFSC_code :{ required : "This field is required" },
			bank_contact : { required : "This field is required", contact_number : "Please enter valid mobile number"},
			account_type : { required : "This field is required", selected : "Please select Account Type" }
           
		}
    });
      

    
});
