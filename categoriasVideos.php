<?php
include('Connections/cnxRamp.php');
include("includes/pagination/ps_pagination.php");

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

	//Add selected multiple
	$addItems = $_POST['addItems'];
	$N = count($addItems);
	if($N > 0)
	{
		$idGrupos = $_POST['idGrupos'];
		
		$str = "select * from grupos where idGrupos =".$idGrupos;
		$sql = mysql_query($str) or die(mysql_error($sql));
		while ($row = mysql_fetch_array($sql)) {  
			$idGrupos = $row['idGrupos'];
			$nomGrupo = $row['grupos'];
			$padre = $row['padre'];
			$categoria = $row['categoria'];
		}
		
		for($i=0; $i < $N; $i++)
		{
			$str = "INSERT INTO archivos_grupo (id_grupo,id_archivo,fecha_inserta)
												 VALUES ($idGrupos,".$addItems[$i].",NOW())";
			$sql = mysql_query($str) or die(mysql_error($sql));
		} 
	}

	//delete selected multiple
	$remItems = $_POST['remItems'];
	$N = count($remItems);
	if($N > 0)
	{
		$idGrupos = $_POST['idGrupos'];
		$str = "select * from grupos where idGrupos =".$idGrupos;
		$sql = mysql_query($str) or die(mysql_error($sql));
		while ($row = mysql_fetch_array($sql)) {  
			$idGrupos = $row['idGrupos'];
			$nomGrupo = $row['grupos'];
			$padre = $row['padre'];
			$categoria = $row['categoria'];
		}

		for($i=0; $i < $N; $i++)
		{
			$str = "delete from archivos_grupo where id_archivo = ".$remItems[$i]." and id_grupo =".$idGrupos;
			$sql = mysql_query($str) or die(mysql_error($sql));
		} 
	}

	//Delete multiple
	$arrArchivos = $_POST['archivos'];
	
	$U = count($arrArchivos);
	if($U > 0)
	{
	 foreach($arrArchivos as $id)
	 {
			$str = "delete from grupos where idGrupos = $id";
			$sql = mysql_query($str) or die(mysql_error($sql));
			//Borra de tabla hija
			$str = "delete from archivos_grupo where id_grupo = $id";
			$sql = mysql_query($str) or die(mysql_error($sql));
			
			if (!headers_sent()) header('Location: '.$currentPage);
			else echo '<meta http-equiv="refresh" content="0;url='.$currentPage.'" />';
	 }
	} 

	if (trim($_POST['grupos']) != "") {
		
		if($_POST['flgEditar'] == 1){
			$str = "update  grupos
							set 		grupos = '".$_POST['grupos']."',
											padre = ".$_POST['padre'].",
											categoria = '".$_POST['categorias']."'									
							where 	idGrupos = ".$_POST['idGrupos'];							
		}
		elseif($_POST['flgAgregar'] == 1){
			$str = "insert into grupos (grupos,activo,padre,categoria)
							values('".$_POST['grupos']."',1,".$_POST['padre'].",'".$_POST['categorias']."')";	
		}
		
		$sql = mysql_query($str) or die(mysql_error($sql));
	}
	
	if(!empty($_GET))
	{
		if(trim($_GET['add_us']) != "" or trim($_GET['add_all_us'])!= "" or trim($_GET['rem_all_us']) != "")
		{
			if(trim($_GET['add_us']) != "")
				$str = "select * from grupos where idGrupos =". $_GET['add_us'];
			elseif (trim($_GET['add_all_us'])!= "")
				$str = "select * from grupos where idGrupos =". $_GET['add_all_us'];
			elseif (trim($_GET['rem_all_us']) != "")
				$str = "select * from grupos where idGrupos =". $_GET['rem_all_us'];
				
			$sql = mysql_query($str) or die(mysql_error($sql));
			while ($row = mysql_fetch_array($sql)) {  
			
				$idGrupos = $row['idGrupos'];
				$nomGrupo = $row['grupos'];
				$padre = $row['padre'];
				$categoria = $row['categoria'];
				
			}
		}
		
		if (trim($_GET['edit']) != ""){
			$str = "select * from grupos where idGrupos =". $_GET['edit'];
		
			$sql = mysql_query($str) or die(mysql_error($sql));
			while ($row = mysql_fetch_array($sql)) {  
			
				$idGrupos = $row['idGrupos'];
				$nomGrupo = $row['grupos'];
				$padre = $row['padre'];
				$categoria = $row['categoria'];
			}
		}
	}

	if (trim($_GET['delete']) != ""){
		$str = "delete from grupos where idGrupos =". $_GET['delete'];
		$sql = mysql_query($str) or die(mysql_error($sql));
		//Borra de tabla hija
		$str = "delete from archivos_grupo	 where id_grupo =". $_GET['delete'];
		$sql = mysql_query($str) or die(mysql_error($sql));
	}

	if (trim($_GET['add_all_us']) != ""){
		
		$idGrupo = $_GET['add_all_us'];
		
		$str = "SELECT * FROM archivos where id_archivo not in
						(
							select 	id_archivo from archivos_grupo
							where		id_grupo = $idGrupos
						) ORDER BY id_archivo ";
		$sql = mysql_query($str) or die(mysql_error($sql));
		
		while ($row = mysql_fetch_array($sql))
		{
			$str_add_alluser = "INSERT INTO archivos_grupo (id_grupo,id_archivo,fecha_inserta) VALUES ($idGrupos,".$row['id_archivo'].",NOW())";
			$sql_add_alluser = mysql_query($str_add_alluser) or die(mysql_error($sql_add_alluser));
		}	
	}
	
	if (trim($_GET['rem_all_us']) != ""){
		$str = "delete from archivos_grupo where id_grupo =". $_GET['rem_all_us'];
		$sql = mysql_query($str) or die(mysql_error($sql));
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
								new Ajax.Request("includes/addVideo.php?idGrupos=<?=$idGrupos?>", {
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
								new Ajax.Request("includes/removeVideo.php?idGrupos=<?=$idGrupos?>", {
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
	</head> 
	<body> 

		<div id="wrapper">
		<div id="headerDiv">
			<h3>Categorias &gt;&gt; <a id="myHeader" href="javascript:toggle('myContent','myHeader');" >Click para Agregar</a></h3>
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
				<label>Nombre : </label>
				<input type="text" name="grupos" value="<?=$nomGrupo?>" class="text-long" maxlenght="150" />
				</p>
				
				<p>
					<label>Pertenece a:</label>
					<select name="padre">
						<option value=0 <?php if($idGrupos == $row['idGrupos']) echo "selected='selected'" ?>>Sin Padre</option>
						<?php
						//First level menus
						$result = mysql_query('SELECT * FROM grupos WHERE padre = 0 order by idGrupos');
						while ($row = mysql_fetch_array($result))
						{
							?>
							<option value="<?=$row['idGrupos'] ?>" <?php if($padre ==  $row['idGrupos']) echo "selected='selected'" ?>><?=ucfirst(strtolower($row['grupos'])) ?></option>
							<?php
							$dad=$row['grupos'];
							//Second+ level menus
							//Sorry for the mess, Padre needs to be sent as a comparison value.
							make_kids($row['idGrupos'],$dad,$padre);
						}
						?>
					</select>
				</p>
				<p>
					<label>Tipo de Broadcast:</label>
					<select name="categorias">
						<option value="Live" <?php if ($categoria =="Live") echo "selected='selected'" ?>>Live</option>
						<option value="OnDemand" <?php if ($categoria =="OnDemand") echo "selected='selected'" ?>>OnDemand</option>
					</select>
				</p>
				
				<input type="hidden" name="idGrupos" value="<?=$idGrupos?>" />				
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
				<a href="<?=$_SERVER['PHP_SELF']?>"><input type="button" value="Limpiar" class="button-submit" /></a>
			</fieldset>
		</form>
			
		</div></div>
		
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">		
		<table>
			<tr>
				<td align="center" style="padding:5px 0px 5px 0px"><input class="button-submit" type="submit" value="Borrar Seleccion" name="borrar" onclick="return confirm('Desea borrar los elementos seleccionados?')" /></label></td>
				<td><b>Nombre</b></td>
				<td><b>Señal</b></td>
				<td class="action"><b>Borrar</b></td>
				<td class="action"><b>Agregar Videos</b></td>
			</tr>
			<?php
				$counter = 0;
				$sql = "SELECT * FROM grupos order by padre asc";
				
				$pager = new PS_Pagination($cnxRamp, $sql, 5, 5);
				$rs = $pager->paginate();
				
				while ($row = mysql_fetch_array($rs)) {  
					$counter++;	
					?>
					<!--	ToDo: Validar Borrado de categorias con hijos				-->
					<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td align="center"><input name='archivos[]' type='checkbox' value="<?=$row['idGrupos']?>"></td>
							<td><a href="<?=$_SERVER['PHP_SELF']?>?edit=<?=$row['idGrupos']?>" ><?=ucfirst(strtolower($row['grupos']))?></a></td>
							<td align="left"><?=$row['categoria']?></td>
							<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?delete=<?=$row['idGrupos']?>" onclick="return confirm('Seguro que desea borrar?')">Borrar</td>
							<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?add_us=<?=$row['idGrupos']?>">Agregar Videos</td>
					</tr>
					<?php;
				}  
				?>
				<tr>
					<td colspan="6" align="center">
						<?php echo $pager->renderFullNav(); ?>
					</td>
				</tr>
		</table>
		</form>
		<br />
		<br />
		<?php
		if($_GET['add_us'] != '' or $_GET['add_all_us'] != '' or $_GET['rem_all_us'] != '' or $_POST['idGrupos'] != '')
		{
			?>
			<div id="dhtmlgoodies_scrolldiv">
				<div id="scrolldiv_parentContainer">
					<div id="scrolldiv_content">

						<p id="changeNotification" style="margin-top:20px">
							<p align="center"><h3>Arrastre para Modificar</h3></p>
							<div id="activityIndicator" style="display:none; ">
								<img src="imagenes/loading_indicator.gif" /> Actualizando Datos...
							</div>
						</p>
					
						<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
							<ul id="sortlist">
								<h4>Videos Disponibles</h4>
								<br />
								<a href="<?=$_SERVER['PHP_SELF']?>?add_all_us=<?=$idGrupos?>"><input type="button" class="button-submit" value="Agregar Todos" /></a>
								<input type="submit" name="a_selected" value="Agregar Marcados" class="button-submit" style="margin-left:10px;" />
								<input type="hidden" value="<?=$idGrupos?>" name="idGrupos" />
								<br/>
								<br/>
								<?php
								$sql = mysql_query("SELECT * FROM archivos where id_archivo not in
																		(
																				select 	id_archivo from archivos_grupo
																				where		id_grupo = $idGrupos
																		) 	ORDER BY id_archivo ");
								while ($row = mysql_fetch_array($sql)) {  
								?>
								<li id="itemid_<?=$row['id_archivo']?>"><input type="checkbox" name="addItems[]" value="<?=$row['id_archivo']?>" /><?=$row['nombreArchivo']?></li><?php;  
								}
							?>
							</ul>
						</form>
						
						<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
							<ul id="sortlist2">
								<h4>Videos en <?=$nomGrupo?></h4>
								<br/>
								<a href="<?=$_SERVER['PHP_SELF']?>?rem_all_us=<?=$idGrupos?>"><input type="button" class="button-submit" value="Quitar Todos" /></a>
								<input type="submit" name="r_selected" value="Quitar Marcados" class="button-submit" style="margin-left:10px;" />
								<input type="hidden" value="<?=$idGrupos?>" name="idGrupos" />
								<br/>
								<br/>
								<?php
								$sql = mysql_query("SELECT * FROM archivos where id_archivo in
																	(
																			select 	id_archivo from archivos_grupo
																			where		id_grupo = $idGrupos
																	) 	ORDER BY id_archivo");
																	
								while ($row = mysql_fetch_array($sql)) {  
									?><li id="itemid_<?=$row['id_archivo']?>"><input type="checkbox" name="remItems[]" value="<?=$row['id_archivo']?>" /><?=$row['nombreArchivo']?></li><?php;
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
	</body>
</html>
		
<?php

//Constructs the top menu
function make_kids($row_id,$dad_name,$padre)
{
	$result = mysql_query("SELECT * FROM grupos WHERE padre = $row_id");
	if (mysql_num_rows($result) > 0)
	{
		while ($row = mysql_fetch_array($result))
		{
			$selected = '';
				if($padre == $row['idGrupos']) $selected = "selected='selected'";
			?>
				<option value="<?=$row['idGrupos'] ?>" <?=$selected ?>><?=ucfirst(strtolower($dad_name))." - ".ucfirst(strtolower($row['grupos']))?></option>
			<?php
			//Welcome Mr. Cobb
			make_kids($row['idGrupos'],$dad_name." - ".$row['grupos'],$row['padre']);
		}
	}
}	

?>
