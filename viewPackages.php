<?
	include("includes/connection.php");
	include("session.php");
	
	//Delete one
	if($_GET['del']!="")
	{
		$id = escape_value($_GET['del']);
		$sql = "delete from packages where id = ".$id;
		$rsSet = $DB->Execute($sql);
		$sql = "delete from packages_livechannels where package_id = ".$id;
		$rsSet = $DB->Execute($sql);
		$sql = "delete from packages_vodchannels where package_id = ".$id;
		$rsSet = $DB->Execute($sql);
	}
	
	//delete selected multiple
	$arrPackages = $_POST['packages'];
	$N = count($arrPackages);
	if($N > 0)
	{
		for($i=0; $i < $N; $i++)
		{
			$sql = "delete from packages where id = ".$arrPackages[$i];
			$rsSet = $DB->Execute($sql);
			$sql = "delete from packages_livechannels where package_id = ".$arrPackages[$i];
			$rsSet = $DB->Execute($sql);
			$sql = "delete from packages_vodchannels where package_id = ".$arrPackages[$i];
			$rsSet = $DB->Execute($sql);
		} 
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
			<h2><a href="#"><?=_("Packages")?></a> &raquo; <a href="#" class="active"><?=_("View all packages")?></a></h2>

			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<table class="no-arrow rowstyle-alt colstyle-alt paginate-10 max-pages-5">
			<thead>
				<tr>
					<th class="sortable"><b><?=_("Name")?></b></th>
					<th class="sortable"><b><?=_("Duration")?></b></th>
					<th class="sortable"><b><?=_("Price")?></b></th>
					<th><b><?=_("Add content Live")?></b></th>
					<th><b><?=_("Add content OnDemand")?></b></th>
					<th style="text-align:center">
						<input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$counter = 0;
					
					$sql = "SELECT * FROM packages order by id desc";
					$rsGet = $DB->Execute($sql);
									
					while (!$rsGet->EOF)
					{  
						$counter++;
						?>
						<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td><a href="viewPackageDetail.php?pck_id=<?=$rsGet->fields['id']?>"><?=$rsGet->fields['name']?></a></td>
							<td><?=$rsGet->fields['duration']?></td>
							<td><?=$rsGet->fields['price']?></td>
							<td class="action"><a href="addPackageContentLive.php?pck_id=<?=$rsGet->fields['id']?>"><?=_("Live")?></td>
							<td class="action"><a href="addPackageContentVod.php?pck_id=<?=$rsGet->fields['id']?>"><?=_("OnDemand")?></td>
							<td align="center"><input name='packages[]' type='checkbox' value="<?=$rsGet->fields['id']?>"></td>
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