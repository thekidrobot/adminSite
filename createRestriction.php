<?
	include("includes/connection.php");
	include("session.php");

	$err = "";

	if($_POST['addRule']!="")
	{
		$postArray = &$_POST;
		
		$name=escape_value($postArray['name']);
		$price=escape_value($postArray['price']);
		$currency=escape_value($postArray['currency']);
		$duration=escape_value($postArray['duration']);
		$views=escape_value($postArray['max_views']);
				
		$validator = new FormValidator();
		$validator->addValidation("name","req",_("Name is a mandatory field"));
		$validator->addValidation("price","req",_("Price is a mandatory field"));
		$validator->addValidation("duration","req",_("Duration is a mandatory field"));
		$validator->addValidation("duration","num",_("Duration should be a number"));
		$validator->addValidation("max_views","req",_("Views is a mandatory field"));
		$validator->addValidation("max_views","num",_("Views should be a number"));

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
			
			$sql = "INSERT INTO
							restrictions
							(name,price,duration,currency,max_views)
							VALUES
							('$name','$price','$duration','$currency','$views')";
		
			$rsSet = $DB->Execute($sql);
			$usr_id = $DB->Insert_ID();

			$message = "The user ".$_SESSION['username']." has created the restriction '".$name."' With ID ".$usr_id;
			writeToLog($message);
	
			redirect("viewRestrictions.php");				
		}
	}

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
			<h2><a href="#"><?=_("Restrictions")?></a> &raquo; <a href="#" class="active"><?=_("Create new restriction rule")?></a></h2>	
			<?
			if(trim($err) != ""){
			?>
				<p>
					<h3><?=_("Please correct the following errors: ")?></h3>
					<div class="err"><?=$err?></div>
				</p>						
			<?
			}
			?>
			
			<form action="<?=$currentPage?>" method="post" class="jNice" >
				<fieldset>
				<p>
					<label><?=_("Rule Name")?></label>
					<input type="text" name="name" value="<?=$_POST['name']?>" maxlength="255" class="text-long" />
				</p>
				<p>
					<label><?=_("Rule Price")?></label>
					<input type="text" name="price" value="<?=$_POST['price']?>" maxlength="10" class="text-small" />
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
				<p>
					<label><?=_("Validity (In Days)")?></label>
					<input type="text" name="duration" value="0" maxlength="10" class="text-small" />
				</p>
				<p>
					<label><?=_("Number of views")?><br/>
					<?=_("(Zero means unlimited)")?></label>
					<input type="text" name="max_views" value="0" maxlength="10" class="text-small" />
				</p>
				<p>
					<label><?=_("Save Rule")?></label>
					<input type="hidden" name="addRule" value="1" />
					<input type="submit" value="<?=_("Save")?>" />
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