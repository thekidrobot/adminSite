<?php require_once('Connections/cnxRamp.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$colname_rsPass = "-1";
if (isset($_POST['mail'])) {
  $colname_rsPass = $_POST['mail'];
}
mysql_select_db($database_cnxRamp, $cnxRamp);
$query_rsPass = sprintf("SELECT * FROM usuarios WHERE mail = %s", GetSQLValueString($colname_rsPass, "text"));
$rsPass = mysql_query($query_rsPass, $cnxRamp) or die(mysql_error());
$row_rsPass = mysql_fetch_assoc($rsPass);
$totalRows_rsPass = mysql_num_rows($rsPass);

$mensaje="";
if($colname_rsPass!="-1")
	{
	mail($row_rsPass['mail'],"Serviço de envio de password","Seu usuário é: ". $row_rsPass['Usuario'],"Su password es: " . $row_rsPass['Password']);
	$mensaje = "Mensage enviado ao seu e-mail";
	}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>:::::LFG:::::</title>
<script src="" type="text/javascript"></script>
<link href="../galeria/css/galeria.css" rel="stylesheet" type="text/css">
<link href="galeria/css/galeria.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="840" border="0" align="center" cellpadding="0">
  <tr>
    <th colspan="3" scope="col"><img src="imagenes/topo.jpg" width="900" height="174" border="0" usemap="#Map">
      <map name="Map">
        <area shape="rect" coords="414,146,501,160" href="requrimientos.php">
        <area shape="rect" coords="351,143,397,160" href="index.php">
        <area shape="rect" coords="512,145,600,160" href="como_funciona.php">
        <area shape="rect" coords="613,145,664,161" href="suporte.php">
        <area shape="rect" coords="687,145,717,159" href="http://www.lfg.com.br" target="_blank">
      </map></th>
  </tr>
  <tr>
    <th width="24" scope="col">&nbsp;</th>
    <th width="782" scope="col">&nbsp;</th>
    <th width="30" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
    <td align="center" scope="col"><p>&nbsp;</p>
<p>
  <?php
if($mensaje=="")
{
	?></p>
<form name="form1" method="post" action="">
  <label>
  <div align="center"><span class="tahoma_12">Preencha com o e-mail registrado e clique em enviar. No seu e-mail chegará um password registrado</span><span class="tahoma"><br>
    </span><br>
    <input type="text" name="mail" id="mail">
  </div>
  </label> 
  <label>
  <input type="submit" name="aceptar" id="aceptar" value="Enviar">
	  </label>
  <div align="center"></div>
  <div align="center"></div>
  <div align="center"></div>
</form>
    <p align="center">
      <?php
	}
	else
	{
		echo $mensaje;
	}
	?>
    </p>
    <p align="center" class="tahomaLight"><a href="index.php" class="texto_12">Voltar ao início</a> </p></td>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#EBE9ED"><div align="center"><span class="requerimientos">&copy; Copyright 2009 LFG. all rights reserved. Powered   by <a href="http://www.ramprm.com" target="_blank">RAMP, LLC</a></span></div></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rsPass);
?>
