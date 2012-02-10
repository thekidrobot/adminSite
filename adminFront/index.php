<?php
	session_start();
	include('includes/connection.php');
	include('includes/general_functions.php');
	include('includes/formvalidator.php');

	foreach($_POST as $key=>$value)
	{
	 $$key=$value;
	}
	
	if(trim(escape_value($username))!="" and trim(escape_value($password))!="")
	{
		$error = auth_user($username,$password);
	}
	elseif(isset($_POST['forgotbox']) and escape_value($email) != '')
	{// The form is submitted
		
		$email = escape_value($email);
		
		//Setup Validations
		$validator = new FormValidator();
		$validator->addValidation("email","email","Invalid Email");
            
    //Now, validate the form
    if($validator->ValidateForm())
    { 
			$password = genRandomString();
      
			$password_enc = md5($password);
              
      $query="UPDATE subscribers set password = '$password_enc' where email = '$email'";
      $r= mysql_query($query)or die("Error : ".mysql_error());
              
      if (mysql_affected_rows() > 0)
			{
				$id =mysql_insert_id();
				
				$msg = "Password sent to $email";
									 
				$query = mysql_query("SELECT name from subscribers where email = '$email'"); 
									
				while ($row = mysql_fetch_object($query))
				{
					$fname = $row->name;
				}
				
				//For the mail
				$subject = "Change Password Request";
		
				$body="<p>Dear ".$fname.",<br />
							<br />
							<p><h2>Password change request.</h2>
							As per your password reset request, your new pasword is:
							$password. <br /><br />Note that the letters in the password are case sensitive. <br /> <br />
							-- <br/> Thanks,<br />
							The RAMP Team</p>";
  
        sendemail($email,$subject,$body);
      }
      else
			{
				$msg = "Nonexistent Email.";
      }
		}
    else
    {
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err)
			{
				$msg.=$inp_err;
			}
    }//else
  }//if(isset($_POST['forgotbox']))	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>RAMP</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--  jquery core -->
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body id="login-bg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">

	<!-- start logo -->
	<div id="logo-login">
		<a href="index.php"><img src="images/shared/logo.png" width="156" height="40" alt="" /></a>
	</div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	
	<!--  start login-inner -->
	<form action="<?=$_SERVER['PHP_SELF'] ?>" method="post">
		<div id="login-inner">
			<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<th>Username</th>
				<td><input type="text" class="login-inp" name="username" /></td>
			</tr>
			<tr>
				<th>Password</th>
				<td><input type="password" onfocus="this.value=''" class="login-inp" name="password" /></td>
			</tr>
				
			<tr>
				<th></th>
				<td><input type="submit" class="submit-login" name="loginbox" /></td>
			</tr>
			
			</table>

			<div align="center">
				<?php
				if($error)
				{
					?>
					<div id="forgotbox-text">Username/Password error</div>
				  <?php
				}
				elseif($msg)
				{
					?>	
				  <div id="forgotbox-text"><?=$msg?></div>
				  <?php
				}
				?>
			</div>
			
		</div>
	</form>
 	<!--  end login-inner -->
	<div class="clear"></div>
	<a href="" class="forgot-pwd">Forgot Password?</a>
 </div>
 <!--  end loginbox -->
 
	<!--  start forgotbox ................................................................................... -->
	<div id="forgotbox">
		<form action="<?=$_SERVER['PHP_SELF'] ?>" method="post">
			<div id="forgotbox-text">Please send us your email and we'll reset your password.</div>
			<!--  start forgot-inner -->
			<div id="forgot-inner">
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<th>Email address:</th>
					<td><input type="text" name="email" value="" class="login-inp" /></td>
				</tr>
				<tr>
					<th> </th>
					<td><input type="submit" class="submit-login" name="forgotbox" /></td>
				</tr>
				</table>
			</div>
			<!--  end forgot-inner -->
			<div class="clear"></div>
			<a href="" class="back-login">Back to login</a>
		</form>
	</div>
	<!--  end forgotbox -->

</div>
<!-- End: login-holder -->
</body>
</html>