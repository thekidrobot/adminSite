<?php

require_once('../Connections/cnxRamp.php');
include("../session.php");
include("../includes/general_functions.php");

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
$large_image_location = "../data/images/";
$gallery_upload_path = "../data/images/";
$max_width = 300;
$max_height = 410;
$error = '';

$userfile_name = $_FILES['image']['name'];
$userfile_tmp = $_FILES['image']['tmp_name'];
$userfile_size = $_FILES['image']['size'];
$filename = basename($userfile_name);

$file_ext = substr($filename, strrpos($filename, '.') + 1);	
//remove the ext
$filename_strip= substr($filename,0,strrpos($filename, '.'));	
//Only process if the file is a JPG and below the allowed limit
	if((!empty($_FILES["image"]['name'])) && ($_FILES['image']['error'] == 0))
	{
		if (($file_ext!="jpg"))
		{
			$error= _("Only JPG images are accepted for uploading");
		}
	
		//Everything is ok, so we can upload the image.
		if (strlen($error)==0)
		{
			if (isset($_FILES['image']['name']))
			{
				$filename =$filename_strip."_big".".".$file_ext;

				if(is_file($gallery_upload_path.$filename))
				{
					while (file_exists($gallery_upload_path.$filename))
					{
						$filename_strip .= rand(100, 999);
						$filename =$filename_strip."_big".".".$file_ext;
					}
				}

				$large_image_location = $gallery_upload_path .$filename;
				move_uploaded_file($userfile_tmp, $large_image_location);
				chmod($large_image_location, 0777);
						
				$width = getWidth($large_image_location);
				$height = getHeight($large_image_location);
				
				//Scale the image if it is greater than the width set above
				if (($width > $max_width) or ($height > $max_height))
				{
					$uploaded = resizeImage($large_image_location,$max_width,$max_height);
				}
				
				createThumbnail($filename);
			}
		}
	}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1"))
{
	$insertSQL = sprintf("INSERT INTO archivos
											 (carpeta, nombreArchivo, texto, titulo, cant_descarga,
											 imagen, speaker, estado, archivo1, archivo2, archivo3,
											 TIPO_TRANSMISION, FECHA_HORA_TRANSMISION,tema,fechaLanzamiento)
											 VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
											 GetSQLValueString($_POST['carpeta'], "text"),
											 GetSQLValueString($_POST['nombreArchivo'], "text"),
											 GetSQLValueString($_POST['texto'], "text"),
											 GetSQLValueString($_POST['titulo'], "text"),
											 GetSQLValueString($_POST['cant'], "double"),
											 GetSQLValueString($filename, "text"),
											 GetSQLValueString($_POST['speaker'], "text"),
											 GetSQLValueString($_POST['estado'], "int"),
											 GetSQLValueString($_POST['archivo1'], "text"),
											 GetSQLValueString($_POST['archivo2'], "text"),
											 GetSQLValueString($_POST['archivo3'], "text"),
											 GetSQLValueString($_POST['tipoTrans'], "text"),
											 GetSQLValueString($_POST['fecha_hora'], "date"),
											 GetSQLValueString($_POST['subject'], "text"),
											 GetSQLValueString($_POST['fechaRelease'], "text"));
	
	echo $insertSQL;
	
	$Result1 = mysql_query($insertSQL) or die(mysql_error());

	$insertGoTo = "listarArchivos.php";
	if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	}
	header(sprintf("Location: %s", $insertGoTo));
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RAMP</title>

<!-- CSS -->
<!-- Horrible workaround for the calendar-->
<link href="../style/css/transdmin-tableless.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="../style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="../style/css/ie7.css" /><![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-blue.css" />

<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>

</head>

<body>
  <h3><?=_("Add video file to the catalog")?></h3>
	<form method="post" name="form1" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>" class="jNice">
	<fieldset>
		<p>
			<label><?=_("Folder")?> : </label>
			<input name="carpeta" type="text" id="carpeta" value="" maxlength="150" class="text-long">
		</p>
    <p>
			<label><?=_("Filename")?> : </label>
			<input name="nombreArchivo" type="text" id="titulo2" maxlength="200" class="text-long">
		</p>
    <p>
			<label><?=_("Title")?> : </label>
			<input name="titulo" type="text" id="titulo3" maxlength="200" class="text-long">
		</p>
		<p>
			<label><?=_("Description")?> : </label>
			<label><textarea name="texto" cols="100" id="texto"></textarea></label>
		</p>
		<p>
			<label><?=_("Trainer")?> : </label>
			<input name="speaker" type="text" value="" class="text-long">
		</p>
		<p>
			<label><?=_("Subject")?> : </label>
			<input name="subject" type="text" value="" class="text-long">
		</p>
		<p>
			<label><?=_("Status")?> : </label>
			<select name="estado">
				<option value="1"><?=_("Active")?></option>
				<option value="2"><?=_("Inactive")?></option>
			</select>
		</p>
		<p>
			<label><?=_("Upload an image") ?></label>
			<input type="file" name="image" size="23" />
		</p>
		<p>
			<label><?=_("Release Date")?> : </label>
			<input type="text" name="fechaRelease" id="fechaRelease" class="text-medium" />
			<img src="images/calendar.png" id="csv1_fecha_descarga" alt="" style="cursor:pointer;cursor:hand;" />
			<script type="text/javascript">
			Calendar.setup({
				inputField : "fechaRelease", // ID of the input field
				showsTime: true, // show time
				ifFormat : "%Y/%m/%d %H:%M:%S", // the date format
				button : "csv1_fecha_descarga" // ID of the button
			})
			</script>
		</p>	
		<input type="hidden" name="cant" id="cant">      
		<input type="hidden" name="MM_insert" value="form1">
		<input type="submit" onClick="MM_validateForm('texto','','R');return document.MM_returnValue" value="<?=_("Add Video")?>">
		</fieldset>
  </form>
</body>
</html>