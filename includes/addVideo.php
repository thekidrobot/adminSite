<?php
	include("connection.php");
	include("general_functions.php");

  session_start();


	$cat_id = $_POST['cat_id'];
  parse_str($_POST['data']);
  for ($i = 0; $i < count($sortlist2); $i++)
	{
		$sql = "INSERT IGNORE INTO vod_channels_categories
						(channel_id,category_id)
						VALUES($sortlist2[$i],$cat_id)";
						
		$rsSet = $DB->execute($sql);

		$sql = "SELECT * from vodchannels where id = ". $sortlist2[$i];
		$rsGet = $DB->execute($sql);
		
		$sql_1 = "SELECT * from vodcategories where id = $cat_id";
		$rsGet_1 = $DB->execute($sql_1);

		$message = "The user ".$_SESSION['username']." has added the channel '".$rsGet->fields['name']."' with ID ".$sortlist2[$i]." to the category '".$rsGet_1->fields['name']."' with ID ".$cat_id;
		
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
		
