<?php
	include("includes/connection.php");
	include("session.php");
	
	$id = $_GET['id'];
	
	if(trim($id) == "" or !is_numeric($id) or $id == 0)
	{
		redirect("viewEpg.php");
	}
	
?>

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
			<h2><a href="#"><?=_("EPG")?></a> &raquo; <a href="#" class="active"><?=_("View EPG Grid")?></a></h2>

			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<table class="no-arrow rowstyle-alt colstyle-alt paginate-20 max-pages-3">
			<thead>
				<tr>
					<th class="sortable"><b><?=_("Channel")?></b></th>
					<th class="sortable"><b><?=_("Name")?></b></th>
					<th class="sortable"><b><?=_("Description")?></b></th>
					<th class="sortable"><b><?=_("Start Date")?></b></th>
					<th class="sortable"><b><?=_("Start Time")?></b></th>
					<th class="sortable"><b><?=_("End Date")?></b></th>
					<th class="sortable"><b><?=_("End Time")?></b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$counter = 0;
					
					$sql = "SELECT * FROM grid_live where channel_id = $id";
					$rsGet = $DB->Execute($sql);
					
					while (!$rsGet->EOF)
					{
						$sql = "select name from livechannels where id = ".$rsGet->fields['channel_id'];
						$rsGetChannel = $DB->execute($sql);
						
						$counter++;
						?>
						<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td><?=$rsGetChannel->fields['name']?></td>
							<td><?=$rsGet->fields['name']?></td>
							<td><?=$rsGet->fields['description']?></td>
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