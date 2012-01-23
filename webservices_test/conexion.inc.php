<?php
	$server = 'localhost';
	$db_name = 'rampmood_ws_test';
	$db_user = 'rampmood_wsuser';
	$db_pass = 'sP-~,0hQ8dP='; 
  $conn = mysql_connect($server,$db_user,$db_pass);
  mysql_select_db($db_name,$conn)or die('error');
?>