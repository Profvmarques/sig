<?php
require("controles/configuracao.php");
Processo('incluir');
?>
<style type="text/css">
<!--
.bd_titulo {	text-align:center;
	background-color:#303641;
	font-weight:bold;
}
.textos_white{
  color:#FFF;	
}
/*body,td,th {
	font-size: 16px;
}*/
-->
</style>
<form id="form" name="form" method="post" action="">
  <table width="678" border="0" align="center" cellpadding="2" cellspacing="5">
    <tr>
      <td width="77"><b>Sistemas:</b></td>
      <td><select name="idsistemas" id="idsistemas" onchange="" class="form-control">
        <option value="">Selecione sistema</option>
        <?php for($i=0;$i<$linha;$i++){?>
        <option value="<?php echo $rs[$i]['idsistemas'];?>"><?php echo $rs[$i]['descricao'];?></option>
        <?php }?>
      </select></td>
      <td width="94" rowspan="2"><button type="button" class="btn btn-primary" onclick="document.form.acao.value='consultar', submit();"> </i> CONSULTAR</button>
      <input type="hidden" name="acao" id="acao" /></td>
    </tr>
    <tr>
      <td><b>Perfil:</b></td>
      <td width="475"><select name="idperfil" id="idperfil" onchange="" class="form-control">
        <option value="">Selecione sistema</option>
        <?php for($i=0;$i<$linha1;$i++){?>
        <option value="<?php echo $rs1[$i]['idperfil'];?>"><?php echo $rs1[$i]['descricao'];?></option>
        <?php }?>
      </select></td>
    </tr>
    
    <tr>
      <td></td>
      <td colspan="2"></td>
    </tr>
 
    <tr>
      <td colspan="3">
	  <?php if($_POST['idperfil']!=''){	  ?>
	  <table width="621" border="0">
	   <?php 	  
	    for($i=0;$i<$linha2;$i++){
		 if($array[$i]['idmodulos']==0){
	  ?>
          <tr bgcolor="#303641">
            <td colspan="3"><div align="center"><strong><?php echo ("M&oacute;dulo : ".$array[$i]['modulo']);?></strong>
              <input type="checkbox" name="publico<?php echo $i;?>" id="publico<?php echo $i;?>" <?php echo ($array[$i]['publico']);?> />
            </div></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#303641" class="textos_white"><strong>Nome Menu </strong></td>
            <td width="116" bgcolor="#303641" class="textos_white"><div align="center"><strong>Permiss&atilde;o</strong></div></td>
          </tr>
          <?php }?>
		  <?php if($array[$i]['idmodulos']>0){?>
          <tr bgcolor="">
            <td width="171" class="textos"><?php echo $array[$i]['menu'];?></td>
            <td width="320" class="font_normal">&nbsp;</td>
            <td width="116" class="font_normal"><div align="center">
              <input type="checkbox" name="publico<?php echo $i;?>" id="publico<?php echo $i;?>" <?php echo utf8_encode($array[$i]['permissao']);?> />
            </div></td>
          </tr>
		  <?php }?>
		   <?php }?>
      </table>      </td>
    </tr>
  
    <tr>
      <td colspan="3"><div class="form-actions">
          <div>
            <button type="button" class="btn btn-primary" onclick="validar(document.form);"> </i> SALVAR</button>
            <input name="ok" type="hidden" id="ok"/>
          </div>
      </div></td>
    </tr>
  </table>
 <?php  }  ?>
</form>
<script>
document.form.idsistemas.value=<?php echo $_POST['idsistemas'];?>;
document.form.idperfil.value=<?php echo $_POST['idperfil'];?>;
</script>

