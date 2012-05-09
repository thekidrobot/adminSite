<?
	include("includes/connection.php");
	include("session.php");

	//Restricted Page
	if($role == 0) redirect('index.php');

	$usr_id = $_REQUEST['usr_id'];
	
	if(trim($usr_id) == "" or !is_numeric($usr_id) or $usr_id == 0)
	{
		redirect("admins.php");
	}	
 
	$sql = "SELECT * FROM administrador where IdAdministrador = $usr_id";
	$rsGet = $DB->Execute($sql);
	
	$message = "The user ".$_SESSION['username']." has viewed the information for the admin '".$rsGet->fields['Login']."' With ID ". $usr_id;
	writeToLog($message);
	
	if($_POST['usr_id'] != "")
	{
		$id = $_POST['usr_id'];
		
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
			$message = "The user ".$_SESSION['username']." has edited the information for the admin '".$rsGet->fields['Login']."' With ID $id.";
			writeToLog($message);
			
			//Same password, so we don't update
			if($password === $rsGet->fields['Clave'])
			{
			 $sql = "UPDATE administrador 
							 SET 		Rol = $role
							 WHERE	IdAdministrador = $id";
							 
			 $rsSet=$DB->execute($sql);		 
			 redirect("admins.php");
			}
			else
			{
			 $password = md5($password);
		 
			 $sql = "UPDATE administrador
							 SET 		Clave = '$password',
											Rol = $role 
							 WHERE	IdAdministrador = $id";
							 
			 $rsSet=$DB->execute($sql);
			 redirect("admins.php");
			}
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
			<h2><a href="#"><?=_("Administrator")?></a> &raquo; <a href="#" class="active"><?=_("Edit Information")?></a></h2>
			
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
					<input type="text" name="username" value="<?=$rsGet->fields['Login']?>" maxlength="100" class="text-long" readonly="readonly" />
				</p>
				<p>
					<label><?=_("Password")?></label>
					<input type="password" name="password1" value="<?=$rsGet->fields['Clave']?>" maxlength="15" class="text-long" />
				</p>
				<p>
					<label><?=_("Repeat Password")?></label>
					<input type="password" name="password2" value="<?=$rsGet->fields['Clave']?>" maxlength="15" class="text-long" />
				</p>				
				<p>
					<label><?=_("Role")?> : </label>
					<select name="role">
						<?php
							$sql="select * from roles";
							$rsGetRoles=$DB->execute($sql);
							while(!$rsGetRoles->EOF){
								?>
									<option value="<?=$rsGetRoles->fields['id']?>" <? if($rsGetRoles->fields['id'] == $rsGet->fields['Rol']) echo "selected = 'selected'" ?>><?=$rsGetRoles->fields['name']?></option>
								<?
								$rsGetRoles->movenext();
							}
						?>
					</select>
				</p>
				<p>
					<label><?=_("Update")?></label>
 					<input type="hidden" value="<?=$rsGet->fields['IdAdministrador']?>" name="usr_id" />
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