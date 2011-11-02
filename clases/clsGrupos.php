<?php
//funciones de manejo de grupos
class clsGrupos
{
	function verificarSubgrupos($IdGrupo)
	{
		//funciona para contar cuantos subgripos tiene este grupo
		$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
		mysql_select_db($_SESSION["basededatos"], $link); 
		$sql="SELECT Count(grupos.idGrupos) AS Cuenta  FROM grupos WHERE (((grupos.padre)=" . $IdGrupo . "))";
		$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result))
		{
			$resp=$row["Cuenta"]; 
		}
		return $resp;
	}
}
?>