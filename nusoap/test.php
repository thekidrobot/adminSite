<?php
require_once('conexion.inc.php');

$mac = escape_value($_GET['mac']);
$serial = escape_value($_GET['serial']);

    $sql = "SELECT 	DISTINCT g.grupos as grupos
						FROM 	usuarios u,usvsgrupovsvideo ug , grupos g
						WHERE 	u.IdUsuario = ug.UGD_USUARIO
						AND 	g.idGrupos = ug.UGD_GRUPO
						AND 	u.MAC_ID = '$mac'
						AND 	u.SERIAL = '$serial'";
												
    $result = mysql_query($sql);  
	  while($row = mysql_fetch_object($result))
    {
        $usuario.= $row->grupos.' ';
    }
    echo $usuario;

//Safely escape values. Please use in your SQL queries. 
function escape_value($value)
{
  if(function_exists('mysql_real_escape_string'))
  {
    if(get_magic_quotes_gpc())
    { 
      $value = stripslashes($value); 
		}
		$value = mysql_real_escape_string($value);
	}
  else
  {
    if(!get_magic_quotes_gpc())
    { 
      $value = addslashes($value); 
    }
  }
  return $value;
}

?> 