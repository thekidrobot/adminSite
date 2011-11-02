<?php
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
//inserta una nueva presentacion en un grupo
require_once('../Connections/cnxRamp.php');
include("../clases/clsusuario.php");
$v_grupo = "-1";
if (isset($_POST['grupo'])) {
  $v_grupo = $_POST['grupo'];
}
$v_usuario = "-1";
if (isset($_POST['usuario'])) {
  $v_usuario = $_POST['usuario'];
}

$v_cantidad = "-1";
if (isset($_POST['cantidad'])) {
  $v_cantidad = $_POST['cantidad'];
}
$v_nGrupo = "-1";
if(isset($_POST['nomGrupo'])){
	$v_nGrupo = $_POST['nomGrupo'];
}

if($v_archivo == "-1" or $_vgrupo == "-1")
{
	echo ("no hay archivos paa insertar");
	die();
}

$objGrupos=new clsusuario();
$objGrupos->ingresarGruposUsuarios( $v_usuario , $v_grupo , $v_cantidad );
$objGrupos->poblarUsVsGrupVsVideo($v_usuario , $v_grupo , $v_cantidad);
/*mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsArchVsGrupo = "insert into grupos_usuario (idUsuario,idGrupos,ramp_cant_descargas) values (" . $v_usuario . "," . $v_grupo . "," . $v_cantidad . ")";
$rsArchVsGrupo = mysql_query($query_rsArchVsGrupo, $cnxRamp) or mysql_error();

//echo $query_rsArchVsGrupo;
//die;
*/
//echo  $v_usuario ."-". $v_grupo ."-". $v_cantidad;
require_once('usuarioVsGrupo.php');
?>




