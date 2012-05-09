<?php

//Multilanguage

//$language=(isset($_REQUEST['language']))?trim(strip_tags($_REQUEST['language'])):"es_CO.utf8";
$language=(isset($_REQUEST['language']))?trim(strip_tags($_REQUEST['language'])):"en_GB.utf8";
putenv("LC_ALL=$language");
setlocale(LC_ALL, $language);
bindtextdomain("messages", "./locale");
textdomain("messages");


//print "<p><a href=\"".$_SERVER['PHP_SELF']."?language=en_GB\">English</a> -
//  <a href=\"".$_SERVER['PHP_SELF']."?language=es_ES\">Español</a></p>\n";

session_start();
 
include("includes/general_functions.php");
include("includes/formvalidator.php");

$currentPage = getCurrentPage();

//Not logged in
$logged = isLoggedIn();
if ($logged == false or $_SESSION['username'] == "") redirect('logout.php');

//Double login
$dbPin = getAdminPin($_SESSION['id']);
if($dbPin !== $_SESSION['pin']) redirect('logout.php');

//Superadmin verification.
$role = 0;
$role = getRole($_SESSION['id'],$_SESSION['role']);

$message = "The user ".$_SESSION['username']." has opened the page.";
writeToLog($message);

?>