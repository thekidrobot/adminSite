<ul id="mainNav">
	<li><a href="home.php"
	<?php if($currentPage == "home.php"
					 or $currentPage == "searchLive.php") echo "class='active'";
	?>		
	><?=_("Live TV")?></a></li>
	<li><a href="vod.php"
	<?php 
	if($currentPage == "vod.php"
		 or $currentPage == "searchVod.php") echo "class='active'";
	?>
	><?=_("Video OnDemand")?></a></li>
	<li><a href="settings.php"
	<?php 
	if($currentPage == "settings.php"
		 or $currentPage == "support.php"
		 or $currentPage == "contact.php") echo "class='active'";
	?>
	><?=_("User Management")?></a></li>
	
	<li class="logout"><a href="logout.php"><?=_("Logout")?></a></li>
</ul>