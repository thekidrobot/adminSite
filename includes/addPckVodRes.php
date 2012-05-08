<?php
	include("connection.php");
	include("general_functions.php");
  session_start();	

	$pck_id = $_POST['pck_id'];
	parse_str($_POST['data']);
	for ($i = 0; $i < count($sortlist2); $i++) {
		$sql = "INSERT ignore INTO packages_vodchannels
						(package_id,resource_id)
						VALUES ($pck_id,$sortlist2[$i])";
		$rsSet = $DB->execute($sql);

		$sql = "SELECT * from vodchannels where id = ". $sortlist2[$i];
		$rsGet = $DB->execute($sql);

		$sql_1 = "SELECT * from packages where id = $pck_id";
		$rsGet_1 = $DB->execute($sql_1);

		$message = "The user ".$_SESSION['username']." has added the VOD channel '".$rsGet->fields['name']."' with ID ".$sortlist2[$i]." to the package '".$rsGet_1->fields['name']."' with ID ".$pck_id.".";
		
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