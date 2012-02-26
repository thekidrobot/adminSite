<ul class="sideNav">
	<?php
		/*******************LIVE TV****************************/
	
		if($currentPage == "home.php"
			 or $currentPage == "searchLive.php"
			){
			?>
			<li><a href="home.php" <?php if($currentPage == "home.php") echo "class='active'"?> ><?=_("View Live Channels")?></a></li>
			<li><a href="searchLive.php" <?php if($currentPage == "searchLive.php") echo "class='active'"?> ><?=_("Search Live Channels")?></a></li>
			<?
		}
		
		/**************** OnDemand *******************************/
		elseif($currentPage == "vod.php"
			 or $currentPage == "searchVod.php")
		{
			?>
			<li><a href="vod.php" <?php if($currentPage == "vod.php") echo "class='active'"?> ><?=_("View VOD Movies")?></a></li>
			<li><a href="searchVod.php" <?php if($currentPage == "searchVod.php") echo "class='active'"?> ><?=_("Search VOD Movies")?></a></li>
			<?
		}
		
		/************* User Admin *******************************/
		
		elseif($currentPage == "settings.php" or
					 $currentPage == "support.php" or
					 $currentPage == "contact.php" 
					)
		{
			?>
			<li><a href="settings.php" <?php if($currentPage == "settings.php") echo "class='active'"?> > <?=_("Change User Data")?></a></li>			
			<li><a href="support.php" <?php if($currentPage == "support.php") echo "class='active'"?> > <?=_("Get support")?></a></li>
			<li><a href="contact.php" <?php if($currentPage == "contact.php") echo "class='active'"?> > <?=_("Contact Us")?></a></li>
			<?
		}
	?>
</ul>
<!-- // .sideNav -->