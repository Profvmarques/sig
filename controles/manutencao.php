<?php 
 session_start(); 
 require_once('classes/manutencao.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$manutencao = new Manutencao(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/correcoes.php'); 
 global $linha1; 
 global $rs1;

$correcoes= new Correcoes(); 
$correcoes->consultar("select * from correcoes order by descricao");
$linha1= $correcoes->Linha; 
$rs1= $correcoes->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$manutencao->consultar('BEGIN'); 
$manutencao->incluir( 
$_POST['idcorrecoes'],
$_POST['descricao'],
$_POST['dtreg']
); 
$manutencao->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/manutencao/consulta.php').'&titulo='.base64_encode('Consulta de Manutencao')); 
} catch (Exception $ex) { 
$manutencao->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$manutencao->consultar('select * from manutencao order by descricao;'); 
$linha = $manutencao->Linha; 
$rs = $manutencao->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$manutencao->consultar("select * from manutencao where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $manutencao->Linha; 
$rs = $manutencao->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/correcoes.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha1; 
 global $rs1;

 $manutencao->consultar("select * from manutencao where idusuarios = ".$_GET['id']); 
$linhaEditar= $manutencao->Linha; 
$rsEditar= $manutencao->Result;
 
$correcoes= new Correcoes(); 
$correcoes->consultar("select * from correcoes order by descricao");
$linha1= $correcoes->Linha; 
$rs1= $correcoes->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$manutencao->consultar('BEGIN'); 
 	$manutencao->alterar( 
 $_GET['id'], 
$_POST['idcorrecoes'],
$_POST['descricao'],
$_POST['dtreg']
); 
$descricao ="Atualização dos dados na tabela manutencao pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$manutencao->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/manutencao/consulta.php').'&titulo='.base64_encode('Consulta de Manutencao')); 
} catch (Exception $ex) { 
$manutencao->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>