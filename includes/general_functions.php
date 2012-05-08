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
function getThumbnail($actual_filename)
{
	if(trim($actual_filename)== "")
	{
		$actual_filename = "default.jpg"; 	
	}
	return $actual_filename;
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

//Random String Generator
function genRandomString()
{
    $length = 12;
    $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
    $string = '';    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;
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
	
	if(imagejpeg($nm, 'data/images/' . $filename_thumb,100))
	{
		return $filename_thumb;	
	}else
	{
		die('Error creating thumbnail');
	}
}

/** 
 * Logging class:
 * - contains lfile, lopen, lclose and lwrite methods
 * - lfile sets path and name of log file
 * - lwrite will write message to the log file
 * - lclose closes log file
 * - first call of the lwrite will open log file implicitly
 * - message is written with the following format: hh:mm:ss (script name) message
 */

/*
Copyright (c) 2008-2012, www.redips.net All rights reserved.
Code licensed under the BSD License: http://www.redips.net/license/
*/

class Logging{
	// define default log file
	private $log_file = '../logfile.log';
	// define default newline character
	private $nl = "\n";
	// define file pointer
	private $fp = null;
	// set log file (path and name)
	public function lfile($path) {
		$this->log_file = $path;
	}
	// write message to the log file
	public function lwrite($message) {
		// if file pointer doesn't exist, then open log file
		if (!$this->fp) {
			$this->lopen();
		}
		// define script name
		$script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
		// define current time
		$time = date('H:i:s');
		// write current time, script name and message to the log file
		fwrite($this->fp, "$time ($script_name) $message". $this->nl);
	}
	// close log file (it's always a good idea to close a file when you're done with it)
	public function lclose() {
		fclose($this->fp);
	}
	// open log file
	private function lopen() {
		// define log file path and name
		$lfile = $this->log_file;
		// set newline character to "\r\n" if script is used on Windows
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			$this->nl = "\r\n";
		}
		// define the current date (it will be appended to the log file name)
		$today = date('d-m-Y');
		
		// open log file for writing only; place the file pointer at the end of the file
		// if the file does not exist, attempt to create it
		$this->fp = fopen($lfile . '_' . $today, 'a') or exit("Can't open $lfile!");
	}
}
	
//Gets the user IP address
function getIp()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	{
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	{
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
	
	
//Defines log file format. 
function getLogName($login){
	$logName = $login;
	return $logName;
}

function writeToLog($message)
{	
	$log = new Logging();

	$logName = 'logs/'.getLogName($_SESSION['username']);

	// set path and name of log file
	$log->lfile($logName);	
	// write message to the log file
	$log->lwrite($message);
	// close log file
	$log->lclose();	
}

//Gets admin pin for unique login purposes
function getAdminPin($admin_id){
		$sql_pin = "SELECT pin from administrador where idAdministrador = $admin_id";
		$result_pin = mysql_query($sql_pin) or die('Error :'.mysql_error());
		
		while($row = mysql_fetch_object($result_pin))
		{
		 $pin = $row->pin;
		}
		return $pin;
}

//This function simply checks if the session variable 'valid' is set to 1.
function isLoggedIn()
{
    if($_SESSION['valid']) return true;
    else return false;
}

//user authentication
function auth_user($username,$password)
{
  
  $error = true;
  
	$sql = "SELECT * FROM administrador where Login='".escape_value($username)."'
					AND Clave='".md5(escape_value($password))."'";
	
	$result = mysql_query($sql) or die('Error :'.mysql_error());
	
	if(mysql_num_rows($result) <= 0)
	{
	 $error = true;
	 $_SESSION['valid'] = 0;
	}
	else
	{
		$pin = genRandomString();
		
		while($row = mysql_fetch_object($result))
		{
		 //IF YOU NEED DATA FROM THE USER,
		 //PULL IT FROM HERE, DONT PUT CRAP IN THE CODE.
		 //SESSION VARIABLES WERE INVENTED WITH THIS PURPOSE.
		 $_SESSION['id'] = $row->IdAdministrador;
		 $_SESSION['username'] = $row->Login;
		 $_SESSION['role'] = $row->Rol;
		 $_SESSION['valid'] = 1;
		 $_SESSION['pin'] = $pin;
		}
		$sql_pin = "UPDATE administrador set pin = '$pin' where IdAdministrador = ".$_SESSION['id'];
		$result_pin = mysql_query($sql_pin) or die("Error in query $sql_pin :".mysql_error());
		
    $error = false;
		
		$ip = getIp();
		$message = "The user ".$_SESSION['username']." has arrived via ".$ip;
		
		writeToLog($message);
		
    redirect('viewLive.php');
  }
  return $error;
}
	
?>
