<?php
session_start();
 require_once('../Connections/cnxRamp.php'); ?>
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

$colname_Recordset1 = "-1";
if (isset($_POST['nombre'])) {
  $colname_Recordset1 = $_POST['nombre'];
}
mysql_select_db($database_cnxRamp, $cnxRamp);
$query_Recordset1 = sprintf("SELECT usuarios.IdUsuario, usuarios.NombreCompleto FROM usuarios WHERE (((usuarios.NombreCompleto) Like %s)); ", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $cnxRamp) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

?><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/stilos.css" rel="stylesheet" type="text/css">
<link href="../galeria/css/galeria.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-color: #CCC;
}
-->
</style></head>
  
<table width="370" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" class="descripcion">&nbsp;</td>
    <tr>
      <td colspan="2" class="descripcion"><STRONG>Buscar por parte do nome do Usu&aacute;rios</STRONG></td>
    <tr>
      <td colspan="2"><p><br />
<label>
        <input name="nombre" type="text" class="descripcion" id="nombre" value="<?php echo $_POST['nombre']; ?>" />
            <input name="aceptar" type="button" class="descripcion" id="aceptar" onclick="buscaArchivo()" value="Buscar" />
          </label>
      </p></td>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td class="descripcion"><label>
        <input name="descargas" type="text" class="descripcion" id="descargas" value="50" size="5" />
      </label>      
  <td class="descripcion">discar o n&uacute;mero de acesso para o usu&aacute;rio </tr>
    <tr>
      <td colspan="2" class="descripcion">    
  </tr>
    <?php do { ?>
        
    <tr>
      <td width="8%" height="24" align="center" valign="middle" bgcolor="#CCCCCC" class="descripcion_borde_inferior"><span class="descripcion"><a href="#" class="descripcion" onclick="javascript:insertaItem(<?php echo $row_Recordset1['IdUsuario']; ?>)" style="color:#063" ><strong>&gt;&gt;</strong></a></span>&nbsp;&nbsp;</td>
      <td width="92%" bgcolor="#CCCCCC" class="descripcion_borde_inferior"><?php echo $row_Recordset1['NombreCompleto']; ?></td>
    </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
<tr>
    <td colspan="2">&nbsp;</td>
    </tr>
  </table>
<?php
mysql_free_result($Recordset1);
?>
