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

				<?php
				
				$strBusca = $_POST['strBusca'];
				$condicion = $_POST['condicion'];
				$whereCondicion="";
				
				if($_POST['strBusca']!= "")
				{
					switch ($condicion)
					{
						case "name":
						
							if($whereCondicion != "") $whereCondicion = " and ";
							$whereCondicion .= " vc.name LIKE '%" . $strBusca . "%' ";
							break;
						
						case "description":
				
							if($whereCondicion != "") $whereCondicion .= " and ";
							$whereCondicion .= " vc.description LIKE '%" . $strBusca . "%' ";
							break;
						
						case "trainer":
				
							if($whereCondicion != "") $whereCondicion .= " and ";
							$whereCondicion .= " vc.trainer LIKE '%" . $strBusca . "%' ";
							break;
						
						case "date_release":
				
							if($whereCondicion != "") $whereCondicion .= " and ";
							$whereCondicion .= " vc.date_release LIKE '%" . $strBusca . "%' ";
							break;
						
						case "keywords":
				
							if($whereCondicion != "") $whereCondicion .= " and ";
							$whereCondicion .= " vc.keywords LIKE '%" . $strBusca . "%' ";
							break;
						
					}
					
					if($whereCondicion != "")	$whereCondicion = " and " . $whereCondicion;	
				}
				
				$userid = $_SESSION['id'];
				
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
												tc.subscriber_id = $userid ". " ". $whereCondicion . " 
												ORDER BY vc.id DESC";
				?>
		
				<div id="main">
					<h2><a href="#"><?=_("Video on demand")?></a> &raquo; <a href="#" class="active"><?=_("Find VOD Movies")?></a></h2>
						<form method="post" action="<?=$currentPage?>" class="jNice">
						<fieldset>
						<p>
							<label><?=_("Select a search criteria")?></label>
							<input type="text" name="strBusca" value="<?=$strBusca ?>" class="text-long">
						</p>
						<p>
							<label><?=_("Select a search filter")?></label>
							<select name="condicion">
								<option value="name" <?php if ($condicion == "name") echo "selected='selected'" ?>><?=_("Movie Name")?></option>
								<option value="description" <?php if ($condicion == "description") echo "selected='selected'" ?>><?=_("Movie Description")?></option>
								<option value="trainer" <?php if ($condicion == "trainer") echo "selected='selected'" ?>><?=_("Trainer / Director")?></option>
								<option value="date_release" <?php if ($condicion == "date_release") echo "selected='selected'" ?>><?=_("Release Date")?></option>
								<option value="keywords" <?php if ($condicion == "keywords") echo "selected='selected'" ?>><?=_("Keywords")?></option>
							</select>
						</p>
						<p>
							<label>&nbsp;</label>
							<input name="find" type="submit" value="<?=_("Find")?>" />
						</p>
						</fieldset>
						</form>
		
				<?php
					
					if(trim($_POST['strBusca']!= ""))
					{
					 $counter = 0;
					 ?>
					 <div class="album">
						<table class="gallery paginate-2 max-pages-6">
						 <tr>
						 <?php
						 $rs_getData = $DB->Execute($sql_getData);
						 while (!$rs_getData->EOF)
						 {
						  $counter++;
						  $thumb=getThumbnail($rs_getData->fields['small_pic']);
									
						  $sql = "select resource_path from vodchannels_resources
											where channel_id = ".$rs_getData->fields['id'];
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
										<a href="viewVodDetailFrm.php?id=<?=$rs_getData->fields['id']?>&iframe=true&width=800&height=550" rel="prettyPhoto[details]" title="View Details for video <?=$rs_getData->fields['name']; ?>">
										 <img src="images/icons/more_details.png" alt="<?=_("More Details")?>" class="icon" />
										</a>
										
										<a href="player.php?id=<?=$rs_getData->fields['id']; ?>&type=2&iframe=true&width=640&height=480" rel="prettyPhoto[player]" title="View Local">
										 <img src="images/icons/view_local.png" alt="<?=_("View Local")?>" class="icon" />
										</a>
															
										<a href="player.php?id=<?=$rs_getData->fields['id']; ?>&type=3&iframe=true&width=640&height=480" rel="prettyPhoto[player]" title="View trough Internet">
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
										 <br />No additional resources found.
										 <?
										}
									 ?>
								 </div>
								</div>
				
								</td>
								<?
								 if ($counter%2 == 0){
								 ?>
								  </tr>
									<tr>
									<?
								 }
								 $rs_getData->MoveNext();
						 }?>
						 </tr>
						</table>
							 
						<?php
						 if($counter == 0)
						 {
							?>
							 <h3><?=_("No data found")?></h3>
							 <?php
						 }
						 ?>				
						</div>
					 <?php
					}
					?>
				 </div><!-- // #main -->
				<script type="text/javascript" src="js/pagination.js"></script>
      <div class="clear"></div>
    </div><!-- // #container -->
    </div><!-- // #containerHolder -->
  <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>