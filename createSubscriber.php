<?
	 include("includes/connection.php");
	 include("session.php");

	if($_POST['addPck']!="")
	{
		$postArray = &$_POST;
		
		$name=escape_value($postArray['name']);
		$username=escape_value($postArray['username']);
		$password=escape_value($postArray['password1']);
		$description=escape_value($postArray['description']);
		$serial=escape_value($postArray['serial']);
		$mac=escape_value($postArray['mac']);
		$license=escape_value($postArray['license']);
		
		$sql = "INSERT INTO
						subscribers
							(name,username,password,description,serial,mac,license)
						VALUES
							('$name','$username','$password',
							 '$description','$serial','$mac','$license')";
	
		$rsSet = $DB->Execute($sql);
		$usr_id = $DB->Insert_ID();

		redirect("addSubscriberPackage.php?usr_id=$usr_id");	
	}
	
	if($_POST['flgEdit'] != "")
	{
		$id = $_POST['flgEdit'];
		$sql = "select * from subscribers where id = $id";
		$rsGet=$DB->execute($sql);
	}
	
	if($_POST['updUsr'] != "")
	{
		$id = $_POST['updUsr'];
		
		$postArray = &$_POST;
		
		$name=escape_value($postArray['name']);
		$username=escape_value($postArray['description']);
		$password=escape_value($postArray['password1']);
		$description=escape_value($postArray['description']);
		$serial=escape_value($postArray['serial']);
		$mac=escape_value($postArray['mac']);
		$license=escape_value($postArray['license']);
		
		$sql = "update subscribers set
						name = '$name',
						username = '$username',
						password = '$password',
						description = '$description',
						serial = '$serial',
						mac = '$mac',
						license = '$license'
						where id = $id";
						
		$rsSet=$DB->execute($sql);
		
		redirect("viewSubscriberDetail.php?usr_id=$id");
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
			<h2><a href="#"><?=_("Subscribers")?></a> &raquo; <a href="#" class="active"><?=_("Create new subscriber")?></a></h2>		
			<form action="<?=$currentPage?>" method="post" class="jNice" >
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
					<label><?=_("Subscriber Password")?></label>
					<input type="password" name="password1" value="<?=$rsGet->fields['password']?>" maxlength="15" class="text-long" />
				</p>
				<p>
					<label><?=_("Repeat Password")?></label>
					<input type="password" name="password2" value="<?=$rsGet->fields['password']?>" maxlength="15" class="text-long" />
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
				<?
				if($_POST['flgEdit'] != "")
				{
					?>
					<p>
						<label>&nbsp;</label>
						<input type="hidden" name="updUsr" value="<?=$id?>" />
						<input type="submit" name="updateUser" value="<?=_("Update")?>" />
					</p>					
					<?
				}
				else
				{
					?>
					<p>
						<label><?=_("Save and Add Packages")?></label>
						<input type="hidden" name="addPck" value="1" />
						<input type="submit" name="addPackages" value="<?=_("Save")?>" />
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