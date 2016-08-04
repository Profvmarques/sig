<?php

header("Content-Type: text/html; charset=ISO-8859-1",true);

require_once('../classes/parentes.php');

require_once('../classes/ConstrucaoForm.php');

require_once("../classes/ValidacaoForm.php");

$Parentes = new Parentes();

$Validacao = new ValidacaoForm();

 $Construcao = new ContrucaoPage();


if ($_POST['id']) {

    
    $id = mysql_escape_String($_POST['id']);

    if($_POST['zero']!='' && $_POST['zero']!='undefined'){

        $foto = $_POST['zero'];     

        $ext = strtolower(strrchr($foto,"."));

        $foto = md5(uniqid(time())).$ext;

    }
    $zero = utf8_decode(mysql_escape_String($_POST['zero']));
    
    $primeiro = utf8_decode(mysql_escape_String($_POST['primeiro']));

    $segundo = utf8_decode(mysql_escape_String($_POST['segundo']));

    $terceiro = $Validacao->formatoDataYMD(mysql_escape_String($_POST['terceiro']));

    try {
        
        
        $caminho = "/home/reserva/public_html/temp/".$foto;
        //"C:/wamp/www/Reserva/restrito2/fotos/" 
        $caminho_imagem = "/home/reserva/public_html/restrito2/fotos/".$foto;
        //$caminho_imagem = "/home/reserva/public_html/restrito2/fotos/" . $_SESSION['fototemp'];
        @copy($caminho, $caminho_imagem);
        //@copy("http://".$_SERVER['HTTP_HOST']."/Reserva/restrito2/fotos/".$_SESSION['foto1'], $caminho_imagem);
        @unlink($caminho);

    
        $Parentes->Consultar("BEGIN");

        $Parentes->Alterar($id, $zero , $primeiro, $segundo, $terceiro);
          
        $Parentes->Consultar("COMMIT");

        
    } catch (Exception $ex) {

        $Parentes->Consultar("ROLLBACK");

        $Construcao = new ContrucaoPage();

        $Construcao->msgbox("Falha " . $ex);

    }

}

?>