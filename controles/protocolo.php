<?php 
 session_start(); 
 require_once('classes/protocolo.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$protocolo = new Protocolo(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/candidatos.php'); 
 require_once('classes/turma.php'); 
 global $linha1; 
 global $rs1;
global $linha2; 
 global $rs2;

$candidatos= new Candidatos(); 
$candidatos->consultar("select * from candidatos order by descricao");
$linha1= $candidatos->Linha; 
$rs1= $candidatos->Result;
 
$turma= new Turma(); 
$turma->consultar("select * from turma order by descricao");
$linha2= $turma->Linha; 
$rs2= $turma->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$protocolo->consultar('BEGIN'); 
$protocolo->incluir( 
$_POST['idcandidatos'],
$_POST['idturma'],
$_POST['dtreg']
); 
$protocolo->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/protocolo/consulta.php').'&titulo='.base64_encode('Consulta de Protocolo')); 
} catch (Exception $ex) { 
$protocolo->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$protocolo->consultar('select * from protocolo order by descricao;'); 
$linha = $protocolo->Linha; 
$rs = $protocolo->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$protocolo->consultar("select * from protocolo where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $protocolo->Linha; 
$rs = $protocolo->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/candidatos.php'); 
 require_once('classes/turma.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha1; 
 global $rs1;
global $linha2; 
 global $rs2;

 $protocolo->consultar("select * from protocolo where idprotocolo = ".$_GET['id']); 
$linhaEditar= $protocolo->Linha; 
$rsEditar= $protocolo->Result;
 
$candidatos= new Candidatos(); 
$candidatos->consultar("select * from candidatos order by descricao");
$linha1= $candidatos->Linha; 
$rs1= $candidatos->Result;
 
$turma= new Turma(); 
$turma->consultar("select * from turma order by descricao");
$linha2= $turma->Linha; 
$rs2= $turma->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$protocolo->consultar('BEGIN'); 
 	$protocolo->alterar( 
 $_GET['id'], 
$_POST['idcandidatos'],
$_POST['idturma'],
$_POST['dtreg']
); 
$descricao ="Atualização dos dados na tabela protocolo pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$protocolo->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/protocolo/consulta.php').'&titulo='.base64_encode('Consulta de Protocolo')); 
} catch (Exception $ex) { 
$protocolo->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>