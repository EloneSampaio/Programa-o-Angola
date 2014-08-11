/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 


$(document).ready(function(){
    
    Cadastrar("#novo",'#teste');
  
});


function Cadastrar(valor,html){
    
    $(valor).submit(function(){
   
  var  url=$(this).attr('action');  
  var  data = $(this).serialize();

  
  $.post(url,data,function(data){
  
      $(html).append('<div>'+data.nome+'</div>');
    console.log(data.nome);
  
  });
   return false;

});
  
    

    
    
}

*/

function Hide(){
    
   
  var teste=$('#te').click();
    if(teste){
      alert(1);
  }   
}
