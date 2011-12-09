<?php
        include('../Connections/cnxRamp.php');
				
				$idGrupo = $_GET['idGrupos'];
        parse_str($_POST['data']);
        for ($i = 0; $i < count($sortlist2); $i++) {
								$str = "INSERT IGNORE INTO archivos_grupo (id_grupo,id_archivo,fecha_inserta)
												VALUES($idGrupo,$sortlist2[$i],NOW())";
								$sql = mysql_query($str) or die(mysql_error($str));
        }
        sleep(1);
?>
		
