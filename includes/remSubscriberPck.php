<?php
	include("connection.php");
	$usr_id = $_POST['usr_id'];
	parse_str($_POST['data']);
	for ($i = 0; $i < count($sortlist); $i++) {
		$str = "delete 	from subscribers_packages
						where 	subscriber_id = $usr_id
						and 		package_id = $sortlist[$i]";
		$rsSet = $DB->execute($str);
	}
	sleep(1);
?>
		
