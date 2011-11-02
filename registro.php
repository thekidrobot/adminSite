<?php require_once('Connections/cnxRamp.php');
include("captcha/class/captchaZDR.php");

if (!isset($_SESSION)) {
  session_start();
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$activo = 1;
$capt = new captchaZDR;

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	if($capt->check_result())
	{ 
			$errrorCaptcha = "si";
			  $insertSQL = sprintf("INSERT INTO usuarios (Usuario, Password, NombreCompleto, mail, empresa, cargo, telefono, activo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
								   GetSQLValueString($_POST['Nombre'], "text"),
								   GetSQLValueString($_POST['Clave'], "text"),
								   GetSQLValueString($_POST['nombres'], "text"),
								   GetSQLValueString($_POST['Correo'], "text"),
								   GetSQLValueString($_POST['compania'], "text"),
								   GetSQLValueString($_POST['cargo'], "text"),
								   GetSQLValueString($_POST['telefono'], "text"),
								   GetSQLValueString($activo, "int"));
			
			  mysql_select_db($database_cnxRamp, $cnxRamp);
			  $Result1 = mysql_query($insertSQL, $cnxRamp) or die(mysql_error());
			
			  $insertGoTo = "envio.php";
			  if (isset($_SERVER['QUERY_STRING'])) {
				$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
				$insertGoTo .= $_SERVER['QUERY_STRING'];
			  }
			  
			  			  
			  $sql2="insert into grupos_usuario (idusuario,idgrupos,ramp_cant_descargas) 
						values((select idUsuario from usuarios where Usuario = '" . $_POST['Nombre'] . "'),3,50)";
			  $resultado = mysql_query($sql2, $cnxRamp) or die(mysql_error());
			  
			  //inserta el usuario en los grupos seleccionados 3 y 4 
			  $sql2="insert into grupos_usuario (idusuario,idgrupos,ramp_cant_descargas) 
						values((select idUsuario from usuarios where Usuario = '" . $_POST['Nombre'] . "'),4,50)";
						
			  $resultado = mysql_query($sql2, $cnxRamp) or die(mysql_error());
			  
			  
			  header(sprintf("Location: %s", $insertGoTo));
	}
		else
		{
				$errrorCaptcha = "no";
			}
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::::APConlinelearning::::</title>
<style type="text/css">
<!--
.verdana {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	color: #000000;
}
.Estilo9 {color: #FF0000}
-->
</style>
<script type="text/javascript" src="js.js"></script>
<script type="text/javascript" src="ajax/core.js"></script>
<script type="text/javascript">
function mirar()
{
	p=document.getElementById('Nombre');
	if(p.value=='')
		alert('ingrese el logion para ser comprobado');
	else
		invocaGenericoPost("apodo","usrCompruebaApodo.php","Usuario="+p.value,"Comprobando disponibilidad...");
	}
	
</script>
</head>

<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	line-height: normal;
}
.Estilo5 {font-size: 10px}
.bordes {
	border: 1px solid #CCCCCC;
}
.Estilo7 {font-size: 10px; font-weight: bold; }
.Estilo8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; line-height: normal; font-weight: bold; }
.okUser {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFF;
	background-color: #0C0;
	text-align: left;
}
.errUser {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFF;
	background-color: #F00;
	text-align: left;
}
-->
</style>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- fwtable fwsrc="home.png" fwbase="home.jpg" fwstyle="Dreamweaver" fwdocid = "538921909" fwnested="0" -->
  
  <tr>
    <td colspan="8"><img name="index_r1_c1" src="imagenes/botar_banner_r1_c1.gif" width="840" height="80" border="0" id="index_r1_c1" alt="" /></td>
  </tr>
  
  <tr>
    <td colspan="8" bgcolor="#F3F2F4"><img name="index_r2_c1" src="images/index_r2_c1.gif" width="840" height="227" border="0" id="index_r2_c1" alt="" /></td>
  </tr>
  <tr>
    <td colspan="8"><table width="811" border="0" align="left" cellspacing="0">
      <tr>
        <td colspan="2" rowspan="4" valign="top"><div align="right"></div>
          <div align="right"><img src="images/SideBannerRegistro.jpg" width="225" height="422" /></div></td>
        <td colspan="3"><div align="right"><span class="Estilo3"> <a href="index.php" class="Estilo3">Regresar a inicio</a></span></div></td>
        </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td width="30">&nbsp;</td>
        <td width="513"><span class="Estilo3">Por favor reg&iacute;strese en nuestro sistema para poder hacer uso de la sistema de e-learning.</span></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td height="381" colspan="2" valign="top"><form action="<?php echo $editFormAction; ?>e&amp;VActivo=activo" method="POST" name="form1" id="form1">
            <label></label>
            <span class="Estilo3">
            <label></label>
            <label></label>
            </span>
            <table width="95%" border="0" align="right" cellpadding="1" class="bordes">
              <tr>
                <th width="25%" valign="middle" class="Estilo3" scope="col"><div align="left"><strong><span class="Estilo5">Nombre</span></strong> y apellidos<span class="Estilo9">*</span></div></th>
                <th colspan="2" scope="col"><div align="left"><span class="Estilo3">
                    <input name="nombres" type="text" class="Estilo3" id="nombres" value="<?php echo $_POST['nombres']; ?>" size="50" />
                </span></div></th>
              </tr>
              
              <tr>
                <th valign="middle" class="Estilo3" scope="col"><div align="left"><strong>E-mail </strong><span class="Estilo9">*</span></div></th>
                <th colspan="2" scope="col"><div align="left"><span class="Estilo3">
                  <input name="Correo" type="text" class="Estilo3" id="Correo" value="<?php echo $_POST['Correo']; ?>" size="50" />
                </span></div></th>
              </tr>
              <tr>
                <th height="19" valign="middle" class="Estilo3" scope="col"><div align="left"><span class="Estilo8">Compa&ntilde;&iacute;a</span><span class="Estilo9">*</span></div></th>
                <th colspan="2" scope="col"><div align="left">
                  <input name="compania" type="text" class="Estilo3" id="compania" value="<?php echo $_POST['compania']; ?>" size="50" />
                </div></th>
              </tr>
              <tr>
                <th height="19" valign="middle" class="Estilo3" scope="col"><div align="left">Empleados<span class="Estilo9">*</span></div></th>
                <th colspan="2" valign="top" class="Estilo3" scope="col"><label>
                  <div align="left">
                    <select name="empleados" class="Estilo3" id="empleados">
                      <option>Seleccione uno</option>
                      <option>hasta 10</option>
                      <option>10 a 50</option>
                      <option>50 a 500</option>
                      <option>500 a 5000</option>
                      <option>Mas de 5000</option>
                    </select>
                    </div>
                </label></th>
              </tr>
              <tr>
                <th height="19" valign="middle" class="Estilo3" scope="col"><div align="left">Segmento<span class="Estilo9">*</span></div></th>
                <th colspan="2" valign="top" class="Estilo3" scope="col"><label>
                  <div align="left">
                    <select name="segmento" class="Estilo3" id="segmento">
                      <option>Seleccione uno</option>
                      <option>consultor</option>
                      <option>Distribuidor/Revendedor</option>
                      <option>Electricista/Independiente</option>
                      <option>Ingenieria</option>
                      <option>Fabricante de máquinas</option>
                      <option>Integrador de Sistemas</option>
                      <option>Instalador</option>
                      <option>Ente educativo</option>
                      <option>Usuario final</option>
                    </select>
                    </div>
                </label></th>
              </tr>
              <tr>
                <th height="19" valign="middle" class="Estilo3" scope="col"><div align="left"><span class="Estilo8">Cargo</span></div></th>
                <th colspan="2" valign="top" class="Estilo3" scope="col"><label>
                  <label>
                  <div align="left" class="Estilo3">
                    <input name="cargo" type="text" class="Estilo3" id="cargo" value="<?php echo $_POST['cargo']; ?>" size="50" />
                  </div>
                  </label>
                  <div align="left"></div>
                  <div align="left"></div>
                  <div align="left"></div>                  </th>
              </tr>
              <tr>
                <th valign="middle" class="Estilo3" scope="col"><div align="left">Telefono</div></th>
                <th colspan="2" scope="col" align="left"><label>
                  <div align="left">
                    <input name="telefono" type="text" class="Estilo3" id="telefono" value="<?php echo $_POST['telefono']; ?>" />
                  </div>
                  </label></th>
              </tr>
              <tr>
                <th valign="middle" class="Estilo3" scope="col"><div align="left"><span class="Estilo8">Pa&iacute;s</span><span class="Estilo9">*</span></div></th>
                <th colspan="2" scope="col"><div align="left">
                  <select name="pais" class="Estilo3" id="pais">
                    <option>Seleccione uno</option>
                    <option>Argentina</option>
                    <option>Bolivia</option>
                    <option>Brasil</option>
                    <option>Colombia</option>
                    <option>Costa Rica</option>
                    <option>Chile</option>
                    <option>Cuba</option>
                    <option>Ecuador</option>
                    <option>Estados Unidos</option>
                    <option>El Salvador</option>
                    <option>Guatemala</option>
                    <option>Honduras</option>
                    <option>Nicaragua</option>
                    <option>Mexico</option>
                    <option>Panama</option>
                    <option>Paraguay</option>
                    <option>Peru</option>
                    <option>Puerto Rico</option>
                    <option>Republica dominicana</option>
                    <option>Uruguay</option>
                    <option>Venezuela</option>
                  </select>
                </div></th>
              </tr>
              <tr>
                <th valign="middle" class="Estilo3" scope="col"><div align="left" class="Estilo7">Usuario<span class="Estilo9">*</span></div></th>
                <th colspan="2" scope="col"><div align="left"><span class="Estilo3">
                    <input name="Nombre" type="text" class="Estilo3" id="Nombre" value="<?php echo $_POST['Nombre']; ?>" />
                </span>
                    <label>
                      <input name="comprobar" type="button" class="Estilo3" id="comprobar" value="comprobar diponibilidad" onclick="javascript:mirar();" />
                    </label>
                </div>
                <div id="apodo" align="left">&nbsp;</div></th>
              </tr>
              <tr>
                <th valign="middle" class="Estilo3" scope="col"><div align="left"><strong>Clave </strong><span class="Estilo9">*</span></div></th>
                <th colspan="2" scope="col"><div align="left"><span class="Estilo3">
                  <input name="Clave" type="password" class="Estilo3" id="Clave" value="<?php echo $_POST['Clave']; ?>" />
                </span></div></th>
              </tr>
              <tr>
                <th valign="middle" class="Estilo3" scope="col">&nbsp;</th>
                <th colspan="2" scope="col"><img src="captcha/captcha_img.php" align="left" /></th>
              </tr>
              <tr>
                <th valign="middle" class="Estilo3" scope="col">ingrese el resultado del cuadro de imagen</th>
                <th colspan="2" scope="col" align="left"><input name="capt" type="text" id="capt" style="width: 80px" />
                <div align="left"><?php
