<?php
require("controles/index.php");
Processo('login');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>

  	<meta charset="iso-8859-1">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Integrado de Gest&atilde;o</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style-login.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/skins/blue.css"> 
    <link rel="shortcut icon" href="assets/images/favicon.ico"> 	
         
    </head>
  <body> 
    <style type="text/css">
      body {
          
      }
    .body {
        /*background-image: url(assets/images/fundo-cinza1.jpg);*/
        background: url(assets/images/fundo.jpg) no-repeat;
        /*background-attachment: fixed;*/
        background-size: cover;
        background-position: 50% 50%;

  text-align: left;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      
       }.form-signin .form-signin-heading,
            
            {
            .form-signin input[type="text"],
            .form-signin input[type="login"],
            .form-signin input[type="password"] {
                font-size: 16px;
                height: auto;
                margin-bottom: 15px;
                padding: 7px 9px;
            }
          }
            
      </style>
     </head>
<script src="js/Validacaoform.js"> </script>
  <body class="body">
      <div class="container">

    <form class="form-signin" method="post"  name="form" id="form">
        <div align="center">
        <h2 class="form-signin-heading">Dados de acesso</h2>
        </div>
                <label for="exampleInputLogin">Usu&aacute;rio</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-user"></span></span>
                <input type="text" name="usuario" id="usuario" class="form-control" required="" title="Campo Usuário é obrigatorio" placeholder="Digite Usu&aacute;rio">
           </div>
         
            <div class="form-group">
              <label for="exampleInputSenha">Senha</label>
              <div class="input-group">
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-lock"></span></span>
                <input type="password" name="senha" class="form-control" required="" placeholder="Digite Senha">
         </div>
         </div>
         <hr/>          

        <button type="button" class="btn btn-primary" name="Logar" id="Logar"  value="" onclick="validar(document.form);" />
                
              Entrar
        </button>
        <p>
          <input type="hidden" name="ok" id="ok">
          <br/></p>
        </form>
        </div>
    <div align="center">         
  <img src="assets/images/sig.png" class="img-rounded">
    </div>

<script src="jquery-1.11.2.min.js"></script>
<script src="bootstrap.min.js"></script>
 
  </body>
</html>