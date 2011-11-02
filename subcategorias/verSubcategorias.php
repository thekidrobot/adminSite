<?php require_once('../Connections/cnxRamp.php');


session_start();

//validar sesion
if($_SESSION["usuario"]=="")
 {
  ?>
  <script language="javascript">
  document.location="inicio.html";
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsSubgrupos = 10;
$pageNum_rsSubgrupos = 0;
if (isset($_POST['pageNum_rsSubgrupos'])) {
  $pageNum_rsSubgrupos = $_POST['pageNum_rsSubgrupos'];
}
$startRow_rsSubgrupos = $pageNum_rsSubgrupos * $maxRows_rsSubgrupos;

$colname_rsSubgrupos = "-1";
if (isset($_POST['grupo'])) {
  $colname_rsSubgrupos = $_POST['grupo'];
}
mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsSubgrupos = sprintf("SELECT grupos.* FROM grupos WHERE grupos.padre=%s ORDER BY grupos.grupos ASC", GetSQLValueString($colname_rsSubgrupos, "int"));
$query_limit_rsSubgrupos = sprintf("%s LIMIT %d, %d", $query_rsSubgrupos, $startRow_rsSubgrupos, $maxRows_rsSubgrupos);
$rsSubgrupos = mysql_query($query_limit_rsSubgrupos, $cnxRamp) or die(mysql_error());
$row_rsSubgrupos = mysql_fetch_assoc($rsSubgrupos);

if (isset($_POST['totalRows_rsSubgrupos'])) {
  $totalRows_rsSubgrupos = $_POST['totalRows_rsSubgrupos'];
} else {
  $all_rsSubgrupos = mysql_query($query_rsSubgrupos);
  $totalRows_rsSubgrupos = mysql_num_rows($all_rsSubgrupos);
}
$totalPages_rsSubgrupos = ceil($totalRows_rsSubgrupos/$maxRows_rsSubgrupos)-1;

$queryString_rsSubgrupos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsSubgrupos") == false && 
        stristr($param, "totalRows_rsSubgrupos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsSubgrupos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsSubgrupos = sprintf("&totalRows_rsSubgrupos=%d%s", $totalRows_rsSubgrupos, $queryString_rsSubgrupos);

$i=$startRow_rsSubgrupos;
?>
<div> 
<div>
<table width="823" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="18">&nbsp;</td>
    <td width="352">Nombre</td>
    <td width="42">Estado</td>
    <td width="126">&nbsp;</td>
    <td width="279">&nbsp;</td>
  </tr>
  <?php 
  $i=1;
  do { ?>
    <tr class="celda">
      <td><?php echo $i; ?></td>
      <td>
        <label>
          <input name="nombre<?php echo $i; ?>" type="text" id="nombre<?php echo $i; ?>" value="<?php echo $row_rsSubgrupos['grupos']; ?>" size="50" maxlength="100">
          <input name="IdGrupo<?php echo $i; ?>" type="hidden" id="IdGrupo<?php echo $i; ?>" value="<?php echo $row_rsSubgrupos['idGrupos']; ?>">
        </label></td>
      <td><label>
        <input name="Estado" type="checkbox" id="Estado<?php echo $i; ?>" value="1"  <?php if($row_rsSubgrupos['activo']==1){echo "checked";}?>>
      </label></td>
      <td><a href="#" onClick="actualizar(<?php echo $i; ?>)">guardar&nbsp;&nbsp;&nbsp;</a>|&nbsp;&nbsp; <a href="#" onclick="eliminar(<?php echo $i; ?>)">eliminar</a></td>
      <td><div id="estado<?php echo $i; $i++;?>">&nbsp;</div></td>
    </tr>
    <?php } while ($row_rsSubgrupos = mysql_fetch_assoc($rsSubgrupos)); ?>
    <tr class="celda">
      <td>&nbsp;</td>
      <td><span class="body-text1">
        <input type="text" name="inputString" id="inputString" onBlur="fill();" onKeyUp="lookup(this.value);" value="" size="50" maxlength="100" />
        <input type="hidden" name="id_seleccionado" id="id_seleccionado" value="" />
      </span></td>
      <td><input type="checkbox" name="nuevoEstado" id="nuevoEstado"></td>
      <td><a href="#" onClick="agregar('pageNum_rsSubgrupos=<?php echo $pageNum_rsSubgrupos ; ?>');">Guardar Nuevo</a></td>
      <td><div id="estadoNuevo">&nbsp;</div></td>
    </tr>
    <tr class="celda">
      <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;
          <table border="0">
            <tr>
              <td><?php if ($pageNum_rsSubgrupos > 0) { // Show if not first page ?>
                  <a href="#" onClick="paginar('<?php printf("%spageNum_rsSubgrupos=%d%s", "", 0, $queryString_rsSubgrupos); ?>')"><img src="First.gif"></a>
                  <?php } // Show if not first page ?></td>
              <td><?php if ($pageNum_rsSubgrupos > 0) { // Show if not first page ?>
                  <a href="#" onClick="paginar('<?php printf("%spageNum_rsSubgrupos=%d%s",  "", max(0, $pageNum_rsSubgrupos - 1), $queryString_rsSubgrupos); ?>')"><img src="Previous.gif"></a>
                  <?php } // Show if not first page ?></td>
              <td><?php if ($pageNum_rsSubgrupos < $totalPages_rsSubgrupos) { // Show if not last page ?>
                  <a href="#" onClick="paginar('<?php printf("%spageNum_rsSubgrupos=%d%s",  "", min($totalPages_rsSubgrupos, $pageNum_rsSubgrupos + 1), $queryString_rsSubgrupos); ?>')"><img src="Next.gif"></a>
                  <?php } // Show if not last page ?></td>
              <td><?php if ($pageNum_rsSubgrupos < $totalPages_rsSubgrupos) { // Show if not last page ?>
                  <a href="#" onClick="paginar('<?php printf("%spageNum_rsSubgrupos=%d%s",  "", $totalPages_rsSubgrupos, $queryString_rsSubgrupos); ?>')"><img src="Last.gif"></a>
                  <?php } // Show if not last page ?></td>
            </tr>
        </table></td>
      </tr>
</table>
</div>
</div>
<div class="suggestionsBox" id="suggestions" style="display: none;">
    <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
    <div class="suggestionList" id="autoSuggestionsList">
        &nbsp;
    </div>
</div>
<?php
mysql_free_result($rsSubgrupos);
?>