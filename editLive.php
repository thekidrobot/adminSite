<?
include("includes/connection.php");
include("session.php");

$id = escape_value($_GET['edit']);
$sql = "SELECT * FROM livechannels WHERE id = $id";
$getData = $DB->Execute($sql);

if($_POST["MM_update"] == "true")
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
					createThumbnail($filename);
				
					//Borrar archivos existentes
					$actual_filename = $getData->fields['pic'];
					
					$file_ext = substr($actual_filename, strrpos($actual_filename, '.') + 1);	 //remove the ext
					$filename_strip= substr($actual_filename,0,strrpos($actual_filename, '.')); 
					$filename_strip= substr($actual_filename,0,strrpos($actual_filename, '_big')); //remove the _big
					$filename_strip= $filename_strip."_small"; //add the _small
			
					$actual_filename_thumb = $filename_strip.".".$file_ext;
		
					$sqlUpd = "UPDATE livechannels SET pic = '$filename' WHERE id=$id";
					$rsUpd = $DB->Execute($sqlUpd);
			
					unlink($gallery_upload_path.$actual_filename);
					unlink($gallery_upload_path.$actual_filename_thumb);
				}
			}
		}
	}

	$postArray = &$_POST ;

	$name = escape_value($postArray['name']);
	$number = escape_value($postArray['number']);
	$description = escape_value($postArray['description']);
	$url = escape_value($postArray['url']);
	$price = escape_value($postArray['price']);
	$rating = escape_value($postArray['rating']);
	$currency = escape_value($postArray['currency']);
	
	$insertSql = "UPDATE livechannels SET
								name = '$name',
								number = $number,
								description = '$description',
								url = '$url',
								price = $price,
								rating = '$rating',
								currency = '$currency' 
								WHERE id = $id";
	
	$rsInsLive = $DB->Execute($insertSql);

	redirect($currentPage."?edit=".$id);
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
			<div id="main">
			<h2><a href="#"><?=_("Live TV")?></a> &raquo; <a href="#" class="active"><?=_("Edit Channel Information")?></a></h2>
			<form method="POST" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>" class="jNice">
				<fieldset>
				<p>
					<label><?=_("Actual Logo")?> : </label>
					<?php
					
						$actual_filename = $getData->fields['pic'];
						$actual_filename_thumb = getThumbnail($actual_filename);
												
						if(trim($actual_filename_thumb == "_small.")){
							$actual_filename_thumb = "default.jpg";
						}
					
					?>
					<img src="<?="data/images/".$actual_filename_thumb?>">
				</p>
				<p>
					<label><?=_("Upload a logo (300x410px)") ?></label>
					<input name="pic" type="file" size="23" />
				</p>
				<p>
					<label><?=_("Channel Name")?> : </label>
					<input value="<?=$getData->fields['name']?>" name="name" type="text" maxlength="200" class="text-long" />
				</p>
				<p>
					<label><?=_("Channel Number")?> : </label>
					<input value="<?=$getData->fields['number']?>"  name="number" type="text" maxlength="150" class="text-long" />
				</p>
				<p>
					<label><?=_("Channel Description")?> : </label>
					<label><textarea name="description" cols="100" /><?=$getData->fields['description']?></textarea></label>
				</p>
				<p>
					<label><?=_("Channel URL")?> : </label>
					<input value="<?=$getData->fields['url']?>"  name="url" type="text" maxlength="350"  class="text-long" />
				</p>
				<p>
					<label><?=_("Price")?> : </label>
					<input value="<?=$getData->fields['price']?>"  name="price" type="text" maxlength="150"  value="0" class="text-long" />
				</p>
				<p>
				 <label><?=_("Currency")?> : </label>
					<select name="currency">
					 <?php
						$sql="select * from currencies";
				 		$rsGet=$DB->execute($sql);
						while(!$rsGet->EOF){
						?>
						 <option value="<?=$rsGet->fields['id']?>" <? if ($getData->fields['currency'] == $rsGet->fields['id']) echo "selected='selected'" ?>><?=$rsGet->fields['code']."-".$rsGet->fields['name']?></option>
						 <?
						 $rsGet->movenext();
						}
						?>
					 <select>
					</p>
					<p>
					 <label><?=_("Rating")?> : </label>
					 <select name="rating">
					  <?php
					  $sql="select * from ratings";
					  $rsGet=$DB->execute($sql);
					  while(!$rsGet->EOF){
					   ?>
						 <option value="<?=$rsGet->fields['id']?>" <? if ($getData->fields['rating'] == $rsGet->fields['id']) echo "selected='selected'" ?>><?=$rsGet->fields['code']."-".$rsGet->fields['name']?></option>
					   <?
					   $rsGet->movenext();
						}
					 ?>
					<select>
				</p>
				<p>
					<label>&nbsp;</label>
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