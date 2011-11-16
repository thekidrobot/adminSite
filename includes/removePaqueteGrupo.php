<?php
        include('../Connections/cnxRamp.php');
				
				$idGrupo = $_GET['idGrupo'];
        parse_str($_POST['data']);
        for ($i = 0; $i < count($sortlist); $i++) {
								$str = "delete from paquetesgrupos where idGrupos = $idGrupo and idPaquete = $sortlist[$i]";
								$sql = mysql_query($str) or die(mysql_error($str));
        }
        sleep(1);
?>
		
