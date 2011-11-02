<?php
if (!isset($_SESSION)) {
  session_start();
}
require_once('../Connections/cnxRamp.php');
//require_once('imgprod.php');


function verImagen($arch,$db,$lnk)
{
//$arch = $_GET['arch'];
// Configurar las dos lineas siguientes
mysql_select_db($db, $lnk);
$query = "SELECT imagen  FROM archivos WHERE id_archivo = $arch";
$result = mysql_query($query);
$imagen = mysql_result($result,0);
return $imagen;
}  
  
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
			if($_FILES['archivo']['size'] < 10000000) 
			{//4
				if($_FILES['archivo']['type'] == "image/pjpeg")
					$extension = ".jpg";
				elseif($_FILES['archivo']['type'] == "image/jpeg")
					$extension = ".jpg";								
			  if($_FILES['archivo']['type']=="image/pjpeg" || $_FILES['archivo']['type']=="image/jpeg") 
			  { //3
					if(file_exists ("../speakers/". $archivo . "_imagen" . $extension))
						unlink("../speakers/". $archivo . "_imagen" . $extension);	
				  $subio = copy($_FILES['archivo']['tmp_name'],"../speakers/". $archivo . "_imagen" . $extension);
				  if($subio==false)
				  {
					$updateGoTo = "erruploadImg.htm";;
					break;
				  }
				  //else
				  //{
				  	
				  //}
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
		$updateSQL = "UPDATE archivos SET imagen='../speakers/". $archivo . "_imagen" . $extension . "'";
		$updateSQL .= " WHERE id_archivo=" . $archivo;
		//echo $updateSQL;
		mysql_select_db($database_cnxRamp, $cnxRamp);
		$Result1 = mysql_query($updateSQL,$cnxRamp) or die(mysql_error());
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
<link href="file:../css/stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.borde {	border-top-color: #CCCCCC;
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
<link href="../galeria/css/galeria.css" rel="stylesheet" type="text/css">
<link href="../css/stilos.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" background="" >
<table width="949" border="0" cellpadding="0">
  <tr>
    <th width="12" scope="col"><img src="../imagenes/flecha.jpg" alt="" width="12" height="26"></th>
    <td width="931" class="borde_arriba_abajo" scope="col"><div align="left">&nbsp;&nbsp;<a href="listarArchivos.php">Ver Arquivos</a>&nbsp;&nbsp;  |&nbsp;&nbsp; <a href="addArchivo.php">Adicionar Videos</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a href="buscarArchivos.php">Buscar Videos</a></div></td>
  </tr>
</table>
<br>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="borde_alrededor" >
  <tr>
    <td height="28" colspan="5" align="center" bgcolor="#FFFFFF"><div align="right" class="encabezado">
      <div align="left" class="fondo_encabezado">Editar im&Atilde;&iexcl;genes</div>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="82" align="right"><img src="<? echo verImagen($archivo,$database_cnxRamp, $cnxRamp); ?>" alt="Imagen del producto" width="70" height="80" border="0" /></td>
    <td width="11">&nbsp;</td>
    <td width="496"><form action="editImagen.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <div align="left">
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
        <input name="arch" type="hidden" id="arch" value="<?php echo $_GET['arch']; ?>" />
        <input type="hidden" name="MM_update" value="form1" />
        <input name="archivo" type="file" class="textareas" id="archivo" size="80" />
        <br />
        <br />
        <input type="submit" name="button" id="button" class="encabezado" value="Aceptar" />
      </div>
      <label></label>
    </form></td>
    <td width="5">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="4">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
<div align="left"></div>
</body>
</html>

