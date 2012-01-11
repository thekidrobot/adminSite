<?php
include("includes/connection.php");
include("session.php");

$strFind = $_POST['strFind'];
$condition = $_POST['condition'];
$strWhere="";

if($_POST['strFind']!= "")
{
	switch ($condition)
	{
		case "name":
			$strWhere .= " where name LIKE '%" . $strFind . "%' ";
			break;
	}
	$sqlGet = "SELECT * FROM subscribers "  . $strWhere;
}


//delete selected multiple
$arrSubscribers = $_POST['subscribers'];
$N = count($arrSubscribers);
if($N > 0)
{
	for($i=0; $i < $N; $i++)
	{
		$sql = "delete from subscribers where id = ".$arrSubscribers[$i];
		$rsSet = $DB->Execute($sql);
		$sql = "delete from subscribers_packages where subscriber_id = ".$arrSubscribers[$i];
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
					<h2><a href="#"><?=_("Subscribers")?></a> &raquo; <a href="#" class="active"><?=_("Find Subscribers")?></a></h2>
						<form method="post" action="<?=$currentPage?>" class="jNice">
						<fieldset>
						<p>
							<label><?=_("Select a search criteria")?></label>
							<input type="text" name="strFind" value="<?=$strFind ?>" class="text-long">
						</p>
						<p>
							<label><?=_("Select a search filter")?></label>
							<select name="condition">
								<option value="name" <?php if ($condition == "name") echo "selected='selected'" ?>><?=_("Subscriber Name")?></option>
							</select>
						</p>
						<p>
							<label>&nbsp;</label>
							<input name="find" type="submit" value="<?=_("Find")?>" />
						</p>
						</fieldset>
						</form>
		
						<?php
						if($_POST['strFind']!= "")
						{
							$counter = 0;
							?>
							<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
								<table class="no-arrow rowstyle-alt colstyle-alt paginate-5 max-pages-5">
								<thead>
									<tr>
										<th class="sortable"><b><?=_("Name")?></b></th>
										<th class="sortable"><b><?=_("STB Serial Number")?></b></th>
										<th class="sortable"><b><?=_("STB Mac Address")?></b></th>
										<th><b><?=_("Add Packages")?></b></th>
										<th style="text-align:center">
											<input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$counter = 0;
										
										$rsGet = $DB->Execute($sqlGet);
										
										while (!$rsGet->EOF)
										{  
											$counter++;
											?>
											<tr <?php if($counter % 2) echo " class='odd'"?>>
												<td><a href="viewSubscriberDetail.php?usr_id=<?=$rsGet->fields['id']?>"><?=$rsGet->fields['name']?></a></td>
												<td><?=$rsGet->fields['serial']?></td>
												<td><?=$rsGet->fields['mac']?></td>
												<td class="action"><a href="addSubscriberPackage.php?usr_id=<?=$rsGet->fields['id']?>"><?=_("Add Packages")?></td>
												<td align="center"><input name='subscribers[]' type='checkbox' value="<?=$rsGet->fields['id']?>"></td>
											</tr>
											<?php
											$rsGet->movenext();
										}
										if ($counter == 0)
										{
											?>
											<tr>
												<td colspan="5" align="center"><?=_("No records found")?></td>
											</tr>
											<?
										}
										?>
								</tbody>
								</table>
							</form>
							<script type="text/javascript" src="js/tablesort.js"></script>
							<script type="text/javascript" src="js/pagination.js"></script>
							<?
						}
					?>
					</div><!-- // #main -->
	      <div class="clear"></div>	
	    </div><!-- // #container -->
    </div><!-- // #containerHolder -->
  <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>