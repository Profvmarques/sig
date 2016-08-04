<?php
require("controles/adm_acesso_usuario.php");
Processo('incluir');
?>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
 // COMENT�RIO DESSA FUN��O *********************************
      $(document).ready(function(){
        // Evento change no campo idsistemas  
         $("select[name=idsistemas]").change(function(){
            // Exibimos no campo idapartamentos antes de concluirmos
			$("select[name=idmodulos]").html('<option value="">Carregando M�dulos...</option>');
            // Exibimos o campo sistemas antes de selecionamos o m�dulo, serve tamb�m em caso
			// do usuario ja ter selecionado o tipo e resolveu trocar, com isso limpamos a
			// sele��o antiga caso tenha feito.
			// Passando tipo por parametro para a pagina ajax_modulos.php
            $.post("ajax/ajax_modulos.php",
                  {idsistemas:$(this).val()},
                  // Carregamos o resultado acima para o campo marca
				  function(valor){
                     $("select[name=idmodulos]").html(valor);
                  }
                  )
         });
	  });      	  
	   // COMENT�RIO DESSA FUN��O *********************************
</script>
<form id="form" name="form" method="post" action="" class="form-horizontal">
  <table width="737" border="0" align="center" cellpadding="2" cellspacing="5">
    <tr>
      <td width="65" class="textos">Usu&aacute;rio:</td>
      <td width="526"><select name="idusuarios" id="idusuarios" class="txt_campo">
          <option>Selecione usuario</option>
          
         <?php for($i=0;$i<$linha2;$i++){?>
		   <option value="<?php echo mysql_result($rs2,$i,'idusuarios');?>"><?php echo mysql_result($rs2,$i,'login');?></option>
		  <?php }?>
          
      </select></td>
    </tr>
    <tr>
      <td class="textos">Sistemas:</td>
      <td><select name="idsistemas" id="idsistemas" onchange="" class="txt_campo">
          <option value="">Selecione sistema</option>
          <?php for($i=0;$i<$linha;$i++){?>
          <option value="<?php echo mysql_result($rs,$i,'idsistemas');?>"><?php echo mysql_result($rs,$i,'descricao');?></option>
          <?php }?>
      </select></td>
    </tr>
    <tr>
      <td class="textos">M&oacute;dulos :</td>
      <td><select name="idmodulos" id="idmodulos" class="input-larger" onchange="submit()">
          <option value="" selected="selected">Aguardando ...</option>
        </select>
      </td>
    </tr>
    
    <tr>
      <td></td>
      <td></td>
    </tr>
 
    <tr>
      <td colspan="2">
	  <?php 
	  if($_POST['idsistemas']!='' && $_POST['idmodulos']!='' && $_POST['idusuarios']!=''){	?>
	 <table width="73%" class="table table-advance" id="table1">
	  
          <tr bgcolor="#AECEF4">
            <td colspan="6" bgcolor="#AECEF4" class="textos_white"><div align="center"><strong><?php echo utf8_encode("M&oacute;dulo : ".@mysql_result($rs3,0,'amod.nome'));?></strong></div></td>
          </tr>
          <tr bgcolor="#AECEF4">
		  
            <td width="187" bgcolor="#AECEF4" class="textos_white"><strong>Nome Menu </strong></td>
            <td width="90" bgcolor="#AECEF4" class="textos_white"><div align="center"><strong>Incluir</strong></div></td>
            <td width="88" bgcolor="#AECEF4" class="textos_white"><div align="center"><strong>Alterar</strong></div></td>
            <td width="92" bgcolor="#AECEF4" class="textos_white"><div align="center"><strong>Excluir</strong></div></td>
            <td width="106" bgcolor="#AECEF4" class="textos_white"><div align="center"><strong>Consulta</strong></div></td>
            <td width="92" class="textos_white"><div align="center"><strong>Publico </strong>
                <input type="checkbox"></div></td>
          </tr>
            <?php 	  
	    for($i=0;$i<$linha3;$i++){
	  ?>
	   <tbody>
         <tr class="table-flag-blue">
            <td width="187" class="textos"><?php echo utf8_encode(mysql_result($rs3,$i,'am.nome_menu'));?></td>
            <td width="90" class="font_normal"><div align="center">
                <input type="checkbox" name="incluir<?php echo $i;?>" id="incluir<?php echo $i;?>" <?php echo utf8_encode(mysql_result($rs3,$i,'acao_incluir'));?> />
            </div></td>
            <td width="88" class="font_normal"><div align="center">
                <input type="checkbox" name="alterar<?php echo $i;?>" id="alterar<?php echo $i;?>" <?php echo utf8_encode(mysql_result($rs3,$i,'acao_alterar'));?>  />
            </div></td>
            <td width="92" class="font_normal"><div align="center">
                <input type="checkbox" name="apagar<?php echo $i;?>" id="apagar<?php echo $i;?>" <?php echo utf8_encode(mysql_result($rs3,$i,'acao_apagar'));?>  />
            </div></td>
            <td width="106" class="font_normal"><div align="center">
                <input type="checkbox" name="consultar<?php echo $i;?>" id="consultar<?php echo $i;?>" <?php echo utf8_encode(mysql_result($rs3,$i,'acao_consultar'));?> />
            </div></td>
            <td width="92" class="font_normal"><div align="center">
              <input name="publico<?php echo $i;?>" type="checkbox" id="publico<?php echo $i;?>" />
            </div></td>
          </tr>
		  </tbody>
		   <?php }?>
      </table>
	   
      </td>
    </tr>
  
    <tr>
      <td colspan="2"><div class="form-actions">
          <div>
            <button type="button" class="btn btn-primary" onclick="validar(document.form);"> </i> SALVAR</button>
            <input name="ok" type="hidden" id="ok"/>
            <input name="modulos" type="hidden" id="modulos" value="<?php echo $_POST['idmodulos'];?>"/>
          </div>
      </div></td>
    </tr>
  </table>
  <?php  }elseif($linha3==0){  ?>
  <br /><br />
                               <div class="alert alert-error">
                                            <button data-dismiss="alert" class="close">×</button>
                                            <h4>Mensagem!</h4>
                                            <p>Não há registros <center>
  </div>
 <?php  }  ?>
</form>
<script>
document.form.idsistemas.value=<?php echo $_POST['idsistemas'];?>;
document.form.idusuarios.value=<?php echo $_POST['idusuarios'];?>;
</script>

