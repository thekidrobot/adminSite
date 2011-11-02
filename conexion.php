<?
include_once('Connections/cnxRamp.php');
session_start(); 
$_SESSION["usuarioBD"] = "";
$_SESSION["claveBD"] = "";

// Establecen la conexion con la BD::
$_SESSION["basededatos"] = $database_cnxRamp;
$_SESSION["servidor"] = $hostname_cnxRamp ;
$_SESSION["root"] = $username_cnxRamp;
$_SESSION["claveBD"]=$password_cnxRamp;
?>