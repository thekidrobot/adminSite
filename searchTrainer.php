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
	$sqlGet = "SELECT * FROM trainers "  . $strWhere;
}

//Delete multiple
$arrArchivos = $_POST['trainers'];
$U = count($arrArchivos);

if($U > 0)
{
 foreach($arrArchivos as $id)
 {
  $query_rsDel = "SELECT * FROM trainers WHERE id = $id";
	$rsDel = $DB->Execute($query_rsDel);
  
  //Borrar archivos existentes
  $gallery_upload_path = "data/images/";

  @unlink($gallery_upload_path.$rsDel->fields['big_pic']);
  @unlink($gallery_upload_path.$rsDel->fields['small_pic']);
  
	//I'm not deleting trainees assigned into packages. 
  $query_rsDel = "DELETE FROM trainers WHERE id = $id and id not in(select trainer from vodchannels)";
	$rsDel = $DB->Execute($query_rsDel);
	
  redirect($currentPage);
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
					<h2><a href="#"><?=_("Trainers")?></a> &raquo; <a href="#" class="active"><?=_("Find Trainers")?></a></h2>
						<form method="post" action="<?=$currentPage?>" class="jNice">
						<fieldset>
						<p>
							<label><?=_("Select a search criteria")?></label>
							<input type="text" name="strFind" value="<?=$strFind ?>" class="text-long">
						</p>
						<p>
							<label><?=_("Select a search filter")?></label>
							<select name="condition">
								<option value="name" <?php if ($condition == "name") echo "selected='selected'" ?>><?=_("Trainer Name")?></option>
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
										<th class="sortable"><b><?=_("Description")?></b></th>
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
											$cntTrainers = 0;
											$readonly = "";
											$sql= "select name from vodchannels where trainer = ".$rsGet->fields['id'];
											$rsGetTrainers = $DB->execute($sql);
											$cntTrainers = $rsGetTrainers->RecordCount();
											if($cntTrainers > 0){
												$readonly = "disabled='disabled'";
											}
											
											$counter++;
											?>
											<tr <?php if($counter % 2) echo " class='odd'"?>>
												<td><a href="viewTrainerDetail.php?id=<?=$rsGet->fields['id']?>"><?=$rsGet->fields['name']?></a></td>
												<td><?=$rsGet->fields['description']?></td>
												<td align="center"><input name='trainers[]' type='checkbox' value="<?=$rsGet->fields['id']?>" <?=$readonly?>></td>
											</tr>
											<?php
											$rsGet->movenext();
										}
										if ($counter == 0)
										{
											?>
											<tr>
												<td colspan="3" align="center"><?=_("No records found")?></td>
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