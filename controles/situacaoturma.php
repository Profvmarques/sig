<?php 
 session_start(); 
 require_once('classes/situacaoturma.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$situacaoturma = new Situacaoturma(); 
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
$situacaoturma->consultar('BEGIN'); 
$situacaoturma->incluir( 
$_POST['descricao']
); 
$situacaoturma->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/situacaoturma/consulta.php').'&titulo='.base64_encode('Consulta de Situacaoturma')); 
} catch (Exception $ex) { 
$situacaoturma->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$situacaoturma->consultar('select * from situacaoturma order by descricao;'); 
$linha = $situacaoturma->Linha; 
$rs = $situacaoturma->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$situacaoturma->consultar("select * from situacaoturma where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $situacaoturma->Linha; 
$rs = $situacaoturma->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linhaEditar; 
 global $rsEditar;

 $situacaoturma->consultar("select * from situacaoturma where idsituacao_turma = ".$_GET['id']); 
$linhaEditar= $situacaoturma->Linha; 
$rsEditar= $situacaoturma->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$situacaoturma->consultar('BEGIN'); 
 	$situacaoturma->alterar( 
 $_GET['id'], 
$_POST['descricao']
); 
$descricao ="Atualização dos dados na tabela situacaoturma pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$situacaoturma->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/situacaoturma/consulta.php').'&titulo='.base64_encode('Consulta de Situacaoturma')); 
} catch (Exception $ex) { 
$situacaoturma->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>