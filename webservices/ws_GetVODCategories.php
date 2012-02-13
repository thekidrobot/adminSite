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
    array('id' => 'xsd:string'),
    array('return' => 'xsd:string'),
    $ns,
    $ns.'#receiveUserData',
    'rpc',
    'encoded',
    'ReceiveUserId'
);

function receiveUserData($id='1')
{
		$arr_msg = array('status'=> '');
		$user = array();
		$channels = array();
		
		$sql = "SELECT DISTINCT vc.*
						FROM subscribers sc,
						subscribers_packages sp,
						packages_vodchannels pv,
						vod_channels_categories vcc,
						vodcategories vc,
						vodchannels vch
						WHERE
						sc.id = sp.subscriber_id AND
						sp.package_id = pv.package_id AND
						pv.resource_id = vch.id AND
						vcc.channel_id = vch.id AND
						vcc.category_id = vc.id AND
						sc.pin = '$id'";
		
		$result = mysql_query($sql);  
		if(mysql_num_rows($result) == 0)
		{
				$arr_msg['status'] = 'success';
				$arr_msg['categories'] = '';				
		}
		else
		{
				while($row = mysql_fetch_object($result))
				{
						array_push
						($channels,$user['categoryId'] = trim($row->id),$user['parentId'] = trim($row->parent),
						 $user['categoryName'] = trim($row->name));
						
						$usuario.=json_encode($user).',';
				}
				$usuario = "[".substr($usuario,0,strlen($usuario)-1)."]";

				$arr_msg['status'] = 'success';
				$arr_msg['categories'] = $usuario;		
		}
		$usuario = str_replace('\\','',json_encode($arr_msg));
		$usuario = str_replace('"[','[',$usuario);
		$usuario = str_replace(']"',']',$usuario);
		return $usuario;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$soap_server->service($HTTP_RAW_POST_DATA);

?> 