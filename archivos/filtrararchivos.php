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

$colname_Recordset1 = "-1";
if (isset($_POST['nombre'])) {
  $colname_Recordset1 = $_POST['nombre'];
}
mysql_select_db($database_cnxRamp, $cnxRamp);
$query_Recordset1 = sprintf("SELECT id_archivo, titulo FROM archivos WHERE titulo LIKE %s ORDER BY id_archivo ASC", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
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
  
<table width="330" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" class="descripcion"><strong>Buscar por parte do nome do arquivo</strong></td>
    <tr>
      <td colspan="2"><p><br />
<label>
        <input name="nombre" type="text" class="descripcion" id="nombre" value="<?php echo $_POST['nombreArchivo']; ?>" />
            <input name="aceptar" type="button" class="descripcion" id="aceptar" onclick="buscaArchivo()" value="Buscar" />
          </label>
      </p></td>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="descripcion"><label for="vDescargas"></label>
  <input name="vDescargas" type="hidden" class="descripcion" id="vDescargas" value="10" size="5" maxlength="3" />
      </tr>
    <tr>
      <td colspan="2" class="descripcion">    
  </tr>
    <?php do { ?>
        
    <tr>
      <td width="12%" height="24" valign="middle" class="descripcion_borde_inferior"><span class="descripcion">&nbsp;&nbsp; &nbsp;<a href="#" class="descripcion" onclick="javascript:insertaItem(<?php echo $row_Recordset1['id_archivo']; ?>,document.getElementById('vDescargas').value);" style="color:#060"><strong>&gt;&gt;</strong></a></span>&nbsp;</td>
      <td width="88%" bgcolor="#CCCCCC" class="descripcion_borde_inferior"><?php echo $row_Recordset1['titulo']; ?></td>
    </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
<tr>
    <td colspan="2">&nbsp;</td>
    </tr>
  </table>
<?php
mysql_free_result($Recordset1);
?>
