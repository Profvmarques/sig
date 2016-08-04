<?php 
 session_start(); 
 require_once('classes/frequencia.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$frequencia = new Frequencia(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/turma.php'); 
 global $linha1; 
 global $rs1;

$turma= new Turma(); 
$turma->consultar("select * from turma order by descricao");
$linha1= $turma->Linha; 
$rs1= $turma->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$frequencia->consultar('BEGIN'); 
$frequencia->incluir( 
$_POST['idturma'],
$_POST['data_frequencia'],
$_POST['dtreg']
); 
$frequencia->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/frequencia/consulta.php').'&titulo='.base64_encode('Consulta de Frequencia')); 
} catch (Exception $ex) { 
$frequencia->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$frequencia->consultar('select * from frequencia order by descricao;'); 
$linha = $frequencia->Linha; 
$rs = $frequencia->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$frequencia->consultar("select * from frequencia where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $frequencia->Linha; 
$rs = $frequencia->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/turma.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha1; 
 global $rs1;

 $frequencia->consultar("select * from frequencia where idfrequencia = ".$_GET['id']); 
$linhaEditar= $frequencia->Linha; 
$rsEditar= $frequencia->Result;
 
$turma= new Turma(); 
$turma->consultar("select * from turma order by descricao");
$linha1= $turma->Linha; 
$rs1= $turma->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$frequencia->consultar('BEGIN'); 
 	$frequencia->alterar( 
 $_GET['id'], 
$_POST['idturma'],
$_POST['data_frequencia'],
$_POST['dtreg']
); 
$descricao ="Atualização dos dados na tabela frequencia pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$frequencia->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/frequencia/consulta.php').'&titulo='.base64_encode('Consulta de Frequencia')); 
} catch (Exception $ex) { 
$frequencia->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>