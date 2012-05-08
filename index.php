<?
session_start();

include('includes/connection.php');
include('includes/general_functions.php');
include('includes/formvalidator.php');

foreach($_POST as $key=>$value) $$key=$value;

if(trim(escape_value($username))!="" and trim(escape_value($password))!="") $error = auth_user($username,$password);

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
	background-image: url(newImages/BackGroundfront.jpg);
	background-repeat: repeat-x;
}
a{
	text-decoration:none;
	color:#666666;
}
-->
</style></head>
<body leftmargin="0" topmargin="0" class="bodyBackGround" >
<form name="formProceso" action="index.php" method="post" onSubmit="return validaAcceso()">
  <table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
    <!-- fwtable fwsrc="rampMS.png" fwpage="P&aacute;gina 1" fwbase="front.jpg" fwstyle="Dreamweaver" fwdocid = "335304702" fwnested="0" -->
    <tr>
      <td><img src="newImages/spacer.gif" width="347" height="1" border="0" alt="" /></td>
      <td><img src="newImages/spacer.gif" width="330" height="1" border="0" alt="" /></td>
      <td><img src="newImages/spacer.gif" width="347" height="1" border="0" alt="" /></td>
      <td><img src="newImages/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3"><img name="front_r1_c1" src="newImages/front_r1_c1.jpg" width="1024" height="141" border="0" id="front_r1_c1" alt="" /></td>
      <td><img src="newImages/spacer.gif" width="1" height="141" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3"><img name="front_r2_c1" src="newImages/front_r2_c1.jpg" width="1024" height="124" border="0" id="front_r2_c1" alt="" /></td>
      <td><img src="newImages/spacer.gif" width="1" height="124" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img name="front_r3_c1" src="newImages/front_r3_c1.jpg" width="347" height="266" border="0" id="front_r3_c1" alt="" /></td>
      <td background="newImages/front_r3_c2.jpg"><table width="307" height="194" border="0" align="center">
        <tr>
          <td colspan="3" class="link10"><div align="center" class="trebuchet_15"><b><?=_("Welcome to RAMP")?></strong></div></td>
        </tr>
				<tr>
          <td colspan="3" class="link10">&nbsp;</td>
        </tr>
        <tr>
          <td width="15" class="link10">&nbsp;</td>
          <td width="61" class="tahoma_12"><span class="trebuchet_12"><?=_("User")?></span></td>
          <td width="175" class="body-text1"><div align="left">
            <input type="text" name="username" maxlength="50" style="width:150" size="30" />
          </div></td>
        </tr>
        <tr>
          <td class="link10">&nbsp;</td>
          <td class="trebuchet_12"><?=_("Password")?></td>
          <td class="body-text1"><div align="left">
            <input type="password" onfocus="this.value=''" name="password" maxlength="50" style="width:150" size="30" />
          </div></td>
        </tr>
        <tr>
          <td height="30" align="right" class="body-text1">&nbsp;</td>
          <td align="right" class="body-text1">&nbsp;</td>
          <td align="right" valign="middle" class="text10"><div align="left">
            <p>
              <input type="submit" name="submit" value="Entrar" class="button_submit" align="left">
            </p>
          </div></td>
        </tr>
        <tr>
          <td align="right" class="body-text1"><div align="center"></div></td>
          <td align="right" class="body-text1">&nbsp;</td>
          <td align="right" class="body-text1">
						<div align="left"><span class="tahoma_11">
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
          </span></div>
					</td>
        </tr>
        <tr>
          <td align="right" class="body-text1"><div align="center" class="index-titles"></div></td>
          <td align="right" class="body-text1">&nbsp;</td>
          <td align="right" class="body-text1"><div align="left"></div></td>
        </tr>
      </table></td>
      <td><img name="front_r3_c3" src="newImages/front_r3_c3.jpg" width="347" height="266" border="0" id="front_r3_c3" alt="" /></td>
      <td><img src="newImages/spacer.gif" width="1" height="266" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3"><img name="front_r4_c1" src="newImages/front_r4_c1.jpg" width="1024" height="197" border="0" id="front_r4_c1" alt="" /></td>
      <td><img src="newImages/spacer.gif" width="1" height="197" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3"><img name="front_r5_c1" src="newImages/front_r5_c1.jpg" width="1024" height="40" border="0" id="front_r5_c1" alt="" /></td>
      <td><img src="newImages/spacer.gif" width="1" height="40" border="0" alt="" /></td>
    </tr>
  </table>
<br>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
</html>
