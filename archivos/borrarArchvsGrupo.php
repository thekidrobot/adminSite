<?php
//inserta una nueva presentacion en un grupo
require_once('../Connections/cnxRamp.php');
$v_grupo = "-1";
if (isset($_POST['grupo'])) {
  $v_grupo = $_POST['grupo'];
}
$v_archivo = "-1";
if (isset($_POST['archivo'])) {
  $v_archivo = $_POST['archivo'];
}

$v_interno = "-1";
if (isset($_POST['interno'])) {
  $v_interno = $_POST['interno'];
}
if($v_archivo == "-1" or $_vgrupo == "-1")
	echo ("no hay archivos paa borrar");

mysql_select_db($database_cnxRamp, $cnxRamp);

$sql = "DELETE usvsgrupovsvideo.*
FROM usvsgrupovsvideo INNER JOIN archivos_grupo ON (usvsgrupovsvideo.UGD_VIDEO = archivos_grupo.id_archivo) AND (usvsgrupovsvideo.UGD_GRUPO = archivos_grupo.id_grupo)
WHERE (((archivos_grupo.id_interno)=" . $v_interno . "))";
mysql_query($sql, $cnxRamp) or die(mysql_error());

$query_rsArchVsGrupo = "delete from archivos_grupo where id_interno = " . $v_interno;
mysql_query($query_rsArchVsGrupo, $cnxRamp) or mysql_error();


//reutilizacion de el script que construye esta pagina
require_once('arcvsGrupo.php');
?>