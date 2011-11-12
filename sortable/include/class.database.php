<?php         
include("constants.php");  
  
class database {  
    var $connection;  
      
    function database() {  
        $this->connection = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());  
        mysql_select_db(DB_NAME, $this->connection) or die(mysql_error());  
    }        
}  
$db = new database;        
?>