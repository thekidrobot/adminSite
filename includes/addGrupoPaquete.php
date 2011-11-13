<?php
        include('../Connections/cnxRamp.php');
				
				$idPaquete = $_GET['idPaquete'];
        parse_str($_POST['data']);
        for ($i = 0; $i < count($sortlist2); $i++) {
								$str = "INSERT ignore INTO paquetesgrupos VALUES ($idPaquete,$sortlist2[$i])";
								echo $sql;
								$sql = mysql_query($str) or die(mysql_error($str));
        }
        sleep(1);
?>
		
