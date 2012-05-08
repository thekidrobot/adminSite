<?php
	include("includes/connection.php");
	include("session.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include ("includes/head.php") ?>
<body>
 <div id="wrapper">
  <h1><a href="#">&nbsp;</a></h1>
	<?php include("includes/mainnav.php") ?>
	<!-- // #end mainNav -->
	<div id="containerHolder">
	 <div id="container">
		<div id="sidebar">
		 <?php include("includes/sidenav.php") ?>
		</div>    
		<!-- // #sidebar -->
		
		<div id="main">
			<h2><a href="#"><?=_("EPG")?></a> &raquo; <a href="#" class="active"><?=_("View EPG Grid")?></a></h2>

			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<table class="no-arrow rowstyle-alt colstyle-alt paginate-20 max-pages-3">
			<thead>
				<tr>
					<th class="sortable"><b><?=_("Number")?></b></th>
					<th class="sortable"><b><?=_("Name / Edit Details")?></b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$counter = 0;
					
					$sql = "SELECT * FROM livechannels order by number asc";
					$rsGet = $DB->Execute($sql);
					
					while (!$rsGet->EOF)
					{
						$counter++;
						?>
						<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td><?=$rsGet->fields['number']?></td>
							<td><a href="viewEpgDetails.php?id=<?=$rsGet->fields['id']?>"><?=$rsGet->fields['name']?></a></td>
						</tr>
						<?php
						$rsGet->movenext();
					}  
					?>
			</tbody>
			</table>
			</form>

			<script type="text/javascript" src="js/tablesort.js"></script>
			<script type="text/javascript" src="js/pagination.js"></script>
			
		</div><!-- // #main -->
    <div class="clear"></div>
    </div><!-- // #container -->
		</div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>