<?
class clstaller
{
//////////////////////////////////////////////////////////////////////////////////////////////////
function ingresarTaller($NombreTaller,$estado,$IdCurso,$Calificacion,$CalificacionMinima,$Presentacion)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$LlaveTaller=rand(1111111111,9999999999);
$sql="insert into taller (NombreTaller, estado, IdCurso,Calificacion,CalificacionMinima,Presentacion,LlaveTaller) values ('".$NombreTaller."','".$estado."',".$IdCurso.",".$Calificacion.",".$CalificacionMinima.",'".$Presentacion."','".$LlaveTaller."')  ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function actualizarTaller($Idtaller,$NombreTaller,$estado,$IdCurso,$Calificacion,$CalificacionMinima,$Presentacion)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="update taller set Estado=".$estado.", NombreTaller='".$NombreTaller."', IdCurso=".$IdCurso.",Calificacion=".$Calificacion.",CalificacionMinima=".$CalificacionMinima.",Presentacion='".$Presentacion."'   where  Idtaller=".$Idtaller;
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function ingresaModulo($Titulo,$Calificacion,$Idtaller,$CalificacionMinima,$Presentacion,$Juego,$Juego2,$estado,$descPres)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$llave = rand(1111111111,9999999999);
$sql="insert into modulos (Titulo,Calificacion,Idtaller,CalificacionMinima,Presentacion,Juego,Juego2,estado,LlaveModulo,descPresentacion) values ('".$Titulo."',".$Calificacion.",".$Idtaller.",".$CalificacionMinima.",'".$Presentacion."','".$Juego."','".$Juego2."','".$estado."','".$llave."','".$descPres."') ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function actualizarModulo($IdModulo,$Titulo,$Calificacion,$CalificacionMinima,$Presentacion,$Juego,$Juego2,$estado,$descPres)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="update modulos set Titulo='".$Titulo."',Calificacion=".$Calificacion.",CalificacionMinima=".$CalificacionMinima.",Presentacion='".$Presentacion."',Juego='".$Juego."',Juego2='".$Juego2."',estado='".$estado."',descPresentacion='". $descPres."' where  IdModulo=".$IdModulo;
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function ingresarPreguntaTallerModulo($IdModulo,$DetallePregunta)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into preguntas (IdModulo,DetallePregunta,IdModoCurso,IdModoTaller) values (".$IdModulo.",'".$DetallePregunta."',0,0) ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function ingresarPreguntaGrupoModo($IdModoGrupo,$DetallePregunta)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into preguntas (IdModoGrupo,DetallePregunta) values (".$IdModoGrupo.",'".$DetallePregunta."') ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function ingresarPreguntaCursoModo($IdModoCurso,$DetallePregunta)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into preguntas (IdModoCurso,DetallePregunta,IdModulo,IdModoTaller) values (".$IdModoCurso.",'".$DetallePregunta."',0,0) ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function ingresarPreguntaTallerModo($IdModoTaller,$DetallePregunta)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into preguntas (IdModoTaller,DetallePregunta,IdModulo,IdModoCurso) values (".$IdModoTaller.",'".$DetallePregunta."',0,0) ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function ingresarPreguntaModuloModo($IdModoModulo,$DetallePregunta,$IdModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into preguntas (IdModoModulo,DetallePregunta,IdModulo,IdModoCurso) values (".$IdModoModulo.",'".$DetallePregunta."',". $IdModulo. ",0) ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////


function ingresarrespPregMod($IdPregunta,$DetalleRespuesta,$Correcta)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 


if($Correcta=="1")
 {
   $sql="update respuesta set Correcta=0 where IdPregunta=".$IdPregunta;
   $result = mysql_query($sql);
 }

$sql="insert into respuesta (IdPregunta,DetalleRespuesta,Correcta) values (".$IdPregunta.",'".$DetalleRespuesta."',".$Correcta.") ";
$result = mysql_query($sql);

}
//////////////////////////////////////////////////////////////////////////////////////////////////

function actualizarrespPregMod($IdRespuesta,$DetalleRespuesta,$Correcta,$IdPregunta)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 


if($Correcta=="1")
 {
   $sql="update respuesta set Correcta=0 where IdPregunta=".$IdPregunta;
   $result = mysql_query($sql);
 }

$sql="update  respuesta set Correcta=".$Correcta.",DetalleRespuesta='".$DetalleRespuesta."' where IdRespuesta=".$IdRespuesta;
$result = mysql_query($sql);

}
//////////////////////////////////////////////////////////////////////////////////////////////////

