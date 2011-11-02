<?php require_once('../Connections/cnxRamp.php'); 
session_start();
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

/*$grupo_rsArchVsGrupo = "-1";
if (isset($_POST['grupo'])) {
  $grupo_rsArchVsGrupo = $_POST['grupo'];
}

if (isset($_GET['grupo'])) {
  $grupo_rsArchVsGrupo = $_GET['grupo'];
}*/

if (!isset($grupo_rsArchVsGrupo)){
	$grupo_rsArchVsGrupo = $_SESSION['sesNgrupo'];
}



mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsArchVsGrupo = "SELECT usuarios.NombreCompleto, grupos_usuario.IdGruposUsuario, grupos_usuario.IdUsuario, grupos_usuario.IdGrupos, grupos_usuario.grupoHijo, grupos.grupos FROM (usuarios INNER JOIN grupos_usuario ON usuarios.IdUsuario = grupos_usuario.IdUsuario) INNER JOIN grupos ON grupos_usuario.IdGrupos = grupos.idGrupos WHERE (((grupos_usuario.tipoHerencia) Is Null) AND ((grupos.grupos) = '" . $grupo_rsArchVsGrupo . "'))";
$rsArchVsGrupo = mysql_query($query_rsArchVsGrupo, $cnxRamp) or die(mysql_error());
$row_rsArchVsGrupo = mysql_fetch_assoc($rsArchVsGrupo);
$totalRows_rsArchVsGrupo = mysql_num_rows($rsArchVsGrupo);$grupo_rsArchVsGrupo = "-1";

//echo $query_rsArchVsGrupo ;

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
  <table width="340" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="3" class="descripcion">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" class="descripcion"><strong>Usu&aacute;rios que pertencem a esta categoria</strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr class="encabezado">
      <td width="8%" class="encabezado">&nbsp;</td>
      <td class="encabezado">Nome do Usu&aacute;rio </td>
      <td class="encabezado">Acesso</td>
    </tr>
    <?php do { $idarch = $row_rsArchVsGrupo['IdGrupos']?>
      <tr class="linea1">
        <td height="23" align="center" bgcolor="#CCCCCC" class="descripcion_borde_inferior"><a href="#" class="descripcion_borde_inferior" onClick="javascript:borraItem(<?php echo $row_rsArchVsGrupo['IdUsuario']; ?>,<?php echo $row_rsArchVsGrupo['IdGrupos']; ?>,<?php echo $row_rsArchVsGrupo['grupoHijo']; ?>)"><img src="../imagenes/delete.gif" alt="d" width="13" height="14" border="0" class="descripcion_borde_inferior"></a></td>
        <td width="78%" bgcolor="#CCCCCC" class="descripcion_borde_inferior"><?php echo "" .$row_rsArchVsGrupo['NombreCompleto']; ?></td>
        <td width="14%" align="center" bgcolor="#CCCCCC" class="descripcion_borde_inferior"><a href="#" class="descripcion_borde_inferior" onclick="javascript:administraDescarga('<?php echo $row_rsArchVsGrupo['NombreCompleto']; ?>',<?php echo $row_rsArchVsGrupo['IdGrupos']; ?>)">+</a></td>
      </tr>
      <?php } while ($row_rsArchVsGrupo = mysql_fetch_assoc($rsArchVsGrupo)); ?>
    <tr>
      <td><input name="codGrupo" id="codGrupo" type="hidden" value="<?php echo $idarch; ?>" /></td>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</div>

<?php
mysql_free_result($rsArchVsGrupo);
?>
