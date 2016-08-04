<?php
require_once('../classes/espacos.php');
$Espacos = new Espacos();

$Espacos->Consultar("select * from horario_reserva hr 
where hr.idhorario_reserva not in(select idhorario_reserva FROM reservas 
where idespacos=".$_REQUEST['idespacos']." 
    and DAY(data_reserva)=".$_REQUEST['d']." and MONTH(data_reserva)=".$_REQUEST['m']." 
    and YEAR(data_reserva)=".$_REQUEST['y'].") order by idhorario_reserva");
$linha2=$Espacos->Linha;
$resultado2=$Espacos->Result;


if($linha2<=0){
   echo  '<option value="0">'.htmlentities('Aguardando escolha de espaço...').'</option>';
   
}else{
   	  echo '<option value="">Selecione o horário...</option>';
   for($i=0;$i<$linha2;$i++){
      echo '<option value="'.mysql_result($resultado2,$i,'idhorario_reserva').'">'.mysql_result($resultado2,$i,'horario').'</option>';
	  
   }
}

?>