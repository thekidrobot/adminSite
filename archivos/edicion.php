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
<?php include("../includes/head.php") ?>
</head>
<body leftmargin="0" topmargin="0" background="" >
    <h3>Editar Informa&ccedil;ao</h3>
		<form method="POST" name="form1" action="<?php echo $editFormAction; ?>" class="jNice">
    <!--<h3>Id_arquivo:<?php echo $row_rsArchivo['id_archivo']; ?></h3>-->
		<fieldset>
			<p>
				<label>Pasta:</label>
				<input name="carpeta" type="text" id="carpeta" value="<?php echo htmlentities($row_rsArchivo['carpeta']); ?>" class="text-long" />				
			</p>
			<p>
				<label>Nombre Arquivo:</label>
				<input name="nombreArchivo" type="text" id="nombreArchivo" value="<?php echo $row_rsArchivo['nombreArchivo']; ?>" class="text-long" maxlength="200" />
			</p>
			<p>
				<label>Titulo:</label>
				<input name="titulo" type="text" value="<?php echo htmlentities($row_rsArchivo['titulo'], ENT_COMPAT, 'utf-8'); ?>" class="text-long" />
			</p>
			<p>
				<label>Descri&ccedil;&atilde;o:</label>
				<textarea name="texto" cols="90" rows="5" wrap="physical"><?php echo htmlentities($row_rsArchivo['texto'], ENT_COMPAT, 'utf-8'); ?></textarea>
			</p>
			<p>
				<label>Professor:</label>
				<input name="speaker" type="text" value="<?php echo htmlentities($row_rsArchivo['speaker'], ENT_COMPAT, 'utf-8'); ?>" class="text-long"></td>
			</p>
			<p>
				<label>Situa&ccedil;&atilde;o:</label>
				<select name="estado" id="estado">
					<option value="1" selected>ativo</option>
					<option value="0">inativo</option>
				</select>
			</p>
			<input type="hidden" name="MM_update" value="form1">
			<input type="hidden" name="id_archivo" value="<?php echo $row_rsArchivo['id_archivo']; ?>">
			<input type="hidden" name="vienede" id="vienede" value="<?php echo $_GET['pagina']; ?>">
			<input type="hidden" name="args" id="args" value="<?php echo $_GET['args']; ?>">
			<input type="submit" class="encabezado" value="Salvar">
    </form>
		</fieldset>
	</body>
</html>
<?php
mysql_free_result($rsArchivo);
?>
