<?
include("includes/connection.php");
include("session.php");

$id = escape_value($_REQUEST['edit']);

if(trim($id) == "" or !is_numeric($id) or $id == 0)
{
	redirect("viewTrainers.php");
}

$sql = "SELECT * FROM trainers WHERE id = $id";

$getData = $DB->Execute($sql);

if($_POST["MM_update"] == "true")
{
	$validator = new FormValidator();

	$validator->addValidation("name","req",_("Name is a mandatory field"));
	$validator->addValidation("description","maxlen=100",_("Description shouldn't be longer than 100 characters"));
	$validator->addValidation("description","req",_("Description is a mandatory field"));
	
	$postArray = &$_POST ;
	
	$name = escape_value($postArray['name']);
	$description = escape_value($postArray['description']);
	
	if(!$validator->ValidateForm())
	{
		$error_hash = $validator->GetErrors();
		foreach($error_hash as $inpname => $inp_err)
		{
			$err .= $inp_err."</br>";
		}
	}
	else
	{		

		$large_image_location = "data/images/";
		$gallery_upload_path = "data/images/";
		$max_width = 300;
		$max_height = 410;
		$error = '';
			
		$userfile_name = $_FILES['pic']['name'];
		$userfile_tmp = $_FILES['pic']['tmp_name'];
		$userfile_size = $_FILES['pic']['size'];
		$filename = basename($userfile_name);
		
		if (trim($filename) != "")
		{
			$file_ext = substr($filename, strrpos($filename, '.') + 1);	 //remove the ext
			$filename_strip= substr($filename,0,strrpos($filename, '.'));	
			//Only process if the file is a JPG and below the allowed limit
			if((!empty($_FILES['pic']['name'])) && ($_FILES['pic']['error'] == 0))
			{
				if (($file_ext!="jpg"))
				{
					$error= _("Only JPG images are accepted for uploading");
				}
				
				//If is ok we can upload the image.
				if (strlen($error)==0)
				{
					if (isset($_FILES['pic']['name']))
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
						$thumb = createThumbnail($filename);
					
						//Borrar archivos existentes
						$actual_filename = $getData->fields['big_pic'];
						$actual_filename_thumb = $getData->fields['small_pic'];
						
						unlink($gallery_upload_path.$actual_filename);
						unlink($gallery_upload_path.$actual_filename_thumb);
			
						$sqlUpd = "UPDATE trainers SET big_pic = '$filename', small_pic = '$thumb' WHERE id=$id";
						$rsUpd = $DB->Execute($sqlUpd);
					}
				}
			}
		}

		$sql = "UPDATE trainers set
						name = '$name',
						description = '$description'
						where id = $id";
		
		$rsSet = $DB->Execute($sql);
	
		redirect($currentPage."?edit=".$id);
	}
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
		<div id="main">
			<h2><a href="#"><?=_("Trainers")?></a> &raquo; <a href="#" class="active"><?=_("Edit trainer details")?></a></h2>
			
			<?php
			if(trim($err) != ""){
			?>
				<p>
					<h3><?=_("Please correct the following errors: ")?></h3>
					<div class="err"><?=$err?></div>
				</p>						
			<?
			}
			?>
			
			<form method="post" enctype="multipart/form-data" action="<?php echo $currentPage; ?>" class="jNice">
				<fieldset>
					<p>
						<label><?=_("Actual Logo")?> : </label>
						<?php						
							$actual_filename = $getData->fields['small_pic'];
							$actual_filename_thumb = getThumbnail($actual_filename);
						?>
						<img src="<?="data/images/".$actual_filename_thumb?>">
					</p>
					<p>
						<label><?=_("Upload a logo (300x410px)") ?></label>
						<input name="pic" type="file" size="23" />
					</p>
					<p>
						<label><?=_("Trainer Name")?> : </label>
						<input name="name" type="text" value="<?=$getData->fields['name']?>" class="text-long" />
					</p>
					<p>
						<label><?=_("Trainer Description")?> : </label>
						<label><textarea name="description" cols="100" /><?=$getData->fields['description']?></textarea></label>
					</p>
					<p>
						<label>&nbsp;</label>
						<input type="hidden" name="edit" value="<?=$id?>">
						<input type="hidden" name="MM_update" value="true">
						<input type="submit" value="<?=_("Update")?>">
					</p>
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