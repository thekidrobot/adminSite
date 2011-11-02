<html>
<head>
<title>::::APConlinelearning::::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.bordes {
	border: 1px solid #CCCCCC;
}
.verdana {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	color: #000000;
}
.Estilo10 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo3 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	line-height: normal;
}
.Estilo5 {font-size: 10px}
.Estilo7 {font-size: 10px; font-weight: bold; }
.Estilo8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; line-height: normal; font-weight: bold; }
.Estilo9 {color: #FF0000}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- fwtable fwsrc="home.png" fwbase="home.jpg" fwstyle="Dreamweaver" fwdocid = "538921909" fwnested="0" -->
  
  <tr>
    <td colspan="8"><img src="imagenes/botar_banner_r1_c1.gif" alt="" name="botar_banner_r1_c1" width="840" height="80" border="0" usemap="#botar_banner_r1_c1Map" id="botar_banner_r1_c1" />
      <map name="botar_banner_r1_c1Map" id="botar_banner_r1_c1Map">
        <area shape="rect" coords="18,3,168,78" href="www.apc.com" target="_blank" />
      </map>
    </td>
  </tr>
  <tr>
    <td colspan="8" bgcolor="#F3F2F4"><img name="index_r2_c1" src="images/index_r2_c1.gif" width="840" height="227" border="0" id="index_r2_c1" alt="" /></td>
  </tr>
  <tr>
    <td colspan="8"><table width="811" border="0" align="left" cellspacing="0">
      <tr>
        <td colspan="2" rowspan="5" valign="top"><div align="right"><img src="images/SideBannerRegistro.jpg" alt="" width="225" height="422" /></div></td>
        <td colspan="3"><div align="right"><span class="Estilo3"> <a href="index.php" class="Estilo3">Regresar a inicio</a></span></div></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td width="11">&nbsp;</td>
        <td width="532"><span class="Estilo3">Su registro fue exitoso. Desde este momento puede acceder a nuestro sistema. <a href="index.php">Entrar</a></span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="381" colspan="2" valign="top">&nbsp;</td>
        <td width="19" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td width="10">&nbsp;</td>
        <td width="229" bgcolor="#CCCCCC">&nbsp;</td>
        <td colspan="3" bgcolor="#CCCCCC"><a href="index.php" class="Estilo3"></a></td>
      </tr>
      <tr>
        <td colspan="5">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>
  <?php require_once('Connections/cnx_local.php'); ?>
  <?php

$adition="From:Admin APConlinelearning";
    
if(mail($_POST['Correo'],"Registro de usuario APConlineLearning","Gracias por registrarse. Recuerde que para acceder a nuestro sistema usted puede digitar la siguiente direccion en su navegador preferido http://www.vzdc.com/apc/online \nSu usuario es: " . $_POST['Nombre'] . "\n" . "Su clave es: " . $_POST['Clave'],$adition))
{

/*	
	echo "<B>DATOS DEL E-MAIL ENVIADO<B><BR><BR>";
	echo "De = ".$_POST['from']."<br>";
	echo "Asunto = ".$_POST['Nombre']."<br>";
	echo "Mensaje = ".$_POST['Clave']."<br>";
	echo "Para = ".$_POST['Correo']."<br>";
*/

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$query_Recordset1 = sprintf("INSERT INTO usuarios2 (USU_LOGIN, USU_PASS , USU_MAIL, USU_NOMBRES, USU_APELLIDOS, USU_ACTIVADO ) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Clave'], "text"),
                       GetSQLValueString($_POST['Correo'], "text"),
					   GetSQLValueString($_POST['nombres'], "text"),
					   GetSQLValueString($_POST['apellidos'], "text"),
					   GetSQLValueString($_POST['activo'], "text"));
					   
mysql_select_db($database_cnx_local, $cnx_local);
$Recordset1 = mysql_query($query_Recordset1, $cnx_local) or die(mysql_error());	
}
else
{
	echo "<B>NO SE PUDO ENVIAR<B><BR><BR>";
}

?>
</p>
<p>&nbsp;</p>

</body>
</html>