<?
include("includes/connection.php");
include("session.php");

if ($_POST["MM_insert"] == "true")
{
	$validator = new FormValidator();

	$validator->addValidation("name","req",_("Name is a mandatory field"));
	$validator->addValidation("description","maxlen=100",_("Description shouldn't be longer than 100 characters"));
	$validator->addValidation("description","req",_("Description is a mandatory field"));
	
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
		
		$file_ext = substr($filename, strrpos($filename, '.') + 1);	 //remove the ext
		$filename_strip= substr($filename,0,strrpos($filename, '.'));
		
		//Only process if the file is a JPG and below the allowed limit
		if((!empty($_FILES['pic']['name'])) && ($_FILES['pic']['error'] == 0))
		{
			if (($file_ext!="jpg"))
			{
				$error= _("Only JPG images are accepted for uploading");
			}
			
			//If is ok, so we can upload the image.
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
				}
			}
		}

		$postArray = &$_POST ;
		
		$big_pic = escape_value($filename);
		$small_pic = escape_value($thumb);
		$name = escape_value($postArray['name']);
		$description = escape_value($postArray['description']);


		$insertSql = "INSERT INTO trainers
									(small_pic,big_pic,name,description)
									VALUES ('$small_pic','$big_pic','$name','$description')";
		
		$rsInsVod = $DB->Execute($insertSql);
		
		redirect("viewTrainers.php");
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
			<h2><a href="#"><?=_("Trainers")?></a> &raquo; <a href="#" class="active"><?=_("Add a trainer")?></a></h2>
		
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
						<label><?=_("Upload a profile pic (300x410px)") ?></label>
						<input name="pic" type="file" size="23" />
					</p>
					<p>
						<label><?=_("Trainer Name")?> : </label>
						<input name="name" value="<?=$_POST['name']?>" type="text" maxlength="200" class="text-long" />
					</p>
					<p>
						<label><?=_("Trainer Description")?> : </label>
						<label><textarea name="description" cols="100" /><?=$_POST['description']?></textarea></label>
					</p>
					<p>
						<label>&nbsp;</label>
						<input type="hidden" name="MM_insert" value="true" />
						<input type="submit" value="<?=_("Add Trainer")?>" />
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