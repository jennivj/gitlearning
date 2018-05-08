$('#frmform').validate({
        rules: {
            userName: {
                minlength: 3,
                maxlength: 15,
                required: true,
				 
            },
            userEmail: {
                minlength: 5,           
                 required: true,
				 email: true
            },
			  userPhone: {                      
                required: true
            },
			userDob:{ required: true}
			
        },
		 messages: {
        userName: "Enter your Name",
        userEmail: {  required: "Enter your Email Address" , email: 'Enter your Valid Email Address' },
		userPhone: "Enter your Phone Number",
		userDob: "Enter your BirthDay",
		 },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
 
    });
	
 