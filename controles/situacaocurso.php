<?php 
 session_start(); 
 require_once('classes/situacaocurso.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$situacaocurso = new Situacaocurso(); 
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
$situacaocurso->consultar('BEGIN'); 
$situacaocurso->incluir( 
$_POST['descricao']
); 
$situacaocurso->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/situacaocurso/consulta.php').'&titulo='.base64_encode('Consulta de Situacaocurso')); 
} catch (Exception $ex) { 
$situacaocurso->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$situacaocurso->consultar('select * from situacaocurso order by descricao;'); 
$linha = $situacaocurso->Linha; 
$rs = $situacaocurso->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$situacaocurso->consultar("select * from situacaocurso where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $situacaocurso->Linha; 
$rs = $situacaocurso->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linhaEditar; 
 global $rsEditar;

 $situacaocurso->consultar("select * from situacaocurso where idsituacao_curso = ".$_GET['id']); 
$linhaEditar= $situacaocurso->Linha; 
$rsEditar= $situacaocurso->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$situacaocurso->consultar('BEGIN'); 
 	$situacaocurso->alterar( 
 $_GET['id'], 
$_POST['descricao']
); 
$descricao ="Atualização dos dados na tabela situacaocurso pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$situacaocurso->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/situacaocurso/consulta.php').'&titulo='.base64_encode('Consulta de Situacaocurso')); 
} catch (Exception $ex) { 
$situacaocurso->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>