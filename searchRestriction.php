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
	$sqlGet = "SELECT * FROM restrictions "  . $strWhere;
}

//Delete multiple
$arrArchivos = $_POST['rules'];
$U = count($arrArchivos);

if($U > 0)
{
 foreach($arrArchivos as $id)
 {
  $query_rsDel = "SELECT * FROM restrictions WHERE id = $id";
	$rsDel = $DB->Execute($query_rsDel);
  
  //Borrar archivos existentes
  $gallery_upload_path = "data/images/";

  @unlink($gallery_upload_path.$rsDel->fields['big_pic']);
  @unlink($gallery_upload_path.$rsDel->fields['small_pic']);
  
  $query_rsDel = "DELETE FROM restrictions WHERE id = $id and id
									not in(select distinct restriction_id from tickets)";
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
					<h2><a href="#"><?=_("Restrictions")?></a> &raquo; <a href="#" class="active"><?=_("Find Restrictions")?></a></h2>
						<form method="post" action="<?=$currentPage?>" class="jNice">
						<fieldset>
						<p>
							<label><?=_("Select a search criteria")?></label>
							<input type="text" name="strFind" value="<?=$strFind ?>" class="text-long">
						</p>
						<p>
							<label><?=_("Select a search filter")?></label>
							<select name="condition">
								<option value="name" <?php if ($condition == "name") echo "selected='selected'" ?>><?=_("Restriction Name")?></option>
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
										<th class="sortable"><b><?=_("Duration (in days)")?></b></th>
										<th class="sortable"><b><?=_("Max Views")?></b></th>
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
											
											$cntRestrictions = 0;
											$readonly = "";
											$sql= "select restriction_id from tickets where restriction_id = ".$rsGet->fields['id'];
											$rsGetRestrictions = $DB->execute($sql);
											$cntRestrictions = $rsGetRestrictions->RecordCount();
											if($cntRestrictions > 0){
												$readonly = "disabled='disabled'";
											}
											
											?>
											<tr <?php if($counter % 2) echo " class='odd'"?>>
												<td><a href="viewRestrictionDetail.php?id=<?=$rsGet->fields['id']?>"><?=$rsGet->fields['name']?></a></td>
												<td><?=$rsGet->fields['duration']?></td>
												<td><?=$rsGet->fields['max_views']?></td>
												<td align="center"><input name='rules[]' type='checkbox' value="<?=$rsGet->fields['id']?>" <?=$readonly?>></td>
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