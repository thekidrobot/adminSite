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

	if (trim($_POST['nomGrupo']) != "") {
		
		if($_POST['flgEditar'] == 1){
			$str = "update  gruposdeusuarios
							set 		nomGrupoDeUsuario = '".$_POST['nomGrupo']."'
							where 	idGrupoDeUsuario = ".$_POST['idGrupo'];	
		}
		elseif($_POST['flgAgregar'] == 1){
			$str = "insert into gruposdeusuarios (nomGrupoDeUsuario) values ('".$_POST['nomGrupo']."')";	
		}
		
		$sql = mysql_query($str) or die(mysql_error($sql));
	}
	
	if(!empty($_GET))
	{
		if (trim($_GET['add_us']) != "" or trim($_GET['add_pq']) != ""){
			
			if(trim($_GET['add_us']) != "")
			$str = "select * from gruposdeusuarios where idGrupoDeUsuario =". $_GET['add_us'];
			elseif (trim($_GET['add_pq']) != "")
			$str = "select * from gruposdeusuarios where idGrupoDeUsuario =". $_GET['add_pq'];
		
			$sql = mysql_query($str) or die(mysql_error($sql));
			while ($row = mysql_fetch_array($sql)) {  
			
				$idGrupo = $row['idGrupoDeUsuario'];
				$nomGrupo = $row['nomGrupoDeUsuario'];
			}
		}
	
		if (trim($_GET['edit']) != ""){
			$str = "select * from gruposdeusuarios where idGrupoDeUsuario =". $_GET['edit'];
		
			$sql = mysql_query($str) or die(mysql_error($sql));
			while ($row = mysql_fetch_array($sql)) {  
			
				$idGrupo = $row['idGrupoDeUsuario'];
				$nomGrupo = $row['nomGrupoDeUsuario'];
			}
		}
	}

	if (trim($_GET['delete']) != ""){
		$str = "delete from gruposdeusuarios where idGrupoDeUsuario =". $_GET['delete'];
		$sql = mysql_query($str) or die(mysql_error($sql));
		
		$str = "delete from usuariosgruposusuarios where idGrupoDeUsuario =". $_GET['delete'];
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
	if(trim($_GET['add_us']) != ""){
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
								new Ajax.Request("includes/addPerson.php?idGrupo=<?=$idGrupo?>", {
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
								new Ajax.Request("includes/removePerson.php?idGrupo=<?=$idGrupo?>", {
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
		elseif(trim($_GET['add_pq'])!="")
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
								new Ajax.Request("includes/addPaqueteGrupo.php?idGrupo=<?=$idGrupo?>", {
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
								new Ajax.Request("includes/removePaqueteGrupo.php?idGrupo=<?=$idGrupo?>", {
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

		<h3>Grupos de Usuarios</h3>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="jNice">
			<fieldset>
				<p>
				<label>Nombre</label>
				<input type="text" name="nomGrupo" value="<?=$nomGrupo?>" class="text-long" maxlenght="150" />
				<input type="hidden" name="idGrupo" value="<?=$idGrupo?>" />				
				</p>
				<? if (trim($nomGrupo) !=""){
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
				<td class="action"><b>Agregar Paquetes</b></td>
				<td class="action"><b>Agregar Usuarios</b></td>
			</tr>
			<?php
				$counter = 0;
				$sql = mysql_query("SELECT * FROM gruposdeusuarios") or die(mysql_error($sql));
				while ($row = mysql_fetch_array($sql)) {  
					$counter++;
					?>
					<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td><?=$row['nomGrupoDeUsuario']?></td>
							<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?edit=<?=$row['idGrupoDeUsuario']?>">Editar</a></td>
							<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?delete=<?=$row['idGrupoDeUsuario']?>" onclick="return confirm('Seguro que desea borrar?')">Borrar</td>
							<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?add_pq=<?=$row['idGrupoDeUsuario']?>">Agregar Paquetes</td>
							<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?add_us=<?=$row['idGrupoDeUsuario']?>">Agregar Usuarios</td>
					</tr>
					<?php;
				}  
				?>
						
		</table>
		<?php
			if($_GET['add_us'] != '')
			{
					?>
					
					<p id="changeNotification" style="margin-top:20px">
						<p align="center"><h3>Arrastre para Modificar</h3></p>
						<div id="activityIndicator" style="display:none; ">
						<img src="imagenes/loading_indicator.gif" /> Actualizando Datos...
						</div>
					</p>
					
					<ul id="sortlist">
					<h4>Usuarios Disponibles</h4>
					<br/>
					<br/>
					<?php  
					$sql = mysql_query("SELECT * FROM usuarios where IdUsuario not in
																	(
																			select 	IdUsuario from usuariosgruposusuarios
																			where		idGrupoDeUsuario = $idGrupo
																	) 	ORDER BY IdUsuario ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['IdUsuario']?>"><?=$row['Usuario']?></li><?php;  
							}  
					?>
					</ul>
			
					
					<ul id="sortlist2">
					<h4>Usuarios en <?=$nomGrupo?></h4>
					<br/>
					<br/>
					<?php  
							$sql = mysql_query("SELECT * FROM usuarios where IdUsuario in
																	(
																			select 	IdUsuario from usuariosgruposusuarios
																			where		idGrupoDeUsuario = $idGrupo
																	) 	ORDER BY IdUsuario ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['IdUsuario']?>"><?=$row['Usuario']?></li><?php;
							}  
					?>
					</ul>
					<hr style="clear:both;visibility:hidden;" />            
					<?php
			}
			elseif($_GET['add_pq'] != '')
			{
					?>
					
					<p id="changeNotification" style="margin-top:20px">
						<p align="center"><h3>Arrastre para Modificar</h3></p>
						<div id="activityIndicator" style="display:none; ">
						<img src="imagenes/loading_indicator.gif" /> Actualizando Datos...
						</div>
					</p>
					
					<ul id="sortlist">
					<h4>Paquetes Disponibles</h4>
					<br/>
					<br/>
					<?php
					
					$sql = mysql_query("SELECT * FROM paquetes where idPaquete not in
																	(
																			select 	idPaquete from paquetesgrupos
																			where		idGrupos = $idGrupo
																	) 	ORDER BY idPaquete ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['idPaquete']?>"><?=$row['nomPaquete']?></li><?php;  
							}
							
					?>
					</ul>
			
					
					<ul id="sortlist2">
					<h4>Paquetes en <?=$nomGrupo?></h4>
					<br/>
					<br/>
					<?php  
					$sql = mysql_query("SELECT * FROM paquetes where idPaquete in
																	(
																			select 	idPaquete from paquetesgrupos
																			where		idGrupos = $idGrupo
																	) 	ORDER BY idPaquete ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['idPaquete']?>"><?=$row['nomPaquete']?></li><?php;
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
		
