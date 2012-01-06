<head>
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=_("Welcome to RAMP")?></title>

<script type="text/javascript" src="style/js/jQuery.js"></script>
<script type="text/javascript" src="style/js/jNice.js"></script>

<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->
<?php
if($currentPage == "menuadmin.php")
{
?>
	<!-- Beginning of conditional styles for menuadmin.php-->
	<!-- Tooltip	-->
	<script type="text/javascript" src="js/ajax-tooltip.js"><?php include("dhtmlLicense.txt")?></script>	
	<link rel="stylesheet" href="css/ajax-tooltip.css" media="screen" type="text/css">
	
	<!-- Scroller	-->
	<link href="style/css/scrollingContent.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="style/js/scrollingContent.js"></script>
	
	<!-- ShowHide	-->
	<script type="text/javascript" src="style/js/toggleShowHide.js"></script>

	<!-- DragDrop	-->
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
	<!-- End of conditional styles for menuadmin.php-->
	<?php	
	}
	elseif($currentPage == "addLive.php"
				 or $currentPage == "editLive.php"
         or $currentPage == "addVod.php")
	{
		?>
		<!-- Beginning of conditional styles for addArchivo.php-->
		<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-blue.css" />
		<script type="text/javascript" src="jscalendar/calendar.js"></script>
		<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>
		<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
		<!-- End of conditional styles for addArchivo.php-->	
    <?
	}
  elseif($currentPage == "addVodContent.php")
  {
    ?>
    <!-- Beginning of conditional styles for categoriasVideos.php-->
		<!--	Scroller -->
    <link href="style/css/scrollingContent.css" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript" src="style/js/scrollingContent.js"></script>
    
		<!--	Dragdrop	-->
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
                  new Ajax.Request("includes/addVideo.php", {
                  method: "post",
                  onLoading: function(){$('activityIndicator').show()},
                  onLoaded: function(){$('activityIndicator').hide()},
                  parameters: { data: Sortable.serialize(list), container: list.id,cat_id: <?=$cat_id?> }
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
                  new Ajax.Request("includes/removeVideo.php", {
                  method: "post",
                  onLoading: function(){$('activityIndicator').show()},
                  onLoaded: function(){$('activityIndicator').hide()},
                  parameters: { data: Sortable.serialize(list), container: list.id , cat_id: <?=$cat_id?> }
              });
          }
          });
          
      });
      //]]>
      </script>
    <!-- End of conditional styles for categoriasVideos.php-->	
    <?
  }
  elseif($currentPage == "gruposUsuarios.php")
  {
    ?>
    <!-- Beginning of conditional styles for gruposUsuarios.php-->	
  
		<!--  Scroller  -->
    <link href="style/css/scrollingContent.css" rel="stylesheet" type="text/css" media="screen" />
	
		<!--  ShowHide  -->
    <script type="text/javascript" src="style/js/toggleShowHide.js"></script>
    <script type="text/javascript" src="style/js/scrollingContent.js"></script>
  
		<!--	Dragdrop	-->
    <script type="text/javascript" src="js/scriptaculous/lib/prototype.js"></script>
    <script type="text/javascript" src="js/scriptaculous/src/scriptaculous.js"></script>
    <link rel="stylesheet" type="text/css" href="style/css/dragdrop.css" />

		<?php
		if(trim($_GET['add_us']) != '' or trim($_GET['add_all_us']) != '' or trim($_GET['rem_all_us']) != '' or trim($_POST['idGrupo_usr']) != '')
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
			<!-- End of conditional styles for gruposUsuarios.php-->	
			<?php
		}
  }
  elseif($currentPage == "gruposPaquetes.php")
  {
  ?>
    <!-- Beginning of conditional styles for gruposPaquetes.php-->	
    
		<!--	Scroller	-->
    <link href="style/css/scrollingContent.css" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript" src="style/js/scrollingContent.js"></script>
		
		<!--  ShowHide  -->
    <script type="text/javascript" src="style/js/toggleShowHide.js"></script>
    
		<!--	DragDrop	-->
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
      <!-- End of conditional styles for gruposPaquetes.php-->	
      <?php
    }
  }
  elseif($currentPage == "admusuarios.php")
  {
    ?>
      <!-- Beginning of conditional styles for admusuarios.php-->	

			<!--	Tooltip		-->
      <script type="text/javascript" src="js/ajax-tooltip.js"><?php include("dhtmlLicense.txt")?></script>	
      <link rel="stylesheet" href="css/ajax-tooltip.css" media="screen" type="text/css">

			<!--  ShowHide    -->
      <script type="text/javascript" src="style/js/toggleShowHide.js"></script>
      <!-- End of conditional styles for admusuarios.php-->	
    <?
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
	
	<style type="text/css">

	table.gallery{
		border: solid 1px #ffffff;
		border-collapse:collapse;
		padding:0;
	}

	table.gallery tr td{
		border: solid 1px #ffffff;
		border-collapse:collapse;
		padding:0;
		margin:0;
		background-image:none;
	}
	
	.album{
	  width:100%;
		float:left;
	}

	.album img{
		border: 3px solid #ebebeb;
	}
	
	.album .imageSingle {
		float: left;
		padding-top:5px;
		margin: 15px; 
		width:156px; 
		text-align:center; 
		border:solid 1px #e1e1e1;
	}
	
	.album .imageSingle .image {
		margin:3px;
	}

	.album .footer {
		text-align:left;
		line-height:17px;
		border-top:solid 1px #e1e1e1; 
		padding:7px; 
		margin-top: 10px;
	}
	
	</style>
	
</head>