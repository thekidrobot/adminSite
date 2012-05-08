<?
include("includes/connection.php");
include("session.php");

$id = $_GET['id'];

if(trim($id) == "" or !is_numeric($id) or $id == 0)
{
	redirect("viewTrainers.php");
}

$sql = "SELECT * FROM trainers WHERE id = $id";
$rsGet = $DB->execute($sql);

$message = "The user ".$_SESSION['username']." has viewed the information for the trainer '".$rsGet->fields['name']."' With ID $id";
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
		<!-- // #sidebar -->
		<div id="main">
			<h2><a href="#"><?=_("Trainers")?></a> &raquo; <a href="#" class="active"><?=_("View Trainer details")?></a></h2>
			<form method="post" action="<?php echo $currentPage; ?>" class="jNice">
				<fieldset>
					<p>
						<label><?=_("Actual Logo")?> : </label>
						<?php
						
							$actual_filename = $rsGet->fields['small_pic'];
							$actual_filename_thumb = getThumbnail($actual_filename);
						?>
						<img src="<?="data/images/".$actual_filename_thumb?>">
					</p>
					<p>
						<label><?=_("Trainer Name")?> : </label>
						<input name="name" type="text" value="<?=$rsGet->fields['name']?>" class="text-long" readonly="readonly" />
					</p>
					<p>
						<label><?=_("Trainer Description")?> : </label>
						<label><textarea name="description" cols="100" readonly="readonly" /><?=$rsGet->fields['description']?></textarea></label>
					</p>
					<p>
						<label>&nbsp;</label>
						<a href="editTrainerDetail.php?edit=<?=$id?>"><input type="button" class="button-submit" value="<?=_("Click to edit")?>" /></a>
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