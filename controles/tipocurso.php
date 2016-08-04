<?php 
 session_start(); 
 require_once('classes/tipocurso.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$tipocurso = new Tipocurso(); 
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
$tipocurso->consultar('BEGIN'); 
$tipocurso->incluir( 
$_POST['descricao']
); 
$tipocurso->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/tipocurso/consulta.php').'&titulo='.base64_encode('Consulta de Tipocurso')); 
} catch (Exception $ex) { 
$tipocurso->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$tipocurso->consultar('select * from tipocurso order by descricao;'); 
$linha = $tipocurso->Linha; 
$rs = $tipocurso->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$tipocurso->consultar("select * from tipocurso where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $tipocurso->Linha; 
$rs = $tipocurso->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linhaEditar; 
 global $rsEditar;

 $tipocurso->consultar("select * from tipocurso where idtipocurso = ".$_GET['id']); 
$linhaEditar= $tipocurso->Linha; 
$rsEditar= $tipocurso->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$tipocurso->consultar('BEGIN'); 
 	$tipocurso->alterar( 
 $_GET['id'], 
$_POST['descricao']
); 
$descricao ="Atualização dos dados na tabela tipocurso pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$tipocurso->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/tipocurso/consulta.php').'&titulo='.base64_encode('Consulta de Tipocurso')); 
} catch (Exception $ex) { 
$tipocurso->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>