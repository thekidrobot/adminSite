<?
include("Connections/cnxRamp.php");
include("session.php");

include("clases/clstaller.php");
include("clases/clsusuario.php");

///objetos
$objTaller=new clstaller();
$objUsuario=new clsusuario();
$msg="";

///ingresar   
if($_POST["ingresar"]!="")
 {
    $resp=$objUsuario->validacionLoginUsuario($_POST["valorLogin"]);
	
	if($resp=="1")
	 {
	  $objUsuario->ingresarUsuario($_POST["valorLogin"],$_POST["valorClave"],$_POST["valorNombre"],
																 $_POST['activo'],$_POST['licencia'],$_POST['txtKeyramp'],
																 $_POST['valorMac'],$_POST['valorSerial']);
	  $msg="Registroe enviado";
	 }
	else
	 {
	  $msg="O login já existe, por favor crie outro";
	 }
 }

if (trim($_GET['delete']) != ""){ 
 $str = "delete from grupos_usuario where IdUsuario =". $_GET['delete'];
 $sql = mysql_query($str) or die(mysql_error($sql));
 
 $str = "delete from usuariosgruposusuarios where IdUsuario =". $_GET['delete'];
 $sql = mysql_query($str) or die(mysql_error($sql));
	
 $str = "delete from usvsgrupovsvideo where UGD_USUARIO =". $_GET['delete'];
 $sql = mysql_query($str) or die(mysql_error($sql));
 
 $str = "delete from usuarios where IdUsuario =". $_GET['delete'];
 $sql = mysql_query($str) or die(mysql_error($sql));
}

//Delete multiple
$arrUsuarios = $_POST['usuarios'];

$U = count($arrUsuarios);
if($U > 0)
{
 foreach($arrUsuarios as $id)
 {
	$str = "delete from grupos_usuario where IdUsuario =". $id;
	$sql = mysql_query($str) or die(mysql_error($sql));
	
	$str = "delete from usuariosgruposusuarios where IdUsuario =". $id;
	$sql = mysql_query($str) or die(mysql_error($sql));
	 
	$str = "delete from usvsgrupovsvideo where UGD_USUARIO =". $id;
	$sql = mysql_query($str) or die(mysql_error($sql));
	
	$str = "delete from usuarios where IdUsuario =". $id;
	$sql = mysql_query($str) or die(mysql_error($sql));
	
	if (!headers_sent()) header('Location: '.$currentPage);
	else echo '<meta http-equiv="refresh" content="0;url='.$currentPage.'" />';
 }
}

///actualizar
if($_POST["actualizar"]!="")
 {
	if($_POST['activo']!='1') $activo=0;
	else $activo=1;
	
	$objUsuario->actualizarUsuario($_POST["actualizar"],$_POST["valorLogin"],$_POST["valorClave"],
																 $_POST["valorNombre"],$activo,$_POST['licencia'],$_POST['txtKeyramp'],
																 $_POST['valorMac'],$_POST['valorSerial']);
	
  $msg="Registro atualizado";
 }


//informacion registro seleccionado
if($_GET["actualizar"]!="")
 {
   $RSresultado=$objUsuario->consultarDetalleUsuarios($_GET["actualizar"]);
   while ($row = mysql_fetch_array($RSresultado))
	 {
	  $vUsuario=$row["Usuario"]; 
	  $vPassword=$row["Password"]; 
	  $vNombreCompleto=$row["NombreCompleto"]; 
	  $vapellidos=$row["apellidos"];
	  $activoUser=$row["activo"]; 
	  $llave=$row["ID_PLUGIN"];
	  $pckey=$row["pcrampkey"];
	  $vMacId=$row["MAC_ID"];
	  $vSerial=$row["serial"];
	  //$vDirLocal=$row["DIRECCION_LOCAL"];	  
     }
 }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include ("includes/head.php") ?>
