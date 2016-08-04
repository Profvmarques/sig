<?php
require_once('../classes/visitantes.php');
require_once('../classes/ConstrucaoForm.php');
require_once("../classes/ValidacaoForm.php");
$Visitantes = new Visitantes();
$Validacao = new ValidacaoForm();
if($_POST['id'])
{
$id=mysql_escape_String($_POST['id']);
$primeiro=utf8_decode(mysql_escape_String($_POST['primeiro']));
$segundo=utf8_decode(mysql_escape_String($_POST['segundo']));
$terceiro=utf8_decode(mysql_escape_String($_POST['terceiro']));

try{
$Visitantes->Consultar("BEGIN");
$Visitantes->Alterar($id,$primeiro,$segundo,$terceiro);
$Visitantes->Consultar("COMMIT");
} catch (Exception $ex) {
  $Visitantes->Consultar("ROLLBACK");
  $Construcao = new ContrucaoPage();
  $Construcao->msgbox("Falha " . $ex);
}

}
?>