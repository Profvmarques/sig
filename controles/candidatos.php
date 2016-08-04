<?php 
 session_start(); 
 require_once('classes/candidatos.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$candidatos = new Candidatos(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/pessoas.php'); 
 global $linha1; 
 global $rs1;

$pessoas= new Pessoas(); 
$pessoas->consultar("select * from pessoas order by descricao");
$linha1= $pessoas->Linha; 
$rs1= $pessoas->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$candidatos->consultar('BEGIN'); 
$candidatos->incluir( 
$_POST['idpessoas'],
$_POST['dtreg']
); 
$candidatos->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/candidatos/consulta.php').'&titulo='.base64_encode('Consulta de Candidatos')); 
} catch (Exception $ex) { 
$candidatos->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$candidatos->consultar('select * from candidatos order by descricao;'); 
$linha = $candidatos->Linha; 
$rs = $candidatos->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$candidatos->consultar("select * from candidatos where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $candidatos->Linha; 
$rs = $candidatos->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/pessoas.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha1; 
 global $rs1;

 $candidatos->consultar("select * from candidatos where idcandidatos = ".$_GET['id']); 
$linhaEditar= $candidatos->Linha; 
$rsEditar= $candidatos->Result;
 
$pessoas= new Pessoas(); 
$pessoas->consultar("select * from pessoas order by descricao");
$linha1= $pessoas->Linha; 
$rs1= $pessoas->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$candidatos->consultar('BEGIN'); 
 	$candidatos->alterar( 
 $_GET['id'], 
$_POST['idpessoas'],
$_POST['dtreg']
); 
$descricao ="Atualização dos dados na tabela candidatos pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$candidatos->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/candidatos/consulta.php').'&titulo='.base64_encode('Consulta de Candidatos')); 
} catch (Exception $ex) { 
$candidatos->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>