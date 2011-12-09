<?php
        include('../Connections/cnxRamp.php');
				
				$idPaquete = $_GET['idPaquete'];
        parse_str($_POST['data']);
        for ($i = 0; $i < count($sortlist); $i++) {
								$str = "delete from gruposusuariospaquetes where idPaquete = $idPaquete and idGrupoDeUsuario = $sortlist[$i]";
								$sql = mysql_query($str) or die(mysql_error($str));
        }
        sleep(1);
?>
		
