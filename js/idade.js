$(document).ready( function() {
   /* Executa a requisição quando o campo idade perder o foco */
   $('#nascimento').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'http://177.185.193.252/sgm/ajax/consulta_idade.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'nascimento=' + $('#nascimento').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#idade').val(data.idade);
                        
                        $('#pai').focus();
                    }
                }
           });   
   return false;    
   })
});