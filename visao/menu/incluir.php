<?php
require("controles/menu.php");
Processo('incluir');
?>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
 // COMENTÁRIO DESSA FUNÇÃO *********************************
      $(document).ready(function(){
        // Evento change no campo idsistemas  
         $("select[name=idsistemas]").change(function(){
            // Exibimos no campo idapartamentos antes de concluirmos
			$("select[name=idmodulos]").html('<option value="">Carregando Módulos...</option>');
            // Exibimos o campo sistemas antes de selecionamos o módulo, serve também em caso
			// do usuario ja ter selecionado o tipo e resolveu trocar, com isso limpamos a
			// seleção antiga caso tenha feito.
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
	   // COMENTÁRIO DESSA FUNÇÃO *********************************
</script>

<script type="text/javascript">
$(function () {
	function removeCampo() {
		$(".removerCampo").unbind("click");
		$(".removerCampo").bind("click", function () {
			if($("tr.linhas").length > 1){
				$(this).parent().parent().remove();
			}
		});
	}
	//removeCampo();
	$(".adicionarCampo").click(function () {
		novoCampo = $("tr.linhas:first").clone();
		novoCampo.find("input").val("");
		novoCampo.insertAfter("tr.linhas:last");
		removeCampo();
	});
});
</script>
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
  <table width="636" border="0" align="center" cellpadding="2" cellspacing="5">
    <tr>
      <td width="65"><b>Sistemas:</b></td>
      <td width="526"><select name="idsistemas" id="idsistemas" onchange="" class="txt_campo">
          <option value="">Selecione sistema</option>
          <?php for($i=0;$i<$linha;$i++){?>
          <option value="<?php echo $rs[$i]['idsistemas'];?>"><?php echo $rs[$i]['descricao'];?></option>
          <?php }?>
      </select></td>
    </tr>
    <tr>
      <td><b>M&oacute;dulos :</b></td>
      <td><select name="idmodulos" id="idmodulos" class="input-larger" onchange="submit()">
          <option value="" selected="selected">Aguardando ...</option>
        </select>      </td>
    </tr>
    
    <tr>
      <td></td>
      <td></td>
    </tr>
 
    <tr>
      <td colspan="2"><br />
	  <?php if($_POST['idsistemas']!='' && $_POST['idmodulos']!=''){	  ?>
	  <table width="714" border="0">
	  
          <tr bgcolor="#303641">
            <td colspan="6" bgcolor="#303641" class="textos_white"><div align="center"><strong><?php echo "Módulo : ".$rs3[0]['amod.nome'];?></strong></div></td>
          </tr>
          <tr bgcolor="#303641">
            <td width="48"  class="textos_white"><strong>Id_pai</strong></td>
            <td width="58" class="textos_white"><div align="center"><strong>Ordem</strong></div></td>
            <td width="135" class="textos_white"><div align="center"><strong>Menu</strong></div></td>
            <td width="101" class="textos_white"><div align="center"><strong>Classe css </strong></div></td>
            <td colspan="2" class="textos_white"><div align="center"><strong>Link</strong></div></td>
		  </tr>
            <?php 	  
	    for($i=0;$i<$linha3;$i++){
	  ?>
          <tr bgcolor="">
            <td width="48" class="textos"><?php echo utf8_encode(mysql_result($rs3,$i,'am.id_pai'));?></td>
            <td width="58" class="font_normal"><span class="textos"><?php echo utf8_encode(mysql_result($rs3,$i,'am.ordem_menu'));?></span></td>
            <td width="135" class="font_normal"><span class="textos"><?php echo utf8_encode(mysql_result($rs3,$i,'am.nome_menu'));?></span></td>
            <td width="101" class="font_normal"><span class="textos"><?php echo utf8_encode(mysql_result($rs3,$i,'am.class_css'));?></span></td>
            <td width="350" class="font_normal"><span class="textos"><?php echo utf8_encode(mysql_result($rs3,$i,'am.link_menu'));?></span></td>
			 <td width="20" class="font_normal"><a class="btn btn-small show-tooltip" title="Editar" href="default.php?pg=view/adm_menu/editar.php&form=Atualizar Cadastro de Menu&id=<?php echo mysql_result($rs3,$i,'am.idmenu');?>"><i class="icon-edit"></i></a></td>
          </tr>
		   <?php }?>
      </table>	  
	  <br />
	    <table width="714" border="0" cellpadding="2" cellspacing="4">
          <tr>
            <td colspan="6" class="textos_white">Adicionando Menu </td>
          </tr>
          <tr>
            <td width="60" bgcolor="#303641" class="textos_white">Id_pai</td>
            <td width="60" bgcolor="#303641" class="textos_white">Ordem</td>
            <td width="124" bgcolor="#303641" class="textos_white">Menu</td>
            <td width="124" bgcolor="#303641" class="textos_white">Classe css </td>
            <td colspan="2" bgcolor="#303641" class="textos_white">Link</td>
          </tr>
          <tr class="linhas">
            <td><input name="id_pai[]" type="text" id="id_pai[]" size="10" class="form-control col-md-1" /></td>
            <td><input name="ordem[]" type="text" id="ordem[]" size="10" class="form-control col-md-1"/></td>
            <td><input name="menu[]" type="text" id="menu[]" size="20" class="form-control col-md-3" /></td>
            <td><input name="class[]" type="text" id="class[]" size="20" class="form-control col-md-3"/></td>
            <td width="278"><input name="url[]" type="text" id="url[]" class="form-control col-md-6" size="60" /></td>
            <td width="110"><a href="#" class="removerCampo" title="Remover linha"><i class="entypo-minus-squared"></i><b>Remover</b></a></td>
          </tr>
          <tr>
            <td colspan="6"><a href="#" class="adicionarCampo" title="Adicionar item"><i class="entypo-plus-squared"></i><b>Adicionar</b></a> </td>
          </tr>
        </table></td>
    </tr>
  
    <tr>
      <td colspan="2"><div class="form-actions">
          <div>
            <button type="button" class="btn btn-primary" onclick="validar(document.form);"> </i> SALVAR</button>
            <input name="ok" type="hidden" id="ok"/>
            <input name="modulo" type="hidden" id="modulo" value="<?php echo utf8_encode(mysql_result($rs3,0,'am.idmodulos'));?>" />
          </div>
      </div></td>
    </tr>
  </table>
 <?php  }  ?>
</form>
<script>
document.form.idsistemas.value=<?php echo $_POST['idsistemas'];?>;
document.form.idmodulos.value=<?php echo $_POST['idmodulos'];?>;
</script>

