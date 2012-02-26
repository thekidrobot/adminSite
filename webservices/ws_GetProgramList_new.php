<?php
session_start();
// incluir libreria nusoap
require_once('conexion.inc.php');
require_once('functions.php');
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
		$programs = array();
		$status = array();
		
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
				$status['status'] = 'success';
				$status['programs'] = '';				
		}
		else
		{
				while($row = mysql_fetch_object($result))
				{
						$programs['cgId'] = trim($row->id);
						$programs['title'] = trim($row->grid_name);
						$programs['description'] = (trim($row->grid_description));
						$programs['beginDate'] = strtotime($row->start_date." ".$row->start_time);
						$programs['endDate'] =strtotime($row->end_date." ".$row->end_time);
				}
				
				$status['status'] = 'success';
				$status['programs'] = "[".my_json_encode($programs)."]";		
		}
		$status = my_json_encode($status);
		$status = str_replace('"[','[',$status);
		$status = str_replace(']"',']',$status);
		return $status;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$soap_server->service($HTTP_RAW_POST_DATA);

?> 