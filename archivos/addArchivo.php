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
<html>
<?php include("../includes/head.php") ?>
<body>
  <h3>Adicionar arquivo de video ao cat&aacute;logo</h3>
	<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
	<fieldset>
		<p>
			<label>Pasta: </label>
			<input name="carpeta" type="text" id="carpeta" value="" maxlength="150">
		</p>
    <p>
			<label>Nome do Arquivo: </label>
			<input name="nombreArchivo" type="text" id="titulo2" maxlength="200">
		</p>
    <p>
			<label>T&iacute;tulo</label>
			<input name="titulo" type="text" class="descripcion" id="titulo3" maxlength="200">
		</p>
		<p>
			Descri&ccedil;&atilde;o
			<label><textarea name="texto" cols="100" class="descripcion" id="texto"></textarea></label>
		</p>
		<p>
			<label>Professor</label>
			<input name="speaker" type="text" class="descripcion" value="">
		</p>
		<p>
			<label>Situa&ccedil;&atilde;o:</label>
			<select name="estado" class="descripcion" id="estado">
				<option value="1">ativo</option>
				<option value="2">inativo</option>
			</select>
		</p>
		<input type="hidden" name="cant" id="cant">      
		<input type="hidden" name="MM_insert" value="form1">
		<input type="submit" onClick="MM_validateForm('texto','','R');return document.MM_returnValue" value="Adicionar Video">
		</fieldset>
  </form>
</body>
</html>

