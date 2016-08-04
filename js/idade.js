$(document).ready( function() {
   /* Executa a requisi��o quando o campo idade perder o foco */
   $('#nascimento').blur(function(){
           /* Configura a requisi��o AJAX */
           $.ajax({
                url : 'http://177.185.193.252/sgm/ajax/consulta_idade.php', /* URL que ser� chamada */ 
                type : 'POST', /* Tipo da requisi��o */ 
                data: 'nascimento=' + $('#nascimento').val(), /* dado que ser� enviado via POST */
                dataType: 'json', /* Tipo de transmiss�o */
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