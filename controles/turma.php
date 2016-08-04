<?php 
 session_start(); 
 require_once('classes/turma.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$turma = new Turma(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/cursos.php'); 
 require_once('classes/turno.php'); 
 require_once('classes/situacao_turma.php'); 
 global $linha2; 
 global $rs2;
global $linha12; 
 global $rs12;
global $linha13; 
 global $rs13;

$cursos= new Cursos(); 
$cursos->consultar("select * from cursos order by descricao");
$linha2= $cursos->Linha; 
$rs2= $cursos->Result;
 
$turno= new Turno(); 
$turno->consultar("select * from turno order by descricao");
$linha12= $turno->Linha; 
$rs12= $turno->Result;
 
$situacao_turma= new Situacao_turma(); 
$situacao_turma->consultar("select * from situacao_turma order by descricao");
$linha13= $situacao_turma->Linha; 
$rs13= $situacao_turma->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$turma->consultar('BEGIN'); 
$turma->incluir( 
$_POST['codigo'],
$_POST['idcursos'],
$_POST['horario_inicio'],
$_POST['horario_termino'],
$_POST['seg'],
$_POST['ter'],
$_POST['qua'],
$_POST['qui'],
$_POST['sex'],
$_POST['sab'],
$_POST['dom'],
$_POST['idturno'],
$_POST['idsituacao_turma']
); 
$turma->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/turma/consulta.php').'&titulo='.base64_encode('Consulta de Turma')); 
} catch (Exception $ex) { 
$turma->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$turma->consultar('select * from turma order by descricao;'); 
$linha = $turma->Linha; 
$rs = $turma->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$turma->consultar("select * from turma where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $turma->Linha; 
$rs = $turma->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/cursos.php'); 
 require_once('classes/turno.php'); 
 require_once('classes/situacao_turma.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha2; 
 global $rs2;
global $linha12; 
 global $rs12;
global $linha13; 
 global $rs13;

 $turma->consultar("select * from turma where idturma = ".$_GET['id']); 
$linhaEditar= $turma->Linha; 
$rsEditar= $turma->Result;
 
$cursos= new Cursos(); 
$cursos->consultar("select * from cursos order by descricao");
$linha2= $cursos->Linha; 
$rs2= $cursos->Result;
 
$turno= new Turno(); 
$turno->consultar("select * from turno order by descricao");
$linha12= $turno->Linha; 
$rs12= $turno->Result;
 
$situacao_turma= new Situacao_turma(); 
$situacao_turma->consultar("select * from situacao_turma order by descricao");
$linha13= $situacao_turma->Linha; 
$rs13= $situacao_turma->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$turma->consultar('BEGIN'); 
 	$turma->alterar( 
 $_GET['id'], 
$_POST['codigo'],
$_POST['idcursos'],
$_POST['horario_inicio'],
$_POST['horario_termino'],
$_POST['seg'],
$_POST['ter'],
$_POST['qua'],
$_POST['qui'],
$_POST['sex'],
$_POST['sab'],
$_POST['dom'],
$_POST['idturno'],
$_POST['idsituacao_turma']
); 
$descricao ="Atualização dos dados na tabela turma pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$turma->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/turma/consulta.php').'&titulo='.base64_encode('Consulta de Turma')); 
} catch (Exception $ex) { 
$turma->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>