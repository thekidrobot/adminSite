<?
include("conexion.php");
include("clases/clstaller.php");
include("clases/clsusuario.php");

$con = mysql_connect($_SESSION["servidor"],$_SESSION["root"],$_SESSION["claveBD"]) or die (mysql_error()); 
mysql_select_db($_SESSION["basededatos"],$con) or die (mysql_error()); 

session_start();

//validar sesion
if($_SESSION["usuario"]=="")
 {
  ?>
  <script language="javascript">
  document.location="index.php";
  </script>
  <?
 }

///objetos
$objTaller=new clstaller();
$objUsuario=new clsusuario();
$msg="";

///ingresar   
if($_POST["ingresar"]!="")
 {
    $resp=$objUsuario->validacionLoginUsuario($_POST["valorLogin"]);
	
	if($resp=="1")
	 {
	  $objUsuario->ingresarUsuario($_POST["valorLogin"],$_POST["valorClave"],$_POST["valorNombre"],$_POST['activo'],$_POST['licencia'],$_POST['txtKeyramp']);
	  $msg="Registroe enviado";
	 }
	else
	 {
	  $msg="O login já existe, por favor crie outro";
	 }
 }


///actualizar
if($_POST["actualizar"]!="")
 {
	 if($_POST['activo']!='1')
		 $activo=0;
	else
		$activo=1;


	$objUsuario->actualizarUsuario($_POST["actualizar"],$_POST["valorLogin"],$_POST["valorClave"],$_POST["valorNombre"],$activo,$_POST['licencia'],$_POST['txtKeyramp']);
	
    $msg="Registro atualizado";
 }


//informacion registro seleccionado
if($_GET["actualizar"]!="")
 {
   $RSresultado=$objUsuario->consultarDetalleUsuarios($_GET["actualizar"]);
   while ($row = mysql_fetch_array($RSresultado))
	 {
	  $vUsuario=$row["Usuario"]; 
	  $vPassword=$row["Password"]; 
	  $vNombreCompleto=$row["NombreCompleto"]; 
	  $vapellidos=$row["apellidos"];
	  $activoUser=$row["activo"]; 
	  $llave=$row["ID_PLUGIN"];
	  $pckey=$row["pcrampkey"];
	  //$vMacId=$row["MAC_ID"];
	  //$vDirLocal=$row["DIRECCION_LOCAL"];	  
     }
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
</head><body>
 <h3>Gerenciar Usuarios</h3>
  
	<form name="formProceso" action="admusuarios.php" method="post" onSubmit="return validarNuevoUsuario()">
	 <fieldset>
	 <? 
	 if($_GET["actualizar"]!="")
	 {
		?>
		<input type="hidden" name="actualizar" value="<?=$_GET["actualizar"]?>">
		<? 
	 }
	 else
	 {
		?>
		<input type="hidden" name="ingresar" value="1">
		<? 
	 }
	 ?>
	 <p>
		<label>Nome</label>
    <input type="text" name="valorNombre" value="<?=$vNombreCompleto?>" maxlength="255" />
	 </p>
   <p>
		<label>Login</label>
		<input type="text" name="valorLogin" value="<?=$vUsuario?>" maxlength="100" />
	 </p>
	 <p>
	  <label>Senha</label>
    <input type="password" name="valorClave" value="<?=$vPassword?>" maxlength="15" />
   </p>
	 <p>
	  <label>Ativar
		<input <?php if (!(strcmp($activoUser,1))) {echo "checked=\"checked\"";} ?> name="activo" type="checkbox" id="activo" value="1" />
		</label>
	 </p>
   <p>
	  <label>Computer ID </label>
		<input name="licencia" type="text" id="licencia" value="<?php echo $llave; ?>" />
		<input type="button" name="btnCambiar" id="btnCambiar" value="New Key" onClick="fngenerakey();" />
    <input name="txtKeyramp" type="text" id="txtKeyramp" value="<?php echo $pckey; ?>" readonly="readonly" />
   </p>
	 <p>
		<label><?=$msg?></label>
	 <input type="image" src="imagenes/crear.jpg">
   </p> 
	 </fieldset>
	 </table>
  </form>

	<h3>Procurar usu&aacute;rios</h3>
	<form name="frmbusca" action="admusuarios.php" method="post">
   <fieldset>
		<p>
		 <label>Nome</label>
		 <input type="text" name="parteNombre" id="parteNombre" value="<?php echo $_POST['parteNombre']; ?>" maxlength="255" />
		</p>
		<input type="image" src="imagenes/buscar.jpg">
	 </fieldset>
  </form>
	
	<h3>Mostrando os 50 registros</h3>
  <table>
    <tr>
		 <td><b>Nome</b></td>
		 <td><b>Ativo</b></td>
		 <td><b>Login</b></td>
    <tr>
    <?php
		//Sentencia sql (sin limit) 
		if($_POST['parteNombre']!="")
		{
		 $RSresultado=$objUsuario->consultarUsuario($_POST['parteNombre']);
		 $_pagi_sql = "SELECT * FROM  usuarios where NombreCompleto like '%" . $_POST['parteNombre'] . "%' order by NombreCompleto ";
		 $_pagi_cuantos = 5000; 
		}
		else
		{
		 $RSresultado=$objUsuario->consultarUsuarios();
		 $_pagi_sql = "SELECT * FROM usuarios ORDER BY NombreCompleto"; 
		 $_pagi_cuantos = 50; 
		}
		//cantidad de resultados por p&aacute;gina (opcional, por defecto 20) 
		//Incluimos el script de paginaci&oacute;n. &Eacute;ste ya ejecuta la consulta autom&aacute;ticamente 
		include("paginator.inc.php"); 
		$counter = 0;
		while ($row = mysql_fetch_array($_pagi_result))
		{
		 $IdUsuario=$row["IdUsuario"]; 
		 $NombreCompleto=$row["NombreCompleto"]; 
		 $apellidos=$row["apellidos"]; 
		 $Usuario=$row["Usuario"]; 
		 $activo=$row["activo"];
		 ?>
		 <tr onMouseOver="sobre(this)" onMouseOut="fuera(this)" <?php if($counter % 2) echo " class='odd'"?>>
			<td>
			 <a href="admusuarios.php?actualizar=<?=$IdUsuario?>" style="color:#003366 "><?=$NombreCompleto?> <?=$apellidos?></a>
			</td>
			<td>
			 <input type="checkbox" name="act" id="act" disabled <?php if (!(strcmp($activo,1))) {echo "checked=\"checked\"";} ?>>
			</td>
			<!--<td  align="left" valign="top" bgcolor="white" class="tahoma_12"><a href="mensajes/insertarMensaje.php?codUser=<?php echo $IdUsuario; ?>&nomUser=<?php echo $NombreCompleto; ?>">Enviar</a></td>-->
			<td><?=$Usuario?></td>
		 <tr>
		 <?
		}
		?>
		<tr>
		 <td colspan="3" align="center"><? echo"<p>".$_pagi_navegacion."</p>"; ?></td>
		</tr>
   </table>
 </body>
</html>