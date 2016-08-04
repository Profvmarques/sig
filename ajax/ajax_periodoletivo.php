<?php
require_once('../classes/turmas.php');
$modulos = new Turma();


$modulos->consultar("select * from periodoletivo where siglacurso='".$_POST['siglacurso']."' order by siglaperiodo desc");
$linha=$modulos->Linha;
$resultado=$modulos->Result;


if($linha<=0){
   echo  '<option value="">'.htmlentities('Aguardando escolha do período...').'</option>';
   
}else{
   	  echo '<option value="">Selecione o Período letivo...</option>';
   for($i=0;$i<$linha;$i++){
      echo '<option value="'.mysql_result($resultado,$i,'idperiodoletivo').'">'.utf8_encode(mysql_result($resultado,$i,'siglaperiodo')).'</option>';
    }
}

?>