function actualizarPreguntaTaller($IdPregunta,$DetallePregunta)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="update preguntas set DetallePregunta='".$DetallePregunta."' where IdPregunta=".$IdPregunta;
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function ingresarModoCurso($IdCurso,$IdModo,$ActivoModoCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into modo_curso (IdCurso,IdModo,ActivoModoCurso) values (".$IdCurso.",".$IdModo.",".$ActivoModoCurso.") ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////


function actualizarInfoCert($EmitidoPor,$GeneradoPor)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="update certificado set EmitidoPor='".$EmitidoPor."' ,GeneradoPor='".$GeneradoPor."' ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////


function ingresarModoGrupo($IdGrupos,$IdModo,$ActivoModoCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into modo_grupo (IdGrupos,IdModo,ActivoModoCurso) values (".$IdGrupos.",".$IdModo.",".$ActivoModoCurso.") ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function ingresarModoTaller($Idtaller,$IdModo,$ActivoModoTaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into modo_taller (Idtaller,IdModo,ActivoModoTaller) values (".$Idtaller.",".$IdModo.",".$ActivoModoTaller.") ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function ingresarModoModulo($IdModulo,$IdModo,$ActivoModoModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into modo_modulo (IdModulo,IdModo,ActivoModoModulo) values (".$IdModulo.",".$IdModo.",".$ActivoModoModulo.") ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function actualizarModoCurso($IdModoCurso,$ActivoModoCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="update modo_curso set ActivoModoCurso=".$ActivoModoCurso." where IdModoCurso=".$IdModoCurso;
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function actualizarModoGrupo($IdModoGrupo,$ActivoModoCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="update modo_grupo set ActivoModoCurso=".$ActivoModoCurso." where IdModoGrupo=".$IdModoGrupo;
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function actualizarModoTaller($IdModoTaller,$ActivoModoCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="update modo_taller set ActivoModoTaller=".$ActivoModoCurso." where IdModoTaller=".$IdModoTaller;
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function actualizarModoModulo($IdModoModulo,$ActivoModoCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="update modo_modulo set ActivoModoModulo=".$ActivoModoCurso." where IdModoModulo=".$IdModoModulo;
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////


function ingresarCurso($DetalleCurso,$Calificacion,$CalificacionMinima,$Presentacion,$EstadoCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$llave = rand(1111111111,9999999999);
$sql="insert into cursos (LlaveCurso,DetalleCurso,Calificacion,CalificacionMinima,Presentacion,EstadoCurso) values ('".$llave."','".$DetalleCurso."',".$Calificacion.",".$CalificacionMinima.",'".$Presentacion."',".$EstadoCurso.")";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function actualizarCurso($IdCurso,$DetalleCurso,$Calificacion,$CalificacionMinima,$Presentacion,$EstadoCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="update cursos set  DetalleCurso='".$DetalleCurso."',Calificacion=".$Calificacion.",CalificacionMinima=".$CalificacionMinima.",Presentacion='".$Presentacion."',EstadoCurso=".$EstadoCurso." where  IdCurso=".$IdCurso;
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function ingresarNotaObtenidaGrupoModo($IdModoGrupo,$IdUsuario,$NotaObtenida,$NotaBase,$NotaMinima)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into resultado_grupo (IdModoGrupo,IdUsuario,NotaObtenida,NotaBase,NotaMinima,Fecha) values (".$IdModoGrupo.",".$IdUsuario.",".$NotaObtenida.",".$NotaBase.",".$NotaMinima.",'".date("y/m/d")."') ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function ingresarNotaObtenidaModulos($IdModulo,$IdUsuario,$NotaObtenida,$NotaBase,$NotaMinima)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into resultadoexamen (IdModulo,IdUsuario,NotaObtenida,NotaBase,NotaMinima,Fecha) values (".$IdModulo.",".$IdUsuario.",".$NotaObtenida.",".$NotaBase.",".$NotaMinima.",'".date("y/m/d")."') ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////



function ingresarNotaObtenidaTallerModo($IdModoTaller,$IdUsuario,$NotaObtenida,$NotaBase,$NotaMinima)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into resultado_taller (IdModoTaller,IdUsuario,NotaObtenida,NotaBase,NotaMinima,Fecha) values (".$IdModoTaller.",".$IdUsuario.",".$NotaObtenida.",".$NotaBase.",".$NotaMinima.",'".date("y/m/d")."') ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////


function ingresarNotaObtenidaCursoModo($IdModoCurso,$IdUsuario,$NotaObtenida,$NotaBase,$NotaMinima)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into resultado_curso (IdModoCurso,IdUsuario,NotaObtenida,NotaBase,NotaMinima,Fecha) values (".$IdModoCurso.",".$IdUsuario.",".$NotaObtenida.",".$NotaBase.",".$NotaMinima.",'".date("y/m/d")."') ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function ingresarNotaObtenida($IdUsuario,$IdModulo,$NotaObtenida,$NotaBase,$IdModo,$NotaMinima)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into resultadoexamen (IdUsuario,IdModulo,NotaObtenida,NotaBase,IdModo,NotaMinima,Fecha) values (".$IdUsuario.",".$IdModulo.",".$NotaObtenida.",".$NotaBase.",".$IdModo.",".$NotaMinima.",'".date("y/m/d")."') ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function ingresarCursoGrupo($IdGrupos,$IdCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into cursos_grupo (IdGrupos,IdCurso) values (".$IdGrupos.",".$IdCurso.") ";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function borrarCursoGrupo($IdCursosGrupo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="delete from cursos_grupo where IdCursosGrupo=".$IdCursosGrupo;
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function consultarDetallePreguntaTaller($IdPregunta)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  preguntas where IdPregunta=".$IdPregunta;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarDetalleRespPregMod($IdRespuesta)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  respuesta where IdRespuesta=".$IdRespuesta;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarRepuestasTotalesPregMod($IdPregunta)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  respuesta where IdPregunta=".$IdPregunta;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarTalleres()
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from taller ORDER BY  NombreTaller ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarTalleresCurso($IdCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from taller WHERE IdCurso=".$IdCurso." ORDER BY  NombreTaller ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarNotasPrePosTaller($Idtaller,$IdUsuario,$modo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from  modo_taller,resultado_taller where resultado_taller.IdUsuario=".$IdUsuario."  and resultado_taller.IdModoTaller=modo_taller.IdModoTaller  and  modo_taller.Idtaller=".$Idtaller." and modo_taller.IdModo=".$modo;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarNotasPrePosModulo($IdModulo,$IdUsuario,$IdModo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from  resultadoexamen where IdModo=".$IdModo." and IdModulo=".$IdModulo." and IdUsuario=".$IdUsuario;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarNotasPrePosModuloTope1($IdModulo,$IdUsuario,$IdModo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from  resultadoexamen,usuarios where usuarios.Usuario='".$IdUsuario."'  and usuarios.IdUsuario=resultadoexamen.IdUsuario and  IdModo=".$IdModo." and IdModulo=".$IdModulo." and  NotaObtenida>=NotaMinima LIMIT 1 ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////




function consultarGruposUusarioAsignados($IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from grupos_usuario,grupos where grupos_usuario.IdUsuario=".$IdUsuario." and grupos.IdGrupos=grupos_usuario.IdGrupos order by grupos ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarTalleresCursoSeleccionado($IdCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from taller where IdCurso=".$IdCurso." ORDER BY Idtaller ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarModulosTallerSeleccionado($Idtaller,$LlaveTaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from taller,modulos where modulos.estado=1 and modulos.Idtaller=taller.Idtaller and taller.LlaveTaller='".$LlaveTaller."' and taller.Idtaller=".$Idtaller." ORDER BY modulos.Titulo ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarModulosTallerSeleccionadoPres($Idtaller,$LlaveTaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from taller,modulos where modulos.estado=1 and modulos.Idtaller=taller.Idtaller and taller.LlaveTaller='".$LlaveTaller."' and taller.Idtaller=".$Idtaller." ORDER BY IdModulo ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarEstudiantesCurso($IdCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from  cursos_grupo,grupos,grupos_usuario,usuarios where usuarios.IdUsuario=grupos_usuario.IdUsuario and grupos_usuario.IdGrupos=grupos.IdGrupos and grupos.IdGrupos=cursos_grupo.IdGrupos and cursos_grupo.IdCurso=".$IdCurso;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////


function consultarCursosGrupoSeleccionado($IdGrupos)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from cursos_grupo,cursos where cursos_grupo.IdGrupos=".$IdGrupos." and cursos.IdCurso=cursos_grupo.IdCurso and cursos.EstadoCurso=1 order by DetalleCurso ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarCursosGrupoSeleccionadoUsuario($Usuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from usuarios,grupos_usuario,grupos,cursos_grupo,cursos where    usuarios.Usuario='".$Usuario."' and grupos_usuario.IdUsuario=usuarios.IdUsuario and grupos.IdGrupos=grupos_usuario.IdGrupos  and cursos_grupo.IdGrupos=grupos.IdGrupos  and cursos.IdCurso=cursos_grupo.IdCurso   ORDER BY  cursos.DetalleCurso ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////



function consultarModosDelGrupo($IdGrupos,$IdModo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo_grupo  where IdGrupos=".$IdGrupos." and  IdModo=".$IdModo;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarModosDelTaller($Idtaller,$IdModo,$IdCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from taller,modo_taller where taller.Idtaller=".$Idtaller." and taller.IdCurso=".$IdCurso."  and modo_taller.IdModo=".$IdModo." and modo_taller.Idtaller=".$Idtaller."  and modo_taller.ActivoModoTaller=1 ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////



function consultarModosDelCurso($IdCurso,$IdModo,$IdGrupos)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo_curso,cursos,cursos_grupo where cursos_grupo.IdGrupos=".$IdGrupos." and cursos_grupo.IdCurso=cursos.IdCurso and cursos.IdCurso=modo_curso.IdCurso and modo_curso.IdCurso=".$IdCurso." and modo_curso.IdModo=".$IdModo." and  modo_curso.ActivoModoCurso=1 ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarPreguntasModGrupo($IdModo,$IdGrupos)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo_grupo,preguntas where  modo_grupo.IdModo=".$IdModo." and modo_grupo.IdGrupos=".$IdGrupos." and modo_grupo.ActivoModoCurso=1 and preguntas.IdModoGrupo=modo_grupo.IdModoGrupo  ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarPreguntasModulo($IdModulo,$LlaveModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modulos,preguntas where  preguntas.IdModulo=modulos.IdModulo and modulos.LlaveModulo='".$LlaveModulo."' and modulos.IdModulo=".$IdModulo;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////



function consultarPreguntasModTaller($IdModo,$Idtaller,$LlaveTaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from taller,modo_taller,preguntas where  taller.Idtaller=".$Idtaller." and taller.LlaveTaller='".$LlaveTaller."' and modo_taller.Idtaller=taller.Idtaller and modo_taller.IdModo=".$IdModo." and modo_taller.ActivoModoTaller=1 and  preguntas.IdModoTaller=modo_taller.IdModoTaller  ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////


function consultarPreguntasModCurso($IdModo,$IdCurso,$LlaveCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo_curso,preguntas,cursos where cursos.EstadoCurso=1 and cursos.LlaveCurso='".$LlaveCurso."' and cursos.IdCurso=modo_curso.IdCurso and modo_curso.IdModo=".$IdModo." and modo_curso.IdCurso=".$IdCurso." and modo_curso.ActivoModoCurso=1 and preguntas.IdModoCurso=modo_curso.IdModoCurso  ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////


function consultarAprobacionModosDelGrupo($IdModoGrupo,$IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from resultado_grupo where resultado_grupo.IdModoGrupo=".$IdModoGrupo." and resultado_grupo.IdUsuario=".$IdUsuario." and resultado_grupo.NotaObtenida>=resultado_grupo.NotaMinima ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarAprobacionModosDelGrupo2($IdModoGrupo,$IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from resultado_grupo where resultado_grupo.IdModoGrupo=".$IdModoGrupo." and resultado_grupo.IdUsuario=".$IdUsuario."  ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////


function consultarAprobacionModosDelTaller($IdModoTaller,$IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from resultado_taller where resultado_taller.IdModoTaller=".$IdModoTaller." and resultado_taller.IdUsuario=".$IdUsuario." and resultado_taller.NotaObtenida>=resultado_taller.NotaMinima ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////


function consultarAprobacionModosDelTaller2($IdModoTaller,$IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from resultado_taller where resultado_taller.IdModoTaller=".$IdModoTaller." and resultado_taller.IdUsuario=".$IdUsuario." ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////


function consultarAprobacionModosDelCurso($IdModoCurso,$IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from resultado_curso where resultado_curso.IdModoCurso=".$IdModoCurso." and resultado_curso.IdUsuario=".$IdUsuario." and resultado_curso.NotaObtenida>=resultado_curso.NotaMinima ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarAprobacionModosDelCurso2($IdModoCurso,$IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from resultado_curso where resultado_curso.IdModoCurso=".$IdModoCurso." and resultado_curso.IdUsuario=".$IdUsuario." ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////


function consultarTalleresUser()
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT 
  `taller`.NombreTaller,
  `taller`.estado,
  `grupos`.grupos,
  `taller`.Idtaller
FROM
  `taller`
  INNER JOIN `grupos` ON (`taller`.IdGrupos = `grupos`.IdGrupos) WHERE taller.estado = 1 order by NombreTaller";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarTalleresUserGrupo($IdGrupos)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT 
  `taller`.NombreTaller,
  `taller`.estado,
  `grupos`.grupos,
  `taller`.Idtaller
FROM
  `taller`
  INNER JOIN `grupos` ON (`taller`.IdGrupos = `grupos`.IdGrupos) WHERE taller.estado = 1 and grupos.IdGrupos= '$IdGrupos'order by NombreTaller";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarPreguntTalleresMod($IdModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
 $sql = "SELECT 
  modulos.Titulo,
  preguntas.IdPregunta,
  preguntas.IdModulo,
  preguntas.DetallePregunta
FROM
  modulos
  INNER JOIN preguntas ON (modulos.IdModulo = preguntas.IdModulo)
WHERE
  modulos.IdModulo =".$IdModulo;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarPreguntTallModuloModo($IdModoModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from preguntas where IdModoModulo=".$IdModoModulo;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function determinarSiPresentoExamenPre($IdModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from resultadoexamen where IdModo=1 and IdModulo=".$IdModulo;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function determinarVioPresentacion($IdModulo,$IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from vinculosmodulo where VistoPresentacion=1 and IdUsuario=".$IdUsuario." and IdModulo=".$IdModulo;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function determinarVioJuego($IdModulo,$IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from vinculosmodulo where VistoJuego=1 and IdUsuario=".$IdUsuario." and IdModulo=".$IdModulo;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function determinarVioJuego2($IdModulo,$IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from vinculosmodulo where VistoJuego2=1 and IdUsuario=".$IdUsuario." and IdModulo=".$IdModulo;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////


function consultarPreguntTalleresGrupoModo($IdModoGrupo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from preguntas where IdModoGrupo=".$IdModoGrupo." ORDER BY DetallePregunta ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarPreguntTalleresCursoModo($IdModoCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
 $sql = "select * from preguntas where IdModoCurso=".$IdModoCurso." ORDER BY DetallePregunta ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarPreguntmodTarller($IdModoTaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
 $sql = "select * from preguntas where IdModoTaller=".$IdModoTaller." ORDER BY DetallePregunta ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarPreguntmodModulo($IdModoModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
 $sql = "select * from preguntas where IdModoModulo=".$IdModoModulo." ORDER BY DetallePregunta ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarModulosXLLave($LlaveModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  modulos where LlaveModulo='".$LlaveModulo."' ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////


function consultarModulosTalleres($Idtaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  modulos where Idtaller=".$Idtaller." order by Titulo";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarModulosTalleresActualPresentacion($Idtaller,$IdModulo,$LlaveModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  modulos where Idtaller=".$Idtaller." and  IdModulo=".$IdModulo." and LlaveModulo='".$LlaveModulo."'  order by Titulo";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarVistoPresentacion($IdModulo,$IdUsuario){
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  vinculosmodulo where IdModulo=".$IdModulo." and IdUsuario='".$IdUsuario."' and VistoPresentacion='1' ";
$rs = mysql_query($sql, $link);
$row=mysql_fetch_assoc($rs);
$count=mysql_num_rows($rs);
return $count;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarVistoJuego($IdModulo,$IdUsuario){
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
 $sql = "SELECT * FROM  vinculosmodulo where IdModulo=".$IdModulo." and IdUsuario='".$IdUsuario."' and VistoJuego='1'";
$rs = mysql_query($sql, $link);
$row=mysql_fetch_assoc($rs);
$count=mysql_num_rows($rs);
return $count;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarVistoJuego2($IdModulo,$IdUsuario){
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
 $sql = "SELECT * FROM  vinculosmodulo where IdModulo=".$IdModulo." and IdUsuario='".$IdUsuario."' and VistoJuego2='1'";
$rs = mysql_query($sql, $link);
$row=mysql_fetch_assoc($rs);
$count=mysql_num_rows($rs);
return $count;
}
function consultarPretestModulo($IdModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  preguntas where IdModulo=".$IdModulo;
$result = mysql_query($sql, $link);
$total = mysql_num_rows($result);
return $total;

}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarModulosTalleresActivo($Idtaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  modulos where Idtaller=".$Idtaller." and estado=1 order by Titulo";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarDetalleTaller($Idtaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  taller where Idtaller=".$Idtaller;
$result = mysql_query($sql, $link);
return $result;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function consultarDetalleModulo($IdModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  modulos where IdModulo=".$IdModulo;
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////
function consultarDetallesCurso($IdCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  cursos where IdCurso=".$IdCurso;
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////
function consultarDetallesTaller($Idtaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM taller where Idtaller=".$Idtaller;
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////

function consultarDetallesCursoXLLave($llavecurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  cursos where llavecurso='".$llavecurso."' ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////

function consultarDetallesGrupo($IdGrupos)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM grupos where IdGrupos=".$IdGrupos;
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////
function consultarDetallesModuloLLave($IdModulo,$LlaveModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  modulos where IdModulo=".$IdModulo." and LlaveModulo='".$LlaveModulo."' ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////

function consultarCodigosPretestPostestModulo($IdModulo,$LlaveModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  modulos,modo_modulo where modo_modulo.ActivoModoModulo=1 and modo_modulo.IdModulo=modulos.IdModulo  and modulos.IdModulo=".$IdModulo." and modulos.LlaveModulo='".$LlaveModulo."' ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////



function consultarDetallesTallerLLave($Idtaller,$LlaveTaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  taller where Idtaller=".$Idtaller." and LlaveTaller='".$LlaveTaller."' ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////


function consultarDetallesCursoLLave($IdCurso,$LlaveCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  cursos where IdCurso=".$IdCurso." and LlaveCurso='".$LlaveCurso."' ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////

function consultarHistorialNotasUsuarioModulo($IdUsuario,$IdModulo,$IdModo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from resultadoexamen,usuarios,modulos where modulos.IdModulo=resultadoexamen.IdModulo and usuarios.IdUsuario=resultadoexamen.IdUsuario and resultadoexamen.IdModo=".$IdModo." and resultadoexamen.IdUsuario=".$IdUsuario." and resultadoexamen.IdModulo=".$IdModulo." ORDER BY resultadoexamen.NotaObtenida  ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////


function consultarHistorialNotasUsuarioTaller($IdUsuario,$Idtaller,$IdModo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo_taller,resultado_taller where resultado_taller.IdUsuario=".$IdUsuario." and resultado_taller.IdModoTaller=modo_taller.IdModoTaller and modo_taller.IdModo=".$IdModo."  and modo_taller.Idtaller=".$Idtaller."  order by NotaObtenida ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////



function consultarHistorialNotasUsuarioCursos($IdUsuario,$IdCurso,$IdModo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo_curso,resultado_curso where resultado_curso.IdUsuario=".$IdUsuario." and resultado_curso.IdModoCurso=modo_curso.IdModoCurso and modo_curso.IdModo=".$IdModo."  and modo_curso.IdCurso=".$IdCurso."  ORDER BY NotaObtenida ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////


function consultarHistorialNotasUsuarioGrupo($IdUsuario,$IdGrupos,$IdModo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo_grupo,resultado_grupo where resultado_grupo.IdUsuario=".$IdUsuario."  and resultado_grupo.IdModoGrupo=modo_grupo.IdModoGrupo  and modo_grupo.IdGrupos=".$IdGrupos." and modo_grupo.IdModo=".$IdModo." ORDER BY resultado_grupo.NotaObtenida ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////

function consultarHistorialNotasReporte($IdGrupos)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo_grupo,resultado_grupo where resultado_grupo.IdUsuario=".$IdUsuario."  and resultado_grupo.IdModoGrupo=modo_grupo.IdModoGrupo  and modo_grupo.IdGrupos=".$IdGrupos." and modo_grupo.IdModo=".$IdModo." ORDER BY resultado_grupo.NotaObtenida ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////


function consultarHistorialModuloUsuario($Idtaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modulos where Idtaller=".$Idtaller." ORDER BY  Titulo ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////


function consultarHistorialTallerUsuario($IdCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from taller where IdCurso=".$IdCurso." ORDER BY  NombreTaller ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////

function consultarHistorialEstudiantesCursoReporte($IdCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from cursos_grupo,grupos,grupos_usuario where cursos_grupo.IdCurso=".$IdCurso." and grupos.IdGrupos=cursos_grupo.IdGrupos and grupos_usuario.IdGrupos=grupos.IdGrupos  ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////


function consultarHistorialCursosAprobaronReporte($IdCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select resultadoexamen.idusuario from resultadoexamen,modulos,taller where taller.IdCurso=".$IdCurso." and taller.Idtaller=modulos.Idtaller  and modulos.IdModulo=resultadoexamen.IdModulo and resultadoexamen.NotaObtenida>=resultadoexamen.NotaBase and resultadoexamen.IdModo=2 group by resultadoexamen.idusuario ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////


function consultarCertifiacionGrupo($IdCurso,$usuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from usuarios,taller,modulos,resultadoexamen where resultadoexamen.IdModo=2 and  taller.idcurso=".$IdCurso." and modulos.idtaller=taller.idtaller and resultadoexamen.IdModulo=modulos.IdModulo and resultadoexamen.IdUsuario=usuarios.IdUsuario and usuarios.Usuario='".$usuario."'   ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////

function informacionCertificado()
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from  certificado ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////


function consultarHistorialCursosUsuario($IdGrupos)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from cursos_grupo,cursos where cursos.IdCurso=cursos_grupo.IdCurso and cursos_grupo.IdGrupos=".$IdGrupos." ORDER BY DetalleCurso ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////


function consultarHistorialGuposUsuario($Usuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from usuarios,grupos_usuario,grupos where grupos.IdGrupos=grupos_usuario.IdGrupos and grupos_usuario.IdUsuario=usuarios.IdUsuario  and usuarios.IdUsuario='".$Usuario."'  ORDER BY grupos.grupos ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////

function consultarHistorialUsuario($IdUsuario)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from resultadoexamen,modo,modulos,taller where taller.IdTaller=modulos.IdTaller and modulos.IdModulo=resultadoexamen.IdModulo  and modo.IdModo=resultadoexamen.IdModo  and IdUsuario=".$IdUsuario." order by resultadoexamen.IdModulo,modo.IdModo ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////
function consultarCursos()
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from  cursos ORDER BY DetalleCurso ";
$result = mysql_query($sql, $link);
return $result;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function consultarCursosGrupoTodo($IdGrupos)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from  cursos_grupo,cursos where cursos.IdCurso=cursos_grupo.IdCurso and cursos_grupo.IdGrupos=".$IdGrupos;
$result = mysql_query($sql, $link);
return $result;
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function consultarInfoCert()
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from  certificado  ";
$result = mysql_query($sql, $link);
return $result;
}
//////////////////////////////////////////////////////////////////////////////////////////////////


function consultarModosCurso($IdCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo_curso,modo where modo.IdModo=modo_curso.IdModo and modo_curso.IdCurso=".$IdCurso;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarModosGrupo($IdGrupos)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo_grupo,modo where modo.IdModo=modo_grupo.IdModo and modo_grupo.IdGrupos=".$IdGrupos;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////

function consultarModosTaller($Idtaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo_taller,modo where modo.IdModo=modo_taller.IdModo and modo_taller.Idtaller=".$Idtaller;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarModosModulo($IdModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo_modulo,modo where modo.IdModo=modo_modulo.IdModo and modo_modulo.IdModulo=".$IdModulo;
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarModos()
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "select * from modo ORDER BY DetalleModo ";
$result = mysql_query($sql, $link);
return $result;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function validacionNuevoModoCurso($IdCurso,$IdModo)
{
$existe=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM modo_curso WHERE IdCurso=".$IdCurso." and IdModo=".$IdModo;
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$existe=1;
	 }
return $existe;
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function validacionNuevoModoGrupo($IdGrupos,$IdModo)
{
$existe=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM modo_grupo WHERE IdGrupos=".$IdGrupos." and IdModo=".$IdModo;
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$existe=1;
	 }
return $existe;
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function validacionNuevoModoTaller($Idtaller,$IdModo)
{
$existe=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM modo_taller WHERE Idtaller=".$Idtaller." and IdModo=".$IdModo;
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$existe=1;
	 }
return $existe;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function validacionNuevoModoModulo($IdModulo,$IdModo)
{
$existe=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM modo_modulo WHERE IdModulo=".$IdModulo." and IdModo=".$IdModo;
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$existe=1;
	 }
return $existe;
}
//////////////////////////////////////////////////////////////////////////////////////////////////



function respuestaValida($IdRespuesta)
{
$valido=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM respuesta WHERE IdRespuesta=".$IdRespuesta." and  Correcta=1 ";
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$valido=1;
	 }
return $valido;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function aproboPreText($IdModulo,$IdUsuario)
{
$valido=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM resultadoexamen WHERE IdModo=1 and NotaObtenida>=NotaMinima and IdModulo=".$IdModulo." and IdUsuario=".$IdUsuario;
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$valido=1;
	 }
return $valido;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function NotaPreText($IdModulo,$IdUsuario)
{

$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM resultadoexamen WHERE IdModo=1 and IdModulo=".$IdModulo." and IdUsuario=".$IdUsuario;
$result = mysql_query($sql, $link);
$row = mysql_fetch_array($result);
return $row["NotaObtenida"];
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarEstadoPasoUser($IdModo,$IdUsuario,$IdModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
 $sql = "SELECT 
  resultadoexamen.IdResultado,
  resultadoexamen.IdUsuario,
  resultadoexamen.IdModulo,
  resultadoexamen.NotaObtenida,
  resultadoexamen.Fecha,
  resultadoexamen.NotaBase,
  resultadoexamen.IdModo,
  resultadoexamen.NotaMinima,
  resultadoexamen.VistoPresentacion,
  resultadoexamen.VistoJuego,
  resultadoexamen.VistoJuego2
FROM
  resultadoexamen
WHERE
  resultadoexamen.IdModo = $IdModo  AND 
  resultadoexamen.IdUsuario = $IdUsuario AND 
  resultadoexamen.IdModulo = $IdModulo ";
$result = mysql_query($sql, $link);
return $result;
}

//////////////////////////////////////////////////////////////////////////////////////////////////
function actualizarVistoPresentacion($IdUsuario,$IdModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="insert into vinculosmodulo (IdUsuario,IdModulo,VistoPresentacion) values (".$IdUsuario.",".$IdModulo.",'1')";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function actualizarVistoJuego($IdUsuario,$IdModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
 $sql="insert into vinculosmodulo (IdUsuario,IdModulo,VistoJuego) values (".$IdUsuario.",".$IdModulo.",'1')";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
function actualizarVistoJuego2($IdUsuario,$IdModulo)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
 $sql="insert into vinculosmodulo (IdUsuario,IdModulo,VistoJuego2) values (".$IdUsuario.",".$IdModulo.",'1')";
$result = mysql_query($sql);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
function aproboTaller($IdTaller,$IdUsuario)
{
$valido=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT 
  resultadoexamen.IdUsuario,
  resultadoexamen.IdModulo,
  resultadoexamen.NotaObtenida,
  resultadoexamen.Fecha,
  resultadoexamen.NotaBase,
  resultadoexamen.IdModo,
  resultadoexamen.NotaMinima,
  modulos.Idtaller,
  modulos.Presentacion
FROM
  taller
  INNER JOIN modulos ON (taller.Idtaller = modulos.Idtaller)
  INNER JOIN resultadoexamen ON (modulos.IdModulo = resultadoexamen.IdModulo)
WHERE
  NotaObtenida >= NotaMinima AND 
  resultadoexamen.IdModo = 2 AND 
  resultadoexamen.IdUsuario = '".$IdUsuario."' and
  modulos.Idtaller='".$IdTaller."'";
$result = mysql_query($sql, $link);
while ($row = mysql_fetch_array($result))
	 {
		$valido=1;
	 }
return $valido;
}
////////////////////////////////////////////
/////////////////////////////////////////////
function validapasoaposttest($IdUsuario,$Titulo){
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM  resultadoexamen,  modo,  modulos,  taller
WHERE
  taller.IdTaller = modulos.IdTaller AND 
  modulos.IdModulo = resultadoexamen.IdModulo AND 
  modo.IdModo = resultadoexamen.IdModo AND 
  IdUsuario = $IdUsuario AND 
  Titulo = '$Titulo' AND 
  detalleModo = 'PostTest'        and
  notaobtenida>=notaminima
ORDER BY
  resultadoexamen.IdModulo,
  modo.IdModo";
$result = mysql_query($sql);
$row=mysql_fetch_assoc($result);
$total= mysql_num_rows($result);
return $total;
}

//////////////////////////////////////////////////////////////////////////////////////////////////

function validacionCursoGrupo($IdGrupos,$IdCurso)
{
$existe=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT * FROM cursos_grupo WHERE IdGrupos=".$IdGrupos." and IdCurso=".$IdCurso;
$result = mysql_query($sql, $link);

while ($row = mysql_fetch_array($result))
	 {
		$existe=1;
	 }
return $existe;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function validacionAproboModulo($IdModulo,$LlaveModulo)
{
$existe=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="select *  from resultadoexamen,modulos where resultadoexamen.IdModulo=modulos.IdModulo and modulos.IdModulo=".$IdModulo." and modulos.LlaveModulo='".$LlaveModulo."' and resultadoexamen.NotaObtenida>=resultadoexamen.NotaMinima limit 1 ";
$result = mysql_query($sql, $link);
while ($row = mysql_fetch_array($result))
	 {
		$existe=1;
	 }
return $existe;
}
//////////////////////////////////////////////////////////////////////////////////////////////////

function validacionAproboModuloPost($IdModulo,$LlaveModulo,$idusuario)
{
$existe=0;
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]); 
mysql_select_db($_SESSION["basededatos"], $link); 
$sql="SELECT *  FROM resultadoexamen,modulos WHERE resultadoexamen.IdModo=2 and resultadoexamen.IdModulo=modulos.IdModulo AND modulos.IdModulo=".$IdModulo." AND modulos.LlaveModulo='".$LlaveModulo."' AND resultadoexamen.NotaObtenida>=resultadoexamen.NotaMinima AND IdUsuario = '".$idusuario."' limit 1 ";
$result = mysql_query($sql, $link);
while ($row = mysql_fetch_array($result))
	 {
		$existe=1;
	 }
return $existe;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function consultarPostestCurso($IdCurso)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  modo_curso where IdModo=2 and IdCurso=".$IdCurso;
$result = mysql_query($sql, $link);
$total = mysql_num_rows($result);
return $total;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function consultarPostestTaller($Idtaller)
{
$link = mysql_connect($_SESSION["servidor"], $_SESSION["root"],$_SESSION["claveBD"]);
mysql_select_db($_SESSION["basededatos"], $link); 
$sql = "SELECT * FROM  modo_taller where IdModo=2 and Idtaller=".$Idtaller;
$result = mysql_query($sql, $link);
$total = mysql_num_rows($result);
return $total;

}
/////////////////////////////////////////////////////////////////////////////////////////////


}
?>

