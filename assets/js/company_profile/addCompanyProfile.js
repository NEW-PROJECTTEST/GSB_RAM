$(document).ready(function(){
	var addCustomerForm = $("#addCompanyProfile");
	var validator = addCustomerForm.validate({
		rules:{
			company_name :{ required : true },
			company_pan_number : { required : true},
			founder_name : {required : true},
			company_address : {required : true},
			company_contact_number_one : {required : true, digits : true},
			company_contact_number_two : { digits : true},
			company_email : {required : true,  email : true},
			company_website_url : {required : true},
			total_employee : {required : true}
		},
		messages:{
			company_name :{ required : "This field is required" },
			company_pan_number :{ required : "This field is required" },
			founder_name :{ required : "This field is required" },
			company_address :{ required : "This field is required" },
			company_contact_number_one :{ required : "This field is required",digits : "Please enter numbers only" },
			company_contact_number_two :{ digits : "Please enter numbers only" },
			company_email :{ required : "This field is required",email : "Please enter valid email address" },
			company_website_url :{ required : "This field is required" },
			total_employee :{ required : "This field is required" }
		}
	});
});
