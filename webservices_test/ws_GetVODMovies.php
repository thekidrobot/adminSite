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
		
		$sql = "SELECT
						a.id_archivo as id,
						CONCAT(a.carpeta,a.nombreArchivo) AS url,
						a.texto as description,
						a.titulo as title,
						/*a.tema,
						a.fechaRelease*/
						a.imagen as poster,
						g.categoria as category,
						g.grupos as groups
					FROM 	archivos a, archivos_grupo ag, grupos_usuario gu, usuarios u, grupos g
					WHERE 	a.id_archivo = ag.id_archivo
					AND 	g.idGrupos = ag.id_grupo
					AND 	g.idGrupos = gu.IdGrupos
					AND 	u.IdUsuario = gu.IdUsuario
					AND 	u.pin = '$pin' 
					AND	g.categoria = 'OnDemand'";
		
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
						if (trim($row->imagen)!=""){
								$posterLarge = "../data/images/".trim($row->imagen);
								
								$poster = trim($row->imagen);
								
								$actual_filename = $poster;
								
								$file_ext = substr($actual_filename, strrpos($actual_filename, '.') + 1);	
								//remove the ext
								$filename_strip= substr($actual_filename,0,strrpos($actual_filename, '.'));	
								//remove the _big
								$filename_strip= substr($actual_filename,0,strrpos($actual_filename, '_big'));
								//add the _small
								$filename_strip= $filename_strip."_small";	
								
								$actual_filename_thumb = $filename_strip.".".$file_ext;

								$poster = "../data/images/$actual_filename_thumb";								
						}
						else{
								$poster = "";
								$posterLarge = "";
						}
						
						
					array_push($channels,$user['id'] = trim($row->id),$user['url'] = trim($row->url),
										$user['description'] = trim($row->description),$user['title'] = trim($row->title),
										$user['categoryId'] = trim($row->category),$user['groups'] = trim($row->groups),
										$user['poster']=$poster,$user['posterLarge']=$posterLarge);
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