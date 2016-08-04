<?php 
 session_start(); 
 require_once('classes/eventos.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$eventos = new Eventos(); 
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
$eventos->consultar('BEGIN'); 
$eventos->incluir( 
$_POST['descricao'],
$_POST['data_inicio'],
$_POST['data_termino']
); 
$eventos->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/eventos/consulta.php').'&titulo='.base64_encode('Consulta de Eventos')); 
} catch (Exception $ex) { 
$eventos->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$eventos->consultar('select * from eventos order by descricao;'); 
$linha = $eventos->Linha; 
$rs = $eventos->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$eventos->consultar("select * from eventos where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $eventos->Linha; 
$rs = $eventos->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linhaEditar; 
 global $rsEditar;

 $eventos->consultar("select * from eventos where ideventos = ".$_GET['id']); 
$linhaEditar= $eventos->Linha; 
$rsEditar= $eventos->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$eventos->consultar('BEGIN'); 
 	$eventos->alterar( 
 $_GET['id'], 
$_POST['descricao'],
$_POST['data_inicio'],
$_POST['data_termino']
); 
$descricao ="Atualização dos dados na tabela eventos pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$eventos->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/eventos/consulta.php').'&titulo='.base64_encode('Consulta de Eventos')); 
} catch (Exception $ex) { 
$eventos->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>