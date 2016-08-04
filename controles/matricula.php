<?php 
 session_start(); 
 require_once('classes/matricula.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$matricula = new Matricula(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/sorteio.php'); 
 require_once('classes/alunos.php'); 
 global $linha1; 
 global $rs1;
global $linha2; 
 global $rs2;

$sorteio= new Sorteio(); 
$sorteio->consultar("select * from sorteio order by descricao");
$linha1= $sorteio->Linha; 
$rs1= $sorteio->Result;
 
$alunos= new Alunos(); 
$alunos->consultar("select * from alunos order by descricao");
$linha2= $alunos->Linha; 
$rs2= $alunos->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$matricula->consultar('BEGIN'); 
$matricula->incluir( 
$_POST['idsorteio'],
$_POST['idalunos'],
$_POST['dtreg']
); 
$matricula->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/matricula/consulta.php').'&titulo='.base64_encode('Consulta de Matricula')); 
} catch (Exception $ex) { 
$matricula->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$matricula->consultar('select * from matricula order by descricao;'); 
$linha = $matricula->Linha; 
$rs = $matricula->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$matricula->consultar("select * from matricula where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $matricula->Linha; 
$rs = $matricula->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/sorteio.php'); 
 require_once('classes/alunos.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha1; 
 global $rs1;
global $linha2; 
 global $rs2;

 $matricula->consultar("select * from matricula where idmatricula = ".$_GET['id']); 
$linhaEditar= $matricula->Linha; 
$rsEditar= $matricula->Result;
 
$sorteio= new Sorteio(); 
$sorteio->consultar("select * from sorteio order by descricao");
$linha1= $sorteio->Linha; 
$rs1= $sorteio->Result;
 
$alunos= new Alunos(); 
$alunos->consultar("select * from alunos order by descricao");
$linha2= $alunos->Linha; 
$rs2= $alunos->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$matricula->consultar('BEGIN'); 
 	$matricula->alterar( 
 $_GET['id'], 
$_POST['idsorteio'],
$_POST['idalunos'],
$_POST['dtreg']
); 
$descricao ="Atualização dos dados na tabela matricula pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$matricula->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/matricula/consulta.php').'&titulo='.base64_encode('Consulta de Matricula')); 
} catch (Exception $ex) { 
$matricula->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>