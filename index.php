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
<link rel="stylesheet" href="INDEX.CSS">
<script language="javascript" src="js.js"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<link href="css/stilos.css" rel="stylesheet" type="text/css">
<link href="galeria/css/galeria.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
body {
	background-color: #3B3B3B;
}
-->
</style></head>
<body leftmargin="0" topmargin="0" background="" >
<form name="formProceso" action="index.php" method="post" onSubmit="return validaAcceso()">
  <table width="342" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="19" rowspan="3" valign="top"><img name="login_r1_c1" src="newImages/login_r1_c1.jpg" width="17" height="454" border="0" id="login_r1_c6" alt="" /></td>
      <td><img name="login_r1_c2" src="newImages/login_r1_c2.jpg" width="308" height="184" border="0" id="login_r1_c4" alt="" /></td>
      <td width="24" rowspan="3" valign="top"><img name="login_r1_c3" src="newImages/login_r1_c3.jpg" width="17" height="454" border="0" id="login_r1_c5" alt="" /></td>
    </tr>
    <tr>
      <td height="233" background="newImages/login_r2_c2.jpg"><table width="307" height="194" border="0" align="center">
        <tr>
          <td colspan="3" class="link10"><div align="center" class="stepactive"><strong><br>
            Digite seu nome de usu&aacute;rio e senha</strong></div></td>
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
          <td width="61" class="tahoma_12"><span class="stepactive">Usu&aacute;rio</span></td>
          <td width="175" class="body-text1"><div align="left">
            <input name="valorLogin" type="text" class="tahoma_12" style="width:150" size="30" maxlength="50">
          </div></td>
        </tr>
        <tr>
          <td class="link10">&nbsp;</td>
          <td class="stepinactive"> Senha</td>
          <td class="body-text1"><div align="left">
            <input name="valorClave" type="password" class="tahoma_12" style="width:150" size="30" maxlength="50">
          </div></td>
        </tr>
        <tr>
          <td class="link10">&nbsp;</td>
          <td class="tahoma_12"> Modo </td>
          <td class="text10"><div align="left">
            <select name="valorModo" class="tahoma_12" style="width:150">
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
          <td align="right" class="body-text1"><div align="left"><span class="verdana_red">
            <?=$msg?>
          </span></div></td>
        </tr>
        <tr>
          <td align="right" class="body-text1"><div align="center" class="index-titles"></div></td>
          <td align="right" class="body-text1">&nbsp;</td>
          <td align="right" class="body-text1"><div align="left"></div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td width="299"><img name="login_r3_c2" src="newImages/login_r3_c2.jpg" width="308" height="38" border="0" id="login_r3_c" alt="" /></td>
    </tr>
  </table>
<br>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
</html>
