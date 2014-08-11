$(document).ready(function(){
    
  $("#form_categoria").validate({
       		rules: {
				nome: {
					required: true,
					minlength: 2,
					remote: "users.action"
				},
				descricao: {
					required: true,
					minlength: 5
				}
				
			},
			messages: {
				nome: {
					required: "Enter a username"
					
				},
                                descricao: {
					required: "Enter a descricao"
					
				}
            
                        }
                    });
});

