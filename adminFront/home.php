<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include ("includes/head.php") ?>
<body>
 <div id="wrapper">
  <h1><a href="menuadmin.php"></a></h1>
	<?php include("includes/mainnav.php") ?>
	<!-- // #end mainNav -->
	<div id="containerHolder">
	 <div id="container">
		<div id="sidebar">
		 <?php include("includes/sidenav.php") ?>
		</div>    
		<!-- // #sidebar -->
		<div id="main">
		
		 <h2><a href="#"><?=_("Live TV")?></a> &raquo; <a href="#" class="active"><?=_("View live channels")?></a></h2>
			
			<div class="album">
			 <table class="gallery paginate-2 max-pages-6">
			 <tr>
			 <?php
			 $sql_getData = "SELECT DISTINCT lc.*
											 FROM
											  livechannels lc,
												packages_livechannels pl,
												subscribers_packages sp
											 WHERE
											  lc.id = pl.resource_id AND
												pl.package_id = sp.package_id AND
												sp.subscriber_id = ".$_SESSION['id'].
											" ORDER BY lc.number";
											 
			 $rs_getData = $DB->Execute($sql_getData);
			 
			 $counter = 1;
			 
				while (!$rs_getData->EOF)
				{
					$thumb=getThumbnail($rs_getData->fields['small_pic']);
					
					$sql = "select code from ratings where id = ".$rs_getData->fields['rating'];
					$rsGetRating = $DB->execute($sql);
					
					?>
						<td>
							<div class="imageSingle">
								<div class="image">
									<a href="http://youtu.be/2qR_94Jmg4A" rel="prettyPhoto" title="">
										<img src="../data/images/<?=$thumb ?>" />
									</a>									
									<div class="caption">
										<b># <?=$rs_getData->fields['number']; ?> : </b><?=$rs_getData->fields['name']; ?><br />
										<?=$rs_getData->fields['description']; ?><br />
										<div class="actions">
											<a href="viewEpg.php?id=<?=$rs_getData->fields['id']?>&iframe=true&width=1800&height=1000" rel="prettyPhoto[epg]" title="View EPG for channel <?=$rs_getData->fields['name']; ?>"><img src="images/icons/calendar.png" alt="<?=_("View EPG")?>" class="icon" /></a>
											<a href="viewLiveDetail.php?id=<?=$rs_getData->fields['id']?>&iframe=true&width=1800&height=1000"" rel="prettyPhoto[details]" title="View Details for channel <?=$rs_getData->fields['name']; ?>"><img src="images/icons/more_details.png" alt="<?=_("More Details")?>" class="icon" /></a>
										</div>
									</div>
								</div>								
							</div>
						<td>
					<?
					if ($counter%2 == 0){
						?>
						</tr>
						<tr>
					<?
					}
					$counter++;
					$rs_getData->MoveNext();
				}?>
				</tr>
			</table>
		</div>
			
		<script type="text/javascript" src="js/pagination.js"></script>
	 </div><!-- // #main -->
	<div class="clear"></div>
 </div><!-- // #container -->
 </div><!-- // #containerHolder -->
 <p id="footer"></p>
 </div><!-- // #wrapper -->
</body>
</html>