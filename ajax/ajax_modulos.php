<?php
require_once('../classes/modulos.php');
$modulos = new Modulos();


$modulos->consultar("select * from modulos where idsistemas=".$_POST['idsistemas']." order by sigla_modulo, descricao");
$linha=$modulos->Linha;
$resultado=$modulos->Result;


if($linha<=0){
   echo  '<option value="">'.htmlentities('Aguardando escolha de Sistema...').'</option>';
   
}else{
   	  echo '<option value="">Selecione o Módulo...</option>';
   for($i=0;$i<$linha;$i++){
      echo '<option value="'.$resultado[$i]['idmodulos'].'">'.$resultado[$i]['sigla_modulo']." - ".utf8_encode($resultado[$i]['descricao']).'</option>';
	  
   }
}

?>