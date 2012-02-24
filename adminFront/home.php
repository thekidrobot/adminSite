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
			<h2><?=_("Available Channels")?></h2>
			<!--<h3><?=_("Available Channels")?></h3>-->
			
			<div class="album">
			 <table class="gallery paginate-1 max-pages-6">
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
											<a href="viewEpg.php?id=<?=$rs_getData->fields['id']?>&iframe=true&width=100%&height=100%" rel="prettyPhoto[epg]" title="View EPG for channel <?=$rs_getData->fields['name']; ?>"><img src="images/icons/calendar.png" alt="<?=_("View EPG")?>" class="icon" /></a>
											<a href="viewLiveDetail.php?id=<?=$rs_getData->fields['id']?>&iframe=true&width=100%&height=100%"" rel="prettyPhoto[details]" title="View Details for channel <?=$rs_getData->fields['name']; ?>"><img src="images/icons/more_details.png" alt="<?=_("More Details")?>" class="icon" /></a>
										</div>
									</div>
								</div>								
							</div>
						<td>
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