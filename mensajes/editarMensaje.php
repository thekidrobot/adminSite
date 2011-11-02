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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE mensajes_usuario SET ID_USUARIO=%s, MENSAJE=%s WHERE ID_MENSAJE=%s",
                       GetSQLValueString($_POST['ID_USUARIO'], "int"),
                       GetSQLValueString($_POST['MENSAJE'], "text"),
                       GetSQLValueString($_POST['ID_MENSAJE'], "int"));

  mysql_select_db($database_cnxRamp, $cnxRamp);
  $Result1 = mysql_query($updateSQL, $cnxRamp) or die(mysql_error());

  $updateGoTo = "AdmMensajes.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsMensaje = "-1";
if (isset($_GET['msg'])) {
  $colname_rsMensaje = $_GET['msg'];
}
mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsMensaje = sprintf("SELECT * FROM mensajes_usuario WHERE ID_MENSAJE = %s", GetSQLValueString($colname_rsMensaje, "int"));
$rsMensaje = mysql_query($query_rsMensaje, $cnxRamp) or die(mysql_error());
$row_rsMensaje = mysql_fetch_assoc($rsMensaje);
$totalRows_rsMensaje = mysql_num_rows($rsMensaje);
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
	left:31px;
	top:82px;
	width:613px;
	height:259px;
	z-index:1;
}
-->
</style>
</head>

<body>
<div id="apDiv1">
  <form id="form1" name="form1" method="post" action="">
  </form>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">ID_USUARIO:</td>
        <td><input type="text" name="ID_USUARIO" value="<?php echo htmlentities($row_rsMensaje['ID_USUARIO'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">MENSAJE:</td>
        <td><input type="text" name="MENSAJE" value="<?php echo htmlentities($row_rsMensaje['MENSAJE'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Actualizar registro" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="ID_MENSAJE" value="<?php echo $row_rsMensaje['ID_MENSAJE']; ?>" />
  </form>
  <p>&nbsp;</p>
</div>
<table width="949" border="0" cellpadding="0">
  <tr>
    <th width="12" scope="col"><img src="../imagenes/flecha.jpg" alt="" width="12" height="26" /></th>
    <td width="931" class="borde_arriba_abajo" scope="col"><div align="left">&nbsp;&nbsp;<a href="listarArchivos.php">Ver Arquivos</a>&nbsp;&nbsp;  |&nbsp;&nbsp; <a href="addArchivo.php">Adicionar Videos</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a href="buscarArchivos.php">Buscar Videos</a></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsMensaje);
?>
