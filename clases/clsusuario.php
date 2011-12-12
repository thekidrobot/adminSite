<?
include("clsGrupos.php");
class clsusuario extends clsGrupos
{
/////////////////////////////////////////////////////////////////////////////////////////////
function validacionAdministrador($Usuario,$Clave)
{
$valido=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM administrador WHERE Clave='" . $Clave . "' AND Login='" . $Usuario . "' ";
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$valido=$row["IdAdministrador"];
	 }
return $valido;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function validacionUsuario($Usuario,$Clave)
{
$valido=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM usuarios WHERE Password='" . $Clave . "' AND Usuario='" . $Usuario . "' and activo = 1";
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$valido=$row["IdUsuario"];
		$_SESSION['NombreCompleto']=$row["NombreCompleto"];
	 }
return $valido;


}
/////////////////////////////////////////////////////////////////////////////////////////////

function obtenerIdGrupo($nomGrupo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT grupos.idGrupos, grupos.grupos FROM grupos WHERE (((grupos.grupos)='" . $nomGrupo . "'))";
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$valido=$row["idGrupos"];
	 }
return $valido;
}

/////////////////////////////////////////////////////////////////////////////////////////////
function validacionLoginUsuario($Usuario)
{
$valido=1;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM usuarios WHERE  Usuario='" . $Usuario . "' ";
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$valido=0;
	 }
return $valido;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function actualizarClave($Login,$Clave)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="update administrador set Clave='".$Clave."' where Login='".$Login."' ";
$result = mysql_query($sql);
}
/////////////////////////////////////////////////////////////////////////////////////////////
function actualizarClaveUsuario($Login,$Clave,$nombre,$mail,$empresa,$cargo,$pais,$telefono)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="update usuarios set Password='".$Clave."',NombreCompleto='". $nombre."',mail='".$mail."',empresa='".$empresa."',cargo='".$cargo."',pais='".$pais."',telefono='".$telefono."' where Usuario='".$Login."' ";
$result = mysql_query($sql);
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarUsuario($nombreUsu)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  usuarios where NombreCompleto like '%" . $nombreUsu . "%' order by NombreCompleto ";
$result = mysql_query($sql, $link);
return $result;
}
////////////////////////////////////////////////////////////////////////////////////////////

function consultarUsuarios()
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  usuarios order by NombreCompleto ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarDetalleUsuarios($IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  usuarios where IdUsuario=".$IdUsuario;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function ingresarUsuario($Usuario,$Password,$NombreCompleto,$activo,$licencia,$rampkey,$mac,$serial)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into usuarios (Usuario,Password,activo,NombreCompleto,ID_PLUGIN,pcrampkey,MAC_ID,serial)
			values ('$Usuario','$Password','$activo','$NombreCompleto','$licencia','$rampkey','$mac','$serial')";
$result = mysql_query($sql);
}
/////////////////////////////////////////////////////////////////////////////////////////////
function actualizarUsuario($IdUsuario,$Usuario,$Password,$NombreCompleto,$activo,$licencia,$rampkey,$mac,$serial)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="update usuarios set NombreCompleto='".$NombreCompleto."',apellidos='".$apellidos."',
			Password='".$Password."',activo=".$activo.",Usuario='" . $Usuario. "',ID_PLUGIN='" . $licencia . "',
			pcrampkey='" . $rampkey . "', MAC_ID = '$mac',serial = '$serial' where IdUsuario=".$IdUsuario;		
$result = mysql_query($sql);
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarDetalleGrupos($IdGrupos)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT grupos. * , grupos_1.grupos AS descPadre, grupos_1.IdGrupos AS idPadre FROM grupos LEFT JOIN grupos AS grupos_1 ON grupos.padre = grupos_1.IdGrupos WHERE grupos.IdGrupos = " .$IdGrupos;
//$sql = "SELECT * FROM  grupos where IdGrupos=".$IdGrupos;
$result = mysql_query($sql, $link);
return $result;
}

