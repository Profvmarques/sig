<?php 
 session_start(); 
 require_once('classes/perfil.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$perfil = new Perfil(); 
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
$perfil->consultar('BEGIN'); 
$perfil->incluir( 
$_POST['descricao']
); 
$perfil->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/perfil/consulta.php').'&titulo='.base64_encode('Consulta de Perfil')); 
} catch (Exception $ex) { 
$perfil->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$perfil->consultar('select * from perfil order by descricao;'); 
$linha = $perfil->Linha; 
$rs = $perfil->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$perfil->consultar("select * from perfil where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $perfil->Linha; 
$rs = $perfil->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linhaEditar; 
 global $rsEditar;

 $perfil->consultar("select * from perfil where idperfil = ".$_GET['id']); 
$linhaEditar= $perfil->Linha; 
$rsEditar= $perfil->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$perfil->consultar('BEGIN'); 
 	$perfil->alterar( 
 $_GET['id'], 
$_POST['descricao']
); 
$descricao ="Atualização dos dados na tabela perfil pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$perfil->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/perfil/consulta.php').'&titulo='.base64_encode('Consulta de Perfil')); 
} catch (Exception $ex) { 
$perfil->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>