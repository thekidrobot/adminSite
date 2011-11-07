<?php
//	step 1: create the navigation data structure
include("../Connections/cnxRamp.php");
include ('../pear/tree_view/Tree.php');
include("../conexion.php");
include("../clases/clsusuario.php");

session_start();

//validar sesion
if($_SESSION["usuario"]=="")
 {
  ?>
  <script language="javascript">
  document.location="inicio.html";
  </script>
  <?
 }

///objetos
$objGrupos=new clsusuario();
//$objGrupos=new clsusuario();
$msg="";

///ingresar examen   
if($_POST["ingresar"]!="")
 {   
    $objGrupos->ingresarGrupos($_POST["valorTitulo"],$_POST['Nivel'],$_POST['id_seleccionado']);
    $msg="Registro ingresado";
 }

///actualizar
if($_POST["actualizar"]!="")
 {
	 if($_POST['activo']!='1')
	 	$activo=0;
	else
		$activo=1;
    $objGrupos->actualizarGrupos($_POST["actualizar"],$_POST["valorTitulo"],$activo,$_POST['Nivel'],$_POST['id_seleccionado'],$_POST['padreActual']);
    $msg="Registro actualizado";
 }


//informacion registro seleccionado
$vSubgrupos=0;
$vIdPadre=0;
if($_GET["actualizar"]!="")
 {
   $RSresultado=$objGrupos->consultarDetalleGrupos($_GET["actualizar"]);
   while ($row = mysql_fetch_array($RSresultado))
	 {
	  $vTitulo=$row["grupos"]; 
	  $vPresentacion=$row["Presentacion"]; 
	  $vCalificacionMinima=$row["CalificacionMinima"]; 
	  $vCalificacion=$row["Calificacion"]; 
	  $vActivo=$row["activo"];
	  $vNivel=$row["nivel"];
	  $vPadre=$row["descPadre"];
	  $vIdPadre=$row["padre"];
	  //$vSubgrupos = $objGrupos->verificarSubgrupos($_GET["actualizar"]);
     }
 }

$tree = &Tree::createFromMySQL(array('host'     => $hostname_cnxRamp,
                                     'user'     => $username_cnxRamp,
                                     'pass'     => $password_cnxRamp,
                                     'database' => $database_cnxRamp,
                                     'query'    => 'SELECT grupos.idGrupos as id,grupos.padre as parent_id, grupos.grupos as text FROM grupos order by padre,idGrupos'));

//	step 2:	initialise the class options
include ('../pear/tree_view/TreeMenu.php');
$nodeOptions = array(
 'text'          => '',
 'link'          => 'usuariosgrupo.php',
 'icon'          => 'folder.png',
 'expandedIcon'  => 'folder-expanded.png',
 'class'         => '',
 'expanded'      => true,
 'linkTarget'    => 'frm1',
 'isDynamic'     => 'true',
 'ensureVisible' => 'false',
 );

$options = array(	'structure' => $tree,
					'type' => 'heyes',
					'nodeOptions' => $nodeOptions);

//	step 3: create the HTML_TreeMenu object from the structure
$menu = &HTML_TreeMenu::createFromStructure($options);

//	step 4:	create a DHTML menu (or listbox) from the HTML_TreeMenu object
$treeMenu = &new HTML_TreeMenu_DHTML($menu, array('images' => 'imagesAlt2', 'defaultClass' => 'treeMenuDefault'));
//$treeMenu = &new HTML_TreeMenu_Listbox($menu, array('images' => 'imagesAlt2', 'defaultClass' => 'treeMenuDefault'));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
h3 {
	color: #5494af;
	font: 16px Arial, Helvetica, sans-serif;
	font-weight:bold;	
	text-align:center;
}
.treeMenuDefault {
 font: 12px Arial, Helvetica, sans-serif;
}
.treeMenuDefault img{
 padding-right:5px;
}
#apDiv4 {
	position:absolute;
	left:172px;
	top:320px;
	width:408px;
	height:24px;
	z-index:4;
	padding:0;
	margin:0;
}
#apDiv3 {
	position:absolute;
	left:381px;
	top:74px;
	width:337px;
	height:635px;
	z-index:3;
	padding:0;
	margin:0;
}
#apDiv2 {
	position:absolute;
	left:0px;
	top:73px;
	width:380px;
	height:600px;
	z-index:2;
	visibility: ;
	padding:0;
	margin:0;
}
</style>
<link rel="stylesheet" href="../css/suggest.css">
<script language="javascript" src="../js.js"></script>
<script type="text/javascript" src="../ajax/jquery1.4.2.js"></script>
<script type="text/javascript">

