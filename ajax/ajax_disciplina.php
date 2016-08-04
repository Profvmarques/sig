<?php
require_once('../classes/turmas.php');
$modulos = new Turma();


$modulos->consultar("select * from turma t inner join disciplinas d on(t.sigladisciplina = d.sigladisciplina) 
inner join inscricao i on(t.idturma = i.idturma) 
where t.idturma='".$_POST['idturma']."' and t.idperiodoletivo='".$_POST['idperiodoletivo']."' group by d.sigladisciplina order by d.descricao;");
$linha=$modulos->Linha;
$resultado=$modulos->Result;


if($linha<=0){
   echo  '<option value="">'.htmlentities('Aguardando escolha da turma...').'</option>';
   
}else{
   	  echo '<option value="">Selecione a tuma...</option>';
   for($i=0;$i<$linha;$i++){
      echo '<option value="'.mysql_result($resultado,$i,'d.sigladisciplina').'">'.utf8_encode(mysql_result($resultado,$i,'d.descricao')).'</option>';
    }
}

?>