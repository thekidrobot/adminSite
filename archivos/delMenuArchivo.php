<?php 
if (!isset($_SESSION)) 
  session_start();
require_once('../Connections/conexion.php');
mysql_select_db($database_conexion, $conexion);
$sql = "DELETE FROM  archivos_vs_menus WHERE id_archivo = " . $_GET['archivo'] . " AND id_menu = " . $_GET['codMenu'];
$res = mysql_query($sql, $conexion) or die(mysql_error());
header("Location: edicion.php?id_archivo=" . $_GET['archivo']);
?>
