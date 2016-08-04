<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
require_once('../classes/funcionarios_domesticos.php');
require_once('../classes/ConstrucaoForm.php');
require_once("../classes/ValidacaoForm.php");
$FD = new FuncionariosDomesticos();
$Validacao = new ValidacaoForm();
if($_POST['id'])
{
$id=mysql_escape_String($_POST['id']);
$primeiro=utf8_decode(mysql_escape_String($_POST['primeiro']));
$segundo=utf8_decode(mysql_escape_String($_POST['segundo']));
$terceiro=utf8_decode(mysql_escape_String($_POST['terceiro']));

try{
$FD->Consultar("BEGIN");
$FD->Alterar($id,$primeiro,$segundo,$terceiro);
$FD->Consultar("COMMIT");
} catch (Exception $ex) {
  $FD->Consultar("ROLLBACK");
  $Construcao = new ContrucaoPage();
  $Construcao->msgbox("Falha " . $ex);
}

}
?>