function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("../subcategorias/listar.php", {queryString: ""+inputString+""}, function(data){
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
	
	function cargaAdmGrupos(){
		//$('#frm1').fadeOut('slow');
		document.getElementById("apDiv2").style.display="none";
		document.getElementById("apDiv3").style.display="none";
		document.getElementById("apDiv1").style.display="";
		}
	function mostrarDivs(){
		document.getElementById("apDiv2").style.display="";
		document.getElementById("apDiv3").style.display="";
//		document.getElementById("apDiv1").style.display="none";
		}



</script>
<script src="../pear/tree_view/TreeMenu.js" language="JavaScript" type="text/javascript"></script>
<link href="js/light/css/lightbox.css" rel="stylesheet" type="text/css" />

<link href="../css/stilos.css" rel="stylesheet" type="text/css" />
<link href="../galeria/css/galeria.css" rel="stylesheet" type="text/css" />
</head>

<body onLoad="cargaAdmGrupos();">
<div id="apDiv1">
<h3>Criar Grupos</h3>
<form id="form1" name="form1" method="post" action="admGrupos.php" onSubmit="return validaGrupoNuevo()">
<table width="600" border="0">
  <tr>
    <td class="encabezado"><b>Criar novo grupo</b></td>
  </tr>
  <tr>
    <td width="89%"><b><label>Nome do novo grupo</label></b></td>
    </tr>
  <tr>
    <td><input type="text" name="valorTitulo" value="<?=$vTitulo?>" maxlength="100" size="30" class="tahoma_12"></td>
    </tr>
  <tr>
    <td><? 
		  if($_GET["actualizar"]!="")
		   {
		     ?>
          <input type="hidden" name="actualizar" value="<?=$_GET["actualizar"]?>">
          <? 
		   }
		  else
		   {
		     ?>
          <input type="hidden" name="ingresar" value="1">
        <? 
		   }
		  ?></td>
    </tr>
  <tr>
    <td><b><label>Pertence &agrave;</label></b></td>
    </tr>
  <tr>
    <td>
      <?php
			  //echo "actualizar = " . $_GET["actualizar"] . " id padre = " . $vIdPadre ;
			  if($_GET["actualizar"]=="" || $vIdPadre!=0)
			  	{
			  	?>
      <input type="text" class="descripcion" id="inputString2" onBlur="fill();" onKeyUp="lookup(this.value);" value="<?php echo $vPadre; ?>" size="30" />
      <input type="hidden" name="id_seleccionado" id="id_seleccionado" value="<?php echo $vIdPadre; ?>" />
      <br />
      <?php
				}else{
				?>
      <input type="text" class="descripcion" id="inputString" style="visibility:hidden" onBlur="fill();" onKeyUp="lookup(this.value);" value="<?php echo $vPadre; ?>" size="30" />
      <input type="hidden" name="id_seleccionado" id="id_seleccionado" value="<?php echo $vIdPadre; ?>" />
      <?php
				}
				?>
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <img src="../subcategorias/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="autoSuggestionsList">
          &nbsp;
          </div>
        </div>
      <input name="noNivel" type="hidden" id="noNivel" value="0"></td>
    </tr>
  <tr>
    <td><input type="hidden" name="valorNotaMinima" value="3" maxlength="3" size="10" class="controles1" />
      <input type="hidden" name="valorPresentacion" value="NA" maxlength="200" size="80" class="controles1" />
      <input type="hidden" name="valorNotaBase" value="3" maxlength="3" size="10" class="controles1" />
      <input name="padreActual" type="hidden" id="padreActual" value="<?php echo $vIdPadre; ?>" /></td>
    </tr>
  <tr>
    <td><input type="image" src="../imagenes/crear.jpg"></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>

</form>
<table width="600" border="0" cellpadding="0" cellspacing="0" class="borde_alrededor">
  <tr>
    <td class="encabezado">&nbsp;</td>
    <td class="encabezado">&nbsp;Categorias existentes</td>
    <td class="encabezado"><span class="letra_gris">Selecione una categoria existente para adicionar usu&agrave;rios e v&iacute;deo.</span></td>
  </tr>
  <tr>
    <td height="18" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="34">&nbsp;</td>
    <td height="34" colspan="2"><? $treeMenu->printMenu() ?></td>
    </tr>
</table>
<p>&nbsp;</p>
</div>
<div id="apDiv2">
<iframe id="frm1" name="frm1" style="width:100%;height:100%; border:none"></iframe>
</div>
<div id="apDiv3">
<iframe id="frm2" name="frm2" style="width:100%;height:100%; border:none"></iframe>
</div>
<table width="600" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td><h3>Gerenciar Categorias</h3></td>
  </tr>
</table>
</body>
</html>