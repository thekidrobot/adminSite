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
 
?>