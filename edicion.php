<?
include("Connections/cnxRamp.php");
include("session.php");

$colname_rsArchivo = "-1";
if ($_REQUEST['id_archivo']) {
  $colname_rsArchivo = $_REQUEST['id_archivo'];
}
$query_rsArchivo = sprintf("SELECT * FROM archivos WHERE id_archivo = %s", GetSQLValueString($colname_rsArchivo, "int"));

$rsArchivo = mysql_query($query_rsArchivo) or die(mysql_error());
$row_rsArchivo = mysql_fetch_assoc($rsArchivo);
$totalRows_rsArchivo = mysql_num_rows($rsArchivo);

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

	if (trim($filename) != "")
	{

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

		//Borrar archivos existentes
		$actual_filename = $row_rsArchivo['imagen'];
		
		$file_ext = substr($actual_filename, strrpos($actual_filename, '.') + 1);	
		//remove the ext
		$filename_strip= substr($actual_filename,0,strrpos($actual_filename, '.'));	
		//remove the _big
		$filename_strip= substr($actual_filename,0,strrpos($actual_filename, '_big'));
		//add the _small
		$filename_strip= $filename_strip."_small";	
		
		
		$actual_filename_thumb = $filename_strip.".".$file_ext;

		$updateSQL_img = sprintf("UPDATE archivos SET imagen='%s' WHERE id_archivo=%s",
                       $filename,
											 GetSQLValueString($_POST['id_archivo'], "text"));

		$Result_img = mysql_query($updateSQL_img) or die("Error: ".mysql_error());
		
		unlink($gallery_upload_path.$actual_filename);
		unlink($gallery_upload_path.$actual_filename_thumb);
		
	}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1"))
{
  $updateSQL = sprintf("UPDATE archivos SET carpeta=%s, nombreArchivo=%s, texto=%s,
											 titulo=%s, cant_descarga=%s, speaker=%s, estado=%s,
											 TIPO_TRANSMISION=%s, FECHA_HORA_TRANSMISION=%s, tema=%s,
											 fechaLanzamiento=%s WHERE id_archivo=%s",
                       GetSQLValueString($_POST['carpeta'], "text"),
                       GetSQLValueString($_POST['nombreArchivo'], "text"),
                       GetSQLValueString($_POST['texto'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['cant_descarga'], "double"),
                       GetSQLValueString($_POST['speaker'], "text"),
                       GetSQLValueString($_POST['estado'], "int"),
                       GetSQLValueString($_POST['tipoTrans'], "text"),
                       GetSQLValueString($_POST['fecha_hora'], "date"),
											 GetSQLValueString($_POST['subject'], "text"),
											 GetSQLValueString($_POST['fechaRelease'], "text"),
                       GetSQLValueString($_POST['id_archivo'], "int"));
	
  $Result1 = mysql_query($updateSQL) or die(mysql_error());
	if (!headers_sent()) header('Location: listarArchivos.php');
	else echo '<meta http-equiv="refresh" content="0;url="listarArchivos.php" />';

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
	
			<h2><?=_("Edit Information")?></h2>
			<form method="POST" name="form1" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>" class="jNice">
			<fieldset>
				<p>
					<label><?=_("Image")?> : </label>
					<?php
					
						//Borrar archivos existentes
						$actual_filename = $row_rsArchivo['imagen'];
						
						$file_ext = substr($actual_filename, strrpos($actual_filename, '.') + 1);	
						//remove the ext
						$filename_strip= substr($actual_filename,0,strrpos($actual_filename, '.'));	
						//remove the _big
						$filename_strip= substr($actual_filename,0,strrpos($actual_filename, '_big'));
						//add the _small
						$filename_strip= $filename_strip."_small";	
						
						
						$actual_filename_thumb = $filename_strip.".".$file_ext;
					
					?>
					<img src="<?="../data/images/".$actual_filename_thumb?>">
				</p>
				<p>
					<label><?=_("Folder")?> : </label>
					<input name="carpeta" type="text" id="carpeta" value="<?php echo htmlentities($row_rsArchivo['carpeta']); ?>" class="text-long" />				
				</p>
				<p>
					<label><?=_("Filename")?> : </label>
					<input name="nombreArchivo" type="text" id="nombreArchivo" value="<?php echo $row_rsArchivo['nombreArchivo']; ?>" class="text-long" maxlength="200" />
				</p>
				<p>
					<label><?=_("Title")?> : </label>
					<input name="titulo" type="text" value="<?php echo htmlentities($row_rsArchivo['titulo'], ENT_COMPAT, 'utf-8'); ?>" class="text-long" />
				</p>
				<p>
					<label><?=_("Description")?> : </label>
					<textarea name="texto" cols="90" rows="5" wrap="physical"><?php echo htmlentities($row_rsArchivo['texto'], ENT_COMPAT, 'utf-8'); ?></textarea>
				</p>
				<p>
					<label><?=_("Subject")?> : </label>
					<input name="subject" type="text" value="<?=$row_rsArchivo['tema']?>" class="text-long" />
				</p>
				<p>
					<label><?=_("Status")?> : </label>
					<select name="estado" id="estado">
						<option value="1" selected><?=_("Active")?></option>
						<option value="0"><?=_("Inactive")?></option>
					</select>
				</p>
				<p>
					<label><?=_("Upload an image") ?></label>
					<input type="file" name="image" size="20" />
				</p>
				<p>
					<label><?=_("Release Date")?> : </label>
					<input type="text" name="fechaRelease" id="fechaRelease" class="text-medium" value="<?= $row_rsArchivo['fechaLanzamiento'] ?>" />
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
						
				<input type="hidden" name="MM_update" value="form1">
				<input type="hidden" name="id_archivo" value="<?php echo $row_rsArchivo['id_archivo']; ?>">
				<input type="hidden" name="args" id="args" value="<?php echo $_GET['args']; ?>">
				<input type="submit" value="<?=_("Save")?>">
			</form>
			</fieldset>

			 </div><!-- // #main -->
      <div class="clear"></div>
      </div><!-- // #container -->
    </div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>