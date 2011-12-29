<?
include("Connections/cnxRamp.php");
include("session.php");

	//Add selected multiple
	$addItems = $_POST['addItems'];
	
	if($_POST['idGrupos'] != '')
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
	}
	
	$N = count($addItems);
	if($N > 0)
	{		
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
		$str = "delete from archivos_grupo where id_grupo =". $_GET['delete'];
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
<?php include ("includes/head.php") ?>
<body>
 <div id="wrapper">
  <h1><a href="menuadmin.php"></a></h1>
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

			<div id="headerDiv">
				<h2>
				<?=_("Categories")?> &gt;&gt;
				<a id="myHeader" href="javascript:toggle('myContent','myHeader');" >
				<?=_("Click to add a new category")?></a>
				</h2>
			</div>

			<div id="contentDiv">
				<?php
				if($_GET['edit'] != '')
				{
					?>
					<div id="myContent" style="display: block;">
					<?
				}
				else
				{
					?>
					<div id="myContent" style="display: none;">
					<?
				}
				?>	
						<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="jNice">
							<fieldset>
							<p>
								<label><?=_("Name")?> : </label>
								<input type="text" name="grupos" value="<?=$nomGrupo?>" class="text-long" maxlenght="150" />
							</p>
							<p>
								<label><?=_("Parent category")?> : </label>
								<select name="padre">
									<option value=0 <?php if($idGrupos == $row['idGrupos']) echo "selected='selected'" ?>><?=_("No Parent")?></option>
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
								<label><?=_("Broadcast Type")?>:</label>
								<select name="categorias">
								<option value="Live" <?php if ($categoria =="Live") echo "selected='selected'" ?>>Live</option>
								<option value="OnDemand" <?php if ($categoria =="OnDemand") echo "selected='selected'" ?>>OnDemand</option>
								</select>
							</p>
							<input type="hidden" name="idGrupos" value="<?=$idGrupos?>" />				
							<? if (trim($nomGrupo) !="")
							{
								?>
								<input type="hidden" name="flgEditar" value=1 />				
								<input type="submit" value="<?=_("Edit")?>" name="Editar" />
								<?
							}
							else
							{
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
				<table class="no-arrow rowstyle-alt colstyle-alt paginate-10 max-pages-5">
				<thead>
				<tr>
					<th class="sortable"><b><?=_("Name")?></b></th>
					<th class="sortable"><b><?=_("Signal")?></b></th>
					<th><b><?=_("Add Videos")?></b></th>
					<th style="text-align:center">
						<input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
					</th>
					<!--<td class="action"><b><?=_("Delete")?></b></td>-->
				</tr>
			</thead>
			<tbody>	
				<?php
				$counter = 0;
				$sql = mysql_query("SELECT * FROM grupos order by padre asc");
					
				while ($row = mysql_fetch_array($sql)) {  
					$counter++;	
					//ToDo: Validar Borrado de categorias con hijos
					?>
					<tr <?php if($counter % 2) echo " class='alt'"?>>
						<td><a href="<?=$_SERVER['PHP_SELF']?>?edit=<?=$row['idGrupos']?>" ><?=ucfirst(strtolower($row['grupos']))?></a></td>
						<td align="left"><?=$row['categoria']?></td>
						<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?add_us=<?=$row['idGrupos']?>"><?=_("Add Videos")?></td>
						<td align="center"><input name='archivos[]' type='checkbox' value="<?=$row['idGrupos']?>"></td>
						<!--<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?delete=<?=$row['idGrupos']?>" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')">Borrar</td>-->
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
		if($_GET['add_us'] != '' or $_GET['add_all_us'] != '' or $_GET['rem_all_us'] != '' or $_POST['idGrupos'] != '')
		{
			?>
			<div id="dhtmlgoodies_scrolldiv">
				<div id="scrolldiv_parentContainer">
					<div id="scrolldiv_content">

						<p id="changeNotification" style="margin-top:20px">
							<p align="center"><h3><?=_("Drag and drop to modify") ?> &gt;&gt; <a href="#" onmouseover="ajax_showTooltip(window.event,'muestraInfoCategorias.php?id=<?=$idGrupos?>',this);return false" onmouseout="ajax_hideTooltip()"><?=_("Mouseover for more info")?></a></h3></p>
							
							<div id="activityIndicator" style="display:none; ">
								<img src="imagenes/loading_indicator.gif" /><?=_("Updating data, please wait")?>...
							</div>
						</p>
					
						<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
							<ul id="sortlist">
								<h4><?=_("Available videos")?></h4>
								<br />
								<a href="<?=$_SERVER['PHP_SELF']?>?add_all_us=<?=$idGrupos?>"><input type="button" class="button-submit" value="<?=_(">>")?>" /></a>
								<input type="submit" name="a_selected" value="<?=_(">")?>" class="button-submit" style="margin-left:10px;" />
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
								<li id="itemid_<?=$row['id_archivo']?>"><input type="checkbox" name="addItems[]" value="<?=$row['id_archivo']?>" /><?=$row['titulo']?></li><?php;  
								}
							?>
							<br/>
							<a href="<?=$_SERVER['PHP_SELF']?>?add_all_us=<?=$idGrupos?>"><input type="button" class="button-submit" value="<?=_(">>")?>" /></a>
							<input type="submit" name="a_selected" value="<?=_(">")?>" class="button-submit" style="margin-left:10px;" />
							</ul>
						</form>
						
						<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
							<ul id="sortlist2">
								<h4><?=_("Videos in category") ?> <?=ucfirst(strtolower($nomGrupo))?></h4>
								<br/>
								<a href="<?=$_SERVER['PHP_SELF']?>?rem_all_us=<?=$idGrupos?>"><input type="button" class="button-submit" value="<?=_("<<")?>" /></a>
								<input type="submit" name="r_selected" value="<?=_("<")?>" class="button-submit" style="margin-left:10px;" />
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
									?><li id="itemid_<?=$row['id_archivo']?>"><input type="checkbox" name="remItems[]" value="<?=$row['id_archivo']?>" /><?=$row['titulo']?></li><?php;
								}
							  ?>
								<br/>
								<a href="<?=$_SERVER['PHP_SELF']?>?rem_all_us=<?=$idGrupos?>"><input type="button" class="button-submit" value="<?=_("<<")?>" /></a>
								<input type="submit" name="r_selected" value="<?=_("<")?>" class="button-submit" style="margin-left:10px;" />
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
			<script type="text/javascript" src="style/js/scrollingInit.js"></script>
			</div>
			<br />
			<br />
			<?php
		}
		?>
	 	
		</div><!-- // #main -->
    <div class="clear"></div>
    </div><!-- // #container -->
		</div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
	<script type="text/javascript" src="js/tablesort.js"></script>
	<script type="text/javascript" src="js/pagination.js"></script>	
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
