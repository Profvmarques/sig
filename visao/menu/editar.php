<?php
require("controles/menu.php");
Processo('editar');
?>
<style type="text/css">
<!--
.bd_titulo {	text-align:center;
	background-color:#AECEF4;
	font-weight:bold
}
-->
</style>

<form class="form-horizontal" id="form" name="form" method="post" action="">
  <table width="715" border="0" align="center">
    <tr>
      <td width="216">SISTEMA</td>
      <td width="334"><strong><?php echo  utf8_encode(mysql_result($resultadoEditar,0,'adms.descricao'));?></strong></td>
    </tr>
    <tr>
      <td>M&Oacute;DULO</td>
      <td><strong><?php echo  utf8_encode(mysql_result($resultadoEditar,0,'amod.nome'));?></strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>ID_PAI</td>
      <td><input name="id_pai" type="text" id="id_pai" size="10" class="input-mini" value="<?php echo mysql_result($resultadoEditar,0,'am.id_pai');?>"/></td>
    </tr>
    <tr>
      <td>ORDEM</td>
      <td><input name="ordem_menu" type="text" id="ordem_menu" size="10" class="input-mini" value="<?php echo mysql_result($resultadoEditar,0,'am.ordem_menu');?>"/></td>
    </tr>
    <tr>
      <td>MENU</td>
      <td><input name="nome_menu" type="text" id="nome_menu" size="20" class="input-medium" value="<?php echo utf8_encode(mysql_result($resultadoEditar,0,'am.nome_menu'));?>"/></td>
    </tr>
    <tr>
      <td>CLASS_CSS</td>
      <td><input name="class_css" type="text" id="class_css" size="20" class="input-medium" value="<?php echo  utf8_encode(mysql_result($resultadoEditar,0,'am.class_css'));?>"/></td>
    </tr>
    <tr>
      <td>LINK</td>
      <td><input name="link_menu" type="text" id="link_menu" class="input-xxlarge" value="<?php echo utf8_encode(mysql_result($resultadoEditar,0,'am.link_menu'));?>" /></td>
    </tr>
    <tr>
      <td>PUBLICAR</td>
      <td>
        <select name="publico" class="input-medium" tabindex="1" id="publico" title="O campo sistema &eacute; obrigat&oacute;rio">
          <option value="">-----</option>
          <option value="0">Despublicar</option>
          <option value="1">Publicar</option>
        </select>
     </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input name="ok" type="hidden" id="ok"/>
        <input name="modulo" type="hidden" id="modulo" value="<?php echo utf8_encode(mysql_result($rs3,0,'am.idmodulos'));?>" />        
      </div>        <div>
            <div align="center">
              <button type="button" class="btn btn-primary" onclick="validar(document.form);"> </i> SALVAR</button>
            </div>
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

</form>
<script>document.form.publico.value=<?php echo mysql_result($resultadoEditar,0,'am.publico');?>;</script>

