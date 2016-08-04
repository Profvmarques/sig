<?php
require_once('controles/sistemas.php');
Processo('consulta');
?>
<form class="form-horizontal" id="form" name="form" method="post">
<table width="1010">
  <tr>
    <td width="868">&nbsp;</td>
    <td width="117"><a href="default.php?pg=view/adm_sistemas/incluir.php&form=Cadastro de Sistemas"><strong> <i class="icon-plus-sign">  Novo Sistema</i> </strong></a></td>
  </tr>
</table>
<br />
<br />

                                <div class="control-group">
                                  <label class="control-label">Descri&ccedil;&atilde;o do Sistema <span class="form-actions">
                                  <input name="ok" type="hidden" id="ok"/>
                                  </span></label>
                                  <div class="controls">
                                    <input name="descricao" type="text" class="input-medium" id="descricao" placeholder="" title="CPF obrigatório" />
								
                                    <button type="button" class="btn btn-primary" onClick="validar(document.form);">
                              <i class="entypo-search"></i> CONSULTAR</button>
                                  </div>
  </div>
								<table width="100%" class="table table-advance" id="table1">
                                  <thead>
                                    <tr>
                                      <th width="675">Descri&ccedil;&atilde;o</th>
                                      <th width="63">A&ccedil;&atilde;o</th>
                                    </tr>
                                  </thead>
                                  <tbody>
								  <?php for($i=0;$i<$linha;$i++){?>
                                    <tr class="table-flag-blue">
                                      <td><?php echo $rs[$i]['descricao'];?></td>
                                      <td><a class="btn btn-small show-tooltip" title="Editar" href="default.php?pg=view/adm_sistemas/editar.php&form=Atulizar Cadastro de Sistemas&id=<?php echo mysql_result($rs,$i,'idsistemas');?>"><i class="icon-edit"></i></a></td>
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
  <div class="form-actions"></div>
  </center>
</form>