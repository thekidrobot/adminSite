<?php
	session_start();
	include('includes/connection.php');
	include('includes/general_functions.php');
	include('includes/formvalidator.php');

	foreach($_POST as $key=>$value)
	{
	 $$key=$value;
	}
	
	if(escape_value($email) != '')
	{// The form is submitted
		
		$email = escape_value($email);
		
		//Setup Validations
		$validator = new FormValidator();
		$validator->addValidation("email","email",_("Invalid Email"));
            
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
				
				$msg = _("Password sent to $email");
									 
				$query = mysql_query("SELECT name from subscribers where email = '$email'"); 
									
				while ($row = mysql_fetch_object($query))
				{
					$fname = $row->name;
				}
				
				//For the mail
				$subject = _("Change Password Request");
		
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
				$msg = _("Nonexistent Email.");
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
  }//if escape_value(email)
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>:::::RAMP:::::</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="css/index.css">

<style type="text/css">
<!--
body {
	background-color: #FFF;
}
.trebuchet_15 {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #930;
}
.trebuchet_12 {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #000;
}
.tahoma_11 {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 11px;
	color: #F00;
}
.bodyBackGround {
	background-image: url(images/login/BackGroundfront.jpg);
	background-repeat: repeat-x;
}
.button_submit{
	background-image: url(images/login/entrar2.jpg);
	background-repeat: no-repeat;
	border:none;
	background-color:transparent;
	height:30px;
	width:100px;
	cursor:pointer;
}
a{
	text-decoration:none;
	color:#666666;
}
-->
</style></head>
<body leftmargin="0" topmargin="0" class="bodyBackGround" >
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
  <table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
    <!-- fwtable fwsrc="rampMS.png" fwpage="P&aacute;gina 1" fwbase="front.jpg" fwstyle="Dreamweaver" fwdocid = "335304702" fwnested="0" -->
    <tr>
      <td><img src="images/login/spacer.gif" width="347" height="1" border="0" alt="" /></td>
      <td><img src="images/login/spacer.gif" width="330" height="1" border="0" alt="" /></td>
      <td><img src="images/login/spacer.gif" width="347" height="1" border="0" alt="" /></td>
      <td><img src="images/login/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3"><img name="front_r1_c1" src="images/login/front_r1_c1.jpg" width="1024" height="141" border="0" id="front_r1_c1" alt="" /></td>
      <td><img src="images/login/spacer.gif" width="1" height="141" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3"><img name="front_r2_c1" src="images/login/front_r2_c1.jpg" width="1024" height="124" border="0" id="front_r2_c1" alt="" /></td>
      <td><img src="images/login/spacer.gif" width="1" height="124" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img name="front_r3_c1" src="images/login/front_r3_c1.jpg" width="347" height="266" border="0" id="front_r3_c1" alt="" /></td>
      <td background="images/login/front_r3_c2.jpg"><table width="307" height="194" border="0" align="center">
        <tr>
          <td colspan="3" class="link10"><div align="center" class="trebuchet_15"><strong><?=_("New Password Request")?></strong></div></td>
        </tr>
        <tr>
          <td class="link10">&nbsp;</td>
          <td class="text10">&nbsp;</td>
          <td class="body-text1"><div align="left">
          </td>
        </tr>
        <tr>
          <td width="15" class="link10">&nbsp;</td>
          <td width="61" class="tahoma_12"><span class="trebuchet_12"><?=_("Email")?></span></td>
          <td width="175" class="body-text1"><div align="left">
            <input type="text" name="email" maxlength="150" style="width:150" size="30" />
          </div></td>
        </tr>				
        <tr>
          <td height="30" align="right" class="body-text1">&nbsp;</td>
          <td align="right" class="body-text1">&nbsp;</td>
          <td align="right" valign="middle" class="text10"><div align="left">
          <span class="tahoma_11">
            <a href="index.php">Back to Login</a>
          </span>
          </div></td>
        </tr>				
        <tr>
          <td height="30" align="right" class="body-text1">&nbsp;</td>
          <td align="right" class="body-text1">&nbsp;</td>
          <td align="right" valign="middle" class="text10"><div align="left">
            <p>
              <input type="submit" name="submit" value="&nbsp;" class="button_submit" align="left">
            </p>
          </div></td>
        </tr>
        <tr>
          <td align="right" class="body-text1"><div align="center"></div></td>
          <td align="right" class="body-text1">&nbsp;</td>
          <td align="right" class="body-text1"><div align="left">
					<span class="tahoma_11">
					  <?php
						if($error)
						{
							?>
							<?=_("Username/Password error")?>
							<?php
						}
						elseif($msg)
						{
							echo $msg;
						}
						?>
          </span></div></td>
        </tr>
        <tr>
          <td align="right" class="body-text1"><div align="center" class="index-titles"></div></td>
          <td align="right" class="body-text1">&nbsp;</td>
          <td align="right" class="body-text1"><div align="left"></div></td>
        </tr>
      </table></td>
      <td><img name="front_r3_c3" src="images/login/front_r3_c3.jpg" width="347" height="266" border="0" id="front_r3_c3" alt="" /></td>
      <td><img src="images/login/spacer.gif" width="1" height="266" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3"><img name="front_r4_c1" src="images/login/front_r4_c1.jpg" width="1024" height="197" border="0" id="front_r4_c1" alt="" /></td>
      <td><img src="images/login/spacer.gif" width="1" height="197" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3"><img name="front_r5_c1" src="images/login/front_r5_c1.jpg" width="1024" height="40" border="0" id="front_r5_c1" alt="" /></td>
      <td><img src="images/login/spacer.gif" width="1" height="40" border="0" alt="" /></td>
    </tr>
  </table>
<br>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
</html>
