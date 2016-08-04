<?php 
 session_start(); 
 require_once('classes/usuarios.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$usuarios = new Usuarios(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/perfil.php'); 
 global $linha4; 
 global $rs4;

$perfil= new Perfil(); 
$perfil->consultar("select * from perfil order by descricao");
$linha4= $perfil->Linha; 
$rs4= $perfil->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$usuarios->consultar('BEGIN'); 
$usuarios->incluir( 
$_POST['usuario'],
$_POST['senha'],
$_POST['situacao'],
$_POST['idperfil'],
$_POST['dtreg']
); 
$usuarios->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/usuarios/consulta.php').'&titulo='.base64_encode('Consulta de Usuarios')); 
} catch (Exception $ex) { 
$usuarios->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$usuarios->consultar('select * from usuarios order by descricao;'); 
$linha = $usuarios->Linha; 
$rs = $usuarios->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$usuarios->consultar("select * from usuarios where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $usuarios->Linha; 
$rs = $usuarios->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/perfil.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha4; 
 global $rs4;

 $usuarios->consultar("select * from usuarios where idusuarios = ".$_GET['id']); 
$linhaEditar= $usuarios->Linha; 
$rsEditar= $usuarios->Result;
 
$perfil= new Perfil(); 
$perfil->consultar("select * from perfil order by descricao");
$linha4= $perfil->Linha; 
$rs4= $perfil->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$usuarios->consultar('BEGIN'); 
 	$usuarios->alterar( 
 $_GET['id'], 
$_POST['usuario'],
$_POST['senha'],
$_POST['situacao'],
$_POST['idperfil'],
$_POST['dtreg']
); 
$descricao ="Atualização dos dados na tabela usuarios pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$usuarios->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/usuarios/consulta.php').'&titulo='.base64_encode('Consulta de Usuarios')); 
} catch (Exception $ex) { 
$usuarios->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>