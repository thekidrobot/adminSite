<ul id="mainNav">
	<li><a href="menuadmin.php"
	<?php if($currentPage == "menuadmin.php" or
					 $currentPage == "addLive.php" or 	
					 $currentPage == "viewLive.php" or 	
					 $currentPage == "editLive.php" or 	
					 $currentPage == "viewLiveDetail.php" or 	
					 $currentPage == "searchLive.php") echo "class='active'";
	?>		
	><?=_("Live TV")?></a></li>
	<li><a href="viewEpg.php"
	<?php 
	if($currentPage == "epg.php" or
		 $currentPage == "viewEpgDetails.php" or
		 $currentPage == "viewEpg.php"
		 ) echo "class='active'";
	?>
	><?=_("EPG")?></a></li>
	<li><a href="viewVod.php"
	<?php 
	if($currentPage == "addVod.php" or
					 $currentPage == "viewVod.php" or 	
					 $currentPage == "searchVod.php" or
					 $currentPage == "addVodCsv.php" or
					 $currentPage == "editVodMovieDetail.php" or
					 $currentPage == "viewVodMovieDetail.php") echo "class='active'";
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
					 $currentPage == "searchPackage.php" or
					 $currentPage == "createPackage.php"
					 ) echo "class='active'";
	?>
	><?=_("Packages")?></a></li>
	<li><a href="viewTrainers.php"
	<?php if($currentPage == "addTrainer.php" or
					 $currentPage == "viewTrainers.php" or 	
					 $currentPage == "viewTrainerDetail.php" or
					 $currentPage == "editTrainerDetail.php" or
					 $currentPage == "searchTrainer.php"
					 ) echo "class='active'";
	?>
	><?=_("Trainers")?></a></li>
	<li><a href="viewSubscribers.php"
	<?php if($currentPage == "createSubscriber.php" or
					 $currentPage == "addSubscriberPackage.php" or 	
					 $currentPage == "viewSubscribers.php" or
					 $currentPage == "ticketSubscriber.php" or
					 $currentPage == "ticketSubscriberGlobal.php" or
					 $currentPage == "viewSubscriberDetail.php"
					 ) echo "class='active'";
	?>
	><?=_("Subscribers")?></a></li>
	<li><a href="viewRestrictions.php"
	<?php if($currentPage == "createRestriction.php" or
					 $currentPage == "viewRestrictions.php" or
					 $currentPage == "viewRestrictionDetail.php" or
					 $currentPage == "editRestrictionDetail.php" or
					 $currentPage == "searchRestriction.php"
					 ) echo "class='active'";
	?>	
	><?=_("Restrictions")?></a></li>
	<li><a href="#"><?=_("FAQ")?></a></li>
	<li class="logout"><a href="index.php"><?=_("Logout")?></a></li>
</ul>