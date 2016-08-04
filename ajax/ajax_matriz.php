<?php
require_once('../classes/turmas.php');
$modulos = new Turma();


$modulos->consultar("select idmatriz, DATE_FORMAT(data_vigencia,'%d/%m/%Y') as vigencia from matriz where siglacurso='".$_POST['siglacurso']."' order by data_vigencia desc");
$linha=$modulos->Linha;
$resultado=$modulos->Result;


if($linha<=0){
   echo  '<option value="">'.htmlentities('Aguardando escolha da matriz...').'</option>';
   
}else{
   	  echo '<option value="">Selecione a Matriz curricular...</option>';
   for($i=0;$i<$linha;$i++){
      echo '<option value="'.mysql_result($resultado,$i,'idmatriz').'">'.utf8_encode(mysql_result($resultado,$i,'vigencia')).'</option>';
    }
}

?>