/////////////////////////////////////////////////////////////////////////////////////////////
function consultarGrupos()
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT grupos. * , gr2.grupos AS descpadre
FROM `grupos` 
LEFT JOIN grupos AS gr2 ON grupos.padre = gr2.idGrupos ORDER BY grupos ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarGruposUsuarios($IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  grupos_usuario,grupos where grupos.idGrupos=grupos_usuario.IdGrupos and  IdUsuario=".$IdUsuario." and grupos_usuario.tipoHerencia is null ORDER BY grupos ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
function ingresarGrupos($DetalleGrupos,$nivel,$padre)
{
	$grupoNuevo=0;
	$ap=0;
	$padreInt=0;
	
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 


//if($noNivel<10){//10 niveles de submenu es el tope maximo de niveles que se sugiere
	$sql="insert into grupos (grupos,activo,NIVEL,PADRE) values ('" .$DetalleGrupos. "',1,'" . $nivel . "'," . $padre . ") "; //crea el grupo
	$result = mysql_query($sql,$link); //ejecuta la sentencia anterior
	
	//heredar los usuarios del padre y sus padres HD hereda down
	//e elimina la herencia down por problemas al tener la jerarquia muchas ramas
	/*if(isset($padre)){
		$padreInt=$padre;
		if ($result){
			/*$sql = "select max(IdGrupos) grupoNuevo from grupos";//sentencia para averiguar el ultimo grupo insertado
			$rs = mysql_query($sql,$link);//ejecuta la sentencia anterior
			$row = mysql_fetch_row($rs);//asigna en $row el resultado de la consulta
			
			$grupoNuevo = $row[0];//asigna en la variable $grupoNuevo el maximo del grupo de la consulta
			
			$grupoNuevo =mysql_insert_id();
			$sql = "insert into grupos_usuario (IdUsuario,IdGrupos,ramp_cant_descargas,tipoHerencia)
						select idUsuario," . $grupoNuevo . ", 50,'HD' from grupos_usuario 
						where idGrupos = " . $padre;
				$result = mysql_query($sql,$link);//inserta en el grupo actual los usuarios del grupo padre
		}
	}*/
//}


}
/////////////////////////////////////////////////////////////////////////////////////////////

function borrarGrupoUsuario($IdGruposUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 

$sql="delete from grupos_usuario where IdGruposUsuario=".$IdGruposUsuario;
$result = mysql_query($sql);

}
/////////////////////////////////////////////////////////////////////////////////////////////
//INGRESAR UN USUARIO A UN GRUPO
function ingresarGruposUsuarios($IdUsuario,$IdGrupos,$cantDesc)
{
	$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
	mysql_select_db($_SESSION["basededatos"], $link); 
	
	$sql="insert into grupos_usuario (IdUsuario,IdGrupos,ramp_cant_descargas,tipoHerencia) values (".$IdUsuario.",".$IdGrupos.",".$cantDesc.",null)  on duplicate key update tipoHerencia=null";
	$result = mysql_query($sql,$link);
	//hay que poner herencia de este usuario en los niveles superiores
	if($result)
	{
		//buscar el padre de este grupo de manera recursiva
		$this->heredarUsuarios($IdUsuario,$IdGrupos,$cantDesc);
	}
}

function poblarUsVsGrupVsVideo($IdUsuario,$IdGrupos,$cantDesc)
{
	$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
	mysql_select_db($_SESSION["basededatos"], $link); 
	
	$sql="insert into usvsgrupovsvideo (UGD_USUARIO,UGD_GRUPO,UGD_VIDEO,UGD_DESCARGAS,UGD_ESTADO) 
			SELECT " . $IdUsuario . " AS USUARIO, archivos_grupo.id_grupo, archivos_grupo.id_archivo, " . $cantDesc . " AS DESCARGAS, 1 AS ESTADO
			FROM archivos_grupo
			WHERE (((archivos_grupo.id_grupo)=" . $IdGrupos . "))";
	$result = mysql_query($sql,$link);

}

function heredarUsuarios($IdUsuario,$IdGrupos,$cantDesc){
	$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
	mysql_select_db($_SESSION["basededatos"], $link); 
	

	$sql="select padre from grupos where idGrupos =" . $IdGrupos . " and padre > 0";
		$result=mysql_query($sql,$link);
		while ($row = @mysql_fetch_array($result))
		 {
			 $sql="insert ignore into grupos_usuario (IdUsuario,IdGrupos,ramp_cant_descargas,tipoHerencia,grupoHijo)  values (".$IdUsuario.",".$row['padre'].",".$cantDesc.",'HU',". $IdGrupos . ")";
			 $result=mysql_query($sql,$link);
			 if($result)
			 	$this->heredarUsuarios($IdUsuario,$row['padre'],$cantDesc);
		 }
	
}
function heredaGruposUsuarios($idGrupo){
	//hereda los usuarios del grupo actual a todos los grupos padres

	$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
	mysql_select_db($_SESSION["basededatos"], $link); 
	

	
	$sql="select padre from grupos where idGrupos =" . $idGrupo . " and padre >0";
	$result=mysql_query($sql,$link);
	while ($row = @mysql_fetch_array($result))
	{
		 $sql="insert ignore into grupos_usuario (IdUsuario,IdGrupos,ramp_cant_descargas,tipoHerencia,grupoHijo) select idUsuario," . $row['padre'] . ",50,'HU'," . $idGrupo . " from grupos_usuario where IdGrupos = " . $idGrupo;
		 $result=mysql_query($sql,$link);
		 if($result)
			$this->heredaGruposUsuarios($row['padre']);
	}
}

function desheredaDeHijoAPadre($idGrupo){
//quita la herencia del grupo actual sobre los padres
//solo administracion de grupos
	
	
	$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
	mysql_select_db($_SESSION["basededatos"], $link);
	 
	$sql="select padre from grupos where idGrupos = " . $idGrupo . " and padre >0";
	$result=mysql_query($sql,$link);
	while ($row = @mysql_fetch_array($result))
	{
		 $sql="delete from grupos_usuario where IdGrupos = " . $row['padre'] . " and grupoHijo = " . $idGrupo;
		 $result=mysql_query($sql,$link);
		 if($result)
			$this->desheredaDeHijoAPadre($row['padre']);
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////


function actualizarGrupos($IdGrupos,$grupos,$activo,$nivel,$padre,$padreActual)
{
$actual=0;//grupo actual dentro del bucle
$flag=0;//variable tipo switch para recorrer las carpetas hijas hasta que se acaben
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 


if(isset($padre) && $padre != $padreActual){
	$padreInt=$padre;
		//quitar los usuarios heredados del grupo actual sobre su padre y sus padres
	$this->desheredaDeHijoAPadre($IdGrupos);
	$sql="update grupos set grupos ='".$grupos."',activo=".$activo.",nivel='" . $nivel . "',padre=" . $padre . " where IdGrupos=".$IdGrupos;
	$result = mysql_query($sql);
	if($result)
		$this->heredaGruposUsuarios($IdGrupos);
}

echo "padre = " . $padre . " actual = " . $padreActual;


//hay que actualizar los grupos por debajo de este para actualizar sus niveles 















}

/////////////////////////////////////////////////////////////////////////////////////////////
//valida si el usuario ya esta en ese grupo
function validacionGruposUsuario($IdUsuario,$IdGrupos)
{
$existe=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM grupos_usuario WHERE IdUsuario=".$IdUsuario." and IdGrupos=".$IdGrupos;
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$existe=1;
	 }
return $existe;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function borrarUsVsGrVsVid($IdUsuario,$IdGrupos){
	//elimina los uaurios y el grupo de esta tabla
	$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
	mysql_select_db($_SESSION["basededatos"], $link); 
	
	$sql="delete from usvsgrupovsvideo where UGD_USUARIO = " . $IdUsuario . " and UGD_GRUPO = " . $IdGrupos;
	$result = mysql_query($sql,$link);
}

function borraUsuarioGrupo($IdUsuario,$IdGrupos){
//borra el usuario de los grupos heredados
	$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
	mysql_select_db($_SESSION["basededatos"], $link); 
	

	$sql="select padre from grupos where idGrupos =" . $IdGrupos . " and padre > 0";
		$result=mysql_query($sql,$link);
		while ($row = @mysql_fetch_array($result))
		 {
			 $sql="delete from grupos_usuario where IdUsuario = ".$IdUsuario." and IdGrupos = ".$row['padre']." and grupoHijo = ". $IdGrupos;
			 $result=mysql_query($sql,$link);
			 if($result)
			 	$this->borraUsuarioGrupo($IdUsuario,$row['padre']);
		 }
	}

/////////////////////////////////////////////////////////////////
//funciones para elñ manejo de descargas
function descargas_x_usuario($usuario,$grupo)
{
	$sql_0 = "SELECT usvsgrupovsvideo.UGD_CONSECUTIVO,usvsgrupovsvideo.UGD_DESCARGAS, usvsgrupovsvideo.UGD_ESTADO, usvsgrupovsvideo.visitas, usuarios.Usuario, grupos.grupos, archivos.carpeta, archivos.titulo
	FROM ((usvsgrupovsvideo INNER JOIN usuarios ON usvsgrupovsvideo.UGD_USUARIO = usuarios.IdUsuario) INNER JOIN grupos ON usvsgrupovsvideo.UGD_GRUPO = grupos.idGrupos) INNER JOIN archivos ON usvsgrupovsvideo.UGD_VIDEO = archivos.id_archivo
	WHERE (((usuarios.NombreCompleto)='" . $usuario . "') AND ((grupos.idGrupos)=" . $grupo . "))";
	/*WHERE (((usuarios.Usuario)='" . $usuario . "'))";*/
	
	
	$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
	mysql_select_db($_SESSION["basededatos"], $link);
	$result=mysql_query($sql_0,$link); 
	return $result;
	
}
function descargas_x_grupo($grupo)
{
	$sql_0 = "SELECT usvsgrupovsvideo.UGD_CONSECUTIVO,usvsgrupovsvideo.UGD_DESCARGAS, usvsgrupovsvideo.UGD_ESTADO, usvsgrupovsvideo.visitas, usuarios.Usuario, grupos.grupos, archivos.carpeta, archivos.titulo
	FROM ((usvsgrupovsvideo INNER JOIN usuarios ON usvsgrupovsvideo.UGD_USUARIO = usuarios.IdUsuario) INNER JOIN grupos ON usvsgrupovsvideo.UGD_GRUPO = grupos.idGrupos) INNER JOIN archivos ON usvsgrupovsvideo.UGD_VIDEO = archivos.id_archivo
	WHERE (((grupos.grupos)='" . $grupo . "'))";
	
	$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
	mysql_select_db($_SESSION["basededatos"], $link);
	$result=mysql_query($sql_0,$link); 
	return $result;
	
}

function actualizaDescarga($idReg,$nuevoNum)
{
	$sql_0 = "update usvsgrupovsvideo set UGD_DESCARGAS = " . $nuevoNum . " where UGD_CONSECUTIVO = " . $idReg ; 
	
	$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
	mysql_select_db($_SESSION["basededatos"], $link);
	$result=mysql_query($sql_0,$link); 
}



}//fin de la clase



?>
