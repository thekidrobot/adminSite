<?php
	include('includes/head.php');
?>
<body> 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    
	<!-- Start: page-top -->
	<?php include('includes/page_top.php'); ?>
	<!-- End: page-top -->
</div>
<!-- End: page-top-outer -->
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
	<!--  start nav-outer -->
	<div class="nav-outer"> 
		<!-- start nav-right -->
		<?php include('includes/nav_right.php');?>
		<!-- end nav-right -->

		<!--  start nav -->
		<?php include('includes/nav.php'); ?>
		<!--  start nav -->
		
	</div>
	<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->
<div class="clear"></div>
 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1><?=_("Change your personal info")?></h1>
	</div>
	<!-- end page-heading -->

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<h2><?=_("Keep your data updated")?></h2>
			<h3><?=_("Let us know you better")?></h3>
			
<?

	$usr_id = $_SESSION['id'];
	 
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
			 $msg = "Your data has been updated sucessfully.";
			 sleep(5);
			 redirect($curr_page);			 
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
			 $msg = "Your data has been updated sucessfully.";
			 sleep(5);
			 redirect($curr_page);
			}
		}
	}
	
?>
			<?
			if(trim($err) != ""){
			?>
				<p>
					<label><?=_("Please correct the following errors: ")?></label>
					<div><?=$err?></div>
				</p>						
			<?
			}
			elseif(trim($msg) != ""){
			?>
				<p>
					<div><?=$msg?></div>
				</p>						
			<?
			}
			?>
			
			<div id="custom_form">
				<form action="<?=$currentPage?>" method="post">
				<p>
					<label><?=_("Subscriber Name")?> :</label>
					<input type="text" name="name" value="<?=$rsGet->fields['name']?>" maxlength="255" class="inp-form" />
				</p>

				<p>
					<label><?=_("Subscriber Username")?></label>
					<input type="text" name="username" value="<?=$rsGet->fields['username']?>" maxlength="100" class="inp-form" />
				</p>
				<p>
					<label><?=_("Subscriber Password")?></label>
					<input type="password" name="password1" value="<?=$rsGet->fields['password']?>" maxlength="15" class="inp-form" />
				</p>
				<p>
					<label><?=_("Repeat Password")?></label>
					<input type="password" name="password2" value="<?=$rsGet->fields['password']?>" maxlength="15" class="inp-form" />
				</p>				
				<p>
					<label><?=_("Subscriber Address")?></label>
					<input type="text" name="address" value="<?=$rsGet->fields['address']?>" maxlength="200" class="inp-form" />
				</p>
				<p>
					<label><?=_("Subscriber Email")?></label>
					<input type="text" name="email" value="<?=$rsGet->fields['email']?>" maxlength="100" class="inp-form" />
				</p>
				<p>
					<label><?=_("Subscriber Account Number")?></label>
					<input type="text" name="account" value="<?=$rsGet->fields['account']?>" maxlength="100" class="inp-form" />
				</p>
				<p>
					<label><?=_("Subscriber Phone")?></label>
					<input type="text" name="phone" value="<?=$rsGet->fields['phone']?>" maxlength="100" class="inp-form" />
				</p>
				<p>
					<label><?=_("Subscriber Country")?> : </label>
					<select name="country" class="styledselect_form_1">
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
					<input type="text" name="city" value="<?=$rsGet->fields['city']?>" maxlength="100" class="inp-form" />
				</p>
				<p>
					<label><?=_("Subscriber Zip code")?></label>
					<input type="text" name="zip" value="<?=$rsGet->fields['zip']?>" maxlength="10" class="inp-form" />
				</p>
				<p>
					<label><?=_("STB Mac Address")?></label>
					<input type="text" name="mac" value="<?=$rsGet->fields['mac']?>" maxlength="100" class="inp-form" />
				</p>
				<p>
					<label><?=_("STB Serial number")?></label>
					<input type="text" name="serial" value="<?=$rsGet->fields['serial']?>" maxlength="100" class="inp-form" />
				</p> 	 
				<p>
					<label><?=_("Computer License")?></label>
					<input name="license" type="text" value="<?=$rsGet->fields['license']?>" class="inp-form" />
				</p>
				<p>
					<label><?=_("Update")?></label>
 					<input type="hidden" value="<?=$rsGet->fields['id']?>" name="usr_id" />
					<input type="submit" value="<?=_("Update")?>" name="edit" class="form-submit" />
				</p> 

			</form>
			
			</div>
			
			</div>
			<!--  end table-content  -->
	
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<?php include('includes/footer.php'); ?>
<!-- end footer -->
 
</body>
</html>