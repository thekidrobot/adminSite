<?php
include("../Connections/cnxRamp.php");
include("../conexion.php");
include("../clases/clsusuario.php");

$idReg = $_POST['idReg'];
$nuevoN = $_POST['nuevoN'];

$objGrupos=new clsusuario();
$objGrupos->actualizaDescarga($idReg,$nuevoN);


echo $nuevoN; ?>
<label for="descargas"></label>
<input name="descargas<?php echo $idReg; ?>" type="text" id="descargas<?php echo $idReg; ?>" size="2" maxlength="3" />
<a href="#" onclick="javascript:actualizaDescargas(<?php echo $idReg; ?>)"><img src="images/co.png" width="21" height="17" border="0" /></a>
