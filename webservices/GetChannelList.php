<?php
session_start();
header('Content-type: application/json');
// libraries
require_once('conexion.inc.php');
require_once('lib/nusoap.php');

$userId = escape_value($_GET['id']);

$page = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$page = 'http://'.substr($page,0,strrpos($page,"/"));

$soap_client = new nusoap_client($page.'/ws_GetChannelList.php?wsdl', true);

$error = $soap_client->getError();

if ($error)
{
    echo '<h2>Error al intentar acceder al WebService</h2><pre>'.error.'</pre>';
}
else
{
    $res = $soap_client->call('receiveUserData',array('userId' => $userId));
    
    if ($soap_client->fault)
    {
        echo '<h2>Error al ejecutar el Método</h2><pre>'.$soap_client->fault->getMessage().'</pre>';
    }
    else
    {
        $error = $soap_client->getError();
        
        if ($error)
        {
            echo '<pre>'.$error.'</pre>';
        }
        else
        {
            echo $res;
        }
    }
}

//Safely escape values. Please use in your SQL queries. 
function escape_value($value)
{
  if(function_exists('mysql_real_escape_string'))
  {
    if(get_magic_quotes_gpc())
    { 
      $value = stripslashes($value); 
		}
		$value = mysql_real_escape_string($value);
	}
  else
  {
    if(!get_magic_quotes_gpc())
    { 
      $value = addslashes($value); 
    }
  }
  return $value;
}

?>
