<ul class="sideNav">
	<?php
		if($currentPage == "menuadmin.php"
			 or $currentPage == "addLive.php"
			 or $currentPage == "viewLive.php"
			 or $currentPage == "searchLive.php" 
			 or $currentPage == "editLive.php"){
			?>
			<li><a href="addLive.php"><?=_("Add Live Channel")?></a></li>
			<li><a href="viewLive.php"><?=_("View Live Channels")?></a></li>
			<li><a href="searchLive.php"><?=_("Search Live Channels")?></a></li>
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