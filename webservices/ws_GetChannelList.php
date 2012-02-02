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

function receiveUserData($pin='')
{
		$arr_msg = array('status'=> '');
		$user = array();
		$channels = array();
		
		$sql = "SELECT distinct
						lc.id as id,
						lc.url as url,
						lc.number as number,
						lc.name as name,
						lc.small_pic as poster,
						lc.big_pic as posterLarge
					 FROM
						livechannels lc,
						packages_livechannels pl,
						subscribers sc,
						subscribers_packages sp
					 WHERE
						pl.resource_id = lc.id AND
						pl.package_id = sp.package_id AND
						sp.subscriber_id = sc.id AND
						sc.pin = '$pin'";
		
		$result = mysql_query($sql);  
		if(mysql_num_rows($result) == 0)
		{
				$arr_msg['status'] = 'failure';
				$arr_msg['categories'] = '';				
		}
		else
		{
				while($row = mysql_fetch_object($result))
				{
						array_push
						($channels,
						 $user['channelId'] = trim($row->id),
						 $user['channelNumber'] = trim($row->number),
						 $user['channelName'] = trim($row->name),
						 $user['sourceUrl'] = trim($row->url),
						 $user['iconUrl']=trim($row->poster));
						
						$usuario.=json_encode($user).',';
				}
				$usuario = "[".substr($usuario,0,strlen($usuario)-1)."]";

				$arr_msg['status'] = 'success';
				$arr_msg['movies'] = $usuario;		
		}
		$usuario = str_replace('\\','',json_encode($arr_msg));
		$usuario = str_replace('"[','[',$usuario);
		$usuario = str_replace(']"',']',$usuario);
		return $usuario;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$soap_server->service($HTTP_RAW_POST_DATA);

?> 