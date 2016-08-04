<?php
require_once('../classes/animais.php');
require_once('../classes/ConstrucaoForm.php');
require_once("../classes/ValidacaoForm.php");
$Animais = new Animais();
$Validacao = new ValidacaoForm();
if($_POST['id'])
{
	
$id=mysql_escape_String($_POST['id']);
$primeiro=utf8_decode(mysql_escape_String($_POST['primeiro']));
$segundo=utf8_decode(mysql_escape_String($_POST['segundo']));
$terceiro=mysql_escape_String($_POST['terceiro']);

 $Construcao = new ContrucaoPage();

try{
$Animais->Consultar("BEGIN");
$Animais->Alterar($id,$primeiro,$segundo,$terceiro);
$Animais->Consultar("COMMIT");

$Construcao->msgbox($update);
} catch (Exception $ex) {
  $Animais->Consultar("ROLLBACK");
  $Construcao = new ContrucaoPage();
  $Construcao->msgbox("Falha " . $ex);
}

}
?>