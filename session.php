<?php

//Translation Libraries
//$language=(isset($_REQUEST['language']))?trim(strip_tags($_REQUEST['language'])):"es_CO.utf8";
$language=(isset($_REQUEST['language']))?trim(strip_tags($_REQUEST['language'])):"en_GB.utf8";
putenv("LC_ALL=$language");
setlocale(LC_ALL, $language);
bindtextdomain("messages", "./locale");
textdomain("messages");


//print "<p><a href=\"".$_SERVER['PHP_SELF']."?language=en_GB\">English</a> -
//  <a href=\"".$_SERVER['PHP_SELF']."?language=es_ES\">Español</a></p>\n";

session_start();

//validar sesion
if($_SESSION["usuario"]=="")
{
 if (!headers_sent()) header('Location: index.php');
 else echo '<meta http-equiv="refresh" content="0;url="index.php" />';
}
 
//Pagina actual, para los menus
function getCurrentPage(){
	$file = $_SERVER["PHP_SELF"];
	$break = Explode('/', $file);
	$currentPage = $break[count($break) - 1];
  return $currentPage;
}

$currentPage = getCurrentPage();


include("includes/general_functions.php");

if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
		if (PHP_VERSION < 6) {
			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		}
	
		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
	
		switch ($theType) {
			case "text":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
				break;    
			case "long":
			case "int":
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
				break;
			case "double":
				$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
				break;
			case "date":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
				break;
			case "defined":
				$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
				break;
		}
		return $theValue;
	}
}

?>