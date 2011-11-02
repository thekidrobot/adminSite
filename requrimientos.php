<?
include("conexion.php");
include("clases/clsusuario.php");

session_start();

//variables de acceso
$_SESSION["usuario"]="";		// almacena el usuario en sesion
$_SESSION["idusuario"]="";		// almacena el id del usuario en sesion

//objetos
$objUsuario=new clsusuario();
$msg="";

///ingresar al sistema
if($_POST["ingresar"]!="")
 {
   if($_POST["valorModo"]=="1")
    {
	   //administrador
	   $clave=$_POST["valorClave"];
	   $valido=$objUsuario->validacionAdministrador($_POST["valorLogin"],$clave);

	   if($valido!="0")
		{
		  //valido
		  $_SESSION["usuario"]=$_POST["valorLogin"];
		  $_SESSION["idusuario"]=$valido;
		  ?>
		  <script language="javascript">
		  document.location="menuadmin.php";
		  </script>
		  <?
		}
	}
   else
    {
	   //usuario
	   $valido=$objUsuario->validacionUsuario($_POST["valorLogin"],$_POST["valorClave"]);

	   if($valido!="0")
		{
		  //valido
		  $_SESSION["usuario"]=$_POST["valorLogin"];
		  $_SESSION["idusuario"]=$valido;
		  ?>
		  <script language="javascript">
		  document.location="galeria/index.php";
		  </script>
		  <?
		}
	}
    
	$msg="O usuário é invalido";
 }

?>
<html>
<head>
<title>:::::LFG:::::</title>
<link rel="stylesheet" href="INDEX.CSS">
<script language="javascript" src="js.js"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<link href="css/stilos.css" rel="stylesheet" type="text/css">
<link href="galeria/css/galeria.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" background="" >
<form name="formProceso" action="index.php" method="post" onSubmit="return validaAcceso()">
  <table width="912" border="0" align="center" cellpadding="0">
    <tr>
      <th colspan="2" scope="col"><img src="imagenes/topo.jpg" width="900" height="174" border="0" usemap="#Map">
        <map name="Map">
          <area shape="rect" coords="414,146,501,160" href="requrimientos.php"><area shape="rect" coords="351,143,397,160" href="index.php">
          <area shape="rect" coords="512,145,600,160" href="como_funciona.php">
          <area shape="rect" coords="613,145,664,161" href="suporte.php">
          <area shape="rect" coords="687,145,717,159" href="http://%20www.lfg.com.br" target="_blank">
        </map>
      </th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="335"><img src="imagenes/filme.jpg" width="312" height="226"></td>
      <td width="571"><p><img src="imagenes/requerimientos.jpg" width="456" height="300"><br>
        <br>
      </p>        </td>
    </tr>
    
    <tr>
      <td colspan="2" bgcolor="#4E76B3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#FFFFFF"><div align="center" class="descripcion_borde_inferior">&copy; Copyright 2009 LFG. all rights reserved. Powered   by <a href="http://www.ramprm.com" target="_blank">RAMP, LLC</a></div></td>
    </tr>
  </table>
  <br>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
</html>
