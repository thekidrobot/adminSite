<?php require_once('../Connections/cnxRamp.php'); ?>
<?php require_once('../Connections/cnxRamp.php'); 
if($_SESSION["usuario"]=="")
 {
  ?>
<script language="javascript">
  document.location="../index.php";
  </script>
  <?
 }
 
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

$grupo_rsArchVsGrupo = "-1";
if (isset($_POST['grupo'])) {
  $grupo_rsArchVsGrupo = $_POST['grupo'];
}
mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsArchVsGrupo = sprintf("SELECT archivos.titulo, archivos_grupo.id_interno, archivos_grupo.id_archivo, archivos_grupo.id_grupo, archivos.TIPO_TRANSMISION, archivos.FECHA_HORA_TRANSMISION, archivos.estado FROM archivos INNER JOIN archivos_grupo ON archivos.id_archivo = archivos_grupo.id_archivo WHERE (((archivos_grupo.id_grupo)=%s))", GetSQLValueString($grupo_rsArchVsGrupo, "int"));
$rsArchVsGrupo = mysql_query($query_rsArchVsGrupo, $cnxRamp) or die(mysql_error());
$row_rsArchVsGrupo = mysql_fetch_assoc($rsArchVsGrupo);
$totalRows_rsArchVsGrupo = mysql_num_rows($rsArchVsGrupo);

?><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../galeria/css/galeria.css" rel="stylesheet" type="text/css">
<link href="../css/stilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-color: #CCC;
}
-->
</style></head>

<div id="archivosgrupo">
  <table width="330" border="0" align="left" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" class="descripcion">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" class="descripcion"><b>V&iacute;deos que pertencem a este grupo</b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="encabezado">
      <td width="8%" height="20">&nbsp;</td>
      <td width="79%">V&iacute;deos</td>
      <td width="13%">Estado</td>
    </tr>
    <?php do { ?>
      <tr class="linea1">
        <td height="23" align="center" bgcolor="#CCCCCC" class="descripcion_borde_inferior"><a href="#" onClick="javascript:borraItem(<?php echo $row_rsArchVsGrupo['id_interno']; ?>,<?php echo $row_rsArchVsGrupo['id_archivo']; ?>)"><img src="../imagenes/delete.gif" alt="d" width="13" height="14" border="0"></a></td>
        <td bgcolor="#CCCCCC" class="descripcion_borde_inferior"><?php echo "" .$row_rsArchVsGrupo['titulo']; ?></td>
        <td bgcolor="#CCCCCC" class="descripcion_borde_inferior"><label>
          <input <?php if (!(strcmp($row_rsArchVsGrupo['estado'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="estado" id="estado" disabled="disabled" />
        </label></td>
      </tr>
      <?php } while ($row_rsArchVsGrupo = mysql_fetch_assoc($rsArchVsGrupo)); ?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<p><br>
  <br>
</p>
<p><br>
  <br>
  <?php
mysql_free_result($rsArchVsGrupo);
?>
</p>