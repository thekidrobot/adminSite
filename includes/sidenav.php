<ul class="sideNav">
	<?php
		if($currentPage == "menuadmin.php"
			 or $currentPage == "addLive.php"
			 or $currentPage == "viewLive.php"
			 or $currentPage == "searchLive.php"
			 ){
			?>
			<li><a href="viewLive.php" <?php if($currentPage == "viewLive.php") echo "class='active'"?> ><?=_("View Live Channels")?></a></li>
			<li><a href="addLive.php" <?php if($currentPage == "addLive.php") echo "class='active'"?> ><?=_("Add Live Channel")?></a></li>
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
			<li><a href="viewVod.php" <?php if($currentPage == "viewVod.php") echo "class='active'"?> ><?=_("View VOD Movies")?></a></li>
			<li><a href="addVod.php" <?php if($currentPage == "addVod.php") echo "class='active'"?> ><?=_("Add VOD Movie")?></a></li>
			<li><a href="searchVod.php" <?php if($currentPage == "searchVod.php") echo "class='active'"?> ><?=_("Search VOD Movies")?></a></li>
			<?
		}
		
		elseif($currentPage == "viewVodCategories.php" or
					 $currentPage == "searchVodCategory.php" or
					 $currentPage == "addVodContent.php" 
					)
		{
			?>
			<li><a href="viewVodCategories.php" <?php if($currentPage == "viewVodCategories.php") echo "class='active'"?> > <?=_("View VOD Categories")?></a></li>
			<li><a href="createVodCategory.php" <?php if($currentPage == "createVodCategory.php") echo "class='active'"?> > <?=_("Create VOD Category")?></a></li>
			<li><a href="searchVodCategory.php" <?php if($currentPage == "searchVodCategory.php") echo "class='active'"?> > <?=_("Find VOD Category")?></a></li>
			<?
		}
		elseif($currentPage == "searchVodCategory.php" or
					 $currentPage == "viewVodDetail.php"
					)
		{
			?>
			<li><a href="#" <?php if($currentPage == "viewVodDetail.php") echo "class='active'"?> > <?=_("View Category detail")?></a></li>
			<li><a href="createVodCategory.php?cat_id=<?=$id?>" <?php if($currentPage == "createVodCategory.php") echo "class='active'"?> > <?=_("Edit this category")?></a></li>
			<li><a href="viewVodCategories.php?del=<?=$id?>" <?php if($currentPage == "viewVodCategories.php") echo "class='active'"?> onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" > <?=_("Delete this category")?></a></li>		
			<li><a href="viewVodCategories.php" <?php if($currentPage == "viewVodCategories.php") echo "class='active'"?> > <?=_("Back to all categories")?></a></li>
			<?
		}
		elseif($currentPage == "createVodCategory.php")
		{
			if($_GET['cat_id'] != ''){
				?>
				<li><a href="viewVodDetail.php?cat_id=<?=$id?>" <?php if($currentPage == "viewVodDetail.php") echo "class='active'"?> > <?=_("View Category detail")?></a></li>
				<li><a href="createVodCategory.php?cat_id=<?=$id?>" <?php if($currentPage == "createVodCategory.php") echo "class='active'"?> > <?=_("Edit this category")?></a></li>
				<li><a href="viewVodCategories.php?del=<?=$id?>" <?php if($currentPage == "viewVodCategories.php") echo "class='active'"?> onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" > <?=_("Delete this category")?></a></li>		
				<li><a href="viewVodCategories.php" <?php if($currentPage == "viewVodCategories.php") echo "class='active'"?> > <?=_("Back to all categories")?></a></li>
				<?
			}
			else
			{
				?>
				<li><a href="viewVodCategories.php" <?php if($currentPage == "viewVodCategories.php") echo "class='active'"?> > <?=_("View VOD Categories")?></a></li>
				<li><a href="createVodCategory.php" <?php if($currentPage == "createVodCategory.php") echo "class='active'"?> > <?=_("Create VOD Category")?></a></li>
				<li><a href="searchVodCategory.php" <?php if($currentPage == "searchVodCategory.php") echo "class='active'"?> > <?=_("Find VOD Category")?></a></li>				
				<?
			}
		}
		elseif($currentPage == "viewPackages.php" or
					 $currentPage == "viewPackageDetail.php" or 	
					 $currentPage == "addPackageContentLive.php" or 	
					 $currentPage == "addPackageContentVod.php" or
					 $currentPage == "searchPackage.php" or
					 $currentPage == "createPackage.php")
		{
			?>
			<li><a href="viewPackages" <?php if($currentPage == "viewPackages.php") echo "class='active'"?> > <?=_("View packages")?></a></li>
			<li><a href="createPackage.php" <?php if($currentPage == "createPackage.php") echo "class='active'"?> > <?=_("Create new package")?></a></li>
			<li><a href="searchPackage.php" <?php if($currentPage == "searchPackage.php") echo "class='active'"?>> <?=_("Find packages")?></a></li>
			<?
		}		
		
	?>
</ul>
<!-- // .sideNav -->