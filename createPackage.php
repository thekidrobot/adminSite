<?
	include("includes/connection.php");
	include("session.php");

	if($_GET['pck_id'] != "")
	{
		$id = $_GET['pck_id'];
		$sql = "select * from packages where id = $id";
		$rsGet=$DB->execute($sql);
	}
	
	if($_POST['flgEdit'] != "")
	{
		$id = $_POST['flgEdit'];
		$sql = "select * from packages where id = $id";
		$rsGet=$DB->execute($sql);
	}
	
	if($_POST['flgUpd'] != "")
	{
		$id = $_POST['pck_id'];
		
		$postArray = &$_POST;
		
		$name=escape_value($postArray['name']);
		$description=escape_value($postArray['description']);
		$duration=escape_value($postArray['duration']);
		$price=escape_value($postArray['price']);
		
		$sql = "update packages set
						name = '$name',
						description = '$description',
						duration = '$duration',
						price = '$price'
						where id = $id";
						
		$rsSet=$DB->execute($sql);
		
		redirect('viewPackages.php');
	}	
	
	
	if($_POST['addLive']!="" or $_POST['addVod']!="")
	{
		$postArray = &$_POST;
		
		$name=escape_value($postArray['name']);
		$description=escape_value($postArray['description']);
		$duration=escape_value($postArray['duration']);
		$price=escape_value($postArray['price']);
		
		$sql = "INSERT INTO packages
						(name,description,duration,price)
						VALUES ('$name','$description','$duration','$price')";
	
		$rsSet = $DB->Execute($sql);
		
		$pck_id = $DB->Insert_ID();

		if($_POST['addLive']!=""){
			redirect("addPackageContentLive.php?pck_id=$pck_id");
		}
		elseif($_POST['addVod']!=""){
			redirect("addPackageContentVod.php?pck_id=$pck_id");
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
			<h2><a href="#">Packages</a> &raquo; <a href="#" class="active">Add a new Package</a></h2>
			<form action="<?=$currentPage?>" method="post" class="jNice">
				<fieldset>
					<p>
					<label><?=_("Package Name")?></label>
					<input type="text" name="name" value="<?=$rsGet->fields['name']?>" class="text-long" maxlenght="150" />
					</p>
					
					<p>
					<label><?=_("Package Description")?></label>
					<textarea name="description" maxlenght="500"><?=$rsGet->fields['description']?></textarea>
					</p>
					
					<p>
					<label><?=_("Package Duration")?></label>
					<input type="text" name="duration" value="<?=$rsGet->fields['duration']?>" class="text-long" maxlenght="150" />
					</p>
					
					<p>
					<label><?=_("Package Price")?></label>
					<input type="text" name="price" value="<?=$rsGet->fields['price']?>" class="text-long" maxlenght="150" />
					</p>

					<?php
					if($_POST['flgEdit'] != "" or $_GET['pck_id'] != "")
					{
						?>
						<p>
							<label>&nbsp;</label>
							<input type="hidden" value="<?=$id?>" name="pck_id" />
							<input type="submit" value="<?=_("Update")?>" name="flgUpd" />
						</p>
						<?
					}
					else
					{
						?>
						<p>
							<label><?=_("Add Live Content")?></label>
							<input type="hidden" value="1" name="addLive" />
							<input type="submit" value="<?=_("Save and Add")?>" name="live" />
						</p>
						
						<p>
							<label><?=_("Add VOD Content")?></label>
							<input type="hidden" value="1" name="addVod" />
							<input type="submit" value="<?=_("Save and Add")?>" name="vod" />
						</p>
						<?
					}
					?>					
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