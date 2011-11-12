<?php
        // This is a class which connect to the database
        include('include/class.database.php');
            
        parse_str($_POST['data']);
        for ($i = 0; $i < count($sortlist); $i++) {
                $sql = mysql_query("INSERT INTO usuariosgruposusuarios VALUES (1,1)");
                if ($sql) print 'Updating order went well'.$i;
        }
        sleep(1);
?>
		
