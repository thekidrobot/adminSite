<?php
// Include your file which makes a connection to your database
include('include/class.database.php');        
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<title>Drag, drop and sort images with Javascript's Prototype</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="pragma" content="no-cache" />
    <script type="text/javascript" src="scriptaculous/lib/prototype.js"></script>
    <script type="text/javascript" src="scriptaculous/src/scriptaculous.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script type="text/javascript"> 
		//<![CDATA[
		document.observe('dom:loaded', function() {
				var changeEffect;
				Sortable.create("sortlist2", {containment: ['sortlist', 'sortlist2'], tag:'li', overlap:'horizontal', constraint:false, dropOnEmpty: true,
						onChange: function(item) {
								var list = Sortable.options(item).element;
								$('changeNotification').update(Sortable.serialize(list).escapeHTML());
								if(changeEffect) changeEffect.cancel();
								changeEffect = new Effect.Highlight('changeNotification', {restoreColor:"transparent" });
						},			
						onUpdate: function(list) {
								new Ajax.Request("addPerson.php", {
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
						$('changeNotification').update(Sortable.serialize(list).escapeHTML());
						if(changeEffect) changeEffect.cancel();
						changeEffect = new Effect.Highlight('changeNotification', {restoreColor:"transparent" });
				},			
				onUpdate: function(list) {
								new Ajax.Request("removePerson.php", {
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
    <p id="changeNotification"></p> 
				<div id="activityIndicator" style="display:none; ">
						Saving image order to database <img src="images/loading_indicator.gif" />
				</div> 
		<div id="wrapper">
		<div id="sortlist">
				<ul>
				<?php  
				$sql = mysql_query("SELECT * FROM usuarios where IdUsuario not in
															  (
																		select 	IdUsuario from usuariosgruposusuarios
																		where		idGrupoDeUsuario = 1
																) ORDER BY IdUsuario ");  
            while ($row = mysql_fetch_array($sql)) {  
                ?><li id="pictureId_<?=$row['IdUsuario']?>"><?=$row['Usuario']?></li><?php;  
            }  
				?>
				</ul>
			<!--<img class="sorting" alt="West Hollywood home" id="pictureId_7" src="images/tn_7.jpg" />-->
			<!--<img class="sorting" alt="Highway 1 Chipmunk" id="pictureId_8" src="images/tn_8.jpg" />-->
			<!--<img class="sorting" alt="San Francisco fire trucks" id="pictureId_9" src="images/tn_9.jpg" />-->
			<!--<img class="sorting" alt="Grand Canyon Rainbow" id="pictureId_3" src="images/tn_3.jpg" />-->
		</div> 
    
		<div id="sortlist2">
				<ul>
				<?php  
            $sql = mysql_query("SELECT * FROM usuarios where IdUsuario in
															  (
																		select 	IdUsuario from usuariosgruposusuarios
																		where		idGrupoDeUsuario = 1
																) ORDER BY IdUsuario ");  
            while ($row = mysql_fetch_array($sql)) {  
								?><li id="pictureId_<?=$row['IdUsuario']?>"><?=$row['Usuario']?></li><?php;
						}  
        ?>
				</ul>
			<!--<img class="sorting" alt="MGM Las Vegas" id="pictureId_1" src="images/tn_1.jpg" /><img class="sorting" alt="Desert road" id="pictureId_6" src="images/tn_6.jpg" /><img class="sorting" alt="Yosemite" id="pictureId_4" src="images/tn_4.jpg" /><img class="sorting" alt="California Wine County" id="pictureId_5" src="images/tn_5.jpg" /><img class="sorting" alt="Hurricane Truck" id="pictureId_2" src="images/tn_2.jpg" />        -->
		</div>       
		
		<hr style="clear:both;visibility:hidden;" />            
		</div>        
  </html>
		
