<?php require_once('../Connections/cnxRamp.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO mensajes_grupo (ID_GRUPO, MENSAJE, FECHA_VENCIMIENTO) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['ID_GRUPO'], "int"),
                       GetSQLValueString($_POST['MENSAJE'], "text"),
                       GetSQLValueString($_POST['fecha_hora'], "date"));

  mysql_select_db($database_cnxRamp, $cnxRamp);
  $Result1 = mysql_query($insertSQL, $cnxRamp) or die(mysql_error());

  $insertGoTo = "../admGrupos.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" src="../js.js" type="text/javascript"></script>
<script language="javascript" src="../ajax/ajaxupload.js"></script>  
<script language="javascript" src="../ajax/jquery1.4.2.js"></script>
<script language="javascript" src="../ajax/jquery_datepicker.js"></script>
<script language="javascript" src="../ajax/date.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script language="javascript">  
window.onload = (function(){
try{
  $(document).ready(function() {
    $('.date-pick').datePicker();
	$('.date-pick').datePicker({clickInput:true});

  });
$('#hora').change(function() {
	var hora =  this.value 
	fecha();
	});
 $('#minuto').change(function() {
	var hora =  this.value 
	fecha();
	});
$('#fecha').change(function() {
	var hora =  this.value 
	fecha();
	});
}catch(e){}});
function fecha()
{
	var fecha=document.getElementById('fecha').value;
	var hora = document.getElementById('hora').value;
	fecha = fecha + ' ' + hora + ':' + '00' + ':00';
	document.getElementById('fecha_hora').value = fecha;
}

</script>
<title>Documento sin título</title>
<style type="text/css">
<!--
#apDiv1 {
	position:absolute;
	left:14px;
	top:93px;
	width:579px;
	height:206px;
	z-index:1;
}
-->
</style>
<link href="../css/stilos.css" rel="stylesheet" type="text/css" />
<link href="../css/stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../galeria/css/galeria.css" rel="stylesheet" type="text/css">
<link href="../css/datepicker.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="apDiv1">
  <form id="form1" name="form1" method="post" action="">
  </form>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
    <table align="center" class="contform">
      <tr valign="baseline">
        <td colspan="3" align="right" nowrap="nowrap" class="TituloAzul"><span class="TilGrilla">Ingrese un mensaje al grupo:<?php echo $_GET['nombreGrupo']; ?></span></td>
      </tr>
      <tr valign="baseline">
        <td width="117" align="right" nowrap="nowrap"><span class="Subtitulo">MENSAJE:</span></td>
        <td colspan="2"><textarea name="MENSAJE" cols="100" class="textareas"></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">fecha Vence</td>
        <td width="158"><input type="text" class="date-pick" id="fecha" name="fecha" /></td>
        <td width="357">hora vencimiento<span class="descripcion">
          <select name="hora" id="hora">
            <option value="00">00</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
          </select>
          <input name="fecha_hora" type="text" id="fecha_hora" />
        </span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><input name="ID_GRUPO" type="hidden" id="ID_GRUPO" value="<?php echo $_GET['ID_GRUPO']; ?>" size="32" /></td>
        <td colspan="2"><input type="submit" class="botonfiltro" value="Insertar registro" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form2" />
  </form>
  <p>&nbsp;</p>
</div>
<table width="949" border="0" cellpadding="0">
  <tr>
    <th width="12" scope="col"><img src="../imagenes/flecha.jpg" alt="" width="12" height="26" /></th>
    <td width="931" class="borde_arriba_abajo" scope="col"><div align="left">&nbsp;&nbsp;Enviar Mensaje a un grupo</div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>