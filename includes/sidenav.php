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
		else
		{
			
		}
	?>
</ul>
<!-- // .sideNav -->