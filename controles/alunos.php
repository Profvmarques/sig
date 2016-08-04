<?php 
 session_start(); 
 require_once('classes/alunos.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$alunos = new Alunos(); 
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
$alunos->consultar('BEGIN'); 
$alunos->incluir( 
$_POST['idpessoas'],
$_POST['dtreg']
); 
$alunos->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/alunos/consulta.php').'&titulo='.base64_encode('Consulta de Alunos')); 
} catch (Exception $ex) { 
$alunos->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$alunos->consultar('select * from alunos order by descricao;'); 
$linha = $alunos->Linha; 
$rs = $alunos->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$alunos->consultar("select * from alunos where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $alunos->Linha; 
$rs = $alunos->Result; 
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

 $alunos->consultar("select * from alunos where idalunos = ".$_GET['id']); 
$linhaEditar= $alunos->Linha; 
$rsEditar= $alunos->Result;
 
$pessoas= new Pessoas(); 
$pessoas->consultar("select * from pessoas order by descricao");
$linha1= $pessoas->Linha; 
$rs1= $pessoas->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$alunos->consultar('BEGIN'); 
 	$alunos->alterar( 
 $_GET['id'], 
$_POST['idpessoas'],
$_POST['dtreg']
); 
$descricao ="Atualização dos dados na tabela alunos pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$alunos->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/alunos/consulta.php').'&titulo='.base64_encode('Consulta de Alunos')); 
} catch (Exception $ex) { 
$alunos->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>