if(!extension_loaded('gd')) echo '<div style="color: red">GD extension is not Loaded!<br /> Please load GD extension in your <b>php.ini</b> file.</div><br />';
?> <span class="errUser"> <?php if($errrorCaptcha =="no"){echo "No coincide el codigo con lo descrito en la imagen";}?></div></th>
              </tr>
				
              <tr>
                <td colspan="3" valign="middle" class="Estilo8">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" valign="middle" class="Estilo8"><label>
                  <input type="checkbox" name="suscrip" id="suscrip" />
                Deseo recibir noticias y promociones de APC en mi correo electrónico</label></td>
              </tr>
              <tr>
                <td colspan="2" valign="middle" class="Estilo8"><div align="left" class="verdana">
                  <input name="activo" type="checkbox" id="activo" value="1" checked="checked" />
                  Acepto pol&iacute;ticas de uso APC</div>
                    <span class="Estilo3">
                    <label></label>
                  </span></td>
                <td width="58%" valign="bottom" class="Estilo3"><a href="#">Ver politicas de uso</a></td>
              </tr>
              
              <tr>
                <td colspan="3" valign="middle" class="Estilo8"><span class="Estilo3"><span class="Estilo1">
                  <input name="enviar" type="submit" class="Estilo3" id="enviar" onclick="MM_validateForm('nombres','','R','Correo','','NisEmail','compania','','R','telefono','','R','Nombre','','R','Clave','','R','capt','','R');return document.MM_returnValue" value="Enviar" />
                  <a href="../index.html">
                  <?php
?>
                  </a></span></span></td>
              </tr>
            </table>
            <div align="right"></div>
            <p class="Estilo3"><span class="Estilo1"><label></label>
              </span>
                <label class="Estilo3"></label><input type="hidden" name="MM_insert" value="form1" />
          </p>
          </form></td>
        <td width="19" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td width="10">&nbsp;</td>
        <td width="229" bgcolor="#CCCCCC">&nbsp;</td>
        <td colspan="3" bgcolor="#CCCCCC"><a href="index.php" class="Estilo3"></a></td>
        </tr>
      <tr>
        <td colspan="5">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
