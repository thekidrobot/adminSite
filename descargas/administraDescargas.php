<?php
include("../Connections/cnxRamp.php");
include ('../pear/tree_view/Tree.php');
include("../conexion.php");
include("../clases/clsusuario.php");



$objGrupos=new clsusuario();
if(isset($_POST['usuario']) && isset($_POST['grupo']))
	$RSresultado=$objGrupos->descargas_x_usuario($_POST['usuario'],$_POST['grupo']);
else
	$RSresultado=$objGrupos->descargas_x_grupo($_POST['grupo']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>archivos</title>
<style>
.tablaAct {
	text-align:center;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 9px;
	color: #000;
	background-color: #CCC;
}
th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	font-style: normal;
	font-weight: bold;
	color: #FFF;
	background-color: #00C;
}
#linkCerrar {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	color: #E8E8E8;
	text-align: right;
}
#linkCerrar a {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	color: #FFF;
}
</style>
<link href="../galeria/css/galeria.css" rel="stylesheet" type="text/css" />
<link href="../css/stilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="351" border="0" cellpadding="0" cellspacing="0" class="borde_alrededor">
  <tr>
    <th colspan="3" class="fondo_encabezado" scope="col">Gerenciar o acesso</th>
  </tr>
  <tr>
    <th width="28%" class="encabezado" scope="col">Adicionar</th>
    <th width="13%" class="encabezado" scope="col">Usado</th>
    <th width="59%" class="encabezado" scope="col">Nome do Arquivo</th>
  </tr>
  <?php
  		 while ($row = mysql_fetch_array($RSresultado))
		 {?>
                  <tr class="descripcion_borde_inferior">
                  
                    <td align="center" valign="middle" bgcolor="#FFFFFF" class="borde_derecho"><div class="fuente-verde" id="reg<?php echo $row['UGD_CONSECUTIVO']; ?>"><?php echo $row['UGD_DESCARGAS']; ?>&nbsp; 
                      <label for="descargas"></label>
                    <input name="descargas<?php echo $row['UGD_CONSECUTIVO']; ?>" type="text" class="descripcion" id="descargas<?php echo $row['UGD_CONSECUTIVO']; ?>" value="<?php echo $row['UGD_DESCARGAS']; ?>" size="2" maxlength="3" />
                    &nbsp; 
                    <a href="#" onclick="javascript:actualizaDescargas(<?php echo $row['UGD_CONSECUTIVO']; ?>)"><img src="images/co.png" width="21" height="17" border="0" align="middle" /></a></div></td>
                    <td align="center" valign="top" bgcolor="#FFFFFF" class="borde_derecho"><?php echo $row['visitas']; ?></td>
                    <td valign="top" bgcolor="#FFFFFF" class="descripcion"> &nbsp; <?php echo $row['titulo']; ?></td>
                    
  </tr>
                  <tr class="descripcion_borde_inferior">
                    <td colspan="3" align="right" valign="middle" bgcolor="#FFFFFF" class="borde_derecho"></td>
                  </tr>
	  <?php
          }
        ?>
</table>
<table width="351" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right" bgcolor="#FFFFFF"><a href="#" class="descripcion" onclick="javascript:ocultarAdmin()">Fechar</a></td>
  </tr>
</table>
</body>
</html>