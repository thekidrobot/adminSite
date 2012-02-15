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

function receiveUserData($id='')
{
		$arr_msg = array('status'=> '');
		$user = array();
		$channels = array();
		
		$sql = "SELECT distinct
						vc.id as id,
						vc.local_url as local_url,
						vc.stb_url as stb_url,
						vc.description as description,
						vc.name as name,
						vc.keywords as keywords,
						vc.date_release as date_release,
						vc.small_pic as poster,
						vc.big_pic as posterLarge,
						vcc.category_id as categoryId
					 FROM
						vodchannels vc,
						vod_channels_categories vcc
					 WHERE
						vc.id = vcc.channel_id AND
						vcc.category_id = '$id'";
		
		$result = mysql_query($sql);  
		if(mysql_num_rows($result) == 0)
		{
				$arr_msg['status'] = 'success';
				$arr_msg['movies'] = '';				
		}
		else
		{
				while($row = mysql_fetch_object($result))
				{
						array_push
						($channels,$user['vodId'] = trim($row->id),$user['categoryId'] = trim($row->categoryId),
						 $user['localURL'] = trim($row->local_url),$user['remoteURL'] = trim($row->stb_url),
						 $user['description'] = trim($row->description),$user['name'] = trim($row->name),
						 $user['poster']=trim($row->poster),$user['posterLarge']=trim($row->posterLarge));
						
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