<?php
require_once('../classes/turmas.php');
$modulos = new Turma();


$modulos->consultar("select * from turma t inner join periodoletivo pl on(t.idperiodoletivo = pl.idperiodoletivo) 
inner join inscricao i on(t.idturma = i.idturma) 
where t.idperiodoletivo='".$_POST['idperiodoletivo']."' and t.idturno='".$_POST['idturno']."' and t.idsituacaoturma=4 group by t.idturma order by t.idturma");
$linha=$modulos->Linha;
$resultado=$modulos->Result;


if($linha<=0){
   echo  '<option value="">'.htmlentities('Aguardando escolha da turma...').'</option>';
   
}else{
   	  echo '<option value="">Selecione a tuma...</option>';
   for($i=0;$i<$linha;$i++){
      echo '<option value="'.mysql_result($resultado,$i,'t.idturma').'">'.utf8_encode(mysql_result($resultado,$i,'idturma')).'</option>';
    }
}

?>