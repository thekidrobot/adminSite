<?php
	include("connection.php");
	$usr_id = $_POST['usr_id'];
	parse_str($_POST['data']);
	for ($i = 0; $i < count($sortlist2); $i++)
	{
		$str = "INSERT 	ignore
						INTO 		subscribers_packages(subscriber_id,package_id)
						VALUES 	($usr_id,$sortlist2[$i])";
		$rsSet = $DB->execute($str);
	}
	sleep(1);
?>
		
