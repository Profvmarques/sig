<?php 
 session_start(); 
 require_once('classes/unidadegestao.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$unidadegestao = new Unidadegestao(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/distrito.php'); 
 global $linha8; 
 global $rs8;

$distrito= new Distrito(); 
$distrito->consultar("select * from distrito order by descricao");
$linha8= $distrito->Linha; 
$rs8= $distrito->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$unidadegestao->consultar('BEGIN'); 
$unidadegestao->incluir( 
$_POST['descricao'],
$_POST['responsavel'],
$_POST['endereco'],
$_POST['bairro'],
$_POST['telefone'],
$_POST['celular'],
$_POST['email'],
$_POST['iddistrito']
); 
$unidadegestao->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/unidadegestao/consulta.php').'&titulo='.base64_encode('Consulta de Unidadegestao')); 
} catch (Exception $ex) { 
$unidadegestao->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$unidadegestao->consultar('select * from unidadegestao order by descricao;'); 
$linha = $unidadegestao->Linha; 
$rs = $unidadegestao->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$unidadegestao->consultar("select * from unidadegestao where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $unidadegestao->Linha; 
$rs = $unidadegestao->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/distrito.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha8; 
 global $rs8;

 $unidadegestao->consultar("select * from unidadegestao where idunidade_gestao = ".$_GET['id']); 
$linhaEditar= $unidadegestao->Linha; 
$rsEditar= $unidadegestao->Result;
 
$distrito= new Distrito(); 
$distrito->consultar("select * from distrito order by descricao");
$linha8= $distrito->Linha; 
$rs8= $distrito->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$unidadegestao->consultar('BEGIN'); 
 	$unidadegestao->alterar( 
 $_GET['id'], 
$_POST['descricao'],
$_POST['responsavel'],
$_POST['endereco'],
$_POST['bairro'],
$_POST['telefone'],
$_POST['celular'],
$_POST['email'],
$_POST['iddistrito']
); 
$descricao ="Atualização dos dados na tabela unidadegestao pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$unidadegestao->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/unidadegestao/consulta.php').'&titulo='.base64_encode('Consulta de Unidadegestao')); 
} catch (Exception $ex) { 
$unidadegestao->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>