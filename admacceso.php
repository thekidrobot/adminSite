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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Transdmin Light</title>

<!-- CSS -->
<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->

<!-- JavaScripts-->
<script type="text/javascript" src="style/js/jquery.js"></script>
<script type="text/javascript" src="style/js/jNice.js"></script>
</head>
<body>
 <h3>Gerenciar minha conta</h3>
 <h3>Trocar password </h3>
 <form name="formProceso" action="admacceso.php" method="post" onSubmit="return validaCambioClave()">
	<fieldset>
	 <input type="hidden" name="ingresar" value="1">
   <p>
		<label>Digite seu novo password:</label>
		<input name="valorClave" type="password">
	 </p>
	 <p>
		<label><?=$msg?></label>
		<input type="image" src="imagenes/crear.jpg">
   </p>
	</fieldset>
 </form>
</body>
</html>
