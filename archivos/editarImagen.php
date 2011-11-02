<?php require_once('../Connections/cnxRamp.php');?> <?php
if (!isset($_SESSION)) 
  session_start();
  
  
  
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

$archivo="";
if(isset($_POST['arch']))
	$archivo=$_POST['arch'];
elseif(isset($_GET['arch']))
	$archivo=$_GET['arch'];

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) 
{//7
	$subio=true;
	//echo $_FILES['archivo']['tmp_name'] . "sssssssssssssssssss";
	if(isset($_FILES['archivo']['tmp_name']) && $_FILES['archivo']['tmp_name']!="")	
	{//6
		$arch=1;
		  if (is_uploaded_file($_FILES['archivo']['tmp_name'])) 
		  {//5
			if($_FILES['archivo']['size'] < 80000) 
			{//4
				if($_FILES['archivo']['type'] == "image/pjpeg")
					$extension = ".jpg";
				elseif($_FILES['archivo']['type'] == "image/jpeg")
					$extension = ".jpg";								
			  if($_FILES['archivo']['type']=="image/pjpeg" || $_FILES['archivo']['type']=="image/jpeg") 
			  { //3
					if(file_exists ("imagen" . $extension))
						unlink("imagen". $extension);	
				  $subio = copy($_FILES['archivo']['tmp_name'],"imagen". $extension);
				  if($subio==false)
				  {
					$updateGoTo = "erruploadImg.htm";;
					break;
				  }
				  else
				  {
				  	$image = imagecreatefromjpeg('imagen.jpg');
					ob_start();
					imagejpeg($image);
					$jpg = ob_get_contents();
					ob_end_clean();
					$jpg = str_replace('##','##',mysql_escape_string($jpg));
				  }
				}//3
				else
				{
					$subio=false;
					$updateGoTo = "datosokErrenImg.htm";
				}
			}//4
			else
			{
				$subio=false;
				$updateGoTo = "datosokErrImg.htm";
			}
		  }//5
	}//6
	else
	{
		$subio=false;
	}
	
	
	if($subio==true)
	{
		$updateSQL = "UPDATE archivos SET imagen='$jpg'";
		$updateSQL .= " WHERE id_archivo=" . $archivo;
		//echo $updateSQL;
		$Result1 = mysql_query($updateSQL,$conexion) or die(mysql_error());
		$updateGoTo = "editImagen.php?arch=" . $archivo;
		//header(sprintf("Location: %s", $updateGoTo));
	}
	
}//7  
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>:: CUESTIONARIO ::</title>
<script language="JavaScript" src="js.js" type="text/javascript">
</script>
<link href="../INDEX.CSS" rel="stylesheet" type="text/css">
<link href="../css/stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.regresar {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	text-align: center;
	top: auto;
}
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.borde {
	border-top-color: #CCCCCC;
	border-right-color: #CCCCCC;
	border-bottom-color: #CCCCCC;
	border-left-color: #CCCCCC;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-bottom-style: solid;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" background="../imagenes/fondo2.jpg" > 
<table width="100%" height="100%" cellpadding="0" cellspacing="0">

 <tr>
  <td width="104"><img src="../imagenes/spacer.gif" width="1" height="1"></td>
  <td width="16" background="../imagenes/fondo3.jpg"></td>
  <td width="751" bgcolor="white" valign="top">
   <table width="100%" height="100%" cellpadding="0" cellspacing="0">
    <!-- banner superior -->
    <tr>
	 <td class="body-text1" height="120"><img src="../imagenes/titulo.jpg" width="751" height="120"></td> 
	</tr>

    <!-- menu superior -->
    <tr>
	 <td class="body-text1"  height="20" align="right"> 
	  <table width="100%" cellpadding="0" cellspacing="0">
	   <tr>
		<td width="10"><img src="../imagenes/spacer.gif" width="1" height="1"></td>	   
	    <td align="left">
		</td>
	    <td class="body-text1" width="220">
		</td>
	    <td width="10"><img src="../imagenes/spacer.gif" width="1" height="1"></td>
	   </tr>
	  </table>
	 </td>
	</tr>
	

    <!-- zona central -->
    <tr>
	 <td class="body-text1" valign="top" background="../imagenes/fondoPAGINA.jpg">
	  <table cellpadding="5" cellspacing="1" width="100%" height="100%">
	   <tr>
	    <td  height="1"><img src="../imagenes/spacer.gif" width="1" height="1"></td>
	   </tr>
	   <tr>
		<td class="body-text1"  valign="top" align="left">
	      <table>
		   <tr>
		    <td class="body-text1" >
			 <img src="../imagenes/iconos/regresar.png" width="16" height="16">
			</td>
		    <td class="body-text1" >
			 <a href="../menuadmin.php" style="color:red">Menú principal</a>
			</td>
		   </tr>
		  </table>
		  <br>
		  <b>::Editar Imagen</b> 
		  <br>
		  <br>
		  <br>
          <table width="691" border="0">
  
  <tr>
    <td width="1" height="97">&nbsp;</td>
    <td width="680"><table width="680" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th scope="col"><img src="../images/barra_archivos.jpg" width="702" height="39"></th>
      </tr>
      <tr>
        <th scope="col"><table width="716" border="0">
  <tr>
    <td><div align="right"><img src="../volver.jpg" width="9" height="14" align="absbottom" /> <span class="regresar"><a href="listarArchivos.php">Regresar</a></span></div></td>
  </tr>
</table>
<table width="716" border="0" cellpadding="2" cellspacing="2" style="BORDER-RIGHT: #bfdbff 2px solid; BORDER-TOP: #bfdbff 2px solid; BORDER-LEFT: #bfdbff 2px solid; BORDER-BOTTOM: #bfdbff 2px solid">
  
  <tr>
    <td height="28" colspan="3" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center"><img src="imgprod.php?arch=<? echo $archivo; ?>" alt="Imagen del producto" width="70" height="80" border="0" /></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="552"><form action="editImagen.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <input type="hidden" name="MAX_FILE_SIZE" value="100000"/>
      <input name="arch" type="hidden" id="arch" value="<?php echo $_GET['arch']; ?>" />
      <input type="hidden" name="MM_update" value="form1" />
      <input name="archivo" type="file" class="textareas" id="archivo" size="80" />
      <br />
      <br />
      <input type="submit" name="button" id="button" class="botonIngreso2" value="Aceptar" />
      <label></label>
    </form></td>
    <td width="105">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="borde">Seleccione la imagen que desea insertar haciendo click en <strong>Examinar</strong>. Recuerde que debe mantener un formato y un tamaño que permita una buena visualización. Luego haga click en <strong>Aceptar. </strong>Si usted ve que la imagen se ha cargado exitosamente puede hacer click en <strong>regresar.</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="35">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table></th>
      </tr>
      <tr>
        <th scope="col">&nbsp;</th>
      </tr>
      
      <tr>
        <th scope="col"><div class="Cuerpo2">
            <div align="center"></div>
        </div></th>
      </tr>
      
    </table></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="fondo">&nbsp;</td>
  </tr>
</table></td>
	   </tr>
	   <tr>
	    <td  height="10"><img src="../imagenes/spacer.gif" width="1" height="1"></td>
	   </tr>
	  </table>
	 </td>
	</tr>
	<!-- footer -->
    <tr>
	 <td  background="../imagenes/seccion.jpg" class="body-text1" height="20" align="center">
	 </td>
	</tr>
   </table>
  </td>
  <td width="13" background="../imagenes/fondo4.jpg">
  </td>
  <td><img src="../imagenes/spacer.gif" width="1" height="1"></td>
 </tr>
 <tr>
  <td colspan="5" height="50"><img src="../imagenes/spacer.gif" width="1" height="1"></td>
 </tr>
</table>
</body>
</html>

