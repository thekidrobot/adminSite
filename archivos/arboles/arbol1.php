<? require("../../Connections/cnxRamp.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<!--[if lte IE 7]>
<style type="text/css">
html .ddsmoothmenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript" src="../js/ddsmoothmenu.js"></script>
<link href="estilo_arbol.css" rel="stylesheet" type="text/css" />
</head>

<body><div id="smoothmenu1" class="ddsmoothmenu">
<?


function arbol( $padre, $nivel,$base,$conexion){
$nivel++;
//$connection = mysql_connect($host, $user , $pass);
 mysql_select_db($base,$conexion);

$sql = "SELECT grupos.idGrupos as id,grupos.padre as parent_id, grupos.grupos as nombre FROM grupos  where grupos.padre =" . $padre . " ORDER BY  padre,idGrupos";

$resultado = mysql_query($sql,$conexion);
if (mysql_num_rows($resultado) > 0)
{
if($nivel>1)
echo "<ul >\n";

while( $rs = mysql_fetch_assoc( $resultado ) ){
echo "<li><a href=\"#\">".$rs["nombre"]."</a>";

arbol($rs["id"],$nivel,$base,$conexion);
echo "</li>\n";

}
mysql_free_result( $resultado );
if($nivel>1)
echo "</ul>\n";
}
}

echo "<ul id=\"treemenu1\" class=\"treeview\"".$x.">\n";
arbol(2,0,$database_cnxRamp,$cnxRamp);
echo "</ul>\n";
?></div>
</body>
</html>

