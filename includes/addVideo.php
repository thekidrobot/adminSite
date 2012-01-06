<?php
	include("connection.php");
	$cat_id = $_POST['cat_id'];
  parse_str($_POST['data']);
  for ($i = 0; $i < count($sortlist2); $i++)
	{
		$sql = "INSERT IGNORE INTO vod_channels_categories
						(channel_id,category_id)
						VALUES($sortlist2[$i],$cat_id)";
		$rsSet = $DB->execute($sql);
  }
  sleep(1);
?>
		
