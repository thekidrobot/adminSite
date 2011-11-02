<?php
session_start();

$valido=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT lp.llave_soft FROM llaves_plugins lp WHERE NOT EXISTS (SELECT 1 FROM usuarios us WHERE us.pcrampkey = lp.llave_soft) LIMIT 1";
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$valido=$row["llave_soft"];
	 }
?>
<input name="txtKeyramp" type="text" id="txtKeyramp" value="<?php echo $valido; ?>" size="50" readonly="readonly">