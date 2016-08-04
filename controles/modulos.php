<?php 
 session_start(); 
 require_once('classes/modulos.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$modulos = new Modulos(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/sistemas.php'); 
 global $linha1; 
 global $rs1;

$sistemas= new Sistemas(); 
$sistemas->consultar("select * from sistemas order by descricao");
$linha1= $sistemas->Linha; 
$rs1= $sistemas->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$modulos->consultar('BEGIN'); 
$modulos->incluir( 
$_POST['idsistemas'],
$_POST['descricao'],
$_POST['dtreg']
); 
$modulos->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/modulos/consulta.php').'&titulo='.base64_encode('Consulta de Modulos')); 
} catch (Exception $ex) { 
$modulos->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$modulos->consultar('select * from modulos order by descricao;'); 
$linha = $modulos->Linha; 
$rs = $modulos->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$modulos->consultar("select * from modulos where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $modulos->Linha; 
$rs = $modulos->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/sistemas.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha1; 
 global $rs1;

 $modulos->consultar("select * from modulos where idmodulos = ".$_GET['id']); 
$linhaEditar= $modulos->Linha; 
$rsEditar= $modulos->Result;
 
$sistemas= new Sistemas(); 
$sistemas->consultar("select * from sistemas order by descricao");
$linha1= $sistemas->Linha; 
$rs1= $sistemas->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$modulos->consultar('BEGIN'); 
 	$modulos->alterar( 
 $_GET['id'], 
$_POST['idsistemas'],
$_POST['descricao'],
$_POST['dtreg']
); 
$descricao ="Atualização dos dados na tabela modulos pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$modulos->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/modulos/consulta.php').'&titulo='.base64_encode('Consulta de Modulos')); 
} catch (Exception $ex) { 
$modulos->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>