
$(document).ready(function(){
	var addUserForm = $("#addEmployee");
	var validator = addUserForm.validate({
		rules:{
            employee_id :{ required : true,remote : { url : baseURL + "checkEmployeeIDExists", type :"post"} },
            employee_name :{ required : true },
            dob :{ required : true },
            gender : { required : true, selected : true},
			email : {  email : true },
            contact_number : { required : true, digits : true },
            alternative_contact_number : { digits : true },
            role_id : { required : true, selected : true},
            employee_address :{ required : true }
		
		},
		messages:{
            employee_id :{ required : "This field is required", remote : "Empployee ID is already registered" },
            employee_name :{ required : "This field is required" },
            dob :{ required : "This field is required" },
            gender : { required : "This field is required", selected : "Please select Gender" },
			email : { email : "Please enter valid email address" },
            contact_number : { required : "This field is required", contact_number : "Please enter valid mobile number"},
            alternative_contact_number : {digits : "Please enter numbers only" },
            role_id : { required : "This field is required", selected : "Please select Role" },
            employee_address :{ required : "This field is required" }			
		}
    });
    
});