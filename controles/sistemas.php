<?php 
 session_start(); 
require_once('classes/sistemas.php'); 
require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$sistemas = new Sistemas(); 
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
$sistemas->consultar('BEGIN'); 
$sistemas->incluir( 
$_POST['descricao']
); 
$sistemas->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/sistemas/consulta.php').'&titulo='.base64_encode('Consulta de Sistemas')); 
} catch (Exception $ex) { 
$sistemas->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$sistemas->consultar('select * from sistemas order by descricao;'); 
$linha = $sistemas->Linha; 
$rs = $sistemas->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$sistemas->consultar("select * from sistemas where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $sistemas->Linha; 
$rs = $sistemas->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linhaEditar; 
 global $rsEditar;

 $sistemas->consultar("select * from sistemas where idsistemas = ".$_GET['id']); 
$linhaEditar= $sistemas->Linha; 
$rsEditar= $sistemas->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$sistemas->consultar('BEGIN'); 
 	$sistemas->alterar( 
 $_GET['id'], 
$_POST['descricao']
); 
$descricao ="Atualização dos dados na tabela sistemas pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$sistemas->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/sistemas/consulta.php').'&titulo='.base64_encode('Consulta de Sistemas')); 
} catch (Exception $ex) { 
$sistemas->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>