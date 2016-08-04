<?php 
 session_start(); 
 require_once('classes/turno.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$turno = new Turno(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 

if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$turno->consultar('BEGIN'); 
$turno->incluir( 
$_POST['descricao']
); 
$turno->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/turno/consulta.php').'&titulo='.base64_encode('Consulta de Turno')); 
} catch (Exception $ex) { 
$turno->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$turno->consultar('select * from turno order by descricao;'); 
$linha = $turno->Linha; 
$rs = $turno->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$turno->consultar("select * from turno where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $turno->Linha; 
$rs = $turno->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linhaEditar; 
 global $rsEditar;

 $turno->consultar("select * from turno where idturno = ".$_GET['id']); 
$linhaEditar= $turno->Linha; 
$rsEditar= $turno->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$turno->consultar('BEGIN'); 
 	$turno->alterar( 
 $_GET['id'], 
$_POST['descricao']
); 
$descricao ="Atualização dos dados na tabela turno pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$turno->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/turno/consulta.php').'&titulo='.base64_encode('Consulta de Turno')); 
} catch (Exception $ex) { 
$turno->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>