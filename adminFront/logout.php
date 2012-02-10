<?php
  include('includes/general_functions.php');
	session_start();
	session_unset();
	session_destroy();
	redirect('index.php');
?>