<?php
include("includes/connection.php");
include("session.php");

$id = $_GET['cat_id'];

$sql = "SELECT * FROM vodcategories WHERE id = $id";
$rsGet = $DB->Execute($sql);

while(!$rsGet->EOF){
	
	$name=$rsGet->fields['name'];
	$parent=$rsGet->fields['parent'];
	
	if ($parent == 0)	$parentName = "No Parent";			 
	else{
		$sqlParent= "SELECT id,name FROM vodcategories where id = $parent";
		$rsGetParent = $DB->Execute($sqlParent);
	
		while(!$rsGetParent->EOF){
			$parentName = $rsGetParent->fields['name'];		
			$rsGetParent->movenext();	
		}
	}
	$rsGet->movenext();
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
				<h2><a href="#"><?=_("VOD Categories")?></a> &raquo; <a href="#" class="active"><?=_("View category detail")?></a></h2>
				<form action="createVodCategory.php" method="post" class="jNice">
					<fieldset>
					<p>
						<label><?=_("Name")?> : </label>
						<input type="text" name="name" value="<?=$name?>" class="text-long" readonly="readonly" />
					</p>
					<p>
						<label><?=_("Parent category")?> : </label>
						<select name="parent" readonly="readonly">
							<option value=0 selected='selected'><?=$parentName?></option>
						</select>
					</p>
					<p>
						<label>&nbsp;</label>
						<input type="hidden" name="cat_id" value="<?=$id?>" />
						<input type="submit" value="<?=_("Edit")?>" />
					</p>
					</fieldset>
				</form>
			</div><!-- // #main -->
			<div class="clear"></div>
    </div><!-- // #container -->
		</div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>