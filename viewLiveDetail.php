<?
include("includes/connection.php");
include("session.php");

$id = escape_value($_GET['id']);
if(trim($id) == "" or !is_numeric($id) or $id == 0)
{
	redirect("viewLive.php");
}
$sql = "SELECT * FROM livechannels WHERE id = $id";
$getData = $DB->Execute($sql);

$message = "The user ".$_SESSION['username']." has viewed the information for the channel '".$getData->fields['name']."' With ID $id";
writeToLog($message);

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
			<div id="main">
			<h2><a href="#"><?=_("Live TV")?></a> &raquo; <a href="#" class="active"><?=_("View Channel Information")?></a></h2>
			<form class="jNice">
				<fieldset>
				<p>
					<label><?=_("Actual Logo")?> : </label>
					<?php
						$actual_filename = $getData->fields['small_pic'];
						$thumb = getThumbnail($actual_filename);
					?>
					<img src="<?="data/images/".$thumb?>">
				</p>
				<p>
					<label><?=_("Channel Name")?> : </label>
					<input value="<?=$getData->fields['name']?>" name="name" type="text" maxlength="200" class="text-long" readonly="readonly" />
				</p>
				<p>
					<label><?=_("Channel Number")?> : </label>
					<input value="<?=$getData->fields['number']?>"  name="number" type="text" maxlength="10" class="text-small" readonly="readonly" />
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
					<label><?=_("Channel PC URL")?> : </label>
					<input value="<?=$getData->fields['pc_url']?>" name="pc_url" type="text" maxlength="350"  class="text-long" />
				</p>					
				<p>
					<label><?=_("Price")?> : </label>
					<input value="<?=$getData->fields['price']?>"  name="price" type="text" maxlength="150"  value="0" class="text-small" readonly="readonly" />
				</p>
				<p>
				 <label><?=_("Currency")?> : </label>
					<select name="currency">
					 <?php
						$sql="select * from currencies where id = ".$getData->fields['currency'];
				 		$rsGet=$DB->execute($sql);
						while(!$rsGet->EOF){
						?>
						 <option value="<?=$rsGet->fields['id']?>" selected="selected" readonly="readonly"><?=$rsGet->fields['code']."-".$rsGet->fields['name']?></option>
						 <?
						 $rsGet->movenext();
						}
						?>
					 <select>
					</p>
					<p>
					 <label><?=_("Rating")?> : </label>
					 <select name="rating">
					  <?php
					  $sql="select * from ratings where id = ".$getData->fields['rating'];
					  $rsGet=$DB->execute($sql);
					  while(!$rsGet->EOF){
					   ?>
						 <option value="<?=$rsGet->fields['id']?>" selected="selected" readonly="readonly"><?=$rsGet->fields['code']."-".$rsGet->fields['name']?></option>
					   <?
					   $rsGet->movenext();
						}
					 ?>
					<select>
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