<?
include("conexion.php");
include("clases/clsusuario.php");
include("session.php");

///objetos
$objUsuario=new clsusuario();
$msg="";

///actualizar clave
if($_POST["ingresar"]!="")
 {
    $clave=$_POST["valorClave"];
    $objUsuario->actualizarClave($_SESSION["usuario"],$clave);
    $msg=_("Password updated");
 }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RAMP</title>

<!-- CSS -->
<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->

<!-- JavaScripts-->
<script type="text/javascript" src="style/js/jquery.js"></script>
<script type="text/javascript" src="style/js/jNice.js"></script>
</head>
<body>
 <h3><?=_("Change password")?></h3>
 <form name="formProceso" action="admacceso.php" method="post" onSubmit="return validaCambioClave()" class="jNice">
	<fieldset>
	 <input type="hidden" name="ingresar" value="1">
   <p>
		<label><?=_("Type your new password ") ?>:</label>
		<input name="valorClave" type="password" class="text-long">
	 </p>
	 <input type="submit" value="<?=_("Change")?>" name="Change" />
	 <p>
		<label><?=$msg?></label>
	 </p>
	</fieldset>
 </form>
</body>
</html>
