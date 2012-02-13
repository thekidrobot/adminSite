<?php
session_start();
// incluir libreria nusoap
require_once('conexion.inc.php');
require_once('lib/nusoap.php');

// Crear server
$soap_server = new nusoap_server();

$page = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$page = 'http://'.substr($page,0,strrpos($page,"/"));

$ns = $page;
// configurar WSDL
$soap_server->configureWSDL('WDSL Authentication', $ns);

// registrar función
$soap_server->register
(
    'receiveAuthData',
    array('mac' => 'xsd:string','serial' => 'xsd:string'),
    array('return' => 'xsd:string'),
    $ns,
    $ns.'#receiveAuthData',
    'rpc',
    'encoded',
    'ReceiveMacAndSerial'
);

function receiveAuthData($mac='',$serial='')
{
		$arr_msg = array('status' => '','packages' => '','PIN'=>'');
		
		$mac = trim($mac);
		$serial = trim($serial);
		 
		$sql = "SELECT 	s.id as uid,p.name as packages
						FROM		subscribers s,
										subscribers_packages sp,
										packages p
						WHERE		s.id = sp.subscriber_id
						AND			p.id = sp.package_id
						AND			s.mac = '$mac'
						AND			s.serial = '$serial'";
						
    $result = mysql_query($sql);  
	  while($row = mysql_fetch_object($result))
    {
				$packages.= trim($row->packages).' - ';
    }
		$packages = substr($packages,0,-3);
		
		if(mysql_num_rows($result) == 0)
		{
				$arr_msg['status'] = 'success';
				$arr_msg['packages'] = 'NULL';
		}
		else
		{
				$pin = generatePin();
						
				$sql = "UPDATE	subscribers
								SET			last_login = NOW(),
												pin = '$pin'
								WHERE		mac = '$mac'
								AND 		serial = '$serial'";
								
				mysql_query($sql);  
				
				$arr_msg['status'] = 'success';
				$arr_msg['packages'] = $packages;
				$arr_msg['PIN'] = $pin;
		}
		$usuario = json_encode($arr_msg);
		return $usuario;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$soap_server->service($HTTP_RAW_POST_DATA);

//PIN Generator
function generatePin()
{
    $length = 15;
    $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
    $string = '';    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;
}

?> 