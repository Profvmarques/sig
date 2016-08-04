<?php 
 session_start(); 
 require_once('classes/cursos.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$cursos = new Cursos(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/situacao_curso.php'); 
 require_once('classes/tipocurso.php'); 
 global $linha1; 
 global $rs1;
global $linha5; 
 global $rs5;

$situacao_curso= new Situacao_curso(); 
$situacao_curso->consultar("select * from situacao_curso order by descricao");
$linha1= $situacao_curso->Linha; 
$rs1= $situacao_curso->Result;
 
$tipocurso= new Tipocurso(); 
$tipocurso->consultar("select * from tipocurso order by descricao");
$linha5= $tipocurso->Linha; 
$rs5= $tipocurso->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$cursos->consultar('BEGIN'); 
$cursos->incluir( 
$_POST['idsituacao_curso'],
$_POST['sigla'],
$_POST['descricao'],
$_POST['carga_horaria'],
$_POST['idtipocurso']
); 
$cursos->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/cursos/consulta.php').'&titulo='.base64_encode('Consulta de Cursos')); 
} catch (Exception $ex) { 
$cursos->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$cursos->consultar('select * from cursos order by descricao;'); 
$linha = $cursos->Linha; 
$rs = $cursos->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$cursos->consultar("select * from cursos where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $cursos->Linha; 
$rs = $cursos->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/situacao_curso.php'); 
 require_once('classes/tipocurso.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha1; 
 global $rs1;
global $linha5; 
 global $rs5;

 $cursos->consultar("select * from cursos where idcursos = ".$_GET['id']); 
$linhaEditar= $cursos->Linha; 
$rsEditar= $cursos->Result;
 
$situacao_curso= new Situacao_curso(); 
$situacao_curso->consultar("select * from situacao_curso order by descricao");
$linha1= $situacao_curso->Linha; 
$rs1= $situacao_curso->Result;
 
$tipocurso= new Tipocurso(); 
$tipocurso->consultar("select * from tipocurso order by descricao");
$linha5= $tipocurso->Linha; 
$rs5= $tipocurso->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$cursos->consultar('BEGIN'); 
 	$cursos->alterar( 
 $_GET['id'], 
$_POST['idsituacao_curso'],
$_POST['sigla'],
$_POST['descricao'],
$_POST['carga_horaria'],
$_POST['idtipocurso']
); 
$descricao ="Atualização dos dados na tabela cursos pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$cursos->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/cursos/consulta.php').'&titulo='.base64_encode('Consulta de Cursos')); 
} catch (Exception $ex) { 
$cursos->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>