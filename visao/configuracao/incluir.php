<?php
require("controles/adm_configuracao.php");
Processo('incluir');
?>

<form id="form" name="form" method="post" action="">
  <table width="636" border="0" align="center" cellpadding="2" cellspacing="5">
    <tr>
      <td width="65" class="textos">Perfil :</td>
      <td width="260"><select name="idperfil" id="idperfil" class="txt_campo" onchange="submit()">
          <option>Selecione o perfil</option>
          
         <?php for($i=0;$i<$linha;$i++){?>
		   <option value="<?php echo mysql_result($rs,$i,'idperfil');?>"><?php echo utf8_encode(mysql_result($rs,$i,'descricao'));?></option>
		  <?php }?>
          
      </select></td>
      <td width="261"><button type="button" class="btn btn-primary" onclick="validar(document.form);"> </i> SALVAR</button></td>
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
		
		 if($array[$i]['id_pai']==0){
	  ?>
          <tr bgcolor="#AECEF4">
            <td colspan="6" bgcolor="#AECEF4" class="textos_white"><div align="center"><strong><?php echo utf8_encode("Módulo : ".$array[$i]['modulo']."<br/> ===>>  Menu Pai : ".$array[$i]['menu']);?></strong>
              <input type="checkbox" name="publico<?php echo $i;?>" id="publico<?php echo $i;?>" <?php echo utf8_encode($array[$i]['publico']);?> />
            </div></td>
          </tr>
          <tr bgcolor="#AECEF4">
            <td width="171" bgcolor="#AECEF4" class="textos_white"><strong>Nome Menu </strong></td>
            <td width="82" bgcolor="#AECEF4" class="textos_white"><div align="center"><strong>Incluir</strong></div></td>
            <td width="80" bgcolor="#AECEF4" class="textos_white"><div align="center"><strong>Alterar</strong></div></td>
            <td width="84" bgcolor="#AECEF4" class="textos_white"><div align="center"><strong>Excluir</strong></div></td>
            <td width="127" bgcolor="#AECEF4" class="textos_white"><div align="center"><strong>Consulta</strong></div></td>
            <td width="51" class="textos_white"><div align="center"><strong>Publico</strong></div></td>
          </tr>
          <?php }?>
		  <?php if($array[$i]['id_pai']!=0){?>
          <tr bgcolor="">
            <td width="171" class="textos"><?php echo utf8_encode($array[$i]['menu']);?></td>
            <td width="82" class="font_normal"><div align="center">
                <input type="checkbox" name="incluir<?php echo $i;?>" id="incluir<?php echo $i;?>" <?php echo utf8_encode($array[$i]['incluir']);?> />
            </div></td>
            <td width="80" class="font_normal"><div align="center">
                <input type="checkbox" name="alterar<?php echo $i;?>" id="alterar<?php echo $i;?>" <?php echo utf8_encode($array[$i]['alterar']);?>  />
            </div></td>
            <td width="84" class="font_normal"><div align="center">
                <input type="checkbox" name="apagar<?php echo $i;?>" id="apagar<?php echo $i;?>" <?php echo utf8_encode($array[$i]['apagar']);?>  />
                </div></td>
            <td width="127" class="font_normal"><div align="center">
                <input type="checkbox" name="consultar<?php echo $i;?>" id="consultar<?php echo $i;?>" <?php echo utf8_encode($array[$i]['consultar']);?> />
            </div></td>
            <td width="51" class="font_normal"><div align="center">
              <input type="checkbox" name="publico<?php echo $i;?>" id="publico<?php echo $i;?>" <?php echo utf8_encode($array[$i]['publico']);?> />
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
document.form.idperfil.value=<?php echo $_POST['idperfil'];?>;
</script>

