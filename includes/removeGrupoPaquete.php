<?php
        include('../Connections/cnxRamp.php');
				
				$idPaquete = $_GET['idPaquete'];
        parse_str($_POST['data']);
        for ($i = 0; $i < count($sortlist); $i++) {
								$str = "delete from paquetesgrupos where idPaquete = $idPaquete and idGrupos = $sortlist[$i]";
								$sql = mysql_query($str) or die(mysql_error($str));
        }
        sleep(1);
?>
		
