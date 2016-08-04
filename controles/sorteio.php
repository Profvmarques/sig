<?php 
 session_start(); 
 require_once('classes/sorteio.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$sorteio = new Sorteio(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/protocolo.php'); 
 global $linha1; 
 global $rs1;

$protocolo= new Protocolo(); 
$protocolo->consultar("select * from protocolo order by descricao");
$linha1= $protocolo->Linha; 
$rs1= $protocolo->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$sorteio->consultar('BEGIN'); 
$sorteio->incluir( 
$_POST['idprotocolo'],
$_POST['sequencia'],
$_POST['ordem_sorteio'],
$_POST['data_sorteio']
); 
$sorteio->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/sorteio/consulta.php').'&titulo='.base64_encode('Consulta de Sorteio')); 
} catch (Exception $ex) { 
$sorteio->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$sorteio->consultar('select * from sorteio order by descricao;'); 
$linha = $sorteio->Linha; 
$rs = $sorteio->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$sorteio->consultar("select * from sorteio where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $sorteio->Linha; 
$rs = $sorteio->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/protocolo.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha1; 
 global $rs1;

 $sorteio->consultar("select * from sorteio where idsorteio = ".$_GET['id']); 
$linhaEditar= $sorteio->Linha; 
$rsEditar= $sorteio->Result;
 
$protocolo= new Protocolo(); 
$protocolo->consultar("select * from protocolo order by descricao");
$linha1= $protocolo->Linha; 
$rs1= $protocolo->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$sorteio->consultar('BEGIN'); 
 	$sorteio->alterar( 
 $_GET['id'], 
$_POST['idprotocolo'],
$_POST['sequencia'],
$_POST['ordem_sorteio'],
$_POST['data_sorteio']
); 
$descricao ="Atualização dos dados na tabela sorteio pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$sorteio->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/sorteio/consulta.php').'&titulo='.base64_encode('Consulta de Sorteio')); 
} catch (Exception $ex) { 
$sorteio->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>