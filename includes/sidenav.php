<ul class="sideNav">
	<?php
		if($currentPage == "menuadmin.php"
			 or $currentPage == "addLive.php"
			 or $currentPage == "viewLive.php"
			 or $currentPage == "searchLive.php"
			 ){
			?>
			<li><a href="addLive.php" <?php if($currentPage == "addLive.php") echo "class='active'"?> ><?=_("Add Live Channel")?></a></li>
			<li><a href="viewLive.php" <?php if($currentPage == "viewLive.php") echo "class='active'"?> ><?=_("View Live Channels")?></a></li>
			<li><a href="searchLive.php" <?php if($currentPage == "searchLive.php") echo "class='active'"?> ><?=_("Search Live Channels")?></a></li>
			<?
		}
		elseif($currentPage == "editLive.php"){
			?>
			<li><a href="viewLiveDetail.php?id=<?=$id?>" > <?=_("View Channel Details")?></a></li>
			<li><a href="editLive.php?edit=<?=$id?>" class='active'><?=_("Edit this channel")?></a></li>
			<li><a href="viewLive.php?del=<?=$id?>" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" ><?=_("Delete this channel")?></a></li>
			<li><a href="viewLive.php"><?=_("Go to the Channel List")?></a></li>
			<?
		}
		elseif($currentPage == "viewLiveDetail.php"){
			?>
			<li><a href="#" class='active'> <?=_("View Channel Details")?></a></li>
			<li><a href="editLive.php?edit=<?=$id?>" ><?=_("Edit this channel")?></a></li>
			<li><a href="viewLive.php?del=<?=$id?>" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" ><?=_("Delete this channel")?></a></li>
			<li><a href="viewLive.php"><?=_("Go to the Channel List")?></a></li>
			<?
		}
		
		
		elseif($currentPage == "viewVod.php"
			 or $currentPage == "addVod.php"
			 or $currentPage == "searchVod.php")
		{
			?>
			<li><a href="addVod.php" <?php if($currentPage == "addVod.php") echo "class='active'"?> ><?=_("Add VOD Movie")?></a></li>
			<li><a href="viewVod.php" <?php if($currentPage == "viewVod.php") echo "class='active'"?> ><?=_("View VOD Movies")?></a></li>
			<li><a href="searchVod.php" <?php if($currentPage == "searchVod.php") echo "class='active'"?> ><?=_("Search VOD Movies")?></a></li>
			<?
		}
		elseif($currentPage == "gruposUsuarios.php" or
					$currentPage == "gruposPaquetes.php")
		{
			?>
			<li><a href="gruposUsuarios.php"><?=_("Group Users")?></a></li>
			<li><a href="gruposPaquetes.php"><?=_("Group Packages")?></a></li>
			<?
		}
		
		elseif($currentPage == "categoriasVideos.php"){
			?>
			<li><a href="createVodCategory.php" <?php if($currentPage == "createVodCategory.php") echo "class='active'"?> > <?=_("Create VOD Category")?></a></li>
			<li><a href="searchVodCategory.php" <?php if($currentPage == "searchVodCategory.php") echo "class='active'"?> > <?=_("Find VOD Category")?></a></li>
			<?
		}
		
		
	?>
</ul>
<!-- // .sideNav -->