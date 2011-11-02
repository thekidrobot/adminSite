<?php require_once('../Connections/cnxRamp.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO mensajes_usuario (ID_USUARIO, MENSAJE) VALUES (%s, %s)",
                       GetSQLValueString($_POST['ID_USUARIO'], "int"),
                       GetSQLValueString($_POST['MENSAJE'], "text"));

  mysql_select_db($database_cnxRamp, $cnxRamp);
  $Result1 = mysql_query($insertSQL, $cnxRamp) or die(mysql_error());

  $insertGoTo = "../admusuarios.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
<!--
#apDiv1 {
	position:absolute;
	left:14px;
	top:93px;
	width:325px;
	height:206px;
	z-index:1;
}
-->
</style>
<link href="../css/stilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="apDiv1">
  <form id="form1" name="form1" method="post" action="">
  </form>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
    <table align="center" class="contform">
      <tr valign="baseline">
        <td colspan="2" align="right" nowrap="nowrap" class="TituloAzul"><span class="TilGrilla">Ingrese un mensaje a:<?php echo $_GET['nomUser']; ?></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><span class="Subtitulo">MENSAJE:</span></td>
        <td><input name="MENSAJE" type="text" class="textareas" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><input type="hidden" name="ID_USUARIO" value="<?php echo $_GET['codUser']; ?>" size="32" /></td>
        <td><input type="submit" class="botonfiltro" value="Insertar registro" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form2" />
  </form>
  <p>&nbsp;</p>
</div>
<table width="949" border="0" cellpadding="0">
  <tr>
    <th width="12" scope="col"><img src="../imagenes/flecha.jpg" alt="" width="12" height="26" /></th>
    <td width="931" class="borde_arriba_abajo" scope="col"><div align="left">&nbsp;&nbsp;Enviar Mensaje a Usuario<a href="buscarArchivos.php"></a></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>