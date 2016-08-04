<?php
require_once('controles/ocorrencias.php');
Processo('incluir');?>

<div class="panel-body"> 
<form class="form-horizontal" id="form" name="form" method="post">
  <?php if($linha>0){?>
  <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
    <thead>
      <tr>
        <th width="36"><input type="checkbox"  id="chkd-all"></th>
        <th width="118">Data / Hora </th>
        <th width="379">Descri&ccedil;&atilde;o </th>
        <th width="266">Funcionalidade</th>
      </tr>
    </thead>
    <tbody  class="allck"> 
      <?php for($i=0;$i<$linha;$i++){?>
      <tr class="table-flag-blue">
        <td width="36"><input name="ch<?php echo $i;?>" type="checkbox" id="ch<?php echo $i;?>"></td>
        <td><?php echo utf8_encode($rs[$i]['dh']);?></td>
        <td><?php echo utf8_encode($rs[$i]['descricao']);?></td>
        <td><?php echo utf8_encode($rs[$i]['funcionalidade']);?></td>
      </tr>
      <?php }?>
    </tbody>
  </table>

    <div class="form-actions">
      <button type="button" class="btn btn-primary" onClick="validar(document.form);"> </i> VALIDAR</button>
      <input name="ok" type="hidden" id="ok"/>
    </div>
  </center>
  <?php }else{?>
  <div class="col-sm-4"></div>
  <div class="alert alert-danger alert-dismissable col-sm-12">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        N&atilde;o h&aacute; ocorr&ecirc;ncias.
  </div>
  
  <?php }?>
  <div class="control-group">
    <label class="control-label"></label>
  </div>
  <div class="control-group">
    <div class="control-group"></div>
    <div class="controls"></div>
  </div>
</form>
</div> 