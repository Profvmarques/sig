<?php 
 session_start(); 
 require_once('classes/pessoas.php'); 
 require_once('classes/util.php'); 
require_once('classes/ocorrencias.php'); 
 
function Processo($Processo) { 
/* Atributos Globais */ 
 $util = new Util(); 
$pessoas = new Pessoas(); 
$ocorrencias = new Ocorrencias(); 
 
/* Switch processos */ 
switch ($Processo) { 
/* incluir*/ 
case 'incluir': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
global $linha; 
 global $rs; 
require_once('classes/usuarios.php'); 
 global $linha17; 
 global $rs17;

$usuarios= new Usuarios(); 
$usuarios->consultar("select * from usuarios order by descricao");
$linha17= $usuarios->Linha; 
$rs17= $usuarios->Result;
 
if($_POST['ok'] == 'true') { 
try { 
 //Chamar  
$pessoas->consultar('BEGIN'); 
$pessoas->incluir( 
$_POST['nome'],
$_POST['sexo'],
$_POST['nascimento'],
$_POST['email'],
$_POST['telefone'],
$_POST['celular'],
$_POST['pai'],
$_POST['mae'],
$_POST['responsavel'],
$_POST['endereco'],
$_POST['numero'],
$_POST['complemento'],
$_POST['bairro'],
$_POST['cidade'],
$_POST['cep'],
$_POST['foto'],
$_POST['idusuarios'],
$_POST['dtreg']
); 
$pessoas->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/pessoas/consulta.php').'&titulo='.base64_encode('Consulta de Pessoas')); 
} catch (Exception $ex) { 
$pessoas->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 case 'consulta': 
 global $linha; 
 global $rs; 
$pessoas->consultar('select * from pessoas order by descricao;'); 
$linha = $pessoas->Linha; 
$rs = $pessoas->Result; 
 
if ($_POST['ok'] == 'true') { 
 
$pessoas->consultar("select * from pessoas where descricao like '%".$_POST['descricao'] ."%' order by descricao"); 
$linha = $pessoas->Linha; 
$rs = $pessoas->Result; 
 } 
break;
 
 /* editar*/ 
case 'editar': 
 
$util->seguranca($_SESSION['idusuarios'], 'index.php'); 
require_once('classes/usuarios.php'); 
 global $linhaEditar; 
 global $rsEditar;
global $linha17; 
 global $rs17;

 $pessoas->consultar("select * from pessoas where idpessoas = ".$_GET['id']); 
$linhaEditar= $pessoas->Linha; 
$rsEditar= $pessoas->Result;
 
$usuarios= new Usuarios(); 
$usuarios->consultar("select * from usuarios order by descricao");
$linha17= $usuarios->Linha; 
$rs17= $usuarios->Result;
 

 	 if ($_POST['ok'] == 'true') { 
 	try { 
 
 	$pessoas->consultar('BEGIN'); 
 	$pessoas->alterar( 
 $_GET['id'], 
$_POST['nome'],
$_POST['sexo'],
$_POST['nascimento'],
$_POST['email'],
$_POST['telefone'],
$_POST['celular'],
$_POST['pai'],
$_POST['mae'],
$_POST['responsavel'],
$_POST['endereco'],
$_POST['numero'],
$_POST['complemento'],
$_POST['bairro'],
$_POST['cidade'],
$_POST['cep'],
$_POST['foto'],
$_POST['idusuarios'],
$_POST['dtreg']
); 
$descricao ="Atualização dos dados na tabela pessoas pelo usuário <b>".$_SESSION['usuario'] ."</b> \n";$funcionalidade ="Atualização de senha";
 $data_hora=date('Y-m-d h:i:s'); 
$ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR',$data_hora); 
 
$pessoas->consultar('COMMIT');
$util->msgbox('REGISTRO SALVO COM SUCESSO!'); 
$util->redirecionamentopage('default.php?pg='.base64_encode('view/pessoas/consulta.php').'&titulo='.base64_encode('Consulta de Pessoas')); 
} catch (Exception $ex) { 
$pessoas->consultar('ROLLBACK'); 
$util->msgbox('Falha de operacao');
 } 
 } 
break; 

 }
 
 } 
 
 ?>