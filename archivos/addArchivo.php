<?php require_once('../Connections/cnxRamp.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
if($_SESSION["usuario"]=="")
 {
  ?>
<script language="javascript">
  document.location="../index.php";
  </script>
  <?
 }
 
?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO archivos (carpeta, nombreArchivo, texto, titulo, cant_descarga, imagen, speaker, estado, archivo1, archivo2, archivo3, TIPO_TRANSMISION, FECHA_HORA_TRANSMISION) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['carpeta'], "text"),
                       GetSQLValueString($_POST['nombreArchivo'], "text"),
                       GetSQLValueString($_POST['texto'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['cant'], "double"),
                       GetSQLValueString($_POST['Mylogo'], "text"),
                       GetSQLValueString($_POST['speaker'], "text"),
                       GetSQLValueString($_POST['estado'], "int"),
                       GetSQLValueString($_POST['archivo1'], "text"),
                       GetSQLValueString($_POST['archivo2'], "text"),
                       GetSQLValueString($_POST['archivo3'], "text"),
                       GetSQLValueString($_POST['tipoTrans'], "text"),
                       GetSQLValueString($_POST['fecha_hora'], "date"));

  mysql_select_db($database_cnxRamp, $cnxRamp);
  $Result1 = mysql_query($insertSQL, $cnxRamp) or die(mysql_error());

  $insertGoTo = "listarArchivos.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
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
<table width="767" border="0" align="left" cellpadding="0" cellspacing="0">
  
  
  <tr>
    <th width="767" colspan="2" align="left" scope="col"><img src="../newImages/titulo_addfile.jpg" width="768" height="52"></th>
  </tr>
  <tr>
    <th colspan="2" align="left" scope="col"><form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <p>&nbsp;</p>
      <table width="651" align="center" cellspacing="0" class="borde_alrededor">
        
        <tr valign="baseline">
          <td width="8" align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td width="82" align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td colspan="3" align="left" bgcolor="#CCCCCC">&nbsp;</td>
          <td width="20" align="left" bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">Pasta</td>
          <td colspan="3" align="left" bgcolor="#CCCCCC"><input name="carpeta" type="text" class="descripcion" id="carpeta" value="" size="100" maxlength="150"></td>
          <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">Nome do Arquivo</td>
          <td colspan="3" align="left" bgcolor="#CCCCCC"><label>
            <input name="nombreArchivo" type="text" class="descripcion" id="titulo2" size="100" maxlength="200">
            </label></td>
          <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">T&iacute;tulo</td>
          <td colspan="3" align="left" bgcolor="#CCCCCC"><input name="titulo" type="text" class="descripcion" id="titulo3" size="100" maxlength="200"></td>
          <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td align="right" valign="top" nowrap bgcolor="#CCCCCC" class="descripcion">Descri&ccedil;&atilde;o</td>
          <td colspan="3" align="left" bgcolor="#CCCCCC"><textarea name="texto" cols="100" class="descripcion" id="texto"></textarea></td>
          <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
        </tr>
        
        
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">Professor</td>
          <td colspan="3" align="left" bgcolor="#CCCCCC"><input name="speaker" type="text" class="descripcion" value="" size="100">
            <input type="hidden" name="cant" id="cant"></td>
          <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td align="right" valign="middle" nowrap bgcolor="#CCCCCC" class="descripcion">Situa&ccedil;&atilde;o:</td>
          <td colspan="3" align="left" valign="middle" bgcolor="#CCCCCC"><p>
            <label>
              <select name="estado" class="descripcion" id="estado">
                <option value="1">ativo</option>
                <option value="2">inativo</option>
                </select>
              </label>
            </p></td>
          <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td align="right" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td colspan="3" align="left" bgcolor="#CCCCCC">&nbsp;</td>
          <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td align="right" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td colspan="3" align="left" bgcolor="#CCCCCC"><input type="submit" class="encabezado" onClick="MM_validateForm('texto','','R');return document.MM_returnValue" value="Adicionar Video"></td>
          <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td align="right" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td colspan="3" align="left" bgcolor="#CCCCCC"><label></label></td>
          <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
        <tr valign="baseline">
          <td align="right" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td align="right" nowrap bgcolor="#CCCCCC" class="descripcion">&nbsp;</td>
          <td colspan="3" align="left" bgcolor="#CCCCCC">&nbsp;</td>
          <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
      </table>
        <input type="hidden" name="MM_insert" value="form1">
      </form></th>
  </tr>
</table>
</body>
</html>

