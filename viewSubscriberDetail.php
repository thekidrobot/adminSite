<?
	include("includes/connection.php");
	include("session.php");

	$usr_id = $_REQUEST['usr_id'];
	
	$sql = "SELECT * FROM subscribers where id = $usr_id";
	$rsGet = $DB->Execute($sql);
	
	if($_POST['usr_id'] != "")
	{
		$id = $_POST['usr_id'];
		
		$postArray = &$_POST;
		
		$name=escape_value($postArray['name']);
		$username=escape_value($postArray['username']);
		$password=escape_value($postArray['password1']);
		$address=escape_value($postArray['address']);
		$email=escape_value($postArray['email']);
		$account=escape_value($postArray['account']);
		$phone=escape_value($postArray['phone']);
		$country=escape_value($postArray['country']);
		$city=escape_value($postArray['city']);
		$zip=escape_value($postArray['zip']);
		$serial=escape_value($postArray['serial']);
		$mac=escape_value($postArray['mac']);
		$license=escape_value($postArray['license']);
				
		$validator = new FormValidator();
		$validator->addValidation("name","req",_("Name is a mandatory field"));
		$validator->addValidation("username","req",_("Username is a mandatory field"));
		$validator->addValidation("password1","req",_("Password is a mandatory field"));
		$validator->addValidation("password1","minlen=8",_("Password should be greater than 8 characters"));
		$validator->addValidation("password1","alnum",_("Password should have only numbers and letters"));
		$validator->addValidation("password2","req",_("Please confirm the password"));
		$validator->addValidation("password2","eqelmnt=password1",_("Passwords don't match"));
		$validator->addValidation("address","req",_("Address is a mandatory field"));
		$validator->addValidation("email","req",_("Email is a mandatory field"));
		$validator->addValidation("email","email",_("Email format is not valid"));
		$validator->addValidation("account","req",_("Account number is a mandatory field"));
		$validator->addValidation("phone","req",_("Phone number is a mandatory field"));
		$validator->addValidation("city","req",_("City is a mandatory field"));
		$validator->addValidation("zip","req",_("Zip code is a mandatory field"));
		$validator->addValidation("zip","num",_("Zip code should be a number"));
		
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
			//Same password, so we don't updated
			if($password === $rsGet->fields['password'])
			{
			 $sql = "update subscribers set
							 name = '$name',
							 username = '$username',
							 address = '$address',
							 email = '$email',
							 account = '$account',
							 phone = '$phone',
							 country = '$country',
							 city = '$city',
							 zip = '$zip',
							 serial = '$serial',
							 mac = '$mac',
							 license = '$license'
							 where id = $id";
							 
			 $rsSet=$DB->execute($sql);		 
			 redirect("viewSubscriberDetail.php?usr_id=$id");
			}
			else
			{
			 $password = md5($password);
		 
			 $sql = "update subscribers set
							 name = '$name',
							 username = '$username',
							 password = '$password',
							 address = '$address',
							 email = '$email',
							 account = '$account',
							 phone = '$phone',
							 country = '$country',
							 city = '$city',
							 zip = '$zip',
							 serial = '$serial',
							 mac = '$mac',
							 license = '$license'
							 where id = $id";
							 
			 $rsSet=$DB->execute($sql);
			 redirect("viewSubscriberDetail.php?usr_id=$id");
			}
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
			<h2><a href="#"><?=_("Subscribers")?></a> &raquo; <a href="#" class="active"><?=_("View subscriber detail")?></a></h2>
			
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
					<label><?=_("Subscriber Address")?></label>
					<input type="text" name="address" value="<?=$rsGet->fields['address']?>" maxlength="200" class="text-long" />
				</p>
				<p>
					<label><?=_("Subscriber Email")?></label>
					<input type="text" name="email" value="<?=$rsGet->fields['email']?>" maxlength="100" class="text-long" />
				</p>
				<p>
					<label><?=_("Subscriber Account Number")?></label>
					<input type="text" name="account" value="<?=$rsGet->fields['account']?>" maxlength="100" class="text-long" />
				</p>
				<p>
					<label><?=_("Subscriber Phone")?></label>
					<input type="text" name="phone" value="<?=$rsGet->fields['phone']?>" maxlength="100" class="text-long" />
				</p>
				<p>
					<label><?=_("Subscriber Country")?> : </label>
					<select name="country">
						<?php
							$sql="select * from countries";
							$rsGetCountries=$DB->execute($sql);
							while(!$rsGetCountries->EOF){
								?>
									<option value="<?=$rsGetCountries->fields['id']?>" <? if($rsGetCountries->fields['id'] == $rsGet->fields['country']) echo "selected = 'selected'" ?>><?=$rsGetCountries->fields['name']?></option>
								<?
								$rsGetCountries->movenext();
							}
						?>
					<select>
				</p>
				<p>
					<label><?=_("Subscriber city")?></label>
					<input type="text" name="city" value="<?=$rsGet->fields['city']?>" maxlength="100" class="text-long" />
				</p>
				<p>
					<label><?=_("Subscriber Zip code")?></label>
					<input type="text" name="zip" value="<?=$rsGet->fields['zip']?>" maxlength="10" class="text-small" />
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
					<label><?=_("Update")?></label>
 					<input type="hidden" value="<?=$rsGet->fields['id']?>" name="usr_id" />
					<input type="submit" value="<?=_("Update")?>" name="edit" />
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