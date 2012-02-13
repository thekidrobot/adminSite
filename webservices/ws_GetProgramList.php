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
    array('userid' => 'xsd:string','id' => 'xsd:string'),
    array('return' => 'xsd:string'),
    $ns,
    $ns.'#receiveUserData',
    'rpc',
    'encoded',
    'ReceiveUserId'
);

function receiveUserData($userid='',$id='')
{
		$arr_msg = array('status'=> '');
		$user = array();
		$channels = array();
		
		$sql = "SELECT distinct gl.*
					  FROM
						 grid_live gl,
						 livechannels lc,
						 packages_livechannels pl,
						 subscribers_packages sp,
						 subscribers sc
					  WHERE
						 gl.channel_id = lc.id AND
						 lc.id = pl.resource_id AND
						 pl.package_id = sp.package_id AND
						 sp.subscriber_id = sc.id AND
						 gl.channel_id = '$id' AND
						 sc.pin = '$userid'";
		
		$result = mysql_query($sql);  
		if(mysql_num_rows($result) == 0)
		{
				$arr_msg['status'] = 'success';
				$arr_msg['programs'] = '';				
		}
		else
		{
				while($row = mysql_fetch_object($result))
				{
						array_push
						($channels,$user['cgId'] = trim($row->id),$user['title'] = trim($row->name),
						 $user['description'] = trim($row->description),
						 $user['beginDate']=strtotime($row->start_date),$user['endDate']=strtotime($row->end_date));
						
						$usuario.=json_encode($user).',';
				}
				$usuario = "[".substr($usuario,0,strlen($usuario)-1)."]";

				$arr_msg['status'] = 'success';
				$arr_msg['programs'] = $usuario;		
		}
		$usuario = str_replace('\\','',json_encode($arr_msg));
		$usuario = str_replace('"[','[',$usuario);
		$usuario = str_replace(']"',']',$usuario);
		return $usuario;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$soap_server->service($HTTP_RAW_POST_DATA);

?> 