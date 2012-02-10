<?php
	$hostname_cnxRamp = "localhost";
	$database_cnxRamp = "lfg";
	$username_cnxRamp = "root";
	$password_cnxRamp = "root";
	
	//$hostname_cnxRamp = "localhost";
	//$database_cnxRamp = "rampmood_lfg";
	//$username_cnxRamp = "rampmood_wsuser";
	//$password_cnxRamp = "sP-~,0hQ8dP=";
	
	include (dirname(__FILE__) . DIRECTORY_SEPARATOR.'adodb/toexport.inc.php');
	include (dirname(__FILE__) . DIRECTORY_SEPARATOR.'adodb/adodb.inc.php');
	$DB = NewADOConnection('mysql');
	$DB->Connect($hostname_cnxRamp, $username_cnxRamp, $password_cnxRamp, $database_cnxRamp);
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	$DB->debug=true;
?>