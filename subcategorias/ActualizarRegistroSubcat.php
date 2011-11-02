<?php require_once('../Connections/cnxRamp.php'); 
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
?>

<?php
mysql_select_db($database_cnxRamp, $cnxRamp);
if($_POST['accion']=='actualizar')
	{
		$sql="update grupos set grupos.grupos = '" . $_POST['nombre'] . "',grupos.activo=" . $_POST['estado'] . " where grupos.idGrupos = " . $_POST['idGrupos'];
		$mensaje="Actualizado...";
	}
else if($_POST['accion']=='agregar')
	{
		$sql="update grupos set grupos.activo=" . $_POST['estado'] . ",padre=" . $_POST['padre'] . " where grupos.idGrupos = " . $_POST['idGrupos'];
		$res=mysql_query($sql,$cnxRamp);
		if($res){
			$objGrupos=new clsusuario();
			$objGrupos->heredaGruposUsuarios($_POST['idGrupos']);
		}
		$mensaje="Ingresado...";
	}
else if($_POST['accion']=='eliminar')
	{
			$objGrupos=new clsusuario();
			$objGrupos->desheredaDeHijoAPadre($_POST['idGrupos']);//borra con herencia el los grupos superiores
			$sql="update grupos set padre=0 where grupos.idGrupos = " . $_POST['idGrupos'];
			$mensaje="Eliminado....";
			$res=mysql_query($sql, $cnxRamp);
	}

//mysql_query($sql, $cnxRamp) or die(mysql_error());
echo $mensaje;
?>  