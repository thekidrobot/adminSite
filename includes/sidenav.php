<ul class="sideNav">
	<?php
		/*******************LIVE TV****************************/
	
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
		elseif($currentPage == "editLive.php" or
					$currentPage == "viewLiveDetail.php"){
			?>
			<li><a href="viewLiveDetail.php?id=<?=$id?>" <?php if($currentPage == "viewLiveDetail.php") echo "class='active'" ?>> <?=_("View Channel Details")?></a></li>
			<li><a href="editLive.php?edit=<?=$id?>" <?php if($currentPage == "editLive.php") echo "class='active'" ?>><?=_("Edit this channel")?></a></li>
			<li><a href="viewLive.php?del=<?=$id?>" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" ><?=_("Delete this channel")?></a></li>
			<li><a href="viewLive.php"><?=_("Go to the Channel List")?></a></li>
			<?
		}
		/**************** EPG *******************************/
		elseif($currentPage == "epg.php" or
					 $currentPage == "viewEpg.php" or
					 $currentPage == "viewEpgDetails.php"
					 )
		{
			?>
			<li><a href="viewEpg.php" <?php if($currentPage == "viewEpg.php" or $currentPage == "viewEpgDetails.php") echo "class='active'"?> ><?=_("View EPG")?></a></li>
			<li><a href="epg.php" <?php if($currentPage == "epg.php") echo "class='active'"?> ><?=_("Add EPG")?></a></li>
			<?
		}
		
		/**************** OnDemand *******************************/
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
		elseif($currentPage == "viewVodMovieDetail.php" or
					 $currentPage == "editVodMovieDetail.php"){
			?>
			<li><a href="viewVodMovieDetail.php?id=<?=$id?>" <?php if($currentPage == "viewVodMovieDetail.php") echo "class='active'"?> ><?=_("View VOD movie detail")?></a></li>
			<li><a href="editVodMovieDetail.php?edit=<?=$id?>" <?php if($currentPage == "editVodMovieDetail.php") echo "class='active'"?> ><?=_("Edit this movie")?></a></li>
			<li><a href="viewVod.php?del=<?=$id?>" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" ><?=_("Delete this movie")?></a></li>
			<li><a href="viewVod.php" <?php if($currentPage == "viewVod.php") echo "class='active'"?> ><?=_("Go to the movies list")?></a></li>
			<?
		}
		/************* Categories *******************************/
		
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
		/******************** Packages *************************/
		
		elseif($currentPage == "viewPackages.php" or
					 $currentPage == "searchPackage.php") 
		{
			?>
			<li><a href="viewPackages.php" <?php if($currentPage == "viewPackages.php") echo "class='active'"?> > <?=_("View packages")?></a></li>
			<li><a href="createPackage.php" <?php if($currentPage == "createPackage.php") echo "class='active'"?> > <?=_("Create new package")?></a></li>
			<li><a href="searchPackage.php" <?php if($currentPage == "searchPackage.php") echo "class='active'"?>> <?=_("Find packages")?></a></li>
			<?
		}		
		elseif($currentPage == "viewPackageDetail.php" or 	
					 $currentPage == "searchPackage.php"
					 )
		{
			?>
			<li><a href="#" <?php if($currentPage == "viewPackageDetail.php") echo "class='active'"?> > <?=_("View package detail")?></a></li>			
			<li><a href="addPackageContentVod.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "addPackageContentVod.php") echo "class='active'"?> > <?=_("View / Add VOD content")?></a></li>		
			<li><a href="addPackageContentLive.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "addPackageContentLive.php") echo "class='active'"?> > <?=_("View / Add Live Content")?></a></li>						
			<li><a href="createPackage.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "createPackage.php") echo "class='active'"?> > <?=_("Edit this package")?></a></li>
			<li><a href="viewPackages.php?del=<?=$pck_id ?>" <?php if($currentPage == "viewPackages.php") echo "class='active'"?> onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')"> <?=_("Delete this package")?></a></li>
			<li><a href="viewPackages.php" <?php if($currentPage == "viewPackages.php") echo "class='active'"?>> <?=_("Back to package list")?></a></li>
			<?
		}
		elseif($currentPage == "createPackage.php")
		{
			if($_GET['pck_id'] != "" or $_POST['flgEdit'] != "")
			{
				if($_GET['pck_id'] !="") $pck_id = $_GET['pck_id'];
				else 	$pck_id = $_POST['flgEdit'];
			?>
				<li><a href="viewPackageDetail.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "viewPackageDetail.php") echo "class='active'"?> > <?=_("View package detail")?></a></li>
				<li><a href="addPackageContentVod.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "addPackageContentVod.php") echo "class='active'"?> > <?=_("View / Add VOD content")?></a></li>		
				<li><a href="addPackageContentLive.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "addPackageContentLive.php") echo "class='active'"?> > <?=_("View / Add Live Content")?></a></li>			
				<li><a href="createPackage.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "createPackage.php") echo "class='active'"?> > <?=_("Edit this package")?></a></li>
				<li><a href="viewPackages.php?del=<?=$pck_id ?>" <?php if($currentPage == "viewPackages.php") echo "class='active'"?> onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')"> <?=_("Delete this package")?></a></li>
				<li><a href="viewPackages.php" <?php if($currentPage == "viewPackages.php") echo "class='active'"?>> <?=_("Back to package list")?></a></li>
			<?	
			}
			else
			{
				?>
				<li><a href="viewPackages.php" <?php if($currentPage == "viewPackages.php") echo "class='active'"?> > <?=_("View packages")?></a></li>
				<li><a href="createPackage.php" <?php if($currentPage == "createPackage.php") echo "class='active'"?> > <?=_("Create new package")?></a></li>
				<li><a href="searchPackage.php" <?php if($currentPage == "searchPackage.php") echo "class='active'"?>> <?=_("Find packages")?></a></li>
				<?	
			}
		}
		elseif($currentPage == "addPackageContentVod.php")
		{
		?>
			<li><a href="viewPackageDetail.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "viewPackageDetail.php") echo "class='active'"?> > <?=_("View package detail")?></a></li>
			<li><a href="#" <?php if($currentPage == "addPackageContentVod.php") echo "class='active'"?> > <?=_("View / Add VOD content")?></a></li>
			<li><a href="addPackageContentLive.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "addPackageContentLive.php") echo "class='active'"?> > <?=_("View / Add Live Content")?></a></li>
			<li><a href="createPackage.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "createPackage.php") echo "class='active'"?> > <?=_("Edit this package")?></a></li>
			<li><a href="viewPackages.php?del=<?=$pck_id ?>" <?php if($currentPage == "viewPackages.php") echo "class='active'"?> onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')"> <?=_("Delete this package")?></a></li>
			<li><a href="viewPackages.php" <?php if($currentPage == "viewPackages.php") echo "class='active'"?>> <?=_("Back to package list")?></a></li>
		<?	
		}
		elseif($currentPage == "addPackageContentLive.php")
		{
		?>
			<li><a href="viewPackageDetail.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "viewPackageDetail.php") echo "class='active'"?> > <?=_("View package detail")?></a></li>
			<li><a href="addPackageContentVod.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "addPackageContentVod.php") echo "class='active'"?> > <?=_("View / Add VOD content")?></a></li>		
			<li><a href="#" <?php if($currentPage == "addPackageContentLive.php") echo "class='active'"?> > <?=_("View / Add Live Content")?></a></li>
			<li><a href="createPackage.php?pck_id=<?=$pck_id ?>" <?php if($currentPage == "createPackage.php") echo "class='active'"?> > <?=_("Edit this package")?></a></li>
			<li><a href="viewPackages.php?del=<?=$pck_id ?>" <?php if($currentPage == "viewPackages.php") echo "class='active'"?> onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')"> <?=_("Delete this package")?></a></li>
			<li><a href="viewPackages.php" <?php if($currentPage == "viewPackages.php") echo "class='active'"?>> <?=_("Back to package list")?></a></li>
		<?	
		}
		/************************ Subscribers **********************************/
		elseif($currentPage == "viewSubscribers.php" or 
					 $currentPage == "viewSubscribers.php" or
					 $currentPage == "searchSubscriber.php"
					 )
		{
		?>
			<li><a href="viewSubscribers.php" <?php if($currentPage == "viewSubscribers.php") echo "class='active'"?> > <?=_("View Subscribers")?></a></li>					
			<li><a href="createSubscriber.php" <?php if($currentPage == "createSubscriber.php") echo "class='active'"?> > <?=_("Create New Subscriber")?></a></li>
			<li><a href="searchSubscriber.php" <?php if($currentPage == "searchSubscriber.php") echo "class='active'"?> > <?=_("Search Subscribers")?></a></li>
		<?	
		}
		elseif($currentPage == "viewSubscriberDetail.php" or
					 $currentPage == "addSubscriberPackage.php" or
					 $currentPage == "ticketSubscriber.php"
					 )
		{
		?>
			<li><a href="addSubscriberPackage.php?usr_id=<?=$usr_id?>" <?php if($currentPage == "addSubscriberPackage.php") echo "class='active'"?> > <?=_("View / Add user packages")?></a></li>
			<li><a href="viewSubscriberDetail.php?usr_id=<?=$usr_id?>" <?php if($currentPage == "viewSubscriberDetail.php") echo "class='active'"?> > <?=_("View Subscriber Detail")?></a></li>
			<li><a href="ticketSubscriber.php?usr_id=<?=$usr_id?>" <?php if($currentPage == "ticketSubscriber.php") echo "class='active'"?> > <?=_("Manage Tickets")?></a></li>
			<li><a href="viewSubscribers.php?del=<?=$usr_id?>" <?php if($currentPage == "viewSubscribers.php") echo "class='active'"?> onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" > <?=_("Delete this Subscriber")?></a></li>
			<li><a href="viewSubscribers.php" <?php if($currentPage == "viewSubscribers.php") echo "class='active'"?> > <?=_("Back to subscribers list")?></a></li>
		<?	
		}
		elseif($currentPage == "createSubscriber.php")
		{
			if($_POST['flgEdit'] != "" or $_POST['updUsr'] != "")
			{
				if ($_POST['flgEdit'] != "") $usr_id = $_POST['flgEdit'];
				else $usr_id = $_POST['updUsr'];
				?>
				<li><a href="#" <?php if($currentPage == "createSubscriber.php") echo "class='active'"?> > <?=_("Edit Subscriber Detail")?></a></li>		
				<li><a href="viewSubscriberDetail.php?usr_id=<?=$usr_id?>" <?php if($currentPage == "viewSubscriberDetail.php") echo "class='active'"?> > <?=_("View Subscriber Detail")?></a></li>		
				<li><a href="addSubscriberPackage.php?usr_id=<?=$usr_id?>" <?php if($currentPage == "addSubscriberPackage.php") echo "class='active'"?> > <?=_("View / Add user packages")?></a></li>
				<li><a href="viewSubscribers.php?del=<?=$usr_id?>" <?php if($currentPage == "viewSubscribers.php") echo "class='active'"?> onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" > <?=_("Delete this Subscriber")?></a></li>
				<li><a href="viewSubscribers.php" <?php if($currentPage == "viewSubscribers.php") echo "class='active'"?> > <?=_("Back to subscribers list")?></a></li>
				<?
			}
			else
			{
				?>
				<li><a href="viewSubscribers.php" <?php if($currentPage == "viewSubscribers.php") echo "class='active'"?> > <?=_("View Subscribers")?></a></li>		
				<li><a href="createSubscriber.php" <?php if($currentPage == "createSubscriber.php") echo "class='active'"?> > <?=_("Create New Subscriber")?></a></li>
				<li><a href="searchSubscriber.php" <?php if($currentPage == "searchSubscriber.php") echo "class='active'"?> > <?=_("Search Subscribers")?></a></li>
				<?	
			}
		}
		/************************ Trainers **********************************/
		elseif($currentPage == "addTrainer.php" or 
					 $currentPage == "viewTrainers.php" or
					 $currentPage == "searchTrainer.php")
		{
			?>
			<li><a href="viewTrainers.php" <?php if($currentPage == "viewTrainers.php") echo "class='active'"?> > <?=_("View Trainers")?></a></li>
			<li><a href="addTrainer.php" <?php if($currentPage == "addTrainer.php") echo "class='active'"?> > <?=_("Create new Trainer")?></a></li>		
			<li><a href="searchTrainer.php" <?php if($currentPage == "searchTrainer.php") echo "class='active'"?> > <?=_("Search Trainers")?></a></li>
			<?	
		}
		elseif($currentPage == "viewTrainerDetail.php" or 
					 $currentPage == "editTrainerDetail.php"){
			?>
				<li><a href="viewTrainerDetail.php?id=<?=$id?>" <?php if($currentPage == "viewTrainerDetail.php") echo "class='active'"?> > <?=_("View Trainer Detail")?></a></li>		
				<li><a href="editTrainerDetail.php?edit=<?=$id?>" <?php if($currentPage == "editTrainerDetail.php") echo "class='active'"?> > <?=_("Edit Trainer Detail")?></a></li>
				<?
					$cntTrainers = 0;
					$readonly = "";
					$sql= "select name from vodchannels where trainer = $id";
					$rsGetTrainers = $DB->execute($sql);
					$cntTrainers = $rsGetTrainers->RecordCount();
					if($cntTrainers > 0){
						?>
						<li><a href="#" onclick="return alert('<?=_("You cannot delete a trainer with videos assigned to it.")?>')" > <?=_("Delete this Trainer")?></a></li>
						<?
					}
					else{
						?>
						<li><a href="viewTrainers.php?del=<?=$id?>" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" > <?=_("Delete this Trainer")?></a></li>
						<?
					}
				?>
				<li><a href="viewTrainers.php" <?php if($currentPage == "viewTrainers.php") echo "class='active'"?> > <?=_("Back to trainers list")?></a></li>
			<?
		}
		/************************ Restrictions **********************************/
		elseif($currentPage == "createRestriction.php" or 
					 $currentPage == "viewRestrictions.php" or
					 $currentPage == "searchRestriction.php")
		{
			?>
			<li><a href="viewRestrictions.php" <?php if($currentPage == "viewRestrictions.php") echo "class='active'"?> > <?=_("View Restrictions")?></a></li>
			<li><a href="createRestriction.php" <?php if($currentPage == "createRestriction.php") echo "class='active'"?> > <?=_("Create new Restriction")?></a></li>		
			<li><a href="searchRestriction.php" <?php if($currentPage == "searchRestriction.php") echo "class='active'"?> > <?=_("Search Restrictions")?></a></li>
			<?	
		}
		elseif($currentPage == "viewRestrictionDetail.php" or 
					 $currentPage == "editRestrictionDetail.php"){
			?>
				<li><a href="viewRestrictionDetail.php?id=<?=$id?>" <?php if($currentPage == "viewRestrictionDetail.php") echo "class='active'"?> > <?=_("View Restriction Detail")?></a></li>		
				<li><a href="editRestrictionDetail.php?id=<?=$id?>" <?php if($currentPage == "editRestrictionDetail.php") echo "class='active'"?> > <?=_("Edit Restriction Detail")?></a></li>		

				<?
					$cntRestrictions = 0;
					$readonly = "";
					$sql= "select restriction_id from tickets where restriction_id = $id";
					$rsGetRestrictions = $DB->execute($sql);
					$cntRestrictions = $rsGetRestrictions->RecordCount();
					if($cntRestrictions > 0){
						?>
						<li><a href="#" onclick="return alert('<?=_("You cannot delete a restriction with videos assigned to it.")?>')" > <?=_("Delete this Restriction")?></a></li>
						<?
					}
					else{
						?>
						<li><a href="viewRestrictions.php?del=<?=$id?>" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" > <?=_("Delete this Restiction")?></a></li>
						<?
					}
				?>
				<li><a href="viewRestrictions.php" <?php if($currentPage == "viewRestrictions.php") echo "class='active'"?> > <?=_("Back to restrictions list")?></a></li>
			<?
		}		
	?>
</ul>
<!-- // .sideNav -->