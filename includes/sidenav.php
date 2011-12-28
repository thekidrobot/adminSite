<ul class="sideNav">
	<?php
		if($currentPage == "menuadmin.php"
			 or $currentPage == "addArchivo.php"
			 or $currentPage == "listarArchivos.php"
			 or $currentPage == "edicion.php" 
			 or $currentPage == "buscarArchivos.php"){
			?>
			<li><a href="addArchivo.php"><?=_("Add Live Channel")?></a></li>
			<li><a href="listarArchivos.php"><?=_("View Live Channels")?></a></li>
			<li><a href="buscarArchivos.php"><?=_("Search Live Channels")?></a></li>
			<?
		}
		elseif($currentPage == "categoriasVideos.php"
			 or $currentPage == "gruposUsuarios.php"
			 or $currentPage == "gruposPaquetes.php")
		{
			?>
			<li><a href="gruposUsuarios.php"><?=_("Group Users")?></a></li>
			<li><a href="gruposPaquetes.php"><?=_("Group Packages")?></a></li>
			<?
		}
	?>
</ul>
<!-- // .sideNav -->