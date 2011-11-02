<?php

session_start();

//validar sesion
if($_SESSION["usuario"]=="")
 {
  ?>
  <script language="javascript">
  document.location="inicio.html";
  </script>
  <?php
 }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript" src="../ajax/core.js"></script>
<script language="javascript" src="../ajax/jquery1.4.2.js"></script>
<script language="javascript" type="text/javascript">
var x;
$(document).ready(function(){
	x=$('#idGrupo').val();
	cargar(x);
});

	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("listar.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup

	function fill(thisValue,thisCode) {
		$('#inputString').val(thisValue);
		$('#id_seleccionado').val(thisCode);
		setTimeout("$('#suggestions').hide();", 200);
	}

function cargar(idGrupo,args)
{
    invocaGenericoPost("zonaCarga","verSubcategorias.php","grupo="+idGrupo+"&"+args,"...");
}
function actualizar(id)
{
	var idGrupo;
	var estado;
	var nombre;
	idGrupo=$('#IdGrupo'+id).val();
	if($('#Estado'+id).is(':checked')){estado=1}else{estado=0};
	nombre=$('#nombre'+id).val();
	if(idGrupo.length==0)
		alert("Grupo invalido");
	else
	{
		invocaGenericoPost("estado"+id,"ActualizarRegistroSubcat.php","accion=actualizar&nombre="+nombre+"&estado="+estado+"&idGrupos="+idGrupo,"...");
	}
}
function agregar(args)
{
	var idGrupo;
	var estado;
	var idGrupoPadre;
	idGrupoPadre=$('#idGrupo').val();
	
	if($('#nuevoEstado').is(':checked')){estado=1}else{estado=0};
	idGrupo=$('#id_seleccionado').val();
	alert(idGrupoPadre + " " + idGrupo);
	if($('#nuevoEstado').is(':checked')){estado=1}else{estado=0};
	if(idGrupo.length==0)
		alert("Grupo invalido");
	else
	{
		//alert("accion=agregar&PADRE="+idGrupoPadre+"&estado="+estado+"&idGrupos="+idGrupo);
		invocaGenericoPost("estadoNuevo","ActualizarRegistroSubcat.php","accion=agregar&padre="+idGrupoPadre+"&estado="+estado+"&idGrupos="+idGrupo,"...");
		//cargar(x,args);
	}
}
function paginar(args)
{
	invocaGenericoPost("zonaCarga","verSubcategorias.php","grupo="+x+"&"+args,"...");
}
function eliminar(id)
{
	var idGrupo;
	var estado;
	var idGrupoPadre;
	idGrupo=$('#IdGrupo'+id).val();
	alert ("el grupo " + idGrupo + "el id " + id);
	if(confirm("Esta seguro de sacar este subgrupo del grupo?"))
	{
		//alert("accion=agregar&PADRE="+idGrupoPadre+"&estado="+estado+"&idGrupos="+idGrupo);
		invocaGenericoPost("estado"+id,"ActualizarRegistroSubcat.php","accion=eliminar&idGrupos="+idGrupo,"...");
		cargar(x,args);
	}
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

<link href="../css/Subcategorias.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/suggest.css">
</head>

<body>
<div id="zonaCarga"></div>
<table width="960" border="0" cellpadding="0">
  <tr class="celda">
    <th width="12" scope="col"><img src="../imagenes/flecha.jpg" alt="" width="12" height="27" /></th>
    <td width="942" class="borde_arriba_abajo" scope="col"><div align="left">&nbsp;&nbsp;Sub Grupos pertenecientes a: <?php echo $_GET['nombreGrupo']; ?>
        <input name="idGrupo" type="hidden" id="idGrupo" value="<?php echo $_GET['grupo']; ?>" />
    </div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>