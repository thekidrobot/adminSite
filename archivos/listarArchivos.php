<?php require_once('../Connections/cnxRamp.php'); ?>
<?php include("../session.php"); 

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

$maxRows_rsArchivos = 5;
$pageNum_rsArchivos = 0;
if (isset($_GET['pageNum_rsArchivos'])) {
  $pageNum_rsArchivos = $_GET['pageNum_rsArchivos'];
}
$startRow_rsArchivos = $pageNum_rsArchivos * $maxRows_rsArchivos;

mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsArchivos = "SELECT * FROM archivos ORDER BY id_archivo DESC";
$query_limit_rsArchivos = sprintf("%s LIMIT %d, %d", $query_rsArchivos, $startRow_rsArchivos, $maxRows_rsArchivos);
$rsArchivos = mysql_query($query_limit_rsArchivos, $cnxRamp) or die(mysql_error());
$row_rsArchivos = mysql_fetch_assoc($rsArchivos);

if (isset($_GET['totalRows_rsArchivos'])) {
  $totalRows_rsArchivos = $_GET['totalRows_rsArchivos'];
} else {
  $all_rsArchivos = mysql_query($query_rsArchivos);
  $totalRows_rsArchivos = mysql_num_rows($all_rsArchivos);
}
$totalPages_rsArchivos = ceil($totalRows_rsArchivos/$maxRows_rsArchivos)-1;$maxRows_rsArchivos = 10;
$pageNum_rsArchivos = 0;
if (isset($_GET['pageNum_rsArchivos'])) {
  $pageNum_rsArchivos = $_GET['pageNum_rsArchivos'];
}
$startRow_rsArchivos = $pageNum_rsArchivos * $maxRows_rsArchivos;

/*mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsArchivos = "SELECT * FROM archivos ORDER BY nombre_fisico DESC";
$query_limit_rsArchivos = sprintf("%s LIMIT %d, %d", $query_rsArchivos, $startRow_rsArchivos, $maxRows_rsArchivos);
$rsArchivos = mysql_query($query_limit_rsArchivos, $cnxRamp) or die(mysql_error());
$row_rsArchivos = mysql_fetch_assoc($rsArchivos);
*/
if (isset($_GET['totalRows_rsArchivos'])) {
  $totalRows_rsArchivos = $_GET['totalRows_rsArchivos'];
} else {
  $all_rsArchivos = mysql_query($query_rsArchivos);
  $totalRows_rsArchivos = mysql_num_rows($all_rsArchivos);
}
$totalPages_rsArchivos = ceil($totalRows_rsArchivos/$maxRows_rsArchivos)-1;

