<?
include("includes/connection.php");
include("session.php");

$id = escape_value($_GET['id']);
$sql = "SELECT * FROM livechannels WHERE id = $id";
$getData = $DB->Execute($sql);

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
			<div id="main">
			<h2><a href="#"><?=_("Live TV")?></a> &raquo; <a href="#" class="active"><?=_("View Channel Information")?></a></h2>
			<form class="jNice">
				<fieldset>
				<p>
					<label><?=_("Actual Logo")?> : </label>
					<?php
					
						$actual_filename = $getData->fields['pic'];
						$actual_filename_thumb = getThumbnail($actual_filename);
												
						if(trim($actual_filename_thumb == "_small.")){
							$actual_filename_thumb = "default.jpg";
						}
					
					?>
					<img src="<?="data/images/".$actual_filename_thumb?>">
				</p>
				<p>
					<label><?=_("Channel Name")?> : </label>
					<input value="<?=$getData->fields['name']?>" name="name" type="text" maxlength="200" class="text-long" readonly="readonly" />
				</p>
				<p>
					<label><?=_("Channel Number")?> : </label>
					<input value="<?=$getData->fields['number']?>"  name="number" type="text" maxlength="150" class="text-long" readonly="readonly" />
				</p>
				<p>
					<label><?=_("Channel Description")?> : </label>
					<label><textarea name="description" cols="100" readonly="readonly" /><?=$getData->fields['description']?></textarea></label>
				</p>
				<p>
					<label><?=_("Channel URL")?> : </label>
					<input value="<?=$getData->fields['url']?>"  name="url" type="text" maxlength="350"  class="text-long" readonly="readonly" />
				</p>
				<p>
					<label><?=_("Price")?> : </label>
					<input value="<?=$getData->fields['price']?>"  name="price" type="text" maxlength="150"  value="0" class="text-long" readonly="readonly" />
				</p>
				<p>
					<label><?=_("Rating")?> : </label>
					<input value="<?=$getData->fields['rating']?>"  name="rating" type="text" maxlength="150"  class="text-long" readonly="readonly" />
				</p>
				<p>
					<label>&nbsp;</label>
					<a href="editLive.php?edit=<?=$id?>"><input type="button" class="button-submit" value="<?=_("Click to edit")?>" /></a>
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