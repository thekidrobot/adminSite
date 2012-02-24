<?php
	include('includes/head.php');
	$id = escape_value($_GET['id']);
	if(trim($id) == "" or !is_numeric($id) or $id == 0)
	{
		redirect("home.php");
	}
	$sql = "SELECT lc.*
					FROM
					 livechannels lc,
					 packages_livechannels pl,
					 subscribers_packages sp
					WHERE
					 lc.id = pl.resource_id AND
					 pl.package_id = sp.package_id AND
					 sp.subscriber_id = ".$_SESSION['id']." AND 
					 lc.id = $id 
					 ORDER BY lc.id DESC";
											
	$getData = $DB->Execute($sql);
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
		<h1><?=_("Live Video")?></h1>
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
				<th valign="top"><?=_("Channel Name")?> : </th>
				<td><?=$getData->fields['name']?></td>
			</tr>

			<tr>
				<th valign="top"><?=_("Channel Number")?> : </th>
				<td><?=$getData->fields['number']?></td>
			</tr>

			<tr>
				<th valign="top"><?=_("Channel Description")?> : </th>
				<td><?=$getData->fields['description']?></td>
			</tr>			
			
			<tr>
				<th valign="top"><?=_("Price")?></th>
				<td><?=$getData->fields['price']?></td>
			</tr>


			<tr>
				<th valign="top"><?=_("Currency")?> :</th>
				<td>
				<?php
					$sql="select * from currencies where id = ".$getData->fields['currency'];
					$rsGet=$DB->execute($sql);
					while(!$rsGet->EOF)
					{
						echo $rsGet->fields['code'] ."-". $rsGet->fields['name'];	
						$rsGet->movenext();
					}
					?>
				</td>
			</tr>

			<tr>
				<th valign="top"><?=_("Rating")?> : </th>
					<td>
					<?php
					  $sql="select * from ratings where id = ".$getData->fields['rating'];
					  $rsGet=$DB->execute($sql);
					  while(!$rsGet->EOF){
					   echo $rsGet->fields['code'] ."-". $rsGet->fields['name'];
					   $rsGet->movenext();
						}
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