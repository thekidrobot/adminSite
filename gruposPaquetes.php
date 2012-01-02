<?
include("Connections/cnxRamp.php");
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
				<h2><?=_("Group of categories - Packages") ?> &gt;&gt; <a id="myHeader" href="javascript:toggle('myContent','myHeader');" ><?=_("Click to add a new package") ?></a></h2>
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
		<table class="no-arrow rowstyle-alt colstyle-alt paginate-5 max-pages-5">
		<thead>
			<tr>
				<th class="sortable-keep fd-column-0"><b><?=_("Name")?></b></th>
				<th class="action"><b><?=_("Add categories")?></b></th>
				<th><b><?=_("Add group of users")?></b></th>
				<!--<td class="action"><b><?=_("Delete")?></b></td>-->
				<th style="text-align:center">
          <input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
        </th>
			</tr>
		</thead>
		<tbody>
			<?php
				$counter = 0;
				$sql = mysql_query("SELECT * FROM paquetes") or die(mysql_error($sql));
				while ($row = mysql_fetch_array($sql)) {  
					$counter++;
					?>
					<tr <?php if($counter % 2) echo " class='odd'"?>>
						<td><a href="<?=$_SERVER['PHP_SELF']?>?edit=<?=$row['idPaquete']?>"><?=$row['nomPaquete']?></a></td>
						<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?add_cat=<?=$row['idPaquete']?>"><?=_("Add categories")?></td>
						<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?add_usr=<?=$row['idPaquete']?>"><?=_("Add group of users")?></td>
						<!--<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?delete=<?=$row['idPaquete']?>" onclick="return confirm('Are you sure do you want to delete?')"><?=_("Delete")?></td>-->
						<td align="center"><input name='paquetes[]' type='checkbox' value="<?=$row['idPaquete']?>"></td>
					</tr>
					<?php
				}  
				?>
		</tbody>
		</table>
		</form>
		<br />
		<br />
		<?php
		if(trim($_GET['add_cat']) != '' or trim($_GET['add_all_cat']) != "" or trim($_GET['rem_all_cat']) != "" or trim($_POST['idPaquete_cat'] != ''))
		{
			?>
			<p align="center"><h2><?=_("Drag and drop to modify")?></h2></p>	
			<div id="dhtmlgoodies_scrolldiv">
				<div id="scrolldiv_parentContainer">
					<div id="scrolldiv_content">
					<p id="changeNotification" style="margin-top:20px">
						<div id="activityIndicator" style="display:none; ">
						<img src="imagenes/loading_indicator.gif" /> <?=_("Updating data, please wait")?>...
						</div>
						<br />
					</p>
					<?	
						$sql1 = mysql_query("SELECT * FROM grupos where idGrupos not in
																		(
																				select 	idGrupos from paquetesgrupos
																				where		idPaquete = $idPaquete
																		) 	ORDER BY idGrupos ");  					
												 
						$sql2 = mysql_query("SELECT * FROM grupos where idGrupos in
																(
																		select 	idGrupos from paquetesgrupos
																		where		idPaquete = $idPaquete
																) 	ORDER BY idGrupos ");  											 
											 
						$nleft = mysql_num_rows($sql1);
						$nright = mysql_num_rows($sql2);
						
						if($nleft >= $nright){
						 $height = $nleft * 38;
						}
						else{
						 $height = $nright * 38;
						}
					
					?>
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">	
					
					<div class="buttons_left">
						<a href="<?=$_SERVER['PHP_SELF']?>?add_all_cat=<?=$idPaquete?>"><input type="button" class="button-submit" value="<?=_(">>")?>" /></a><br /><br />
						<input type="submit" name="a_selected" value="<?=_(">")?>" class="button-submit" />
					</div>
					
					<ul id="sortlist" style="height:<?=$height?>px;">
					<h4><?=_("Available categories")?></h4>
					<input type="hidden" value="<?=$idPaquete?>" name="idPaquete_cat" />
					<br/>
					<br/>

					<?php  
						while ($row = mysql_fetch_array($sql1)) {  
							?><li id="itemid_<?=$row['idGrupos']?>"><input type="checkbox" name="addItems[]" value="<?=$row['idGrupos']?>" /><?=$row['grupos']?></li><?php;  
						}  
					?>
					<br />
					</ul>
					</form>
					
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<div class="buttons_right">
						<input type="submit" name="r_selected" value="<?=_("<")?>" class="button-submit" /><br /><br />
						<a href="<?=$_SERVER['PHP_SELF']?>?rem_all_cat=<?=$idPaquete?>"><input type="button" class="button-submit" value="<?=_("<<")?>" /></a>
					</div>
					<ul id="sortlist2" style="height:<?=$height?>px;">
					<h4><?=_("Categories in ")?> <?=$nomPaquete?></h4>
					<input type="hidden" value="<?=$idPaquete?>" name="idPaquete_cat" />
					<br/>
					<br/>
					<?php  
							while ($row = mysql_fetch_array($sql2)) {  
									?><li id="itemid_<?=$row['idGrupos']?>"><input type="checkbox" name="remItems[]" value="<?=$row['idGrupos']?>" /><?=$row['grupos']?></li><?php;
							}  
					?>
					<br/>
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
			<p align="center"><h2><?=_("Drag and drop to modify")?></h2></p>
			<div id="dhtmlgoodies_scrolldiv">
				<div id="scrolldiv_parentContainer">
					<div id="scrolldiv_content">			
					<p id="changeNotification" style="margin-top:20px">
						<div id="activityIndicator" style="display:none; ">
						<img src="imagenes/loading_indicator.gif" /> <?=_("Updating data, please wait")?> ...
						</div>
					</p>
					<?php

						$sql1 = mysql_query("SELECT * FROM gruposdeusuarios where idGrupoDeUsuario not in
																	(
																			select 	idGrupoDeUsuario from gruposusuariospaquetes
																			where		idPaquete = $idPaquete
																	) 	ORDER BY idGrupoDeUsuario ");  						
						
						$sql2 = mysql_query("SELECT * FROM gruposdeusuarios where idGrupoDeUsuario in
																	(
																			select 	idGrupoDeUsuario from gruposusuariospaquetes
																			where		idPaquete = $idPaquete
																	) 	ORDER BY idGrupoDeUsuario "); 
						
						$nleft = mysql_num_rows($sql1);
						$nright = mysql_num_rows($sql2);
						 
						if($nleft >= $nright){
						 $height = $nleft * 38;
						}
						else{
						 $height = $nright * 38;
						}
					?>
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<div class="buttons_left">
						<a href="<?=$_SERVER['PHP_SELF']?>?add_all_grp=<?=$idPaquete?>"><input type="button" class="button-submit" value="<?=_(">>")?>" /></a><br /><br />
						<input type="submit" name="a_selected" value="<?=_(">")?>" class="button-submit" />
					</div>
					<ul id="sortlist" style="height:<?=$height?>px;">
					<h4><?=_("Available groups")?></h4>
					<input type="hidden" value="<?=$idPaquete?>" name="idPaquete_grp" />
					<br/>
					<?php  
						while ($row = mysql_fetch_array($sql1)) {  
							?><li id="itemid_<?=$row['idGrupoDeUsuario']?>"><input type="checkbox" name="addItems[]" value="<?=$row['idGrupoDeUsuario']?>" /><?=$row['nomGrupoDeUsuario']?></li><?php;  
						}  
					?>
					<br/>
					</ul>
					</form>			
					
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<div class="buttons_right">
						<input type="submit" name="r_selected" value="<?=_("<")?>" class="button-submit" /><br /><br />
						<a href="<?=$_SERVER['PHP_SELF']?>?rem_all_grp=<?=$idPaquete?>"><input type="button" class="button-submit" value="<?=_("<<")?>" /></a>
					</div>
					<ul id="sortlist2" style="height:<?=$height?>px;">
					<h4><?=_("Groups in")?> <?=$nomPaquete?></h4>
					<input type="hidden" value="<?=$idPaquete?>" name="idPaquete_grp" />
					<br/>
					<?php  
						while ($row = mysql_fetch_array($sql2)) {  
								?><li id="itemid_<?=$row['idGrupoDeUsuario']?>"><input type="checkbox" name="remItems[]" value="<?=$row['idGrupoDeUsuario']?>" /><?=$row['nomGrupoDeUsuario']?></li><?php;
						}  
					?>
					<br/>
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
			<br />
			<br />
			<br />
			<script type="text/javascript" src="js/tablesort.js"></script>
			<script type="text/javascript" src="js/pagination.js"></script>
		<br/>
		<br/>
		
		</div><!-- // #main -->
    <div class="clear"></div>
    </div><!-- // #container -->
		</div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>