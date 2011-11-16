<?php
        include('../Connections/cnxRamp.php');
				
				$idGrupo = $_GET['idGrupo'];
        parse_str($_POST['data']);
        for ($i = 0; $i < count($sortlist2); $i++) {
								$str = "INSERT ignore INTO paquetesgrupos VALUES ($idGrupo,$sortlist2[$i])";
								$sql = mysql_query($str) or die(mysql_error($str));
        }
        sleep(1);
?>
		
