<?
	include("includes/connection.php");
	include("session.php");

	if($_GET['pck_id'] != "")
	{
		$id = $_GET['pck_id'];
		
		if(trim($id) == "" or !is_numeric($id) or $id == 0)
		{
			redirect("viewPackages.php");
		}			
		
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
		$currency=escape_value($postArray['currency']);
		
		$validator = new FormValidator();
	
		$validator->addValidation("name","req",_("Name is a mandatory field"));
		$validator->addValidation("description","maxlen=100",_("Description shouldn't be longer than 100 characters"));
		$validator->addValidation("price","num",_("Price should be a numerical value"));
		$validator->addValidation("price","req",_("Price is a mandatory field"));
		$validator->addValidation("Duration","num",_("Duration should be a numerical value"));
		
		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err)
			{
				$err .= $inp_err."</br>";
			}
		}
		else
		{	
			$sql = "update packages set
							name = '$name',
							description = '$description',
							duration = '$duration',
							price = '$price',
							currency = $currency
							where id = $id";
							
			$rsSet=$DB->execute($sql);
			
			redirect('viewPackages.php');
		}
	}	
	
	
	if($_POST['flgAdd']!="")
	{
		$postArray = &$_POST;
		
		$name=escape_value($postArray['name']);
		$description=escape_value($postArray['description']);
		$duration=escape_value($postArray['duration']);
		$price=escape_value($postArray['price']);
		$currency=escape_value($postArray['currency']);
		
		$validator = new FormValidator();
	
		$validator->addValidation("name","req",_("Name is a mandatory field"));
		$validator->addValidation("description","maxlen=100",_("Description shouldn't be longer than 100 characters"));
		$validator->addValidation("price","num",_("Price should be a numerical value"));
		$validator->addValidation("price","req",_("Price is a mandatory field"));
		$validator->addValidation("Duration","num",_("Duration should be a numerical value"));

		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err)
			{
				$err .= $inp_err."</br>";
			}
		}
		else
		{	
			$sql = "INSERT INTO packages
							(name,description,duration,price,currency)
							VALUES ('$name','$description','$duration','$price',$currency)";
		
			$rsSet = $DB->Execute($sql);
			$pck_id = $DB->Insert_ID();
	
			redirect("viewPackages.php");
		
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
			
			<?php
			if($_POST['flgEdit'] != "")
			{
				?>
				<h2><a href="#"><?=_("Packages")?></a> &raquo; <a href="#" class="active"><?=_("Edit package information")?></a></h2>		
				<?
			}
			else
			{
				?>
				<h2><a href="#"><?=_("Packages")?></a> &raquo; <a href="#" class="active"><?=_("Add a new Package")?></a></h2>
				<?
			}
			if(trim($err) != ""){
			?>
				<p>
					<h3><?=_("Please correct the following errors: ")?></h3>
					<div class="err"><?=$err?></div>
				</p>						
			<?
			}
			?>
			
			<form action="<?=$currentPage?>" method="post" class="jNice">
				<fieldset>
					<p>
					<label><?=_("Package Name")?></label>
					<input type="text" name="name" value="<?=$_POST['name']?>" class="text-long" maxlenght="150" />
					</p>
					
					<p>
					<label><?=_("Package Description")?></label>
					<textarea name="description" maxlenght="500"><?=$_POST['description']?></textarea>
					</p>
					
					<p>
					<label><?=_("Package Duration (In Days)")?></label>
					<input type="text" name="duration" value="<?=$_POST['duration']?>" class="text-small" maxlenght="20" />
					</p>
					
					<p>
					<label><?=_("Package Price")?></label>
					<input type="text" name="price" value="<?=$_POST['price']?>" class="text-small" maxlenght="10" />
					</p>
					<p>
						<label><?=_("Currency")?> : </label>
						<select name="currency">
							<?php
								$sql="select * from currencies";
								$rsGetCurrencies=$DB->execute($sql);
								while(!$rsGetCurrencies->EOF){
									
									if($rsGet->fields['id'] == $_POST['currency']){
										$selected = "selected='selected'";
									}
									else $selected = '';
									
									?>
										<option <?=$selected?> value="<?=$rsGetCurrencies->fields['id']?>" <? if($rsGetCurrencies->fields['id'] == $rsGet->fields['currency']) echo "selected='selected'" ?>><?=$rsGetCurrencies->fields['code']."-".$rsGetCurrencies->fields['name']?></option>
									<?
									$rsGetCurrencies->movenext();
								}
							?>
						<select>
					</p>
					<?php
					if($_POST['flgEdit'] != "" or $_GET['pck_id'] != "")
					{
						?>
						<p>
							<label>&nbsp;</label>
							<input type="hidden" value="<?=$id?>" name="pck_id" />
							<input type="hidden" value="1" name="flgUpd" />
							<input type="submit" value="<?=_("Update")?>" name="update" />
						</p>
						<?
					}
					else
					{
						?>
						<p>
							<label><?=_("Add package")?></label>
							<input type="hidden" value="1" name="flgAdd" />
							<input type="submit" value="<?=_("Add")?>" name="add" />
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