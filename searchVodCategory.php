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
	$sqlGet = "SELECT * FROM vodcategories "  . $strWhere;
}

//Delete multiple
$arrArchivos = $_POST['archivos'];

$U = count($arrArchivos);
if($U > 0)
{
 foreach($arrArchivos as $id)
 {
		//Borra de tabla hija
		$str = "delete from vod_channels_categories where category_id = $id";
		$strSet = $DB->execute($str);
		//Borra de tabla padre
		$str = "delete from vodcategories where id = $id";
		$strSet = $DB->execute($str);
	
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
					<h2><a href="#"><?=_("VOD Categories")?></a> &raquo; <a href="#" class="active"><?=_("Find VOD Categories")?></a></h2>
						<form method="post" action="<?=$currentPage?>" class="jNice">
						<fieldset>
						<p>
							<label><?=_("Select a search criteria")?></label>
							<input type="text" name="strFind" value="<?=$strFind ?>" class="text-long">
						</p>
						<p>
							<label><?=_("Select a search filter")?></label>
							<select name="condition">
								<option value="name" <?php if ($condition == "name") echo "selected='selected'" ?>><?=_("Category Name")?></option>
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
						<table class="no-arrow rowstyle-alt colstyle-alt paginate-10 max-pages-5">
							<thead>
							<tr>
								<th class="sortable"><b><?=_("View Details")?></b></th>
								<th><b><?=_("Add Content")?></b></th>
								<th style="text-align:center">
									<input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
								</th>
							</tr>
						</thead>
						<tbody>	
							<?php
							$counter = 0;
							$rsGet = $DB->execute($sqlGet);
							
							while (!$rsGet->EOF)
							{  
								$counter++;
								$id = $rsGet->fields['id'];
								$name = $rsGet->fields['name'];
								?>
								<tr <?php if($counter % 2) echo " class='alt'"?>>
									<td><a href="viewVodDetail.php?cat_id=<?=$id?>" ><?=ucfirst(strtolower($name))?></a></td>
									<td><a href="addVodContent.php?cat_id=<?=$id?>" >Add Content</a></td>
									<td align="center"><input name='archivos[]' type='checkbox' value="<?=$id?>"></td>
								</tr>
								<?php;
								$rsGet->movenext();
							}  
							?>
							</tbody>
						</table>
					</form>
					<?php
					}
					?>
				</div><!-- // #main -->
      <div class="clear"></div>
			<script type="text/javascript" src="js/tablesort.js"></script>
			<script type="text/javascript" src="js/pagination.js"></script>	
    </div><!-- // #container -->
    </div><!-- // #containerHolder -->
  <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>