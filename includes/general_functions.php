<?

//Get the current page name
function getCurrentPage(){
	$file = $_SERVER["PHP_SELF"];
	$break = Explode('/', $file);
	$currentPage = $break[count($break) - 1];
  return $currentPage;
}


//Build the top menu
function make_kids($row_id,$dad_name,$parent)
{
	$sql = mysql_query("SELECT * FROM vodcategories WHERE parent = $row_id");

	if (mysql_num_rows($sql) > 0)
	{
		while ($row = mysql_fetch_array($sql))
		{
			$selected = '';
			if($parent == $row['id']) $selected = "selected='selected'";
			?>
				<option value="<?=$row['id'] ?>" <?=$selected ?>>
					<?=ucfirst(strtolower($dad_name))." - ".ucfirst(strtolower($row['name']))?>
				</option>
			<?php
			//Welcome Mr. Cobb
			make_kids($row['id'],$dad_name." - ".$row['name'],$row['parent']);
		}
	}
}	

//Get thumbnail of an already created picture
function getThumbnail($actual_filename){
 $file_ext = substr($actual_filename, strrpos($actual_filename, '.') + 1);	
 $filename_strip= substr($actual_filename,0,strrpos($actual_filename, '.'));	//remove the ext
 $filename_strip= substr($actual_filename,0,strrpos($actual_filename, '_big')); //remove the _big
 $filename_strip= $filename_strip."_small";	//add the _small
 $actual_filename_thumb = $filename_strip.".".$file_ext;
 return $actual_filename_thumb; 
}


//Safely escape values. Please use in your SQL queries. 
function escape_value($value)
{
  if(function_exists('mysql_real_escape_string'))
  {
    if(get_magic_quotes_gpc())
    { 
      $value = stripslashes($value); 
		}
		$value = mysql_real_escape_string($value);
	}
  else
  {
    if(!get_magic_quotes_gpc())
    { 
      $value = addslashes($value); 
    }
  }
  return $value;
}

//Safely Redirects
function redirect($filename)
{
	if (!headers_sent()) header('Location: '.$filename);
	else echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
}

/*******Functions for graphic processing************/

//You do not need to alter these functions
function resizeImage($image,$width,$height) {
	$newImageWidth = $width;
	$newImageHeight = $height;
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	$source = imagecreatefromjpeg($image);
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	imagejpeg($newImage,$image,90);
	chmod($image, 0777);
	return $image;
}

//You do not need to alter these functions
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	$source = imagecreatefromjpeg($image);
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
	imagejpeg($newImage,$thumb_image_name,90);
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}

function resizeThumbnailImage1($thumb_image_name, $image, $width, $height){
	$source_width=getWidth($image);
	$source_height=getHeight($image);
	$scale=$source_width/$source_width;
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	$source = imagecreatefromjpeg($image);
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$source_width,$source_height);
	imagejpeg($newImage,$thumb_image_name,90);
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}

//You do not need to alter these functions
function getHeight($image) {
	$sizes = getimagesize($image);
	$height = $sizes[1];
	return $height;
}

//You do not need to alter these functions
function getWidth($image) {
	$sizes = getimagesize($image);
	$width = $sizes[0];
	return $width;
}

	function createThumbnail($filename) {

		if(preg_match('/[.](jpg)$/', $filename)) {
			$im = imagecreatefromjpeg('data/images/' . $filename);
		} else if (preg_match('/[.](gif)$/', $filename)) {
			$im = imagecreatefromgif('data/images/' . $filename);
		} else if (preg_match('/[.](png)$/', $filename)) {
			$im = imagecreatefrompng('data/images/' . $filename);
		}
		
		$ox = imagesx($im);
		$oy = imagesy($im);
		
		$nx = 99;
		$ny = 140;
		
		$nm = imagecreatetruecolor($nx, $ny);
		
		imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
	
		$file_ext = substr($filename, strrpos($filename, '.') + 1);	
		//remove the ext
		$filename_strip= substr($filename,0,strrpos($filename, '.'));	
		//remove the _big
		$filename_strip= substr($filename,0,strrpos($filename, '_big'));
		//add the _small
		$filename_strip= $filename_strip."_small";	
		
		$filename_thumb = $filename_strip.".".$file_ext;
		
		chmod($filename_thumb, 0777);
		
		if(imagejpeg($nm, 'data/images/' . $filename_thumb,100)){
			return true;	
		}else{
			die('Error creating thumbnail');
		}
	}
?>
