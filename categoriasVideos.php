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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>RAMP</title>

	<style type="text/css">
	body{
		font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
	}
	p{
		margin-top:0px;
	}
	#dhtmlgoodies_scrolldiv{
		/* The total width of the scrolling div including scrollbar */
		width:700px;
		height:400px;	/* The height of the scrolling div */
	}
	#scrolldiv_parentContainer{
		width:700px;	/* Width of the scrolling text */
		height:100%;
		overflow:hidden;
		border:1px solid #BC8FBD;
		float:left;
		position:relative;
	}
	
	/*
	CSS for the scrolling content 
	*/
	#scrolldiv_content{
		padding: 5px;
		position:relative;
		font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
		font-size: 0.9em;
		line-height:130%;
		color: #333;
	}
	
	/*
	The scrollbar slider 
	*/
	#scrolldiv_slider{
		width:15px;
		margin-left:2px;
		height:500px;
		float:left;
	}
	
	/*
	The scrollbar (The bar between the up and down arrow )
	*/
	#scrolldiv_scrollbar{
		width:15px;
		height:460px;	/* Total height - 40 pixels */
		border:1px solid #BC8FBD;
		position:relative;
		
	}
	/*
	The scrollbar handle
	*/
	#scrolldiv_theScroll{
		margin:1px;
		width:13px;
		height:13px;
		background-color:#BC8FBD;
		position:absolute;	
		top:0px;
		left:0px;
		cursor:pointer;
	}
	/*
	Scroll buttons(The up and down arrows)
	*/
	#scrolldiv_scrollUp,#scrolldiv_scrollDown{
		width:15px;
		height:16px;
		border:1px solid #BC8FBD;
		color: #BC8FBD;
		text-align:center;
		font-size:16px;
		line-height:16px;
		cursor:pointer;
	}
	#scrolldiv_scrollUp{
		margin-bottom:2px;
	}
	#scrolldiv_scrollDown{
		margin-top:2px;
	}
	#scrolldiv_scrollDown span,#scrolldiv_scrollUp span{
		font-family: Symbol;
	}

	</style>
	<script type="text/javascript">
	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, September 2005
	
	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.	
	
	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.
	
	Thank you!
	
	www.dhtmlgoodies.com
	Alf Magne Kalleland
	
	************************************************************************************************************/	
	var contentHeight = 0; 	// The total height of the content
	var visibleContentHeight = 0;	
	var scrollActive = false;
	
	var scrollHandleObj = false; // reference to the scroll handle
	var scrollHandleHeight = false;
	var scrollbarTop = false;
	var eventYPos = false;

	var scrollbuttonActive = false;
	var scrollbuttonDirection = false;
	var scrollbuttonSpeed = 2; // How fast the content scrolls when you click the scroll buttons(Up and down arrows)
	var scrollTimer = 10;	// Also how fast the content scrolls. By decreasing this value, the content will move faster	
	
	var scrollMoveToActive = false;
	var scrollMoveToYPosition = false;
	function scrollDiv_startScroll(e)
	{
		if(document.all)e = event;
		scrollbarTop = document.getElementById('scrolldiv_theScroll').offsetTop;
		eventYPos = e.clientY;
		scrollActive = true;
	}
	
	function scrollDiv_stopScroll()
	{
		scrollActive = false;
		scrollbuttonActive = false;
		scrollMoveToActive = false;
	}
	function scrollDiv_scroll(e)
	{
		if(!scrollActive)return;
		if(document.all)e = event;
		if(e.button!=1 && document.all)return;
		var topPos = scrollbarTop + e.clientY - eventYPos; 
		if(topPos<0)topPos=0;
		if(topPos/1>visibleContentHeight-(scrollHandleHeight+4)/1)topPos = visibleContentHeight-(scrollHandleHeight+4);
		document.getElementById('scrolldiv_theScroll').style.top = topPos + 'px';
		document.getElementById('scrolldiv_content').style.top = 0 - Math.floor((contentHeight) * ((topPos)/(visibleContentHeight-scrollHandleHeight)))+'px' 
	}
	
	/*
	Click on the slider
	Move the content to the this point
	*/
	function scrolldiv_scrollMoveToInit(e)
	{		
		if(document.all)e = event;
		scrollMoveToActive = true;
		scrollMoveToYPosition = e.clientY - document.getElementById('scrolldiv_scrollbar').offsetTop;
		if(document.getElementById('scrolldiv_theScroll').offsetTop/1 > scrollMoveToYPosition) scrollbuttonDirection = scrollbuttonSpeed*-2; else  scrollbuttonDirection = scrollbuttonSpeed*2;
		scrolldiv_scrollMoveTo();	
	}
	
	function scrolldiv_scrollMoveTo()
	{
		if(!scrollMoveToActive || scrollActive)return;
		var topPos = document.getElementById('scrolldiv_theScroll').style.top.replace('px','');
		topPos = topPos/1 + scrollbuttonDirection;
		if(topPos<0){
			topPos=0;
			scrollMoveToActive=false;
		}
		if(topPos/1>visibleContentHeight-(scrollHandleHeight+4)/1){
			topPos = visibleContentHeight-(scrollHandleHeight+4);	
			scrollMoveToActive=false;
		}
		if(scrollbuttonDirection<0 && topPos<scrollMoveToYPosition-scrollHandleHeight/2)return;	
		if(scrollbuttonDirection>0 && topPos>scrollMoveToYPosition-scrollHandleHeight/2)return;			
		document.getElementById('scrolldiv_theScroll').style.top = topPos + 'px';
		document.getElementById('scrolldiv_content').style.top = 0 - Math.floor((contentHeight) * ((topPos)/(visibleContentHeight-scrollHandleHeight)))+'px' 		
		setTimeout('scrolldiv_scrollMoveTo()',scrollTimer);		
	}
	
	function cancelEvent()
	{
		return false;			
	}

	function scrolldiv_scrollButton()
	{
		if(this.id=='scrolldiv_scrollDown')scrollbuttonDirection = scrollbuttonSpeed; else scrollbuttonDirection = scrollbuttonSpeed*-1;
		scrollbuttonActive=true;
		scrolldiv_scrollButtonScroll();
	}
	function scrolldiv_scrollButtonScroll()
	{
		if(!scrollbuttonActive)return;
		var topPos = document.getElementById('scrolldiv_theScroll').style.top.replace('px','');
		topPos = topPos/1 + scrollbuttonDirection;
		if(topPos<0){
			topPos=0;
			scrollbuttonActive=false;
		}
		if(topPos/1>visibleContentHeight-(scrollHandleHeight+4)/1){
			topPos = visibleContentHeight-(scrollHandleHeight+4);	
			scrollbuttonActive=false;
		}	
		document.getElementById('scrolldiv_theScroll').style.top = topPos + 'px';
		document.getElementById('scrolldiv_content').style.top = 0 - Math.floor((contentHeight) * ((topPos)/(visibleContentHeight-scrollHandleHeight)))+'px' 			
		setTimeout('scrolldiv_scrollButtonScroll()',scrollTimer);
	}
	function scrolldiv_scrollButtonStop()
	{
		scrollbuttonActive = false;
	}
	
	
	function scrolldiv_initScroll()
	{
		visibleContentHeight = document.getElementById('scrolldiv_scrollbar').offsetHeight ;
		contentHeight = document.getElementById('scrolldiv_content').offsetHeight - visibleContentHeight;		
		scrollHandleObj = document.getElementById('scrolldiv_theScroll');
		scrollHandleHeight = scrollHandleObj.offsetHeight;
		scrollbarTop = document.getElementById('scrolldiv_scrollbar').offsetTop;		
		document.getElementById('scrolldiv_theScroll').onmousedown = scrollDiv_startScroll;
		document.body.onmousemove = scrollDiv_scroll;
		document.getElementById('scrolldiv_scrollbar').onselectstart = cancelEvent;
		document.getElementById('scrolldiv_theScroll').onmouseup = scrollDiv_stopScroll;
		if(document.all)document.body.onmouseup = scrollDiv_stopScroll; else document.documentElement.onmouseup = scrollDiv_stopScroll;
		document.getElementById('scrolldiv_scrollDown').onmousedown = scrolldiv_scrollButton;
		document.getElementById('scrolldiv_scrollUp').onmousedown = scrolldiv_scrollButton;
		document.getElementById('scrolldiv_scrollDown').onmouseup = scrolldiv_scrollButtonStop;
		document.getElementById('scrolldiv_scrollUp').onmouseup = scrolldiv_scrollButtonStop;
		document.getElementById('scrolldiv_scrollUp').onselectstart = cancelEvent;
		document.getElementById('scrolldiv_scrollDown').onselectstart = cancelEvent;
		document.getElementById('scrolldiv_scrollbar').onmousedown = scrolldiv_scrollMoveToInit;
	}
	/*
	Change from the default color
	*/	
	function scrolldiv_setColor(rgbColor)
	{
		document.getElementById('scrolldiv_scrollbar').style.borderColor = rgbColor;
		document.getElementById('scrolldiv_theScroll').style.backgroundColor = rgbColor;
		document.getElementById('scrolldiv_scrollUp').style.borderColor = rgbColor;
		document.getElementById('scrolldiv_scrollDown').style.borderColor = rgbColor;
		document.getElementById('scrolldiv_scrollUp').style.color = rgbColor;
		document.getElementById('scrolldiv_scrollDown').style.color = rgbColor;
		document.getElementById('scrolldiv_parentContainer').style.borderColor = rgbColor;
	}
	/*
	Setting total width of scrolling div
	*/
	function scrolldiv_setWidth(newWidth)
	{
		document.getElementById('dhtmlgoodies_scrolldiv').style.width = newWidth + 'px';
		document.getElementById('scrolldiv_parentContainer').style.width = newWidth-30 + 'px';		
	}
	
	/*
	Setting total height of scrolling div
	*/
	function scrolldiv_setHeight(newHeight)
	{
		document.getElementById('dhtmlgoodies_scrolldiv').style.height = newHeight + 'px';
		document.getElementById('scrolldiv_parentContainer').style.height = newHeight + 'px';
		document.getElementById('scrolldiv_slider').style.height = newHeight + 'px';
		document.getElementById('scrolldiv_scrollbar').style.height = newHeight-40 + 'px';		
	}
	/*
	Setting new background color to the slider 
	*/
	function setSliderBgColor(rgbColor)
	{
		document.getElementById('scrolldiv_scrollbar').style.backgroundColor = rgbColor;
		document.getElementById('scrolldiv_scrollUp').style.backgroundColor = rgbColor;
		document.getElementById('scrolldiv_scrollDown').style.backgroundColor = rgbColor;
	}
	/*
	Setting new content background color
	*/
	function setContentBgColor(rgbColor)
	{
		document.getElementById('scrolldiv_parentContainer').style.backgroundColor = rgbColor;
	}
	
	/*
	Setting scroll button speed
	*/
	function setScrollButtonSpeed(newScrollButtonSpeed)
	{
		scrollbuttonSpeed = newScrollButtonSpeed;
	}
	/*
	Setting interval of the scroll
	*/
	function setScrollTimer(newInterval)
	{
		scrollTimer = newInterval;
	}
	
	</script>


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
		<h3>Categorias</h3>
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
			</fieldset>
		</form>
		
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">		
		<table>
			<tr>
				<td><input type="submit" value="X" name="borrar" onclick="return confirm('Desea Borrar?')" /></td>
				<td><b>Nombre</b></td>
				<td class="action"><b>Editar</b></td>
				<td class="action"><b>Borrar</b></td>
				<td><b>Senal</b></td>
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
							<td><input name='archivos[]' type='checkbox' value="<?=$row['idGrupos']?>"></td>
							<td><?=ucfirst(strtolower($row['grupos']))?></td>
							<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?edit=<?=$row['idGrupos']?>">Editar</a></td>
							<td class="action"><a href="<?=$_SERVER['PHP_SELF']?>?delete=<?=$row['idGrupos']?>" onclick="return confirm('Seguro que desea borrar?')">Borrar</td>
							<td align="left"><?=$row['categoria']?></td>
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
			if($_GET['add_us'] != '' or $_GET['add_all_us'] != '' or $_GET['rem_all_us'] != '')
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
					<h4>Videos Disponibles &gt;&gt; <a href="<?=$_SERVER['PHP_SELF']?>?add_all_us=<?=$idGrupos?>">Agregar todos</a></h4>
					<br />
					<input type="submit" name="a_selected" value="add selected" />
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
									?><li id="itemid_<?=$row['id_archivo']?>"><input type="checkbox" name="addItems[]" value="<?=$row['id_archivo']?>" /><?=$row['nombreArchivo']?></li><?php;  
							}

					?>
					</ul>
					</form>
					
					<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<ul id="sortlist2">
					<h4>Videos en <?=$nomGrupo?> &gt;&gt; <a href="<?=$_SERVER['PHP_SELF']?>?rem_all_us=<?=$idGrupos?>">Remover todos</a></h4>
					<br/>
					<input type="submit" name="r_selected" value="remove selected" />
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
<script type="text/javascript">
scrolldiv_setColor('#317082');	// Setting border color of the scrolling content
setSliderBgColor('#E2EBED');	// Setting color of the slider div
setContentBgColor('#FFFFFF');	// Setting color of the scrolling content
setScrollButtonSpeed(1);	// Setting speed of scrolling when someone clicks on the arrow or the slider
setScrollTimer(5);	// speed of 1 and timer of 5 is the same as speed of 2 and timer on 10 - what's the difference? 1 and 5 will make the scroll move a little smoother.
scrolldiv_setWidth(750);	// Setting total width of scrolling div
scrolldiv_setHeight(400);	// Setting total height of scrolling div
scrolldiv_initScroll();	// Initialize javascript functions
</script>

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
