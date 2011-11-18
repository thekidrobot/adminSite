<?php
include('Connections/cnxRamp.php');

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

	if (trim($_POST['nomPaquete']) != "") {
		
		if($_POST['flgEditar'] == 1){
			$str = "update  paquetes
							set 		nomPaquete = '".$_POST['nomPaquete']."'
							where 	idPaquete = ".$_POST['idPaquete'];	
		}
		elseif($_POST['flgAgregar'] == 1){
			$str = "insert into paquetes (nomPaquete) values ('".$_POST['nomPaquete']."')";	
		}
		
		$sql = mysql_query($str) or die(mysql_error($sql));
	}
	
	if(!empty($_GET))
	{
		if (trim($_GET['add_cat']) != "" or trim($_GET['add_usr']) != ""
				or trim($_GET['add_all_cat']) != "" or trim($_GET['rem_all_cat']) != ""
				or trim($_GET['add_all_grp']) != "" or trim($_GET['rem_all_grp']) != ""){
			
			if (trim($_GET['add_cat']) != "")
				$str = "select * from paquetes where idPaquete =". $_GET['add_cat'];
			elseif (trim($_GET['add_usr']) != "")
				$str = "select * from paquetes where idPaquete =". $_GET['add_usr'];

			if (trim($_GET['add_all_cat']) != "")
				$str = "select * from paquetes where idPaquete =". $_GET['add_all_cat'];
			elseif (trim($_GET['rem_all_cat']) != "")
				$str = "select * from paquetes where idPaquete =". $_GET['rem_all_cat'];

			if (trim($_GET['add_all_grp']) != "")
				$str = "select * from paquetes where idPaquete =". $_GET['add_all_grp'];
			elseif (trim($_GET['rem_all_grp']) != "")
				$str = "select * from paquetes where idPaquete =". $_GET['rem_all_grp'];
		
			$sql = mysql_query($str) or die(mysql_error($sql));
			while ($row = mysql_fetch_array($sql)) {  
			
				$idPaquete = $row['idPaquete'];
				$nomPaquete = $row['nomPaquete'];
			}
		}
	
		if (trim($_GET['edit']) != ""){
			$str = "select * from paquetes where idPaquete =". $_GET['edit'];
		
			$sql = mysql_query($str) or die(mysql_error($sql));
			while ($row = mysql_fetch_array($sql)) {  
			
				$idPaquete = $row['idPaquete'];
				$nomPaquete = $row['nomPaquete'];
			}
		}
	}

	if (trim($_GET['delete']) != ""){
		$str = "delete from paquetesgrupos where idPaquete =". $_GET['delete'];
		$sql = mysql_query($str) or die(mysql_error($sql));
		
		$str = "delete from paquetes where idPaquete =". $_GET['delete'];
		$sql = mysql_query($str) or die(mysql_error($sql));
	}
	
	//Agregar todas las Categorias
	if (trim($_GET['add_all_cat']) != ""){
	
		$idPaquete = $_GET['add_all_cat'];
	
		$str = "SELECT * FROM grupos where idGrupos not in
						(
								select 	idGrupos from paquetesgrupos
								where		idPaquete = $idPaquete
						) 	ORDER BY idGrupos ";
		$sql = mysql_query($str) or die(mysql_error($sql));
		
		while ($row = mysql_fetch_array($sql)){
			$str_add_allcat = "INSERT INTO paquetesgrupos(idPaquete,idGrupos) VALUES ($idPaquete,".$row['idGrupos'].")";
			$sql_add_allcat = mysql_query($str_add_allcat) or die(mysql_error($sql_add_allcat));
		}	
	}
	
	//Remover todas las categorias
	if (trim($_GET['rem_all_cat']) != ""){
		$str = "delete from paquetesgrupos where idPaquete = ". $_GET['rem_all_cat'];
		$sql = mysql_query($str) or die(mysql_error($sql));
	}

	//Agregar todos los grp. de usuario
	if (trim($_GET['add_all_grp']) != ""){
	
		$idPaquete = $_GET['add_all_grp'];
	
		$str = "SELECT * FROM gruposdeusuarios where idGrupoDeUsuario not in
						(
								select 	idGrupoDeUsuario from gruposusuariospaquetes
								where		idPaquete = $idPaquete
						) 	ORDER BY idGrupoDeUsuario ";
		$sql = mysql_query($str) or die(mysql_error($sql));
		
		while ($row = mysql_fetch_array($sql)){
			$str_add_allcat = "INSERT INTO gruposusuariospaquetes (idPaquete,idGrupoDeUsuario) VALUES($idPaquete,".$row['idGrupoDeUsuario'].")";
			$sql_add_allcat = mysql_query($str_add_allcat) or die(mysql_error($sql_add_allcat));
		}	
	}
	//Remover todos los grp. de usuario
	if (trim($_GET['rem_all_grp']) != ""){
		$str = "delete from gruposusuariospaquetes where idPaquete = ". $_GET['rem_all_grp'];
		$sql = mysql_query($str) or die(mysql_error($sql));
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>RAMP</title>

	<!-- CSS -->
	<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
	<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->
	
	<!-- JavaScripts-->
	<script type="text/javascript" src="style/js/jquery.js"></script>
	<script type="text/javascript" src="style/js/jNice.js"></script>
		
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="pragma" content="no-cache" />
  <script type="text/javascript" src="js/scriptaculous/lib/prototype.js"></script>
  <script type="text/javascript" src="js/scriptaculous/src/scriptaculous.js"></script>
	<link rel="stylesheet" type="text/css" href="style/css/dragdrop.css" />
	<?php
	if(trim($_GET['add_cat'] != "") or trim($_GET['add_all_cat']) != "" or trim($_GET['rem_all_cat']) != ""){
		
	
	?>
	<script type="text/javascript"> 
		//<![CDATA[
		document.observe('dom:loaded', function() {
				var changeEffect;
				Sortable.create("sortlist2", {containment: ['sortlist', 'sortlist2'], tag:'li', overlap:'horizontal', constraint:false, dropOnEmpty: true,
						onChange: function(item) {
								var list = Sortable.options(item).element;
								if(changeEffect) changeEffect.cancel();
								changeEffect = new Effect.Highlight('changeNotification', {restoreColor:"transparent" });
						},			
						onUpdate: function(list) {
								new Ajax.Request("includes/addGrupoPaquete.php?idPaquete=<?=$idPaquete?>", {
								method: "post",
								onLoading: function(){$('activityIndicator').show()},
								onLoaded: function(){$('activityIndicator').hide()},
								parameters: { data: Sortable.serialize(list), container: list.id }
							});				
						}
				});			
		
				Sortable.create("sortlist", {containment: ['sortlist', 'sortlist2'], tag:'li', overlap:'horizontal', constraint:false, dropOnEmpty: true,
					onChange: function(item) {
						var list = Sortable.options(item).element;
						if(changeEffect) changeEffect.cancel();
						changeEffect = new Effect.Highlight('changeNotification', {restoreColor:"transparent" });
				},			
				onUpdate: function(list) {
								new Ajax.Request("includes/removeGrupoPaquete.php?idPaquete=<?=$idPaquete?>", {
								method: "post",
								onLoading: function(){$('activityIndicator').show()},
								onLoaded: function(){$('activityIndicator').hide()},
								parameters: { data: Sortable.serialize(list), container: list.id }
						});
				}
				});	
		});
		//]]>
		</script>
	<?php
	}
	elseif(trim($_GET['add_usr'] != "" or trim($_GET['add_all_grp']) != "" or trim($_GET['rem_all_grp']) != ""))
	{
		?>
		<script type="text/javascript"> 
		//<![CDATA[
		document.observe('dom:loaded', function() {
				var changeEffect;
				Sortable.create("sortlist2", {containment: ['sortlist', 'sortlist2'], tag:'li', overlap:'horizontal', constraint:false, dropOnEmpty: true,
						onChange: function(item) {
								var list = Sortable.options(item).element;
								if(changeEffect) changeEffect.cancel();
								changeEffect = new Effect.Highlight('changeNotification', {restoreColor:"transparent" });
						},			
						onUpdate: function(list) {
								new Ajax.Request("includes/addGrupoUsuarioPaquete.php?idPaquete=<?=$idPaquete?>", {
								method: "post",
								onLoading: function(){$('activityIndicator').show()},
								onLoaded: function(){$('activityIndicator').hide()},
								parameters: { data: Sortable.serialize(list), container: list.id }
							});				
						}
				});			
		
				Sortable.create("sortlist", {containment: ['sortlist', 'sortlist2'], tag:'li', overlap:'horizontal', constraint:false, dropOnEmpty: true,
					onChange: function(item) {
						var list = Sortable.options(item).element;
						if(changeEffect) changeEffect.cancel();
						changeEffect = new Effect.Highlight('changeNotification', {restoreColor:"transparent" });
				},			
				onUpdate: function(list) {
								new Ajax.Request("includes/removeGrupoUsuarioPaquete.php?idPaquete=<?=$idPaquete?>", {
								method: "post",
								onLoading: function(){$('activityIndicator').show()},
								onLoaded: function(){$('activityIndicator').hide()},
								parameters: { data: Sortable.serialize(list), container: list.id }
						});
				}
				});	
		});
		//]]>
		</script> 
		<?php
	}
	?>
	</head> 
	<body> 

		<div id="wrapper">

		<h3>Grupos de Categorias - Paquetes</h3>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="jNice">
			<fieldset>
				<p>
				<label>Nombre</label>
				<input type="text" name="nomPaquete" value="<?=$nomPaquete?>" class="text-long" maxlenght="150" />
				<input type="hidden" name="idPaquete" value="<?=$idPaquete?>" />				
				</p>
				<? if (trim($nomPaquete) !=""){
					?>
					<input type="hidden" name="flgEditar" value=1 />				
					<input type="submit" value="Editar" name="Editar" />
					<?
				}
				else{
					?>
					<input type="hidden" name="flgAgregar" value=1 />				
					<input type="submit" value="Agregar" name="Agregar" />
					<?	
			}
			?>
			</fieldset>
		</form>
		
		<table>
			<tr>
				<td><b>Nombre</b></td>
				<td class="action"><b>Editar</b></td>
				<td class="action"><b>Borrar</b></td>
				<td class="action"><b>Agregar Grupos de Usuarios</b></td>
				<td class="action"><b>Agregar Categorias</b></td>
			</tr>
			<?php
				$counter = 0;
				$sql = mysql_query("SELECT * FROM paquetes") or die(mysql_error($sql));
				while ($row = mysql_fetch_array($sql)) {  
					$counter++;
					?>
					<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td><?=$row['nomPaquete']?></td>
							<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?edit=<?=$row['idPaquete']?>">Editar</a></td>
							<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?delete=<?=$row['idPaquete']?>" onclick="return confirm('Seguro que desea borrar?')">Borrar</td>
							<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?add_usr=<?=$row['idPaquete']?>">Agregar Grupos de Usuarios</td>
							<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?add_cat=<?=$row['idPaquete']?>">Agregar Categorias</td>
					</tr>
					<?php;
				}  
				?>
						
		</table>
		<?php
			if(trim($_GET['add_cat']) != '' or trim($_GET['add_all_cat']) != "" or trim($_GET['rem_all_cat']) != "")
			{
					?>
					
					<p id="changeNotification" style="margin-top:20px">
						<p align="center"><h3>Arrastre para Modificar</h3></p>
						<div id="activityIndicator" style="display:none; ">
						<img src="imagenes/loading_indicator.gif" /> Actualizando Datos...
						</div>
					</p>
					
					<ul id="sortlist">
					<h4>Categorias Disponibles &gt;&gt; <a href="<?=$_SERVER['PHP_SELF']?>?add_all_cat=<?=$idPaquete?>">Agregar todas</a></h4>
					<br/>
					<br/>
					<?php  
					$sql = mysql_query("SELECT * FROM grupos where idGrupos not in
																	(
																			select 	idGrupos from paquetesgrupos
																			where		idPaquete = $idPaquete
																	) 	ORDER BY idGrupos ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['idGrupos']?>"><?=$row['grupos']?></li><?php;  
							}  
					?>
					</ul>
			
					
					<ul id="sortlist2">
					<h4>Categorias en <?=$nomPaquete?> &gt;&gt; <a href="<?=$_SERVER['PHP_SELF']?>?rem_all_cat=<?=$idPaquete?>">Eliminar todas</a></h4>
					<br/>
					<br/>
					<?php  
							$sql = mysql_query("SELECT * FROM grupos where idGrupos in
																	(
																			select 	idGrupos from paquetesgrupos
																			where		idPaquete = $idPaquete
																	) 	ORDER BY idGrupos ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['idGrupos']?>"><?=$row['grupos']?></li><?php;
							}  
					?>
					</ul>
					<hr style="clear:both;visibility:hidden;" />            
					<?php
			}
			if(trim($_GET['add_usr']) != '' or trim($_GET['add_all_grp']) != "" or trim($_GET['rem_all_grp']) != "")
			{
					?>
					
					<p id="changeNotification" style="margin-top:20px">
						<p align="center"><h3>Arrastre para Modificar</h3></p>
						<div id="activityIndicator" style="display:none; ">
						<img src="imagenes/loading_indicator.gif" /> Actualizando Datos...
						</div>
					</p>
					
					<ul id="sortlist">
					<h4>Grupos Disponibles &gt;&gt; <a href="<?=$_SERVER['PHP_SELF']?>?add_all_grp=<?=$idPaquete?>">Agregar todos</a></h4>
					<br/>
					<br/>
					<?php  
					$sql = mysql_query("SELECT * FROM gruposdeusuarios where idGrupoDeUsuario not in
																	(
																			select 	idGrupoDeUsuario from gruposusuariospaquetes
																			where		idPaquete = $idPaquete
																	) 	ORDER BY idGrupoDeUsuario ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['idGrupoDeUsuario']?>"><?=$row['nomGrupoDeUsuario']?></li><?php;  
							}  
					?>
					</ul>
			
					
					<ul id="sortlist2">
					<h4>Grupos en <?=$nomPaquete?> &gt;&gt; <a href="<?=$_SERVER['PHP_SELF']?>?rem_all_grp=<?=$idPaquete?>">Eliminar todos</a></h4>
					<br/>
					<br/>
					<?php  
							$sql = mysql_query("SELECT * FROM gruposdeusuarios where idGrupoDeUsuario in
																	(
																			select 	idGrupoDeUsuario from gruposusuariospaquetes
																			where		idPaquete = $idPaquete
																	) 	ORDER BY idGrupoDeUsuario ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['idGrupoDeUsuario']?>"><?=$row['nomGrupoDeUsuario']?></li><?php;
							}  
					?>
					</ul>
					<hr style="clear:both;visibility:hidden;" />            
					<?php
			}
			?>
		</div>
	</body>
</html>
		
