<?php
session_start();
// incluir libreria nusoap
require_once('conexion.inc.php');

		$arr_msg = array('status'=> '');
		$user = array();
		$channels = array();

$id = 'h1hr44dvfz5mzx6';
		
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
								sc.pin = '$id' 
						ORDER BY
								vc.id ASC ";
		
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
						if(trim($row->parent) != 0)
						{
								$sql_parent = "SELECT * from vodchannels where id = ". trim($row->parent);
								$result_parent = mysql_query($sql_parent);
								while($row_parent = mysql_fetch_object($result_parent))
								{

										$arr_search = search($user,'categoryId',trim($row_parent->id));
										
										if(count($arr_search == 0)){
												array_push
												($channels,$user['categoryId'] = trim($row_parent->id),$user['parentId'] = trim($row_parent->parent),
												 $user['categoryName'] = trim($row_parent->name));
												 $usuario.=json_encode($user).',';
										}
								}
						}
						else
						{
								$arr_search = search($user,'categoryId',trim($row->id));
						
								if(count($arr_search == 0)){	
										array_push
										($channels,$user['categoryId'] = trim($row->id),$user['parentId'] = trim($row->parent),
										 $user['categoryName'] = trim($row->name));
										 $usuario.=json_encode($user).',';

								}
						}
				}
				$usuario = "[".substr($usuario,0,strlen($usuario)-1)."]";

				$arr_msg['status'] = 'success';
				$arr_msg['categories'] = $usuario;
				
		}
		$usuario = str_replace('\\','',json_encode($arr_msg));
		$usuario = str_replace('"[','[',$usuario);
		$usuario = str_replace(']"',']',$usuario);
		echo $usuario;

// search array for specific key = value
function search($array, $key, $value)
{
    $results = array();

    if (is_array($array))
    {
        if (isset($array[$key]) && $array[$key] == $value)
            $results[] = $array;

        foreach ($array as $subarray)
            $results = array_merge($results, search($subarray, $key, $value));
    }

    return $results;
}


?> 