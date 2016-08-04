$(document).ready( function() {
   /* Executa a requisi��o quando o campo CEP perder o foco */
   $('#cep').blur(function(){
           /* Configura a requisi��o AJAX */
           $.ajax({
                url : 'http://www.faeterj-caxias.net/sgm2/ajax/consulta_cep.php', /* URL que ser� chamada */ 
                type : 'POST', /* Tipo da requisi��o */ 
                data: 'cep=' + $('#cep').val(), /* dado que ser� enviado via POST */
                dataType: 'json', /* Tipo de transmiss�o */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#endereco').val(data.endereco);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.municipio);
                        $('#uf').val(data.uf);
 
                        $('#numero').focus();
                    }
                }
           });   
   return false;    
   })
});