<?php

require_once('../classes/veiculo_morador.php');

require_once('../classes/ConstrucaoForm.php');

require_once("../classes/ValidacaoForm.php");

$VeiculoMorador = new VeiculoMorador();

$Validacao = new ValidacaoForm();

if($_POST['id'])

{

	

$id=mysql_escape_String($_POST['id']);

$primeiro=utf8_decode(mysql_escape_String($_POST['primeiro']));

$segundo=utf8_decode(mysql_escape_String($_POST['segundo']));

$terceiro=utf8_decode(mysql_escape_String($_POST['terceiro']));

$quarto=utf8_decode(mysql_escape_String($_POST['quarto']));

$quinto=utf8_decode(mysql_escape_String($_POST['quinto']));

$sexto=utf8_decode(mysql_escape_String($_POST['sexto']));

 $Construcao = new ContrucaoPage();



try{

$VeiculoMorador->Consultar("BEGIN");

$VeiculoMorador->Alterar($id,$primeiro,$segundo,$terceiro,$quarto,$quinto, $sexto);

$VeiculoMorador->Consultar("COMMIT");



$Construcao->msgbox($update);

} catch (Exception $ex) {

  $VeiculoMorador->Consultar("ROLLBACK");

  $Construcao = new ContrucaoPage();

  $Construcao->msgbox("Falha " . $ex);

}



}

?>