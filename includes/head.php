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
  if($currentPage == "addLive.php" or
     $currentPage == "editLive.php" or
     $currentPage == "addVod.php")
	{
		?>
		<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-blue.css" />
		<script type="text/javascript" src="jscalendar/calendar.js"></script>
		<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>
		<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
    <?
	}
  elseif($currentPage == "addVodContent.php")
  {
    ?>
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
    <?
  }
  elseif($currentPage == "addSubscriberPackage.php")
  {
    ?>
  
		<!--  Scroller  -->
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
									new Ajax.Request("includes/addSubscriberPck.php", {
									method: "post",
									onLoading: function(){$('activityIndicator').show()},
									onLoaded: function(){$('activityIndicator').hide()},
									parameters: { data: Sortable.serialize(list), container: list.id, usr_id: <?=$usr_id?> }
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
									new Ajax.Request("includes/remSubscriberPck.php", {
									method: "post",
									onLoading: function(){$('activityIndicator').show()},
									onLoaded: function(){$('activityIndicator').hide()},
									parameters: { data: Sortable.serialize(list), container: list.id, usr_id: <?=$usr_id?> }
							});
					}
					});
					
			});
			//]]>
		</script>
		<?php
  }
  elseif($currentPage == "addPackageContentLive.php")
  {
  ?>    
		<!--	Scroller	-->
    <link href="style/css/scrollingContent.css" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript" src="style/js/scrollingContent.js"></script>
		    
		<!--	DragDrop	-->
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
                  new Ajax.Request("includes/addPckLiveRes.php", {
                  method: "post",
                  onLoading: function(){$('activityIndicator').show()},
                  onLoaded: function(){$('activityIndicator').hide()},
                  parameters: { data: Sortable.serialize(list), container: list.id, pck_id: <?=$pck_id?> }
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
                  new Ajax.Request("includes/remPckLiveRes.php", {
                  method: "post",
                  onLoading: function(){$('activityIndicator').show()},
                  onLoaded: function(){$('activityIndicator').hide()},
                  parameters: { data: Sortable.serialize(list), container: list.id, pck_id: <?=$pck_id?> }
              });
          }
          });	
      });
      //]]>
      </script>
    <?
  }
    elseif($currentPage == "addPackageContentVod.php")
  {
  ?>    
		<!--	Scroller	-->
    <link href="style/css/scrollingContent.css" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript" src="style/js/scrollingContent.js"></script>
		    
		<!--	DragDrop	-->
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
                  new Ajax.Request("includes/addPckVodRes.php", {
                  method: "post",
                  onLoading: function(){$('activityIndicator').show()},
                  onLoaded: function(){$('activityIndicator').hide()},
                  parameters: { data: Sortable.serialize(list), container: list.id, pck_id: <?=$pck_id?> }
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
                  new Ajax.Request("includes/remPckVodRes.php", {
                  method: "post",
                  onLoading: function(){$('activityIndicator').show()},
                  onLoaded: function(){$('activityIndicator').hide()},
                  parameters: { data: Sortable.serialize(list), container: list.id, pck_id: <?=$pck_id?> }
              });
          }
          });	
      });
      //]]>
      </script>
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
</head>