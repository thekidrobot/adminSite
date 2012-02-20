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
		<h1><?=_("Search Content")?></h1>
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
			<h2><?=_("Search Results")?></h2>
			<!--<h3><?=_("Search Results")?></h3>-->
			
			<?php
				$search_text = escape_value($_POST['search_text']);
				$search_term = escape_value($_POST['search_term']);
			
				switch ($search_term) {
					case 'live':
							?><h3><?=_("Live Videos")?></h3><?
							break;
					case 'vod':
							?><h3><?=_("Video OnDemand")?></h3><?
							break;
					case 'epg':
							?><h3><?=_("EPG Grid")?></h3><?
							break;
				}
			?>
			
			Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et Lorem ipsum dolor sit amet consectetur 
			adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  dolore magna aliqua. Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et Lorem ipsum dolor sit amet consectetur 
			adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  dolore magna aliqua. 
			<br />
			<br />
			Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et Lorem ipsum dolor sit amet consectetur 
			adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  dolore magna aliqua. Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et Lorem ipsum dolor sit amet consectetur 
			adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  dolore magna aliqua. 
			<br />
			<br />
			Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et Lorem ipsum dolor sit amet consectetur 
			adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  dolore magna aliqua. Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et Lorem ipsum dolor sit amet consectetur 
			adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  dolore magna aliqua. 
			
			
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