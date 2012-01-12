<?
	include("includes/connection.php");
	include("session.php");
	
	$pck_id = $_GET['pck_id'];
	
	if(trim($pck_id) == "" or !is_numeric($pck_id) or $pck_id == 0)
	{
		redirect("viewPackages.php");
	}	
	
	$sql = "SELECT * FROM packages where id = $pck_id";
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
			<h2><a href="#"><?=_("Packages")?></a> &raquo; <a href="#" class="active"><?=_("View package detail")?></a></h2>
			<form action="createPackage.php" method="post" class="jNice">
				<fieldset>
					<p>
					<label><?=_("Package Name")?></label>
					<input type="text" name="name" value="<?=$rsGet->fields['name']?>" class="text-long" maxlenght="150" readonly="readonly" />
					</p>
					
					<p>
					<label><?=_("Package Description")?></label>
					<textarea name="description" maxlenght="150" readonly="readonly"><?=$rsGet->fields['description']?></textarea>
					</p>
					
					<p>
					<label><?=_("Package Duration")?></label>
					<input type="text" name="duration" value="<?=$rsGet->fields['duration']?>" class="text-small" maxlenght="150" readonly="readonly" />
					</p>
					
					<p>
					<label><?=_("Package Price")?></label>
					<input type="text" name="price" value="<?=$rsGet->fields['price']?>" class="text-small" maxlenght="150" readonly="readonly" />
					</p>
					<p>
						<label><?=_("Currency")?> : </label>
						<select name="currency">
							<?php
								$sql="select * from currencies where id = ".$rsGet->fields['currency'];
								$rsGetCurrencies=$DB->execute($sql);
								while(!$rsGetCurrencies->EOF){
									?>
										<option value="<?=$rsGetCurrencies->fields['id']?>"><?=$rsGetCurrencies->fields['code']."-".$rsGetCurrencies->fields['name']?></option>
									<?
									$rsGetCurrencies->movenext();
								}
							?>
						<select>
					</p>
					<p>
						<label>&nbsp;</label>
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