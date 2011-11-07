<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>:: CUESTIONARIO ::</title>
<script language="JavaScript" src="js.js" type="text/javascript"></script>
<link href="../INDEX.CSS" rel="stylesheet" type="text/css">
<link href="../css/stilos.css" rel="stylesheet" type="text/css">
<link href="../galeria/css/galeria.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../ajax/core.js"></script>
<style type="text/css">
body{background-color:#ffffff;}
</style>
<script language="javascript">
function alAbrir()
{
	var a;
	a=document.getElementById("grupo").value;
	invocaGenericoPost("archivosgrupo","arcvsGrupo.php","grupo="+a,"cargando lista de archivos para este grupo, espere.......");
	}
function pasarUsuario(codUsuario)
{
	var b;
	b=document.getElementById("grupo").value;
	invocaGenericoPost("apDiv2","insertaUsVsGrupo.php","grupoId="+b+"&usuId="+codUsuario,"insertando espere.......");
	refrescar();
}
function insertaItem(archivo,descargas)
{
	var b;
	b=document.getElementById("grupo").value;
	invocaGenericoPost("archivosgrupo","addarchvsgrupo.php","grupo="+b+"&archivo="+archivo+"&ndesc="+descargas,"insertando espere.......");
	//refrescar();
}
function borraItem(interno,archivo)
{
	var b;
	b=document.getElementById("grupo").value;
	invocaGenericoPost("archivosgrupo","borrarArchvsGrupo.php","grupo="+b+"&archivo="+archivo+"&interno="+interno,"borrando espere.......");
	//refrescar();
}
function buscaArchivo()
{
	var b;
	b=document.getElementById("nombre").value;
	if (b=='')
	{
		alert("debe ingresar un nombre de archivo para buscar");
	}
	else
	{
		invocaGenericoPost("archivos","filtrararchivos.php","nombre="+b,"Buscando espere.......");
	//refrescar();
	}
}
function administraDescarga(usuario)
{
	alert(usuario);
	invocaGenericoPost('apDiv4','administraDescargas.php','usuario='+usuario,'Buscando espere.......')
}
</script>
</head>
<body onLoad="javascript:alAbrir();">
<table width="330" height="129%" align="left" cellpadding="0" cellspacing="0">
  <!-- banner superior -->
  <!-- menu superior -->
  <!-- zona central -->
  <tr>
    <td width="48" valign="top" background="" class="body-text1">&nbsp;</td>
    <td width="280" height="152" valign="top" background="" class="body-text1"><div id="uno">
      <table cellpadding="5" cellspacing="1" width="100%" height="4%">
        
        <tr>
          <td  height="10" align="right"><input name="grupo" type="hidden" id="grupo" value="<?php echo $_GET['grupo']; ?>">
            <a href="#" class="descripcion" onClick="parent.cargaAdmGrupos()">Terminar</a></td>
        </tr>
      </table>
    </div>
        <div id="archivos">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="14" valign="bottom" class="descripcion">&nbsp;</td>
            </tr>
            <tr>
              <td height="15" valign="bottom" class="descripcion"><strong>Buscar arquivos dispon&iacute;veis </strong></td>
            </tr>
            <tr>
              <td width="96%">&nbsp;</td>
            </tr>
            <tr>
              <td><label>
                  <input name="nombre" type="text" class="descripcion" id="nombre" />
                  <input name="aceptar" type="button" class="descripcion" id="aceptar" onclick="buscaArchivo()" value="Buscar" />
                </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="descripcion">Escreva parte do nome ou o nome completo </td>
            </tr>
            <tr>
              <td class="descripcion">&nbsp;</td>
            </tr>
          </table>
</div>
        <div id="archivosgrupo">&nbsp;</div></td>
  </tr>
  <!-- footer -->
  <tr>
    <td class="body-text1" align="center"></td>
    <td class="body-text1" height="20" align="center"></td>
  </tr>
</table>
</body>
</html>

