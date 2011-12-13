<?php
include('Connections/cnxRamp.php');
include("session.php");
	
	//Add selected multiple
	$addItems = $_POST['addItems'];
	
	if($_POST['idPaquete_cat'] != '')
	{
		$idPaquete = $_POST['idPaquete_cat'];
	
		$str = "select * from paquetes where idPaquete =".$idPaquete;
		
		$sql = mysql_query($str) or die(mysql_error($sql));
		while ($row = mysql_fetch_array($sql)) {  
		
			$idPaquete = $row['idPaquete'];
			$nomPaquete = $row['nomPaquete'];
		}
	
		$N = count($addItems);
		if($N > 0)
		{
			for($i=0; $i < $N; $i++)
			{
				$str_add_allcat = "INSERT INTO paquetesgrupos(idPaquete,idGrupos) VALUES ($idPaquete,".$addItems[$i].")";
				$sql_add_allcat = mysql_query($str_add_allcat) or die(mysql_error($sql_add_allcat));
			} 
		}		
	}
	elseif($_POST['idPaquete_grp'] != '')
	{
		$idPaquete = $_POST['idPaquete_grp'];

		$str = "select * from paquetes where idPaquete =".$idPaquete;
		
		$sql = mysql_query($str) or die(mysql_error($sql));
		while ($row = mysql_fetch_array($sql)) {  
		
			$idPaquete = $row['idPaquete'];
			$nomPaquete = $row['nomPaquete'];
		}		
		
		$N = count($addItems);
		if($N > 0)
		{
			for($i=0; $i < $N; $i++)
			{
				$str_add_allcat = "INSERT INTO gruposusuariospaquetes (idPaquete,idGrupoDeUsuario) VALUES($idPaquete,".$addItems[$i].")";
				$sql_add_allcat = mysql_query($str_add_allcat) or die(mysql_error($sql_add_allcat));
			} 
		}
	}

	//delete selected multiple
	$remItems = $_POST['remItems'];
	$N = count($remItems);
	if($N > 0)
	{
		if($_POST['idPaquete_cat'] != ''){
			
			$idPaquete = $_POST['idPaquete_cat'];
			for($i=0; $i < $N; $i++)
			{
					$str = "delete from paquetesgrupos where idPaquete = ". $idPaquete ." and idGrupos =".$remItems[$i];
					$sql = mysql_query($str) or die(mysql_error($sql));
			} 
		}
		elseif($_POST['idPaquete_grp'] != ''){

			$idPaquete = $_POST['idPaquete_grp'];

			for($i=0; $i < $N; $i++)
			{
				$str = "delete from gruposusuariospaquetes where idPaquete = ".$idPaquete." and idGrupoDeUsuario = ".$remItems[$i];
				$sql = mysql_query($str) or die(mysql_error($sql));
			} 
		}
	}

	//Delete all
	$arrPaquetes = $_POST['paquetes'];
	
	$U = count($arrPaquetes);
	if($U > 0)
	{
	 foreach($arrPaquetes as $id)
	 {
			echo $str;
		
			$str = "delete from paquetes where idPaquete = $id";
			$sql = mysql_query($str) or die(mysql_error($sql));
			//Borra de tabla hija
			$str = "delete from paquetesgrupos where idPaquete = $id";
			$sql = mysql_query($str) or die(mysql_error($sql));
			
			if (!headers_sent()) header('Location: '.$_SERVER['PHP_SELF']);
			else echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['PHP_SELF'].'" />';
	 }
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
	<link href="style/css/scrollingContent.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
	<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->
	
	<!-- JavaScripts-->
	<script type="text/javascript" src="style/js/toggleShowHide.js"></script>
	<script type="text/javascript" src="style/js/scrollingContent.js"></script>	
	<script type="text/javascript" src="style/js/jquery.js"></script>
	<script type="text/javascript" src="style/js/jNice.js"></script>
		
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="pragma" content="no-cache" />
  <script type="text/javascript" src="js/scriptaculous/lib/prototype.js"></script>
  <script type="text/javascript" src="js/scriptaculous/src/scriptaculous.js"></script>
	<link rel="stylesheet" type="text/css" href="style/css/dragdrop.css" />
	<?php
	if(trim($_GET['add_cat'] != "") or trim($_GET['add_all_cat']) != "" or trim($_GET['rem_all_cat']) != "" or trim($_POST['idPaquete_cat'] != '')){
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
	elseif(trim($_GET['add_usr'] != "" or trim($_GET['add_all_grp']) != "" or trim($_GET['rem_all_grp']) != "") or trim($_POST['idPaquete_grp'] != ''))
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
			<div id="headerDiv">
				<h3><?=_("Group of categories - Packages") ?> &gt;&gt; <a id="myHeader" href="javascript:toggle('myContent','myHeader');" ><?=_("Click to add") ?></a></h3>
			</div>
			<div id="contentDiv">
			<?php
				if($_GET['edit'] != ''){
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
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="jNice">
					<fieldset>
						<p>
						<label><?=_("Name")?></label>
						<input type="text" name="nomPaquete" value="<?=$nomPaquete?>" class="text-long" maxlenght="150" />
						<input type="hidden" name="idPaquete" value="<?=$idPaquete?>" />				
						</p>
						<? if (trim($nomPaquete) !=""){
							?>
							<input type="hidden" name="flgEditar" value=1 />				
							<input type="submit" value="<?=_("Edit")?>" name="Editar" />
							<?
						}
						else{
							?>
							<input type="hidden" name="flgAgregar" value=1 />				
							<input type="submit" value="<?=_("Add")?>" name="Agregar" />
							<?	
					}
					?>
					</fieldset>
				</form>
			</div>
		</div>
		
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		<table>
			<tr>
				<td align="center" style="padding:5px 0px 5px 0px">
          <input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
        </td>
				<td><b><?=_("Name")?></b></td>
				<td class="action"><b><?=_("Add group of users")?></b></td>
				<td class="action"><b><?=_("Add categories")?></b></td>
				<td class="action"><b><?=_("Delete")?></b></td>
			</tr>
			<?php
				$counter = 0;
				$sql = mysql_query("SELECT * FROM paquetes") or die(mysql_error($sql));
				while ($row = mysql_fetch_array($sql)) {  
					$counter++;
					?>
					<tr <?php if($counter % 2) echo " class='odd'"?>>
						<td align="center"><input name='paquetes[]' type='checkbox' value="<?=$row['idPaquete']?>"></td>
						<td><a href="<?=$_SERVER['PHP_SELF']?>?edit=<?=$row['idPaquete']?>"><?=$row['nomPaquete']?></a></td>
						<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?add_usr=<?=$row['idPaquete']?>"><?=_("Add group of users")?></td>
						<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?add_cat=<?=$row['idPaquete']?>"><?=_("Add categories")?></td>
						<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?delete=<?=$row['idPaquete']?>" onclick="return confirm('Are you sure do you want to delete?')"><?=_("Delete")?></td>
					</tr>
					<?php
				}  
				?>
		</table>
		</form>
		<br />
		<br />
		<?php
		if(trim($_GET['add_cat']) != '' or trim($_GET['add_all_cat']) != "" or trim($_GET['rem_all_cat']) != "" or trim($_POST['idPaquete_cat'] != ''))
		{
			?>
			<div id="dhtmlgoodies_scrolldiv">
				<div id="scrolldiv_parentContainer">
					<div id="scrolldiv_content">
						
					<p id="changeNotification" style="margin-top:20px">
						<p align="center"><h3><?=_("Drag and drop to modify")?></h3></p>
						<div id="activityIndicator" style="display:none; ">
						<img src="imagenes/loading_indicator.gif" /> <?=_("Updating data, please wait")?>...
						</div>
					</p>
					
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">	
					
					<ul id="sortlist">
					<h4><?=_("Available categories")?></h4>
					<br/>
					<a href="<?=$_SERVER['PHP_SELF']?>?add_all_cat=<?=$idPaquete?>"><input type="button" class="button-submit" value="<?=_("Add all")?>" /></a>
					<input type="submit" name="a_selected" value="<?=_("Add selected")?>" class="button-submit" style="margin-left:10px;" />
					<input type="hidden" value="<?=$idPaquete?>" name="idPaquete_cat" />
					<br/>
					<br/>

					<?php  
					$sql = mysql_query("SELECT * FROM grupos where idGrupos not in
																	(
																			select 	idGrupos from paquetesgrupos
																			where		idPaquete = $idPaquete
																	) 	ORDER BY idGrupos ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['idGrupos']?>"><input type="checkbox" name="addItems[]" value="<?=$row['idGrupos']?>" /><?=$row['grupos']?></li><?php;  
							}  
					?>
					</ul>
					</form>
					
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<ul id="sortlist2">
					<h4><?=_("Categories in ")?> <?=$nomPaquete?></h4>
					<br/>
						<a href="<?=$_SERVER['PHP_SELF']?>?rem_all_cat=<?=$idPaquete?>"><input type="button" class="button-submit" value="<?=_("Remove all")?>" /></a>
						<input type="submit" name="r_selected" value="<?=_("Remove selected")?>" class="button-submit" style="margin-left:10px;" />
						<input type="hidden" value="<?=$idPaquete?>" name="idPaquete_cat" />
					<br/>
					<br/>
					<?php  
							$sql = mysql_query("SELECT * FROM grupos where idGrupos in
																	(
																			select 	idGrupos from paquetesgrupos
																			where		idPaquete = $idPaquete
																	) 	ORDER BY idGrupos ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['idGrupos']?>"><input type="checkbox" name="remItems[]" value="<?=$row['idGrupos']?>" /><?=$row['grupos']?></li><?php;
							}  
					?>
					</ul>
					</form>
					
					<hr style="clear:both;visibility:hidden;" />
					</div>
					</div>
					<div id="scrolldiv_slider">
						<div id="scrolldiv_scrollUp"><img src="images/arrow_up.gif"></div>
						<div id="scrolldiv_scrollbar">
						<div id="scrolldiv_theScroll"><span></span></div>
						</div>
						<div id="scrolldiv_scrollDown"><img src="images/arrow_down.gif"></div>
					</div>
				</div>
				<script type="text/javascript" src="style/js/scrollingInit.js"></script>
				<?php
		}
		if(trim($_GET['add_usr']) != '' or trim($_GET['add_all_grp']) != "" or trim($_GET['rem_all_grp']) != "" or trim($_POST['idPaquete_grp'] != ''))
		{
			?>
			<div id="dhtmlgoodies_scrolldiv">
				<div id="scrolldiv_parentContainer">
					<div id="scrolldiv_content">			
			
					<p id="changeNotification" style="margin-top:20px">
						<p align="center"><h3><?=_("Drag and drop to modify")?></h3></p>
						<div id="activityIndicator" style="display:none; ">
						<img src="imagenes/loading_indicator.gif" /> <?=_("Updating data, please wait")?> ...
						</div>
					</p>
					
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<ul id="sortlist">
					<h4><?=_("Available groups")?></h4>
					<br/>
					<a href="<?=$_SERVER['PHP_SELF']?>?add_all_grp=<?=$idPaquete?>"><input type="button" class="button-submit" value="<?=_("Add all")?>" /></a>
					<input type="submit" name="a_selected" value="<?=_("Add selected")?>" class="button-submit" style="margin-left:10px;" />
					<input type="hidden" value="<?=$idPaquete?>" name="idPaquete_grp" />
					<br/>
					<br/>
					<?php  
					$sql = mysql_query("SELECT * FROM gruposdeusuarios where idGrupoDeUsuario not in
																	(
																			select 	idGrupoDeUsuario from gruposusuariospaquetes
																			where		idPaquete = $idPaquete
																	) 	ORDER BY idGrupoDeUsuario ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['idGrupoDeUsuario']?>"><input type="checkbox" name="addItems[]" value="<?=$row['idGrupoDeUsuario']?>" /><?=$row['nomGrupoDeUsuario']?></li><?php;  
							}  
					?>
					</ul>
					</form>			
					
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<ul id="sortlist2">
					<h4><?=_("Groups in")?> <?=$nomPaquete?></h4>
					<br/>
						<a href="<?=$_SERVER['PHP_SELF']?>?rem_all_grp=<?=$idPaquete?>"><input type="button" class="button-submit" value="<?=_("Remove all")?>" /></a>
						<input type="submit" name="r_selected" value="<?=_("Remove selected")?>" class="button-submit" style="margin-left:10px;" />
						<input type="hidden" value="<?=$idPaquete?>" name="idPaquete_grp" />
					<br/>
					<br/>
					<?php  
							$sql = mysql_query("SELECT * FROM gruposdeusuarios where idGrupoDeUsuario in
																	(
																			select 	idGrupoDeUsuario from gruposusuariospaquetes
																			where		idPaquete = $idPaquete
																	) 	ORDER BY idGrupoDeUsuario ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['idGrupoDeUsuario']?>"><input type="checkbox" name="remItems[]" value="<?=$row['idGrupoDeUsuario']?>" /><?=$row['nomGrupoDeUsuario']?></li><?php;
							}  
					?>
					</ul>
					</form>
					<hr style="clear:both;visibility:hidden;" />
					</div>
					</div>
					<div id="scrolldiv_slider">
						<div id="scrolldiv_scrollUp"><img src="images/arrow_up.gif"></div>
						<div id="scrolldiv_scrollbar">
							<div id="scrolldiv_theScroll"><span></span></div>
						</div>
						<div id="scrolldiv_scrollDown"><img src="images/arrow_down.gif"></div>
					</div>
				</div>
				<script type="text/javascript" src="style/js/scrollingInit.js"></script>
				<?php
			}
			?>
		</div>
	</body>
</html>