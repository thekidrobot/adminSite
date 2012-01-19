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
			$password = md5($password);
			
			$sql = "INSERT INTO
							restrictions
							(name,price,duration,currency,current_views,max_views)
							VALUES
							('$name','$price','$currency','$duration',0,'$views')";
		
			$rsSet = $DB->Execute($sql);
			$usr_id = $DB->Insert_ID();
	
			redirect("viewRestrictions.php");				
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
					<input type="text" name="name" value="<?=$rsGet->fields['name']?>" maxlength="255" class="text-long" />
				</p>
				<p>
					<label><?=_("Rule Price")?></label>
					<input type="text" name="price" value="<?=$rsGet->fields['price']?>" maxlength="100" class="text-small" />
				</p>
				<p>
					<label><?=_("Currency")?> : </label>
					<select name="currency">
						<?php
							$sql="select * from currencies";
							$rsGet=$DB->execute($sql);
							while(!$rsGet->EOF){
								?>
									<option value="<?=$rsGet->fields['id']?>"><?=$rsGet->fields['code']."-".$rsGet->fields['name']?></option>
								<?
								$rsGet->movenext();
							}
						?>
					</select>
				</p>
				<p>
					<label><?=_("Validity (In Days)")?></label>
					<input type="text" name="duration" value="<?=$rsGet->fields['duration']?>" maxlength="200" class="text-small" />
				</p>
				<p>
					<label><?=_("Number of views")?><br/>
					<?=_("(Zero means unlimited)")?></label>
					<input type="text" name="max_views" value="0" maxlength="100" class="text-small" />
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