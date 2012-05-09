<?
	include("includes/connection.php");
	include("session.php");

	//Restricted Page
	if($role == 0) redirect('index.php');

	$err = "";

	if($_POST['addAdmin']!="")
	{
		$postArray = &$_POST;
		
		$username=escape_value($postArray['username']);
		$password=escape_value($postArray['password1']);
		$role=escape_value($postArray['role']);

				
		$validator = new FormValidator();
		$validator->addValidation("username","req",_("Username is a mandatory field"));
		$validator->addValidation("password1","req",_("Password is a mandatory field"));
		$validator->addValidation("password1","minlen=8",_("Password should be greater than 8 characters"));
		$validator->addValidation("password1","alnum",_("Password should have only numbers and letters"));
		$validator->addValidation("password2","req",_("Please confirm the password"));
		$validator->addValidation("password2","eqelmnt=password1",_("Passwords don't match"));

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
							administrador
								(Login,Clave,Rol)
							VALUES
								('$username','$password',$role)";
		
			$rsSet = $DB->Execute($sql);
			$usr_id = $DB->Insert_ID();
	
			$message = "The user ".$_SESSION['username']." has created the admin '".$username."' With ID ".$usr_id;
			writeToLog($message);
	
			redirect("admins.php");				
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
			<h2><a href="#"><?=_("Administrators")?></a> &raquo; <a href="#" class="active"><?=_("Create new administrator")?></a></h2>	
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
					<label><?=_("Username")?></label>
					<input type="text" name="username" value="<?=$_POST['username']?>" maxlength="100" class="text-long" />
				</p>
				<p>
					<label><?=_("Password <br /> [More than 8 characters]")?></label>
					<input type="password" name="password1" value="" maxlength="150" class="text-long" />
				</p>
				<p>
					<label><?=_("Repeat Password")?></label>
					<input type="password" name="password2" value="" maxlength="150" class="text-long" />
				</p>
				<p>
					<label><?=_("Role")?> : </label>
					<select name="role">
						<?php
							$sql="select * from roles";
							$rsGetRoles=$DB->execute($sql);
							while(!$rsGetRoles->EOF){
								?>
									<option value="<?=$rsGetRoles->fields['id']?>" <? if($rsGetRoles->fields['id'] == $_POST['role']) echo "selected = 'selected'" ?>><?=$rsGetRoles->fields['name']?></option>
								<?
								$rsGetRoles->movenext();
							}
						?>
					</select>
				</p>
				<p>
					<label><?=_("Save Admin")?></label>
					<input type="hidden" name="addAdmin" value="1" />
					<input type="submit" name="add" value="<?=_("Save")?>" />
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