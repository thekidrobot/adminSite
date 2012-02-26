<?php 

//EVERY FUNCTION HERE SHOULD BE COMMENTED.

// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('UTC');

// Shows the name of the script in execution, used by menus and custom scripts
$file = $_SERVER["SCRIPT_NAME"];
$break = Explode('/', $file);
$curr_page = $break[count($break) - 1];

//Sets name of the website, used for page titles.
$website_name = "Welcome to Ramp";


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

//This function simply checks if the session variable 'valid' is set to 1. - for SUBSCRIBER
function isLoggedIn()
{
    if($_SESSION['valid']) return true;
    else return false;
}

//Random Password Generator
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

//Safely Redirects
function redirect($filename)
{
	if (!headers_sent()) header('Location: '.$filename);
	else echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
}

//user authentication
function auth_user($username,$password)
{
  
  $error = true;
  
	$sql = "SELECT * FROM subscribers where username='".escape_value($username)."'
					AND password='".md5(escape_value($password))."'";
	
	$result = mysql_query($sql) or die('Error :'.mysql_error());
	
	if(mysql_num_rows($result) <= 0)
	{
	 $error = true;
	 $_SESSION['valid'] = 0;
	}
	else
	{
		while($row = mysql_fetch_object($result))
		{
		 //IF YOU NEED DATA FROM THE USER,
		 //PULL IT FROM HERE, DONT PUT CRAP IN THE CODE.
		 //SESSION VARIABLES WERE INVENTED WITH THIS PURPOSE.
		 $_SESSION['id'] = $row->id;
		 $_SESSION['name'] = $row->name;
		 $_SESSION['username'] = $row->username;
		 $_SESSION['address'] = $row->address;
		 $_SESSION['email'] = $row->email;
		 $_SESSION['account'] = $row->account;
		 $_SESSION['phone'] = $row->phone;
		 $_SESSION['country'] = $row->country;
		 $_SESSION['city'] = $row->city;
		 $_SESSION['zip'] = $row->zip;
		 $_SESSION['valid'] = 1;
		}
    $error = false;
    redirect('home.php');
  }
  return $error;
}

//Generic function to send mails
//TODO : Make this function even safer
function sendemail($to,$subject,$msg)
{
  $mailcheck = spamcheck($to);
  
  if ($mailcheck==FALSE){
    echo "Invalid email format";
  }
  else
	{
	  $headers='Content-type: text/html; charset=iso-8859-1'."\r\n";
    $headers.='From:'. $email_admin ."\r\n";

    mail( $to, $subject, $msg, $headers );
  }
}


function spamcheck($field)
{
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);

  if(filter_var($field, FILTER_VALIDATE_EMAIL))
  {
    return TRUE;
  }
  else
  {
    return FALSE;
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

//Build categories recursively
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
				<option value="<?=$row['id'] ?>" <?=$selected ?>><?=ucfirst(strtolower($dad_name))." - ".ucfirst(strtolower($row['name']))?></option>
			<?php
			//Welcome Mr. Cobb
			make_kids($row['id'],$dad_name." - ".$row['name'],$row['parent']);
		}
	}
}	

?>