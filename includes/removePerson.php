<?php
        include('../Connections/cnxRamp.php');
				
				$idGrupo = $_GET['idGrupo'];
        parse_str($_POST['data']);
        for ($i = 0; $i < count($sortlist); $i++) {
								$str = "delete from usuariosgruposusuarios where  idGrupoDeUsuario = $idGrupo and IdUsuario = $sortlist[$i]";
								$sql = mysql_query($str) or die(mysql_error($str));
        }
        sleep(1);
?>
		
