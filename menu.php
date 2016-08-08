<!DOCTYPE html>
<html lang="pt-BR">
	<meta charset="iso-8859-1">
<?php 
session_start();
require_once('controles/acessousuario.php');
$url = $_SERVER['PHP_SELF'];
$dir = explode("/", $url);
ProcessoAcessoUsuario('menu');

if($_SESSION['idperfil']==1 && ($_GET['idsistemas']=='' || $_GET['idsistemas']==0 || $_SESSION['idsistemas']==0) ){	
        	
   for ($i = 0; $i < $linhaPai; $i++) {
?>
            <li>
				<a href="index.html">
					<i class="<?php echo $array[$i]['class'];?>"></i>
					<span><?php echo $array[$i]['menu'];?></span>
				</a>
<?php } ?>
			 <?php if($linhaSm1>0){?>	
                <ul>
                  <?php for($a = 0; $a < $linhaSm1; $a++) {?>
					<li>
					 <a href="<?php echo $array1[$a]['url'];?>">
						<i class="<?php echo $array1[$a]['class'];?>"></i><span><?php echo $array1[$a]['menu'];?></span>
					 </a>
                       <?php if($linhaSm2>0){?>	
                       <ul>
                         <?php for($b = 0; $b < $linhaSm2; $b++) {?>
					       <li>
					        <a href="<?php echo $array2[$b]['url'];?>">
						    <i class="<?php echo $array2[$b]['class'];?>"></i><span><?php echo $array2[$b]['menu'];?></span>
					        </a>
                           </li> 
                          <?php } // fim for Sm2?> 
                       </ul>
                        <?php }// fim if Sm2?>
                    </li>	
                  <?php } // fim for Sm1?>
                   
				</ul>
             <?php }// fim if Sm1?>
			</li>
	
			
	<?php } ?>			

   </html>     