<body>
 <div id="wrapper">
  <h1><a href="#">&nbsp;</a></h1>
	<?php include("includes/mainnav.php") ?>
	<!-- // #end mainNav -->
	<div id="containerHolder">
	 <div id="container">
		<div id="sidebar">
		 <?php include("includes/sidenav.php") ?>
		</div>    
		<!-- // #sidebar -->
		<!-- h2 stays for breadcrumbs -->
		<!--<h2><a href="#">Dashboard</a> &raquo; <a href="#" class="active">Print resources</a></h2>
		<h2>&nbsp;</h2>-->
    
		<div id="main">
		
		<form name="frmbusca" action="<?=$currentPage?>" method="post" class="jNice">
		 <h2><?=_("Find users")?></h2>
		 <fieldset>
			<p>
			 <label><?=_("Name")?></label>
			 <input type="text" name="parteNombre" id="parteNombre" value="<?php echo $_POST['parteNombre']; ?>" maxlength="255" class="text-long" />
			</p>
			<input type="submit" value="<?=_("Find")?>" name="Buscar" />
		 </fieldset>
		</form>
		
		<form name="formProceso" action="<?=$_SERVER['PHP_SELF']?>" method="post" onSubmit="return validarNuevoUsuario()" class="jNice" >
		 <div id="headerDiv">
			 <h2><?=_("Manage users")?> &gt;&gt; <a id="myHeader" href="javascript:toggle('myContent','myHeader');" ><?=_("Click to add a new user")?></a></h2>
		 </div>
		 <div id="contentDiv">
		 <?php
			if($_GET['actualizar'] != ''){
			 ?>
			 <div id="myContent" style="display: block;">
			 <?
			}
			else{
			 ?>
			 <div id="myContent" style="display: none;">
			 <?
			}
			?>	
			
			 <fieldset>
			 <? 
			 if($_GET["actualizar"]!=""){
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
			 ?>
			 <?php
			 if($_GET["actualizar"]!=""){
			 ?>
			 <p>
				<h4>
				 <a href="#" onmouseover="ajax_showTooltip(window.event,'muestraGrupos.php?id=<?=$_GET["actualizar"]?>',this);return false" onmouseout="ajax_hideTooltip()"><?=_("Hover to see groups of the user $vUsuario")?></a>
				</h4>
			 </p>
			 <?php
			 }
			 ?>
			 <p>
				<label><?=_("Name")?></label>
				<input type="text" name="valorNombre" value="<?=$vNombreCompleto?>" maxlength="255" class="text-long" />
			 </p>
			 <p>
				<label><?=_("Username")?></label>
				<input type="text" name="valorLogin" value="<?=$vUsuario?>" maxlength="100" class="text-long" />
			 </p>
			 <p>
				<label><?=_("Password")?></label>
				<input type="password" name="valorClave" value="<?=$vPassword?>" maxlength="15" class="text-long" />
			 </p>
			 <p>
				<label><?=_("Mac Address")?></label>
				<input type="text" name="valorMac" value="<?=$vMacId?>" maxlength="100" class="text-long" />
			 </p>
			 <p>
				<label><?=_("Machine serial number")?></label>
				<input type="text" name="valorSerial" value="<?=$vSerial?>" maxlength="100" class="text-long" />
			 </p> 
			 <p>
				<label><?=_("Enable")?>
				<input type="checkbox" <?php if (!(strcmp($activoUser,1))) {echo "checked=\"checked\"";} ?> name="activo"  id="activo" value="1" />
				</label>
			 </p>	 
			 </p>
			 <p>
				<label><?=_("Computer ID")?></label>
				<input name="licencia" type="text" id="licencia" value="<?php echo $llave; ?>" class="text-long" />
			 </p>
			 <p>
				<input name="txtKeyramp" type="text" id="txtKeyramp" value="<?php echo $pckey; ?>" readonly="readonly" class="text-long" />
				<input type="button" name="btnCambiar" id="btnCambiar" value="New Key" onClick="fngenerakey();" class="button-submit" />
			 </p>
			 <p>
				<label><?=$msg?></label>
			 <input type="image" src="imagenes/crear.jpg">
			 </p> 
			 </fieldset>
			</form>
		 </div>
		</div>
		
		<form action="<?=$currentPage?>" method="post">
		 <table class="no-arrow paginate-20 max-pages-5">
			<thead>
			 <tr>
			 <th class="sortable"><b><?=_("Name")?></b></th>
			 <th class="sortable"><b><?=_("Username")?></b></th>
			 <!--<td><b><?=_("Delete")?></b></td>-->
			 <th><b><?=_("Active")?></b></th>
			 <th style="text-align:center">
				<input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
			 </th>
			<tr>
			</thead>
			<tbody>
				<?php
				//Sentencia sql (sin limit) 
				if($_POST['parteNombre']!="")
				{
				 $RSresultado=$objUsuario->consultarUsuario($_POST['parteNombre']);
				 $_pagi_sql = "SELECT * FROM  usuarios where NombreCompleto like '%" . $_POST['parteNombre'] . "%' order by NombreCompleto ";
				}
				else
				{
				 $RSresultado=$objUsuario->consultarUsuarios();
				 $_pagi_sql = "SELECT * FROM usuarios ORDER BY NombreCompleto"; 
				}
				
				$_pagi_result = mysql_query($_pagi_sql) or die("Error: ".mysql_error($_pagi_result));
				
				$counter = 0;
				while ($row = mysql_fetch_array($_pagi_result))
				{
				 $IdUsuario=$row["IdUsuario"]; 
				 $NombreCompleto=$row["NombreCompleto"]; 
				 $apellidos=$row["apellidos"]; 
				 $Usuario=$row["Usuario"]; 
				 $activo=$row["activo"];
				 ?>
				 <tr <?php if($counter % 2) echo " class='alt'"?>>
					<td>
					 <a href="admusuarios.php?actualizar=<?=$IdUsuario?>"><?=$NombreCompleto." ".$apellidos?></a>
					</td>
					<!--<td  align="left" valign="top" bgcolor="white" class="tahoma_12"><a href="mensajes/insertarMensaje.php?codUser=<?php echo $IdUsuario; ?>&nomUser=<?php echo $NombreCompleto; ?>">Enviar</a></td>-->
					<td><?=$Usuario?></td>
					<td>
					 <input type="checkbox" name="act" id="act" disabled <?php if (!(strcmp($activo,1))) {echo "checked=\"checked\"";} ?>>
					</td>
					<td align="center"><input name='usuarios[]' type='checkbox' value="<?=$row['IdUsuario']?>"></td>
					<!--<td><a href="<?=$_SERVER['PHP_SELF']?>?delete=<?=$row['IdUsuario']?>" onclick="return confirm('Are you sure do you want to delete?')"><?=_("Delete")?></td>-->
				 <tr>
				 <?
				}
				if($counter == 0 and $_POST['parteNombre']!="")
				{
				 ?>
				 <tr>
					<td  colspan="4" align="center"><?=_("No data found.")?></td>
				 </tr>
				 <?
				}
				?>
				
				</tbody>
			 </table>
			 </form>
			 <script type="text/javascript" src="js/tablesort.js"></script>
			 <script type="text/javascript" src="js/pagination.js"></script>
		
		</div><!-- // #main -->
    <div class="clear"></div>
    </div><!-- // #container -->
		</div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>