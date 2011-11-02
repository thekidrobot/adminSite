<?
include("conexion.php");
include("clases/clsusuario.php");

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

///objetos
$objUsuario=new clsusuario();
$msg="";

///actualizar clave
if($_POST["ingresar"]!="")
 {
    $clave=$_POST["valorClave"];
    $objUsuario->actualizarClave($_SESSION["usuario"],$clave);
    $msg="Password atualizado";
 }
?>
<html>
<head>
<title>:: CUESTIONARIO ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="INDEX.CSS">
<script language="javascript" src="js.js">
</script>
<link href="galeria/css/galeria.css" rel="stylesheet" type="text/css">
<link href="css/stilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-color: #CCC;
}
-->
</style></head>
<body leftmargin="0" topmargin="0" background="" >
<table width="767" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="767"  height="1" valign="top"><img src="imagenes/spacer.gif" width="1" height="1"><img src="newImages/titulo_cuenta.jpg" width="768" height="52"></td>
  </tr>
  <tr>
    <td class="body-text1"  valign="top" align="left"><form name="formProceso" action="admacceso.php" method="post" onSubmit="return validaCambioClave()">
          <p>
            <input type="hidden" name="ingresar" value="1">
          </p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <table width="515" align="center" class="borde_alrededor">
            <tr>
              <td colspan="2" class="encabezado">Trocar password </td>
            </tr>
            <tr>
              <td class="tahoma_12">&nbsp;</td>
              <td class="body-text1">&nbsp;</td>
            </tr>
            <tr>
              <td width="149" align="right" class="descripcion">Digite seu novo password:</td>
              <td width="354" class="body-text1"><input name="valorClave" type="password" class="tahoma_12" size="50">              </td>
            </tr>
            <tr>
              <td align="right" class="body-text1"><br>
                <br></td>
              <td align="right" class="body-text1"><div align="left" class="descripcion">
                <input type="image" src="imagenes/crear.jpg">
                <?=$msg?>
              </div></td>
            </tr>
            <tr>
              <td align="right" class="body-text1">&nbsp;</td>
              <td align="right" class="body-text1">&nbsp;</td>
            </tr>
          </table>
      </form></td>
  </tr>
  <tr>
    <td  height="10"><img src="imagenes/spacer.gif" width="1" height="1"></td>
  </tr>
</table>
</body>
</html>
