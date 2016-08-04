<?php 
 session_start(); 
 require_once('classes/distrito.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$distrito = new Distrito(); 
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
$distrito->consultar('BEGIN'); 
$distrito->incluir( 
$_POST['descricao']
); 
$distrito->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/distrito/consulta.php').'&titulo='.base64_encode('Consulta de Distrito')); 
} catch (Exception $ex) { 
$distrito->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$distrito->consultar('select * from distrito order by descricao;'); 
$linha = $distrito->Linha; 
$rs = $distrito->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$distrito->consultar("select * from distrito where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $distrito->Linha; 
$rs = $distrito->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linhaEditar; 
 global $rsEditar;

 $distrito->consultar("select * from distrito where iddistrito = ".$_GET['id']); 
$linhaEditar= $distrito->Linha; 
$rsEditar= $distrito->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$distrito->consultar('BEGIN'); 
 	$distrito->alterar( 
 $_GET['id'], 
$_POST['descricao']
); 
$descricao ="Atualização dos dados na tabela distrito pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$distrito->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/distrito/consulta.php').'&titulo='.base64_encode('Consulta de Distrito')); 
} catch (Exception $ex) { 
$distrito->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>