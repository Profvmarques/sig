<?php
require_once('controles/modulos.php');
Processo('incluir');
?>
<form class="form-horizontal" id="form" name="form" method="post">
  <table width="1010">
    <tr>
      <td width="846">&nbsp;</td>
      <td width="152"><a href="default.php?pg=view/adm_modulos/consulta.php&amp;form=Consulta de Módulos"><strong><i class="icon-search"> Consultar Módulos </i></strong></a> </td>
    </tr>
  </table>
  <table width="397" border="0">
    <tr>
      <td width="144" class="control-group"><label class="control-label">SISTEMA</label></td>
      <td width="243"><span class="controls">
        <select name="idsistemas" class="input-medium" tabindex="1" id="idsistemas" title="O campo sistema é obrigatório">
          <option value="">Escolha o sistema</option>
          <?php for($i=0;$i<$linha;$i++){?>
		   <option value="<?php echo mysql_result($rs,$i,'sigla_modulo');?>"><?php echo utf8_encode(mysql_result($rs,$i,'nome'));?></option>
		  <?php }?>
        </select>
      </span></td>
    </tr>
    <tr>
      <td width="144" class="control-group"><label class="control-label">SIIGLA M&Oacute;DULO </label></td>
      <td><span class="controls">
        <input name="sigla_modulo" type="text" class="input-medium" id="sigla_modulo" placeholder="" />
      </span></td>
    </tr>
    <tr>
      <td class="control-group"><label class="control-label">M&Oacute;DULO</label></td>
      <td><span class="controls">
        <input name="nome" type="text" class="input-xxlarge" id="nome" placeholder="" />
      </span></td>
    </tr>
  </table>
  <div class="form-actions">
                                  <button type="button" class="btn btn-primary" onClick="validar(document.form);">
                              </i> SALVAR</button>
                                  <button type="button" class="btn" >CANCELAR</button>
                               <input name="ok" type="hidden" id="ok"/></div>
</form>