<?php
	include("connection.php");
	include("general_functions.php");
	session_start();
	
	$pck_id = $_POST['pck_id'];
	parse_str($_POST['data']);
	for ($i = 0; $i < count($sortlist); $i++)
	{
		$str = "delete from packages_livechannels
						where package_id = $pck_id
						and resource_id = $sortlist[$i]";
						
		$rsSet = $DB->execute($str);
		
		$sql = "SELECT * from livechannels where id = ". $sortlist[$i];
		$rsGet = $DB->execute($sql);

		$sql_1 = "SELECT * from packages where id = $pck_id";
		$rsGet_1 = $DB->execute($sql_1);

		$message = "The user ".$_SESSION['username']." has removed the live channel '".$rsGet->fields['name']."' with ID ".$sortlist[$i]." from the package '".$rsGet_1->fields['name']."' with ID ".$pck_id.".";
		
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