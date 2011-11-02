<?php require_once('../Connections/cnxRamp.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE archivos SET carpeta=%s, nombreArchivo=%s, texto=%s, titulo=%s, cant_descarga=%s, imagen=%s, speaker=%s, estado=%s, TIPO_TRANSMISION=%s, FECHA_HORA_TRANSMISION=%s WHERE id_archivo=%s",
                       GetSQLValueString($_POST['carpeta'], "text"),
                       GetSQLValueString($_POST['nombreArchivo'], "text"),
                       GetSQLValueString($_POST['texto'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['cant_descarga'], "double"),
                       GetSQLValueString($_POST['Mylogo'], "text"),
                       GetSQLValueString($_POST['speaker'], "text"),
                       GetSQLValueString($_POST['estado'], "int"),
                       GetSQLValueString($_POST['tipoTrans'], "text"),
                       GetSQLValueString($_POST['fecha_hora'], "date"),
                       GetSQLValueString($_POST['id_archivo'], "int"));

  mysql_select_db($database_cnxRamp, $cnxRamp);
  $Result1 = mysql_query($updateSQL, $cnxRamp) or die(mysql_error());
}

  $updateGoTo = trim($_POST['vienede']);
  if ($updateGoTo <> "" ) {
	$updateGoTo .= ".php?" . $_POST['args'];
	header(sprintf("Location: %s", $updateGoTo));
  }
  




