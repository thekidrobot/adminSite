<?
	$currentPage = $_SESSION['currentPage'];
?>

<ul class="sideNav">
	<?php
		if($currentPage == "categoriasVideos.php"){
			?>
			<li><a href="archivos/addArchivo.php" target="carga"><?=_("Add Live Channel")?></a></li>
			<li><a href="archivos/listarArchivos.php" target="carga"><?=_("View Live Channels")?></a></li>
			<li><a href="archivos/buscarArchivos.php" target="carga"><?=_("Search Live Channels")?></a></li>
			<?
		}
		else
		{
			
		}
	?>
	<!--<li><a href="archivos/listarArchivos.php" target="carga" class="active">Ver Arquivos</a></li>-->
	<!--<li><a href="archivos/addArchivo.php" target="carga" >Adicionar Arquivos</a></li>-->
	<!--<li><a href="archivos/buscarArchivos.php" target="carga">Buscar Arquivos</a></li>-->
	<!--<li><a href="#" target="carga"><?=_("FAQ")?></a></li>-->
	<!--<li><a href="#" target="carga"><?=_("Support")?></a></li>-->
</ul>
<!-- // .sideNav -->