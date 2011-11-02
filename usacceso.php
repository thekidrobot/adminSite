<?php require_once('Connections/cnxRamp.php'); 
//validar sesion
session_start();

if($_SESSION["usuario"]=="")
 {
  ?>
  <script language="javascript">
  document.location="inicio.html";
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
                       GetSQLValueString($_POST['NombreCompleto'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['empresa'], "text"),
                       GetSQLValueString($_POST['cargo'], "text"),
                       GetSQLValueString($_POST['pais'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['IdUsuario'], "int"));

  mysql_select_db($database_cnxRamp, $cnxRamp);
  $Result1 = mysql_query($updateSQL, $cnxRamp) or die(mysql_error());

  $updateGoTo = "usacceso.php";
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
<title>:: CUESTIONARIO ::</title>
<link rel="stylesheet" href="INDEX.CSS">
<script language="javascript" src="js.js">
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style>

</head>
<body leftmargin="0" topmargin="0" background="" >
<table width="840" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- fwtable fwsrc="APC-Catalogo_VZ.png" fwbase="botar_banner.gif" fwstyle="Dreamweaver" fwdocid = "2037490143" fwnested="0" -->
  <tr>
    <td><img src="spacer.gif" width="30" height="1" border="0" alt="" /></td>
    <td><img src="spacer.gif" width="254" height="1" border="0" alt="" /></td>
    <td><img src="spacer.gif" width="556" height="1" border="0" alt="" /></td>
    <td><img src="spacer.gif" width="1" height="1" border="0" alt="" /></td>
  </tr>
  <tr>
    <td colspan="3"><img src="imagenes/botar_banner_r1_c1.gif" alt="" name="botar_banner_r1_c1" width="840" height="80" border="0" usemap="#botar_banner_r1_c1Map" id="botar_banner_r1_c1" /></td>
    <td><img src="spacer.gif" width="1" height="80" border="0" alt="" /></td>
  </tr>
  <tr>
    <td><img name="botar_banner_r2_c1" src="imagenes/botar_banner_r2_c1.gif" width="30" height="29" border="0" id="botar_banner_r2_c1" alt="" /></td>
    <td background="imagenes/botar_banner_r2_c2.gif" class="fuente_blanca"><div align="left">Bienvenido:
      <?=$_SESSION['NombreCompleto']; ?>
    </div></td>
    <link href="galeria/css/galeria.css" rel="stylesheet" type="text/css">
    
    <td><img src="imagenes/botar_banner_r2_c3.gif" alt="" name="botar_banner_r2_c3" width="556" height="29" border="0" usemap="#botar_banner_r2_c3Map" id="botar_banner_r2_c3" /></td>
    <td><img src="spacer.gif" width="1" height="29" border="0" alt="" /></td>
  </tr>
</table>
<map name="botar_banner_r2_c3Map" id="botar_banner_r2_c3Map">
  <area shape="rect" coords="285,8,345,24" href="usacceso.php" />
  <area shape="rect" coords="363,8,416,22" href="ushistorial.php" />
  <area shape="rect" coords="434,9,477,24" href="#" />
  <area shape="rect" coords="488,7,529,22" href="index.php" />
</map>
<map name="botar_banner_r1_c1Map" id="botar_banner_r1_c1Map">
  <area shape="rect" coords="18,3,168,78" href="www.apc.com" target="_blank" />
</map>
<p>&nbsp;</p>
<table width="70%" height="100%" align="center" cellpadding="0" cellspacing="1" class="borde_alrededor">
  
  <tr>
    <td class="titulo_curso" background="imagenes/fondoPAGINA.jpg"  valign="top" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td class="titulo_curso" background="imagenes/fondoPAGINA.jpg"  valign="top" align="left">Acceso Usuario</td>
  </tr>
  <tr>
    <td class="text10"  valign="top" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td class="text10"  valign="top" align="left">Cambie los datos de registro de usuario</td>
  </tr>
  <tr>
    <td class="body-text1"  valign="top" align="left"><form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table align="center">
          <tr valign="baseline">
            <td align="right" nowrap class="letra_gris">Password:</td>
            <td><input type="password" name="Password" value="<?php echo md5($row_rsUsuario['Password']); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="letra_gris">NombreCompleto:</td>
            <td><input type="text" name="NombreCompleto" value="<?php echo htmlentities($row_rsUsuario['NombreCompleto'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="letra_gris">Mail:</td>
            <td><input type="text" name="mail" value="<?php echo htmlentities($row_rsUsuario['mail'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="letra_gris">Empresa:</td>
            <td><input type="text" name="empresa" value="<?php echo htmlentities($row_rsUsuario['empresa'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="letra_gris">Cargo:</td>
            <td><input type="text" name="cargo" value="<?php echo htmlentities($row_rsUsuario['cargo'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="letra_gris">Pais:</td>
            <td><input type="text" name="pais" value="<?php echo htmlentities($row_rsUsuario['pais'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap class="letra_gris">Telefono:</td>
            <td><input type="text" name="telefono" value="<?php echo htmlentities($row_rsUsuario['telefono'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" class="verde_out_line" value="Actualizar"></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1">
        <input type="hidden" name="IdUsuario" value="<?php echo $row_rsUsuario['IdUsuario']; ?>">
      </form>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td  height="10"><img src="imagenes/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td  height="10">&nbsp;</td>
  </tr>
  <tr>
    <td  height="10">&nbsp;</td>
  </tr>
  <tr>
    <td  height="10">&nbsp;</td>
  </tr>
  <tr>
    <td  height="10">&nbsp;</td>
  </tr>
  <tr>
    <td  height="10">&nbsp;</td>
  </tr>
  <tr>
    <td  height="10">&nbsp;</td>
  </tr>
  <tr>
    <td  height="10">&nbsp;</td>
  </tr>
  <tr>
    <td  height="10">&nbsp;</td>
  </tr>
  <tr>
    <td  height="10">&nbsp;</td>
  </tr>
  <tr>
    <td  height="10">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsUsuario);
?>
