
$(document).ready(function(){
	var addUserForm = $("#addDevotee");
	var validator = addUserForm.validate({
		rules:{
            devotee_id :{ required : true,remote : { url : baseURL + "checkDevoteeIDExists", type :"post"} },
            devotee_name :{ required : true },
            // dob :{ required : true },
            gender : { required : true, selected : true},
			email : {  email : true },
            contact_number : { required : true, digits : true },
            alternative_contact_number : { digits : true },
            type : { required : true, selected : true},
            role_id : { required : true, selected : true},
            devotee_address :{ required : true }
		
		},
		messages:{
            devotee_id :{ required : "This field is required", remote : "Empployee ID is already registered" },
            devotee_name :{ required : "This field is required" },
            // dob :{ required : "This field is required" },
            gender : { required : "This field is required", selected : "Please select Gender" },
			email : { email : "Please enter valid email address" },
            contact_number : { required : "This field is required", contact_number : "Please enter valid mobile number"},
            alternative_contact_number : {digits : "Please enter numbers only" },
            type : {required : "This field is required", selected : "Please select Committee type" },
            role_id : { required : "This field is required", selected : "Please select Role" },
            devotee_address :{ required : "This field is required" }			
		}
    });
    
});