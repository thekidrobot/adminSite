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

		 <h2><a href="#"><?=_("Video OnDemand")?></a> &raquo; <a href="#" class="active"><?=_("View channels")?></a></h2>

			<?php
				$catId = $_POST['category'];
			?>
			
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<select name="category" class="styledselect_form_1">
				<option value="0"><?=_("All Categories")?></option>
				<?php
								
					//$sql = "SELECT
					//					vc.*
					//				FROM
					//					vodcategories vc,
					//					vod_channels_categories vcc,
					//					packages_vodchannels pv,
					//					subscribers_packages sp
					//				WHERE
					//					vc.id = vcc.category_id AND
					//					vc.id = pv.resource_id AND
					//					pv.package_id = sp.package_id AND
					//					sp.subscriber_id = ".$_SESSION['id']." AND
					//					vc.parent = 0
					//				ORDER BY
					//					vc.id";
					
					$sql = "SELECT * from vodcategories";
					
					$rsGet = $DB->Execute($sql);
					
					while (!$rsGet->EOF)
					{	
						?>
						<option value="<?=$rsGet->fields['id'] ?>" <?php if($catId == $rsGet->fields['id']) echo "selected='selected'" ?>><?=ucfirst(strtolower($rsGet->fields['name'])) ?></option>
						<?php
						$dad=$rsGet->fields['name'];
						//Second+ level menus - Sorry for the mess, Padre needs to be sent as a comparison value.
						make_kids($rsGet->fields['id'],$dad,$padre);
						$rsGet->MoveNext();
					}
					?>
				</select>
			</form>
			
			<div class="album">
			 <table class="gallery paginate-1 max-pages-6">
			 <tr>
			 <?php
			 $sql_getData = "SELECT
												vc.id,
												vc.name,
												tc.current_views,
												rc.max_views,
												rc.duration,
												vc.stb_url,
												vc.local_url
											 FROM
												vodchannels vc,
												tickets tc,
												restrictions rc
											 WHERE
											  vc.id = tc.resource_id AND
												tc.restriction_id  = rc.id AND
												tc.subscriber_id = ".$_SESSION['id'].
												" ORDER BY vc.id DESC";
										
			 $rs_getData = $DB->Execute($sql_getData);
			 
			 $counter = 1;
			 
				while (!$rs_getData->EOF)
				{
					$thumb=getThumbnail($rs_getData->fields['small_pic']);
					
					$sql = "select resource_path from vodchannels_resources where channel_id = ".$rs_getData->fields['id'];
					$rsGetResources = $DB->execute($sql);
					
					?>
						<td>
							<div class="imageSingle">
								<div class="image">
									<img src="../data/images/<?=$thumb ?>" />
									
									<div class="caption">
										<b><?=_("Name")?> : </b><?=$rs_getData->fields['name']; ?><br />
										<b><?=_("Current Views")?> : </b><?=$rs_getData->fields['current_views']; ?><br />
										<b><?=_("Max Views")?> : </b><?=$rs_getData->fields['max_views']; ?><br />
										<b><?=_("Validity (days)")?> : </b><?=$rs_getData->fields['duration']; ?><br />
										
										<div class="actions">
											<a href="viewVodDetail.php?id=<?=$rs_getData->fields['id']?>&iframe=true&width=100%&height=100%"" rel="prettyPhoto[details]" title="View Details for video <?=$rs_getData->fields['name']; ?>">
												<img src="images/icons/more_details.png" alt="<?=_("More Details")?>" class="icon" />
											</a>
											
											<a href="http://youtu.be/2qR_94Jmg4A" rel="prettyPhoto" title="<?=_("View Local")?>">
												<!--<a href="<?=$rs_getData->fields['local_url']?>" title="<?=_("View Local")?>">-->
												<img src="images/icons/view_local.png" alt="<?=_("View Local")?>" class="icon" />
											</a>
											
											<a href="http://youtu.be/2qR_94Jmg4A" rel="prettyPhoto" title="<?=_("View through Internet")?>">
											<!--<a href="<?=$rs_getData->fields['stb_url']?>" title="<?=_("View through Internet")?>">-->
												<img src="images/icons/view_internet.png" alt="<?=_("View trough Internet")?>" class="icon" />
											</a>
										</div>
									</div>
								</div>
							</div>
							
							<div class="imageSingle">
								<div class="image">
									<b><?=_("Additional Resources")?> : </b>
									<?php
										while (!$rsGetResources->EOF){
											?>
												<a href="<?=$rsGetResources->fields['resource_path']?>"><?=$rsGetResources->fields['resource_path']?></a><br />
											<?
											$rsGetResources->movenext();
										}
										if($rsGetResources->numrows()== 0){
										?>
										<br />No additional resources found
										<?
										}
									?>
								</div>
							</div>

						</td>
					<?
					if ($counter%4 == 0){
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