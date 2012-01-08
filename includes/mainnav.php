<ul id="mainNav">
	<li><a href="menuadmin.php"
	<?php if($currentPage == "menuadmin.php" or
					 $currentPage == "addLive.php" or 	
					 $currentPage == "viewLive.php" or 	
					 $currentPage == "editLive.php" or 	
					 $currentPage == "viewLiveDetail.php" or 	
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
	<li><a href="viewVodCategories.php"
	<?php if($currentPage == "viewVodCategories.php" or
					 $currentPage == "searchVodCategory.php" or 	
					 $currentPage == "viewVodDetail.php" or 	
					 $currentPage == "createVodCategory.php" or
					 $currentPage == "addVodContent.php"
					 ) echo "class='active'";
	?>		
	><?=_("Categories")?></a></li>
	<li><a href="viewPackages.php"
	<?php if($currentPage == "viewPackages.php" or
					 $currentPage == "viewPackageDetail.php" or 	
					 $currentPage == "addPackageContentLive.php" or 	
					 $currentPage == "addPackageContentVod.php" or
					 $currentPage == "createPackage.php"
					 ) echo "class='active'";
	?>
	><?=_("Packages")?></a></li>
	<li><a href="admusuarios.php"><?=_("Subscribers")?></a></li>
	<li><a href="#"><?=_("Reports")?></a></li>
	<li><a href="#"><?=_("Support")?></a></li>
	<li><a href="#"><?=_("FAQ")?></a></li>
	<li class="logout"><a href="index.php"><?=_("Logout")?></a></li>
</ul>