<?php 
 session_start(); 
 require_once('classes/funcionarios.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$funcionarios = new Funcionarios(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/pessoas.php'); 
 require_once('classes/cargos.php'); 
 global $linha1; 
 global $rs1;
global $linha2; 
 global $rs2;

$pessoas= new Pessoas(); 
$pessoas->consultar("select * from pessoas order by descricao");
$linha1= $pessoas->Linha; 
$rs1= $pessoas->Result;
 
$cargos= new Cargos(); 
$cargos->consultar("select * from cargos order by descricao");
$linha2= $cargos->Linha; 
$rs2= $cargos->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$funcionarios->consultar('BEGIN'); 
$funcionarios->incluir( 
$_POST['idpessoas'],
$_POST['idcargos'],
$_POST['dtreg']
); 
$funcionarios->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/funcionarios/consulta.php').'&titulo='.base64_encode('Consulta de Funcionarios')); 
} catch (Exception $ex) { 
$funcionarios->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$funcionarios->consultar('select * from funcionarios order by descricao;'); 
$linha = $funcionarios->Linha; 
$rs = $funcionarios->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$funcionarios->consultar("select * from funcionarios where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $funcionarios->Linha; 
$rs = $funcionarios->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/pessoas.php'); 
 require_once('classes/cargos.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha1; 
 global $rs1;
global $linha2; 
 global $rs2;

 $funcionarios->consultar("select * from funcionarios where idfuncionarios = ".$_GET['id']); 
$linhaEditar= $funcionarios->Linha; 
$rsEditar= $funcionarios->Result;
 
$pessoas= new Pessoas(); 
$pessoas->consultar("select * from pessoas order by descricao");
$linha1= $pessoas->Linha; 
$rs1= $pessoas->Result;
 
$cargos= new Cargos(); 
$cargos->consultar("select * from cargos order by descricao");
$linha2= $cargos->Linha; 
$rs2= $cargos->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$funcionarios->consultar('BEGIN'); 
 	$funcionarios->alterar( 
 $_GET['id'], 
$_POST['idpessoas'],
$_POST['idcargos'],
$_POST['dtreg']
); 
$descricao ="Atualização dos dados na tabela funcionarios pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$funcionarios->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/funcionarios/consulta.php').'&titulo='.base64_encode('Consulta de Funcionarios')); 
} catch (Exception $ex) { 
$funcionarios->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>