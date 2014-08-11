$(document).ready(function(){

    modal();
    valida();

});



function modal(){
    
    $('#loginform').submit(function(e){
     
  });
  
  $('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: ".hidemodal" });
}


function valida(){
     $("#loginform").validate({
       		rules: {
				email: {
					required: true,
					email: true,
					
				},
				senha: {
					required: true,
					minlength: 4
				}
				
			},
			messages: {
				email: {
					required: "Insere um email Valido"
					
				},
                                senha: {
					required: "Inserir uma senha valida"
					
				}
            
                        }
                    });

}


