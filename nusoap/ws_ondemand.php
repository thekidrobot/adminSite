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
		$arr_msg = array('status'=> '', 'url' => '','texto' => '','titulo' => '','categoria' => '','grupos' => '' );

		$sql = "SELECT 	CONCAT(a.carpeta,a.nombreArchivo) AS url,
						a.texto,
						a.titulo,
						/*a.tema,
						a.fechaRelease*/
						g.categoria,
						g.grupos
					FROM 	archivos a, archivos_grupo ag, grupos_usuario gu, usuarios u, grupos g
					WHERE 	a.id_archivo = ag.id_archivo
					AND 	g.idGrupos = ag.id_grupo
					AND 	g.idGrupos = gu.IdGrupos
					AND 	u.IdUsuario = gu.IdUsuario
					AND 	u.pin = '$pin' 
					AND	g.categoria = 'OnDemand'";
		
		$result = mysql_query($sql);  
		while($row = mysql_fetch_object($result))
		{
				$url.= trim($row->url)." | ";
				$texto.= trim($row->texto)." | ";
				$titulo.= trim($row->titulo)." | ";
				$categoria.= trim($row->categoria)." | ";
				$grupos.= trim($row->grupos)." | ";
		}
		$url= substr($url,0,-3);
		$texto= substr($texto,0,-3);
		$titulo= substr($titulo,0,-3);
		$categoria= substr($categoria,0,-3);
		$grupos= substr($grupos,0,-3);

		if(mysql_num_rows($result) == 0)
		{
				$arr_msg['status'] = 'failure';
				$arr_msg['url'] = '';				
				$arr_msg['texto'] = '';				
				$arr_msg['titulo'] = '';				
				$arr_msg['categoria'] = '';				
				$arr_msg['grupos'] = '';	
		}
		else
		{
				$arr_msg['status'] = 'success';
				$arr_msg['url'] = $url;				
				$arr_msg['texto'] = $texto;				
				$arr_msg['titulo'] = $titulo;				
				$arr_msg['categoria'] = $categoria;				
				$arr_msg['grupos'] = $grupos;				
		}

		$usuario = str_replace('\/','/',json_encode($arr_msg));
		return $usuario;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$soap_server->service($HTTP_RAW_POST_DATA);

?> 