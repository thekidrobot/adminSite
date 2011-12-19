<?php
include('Connections/cnxRamp.php');
include("session.php");

	//Add selected multiple
	$addItems = $_POST['addItems'];
	
	if($_POST['idGrupo_paq'] != '')
	{
		$idGrupo = $_POST['idGrupo_paq'];
		$str = "select * from gruposdeusuarios where idGrupoDeUsuario =".$idGrupo;

		$sql = mysql_query($str) or die(mysql_error($sql));
		while ($row = mysql_fetch_array($sql)) {  
		
			$idGrupo = $row['idGrupoDeUsuario'];
			$nomGrupo = $row['nomGrupoDeUsuario'];
		}
		
		$N = count($addItems);
		if($N > 0)
		{
			for($i=0; $i < $N; $i++)
			{
				$str = "INSERT INTO paquetesgrupos (idPaquete,idGrupos) VALUES (".$addItems[$i].",$idGrupo)";
				$sql = mysql_query($str) or die(mysql_error($sql));
			} 
		}		
	}
	elseif($_POST['idGrupo_usr'] != '')
	{
		$idGrupo = $_POST['idGrupo_usr'];
		$str = "select * from gruposdeusuarios where idGrupoDeUsuario =".$idGrupo;

		$sql = mysql_query($str) or die(mysql_error($sql));
		while ($row = mysql_fetch_array($sql)) {  
			$idGrupo = $row['idGrupoDeUsuario'];
			$nomGrupo = $row['nomGrupoDeUsuario'];
		}
			
		$N = count($addItems);
		if($N > 0)
		{
			for($i=0; $i < $N; $i++)
			{
				$str = "INSERT INTO usuariosgruposusuarios (idGrupoDeUsuario,IdUsuario) VALUES ($idGrupo,".$addItems[$i].")";
				$sql = mysql_query($str) or die(mysql_error($sql));
			} 
		}
	}

	//delete selected multiple
	$remItems = $_POST['remItems'];
	$N = count($remItems);
	if($N > 0)
	{
		if($_POST['idGrupo_paq'] != ''){
			$idGrupo = $_POST['idGrupo_paq'];	
			for($i=0; $i < $N; $i++)
			{			
				$str = "delete from paquetesgrupos where idGrupos=".$idGrupo." and idPaquete=".$remItems[$i];
				$sql = mysql_query($str) or die(mysql_error($sql));
			} 
		}
		elseif($_POST['idGrupo_usr'] != ''){
			$idGrupo = $_POST['idGrupo_usr'];
			for($i=0; $i < $N; $i++)
			{
				$str = "delete from usuariosgruposusuarios where idGrupoDeUsuario =".$idGrupo." and IdUsuario=".$remItems[$i];
				$sql = mysql_query($str) or die(mysql_error($sql));
			} 
		}
	}


	//Delete multiple
	$arrArchivos = $_POST['archivos'];
	
	$U = count($arrArchivos);
	if($U > 0)
	{
	 foreach($arrArchivos as $id)
	 {
			$str = "delete from gruposdeusuarios where idGrupoDeUsuario = $id";
			$sql = mysql_query($str) or die(mysql_error($sql));
			//Borra de tabla hija
			$str = "delete from usuariosgruposusuarios where idGrupoDeUsuario = $id";
			$sql = mysql_query($str) or die(mysql_error($sql));
			
			if (!headers_sent()) header('Location: '.$currentPage);
			else echo '<meta http-equiv="refresh" content="0;url='.$currentPage.'" />';
	 }
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
		if(trim($_GET['add_us']) != "" or trim($_GET['add_pq']) != "" or trim($_GET['add_all_us'])!= ""
			 or trim($_GET['rem_all_us']) != "" or trim($_GET['add_all_pq'])!= "" or trim($_GET['rem_all_pq']))
		{
			if(trim($_GET['add_us']) != "")
				$str = "select * from gruposdeusuarios where idGrupoDeUsuario =". $_GET['add_us'];
			elseif (trim($_GET['add_pq']) != "")
				$str = "select * from gruposdeusuarios where idGrupoDeUsuario =". $_GET['add_pq'];
			elseif (trim($_GET['add_all_us'])!= "")
				$str = "select * from gruposdeusuarios where idGrupoDeUsuario =". $_GET['add_all_us'];
			elseif (trim($_GET['rem_all_us']) != "")
				$str = "select * from gruposdeusuarios where idGrupoDeUsuario =". $_GET['rem_all_us'];
			elseif (trim($_GET['add_all_pq'])!= "")
				$str = "select * from gruposdeusuarios where idGrupoDeUsuario =". $_GET['add_all_pq'];
			elseif (trim($_GET['rem_all_pq']) != "")
				$str = "select * from gruposdeusuarios where idGrupoDeUsuario =". $_GET['rem_all_pq'];
		
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
		//Borra de tabla hija
		$str = "delete from usuariosgruposusuarios where idGrupoDeUsuario =". $_GET['delete'];
		$sql = mysql_query($str) or die(mysql_error($sql));
	}

	if (trim($_GET['add_all_us']) != ""){
		
		$idGrupo = $_GET['add_all_us'];
		
		$str = "SELECT * FROM usuarios where IdUsuario not in
						(
								select 	IdUsuario from usuariosgruposusuarios
								where		idGrupoDeUsuario = $idGrupo
						) 	ORDER BY IdUsuario";
		$sql = mysql_query($str) or die(mysql_error($sql));
		
		while ($row = mysql_fetch_array($sql))
		{
			$str_add_alluser = "INSERT INTO usuariosgruposusuarios (idGrupoDeUsuario,IdUsuario) VALUES ($idGrupo,".$row['IdUsuario'].")";
			$sql_add_alluser = mysql_query($str_add_alluser) or die(mysql_error($sql_add_alluser));
		}	
	}
	
	if (trim($_GET['rem_all_us']) != ""){
		$str = "delete from usuariosgruposusuarios where idGrupoDeUsuario =". $_GET['rem_all_us'];
		$sql = mysql_query($str) or die(mysql_error($sql));
	}
	
	if (trim($_GET['add_all_pq']) != ""){
	
	$idGrupo = $_GET['add_all_pq'];
	
	$str = "SELECT * FROM paquetes where idPaquete not in
					(
							select 	idPaquete from paquetesgrupos
							where		idGrupos = $idGrupo
					) 	ORDER BY idPaquete";
	$sql = mysql_query($str) or die(mysql_error($sql));
	
		while ($row = mysql_fetch_array($sql))
		{
			$str_add_allpaq = "INSERT INTO paquetesgrupos (idPaquete,idGrupos) VALUES (".$row['idPaquete'].",$idGrupo)";
			$sql_add_allpaq = mysql_query($str_add_allpaq) or die(mysql_error($sql_add_allpaq));
		}	
	}
	
	if (trim($_GET['rem_all_pq']) != ""){
		$str = "delete from paquetesgrupos where idGrupos =". $_GET['rem_all_pq'];
		$sql = mysql_query($str) or die(mysql_error($sql));
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	if(trim($_GET['add_us']) != '' or trim($_GET['add_all_us']) != '' or trim($_GET['rem_all_us']) != '' or trim($_POST['idGrupo_usr']) != ''){
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
		elseif(trim($_GET['add_pq']) != '' or trim($_GET['add_all_pq']) != '' or trim($_GET['rem_all_pq']) != '' or trim($_POST['idGrupo_paq']) != '')
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
		
		<!--[if IE]>
		<style type="text/css">
			ul.fdtablePaginater {display:inline-block;}
			ul.fdtablePaginater {display:inline;}
			ul.fdtablePaginater li {float:left;}
			ul.fdtablePaginater {text-align:center;}
			table { border-bottom:1px solid #C1DAD7; }
		</style>
		<![endif]-->
		
	</head> 
	<body> 

		<div id="wrapper">
		<div id="headerDiv">
			<h3><?=_("Groups of users") ?> &gt;&gt; <a id="myHeader" href="javascript:toggle('myContent','myHeader');" ><?=_("Click to add")?></a></h3>
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
					<input type="text" name="nomGrupo" value="<?=$nomGrupo?>" class="text-long" maxlenght="150" />
					<input type="hidden" name="idGrupo" value="<?=$idGrupo?>" />				
					</p>
					<? if (trim($nomGrupo) !=""){
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
					<a href="<?=$_SERVER['PHP_SELF']?>"><input type="button" value="<?=_("Reset")?>" class="button-submit" /></a>
				</fieldset>
			</form>
			</div>
		</div>	
		
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		<table class="no-arrow rowstyle-alt colstyle-alt paginate-5 max-pages-5">
		<thead>
			<tr>
				<th class="sortable-keep fd-column-0"><b><?=_("Name")?></b></th>
				<th><b><?=_("Add Packages")?></b></th>
				<th><b><?=_("Add Users")?></b></th>
				<th style="text-align:center">
          <input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
        </th>
				<!--<td><b><?=_("Delete")?></b></td>-->
			</tr>
		</thead>
		<tbody>
			<?php
				$counter = 0;
				$sql = mysql_query("SELECT * FROM gruposdeusuarios") or die(mysql_error($sql));
				while ($row = mysql_fetch_array($sql)) {  
					$counter++;
					?>
					<tr <?php if($counter % 2) echo " class='odd'"?>>
						<td><a href="<?=$_SERVER['PHP_SELF']?>?edit=<?=$row['idGrupoDeUsuario']?>"><?=$row['nomGrupoDeUsuario']?></a></td>
						<td><a href="<?=$_SERVER['PHP_SELF']?>?add_pq=<?=$row['idGrupoDeUsuario']?>"><?=_("Add Packages")?></td>
						<td><a href="<?=$_SERVER['PHP_SELF']?>?add_us=<?=$row['idGrupoDeUsuario']?>"><?=_("Add Users")?></td>
						<!--<td><a href="<?=$_SERVER['PHP_SELF']?>?delete=<?=$row['idGrupoDeUsuario']?>" onclick="return confirm('Are you sure do you want to delete?')"><?=_("Delete")?></td>-->
						<td align="center"><input name='archivos[]' type='checkbox' value="<?=$row['idGrupoDeUsuario']?>"></td>
					</tr>
					<?php;
				}  
				?>
		</tbody>
		</table>
		</form>
		<br />
		<br />
		<?php
		if($_GET['add_us'] != '' or $_GET['add_all_us'] != '' or $_GET['rem_all_us'] != '' or trim($_POST['idGrupo_usr']) != '')
		{
		?>
			<div id="dhtmlgoodies_scrolldiv">
				<div id="scrolldiv_parentContainer">
					<div id="scrolldiv_content">

					<p id="changeNotification" style="margin-top:20px">
						<p align="center"><h3><?=_("Drag and drop to modify") ?></h3></p>
						<div id="activityIndicator" style="display:none; ">
						<img src="imagenes/loading_indicator.gif" /> <?=_("Updating data, please wait")?>...
						</div>
					</p>
					
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">	
					
					<ul id="sortlist">
					<h4><?=_("Available Users")?></h4>
					<br/>
					<a href="<?=$_SERVER['PHP_SELF']?>?add_all_us=<?=$idGrupo?>"><input type="button" class="button-submit" value="<?=_("Add all")?>" /></a>
					<input type="submit" name="a_selected" value="<?=_("Add Selected")?>" class="button-submit" style="margin-left:10px;" />
					<input type="hidden" value="<?=$idGrupo?>" name="idGrupo_usr" />
					<br/>
					<br/>
					<?php  
					$sql = mysql_query("SELECT * FROM usuarios where IdUsuario not in
																	(
																			select 	IdUsuario from usuariosgruposusuarios
																			where		idGrupoDeUsuario = $idGrupo
																	) 	ORDER BY IdUsuario ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['IdUsuario']?>"><input type="checkbox" name="addItems[]" value="<?=$row['IdUsuario']?>" /><?=$row['Usuario']?></li><?php;  
							}  
					?>
					</ul>
					</form>
					
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<ul id="sortlist2">
					<h4><?=_("Users in ")?> <?=$nomGrupo?></h4>
					<br/>
						<a href="<?=$_SERVER['PHP_SELF']?>?rem_all_us=<?=$idGrupo?>"><input type="button" class="button-submit" value="<?=_("Remove all")?>" /></a>
						<input type="submit" name="r_selected" value="<?=_("Remove selected")?>" class="button-submit" style="margin-left:10px;" />
						<input type="hidden" value="<?=$idGrupo?>" name="idGrupo_usr" />
					<br/>
					<br/>
					<?php  
							$sql = mysql_query("SELECT * FROM usuarios where IdUsuario in
																	(
																			select 	IdUsuario from usuariosgruposusuarios
																			where		idGrupoDeUsuario = $idGrupo
																	) 	ORDER BY IdUsuario ");  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['IdUsuario']?>"><input type="checkbox" name="remItems[]" value="<?=$row['IdUsuario']?>" /><?=$row['Usuario']?></li><?php;
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
		elseif($_GET['add_pq'] != '' or $_GET['add_all_pq'] != '' or $_GET['rem_all_pq'] != '' or trim($_POST['idGrupo_paq']) != '')
		{
			?>
			<div id="dhtmlgoodies_scrolldiv">
				<div id="scrolldiv_parentContainer">
					<div id="scrolldiv_content">
						
					<p id="changeNotification" style="margin-top:20px">
						<p align="center"><h3><?=_("Drag and drop to modify") ?></h3></p>
						<div id="activityIndicator" style="display:none; ">
						<img src="imagenes/loading_indicator.gif" /> <?=_("Updating data, please wait")?>...
						</div>
					</p>

					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">

					<ul id="sortlist">
					<h4><?=_("Available Packages")?></h4>
					<br/>
					<a href="<?=$_SERVER['PHP_SELF']?>?add_all_pq=<?=$idGrupo?>"><input type="button" class="button-submit" value="<?=_("Add all")?>" /></a>
					<input type="submit" name="a_selected" value="<?=_("Add Selected")?>" class="button-submit" style="margin-left:10px;" />
					<input type="hidden" value="<?=$idGrupo?>" name="idGrupo_paq" />
					<br/>
					<br/>
					<?php
					$str = "SELECT * FROM paquetes where idPaquete not in
									(
											select 	idPaquete from paquetesgrupos
											where		idGrupos = $idGrupo
									) 	ORDER BY idPaquete ";
					
					$sql = mysql_query($str);  
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['idPaquete']?>"><input type="checkbox" name="addItems[]" value="<?=$row['idPaquete']?>" /><?=$row['nomPaquete']?></li><?php;  
							}
							
					?>
					</ul>
					</form>
			
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<ul id="sortlist2">
					<h4><?=_("Packages in ")?> <?=$nomGrupo?></h4>
					<br/>
						<a href="<?=$_SERVER['PHP_SELF']?>?rem_all_pq=<?=$idGrupo?>"><input type="button" class="button-submit" value="<?=_("Remove all")?>" /></a>
						<input type="submit" name="r_selected" value="<?=_("Remove Selected")?>" class="button-submit" style="margin-left:10px;" />
						<input type="hidden" value="<?=$idGrupo?>" name="idGrupo_paq" />
					<br/>
					<br/>
					<?php
					$str = "SELECT * FROM paquetes where idPaquete in
									(
											select 	idPaquete from paquetesgrupos
											where		idGrupos = $idGrupo
									) 	ORDER BY idPaquete ";
					$sql = mysql_query($str);
							while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['idPaquete']?>"><input type="checkbox" name="remItems[]" value="<?=$row['idPaquete']?>" /><?=$row['nomPaquete']?></li><?php;
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
		<br />
		<br />
		<br />
		<script type="text/javascript" src="js/tablesort.js"></script>
		<script type="text/javascript" src="js/pagination.js"></script>
	</body>
</html>