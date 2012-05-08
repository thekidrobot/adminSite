<?php
  include('includes/general_functions.php');
	
	session_start();
	
	$message = "The user ".$_SESSION['username']." has logged out";
	writeToLog($message);
	
	session_unset();
	session_destroy();
	redirect('index.php');
?>