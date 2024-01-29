$(document).ready(function(){
	
       var updatePartyForm = $("#updateParty");
	     var validator = updatePartyForm.validate({
		rules:{
            party_name : { required : true},
			email : {  email : true },
            party_address :{ required : true },
            contact_number_one : { required : true, digits : true },
           
		},
		messages:{
			party_name : { required : "This field is required" },
			email : { email : "Please enter valid email address" },
            party_address :{ required : "This field is required" },
            contact_number_one : { required : "This field is required", contact_number : "Please enter valid mobile number"},
           
		}
    });
      

      








});
