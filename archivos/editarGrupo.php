<?php 
require_once('../Connections/cnxRamp.php');
include("../clases/clsusuario.php");


mysql_select_db($database_cnxRamp, $cnxRamp);

if($_POST['actualizar']== 1)
{
	$query_rsArchVsGrupo = "update grupos set grupos = '" . $_POST['nombreGrupo'] . "',activo = " . $_POST['estado'] . " where idGrupos = '" . $_POST['grupo'] . "'";
					 // echo "update grupos set grupos = '" . $_POST['nombreGrupo'] . "',activo = " . $_POST['estado'] . " where idGrupos = '" . $_POST['grupo'] . "'";
	//$query_rsArchVsGrupo = "update grupos set grupos = '" . $_POST['nombreGrupo'] . "' where grupos = '" . $_POST['codGrupo'] . "'";
	$res = mysql_query($query_rsArchVsGrupo, $cnxRamp);//Actualiza el grupo
	
}



$query_rsConsulta1 = "SELECT * FROM grupos where grupos = '" . $_POST['nombreGrupo'] . "'";
//echo $query_limit_rsConsulta1 . "</br>";
$rsConsulta1 = mysql_query($query_rsConsulta1, $cnxRamp) or die(mysql_error());
$row_rsConsulta1 = mysql_fetch_assoc($rsConsulta1);

$estado = $row_rsConsulta1['activo'];
$codGrupo = $row_rsConsulta1['idGrupos'];

/*
mysql_select_db($database_cnxRamp, $cnxRamp);
if($res)
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #CCC;
}
-->
</style>
<link href="../css/stilos.css" rel="stylesheet" type="text/css" />
<link href="../css/galeria.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="frmActGrupo" name="frmActGrupo" method="post" action="editarGrupo.php">
  <label for="editNombeGrupo"></label>
  <table width="340" border="0" cellpadding="0" cellspacing="0" class="borde_alrededor">
    <tr>
      <td width="53%" bgcolor="#C9D7DA" class="encabezado">&nbsp; Cambiar nome categoria</td>
      <td width="33%" align="center" bgcolor="#C9D7DA" class="encabezado">Ativar desativar</td>
      <td width="14%" class="encabezado"></td>
    </tr>
    <tr>
      <td height="22" bgcolor="#CCCCCC" class="descripcion">&nbsp;&nbsp;&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td height="31" bgcolor="#CCCCCC"> &nbsp;
        <input name="editNombeGrupo" type="text" class="descripcion" id="editNombeGrupo" value="<?php echo $_POST['nombreGrupo']; ?>" />
      <input name="editCodGrupo" type="hidden" id="editCodGrupo" value="<?php echo $codGrupo; ?>" /></td>
      <td align="center" bgcolor="#CCCCCC"><input <?php if (!(strcmp($estado,1))) {echo "checked=\"checked\"";} ?> name="editActivo" type="checkbox" id="editActivo" value="1" >
      <input name="actualizar" type="hidden" id="actualizar" value="1" /></td>
      <td align="center" bgcolor="#CCCCCC"><a href="#" class="descripcion" onclick="actGrupoGuardar();">Salvar</a></td>
    </tr>
    <tr>
      <td height="19" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td height="19" colspan="3" align="right" bgcolor="#FFFFFF"><a href="#" class="descripcion" onclick="ocultarAdmin();">Fechar</a></td>
    </tr>
  </table>
</form>
</body>
</html>