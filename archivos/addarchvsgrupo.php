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

$descargas = $_POST['ndesc'];

if($v_archivo == "-1" or $_vgrupo == "-1")
	echo ("no hay archivos paa insertar");

mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsArchVsGrupo = "insert into archivos_grupo (id_grupo,id_archivo) values (" . $v_grupo . "," . $v_archivo . ")";
$rsArchVsGrupo = mysql_query($query_rsArchVsGrupo, $cnxRamp) or mysql_error();

$sql="insert into usvsgrupovsvideo (UGD_USUARIO,UGD_GRUPO,UGD_VIDEO,UGD_DESCARGAS,UGD_ESTADO) 
SELECT grupos_usuario.IdUsuario, grupos_usuario.IdGrupos, " . $v_archivo . " AS video, " . $descargas . " AS descargas, 1 AS estado
FROM grupos_usuario
WHERE (((grupos_usuario.IdGrupos)=" . $v_grupo . "))";

$result = mysql_query($sql,$cnxRamp);

require_once('arcvsGrupo.php');
?>




