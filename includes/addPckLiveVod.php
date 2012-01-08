<?php
	include("connection.php");
	$pck_id = $_POST['pck_id'];
	parse_str($_POST['data']);
	for ($i = 0; $i < count($sortlist2); $i++) {
		$sql = "INSERT ignore INTO packages_vodchannels
						(package_id,resource_id)
						VALUES ($pck_id,$sortlist2[$i])";
		$rsSet = $DB->execute($sql);
	}
	sleep(1);
?>