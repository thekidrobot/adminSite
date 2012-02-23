<?php
session_start();
header('Content-type: application/json; charset=UTF-8' );
// libraries
require_once('conexion.inc.php');
require_once('functions.php');
require_once('lib/nusoap.php');

$userid = escape_value($_GET['userid']);
$id = escape_value($_GET['id']);

$page = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$page = 'http://'.substr($page,0,strrpos($page,"/"));

$soap_client = new nusoap_client($page.'/ws_GetProgramList.php?wsdl', true);

$error = $soap_client->getError();

if ($error)
{
    echo '<h2>Error al intentar acceder al WebService</h2><pre>'.error.'</pre>';
}
else
{
    $res = $soap_client->call('receiveUserData',array('userid' => $userid,'id' => $id));
    
    if ($soap_client->fault)
    {
        echo '<h2>Error al ejecutar el Método</h2><pre>'.$soap_client->fault->getMessage().'</pre>';
    }
    else
    {
        $error = $soap_client->getError();
        
        if ($error)
        {
            echo $error;
        }
        else
        {
            echo $res;
        }
    }
}

?>
