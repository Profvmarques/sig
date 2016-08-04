<!DOCTYPE html>
<html lang="pt-BR">
	<meta charset="iso-8859-1">
<?php 
session_start();
require_once('classes/acessousuario.php');
$url = $_SERVER['PHP_SELF'];
$dir = explode("/", $url);
Processo('menu');

if($_SESSION['idperfil']==1 && ($_GET['idsistemas']=='' || $_GET['idsistemas']==0 || $_SESSION['idsistemas']==0) ){?>	
          <li>
				<a href="index.html" target="_blank">
					<i class="entypo-database"></i>
					<span>Backup</span>
				</a>
			</li>	
            <li>
				<a href="index.html">
					<i class="entypo-air"></i>
					<span>Configura&ccedil;&atilde;o</span>
				</a>
				<ul>
					<li>
						<a href="skin-black.html">
							<span>Gerenciamento de Usu&aacute;rios</span>
						</a>
						<ul>
							<li>
								<a href="skin-black.html">
									<span>Cadastro</span>
								</a>
							</li>
							<li>
								<a href="skin-white.html">
									<span>Consulta</span>
								</a>
							</li>
							
						</ul>
					</li>
					<li>
						<a href="#">
							<span>Gerenciamento de Sistemas</span>
						</a>
						<ul>
							<li>
								<a href="default.php?pg=<?php echo base64_encode('visao/sistemas/incluir.php');?>&titulo=<?php echo base64_encode('Cadastro de Sistemas');?>">
									<span>Cadastro</span>
								</a>
							</li>
							<li>
								<a href="default.php?pg=<?php echo base64_encode('visao/sistemas/consulta.php');?>&titulo=<?php echo base64_encode('Consulta de Sistemas');?>">
									<span>Consulta</span>
								</a>
							</li>
							
						</ul>
					</li>
                    
                    <!--MÃ³dulos-->
                    <li>
						<a href="#">
							<span>Gerenciamento de M&oacute;dulos</span>
						</a>
						<ul>
							<li>
								<a href="default.php?pg=<?php echo base64_encode('visao/modulos/incluir.php');?>&titulo=<?php echo base64_encode('Cadastro de Módulos');?>">
									<span>Cadastro</span>
								</a>
							</li>
							<li>
								<a href="default.php?pg=<?php echo base64_encode('visao/modulos/consulta.php');?>&titulo=<?php echo base64_encode('Consulta de Módulos');?>">
									<span>Consulta</span>
								</a>
							</li>
							
						</ul>
					</li>
                    
                    <li>
						<a href="skin-black.html">
							<span>Gerenciamento de Menu</span>
						</a>
						<ul>
							<li>
								<a href="default.php?pg=<?php echo base64_encode('visao/menu/incluir.php');?>&titulo=<?php echo base64_encode('Cadastro de Menu');?>">
									<span>Cadastro</span>
								</a>
							</li>
							<li>
								<a href="default.php?pg=<?php echo base64_encode('visao/menu/consulta.php');?>&titulo=<?php echo base64_encode('Consulta de Menu');?>">
									<span>Consulta</span>
								</a>
							</li>
							
						</ul>
					</li>
                    <!--fim menu --->
                   
				</ul>
			</li>
			<li>
				<a href="layout-api.html">
					<i class="entypo-layout"></i>
					<span>Sistemas</span>
				</a>
				<ul>
					<li>
						<a href="layout-api.html">
							<span>SysFundec</span>
						</a>
					</li>
					<li>
						<a href="layout-collapsed-sidebar.html">
							<span>SIC</span>
						</a>
					</li>
					<li>
						<a href="layout-fixed-sidebar.html">
							<span>SOS</span>
					</a></li>
				</ul>
			</li>
          
			<li>
				<a href="logoff.php">
					<i class="entypo-logout"></i>
					<span>Sair</span>
				</a>
			</li>
	<?php } ?>			

   </html>     