$colname_rsArchivo = "-1";
if (isset($_GET['id_archivo'])) {
  $colname_rsArchivo = $_GET['id_archivo'];
}
mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsArchivo = sprintf("SELECT * FROM archivos WHERE id_archivo = %s", GetSQLValueString($colname_rsArchivo, "int"));
$rsArchivo = mysql_query($query_rsArchivo, $cnxRamp) or die(mysql_error());
$row_rsArchivo = mysql_fetch_assoc($rsArchivo);
$totalRows_rsArchivo = mysql_num_rows($rsArchivo);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>:: CUESTIONARIO ::</title>
<script language="JavaScript" src="js.js" type="text/javascript"></script>
<script language="javascript" src="../ajax/ajaxupload.js"></script>  
<script language="javascript" src="../ajax/jquery1.4.2.js"></script>
<script language="javascript" src="../ajax/jquery_datepicker.js"></script>
<script language="javascript" src="../ajax/date.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script language="javascript">  
$(document).ready(function(){  
     var button = $('#upload_button'), interval;  
     new AjaxUpload('#upload_button', {  
         action: 'upload.php',  
         onSubmit : function(file , ext){  
		 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){  
			alert('Error: Solo se permiten imagenes');  
             // cancela upload  
             return false;  
			 } else {  
				 button.text('Uploading');  
				 this.disable();  
			 }  
         },  
         onComplete: function(file, response){  
         button.text('Upload');  
         // enable upload button  
         this.enable();            
         $('#photo').html('<img src="../speakers/'+file+'">');  
             $('#Mylogo').val('../speakers/'+file);  
         }     
     });  
});  
window.onload = (function(){
try{
  $(document).ready(function() {
    $('.date-pick').datePicker();
	$('.date-pick').datePicker({clickInput:true});

  });
  
$('#linkarriba').click(function() {
	var currentText = $("#datepicker").datepicker("getDate");
	var altFormat = $("#datepicker").datepicker( "option", "altFormat" );
	alert(altFormat + ' ' + currentText );							  
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
	var minuto = document.getElementById('minuto').value;
	//guarda el formato en tipo timestamp compatible con mysql	
	fecha = fecha + ' ' + hora + ':' + minuto + ':00';
	document.getElementById('fecha_hora').value = fecha;
}
</script>


<link href="../INDEX.CSS" rel="stylesheet" type="text/css">
<link href="../css/stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../galeria/css/galeria.css" rel="stylesheet" type="text/css">
<link href="../css/datepicker.css" rel="stylesheet" type="text/css">
<!--<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>-->

<style type="text/css">
<!--
body {
	background-color: #CCC;
}
-->
</style></head>
<body leftmargin="0" topmargin="0" background="" >
<table width="780" border="0" align="left" cellpadding="0" cellspacing="0">
  
  <tr>
    <th scope="col"><img src="../newImages/titulo_edit.jpg" width="768" height="52"></th>
  </tr>
  <tr>
    <th width="780" scope="col"><form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
        <br>
        <table width="700" align="center" cellspacing="0" class="borde_alrededor">
            
            <tr valign="baseline">
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr valign="baseline">
              <td width="12" align="right" nowrap class="descripcion">&nbsp;</td>
              <td width="102" align="right" valign="middle" nowrap class="descripcion">Id_arquivo:</td>
              <td width="158" class="Estilo1"><div align="left" class="trebuchet"><?php echo $row_rsArchivo['id_archivo']; ?></div></td>
              <td width="418">&nbsp;</td>
            </tr>
            <tr valign="baseline">
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td align="right" valign="middle" nowrap class="descripcion">Pasta</td>
              <td colspan="2" class="descripcion"><div align="left">
                <input name="carpeta" type="text" class="descripcion" id="carpeta" value="<?php echo htmlentities($row_rsArchivo['carpeta']); ?>" size="90">
              </div></td>
            </tr>
            <tr valign="baseline">
              <td align="right" valign="top" nowrap class="descripcion">&nbsp;</td>
              <td align="right" valign="middle" nowrap class="descripcion">Nombre Arquivo</td>
              <td colspan="2" class="descripcion"><label>
                <input name="nombreArchivo" type="text" class="descripcion" id="nombreArchivo" value="<?php echo $row_rsArchivo['nombreArchivo']; ?>" size="90" maxlength="200">
              </label></td>
            </tr>
            <tr valign="baseline">
              <td align="right" valign="top" nowrap class="descripcion">&nbsp;</td>
              <td align="right" valign="middle" nowrap class="descripcion">Titulo:</td>
              <td colspan="2" class="descripcion"><div align="left">
                <input name="titulo" type="text" class="descripcion" value="<?php echo htmlentities($row_rsArchivo['titulo'], ENT_COMPAT, 'utf-8'); ?>" size="90">
              </div></td>
            </tr>
            <tr valign="baseline">
              <td align="right" valign="top" nowrap class="descripcion">&nbsp;</td>
              <td align="right" valign="top" nowrap class="descripcion">Descri&ccedil;&atilde;o:</td>
              <td colspan="2" class="descripcion"><div align="left">
                <textarea name="texto" cols="90" rows="5" wrap="physical" class="descripcion"><?php echo htmlentities($row_rsArchivo['texto'], ENT_COMPAT, 'utf-8'); ?></textarea>
              </div></td>
            </tr>
            
            <tr valign="baseline">
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td align="right" valign="middle" nowrap class="descripcion">Professor:</td>
              <td colspan="2" align="left" class="descripcion"><input name="speaker" type="text" class="descripcion" value="<?php echo htmlentities($row_rsArchivo['speaker'], ENT_COMPAT, 'utf-8'); ?>" size="90"></td>
            </tr>
            <tr valign="baseline">
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td align="right" valign="middle" nowrap class="descripcion">Situa&ccedil;&atilde;o:</td>
              <td colspan="2" align="left" class="descripcion"><select name="estado" class="descripcion" id="estado">
                <option value="1" selected>ativo</option>
                <option value="0">inativo</option>
              </select></td>
            </tr>
            <tr valign="baseline">
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td colspan="2" class="descripcion"><div align="left">
                <!--<input name="cant_descarga" type="text" class="descripcion" value="<?php echo htmlentities($row_rsArchivo['cant_descarga'], ENT_COMPAT, 'utf-8'); ?>" size="6">-->
              </div></td>
            </tr>
            
            <tr valign="baseline">
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr valign="baseline">
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td colspan="2"><div align="left">
                <input type="submit" class="encabezado" value="Salvar">
              </div></td>
            </tr>
            <tr valign="baseline">
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td align="right" nowrap class="descripcion">&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
          </table>
          <br>
<input type="hidden" name="MM_update" value="form1">
          <input type="hidden" name="id_archivo" value="<?php echo $row_rsArchivo['id_archivo']; ?>">
        <input type="hidden" name="vienede" id="vienede" value="<?php echo $_GET['pagina']; ?>">
        <input type="hidden" name="args" id="args" value="<?php echo $_GET['args']; ?>">
    </form>
    <p>&nbsp;</p></th>
  </tr>
  <tr>
    <th scope="col"><div class="Cuerpo2">
      <div align="center"></div>
    </div></th>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rsArchivo);
?>
