<?
	include("includes/connection.php");
	include("session.php");

	$usr_id = $_GET['usr_id'];
	
	$sql = "SELECT * FROM subscribers where id = $usr_id";
	$rsGet = $DB->Execute($sql);

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
			<h2><a href="#"><?=_("Subscribers")?></a> &raquo; <a href="#" class="active"><?=_("View subscriber detail")?></a></h2>		
			<form action="createSubscriber.php" method="post" class="jNice" >
				<fieldset>
				<p>
					<label><?=_("Subscriber Name")?></label>
					<input type="text" name="name" value="<?=$rsGet->fields['name']?>" maxlength="255" class="text-long" />
				</p>
				<p>
					<label><?=_("Subscriber Username")?></label>
					<input type="text" name="username" value="<?=$rsGet->fields['username']?>" maxlength="100" class="text-long" />
				</p>
				<p>
					<label><?=_("Subscriber Info")?></label>
					<textarea name="description" maxlenght="500"><?=$rsGet->fields['description']?></textarea>
				</p>
				<p>
					<label><?=_("STB Mac Address")?></label>
					<input type="text" name="mac" value="<?=$rsGet->fields['mac']?>" maxlength="100" class="text-long" />
				</p>
				<p>
					<label><?=_("STB Serial number")?></label>
					<input type="text" name="serial" value="<?=$rsGet->fields['serial']?>" maxlength="100" class="text-long" />
				</p> 	 
				<p>
					<label><?=_("Computer License")?></label>
					<input name="license" type="text" value="<?=$rsGet->fields['license']?>" class="text-long" />
				</p>
				<p>
					<label><?=_("Save and Add Packages")?></label>
						<input type="hidden" value="<?=$rsGet->fields['id']?>" name="flgEdit" />
						<input type="submit" value="<?=_("Edit")?>" name="edit" />
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