<?php
        include('../Connections/cnxRamp.php');
				
				$idGrupo = $_GET['idGrupos'];
        parse_str($_POST['data']);
        for ($i = 0; $i < count($sortlist); $i++) {
								$str = "delete from archivos_grupo where id_grupo = $idGrupo and id_archivo = $sortlist[$i]";
								$sql = mysql_query($str) or die(mysql_error($str));
        }
        sleep(1);
?>
		
