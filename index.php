<?
include("conexion.php");
include("clases/clsusuario.php");

session_start();

//variables de acceso
$_SESSION["usuario"]="";		// almacena el usuario en sesion
$_SESSION["idusuario"]="";		// almacena el id del usuario en sesion

//objetos
$objUsuario=new clsusuario();
$msg="";

///ingresar al sistema
if($_POST["ingresar"]!="")
 {
   if($_POST["valorModo"]=="1")
    {
	   //administrador
	   $clave=$_POST["valorClave"];
	   $valido=$objUsuario->validacionAdministrador($_POST["valorLogin"],$clave);

	   if($valido!="0")
		{
		  //valido
		  $_SESSION["usuario"]=$_POST["valorLogin"];
		  $_SESSION["idusuario"]=$valido;
		  ?>
		  <script language="javascript">
		  document.location="menuadmin.php";
		  </script>
		  <?
		}
	}
   else
    {
	   //usuario
	   $valido=$objUsuario->validacionUsuario($_POST["valorLogin"],$_POST["valorClave"]);

	   if($valido!="0")
		{
		  //valido
		  $_SESSION["usuario"]=$_POST["valorLogin"];
		  $_SESSION["idusuario"]=$valido;
		  ?>
		  <script language="javascript">
		  document.location="galeria/index.php";
		  </script>
		  <?
		}
	}
    
	$msg="O usuário é invalido";
 }

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
          <td colspan="3" class="link10"><div align="center" class="trebuchet_15"><strong>            Digite seu nome de usu&aacute;rio e senha</strong></div></td>
        </tr>
        <tr>
          <td class="link10">&nbsp;</td>
          <td class="text10">&nbsp;</td>
          <td class="body-text1"><div align="left">
            <input type="hidden" name="ingresar" value="1">
          </div></td>
        </tr>
        <tr>
          <td width="15" class="link10">&nbsp;</td>
          <td width="61" class="tahoma_12"><span class="trebuchet_12">Usu&aacute;rio</span></td>
          <td width="175" class="body-text1"><div align="left">
            <input name="valorLogin" type="text" class="trebuchet_12" style="width:150" size="30" maxlength="50">
          </div></td>
        </tr>
        <tr>
          <td class="link10">&nbsp;</td>
          <td class="trebuchet_12"> Senha</td>
          <td class="body-text1"><div align="left">
            <input name="valorClave" type="password" class="trebuchet_12" style="width:150" size="30" maxlength="50">
          </div></td>
        </tr>
        <tr>
          <td class="link10">&nbsp;</td>
          <td class="trebuchet_12"> Modo </td>
          <td class="text10"><div align="left">
            <select name="valorModo" class="trebuchet_12" style="width:150">
              <option value="1">Administrador</option>
            </select>
          </div></td>
        </tr>
        <tr>
          <td height="30" align="right" class="body-text1">&nbsp;</td>
          <td align="right" class="body-text1">&nbsp;</td>
          <td align="right" valign="middle" class="text10"><div align="left">
            <p>
              <input type="image" src="imagenes/entrar2.jpg" align="left">
            </p>
          </div></td>
        </tr>
        <tr>
          <td align="right" class="body-text1"><div align="center"></div></td>
          <td align="right" class="body-text1">&nbsp;</td>
          <td align="right" class="body-text1"><div align="left"><span class="tahoma_11">
            <?=$msg?>
          </span></div></td>
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
