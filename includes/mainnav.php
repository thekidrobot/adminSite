<ul id="mainNav">
	<li><a href="menuadmin.php"
	<?php if($currentPage == "menuadmin.php" or
					 $currentPage == "addLive.php" or 	
					 $currentPage == "viewLive.php" or 	
					 $currentPage == "searchLive.php") echo "class='active'";
	?>		
	><?=_("Live Tv")?></a></li>
	<li><a href="#"><?=_("EPG")?></a></li>
	<li><a href="viewVod.php"
	<?php 
	if($currentPage == "addVod.php" or
					 $currentPage == "viewVod.php" or 	
					 $currentPage == "searchVod.php") echo "class='active'";
	?>
	><?=_("VOD")?></a></li>
	<li><a href="categoriasVideos.php"><?=_("Categories")?></a></li>
	<li><a href="gruposPaquetes.php"><?=_("Packages")?></a></li>
	<li><a href="admusuarios.php"><?=_("Subscribers")?></a></li>
	<li><a href="#"><?=_("Reports")?></a></li>
	<li><a href="#"><?=_("Support")?></a></li>
	<li><a href="#"><?=_("FAQ")?></a></li>
	<li class="logout"><a href="index.php"><?=_("Logout")?></a></li>
</ul>