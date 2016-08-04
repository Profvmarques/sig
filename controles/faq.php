<?php 
 session_start(); 
 require_once('classes/faq.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$faq = new Faq(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/usuarios.php'); 
 global $linha3; 
 global $rs3;

$usuarios= new Usuarios(); 
$usuarios->consultar("select * from usuarios order by descricao");
$linha3= $usuarios->Linha; 
$rs3= $usuarios->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$faq->consultar('BEGIN'); 
$faq->incluir( 
$_POST['titulo'],
$_POST['resposta'],
$_POST['idusuarios'],
$_POST['dtreg']
); 
$faq->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/faq/consulta.php').'&titulo='.base64_encode('Consulta de Faq')); 
} catch (Exception $ex) { 
$faq->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$faq->consultar('select * from faq order by descricao;'); 
$linha = $faq->Linha; 
$rs = $faq->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$faq->consultar("select * from faq where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $faq->Linha; 
$rs = $faq->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/usuarios.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha3; 
 global $rs3;

 $faq->consultar("select * from faq where idfaq = ".$_GET['id']); 
$linhaEditar= $faq->Linha; 
$rsEditar= $faq->Result;
 
$usuarios= new Usuarios(); 
$usuarios->consultar("select * from usuarios order by descricao");
$linha3= $usuarios->Linha; 
$rs3= $usuarios->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$faq->consultar('BEGIN'); 
 	$faq->alterar( 
 $_GET['id'], 
$_POST['titulo'],
$_POST['resposta'],
$_POST['idusuarios'],
$_POST['dtreg']
); 
$descricao ="Atualização dos dados na tabela faq pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$faq->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/faq/consulta.php').'&titulo='.base64_encode('Consulta de Faq')); 
} catch (Exception $ex) { 
$faq->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>