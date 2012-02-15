<?php
	include('includes/head.php');
	$id = escape_value($_GET['id']);
	if(trim($id) == "" or !is_numeric($id) or $id == 0)
	{
		redirect("home.php");
	}

//Todo: Secure this!
$sql = "SELECT * FROM vodchannels WHERE id = $id";

$rsGet = $DB->execute($sql);

?>

<body> 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    
	<!-- Start: page-top -->
	<?php include('includes/page_top.php'); ?>
	<!-- End: page-top -->
</div>
<!-- End: page-top-outer -->
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
	<!--  start nav-outer -->
	<div class="nav-outer"> 
		<!-- start nav-right -->
		<?php include('includes/nav_right.php');?>
		<!-- end nav-right -->

		<!--  start nav -->
		<?php include('includes/nav.php'); ?>
		<!--  start nav -->
		
	</div>
	<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->
<div class="clear"></div>
 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1><?=_("Video OnDemand")?></h1>
	</div>
	<!-- end page-heading -->

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<h2><?=_("View Details")?></h2>
			<h3><?=_("Available Details")?></h3>
			
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
						<th><?=_("Movie STB URL")?> : </th>
						<td><?=$rsGet->fields['stb_url']?></td>
					</tr>
					
					<tr>
						<th><?=_("Movie Download URL")?> : </th>
						<td><?=$rsGet->fields['download_url']?></td>
					</tr>
										
					<tr>
						<th><?=_("Movie PC URL")?> : </th>
						<td><?=$rsGet->fields['pc_url']?></td>
					</tr>
					
					<tr>
						<th><?=_("Movie Local URL")?> : </th>
						<td><?=$rsGet->fields['local_url']?></td>
					</p>	
				 
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
			
			</div>
			<!--  end table-content  -->
	
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<?php include('includes/footer.php'); ?>
<!-- end footer -->
 
</body>
</html>