<?php
require_once('controles/adm_sistemas.php');
Processo('editar');
?>
<form class="form-horizontal" id="form" name="form" method="post">
<table width="1010">
  <tr>
    <td width="846">&nbsp;</td>
    <td width="152"><a href="default.php?pg=view/sistemas/consulta.php&form=Cadastro de Sistemas"><strong><i class="icon-search"> Consultar Sistemas</i></strong></a> </td>
  </tr>
</table>


                                <div class="control-group">
                                  <label class="control-label">Descri&ccedil;&atilde;o do Sistema </label><div class="controls">
                                    <input name="descricao" type="text" class="input-medium" id="descricao" placeholder="" title="CPF obrigatório" value="<?php echo mysql_result($rs,0,'descricao');?>"/>
                                  </div>
                                </div>
  <div class="control-group">
    <label class="control-label"></label>
  </div>
                                <div class="control-group"><div class="control-group"></div>
                                  <div class="controls"></div>
                                </div>
  <div class="form-actions">
                                  <div align="center">
                                    <button type="button" class="btn btn-primary" onClick="validar(document.form);">
                                    </i> SALVAR</button>
                                    <button type="button" class="btn" >CANCELAR</button>
                                    <input name="ok" type="hidden" id="ok"/>
                                  </div>
  </div>
</form>