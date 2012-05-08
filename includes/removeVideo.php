<?php
	include("connection.php");
  include("general_functions.php");
	
	session_start();	
	
	$cat_id = $_POST['cat_id'];
  parse_str($_POST['data']);
  for ($i = 0; $i < count($sortlist); $i++)
	{
		$sql = "SELECT * from vodchannels where id = ". $sortlist[$i];
		$rsGet = $DB->execute($sql);
		
		$sql_1 = "SELECT * from vodcategories where id = $cat_id";
		$rsGet_1 = $DB->execute($sql_1);

		$str = "delete from vod_channels_categories where category_id = $cat_id and channel_id = $sortlist[$i]";
		$rsSet = $DB->execute($str);
		
		$message = "The user ".$_SESSION['username']." has removed the channel '".$rsGet->fields['name']."' with ID ".$sortlist[$i]." from the category '".$rsGet_1->fields['name']."' with ID ".$cat_id;

	  $log = new Logging();

    $logName = '../logs/'.getLogName($_SESSION['username']);

    // set path and name of log file
    $log->lfile($logName);	
    // write message to the log file
    $log->lwrite($message);
    // close log file
    $log->lclose();	
		
  }
  sleep(1);
?>
		
