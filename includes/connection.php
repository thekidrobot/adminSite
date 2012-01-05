<?php
	$hostname_cnxRamp = "localhost";
	$database_cnxRamp = "lfg";
	$username_cnxRamp = "root";
	$password_cnxRamp = "root";
	
	include('adodb/adodb.inc.php');
	$DB = NewADOConnection('mysql');
	$DB->Connect($hostname_cnxRamp, $username_cnxRamp, $password_cnxRamp, $database_cnxRamp);
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	$DB->debug=true;
?>