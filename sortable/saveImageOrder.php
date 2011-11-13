<?php  
        // This is a class which connect to the database  
          include('include/class.database.php');  
            
          parse_str($_POST['data']);  
          for ($i = 0; $i < count($sortlist); $i++) {  
              $sql = mysql_query("UPDATE tut_sortImages SET orderId = $i WHERE imageId = $sortlist[$i]") or die(mysql_error());  
              if ($sql) print 'Updating order went well'.$i;  
          }  
          sleep(1);  
?>