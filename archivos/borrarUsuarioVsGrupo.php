<?php
//inserta una nueva presentacion en un grupo
require_once('../Connections/cnxRamp.php');
include("../clases/clsusuario.php");

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


$v_grupo = "-1";
if (isset($_POST['grupo'])) {
  $v_grupo = $_POST['grupo'];
}
$v_usuario = "-1";
if (isset($_POST['usuario'])) {
  $v_usuario = $_POST['usuario'];
}

$v_hijo = "-1";
if (isset($_POST['hijo'])) {
  $v_hijo = $_POST['hijo'];
}
if($v_archivo == "-1" or $_vgrupo == "-1")
	echo ("no hay archivos paa borrar");





mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsArchVsGrupo = "delete from grupos_usuario where IdUsuario = " . $v_usuario . " and IdGrupos = " . $v_grupo . " and grupoHijo = " . $v_hijo;
$res = mysql_query($query_rsArchVsGrupo, $cnxRamp);//borra el usuario del grupo actual
if($res)
{
	$objGrupos=new clsusuario();
	$objGrupos->borraUsuarioGrupo($v_usuario,$v_grupo);//borra con herencia el usuario de los grupos superiores
	$objGrupos->borrarUsVsGrVsVid($v_usuario,$v_grupo);//elimina los datos de la tavla usvsgrupovsvideo
}
//reutilizacion de el script que construye esta pagina
require_once('usuarioVsGrupo.php');
?>