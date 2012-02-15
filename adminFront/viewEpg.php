<?php
	include('includes/head.php');
	$id = escape_value($_GET['id']);
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
			<h2><?=_("View EPG")?></h2>
			<h3><?=_("Available Grid")?></h3>
			
			<table class="no-arrow rowstyle-alt colstyle-alt paginate-20 max-pages-3">
			<thead>
				<tr>
					<th class="sortable"><b><?=_("Channel name")?></b></th>
					<th class="sortable"><b><?=_("Grid name")?></b></th>
					<th class="sortable"><b><?=_("Description")?></b></th>
					<th class="sortable"><b><?=_("Rating")?></b></th>
					<th class="sortable"><b><?=_("Start Date")?></b></th>
					<th class="sortable"><b><?=_("Start Time")?></b></th>
					<th class="sortable"><b><?=_("End Date")?></b></th>
					<th class="sortable"><b><?=_("End Time")?></b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$counter = 0;
					
					$sql = "SELECT DISTINCT gl.*
									FROM
									 grid_live gl,
									 livechannels lc,
									 packages_livechannels pl,
									 subscribers_packages sp
									WHERE
									 gl.channel_id = lc.id AND
									 lc.id = pl.resource_id AND
									 pl.package_id = sp.package_id AND
									 sp.subscriber_id = ".$_SESSION['id']." AND 
									 gl.channel_id = $id";
									 
					$rsGet = $DB->Execute($sql);
					
					while (!$rsGet->EOF)
					{
						$sql = "select name from livechannels where id = ".$rsGet->fields['channel_id'];
						$rsGetChannel = $DB->execute($sql);

						$sql = "select code from ratings where id = ".$rsGet->fields['rating'];
						$rsGetRating = $DB->execute($sql);
						
						$counter++;
						?>
						<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td><b><?=$rsGetChannel->fields['name']?></b></td>
							<td><?=$rsGet->fields['grid_name']?></td>
							<td><?=$rsGet->fields['grid_description']?></td>
							<td><?=$rsGetRating->fields['code']?></td>
							<td><?=$rsGet->fields['start_date']?></td>
							<td><?=$rsGet->fields['start_time']?></td>
							<td><?=$rsGet->fields['end_date']?></td>
							<td><?=$rsGet->fields['end_time']?></td>
						</tr>
						<?php
						$rsGet->movenext();
					}  
					?>
			</tbody>
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