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
<title>:: CUESTIONARIO ::</title>
<link rel="stylesheet" href="INDEX.CSS">
<script language="javascript" src="core.js"></script>
<script language="javascript" src="js.js"></script>
<link href="galeria/css/galeria.css" rel="stylesheet" type="text/css">
<link href="css/stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<style type="text/css">
<!--
.Estilo2 {color: #999999}
-->
</style>
</head>
<body leftmargin="0" topmargin="0"  bgcolor="#CCCCCC" >
<table width="767" height="100%" border="0" cellpadding="0" cellspacing="0">
  
  <tr>
    <td width="767" align="left" valign="top" class="body-text1"><img src="newImages/titulo_usuarios.jpg" width="768" height="52"></td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#CCCCCC" class="body-text1"><form name="formProceso" action="admusuarios.php" method="post" onSubmit="return validarNuevoUsuario()">
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
<table width="579" border="0" align="center" cellpadding="0" cellspacing="0" class="borde_alrededor">
            <tr>
              <td colspan="3" class="encabezado">Adicionar Usu&aacute;rios</td>
            </tr>
            <tr>
              <td width="18" class="tahoma_12">&nbsp;</td>
              <td width="74" class="tahoma_12">&nbsp;</td>
              <td width="485" class="body-text1">&nbsp;</td>
            </tr>
            <tr>
              <td class="tahoma_12">&nbsp;</td>
              <td class="descripcion"> Nome </td>
              <td class="body-text1"><input type="text" name="valorNombre" value="<?=$vNombreCompleto?>" maxlength="255" size="80" class="descripcion">              </td>
            </tr>
            
            <tr>
              <td class="tahoma_12">&nbsp;</td>
              <td class="descripcion"> Login </td>
              <td class="body-text1"><input type="text" name="valorLogin" value="<?=$vUsuario?>" maxlength="100" size="50" class="descripcion" >              </td>
            </tr>
            <tr>
              <td class="tahoma_12">&nbsp;</td>
              <td class="descripcion"> Senha</td>
              <td class="body-text1"><input type="password" name="valorClave" value="<?=$vPassword?>" maxlength="15" size="50" class="descripcion">              </td>
            </tr>
            <tr>
              <td align="left" class="tahoma_12">&nbsp;</td>
              <td align="left" class="descripcion">Ativar</td>
              <td align="left" class="body-text1"><input <?php if (!(strcmp($activoUser,1))) {echo "checked=\"checked\"";} ?> name="activo" type="checkbox" id="activo" value="1" ></td>
            </tr>
            <tr>
              <td align="left" class="tahoma_12">&nbsp;</td>
              <td align="left" class="descripcion">Computer ID </td>
              <td align="left" class="body-text1"><label>
                <input name="licencia" type="text" class="descripcion" id="licencia" value="<?php echo $llave; ?>" size="80">
              </label></td>
            </tr>
            <tr>
              <td align="left" class="tahoma_12">&nbsp;</td>
              <td align="left" class="tahoma_12">&nbsp;</td>
              <td align="right" class="descripcion"> <label>
                  <input type="button" name="btnCambiar" id="btnCambiar" value="New Key" onClick="fngenerakey();">
                </label>
                <div id="keyramp" align="left">
                  <input name="txtKeyramp" type="text" class="descripcion" id="txtKeyramp" value="<?php echo $pckey; ?>" size="64" readonly="readonly">
              </div></td>
            </tr>
            <tr>
              <td align="right" class="body-text1">&nbsp;</td>
              <td align="right" class="body-text1"><br>
                <br></td>
              <td align="right" class="descripcion"><div align="left">
                <input type="image" src="imagenes/crear.jpg">
                <?=$msg?>
              </div></td>
            </tr>
            <tr>
              <td align="right" class="body-text1">&nbsp;</td>
              <td align="right" class="body-text1">&nbsp;</td>
              <td align="right" class="descripcion">&nbsp;</td>
            </tr>
          </table>
    </form>
    <form name="frmbusca" action="admusuarios.php" method="post">
    <table width="587" border="0" align="center" cellpadding="0" cellspacing="0" class="borde_alrededor">
            <tr>
              <td colspan="3" class="encabezado">Procurar usu&aacute;rios</td>
            </tr>
            <tr>
              <td width="23" class="tahoma_12">&nbsp;</td>
              <td width="72" class="tahoma_12">&nbsp;</td>
              <td width="490" class="body-text1">&nbsp;</td>
            </tr>
            <tr>
              <td class="tahoma_12">&nbsp;</td>
              <td class="descripcion"> Nome </td>
              <td class="body-text1"><input type="text" name="parteNombre" id="parteNombre" value="<?php echo $_POST['parteNombre']; ?>" maxlength="255" size="90" class="descripcion">              </td>
            </tr>
            
            <tr>
              <td class="tahoma_12">&nbsp;</td>
              <td class="tahoma_12">&nbsp;</td>
              <td class="body-text1">&nbsp;</td>
            </tr>
            <tr>
              <td class="tahoma_12">&nbsp;</td>
              <td class="tahoma_12">&nbsp;</td>
              <td class="body-text1"><input type="image" src="imagenes/buscar.jpg"></td>
            </tr>
            <tr>
              <td class="tahoma_12">&nbsp;</td>
              <td class="tahoma_12">&nbsp;</td>
              <td class="body-text1">&nbsp;</td>
            </tr>
        </table>
     </form>
    <br>
    <table width="587" height="25" border="0" align="center" cellpadding="0">
        <tr>
          <td class="descripcion" scope="col"><div align="left" class="Estilo2">
            <div align="left" class="letra_gris">Mostrando os 50 registros</div>
          </div></td>
        </tr>
      </table>
      <table width="587" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="D4D4D4">
          <tr bgcolor="D4D4D4" class="encabezado" >
            <td width="68%" bgcolor="#FFFFFF" class="encabezado"> Nome</td>
            <td width="13%"  align="left" bgcolor="#FFFFFF" class="encabezado">Ativo</td>
            <td width="15%"  align="left" bgcolor="#FFFFFF" class="encabezado">Login </td>
            <td width="2%"  align="center" bgcolor="#FFFFFF" class="encabezado">&nbsp;</td>
            <td width="2%"  align="center" bgcolor="#FFFFFF" class="encabezado">&nbsp;</td>
    <tr>
            <?
		   
		   
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
		   
		   while ($row = mysql_fetch_array($_pagi_result))
			 {
			  $IdUsuario=$row["IdUsuario"]; 
			  $NombreCompleto=$row["NombreCompleto"]; 
			  $apellidos=$row["apellidos"]; 
			  $Usuario=$row["Usuario"]; 
			  $activo=$row["activo"];
			  ?>
      <tr bgcolor="white" class="descripcion_borde_inferior" onMouseOver="sobre(this)" onMouseOut="fuera(this)" >
          <td width="68%" valign="top" bgcolor="#CCCCCC" class="descripcion_borde_inferior"> &nbsp;&nbsp;  <a href="admusuarios.php?actualizar=<?=$IdUsuario?>" style="color:#003366 "><?=$NombreCompleto?> <?=$apellidos?>
            </a></td>
            <td  align="center" valign="top" bgcolor="#CCCCCC" class="descripcion_borde_inferior"><label>
              <input type="checkbox" name="act" id="act" disabled <?php if (!(strcmp($activo,1))) {echo "checked=\"checked\"";} ?>>
            </label></td>
            <!--<td  align="left" valign="top" bgcolor="white" class="tahoma_12"><a href="mensajes/insertarMensaje.php?codUser=<?php echo $IdUsuario; ?>&nomUser=<?php echo $NombreCompleto; ?>">Enviar</a></td>-->
          <td  align="left" valign="top" bgcolor="#CCCCCC" class="descripcion_borde_inferior"><?=$Usuario?>            </td>
            <td width="2%" align="center" valign="top" bgcolor="#CCCCCC" class="descripcion_borde_inferior">&nbsp;</td>
        <tr>
            <?
			 }
		   ?>
      </table>
<br>
        <table width="587" border="0" align="center" cellpadding="0">
          <tr>
            <th scope="col"><div align="left"><span class="descripcion"><? echo"<p>".$_pagi_navegacion."</p>"; ?></span></div></th>
          </tr>
        </table>
    <br>    </td>
  </tr>
  <tr>
    <td  height="10"><img src="imagenes/spacer.gif" width="1" height="1"></td>
  </tr>
</table>
</body>
</html>