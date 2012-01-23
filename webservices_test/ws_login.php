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
		$arr_msg = array('status' => '','user' => '','PIN'=>'');
		
		$sql = "SELECT 	DISTINCT u.IdUsuario as idUsuario, g.grupos as grupos
						FROM 	usuarios u,usvsgrupovsvideo ug , grupos g
						WHERE 	u.IdUsuario = ug.UGD_USUARIO
						AND 	g.idGrupos = ug.UGD_GRUPO
						AND 	u.MAC_ID = '$mac'
						AND 	u.SERIAL = '$serial'";
						
    $result = mysql_query($sql);  
	  while($row = mysql_fetch_object($result))
    {
				$user.= trim($row->grupos).' - ';
				$userId.= trim($row->idUsuario);
    }
		
		$user = substr($user,0,-3);
		
		if(mysql_num_rows($result) == 0)
		{
				$arr_msg['status'] = 'failure';
				$arr_msg['user'] = 'NULL';
		}
		else
		{
				$pin = generatePin();
						
				$sql = "UPDATE	usuarios set ultimo_login = NOW(),pin = '$pin'
								WHERE	MAC_ID = '$mac'
								AND 		serial = '$serial'";
								
				mysql_query($sql);  
				
				$arr_msg['status'] = 'success';
				$arr_msg['user'] = $user;
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