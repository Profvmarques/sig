<?php
require_once('controles/modulos.php');
Processo('consulta');
?>
<form class="form-horizontal" id="form" name="form" method="post">
<table width="1010">
  <tr>
    <td width="868">&nbsp;</td>
    <td width="117"><a href="default.php?pg=view/adm_modulos/incluir.php&form=Cadastro de Módulos"><strong> <i class="icon-plus-sign">  Novo Módulo</i> </strong></a></td>
  </tr>
</table>
<br />
<br />

                                <div class="control-group">
                                  <label class="control-label">Descrição do Módulo </label>
                                  <div class="controls">
                                    <input name="nome" type="text" class="input-medium" id="nome" placeholder="" title="A descrição é obrigatória" />
									
									<button type="button" onClick="validar(document.form);"> <i class="icon-search"></i></button>
                                  </div>
                                </div>
								<table width="100%" class="table table-advance" id="table1">
                                  <thead>
                                    <tr>
                                      <th width="675">Descricao</th>
                                      <th width="63">Ação</th>
                                    </tr>
                                  </thead>
                                  <tbody>
								  <?php for($i=0;$i<$linha;$i++){?>
                                    <tr class="table-flag-blue">
                                      <td><?php echo utf8_encode(mysql_result($rs,$i,'nome'));?></td>
                                      <td><a class="btn btn-small show-tooltip" title="Editar" href="default.php?pg=view/adm_sistemas/editar.php&form=Atulizar Cadastro de Sistemas&id=<?php echo mysql_result($rs,$i,'idmodulos');?>"><i class="icon-edit"></i></a></td>
                                    </tr>
									<?php }?>
                                  </tbody>
                                </table>
								<br />
								<br />
  <div class="control-group">
    <label class="control-label"></label>
  </div>
                                <div class="control-group"><div class="control-group"></div>
                                  <div class="controls"></div>
  </div>
  <center>
  <div class="form-actions">
                                  <button type="button" class="btn btn-primary" onClick="validar(document.form);">
                              </i> SALVAR</button>
                                  <button type="button" class="btn" >CANCELAR</button>
                               <input name="ok" type="hidden" id="ok"/></div>
  </center>
</form>