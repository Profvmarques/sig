<?php 
 session_start(); 
 require_once('classes/correcoes.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$correcoes = new Correcoes(); 
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
$correcoes->consultar('BEGIN'); 
$correcoes->incluir( 
$_POST['assunto'],
$_POST['foto'],
$_POST['observacao'],
$_POST['situacao'],
$_POST['dtreg']
); 
$correcoes->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/correcoes/consulta.php').'&titulo='.base64_encode('Consulta de Correcoes')); 
} catch (Exception $ex) { 
$correcoes->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$correcoes->consultar('select * from correcoes order by descricao;'); 
$linha = $correcoes->Linha; 
$rs = $correcoes->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$correcoes->consultar("select * from correcoes where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $correcoes->Linha; 
$rs = $correcoes->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linhaEditar; 
 global $rsEditar;

 $correcoes->consultar("select * from correcoes where idcorrecoes = ".$_GET['id']); 
$linhaEditar= $correcoes->Linha; 
$rsEditar= $correcoes->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$correcoes->consultar('BEGIN'); 
 	$correcoes->alterar( 
 $_GET['id'], 
$_POST['assunto'],
$_POST['foto'],
$_POST['observacao'],
$_POST['situacao'],
$_POST['dtreg']
); 
$descricao ="Atualização dos dados na tabela correcoes pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$correcoes->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/correcoes/consulta.php').'&titulo='.base64_encode('Consulta de Correcoes')); 
} catch (Exception $ex) { 
$correcoes->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>