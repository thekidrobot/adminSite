<?php
	include('includes/head.php');
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
			<h2><?=_("Available Channels")?></h2>
			<h3><?=_("Available Channels")?></h3>
			
			<form action="">
				<select class="styledselect_form_1">
					<option value="" selected="selected">--Select a Category --</option>
					<option value="">C1</option>
					<option value="">C2</option>
					<option value="">C3</option>
					<option value="">C4</option>
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
								<a href="http://youtu.be/2qR_94Jmg4A" rel="prettyPhoto" title="">
								<div class="image">
									<img src="../data/images/<?=$thumb ?>" />
								</div>
								</a>
								<div class="footer">
									<b><?=_("Name")?> : </b><?=$rs_getData->fields['name']; ?><br />
									<b><?=_("Current Views")?> : </b><?=$rs_getData->fields['current_views']; ?><br />
									<b><?=_("Max Views")?> : </b><?=$rs_getData->fields['max_views']; ?><br />
									<b><?=_("Validity (days)")?> : </b><?=$rs_getData->fields['duration']; ?><br />
									<a href="viewLiveDetail.php?id=<?=$rs_getData->fields['id']?>&iframe=true&width=100%&height=100%"" rel="prettyPhoto[details]" title="View Details for channel <?=$rs_getData->fields['name']; ?>">More Details</a><br />
									<a href="<?=$rs_getData->fields['local_url']?>"><?=_("View Local")?></a><br />
									<a href="<?=$rs_getData->fields['stb_url']?>"><?=_("View Through Internet")?></a>
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
									</td>
								</div>
							</div>
						<td>
					<?
					if ($counter%6 == 0){
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