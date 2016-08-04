<?php 
 session_start(); 
 require_once('classes/cargos.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$cargos = new Cargos(); 
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
$cargos->consultar('BEGIN'); 
$cargos->incluir( 
$_POST['descricao']
); 
$cargos->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/cargos/consulta.php').'&titulo='.base64_encode('Consulta de Cargos')); 
} catch (Exception $ex) { 
$cargos->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$cargos->consultar('select * from cargos order by descricao;'); 
$linha = $cargos->Linha; 
$rs = $cargos->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$cargos->consultar("select * from cargos where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $cargos->Linha; 
$rs = $cargos->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linhaEditar; 
 global $rsEditar;

 $cargos->consultar("select * from cargos where idcargos = ".$_GET['id']); 
$linhaEditar= $cargos->Linha; 
$rsEditar= $cargos->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$cargos->consultar('BEGIN'); 
 	$cargos->alterar( 
 $_GET['id'], 
$_POST['descricao']
); 
$descricao ="Atualização dos dados na tabela cargos pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$cargos->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/cargos/consulta.php').'&titulo='.base64_encode('Consulta de Cargos')); 
} catch (Exception $ex) { 
$cargos->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>