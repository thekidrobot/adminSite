<?php require_once('../Connections/cnxRamp.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
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

$currentPage = $_SERVER["PHP_SELF"];
$whereCondicion="";
$micondicion="";
$micondicion2="";

if($_POST['nombreArchivo']!= "" || $_GET['nombreArchivo']!='')
	{
		if($_POST['nombreArchivo']!="")
			$micondicion2=$_POST['nombreArchivo'];
		elseif($_GET['nombreArchivo']!="")
			$micondicion2=$_GET['nombreArchivo'];
		
		if($whereCondicion != "")
			$whereCondicion = " and ";
		$whereCondicion .= " archivos.nombreArchivo LIKE '%" . $micondicion2 . "%' ";
	}
if($_POST['tituloArchivo']!="" || $_GET['tituloArchivo']!='') 
	{
		if($_POST['tituloArchivo']!="")
			$micondicion=$_POST['tituloArchivo'];
		elseif($_GET['tituloArchivo']!="")
			$micondicion=$_GET['tituloArchivo'];
			
		if($whereCondicion != "")
			$whereCondicion .= " and ";
		$whereCondicion .= " archivos.titulo LIKE '%" . $micondicion . "%' ";
	}
if($whereCondicion != "")		  
	$whereCondicion = " where " . $whereCondicion;
	

$maxRows_rsConsulta1 = 10;
$pageNum_rsConsulta1 = 0;
if (isset($_GET['pageNum_rsConsulta1'])) {
  $pageNum_rsConsulta1 = $_GET['pageNum_rsConsulta1'];
}
$startRow_rsConsulta1 = $pageNum_rsConsulta1 * $maxRows_rsConsulta1;

mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsConsulta1 = "SELECT * FROM archivos "  . $whereCondicion;
$query_limit_rsConsulta1 = sprintf("%s LIMIT %d, %d", $query_rsConsulta1, $startRow_rsConsulta1, $maxRows_rsConsulta1);
//echo $query_limit_rsConsulta1 . "</br>";
$rsConsulta1 = mysql_query($query_limit_rsConsulta1, $cnxRamp) or die(mysql_error());
$row_rsConsulta1 = mysql_fetch_assoc($rsConsulta1);

if (isset($_GET['totalRows_rsConsulta1'])) {
  $totalRows_rsConsulta1 = $_GET['totalRows_rsConsulta1'];
} else {
  $all_rsConsulta1 = mysql_query($query_rsConsulta1);
  $totalRows_rsConsulta1 = mysql_num_rows($all_rsConsulta1);
}
$totalPages_rsConsulta1 = ceil($totalRows_rsConsulta1/$maxRows_rsConsulta1)-1;

$queryString_rsConsulta1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsConsulta1") == false && 
        stristr($param, "totalRows_rsConsulta1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsConsulta1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsConsulta1 = sprintf("&totalRows_rsConsulta1=%d%s", $totalRows_rsConsulta1, $queryString_rsConsulta1);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>:: CUESTIONARIO ::</title>
<script language="JavaScript" src="js.js" type="text/javascript">
</script>
<link href="../INDEX.CSS" rel="stylesheet" type="text/css">
<link href="../css/stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../galeria/css/galeria.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-color: #CCC;
}
-->
</style></head>
<body leftmargin="0" topmargin="0" background="
" >
<table width="725" border="0" align="left" cellpadding="0" cellspacing="0">
  
  <tr>
    <td height="21" colspan="2"><img src="../newImages/titulo_searchfile.jpg" width="768" height="52"></td>
  </tr>
  <tr>
    <td width="900" height="97" colspan="2"><table width="538" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <th scope="col">&nbsp;</th>
      </tr>
      <tr>
        <th scope="col"><form name="form1" method="post" action="buscarArchivos.php">
          <table width="540" border="0" align="left" cellpadding="0" cellspacing="0" class="borde_alrededor">
            <tr>
              <td height="27" colspan="2" valign="middle" class="encabezado"><div align="left">&nbsp;Selecione um crit&eacute;rio de busca</div></td>
              </tr>
            <tr>
              <td height="19" colspan="2" class="descripcion">&nbsp;</td>
              </tr>
            <tr>
              <td width="121" height="27" align="right" class="descripcion"><div align="right">Buscar nome do arquivo</div></td>
              <td width="384"><label>
                <input name="nombreArchivo" type="text" class="descripcion" id="nombreArchivo" value="<?php echo $micondicion2; ?>" size="50">
                </label></td>
              </tr>
            <tr>
              <td height="29" align="left" class="descripcion"><div align="right">Buscar por T&iacute;tulo</div></td>
              <td><label>
                <input name="tituloArchivo" type="text" class="descripcion" id="tituloArchivo" value="<?php echo $micondicion; ?>" size="50">
                </label></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div align="left">
                <input name="buscar" type="submit" class="encabezado" id="buscar" value="Buscar">
                </div></td>
              </tr>
            <tr>
              <td><label></label></td>
              <td>&nbsp;</td>
              </tr>
            </table>
          </form></th>
        </tr>
      <tr>
        <th height="33" scope="col"><div class="Cuerpo2">
          <div align="center"></div>
          </div></th>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <table width="538" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="22%" valign="middle" class="encabezado">Editar </td>
          <td width="53%" valign="middle" class="encabezado">T&iacute;tulo-Nome</td>
          <td width="25%" valign="middle" class="encabezado">Professor</td>
        </tr>
        <?php do { ?>
          <tr>
            <td height="26" bgcolor="#CCCCCC" class="descripcion_borde_inferior"><div align="center"><a href="edicion.php?id_archivo=<?php echo $row_rsConsulta1['id_archivo']; ?>"><?php echo $row_rsConsulta1['id_archivo']; ?></a></div>
              <div align="center"></div></td>
            <td bgcolor="#CCCCCC" class="descripcion_borde_inferior"><div align="left"><strong><?php echo $row_rsConsulta1['titulo']; ?></strong></div></td>
            <td bgcolor="#CCCCCC" class="descripcion_borde_inferior"><div align="left"><?php echo $row_rsConsulta1['speaker']; ?></div></td>
            </tr>
          <?php } while ($row_rsConsulta1 = mysql_fetch_assoc($rsConsulta1)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
        </table>
    </div></td>
  </tr>
  <tr>
    <td height="21" colspan="2" align="center" class="fondo"><table border="0" align="center">
      <tr>
        <td><?php if ($pageNum_rsConsulta1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsConsulta1=%d%s", $currentPage, 0, $queryString_rsConsulta1 . '&tituloArchivo=' . $micondicion . '&nombreArchivo=' . $micondicion2); ?>"><img src="../imagenes/First.gif" border="0"></a>
          <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_rsConsulta1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsConsulta1=%d%s", $currentPage, max(0, $pageNum_rsConsulta1 - 1), $queryString_rsConsulta1 . '&tituloArchivo=' . $micondicion . '&nombreArchivo=' . $micondicion2); ?>"><img src="../imagenes/Previous.gif" border="0"></a>
          <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_rsConsulta1 < $totalPages_rsConsulta1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsConsulta1=%d%s", $currentPage, min($totalPages_rsConsulta1, $pageNum_rsConsulta1 + 1), $queryString_rsConsulta1 . '&tituloArchivo=' . $micondicion . '&nombreArchivo=' . $micondicion2); ?>"><img src="../imagenes/Next.gif" border="0"></a>
          <?php } // Show if not last page ?></td>
        <td><?php if ($pageNum_rsConsulta1 < $totalPages_rsConsulta1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsConsulta1=%d%s", $currentPage, $totalPages_rsConsulta1, $queryString_rsConsulta1 . '&tituloArchivo=' . $micondicion . '&nombreArchivo=' . $micondicion2); ?>"><img src="../imagenes/Last.gif" border="0"></a>
          <?php } // Show if not last page ?></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rsConsulta1);
?>
