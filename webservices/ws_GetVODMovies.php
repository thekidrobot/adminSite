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
		
		$sql = "SELECT DISTINCT 
						vc.id as id,
						vcc.category_id as categoryId,
						vc.local_url as local_url,
						vc.stb_url as stb_url,
						vc.description as description,
						vc.name as name,
						vc.keywords as keywords,
						vc.date_release as date_release,
						vc.small_pic as poster,
						vc.big_pic as posterLarge,
						
						rc.duration,
						DATE_ADD(tc.creation_date, INTERVAL rc.duration DAY) as restriction_date,
						NOW() as today
						
					 FROM
						vodchannels vc,
						packages_vodchannels pv,
						subscribers sc,
						subscribers_packages sp,
						vod_channels_categories vcc,
						
						tickets tc,
						restrictions rc
						
					 WHERE
					 
					 	vc.id = tc.resource_id AND
						tc.restriction_id  = rc.id AND
						tc.subscriber_id = sc.id AND 
					 
					  vc.id = vcc.channel_id AND
						pv.resource_id = vc.id AND
						pv.package_id = sp.package_id AND
						sp.subscriber_id = sc.id AND 
						sc.pin = '$userid' AND 
						vcc.category_id = $id";
		
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
						$show = true;
						
						//Restriction by max. views
						if($row->max_views != 0 and ($row->max_views > $row->current_views))
						{
							$show = false;
						}
						
						//Restriction by date
						
						if($row->duration != 0)
						{
							$restriction_date = strtotime($row->restriction_date);
							$now = strtotime($row->today);
							
							if ($restriction_date < $now){
								$show = false;	
							}
						}
					
						if($show == true){

								array_push
								($channels,$user['vodId'] = trim($row->id),$user['categoryId'] = trim($row->categoryId),
								 $user['localURL'] = trim($row->local_url),$user['remoteURL'] = trim($row->stb_url),
								 $user['description'] = trim($row->description),$user['name'] = trim($row->name),
								 $user['poster']=trim($row->poster),$user['posterLarge']=trim($row->posterLarge));
						
								$usuario.=json_encode($user).',';
						}
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