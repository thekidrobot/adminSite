<?php require_once('Connections/cnxRamp.php'); 
//validar sesion
session_start();

if($_SESSION["usuario"]=="")
 {
  ?>
  <script language="javascript">
  document.location="index.php";
  </script>
  <?php
 }

///objetos

?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE usuarios SET Password=%s, NombreCompleto=%s, mail=%s, empresa=%s, cargo=%s, pais=%s, telefono=%s WHERE IdUsuario=%s",
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['Usuario'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['empresa'], "text"),
                       GetSQLValueString($_POST['cargo'], "text"),
                       GetSQLValueString($_POST['pais'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['IdUsuario'], "int"));

  mysql_select_db($database_cnxRamp, $cnxRamp);
  $Result1 = mysql_query($updateSQL, $cnxRamp) or die(mysql_error());

  $updateGoTo = "actualizacion.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsUsuario = "-1";
if (isset($_SESSION['usuario'])) {
  $colname_rsUsuario = $_SESSION['usuario'];
}
mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsUsuario = sprintf("SELECT * FROM usuarios WHERE Usuario = %s", GetSQLValueString($colname_rsUsuario, "text"));
$rsUsuario = mysql_query($query_rsUsuario, $cnxRamp) or die(mysql_error());
$row_rsUsuario = mysql_fetch_assoc($rsUsuario);
$totalRows_rsUsuario = mysql_num_rows($rsUsuario);
include("conexion.php");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Apclearningnetwork.com</title>
<link rel="stylesheet" href="INDEX.CSS">
<script language="javascript" src="js.js">
</script>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style>

<link href="galeria/css/galeria2.css" rel="stylesheet" type="text/css">
<link href="galeria/css/galeria2.css" rel="stylesheet" type="text/css">
<link href="galeria/css/galeria.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" background="" ><?php require_once("banner.php") ?>
<table width="909" border="0" align="center" cellpadding="0" cellspacing="0" class="borde_inferior">
  <tr>
    <th width="329" scope="col">&nbsp;</th>
    <th colspan="2" scope="col"><div align="left"></div></th>
  </tr>
  <tr>
    <td rowspan="15"><img src="imagenes/filme.jpg" width="312" height="226"></td>
    <td width="15" bgcolor="#FFFFFF" class="tahomaLight">&nbsp;</td>
    <td width="565" bgcolor="#FFFFFF" class="tahomaLight">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"><p class="tahoma_grande">Para suporte t&eacute;cnico entre em contato via e-mail streaming@lfg.com.br <br>
      ou via telefone (11) 2121-4803<BR>
    </p>
    </td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <th colspan="3" align="right" valign="top" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td height="21" colspan="3" align="right" valign="middle" bgcolor="#EBE9ED" scope="col"><div align="center" class="tahomaCopia">&copy; Copyright 2009 LFG. all rights reserved. Powered   by <a href="http://www.ramprm.com" target="_blank">RAMP, LLC</a></div></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsUsuario);
?>
