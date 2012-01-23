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
    'receiveUserData',
    array('userId' => 'xsd:string'),
    array('return' => 'xsd:string'),
    $ns,
    $ns.'#receiveUserData',
    'rpc',
    'encoded',
    'ReceiveUserId'
);

function receiveUserData($userId='')
{
		$arr_msg = array('status' => '','channels' => '');

		$sql = "SELECT 	DISTINCT g.grupos as grupos
						FROM 		usuarios u,usvsgrupovsvideo ug , grupos g
						WHERE 	u.IdUsuario = ug.UGD_USUARIO
						AND 		g.idGrupos = ug.UGD_GRUPO
						AND 	 	u.pin = '$userId'";				
		
		$result = mysql_query($sql);  
		while($row = mysql_fetch_object($result))
		{
				$user.= trim($row->grupos).' - ';
		}
		$user = substr($user,0,-3);

		if(mysql_num_rows($result) == 0)
		{
				$arr_msg['status'] = 'failure';
				$arr_msg['channels'] = '';	
		}
		else
		{
				$arr_msg['status'] = 'success';
				$arr_msg['channels'] = $user;				
		}

		$usuario = json_encode($arr_msg);
		return $usuario;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$soap_server->service($HTTP_RAW_POST_DATA);

?> 