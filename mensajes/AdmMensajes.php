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


$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsMensajesTexto = 10;
$pageNum_rsMensajesTexto = 0;
if (isset($_GET['pageNum_rsMensajesTexto'])) {
  $pageNum_rsMensajesTexto = $_GET['pageNum_rsMensajesTexto'];
}
$startRow_rsMensajesTexto = $pageNum_rsMensajesTexto * $maxRows_rsMensajesTexto;

$sql='SELECT mensajes_usuario.ID_MENSAJE, mensajes_usuario.ID_USUARIO, mensajes_usuario.MENSAJE, mensajes_usuario.FECHA_CREACION, mensajes_usuario.FECHA_LECTURA, usuarios.NombreCompleto
FROM mensajes_usuario INNER JOIN usuarios ON mensajes_usuario.ID_USUARIO = usuarios.IdUsuario';

$colname_rsMensajesTexto = "-1";
if (isset($_POST['texto'])) {
  $colname_rsMensajesTexto = $_POST['texto'];
  $donde = "WHERE mensajes_usuario.MENSAJE Like '%" . $colname_rsMensajesTexto . "%'";
}

$colname_rsMensajeusuario = "-1";
if (isset($_POST['usuario'])) {
  $colname_rsMensajeusuario = $_POST['usuario'];
  $donde = "WHERE usuarios.NombreCompleto Like '%" . $colname_rsMensajeusuario . "%'";
}

mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsMensajesTexto = $sql . " " . $donde;
$query_limit_rsMensajesTexto = sprintf("%s LIMIT %d, %d", $query_rsMensajesTexto, $startRow_rsMensajesTexto, $maxRows_rsMensajesTexto);
$rsMensajesTexto = mysql_query($query_limit_rsMensajesTexto, $cnxRamp) or die(mysql_error());
$row_rsMensajesTexto = mysql_fetch_assoc($rsMensajesTexto);

//echo $query_limit_rsMensajesTexto;

if (isset($_GET['totalRows_rsMensajesTexto'])) {
  $totalRows_rsMensajesTexto = $_GET['totalRows_rsMensajesTexto'];
} else {
  $all_rsMensajesTexto = mysql_query($query_rsMensajesTexto);
  $totalRows_rsMensajesTexto = mysql_num_rows($all_rsMensajesTexto);
}
$totalPages_rsMensajesTexto = ceil($totalRows_rsMensajesTexto/$maxRows_rsMensajesTexto)-1;



$queryString_rsMensajesTexto = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsMensajesTexto") == false && 
        stristr($param, "totalRows_rsMensajesTexto") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsMensajesTexto = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsMensajesTexto = sprintf("&totalRows_rsMensajesTexto=%d%s", $totalRows_rsMensajesTexto, $queryString_rsMensajesTexto);
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
	left:9px;
	top:65px;
	width:298px;
	height:83px;
	z-index:1;
}
#apDiv2 {
	position:absolute;
	left:317px;
	top:65px;
	width:298px;
	height:87px;
	z-index:2;
}
#apDiv3 {
	position:absolute;
	left:10px;
	top:172px;
	width:693px;
	height:201px;
	z-index:3;
}
-->
</style>
<link href="../css/stilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
#apDiv4 {
	position:absolute;
	left:600px;
	top:65px;
	width:359px;
	height:103px;
	z-index:4;
}
-->
</style>
</head>

<body>
<div id="apDiv1">
  <form id="form1" name="form1" method="post" action="">
    <table width="100%" border="0" class="contform">
      <tr>
        <td colspan="3" class="TituloAzul">Buscar por usuario</td>
      </tr>
      <tr>
        <td width="46%" class="Subtitulo">ingrese el Usuario</td>
        <td width="3%">&nbsp;</td>
        <td width="51%"><label>
          <input name="usuario" type="text" class="textareas" id="usuario" />
        </label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><label>
          <input name="button" type="submit" class="botonfiltro" id="button" value="Enviar" />
        </label></td>
      </tr>
    </table>
  </form>
