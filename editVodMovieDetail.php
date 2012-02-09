<?
include("includes/connection.php");
include("session.php");

$id = escape_value($_REQUEST['edit']);

if(trim($id) == "" or !is_numeric($id) or $id == 0)
{
	redirect("viewVod.php");
}

$sql = "SELECT * FROM vodchannels WHERE id = $id";

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
					$thumb = createThumbnail($filename);
				
					//Borrar archivos existentes
					$actual_filename = $getData->fields['big_pic'];
					$actual_filename_thumb = $getData->fields['small_pic'];
					
					unlink($gallery_upload_path.$actual_filename);
					unlink($gallery_upload_path.$actual_filename_thumb);
		
					$sqlUpd = "UPDATE vodchannels SET big_pic = '$filename', small_pic = '$thumb' WHERE id=$id";
					$rsUpd = $DB->Execute($sqlUpd);
				}
			}
		}
	}
	
	$validator = new FormValidator();

	$validator->addValidation("name","req",_("Name is a mandatory field"));
	$validator->addValidation("description","maxlen=100",_("Description shouldn't be longer than 100 characters"));
	$validator->addValidation("description","req",_("Description is a mandatory field"));
	$validator->addValidation("stb_url","req",_("STB URL is a mandatory field"));
	$validator->addValidation("download_url","req",_("Download URL is a mandatory field"));
	$validator->addValidation("pc_url","req",_("PC URL is a mandatory field"));
	$validator->addValidation("local_url","req",_("Local URL is a mandatory field"));
	$validator->addValidation("trainer","req",_("Trainer is a mandatory field"));
	$validator->addValidation("price","req",_("Price is a mandatory field"));
	$validator->addValidation("price","num",_("Price should be a numerical value"));
	$validator->addValidation("date_release","req",_("Release date is a mandatory field"));
	$validator->addValidation("keywords","req",_("Keywords is a mandatory field"));
	
	$postArray = &$_POST ;
	
	$name = escape_value($postArray['name']);
	$description = escape_value($postArray['description']);
	$stb_url = escape_value($postArray['stb_url']);
	$download_url = escape_value($postArray['download_url']);
	$pc_url = escape_value($postArray['pc_url']);
	$local_url = escape_value($postArray['local_url']);
	$trainer = escape_value($postArray['trainer']);
	$date_release = escape_value($postArray['date_release']);
	$keywords = escape_value($postArray['keywords']);
	$rating = escape_value($postArray['rating']);
	$price = escape_value($postArray['price']);
	$currency = escape_value($postArray['currency']);
	
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
		$sql = "UPDATE vodchannels set
						name = '$name',
						description = '$description' ,
						stb_url = '$stb_url',
						download_url = '$download_url',
						pc_url = '$pc_url',
						local_url = '$local_url',
						trainer = '$trainer',
						date_release = '$date_release',
						keywords = '$keywords',
						rating = $rating,
						price = $price,
						currency = $currency
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
			<h2><a href="#"><?=_("Video on demand")?></a> &raquo; <a href="#" class="active"><?=_("Edit VOD movie details")?></a></h2>
			
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
						<label><?=_("Movie Name")?> : </label>
						<input name="name" type="text" value="<?=$getData->fields['name']?>" class="text-long" />
					</p>
					<p>
						<label><?=_("Movie Description")?> : </label>
						<label><textarea name="description" cols="100" /><?=$getData->fields['description']?></textarea></label>
					</p>

					<p>
						<label><?=_("Movie STB URL")?> : </label>
						<input name="stb_url" type="text" value="<?=$getData->fields['stb_url']?>" class="text-long" />
					</p>
					
					<p>
						<label><?=_("Movie Download URL")?> : </label>
						<input name="download_url" type="text" value="<?=$getData->fields['download_url']?>" class="text-long" />
					</p>
										
					<p>
						<label><?=_("Movie PC URL")?> : </label>
						<input name="pc_url" type="text" value="<?=$getData->fields['pc_url']?>" class="text-long" />
					</p>
					
					<p>
						<label><?=_("Movie Local URL")?> : </label>
						<input name="local_url" type="text" maxlength="350"  class="text-long" value="<?=$getData->fields['local_url']?>" />
					</p>	
					
					<p>
						<label><?=_("Movie Director / Trainer")?> : </label>
						<select name="trainer">
						<?php
							$sql="select * from trainers";
							$rsGetTrainers=$DB->execute($sql);
							while(!$rsGetTrainers->EOF){
								?>
									<option value="<?=$rsGetTrainers->fields['id']?>" <? if($rsGetTrainers->fields['id'] == $getData->fields['trainer']) echo "selected='selected'" ?>><?=$rsGetTrainers->fields['name']?></option>
								<?
								$rsGetTrainers->movenext();
							}
						?>
						</select>
					</p>
					<p>
						<label><?=_("Release Date")?> : </label>
						<input type="text" id="date_release" name="date_release" value="<?=$getData->fields['date_release']?>" class="text-medium" />
						<img src="images/calendar.png" id="btn_date_release" alt="" />
						<script type="text/javascript">
						Calendar.setup({
							inputField : "date_release", // ID of the input field
							showsTime: true, // show time
							ifFormat : "%Y/%m/%d %H:%M:%S", // the date format
							button : "btn_date_release" // ID of the button
						})
						</script>
					</p>
					<p>
						<label><?=_("Keywords (Comma Separated)")?> : </label>
						<input name="keywords" type="text" value="<?=$getData->fields['keywords']?>" class="text-long" />
					</p>
					<p>
						<label><?=_("Price")?> : </label>
						<input name="price" type="text" maxlength="150" value="<?=$getData->fields['price']?>" class="text-small" />
					</p>
					<p>
						<label><?=_("Currency")?> : </label>
						<select name="currency">
							<?php
								$sql="select * from currencies";
								$rsGetCurrencies=$DB->execute($sql);
								while(!$rsGetCurrencies->EOF){
									?>
										<option value="<?=$rsGetCurrencies->fields['id']?>" <?php if($getData->fields['currency'] == $rsGetCurrencies->fields['id']) echo "selected='selected'"?>><?=$rsGetCurrencies->fields['code']."-".$rsGetCurrencies->fields['name']?></option>
									<?
									$rsGetCurrencies->movenext();
								}
							?>
						</select>
					</p>
					<p>
						<label><?=_("Rating")?> : </label>
						<select name="rating">
							<?php
								$sql="select * from ratings";
								$rsGetRating=$DB->execute($sql);
								while(!$rsGetRating->EOF){
									?>
										<option value="<?=$rsGetRating->fields['id']?>" <? if($getData->fields['rating'] == $rsGetRating->fields['id']) echo"selected='selected'"?>><?=$rsGetRating->fields['code']."-".$rsGetRating->fields['name']?></option>
									<?
									$rsGetRating->movenext();
								}
							?>
						</select>
					</p>
					<p>
					 	<label><?=_("Resources")?> : </label>
						<a href="uploadFiles.php?id=<?=$id?>" target="_blank"><?=_("Upload / Modify Resources")?></a>
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