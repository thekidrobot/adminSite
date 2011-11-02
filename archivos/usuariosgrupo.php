<?php 
session_start();
include("../clases/clsusuario.php");
$_SESSION['sesNgrupo'] = $_GET['nombreGrupo'];



$objGrupos=new clsusuario();
$codGrupo=$objGrupos->obtenerIdGrupo($_SESSION['sesNgrupo']);

 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>:: CUESTIONARIO ::</title>
<script language="JavaScript" src="js.js" type="text/javascript">
</script>
<link href="../INDEX.CSS" rel="stylesheet" type="text/css">
<link href="../css/stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="../ajax/core.js"></script>
<script language="javascript" src="js/light/js/jquery.js"></script>



<script language="javascript">
function alAbrir()
{
	var a;
	a=<?php echo $codGrupo; ?>;
	<?php if(isset($_GET['nombreGrupo'])){?>
		parent.document.getElementById("apDiv2").style.display="";
		parent.document.getElementById("apDiv3").style.display="";
		parent.document.getElementById("apDiv1").style.display="none";
		parent.document.getElementById("frm2").src="archivosgrupo.php?grupo=<?php echo $codGrupo; ?>";
		//$('#frm1').fadeOut('slow');
	<?php } ?>
ocultarAdmin();

	invocaGenericoPost("archivosgrupo","usuarioVsGrupo.php","grupo="+a,"cargando lista de archivos para este grupo, espere.......");
	}