</div>
<div id="apDiv2">
  <form id="form2" name="form2" method="post" action="">
    <table width="100%" border="0" class="contform">
      <tr>
        <td colspan="3" class="TituloAzul">Buscar por parte del mensaje</td>
      </tr>
      <tr>
        <td width="38%" class="Subtitulo">Ingrese el texto</td>
        <td width="6%">&nbsp;</td>
        <td width="56%"><label>
          <input name="texto" type="text" class="textareas" id="texto" />
        </label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><label>
          <input name="button2" type="submit" class="botonfiltro" id="button2" value="Enviar" />
        </label></td>
      </tr>
    </table>
  </form>
</div>
<div id="apDiv3">
  <table width="100%" border="0" cellpadding="0" cellspacing="1">
    <tr class="TituloAzul">
      <td width="5%">id</td>
      <td width="25%">Destinatario</td>
      <td width="33%">Mensaje</td>
      <td width="18%">Fecha Creacion</td>
      <td width="19%">Fecha Lectura</td>
    </tr>
    <?php do { ?>
      <tr class="linea1">
        <td><a href="AdmMensajes.php?msg=<?php echo "" . $row_rsMensajesTexto['ID_MENSAJE']; ?>"><?php echo "" . $row_rsMensajesTexto['ID_MENSAJE']; ?></a></td>
        <td><?php echo "" . $row_rsMensajesTexto['NombreCompleto']; ?></td>
        <td><?php echo "" . substr($row_rsMensajesTexto['MENSAJE'],1,50) . '...'; ?></td>
        <td><?php echo "" . $row_rsMensajesTexto['FECHA_CREACION']; ?></td>
        <td><?php echo "" . $row_rsMensajesTexto['FECHA_LECTURA']; ?></td>
      </tr>
      <?php } while ($row_rsMensajesTexto = mysql_fetch_assoc($rsMensajesTexto)); ?>
<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;
        <table border="0">
          <tr>
            <td><?php if ($pageNum_rsMensajesTexto > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_rsMensajesTexto=%d%s", $currentPage, 0, $queryString_rsMensajesTexto); ?>"><img src="First.gif" /></a>
                <?php } // Show if not first page ?></td>
            <td><?php if ($pageNum_rsMensajesTexto > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_rsMensajesTexto=%d%s", $currentPage, max(0, $pageNum_rsMensajesTexto - 1), $queryString_rsMensajesTexto); ?>"><img src="Previous.gif" /></a>
                <?php } // Show if not first page ?></td>
            <td><?php if ($pageNum_rsMensajesTexto < $totalPages_rsMensajesTexto) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_rsMensajesTexto=%d%s", $currentPage, min($totalPages_rsMensajesTexto, $pageNum_rsMensajesTexto + 1), $queryString_rsMensajesTexto); ?>"><img src="Next.gif" /></a>
                <?php } // Show if not last page ?></td>
            <td><?php if ($pageNum_rsMensajesTexto < $totalPages_rsMensajesTexto) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_rsMensajesTexto=%d%s", $currentPage, $totalPages_rsMensajesTexto, $queryString_rsMensajesTexto); ?>"><img src="Last.gif" /></a>
                <?php } // Show if not last page ?></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
<div id="apDiv4">
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
    <table align="center" class="contform">
      <tr valign="baseline">
        <td colspan="2" align="right" nowrap="nowrap" class="TituloAzul">Actualizar mensaje</td>
      </tr>
      <tr valign="baseline">
        <td align="right" nowrap="nowrap" class="Subtitulo">MENSAJE:</td>
        <td><input name="MENSAJE" type="text" class="textareas" value="<?php echo htmlentities($row_rsMensaje['MENSAJE'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><input type="hidden" name="ID_USUARIO" value="<?php echo htmlentities($row_rsMensaje['ID_USUARIO'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        <td><input type="submit" class="botonfiltro" value="Actualizar registro" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="ID_MENSAJE" value="<?php echo $row_rsMensaje['ID_MENSAJE']; ?>" />
  </form>
</div>
<table width="949" border="0" cellpadding="0">
  <tr>
    <th width="12" scope="col"><img src="../imagenes/flecha.jpg" alt="" width="12" height="26"></th>
    <td width="931" class="borde_arriba_abajo" scope="col"><div align="left">&nbsp;&nbsp;<a href="AdmMensajes.php">Mensajes usuario</a>&nbsp; |&nbsp;&nbsp;<a href="AdmMensajeGrupo">mensajes Grupales</a></div></td>
  </tr>
</table>
<br />
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsMensajesTexto);

?>
