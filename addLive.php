<?
include("Connections/cnxRamp.php");
include("session.php");

$editFormAction = $_SERVER['PHP_SELF'];
$large_image_location = "data/images/";
$gallery_upload_path = "data/images/";
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
	
	$Result1 = mysql_query($insertSQL) or die(mysql_error());

	$insertGoTo = "viewLive.php";
	if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	}
	if (!headers_sent()) header('Location: viewLive.php');
	else echo '<meta http-equiv="refresh" content="0;url="viewLive.php" />';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include ("includes/head.php") ?>
<body>
 <div id="wrapper">
  <h1><a href="menuadmin.php"></a></h1>
	<?php include("includes/mainnav.php") ?>
	<!-- // #end mainNav -->
	<div id="containerHolder">
	 <div id="container">
		<div id="sidebar">
		 <?php include("includes/sidenav.php") ?>
		</div>    
		<!-- // #sidebar -->
		<!-- h2 stays for breadcrumbs -->
		<!--<h2><a href="#">Dashboard</a> &raquo; <a href="#" class="active">Print resources</a></h2>
		<h2>&nbsp;</h2>-->
    
		<div id="main">
			<h2><?=_("Add video file to the catalog")?></h2>
			<form method="post" name="form1" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>" class="jNice">
			<fieldset>
			<p>
				<label><?=_("Upload a logo (300x410px)") ?></label>
				<input type="file" name="image" size="23" />
			</p>
			<p>
				<label><?=_("Channel Name")?> : </label>
				<input name="titulo" type="text" id="titulo3" maxlength="200" class="text-long">
			</p>
			<p>
				<label><?=_("Channel URL")?> : </label>
				<input name="carpeta" type="text" id="carpeta" value="" maxlength="150" class="text-long">
			</p>
			<p>
				<label><?=_("Channel Filename")?> : </label>
				<input name="nombreArchivo" type="text" id="titulo2" maxlength="200" class="text-long">
			</p>
			<p>
				<label><?=_("Channel Description")?> : </label>
				<label><textarea name="texto" cols="100" id="texto"></textarea></label>
			</p>
			<p>
				<label><?=_("Trainer")?> : </label>
				<input name="speaker" type="text" value="" class="text-long">
			</p>
			<p>
				<label><?=_("Tags")?> : </label>
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
			<input type="submit" value="<?=_("Add Video")?>">
			</fieldset>
			</form>	
		 
			 </div><!-- // #main -->
      <div class="clear"></div>
      </div><!-- // #container -->
    </div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>