$queryString_rsArchivos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsArchivos") == false && 
        stristr($param, "totalRows_rsArchivos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsArchivos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsArchivos = sprintf("&totalRows_rsArchivos=%d%s", $totalRows_rsArchivos, $queryString_rsArchivos);

//Delete one
if($_GET["del"]!="" and is_numeric($_GET["del"]))
{
  $query_rsArchivo = "SELECT * FROM archivos WHERE id_archivo = ".$_GET["del"];
  $rsArchivo = mysql_query($query_rsArchivo) or die(mysql_error());
  $row_rsArchivo = mysql_fetch_assoc($rsArchivo);
  $totalRows_rsArchivo = mysql_num_rows($rsArchivo);
  
  //Borrar archivos existentes
  $gallery_upload_path = "../data/images/";
  
  $actual_filename = $row_rsArchivo['imagen'];
  $file_ext = substr($actual_filename, strrpos($actual_filename, '.') + 1);	
  //remove the ext
  $filename_strip= substr($actual_filename,0,strrpos($actual_filename, '.'));	
  //remove the _big
  $filename_strip= substr($actual_filename,0,strrpos($actual_filename, '_big'));
  //add the _small
  $filename_strip= $filename_strip."_small";	
  
  $actual_filename_thumb = $filename_strip.".".$file_ext;

  unlink($gallery_upload_path.$actual_filename);
  unlink($gallery_upload_path.$actual_filename_thumb);
  
  
  $sql = "DELETE FROM archivos where id_archivo=".$_GET["del"];
  mysql_query($sql);
  if (!headers_sent()) header('Location: '.$currentPage);
  else echo '<meta http-equiv="refresh" content="0;url='.$currentPage.'" />';
}

//Delete multiple
$arrArchivos = $_POST['archivos'];

$U = count($arrArchivos);
if($U > 0)
{
 foreach($arrArchivos as $id)
 {
  $query_rsArchivo = "SELECT * FROM archivos WHERE id_archivo = $id";
  $rsArchivo = mysql_query($query_rsArchivo) or die(mysql_error());
  $row_rsArchivo = mysql_fetch_assoc($rsArchivo);
  $totalRows_rsArchivo = mysql_num_rows($rsArchivo);
  
  //Borrar archivos existentes
  $gallery_upload_path = "../data/images/";
  
  $actual_filename = $row_rsArchivo['imagen'];
  $file_ext = substr($actual_filename, strrpos($actual_filename, '.') + 1);	
  //remove the ext
  $filename_strip= substr($actual_filename,0,strrpos($actual_filename, '.'));	
  //remove the _big
  $filename_strip= substr($actual_filename,0,strrpos($actual_filename, '_big'));
  //add the _small
  $filename_strip= $filename_strip."_small";	
  
  $actual_filename_thumb = $filename_strip.".".$file_ext;

  unlink($gallery_upload_path.$actual_filename);
  unlink($gallery_upload_path.$actual_filename_thumb);
  
  $sql = "DELETE FROM archivos where id_archivo=$id";
  mysql_query($sql);
  if (!headers_sent()) header('Location: '.$currentPage);
  else echo '<meta http-equiv="refresh" content="0;url='.$currentPage.'" />';
 }
} 

?>
<html>
<?php include("../includes/head.php") ?>
<body>
    <h3><?=_("View Files")?></h3>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <table cellpadding="0" cellspacing="0">
      <tr valign="absmiddle">
        <td align="center" style="padding:5px 0px 5px 0px">
          <input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
        </td>
        <td><b><?=_("Edit")?></b></td>
        <td><b><?=_("Description")?></b></td>
        <td><b><?=_("Trainer")?></b></td>
        <td><b><?=_("Subject")?></b></td>
        <td><b><?=_("Release date")?></b></td>
        <td><b><?=_("Delete")?></b></td>
      </tr>
      <?php
        $counter = 0;
        do
        {
        ?>
        <tr <?php if($counter % 2) echo " class='odd'"?>>
          <td align="center">
            <input name='archivos[]' type='checkbox' value="<?=$row_rsArchivos['id_archivo']?>">
          </td>
          <td>
            <a href="edicion.php?id_archivo=<?php echo $row_rsArchivos['id_archivo']; ?>">
            <?=$row_rsArchivos['titulo']; ?>
            </a>
          </td>
          <td><a href="editImagen.php?arch=<?=$row_rsArchivos['id_archivo']; ?>"></a> <?=$row_rsArchivos['texto']; ?></td>
          <td><?=$row_rsArchivos['speaker']; ?></td>
          <td><?=$row_rsArchivos['tema']; ?></td>
          <td><?=$row_rsArchivos['fechaLanzamiento']; ?></td>
          <td class="action"><a href="<?=$_SERVER['PHP_SELF']; ?>?del=<?=$row_rsArchivos['id_archivo']?>" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')"><?=_("Delete")?></a></td>
        </tr>
        <?php
          $counter++;
        }
        while ($row_rsArchivos = mysql_fetch_assoc($rsArchivos)); ?>
        <tr>
          <td colspan="7">
            <?php
              gettext(printf("Files %d to %d of %d",($startRow_rsArchivos + 1),min($startRow_rsArchivos + $maxRows_rsArchivos, $totalRows_rsArchivos),$totalRows_rsArchivos))
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="7" align="center">
          <?php
          if ($pageNum_rsArchivos > 0)
          { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsArchivos=%d%s", $currentPage, 0, $queryString_rsArchivos); ?>">
            <img src="../imagenes/first.png">
            </a>
            <?php
          } // Show if not first page ?>        
          
          <?php
          if ($pageNum_rsArchivos > 0)
          { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsArchivos=%d%s", $currentPage, max(0, $pageNum_rsArchivos - 1), $queryString_rsArchivos); ?>">
            <img src="../imagenes/previous.png">
            </a>
            <?php
          } // Show if not first page ?>
          <?php
          if ($pageNum_rsArchivos < $totalPages_rsArchivos)
          { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsArchivos=%d%s", $currentPage, min($totalPages_rsArchivos, $pageNum_rsArchivos + 1), $queryString_rsArchivos); ?>">
            <img src="../imagenes/next.png">
            </a>
            <?php
          } // Show if not last page ?>
          <?php
          if ($pageNum_rsArchivos < $totalPages_rsArchivos)
          { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsArchivos=%d%s", $currentPage, $totalPages_rsArchivos, $queryString_rsArchivos); ?>">
            <img src="../imagenes/last.png">
            </a>
            <?php
          } // Show if not last page ?>
          </td>
        </tr>
    </table>
  </form>
</body>
</html>
<?php
mysql_free_result($rsArchivos);
?>
