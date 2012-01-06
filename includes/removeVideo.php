<?php
	include("connection.php");
	$cat_id = $_POST['cat_id'];
  parse_str($_POST['data']);
  for ($i = 0; $i < count($sortlist); $i++) {
		$str = "delete from vod_channels_categories where category_id = $cat_id and channel_id = $sortlist[$i]";
		$rsSet = $DB->execute($str);
  }
  sleep(1);
?>
		
