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
							$whereCondicion .= " name LIKE '%" . $strBusca . "%' ";
							break;
						
						case "description":
				
							if($whereCondicion != "") $whereCondicion .= " and ";
							$whereCondicion .= " description LIKE '%" . $strBusca . "%' ";
							break;
						
						case "rating":
				
							if($whereCondicion != "") $whereCondicion .= " and ";
							$whereCondicion .= " rating in( select id from ratings where code LIKE '%" . $strBusca . "%')";
							break;
						
						case "number":
				
							if($whereCondicion != "") $whereCondicion .= " and ";
							$whereCondicion .= " number LIKE '%" . $strBusca . "%' ";
							break;
					}
					
					if($whereCondicion != "")	$whereCondicion = " and " . $whereCondicion;	
				}
				
				$userid = $_SESSION['id'];
				
				$sql_getData = "SELECT DISTINCT lc.*
												FROM
												 livechannels lc,
												 packages_livechannels pl,
												 subscribers_packages sp
												WHERE
												 lc.id = pl.resource_id AND
												 pl.package_id = sp.package_id AND
												 sp.subscriber_id = $userid ". " ". $whereCondicion . "
												 ORDER BY lc.number";
				
				?>
		
				<div id="main">
					<h2><a href="#"><?=_("Live TV")?></a> &raquo; <a href="#" class="active"><?=_("Find live channels")?></a></h2>
						<form method="post" action="<?=$currentPage?>" class="jNice">
						<fieldset>
						<p>
							<label><?=_("Select a search criteria")?></label>
							<input type="text" name="strBusca" value="<?=$strBusca ?>" class="text-long">
						</p>
						<p>
							<label><?=_("Select a search filter")?></label>
							<select name="condicion">
								<option value="name" <?php if ($condicion == "name") echo "selected='selected'" ?>><?=_("Channel Name")?></option>
								<option value="description" <?php if ($condicion == "description") echo "selected='selected'" ?>><?=_("Channel Description")?></option>
								<option value="rating" <?php if ($condicion == "rating") echo "selected='selected'" ?>><?=_("Channel Rating")?></option>
								<option value="number" <?php if ($condicion == "number") echo "selected='selected'" ?>><?=_("Channel Number")?></option>
							</select>
						</p>
						<p>
							<label>&nbsp;</label>
							<input name="find" type="submit" value="<?=_("Find")?>" />
						</p>
						</fieldset>
						</form>
		
				<?php
					
					if($_POST['strBusca']!= "")
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
							 ?>
								<td>
								 <div class="imageSingle">
									<div class="image">
									 <a href="player.php?id=<?=$rs_getData->fields['id']; ?>&type=1&iframe=true&width=640&height=480" rel="prettyPhoto[player]" title="Player for channel <?=$rs_getData->fields['name']; ?>">
										<img src="../data/images/<?=$thumb ?>" />
									 </a>									
									 <div class="caption">
										<b># <?=$rs_getData->fields['number']; ?> : </b><?=$rs_getData->fields['name']; ?><br />
										<?=$rs_getData->fields['description']; ?><br />
										 <div class="actions">
											<a href="viewEpgFrm.php?id=<?=$rs_getData->fields['id']?>&iframe=true&width=1200&height=1000" rel="prettyPhoto[epg]" title="View EPG for channel <?=$rs_getData->fields['name']; ?>"><img src="images/icons/calendar.png" alt="<?=_("View EPG")?>" class="icon" /></a>
											<a href="viewLiveDetailFrm.php?id=<?=$rs_getData->fields['id']?>&iframe=true&width=1000&height=1000"" rel="prettyPhoto[details]" title="View Details for channel <?=$rs_getData->fields['name']; ?>"><img src="images/icons/more_details.png" alt="<?=_("More Details")?>" class="icon" /></a>
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
								$rs_getData->MoveNext();
							}
							?>
							</tr>
						</table>
					</div>		 
							
					<?php
					 if($counter == 0)
					 {
						?>
						<h3><?=_("No data found")?></h3>
						<?php
					 }
				 }
				?>

				 </div><!-- // #main -->
				<script type="text/javascript" src="js/tablesort.js"></script>
				<script type="text/javascript" src="js/pagination.js"></script>
      <div class="clear"></div>
    </div><!-- // #container -->
    </div><!-- // #containerHolder -->
  <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>