<?php
 include("conexion.php");
 $idUsuario = $_GET['id'];

 $sql = "select g.grupos as grupos
				 from 	grupos_usuario ga, grupos g
				 where 	g.idGrupos = ga.IdGrupos
				 and 		ga.IdUsuario = $idUsuario";
 
 $res = mysql_query($sql) or die(mysql_error($res));
 
 ?>
 <ul>
 <?
 while ($row = mysql_fetch_array($res))
 {
	echo "<li>".ucfirst(strtolower($row['grupos']))."</li>";
 }
 ?>
 </ul>