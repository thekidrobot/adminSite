<?php //require_once('../Connections/cnxRamp.php');
function archivo($arch)
{
//$arch = $_GET['arch'];
// Configurar las dos lineas siguientes
mysql_select_db($database_cnxRamp, $cnxRamp);
$query = "SELECT imagen  FROM archivos WHERE id_archivo = $arch";
$result = mysql_query($query);
$imagen = mysql_result($result,0);
return $imagen;
}
?>
 