function pasarUsuario(codUsuario)
{
	var b;
	b=document.getElementById("grupo").value;
	invocaGenericoPost("apDiv2","insertaUsVsGrupo.php","grupoId="+b+"&usuId="+codUsuario,"insertando espere.......");
	refrescar();
}
function insertaItem(archivo)
{
	var b;
	var c;
	var d;
	b=<?php echo $codGrupo; ?>;
	d=document.getElementById("grupo").value;
	c=document.getElementById("descargas").value;
	invocaGenericoPost("archivosgrupo","addUsuariosvsgrupo.php","grupo="+b+"&usuario="+archivo+"&cantidad="+c+"&nomGrupo="+d,"insertando espere.......");
	//refrescar();
}
function borraItem(usuario,grupos,hijo)
{
	var b;
	b=document.getElementById("grupo").value;
	invocaGenericoPost("archivosgrupo","borrarUsuarioVsGrupo.php","usuario="+usuario+"&grupo="+grupos+"&hijo="+hijo,"borrando espere.......");
	//refrescar();
}
function buscaArchivo()
{
	var b;
	b=document.getElementById("nombre").value;
	if (b=='')
	{
		alert("debe ingresar un nombre de usuario para buscar");
	}
	else
	{
		invocaGenericoPost("archivos","filtrarUsuarios.php","nombre="+b,"Buscando espere.......");
	//refrescar();
	}
}
function borrarTodos(grupo)
{
	var b;
	if(confirm("Esta seguro de eliminar toda esta información?"))
	{
		b=<?php echo $codGrupo; ?>;
		invocaGenericoPost("archivosgrupo","borrarTodoGrupo.php","grupo="+b,"borrando espere.......");
	}
}
function editarGrupo()
{
	
	$('#divEditarGrupo').fadeIn(500);
	var nombreGrupo;
	nombreGrupo = '<?php  echo $_GET['nombreGrupo'] ?>';
	var b;
	b=document.getElementById("grupo").value;	
	invocaGenericoPost("divEditarGrupo","editarGrupo.php","nombreGrupo="+b,"borrando espere.......");
}
function administraDescarga(usuario,grupo)
{
	$('#apAdminUser').fadeIn(500);
	invocaGenericoPost("apAdminUser","administraDescargas.php","usuario="+usuario+"&grupo="+grupo,"Buscando espere.......");
}
function actualizaDescargas(id)
{
	var nuevoNumero = document.getElementById('descargas'+id).value;
	alert(nuevoNumero);
	invocaGenericoPost("reg"+id,"actualizaDescargas.php","idReg="+id+"&nuevoN="+nuevoNumero,"Buscando espere.......");
}
function ocultarAdmin(){
	$('#apAdminUser').fadeOut(500);
	$('#divEditarGrupo').fadeOut(100);
}
function actGrupoGuardar(){
	
	var nombre;
	var codigo;
	var estado;
	nombre = document.getElementById('editNombeGrupo').value;
	codigo = document.getElementById('editCodGrupo').value;
	if(document.getElementById('editActivo').checked==true)
	{
		estado = 1
	}
	else{
		estado=0;
		}
	//b=document.getElementById("grupo").value;	
	invocaGenericoPost("divEditarGrupo","editarGrupo.php","grupo="+codigo+"&nombreGrupo="+nombre+"&estado="+estado+"&actualizar=1","Actualizando espere.......");
	
	//invocaGenericoPost("reg"+id,"actualizaDescargas.php","idReg="+id+"&nuevoN="+nuevoNumero,"Buscando espere.......");

		
}
</script>
<link href="../galeria/css/galeria.css" rel="stylesheet" type="text/css">
<style type="text/css">
#apAdminUser {
	position:absolute;
	left:-1px;
	top:29px;
	width:340px;
	height:173px;
	z-index:4;
}
.tablaAct {
	text-align:left;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #000;
	background-color: #CCC;
}
#divEditarGrupo {
	position:absolute;
	left:-1px;
	top:32px;
	width:340px;
	height:127px;
	z-index:5;
	background-color: #999;
	visibility:;
	visibility: default;
}
body {
	background-color: #CCC;
}
</style>
</head>
<body leftmargin="0" topmargin="0" background="" onLoad="javascript:alAbrir();">
<div id="divEditarGrupo"></div>
<table width="340" height="129%" align="left" cellpadding="0" cellspacing="0">
  <!-- banner superior -->
  <!-- menu superior -->
  <!-- zona central -->
  <tr>
    <td height="189" valign="top" background="" class="body-text1"><div id="uno">
      <table width="340" height="4%" border="0" cellpadding="0" cellspacing="0">
        
        <tr>
          <td  height="29" class="trebuchet"><img src="../imagenes/spacer.gif" alt="b" width="1" height="1">Categoria: <?php echo $_GET['nombreGrupo']; ?>
            <input name="grupo" type="hidden" id="grupo" value="<?php echo $_GET['nombreGrupo']; ?>"></td>
          </tr>
        <tr>
          <td  height="10" align="right" class="trebuchet"><?php echo $estado; ?> <a href="#" class="descripcion" onClick="editarGrupo();">Cambiar nome Categoria</a></td>
          </tr>
      </table>
  </div>
        <div id="archivos">
          <table width="340" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="3" class="descripcion">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" class="descripcion"><strong>&nbsp; Buscar por parte do nome do Usu&aacute;rios</strong></td>
            </tr>
            <tr>
              <td width="3%">&nbsp;</td>
              <td width="97%">&nbsp;</td>
            </tr>
            <tr>
              <td valign="middle">&nbsp;</td>
              <td valign="middle"><label>
                  <input name="nombre" type="text" class="descripcion" id="nombre" />
                  <input name="aceptar" type="button" class="descripcion" id="aceptar" onclick="buscaArchivo()" value="Buscar" />
                </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="descripcion">&nbsp;</td>
              <td class="descripcion">Escreva parte do nome ou o nome completo </td>
            </tr>
            <tr>
              <td class="descripcion">&nbsp;</td>
              <td class="descripcion">&nbsp;</td>
            </tr>
          </table>
  </div>
        <div id="archivosgrupo">&nbsp;</div></td>
  </tr>
  <!-- footer -->
  <tr>
    <td class="body-text1" height="20" align="center"></td>
  </tr>
</table>
<div id="apAdminUser"></div>
</body>
</html>

