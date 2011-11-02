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

$maxRows_rsGrupos = 20;
$pageNum_rsGrupos = 0;
if (isset($_GET['pageNum_rsGrupos'])) {
  $pageNum_rsGrupos = $_GET['pageNum_rsGrupos'];
}
$startRow_rsGrupos = $pageNum_rsGrupos * $maxRows_rsGrupos;

$colname_rsGrupos = "-1";
if (isset($_POST['queryString'])) {
  $colname_rsGrupos = $_POST['queryString'];
}
mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsGrupos = sprintf("SELECT * FROM grupos WHERE grupos LIKE %s AND grupos.activo = 1 ORDER BY grupos ASC", GetSQLValueString("%" . $colname_rsGrupos . "%", "text"));
$query_limit_rsGrupos = sprintf("%s LIMIT %d, %d", $query_rsGrupos, $startRow_rsGrupos, $maxRows_rsGrupos);
$rsGrupos = mysql_query($query_limit_rsGrupos, $cnxRamp) or die(mysql_error());
$row_rsGrupos = mysql_fetch_assoc($rsGrupos);

if (isset($_GET['totalRows_rsGrupos'])) {
  $totalRows_rsGrupos = $_GET['totalRows_rsGrupos'];
} else {
  $all_rsGrupos = mysql_query($query_rsGrupos);
  $totalRows_rsGrupos = mysql_num_rows($all_rsGrupos);
}
$totalPages_rsGrupos = ceil($totalRows_rsGrupos/$maxRows_rsGrupos)-1;



?>
<?php do { ?>
  <li onclick="fill('<?php echo $row_rsGrupos['grupos']; ?>',<?php echo $row_rsGrupos['idGrupos']; ?>);"><?php echo str_replace(strtoupper($colname_rsGrupos),"<font color='#CCFF00'>" . strtoupper($colname_rsGrupos) . "</font>",htmlentities(strtoupper($row_rsGrupos['grupos']))); ?></li>
  <?php } while ($row_rsGrupos = mysql_fetch_assoc($rsGrupos)); ?>
<?php
mysql_free_result($rsGrupos);
?>
