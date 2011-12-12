<?php
 include("conexion.php");
 $idGrupo = $_GET['id'];

 $sql = "select * from grupos where idGrupos = $idGrupo";
 
 $res = mysql_query($sql) or die(mysql_error($res));
 
 ?>
 <ul>
 <?
 while ($row = mysql_fetch_array($res))
 {
	if($row['padre'] == 0) $dad = "Si";
	else $dad = "No";
	
	echo "<li><b>Categoria Raiz:</b> $dad </li>";
	if($dad == "Si"){
	 echo "<li><b>Hijos : </b></li>";
	 $sql1 = "select * from grupos where padre = $idGrupo";
	 $res1 = mysql_query($sql1) or die(mysql_error($res1));
	 while ($row1 = mysql_fetch_array($res1))
	 {
		echo "<li>".ucfirst(strtolower($row1['grupos']))."</li>";	
	 }
	}
 }
 ?>
 </ul>