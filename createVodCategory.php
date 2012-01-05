<?php
include("includes/connection.php");
include("session.php");

if (trim($_POST['name']) != "")
{
	if($_POST['flgEdit'] == 1)
	{
		$str = "update  vodcategories
						set 		name 		= '".$_POST['name']."',
										parent 	= ".$_POST['parent'].",
						where 	id 			= ".$_POST['id'];							
	}
	elseif($_POST['flgAdd'] == 1)
	{
		$str = "insert into vodcategories (name,parent)
						values('".$_POST['name']."',".$_POST['parent'].")";	
	}
	$rsSet = $DB->Execute($str);
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
				<h2><a href="#"><?=_("VOD Categories")?></a> &raquo; <a href="#" class="active"><?=_("Add a new category")?></a></h2>
				<form action="<?=$currentPage?>" method="post" class="jNice">
					<fieldset>
					<p>
						<label><?=_("Name")?> : </label>
						<input type="text" name="name" value="<?=$name?>" class="text-long" maxlenght="150" />
					</p>
					<p>
						<label><?=_("Parent category")?> : </label>
						<select name="parent">
							<option value=0 <?php if($idGrupos == $row['id']) echo "selected='selected'" ?>>
								<?=_("No Parent")?>
							</option>
							<?php
							//First level menus
							$sql = "SELECT * FROM vodcategories WHERE parent = 0 order by id";
							$rsGet = $DB->Execute($sql);
							
							while (!$rsGet->EOF)
							{	
								?>
								<option value="<?=$rsGet->fields['id'] ?>" <?php if($padre ==  $rsGet->fields['id']) echo "selected='selected'" ?>>
									<?=ucfirst(strtolower($rsGet->fields['name'])) ?>
								</option>
								<?php
								$dad=$rsGet->fields['name'];
								//Second+ level menus - Sorry for the mess, Padre needs to be sent as a comparison value.
								make_kids($rsGet->fields['id'],$dad,$padre);
								$rsGet->MoveNext();
							}
							?>
						</select>
					</p>
					<p>
						<label>&nbsp;</label>
						<input type="hidden" name="id" value="<?=$id?>" />				
						<? if (trim($name) !="")
						{
							?>
							<input type="hidden" name="flgEdit" value=1 />				
							<input type="submit" value="<?=_("Edit")?>" />
							<?
						}
						else
						{
							?>
							<input type="hidden" name="flgAdd" value=1 />				
							<input type="submit" value="<?=_("Add")?>" />
							<?	
						}
						?>
						<a href="<?=$currentPage?>"><input type="button" value="<?=_("Reset")?>" class="button-submit" /></a>
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