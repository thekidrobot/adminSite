<?php
	include("connection.php");
	$pck_id = $_POST['pck_id'];
	parse_str($_POST['data']);
	for ($i = 0; $i < count($sortlist); $i++)
	{
		$str = "delete from packages_vodchannels
						where package_id = $pck_id
						and resource_id = $sortlist[$i]";
		$rsSet = $DB->execute($str);
	}
	sleep(1);
?>