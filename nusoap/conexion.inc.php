<?php
	$server = 'localhost';
	$db_name = 'lfg';
	$db_user = 'root';
	$db_pass = 'root';  
  $conn = mysql_connect($server,$db_user,$db_pass);
  mysql_select_db($db_name,$conn)or die('error');
?>