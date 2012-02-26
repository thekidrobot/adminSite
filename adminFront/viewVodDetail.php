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
			
		<h2><a href="#"><?=_("Video OnDemand")?></a> &raquo; <a href="#" class="active"><?=_("View Details")?></a></h2>
		
		<?php
		
			$id = escape_value($_GET['id']);
			if(trim($id) == "" or !is_numeric($id) or $id == 0)
			{
				redirect("home.php");
			}
		
			//Todo: Filter this!
			$sql = "SELECT * FROM vodchannels WHERE id = $id";
			
			$rsGet = $DB->execute($sql);
		?>

			
				<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
					<tr>
						<th valign="top"><?=_("Actual Logo")?> : </th>
						<td>
							<?php
								$actual_filename = $getData->fields['small_pic'];
								$thumb = getThumbnail($actual_filename);
							?>
							<img style="margin-top:15px;" src="<?="../data/images/".$thumb?>">
						</td>
					</tr>
					
					<tr>
						<th><?=_("Movie Name")?> : </th>
						<td><?=$rsGet->fields['name']?></td>
					</tr>
					
					<tr>
						<th><?=_("Movie Description")?> : </th>
						<td><?=$rsGet->fields['description']?></td>
					</tr>
				 
					<tr>
						<th><?=_("Movie Director / Trainer")?> : </th>
						<?php
							$sql="select * from trainers where id = ".$rsGet->fields['trainer'];
							$rsGetTrainers=$DB->execute($sql);
							while(!$rsGetTrainers->EOF){
								?>
									<td><?=$rsGetTrainers->fields['name']?></td>
								<?
								$rsGetTrainers->movenext();
							}
						?>
					</tr>
					
					<tr>
						<th><?=_("Release Date")?> : </th>
						<td><?=$rsGet->fields['date_release']?></td>
					</tr>
					
					<tr>
						<th><?=_("Keywords (Comma Separated)")?> : </th>
						<td><?=$rsGet->fields['keywords']?></td>
					</tr>
					
					<tr>
						<th><?=_("Price")?> : </th>
						<td><?=$rsGet->fields['price']?></td>
					</tr>
					
					<tr>
						<th><?=_("Currency")?> : </th>
						<?php
							$sql="select * from currencies where id = ".$rsGet->fields['currency'];
							$rsGetCurrencies=$DB->execute($sql);
							while(!$rsGetCurrencies->EOF){
								?>
									<td><?=$rsGetCurrencies->fields['code']."-".$rsGetCurrencies->fields['name']?></td>
								<?
								$rsGetCurrencies->movenext();
							}
						?>
					</tr>
					
					<tr>
						<th><?=_("Rating")?> : </th>
						<?php
							$sql="select * from ratings where id = ".$rsGet->fields['rating'];
							$rsGetRating=$DB->execute($sql);
							while(!$rsGetRating->EOF){
								?>
									<td><?=$rsGetRating->fields['code']."-".$rsGetRating->fields['name']?></td>
								<?
								$rsGetRating->movenext();
							}
						?>
					</tr>
					
					<tr>
					 <th><?=_("Available Resources")?></th>
					 <td>
					 <?php
						$sql = "select * from vodchannels_resources where channel_id = $id";
						$rsGet = $DB->Execute($sql);
						while(!$rsGet->EOF){
							?>
							<a href="resources/<?=$rsGet->fields['resource_path']?>"><?=$rsGet->fields['resource_path']?></a>
							<?
							$rsGet->movenext();
						}
						if($rsGet->numrows() == 0) echo _("No resources available");
					 ?>
					 </td>
					</tr>
				</table>
			
	 </div><!-- // #main -->
	<div class="clear"></div>
 </div><!-- // #container -->
 </div><!-- // #containerHolder -->
 <p id="footer"></p>
 </div><!-- // #wrapper -->
</body>
</html>