<?php
//inserta una nueva presentacion en un grupo
require_once('../Connections/cnxRamp.php');
$v_grupo = "-1";
if (isset($_POST['grupo'])) {
  $v_grupo = $_POST['grupo'];
}

mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsArchVsGrupo = "delete from grupos_usuario where IdGrupos = " . $v_grupo;
mysql_query($query_rsArchVsGrupo, $cnxRamp) or mysql_error();


//reutilizacion de el script que construye esta pagina
require_once('usuarioVsGrupo.php');
?>