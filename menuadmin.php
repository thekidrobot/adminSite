<?
include("conexion.php");
include("session.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ben-vindo a RAMP</title>

<link rel="stylesheet" type="text/css" href="css/anylinkmenu.css" />
<script type="text/javascript" src="js/menucontents.js"></script>
<script type="text/javascript" src="js/anylinkmenu.js">

/***********************************************
* AnyLink JS Drop Down Menu v2.0- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com/dynamicindex1/dropmenuindex.htm for full source code
***********************************************/

</script>

<script type="text/javascript">

//anylinkmenu.init("menu_anchors_class") //Pass in the CSS class of anchor links (that contain a sub menu)
anylinkmenu.init("menuanchorclass")

</script>

<!-- CSS -->
<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->

<!-- JavaScripts-->
<script type="text/javascript" src="style/js/jquery.js"></script>
<script type="text/javascript" src="style/js/jNice.js"></script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body>
	<div id="wrapper">
    	<!-- h1 tag stays for the logo, you can use the a tag for linking the index page -->
    	<h1><a href="inicio.html" target="carga"><span>:::::RAMP:::::::</span></a></h1>
			<!--<ul id="mainNav">-->
			<!--	<li><a href="inicio.html" target="carga" class="active"><?=_("Home")?></a></li>-->
			<!--	<li><a href="archivos/listarArchivos.php" target="carga" class="menuanchorclass" rel="anylinkmenu1"><?=_("Manage Files")?></a></li>-->
			<!--	<li><a href="categoriasVideos.php" target="carga" class="menuanchorclass" rel="anylinkmenu2"><?=_("Manage Categories")?></a></li>-->
			<!--	<li><a href="admusuarios.php" target="carga"><?=_("Manage Users")?></a></li>-->
			<!--	<!--<li><a href="reportes/index.php" target="carga"><?=_("Manage Reports")?></a></li>-->
			<!--  <li><a href="admacceso.php" target="carga"><?=_("Manage my account") ?></a></li>-->
			<!--	<li class="logout"><a href="index.php"><?=_("Logout")?></a></li>-->
			<!--</ul>-->
			<?php include("includes/mainnav.php") ?>
			<!-- // #end mainNav -->

      <div id="containerHolder">
			<div id="container">
				<div id="sidebar">
					<?php include("includes/sidenav.php") ?>
				</div>    
				<!-- // #sidebar -->

				<!-- h2 stays for breadcrumbs -->
				<!--<h2><a href="#">Dashboard</a> &raquo; <a href="#" class="active">Print resources</a></h2>-->
				<!--<h2>&nbsp;</h2>-->
        <div id="main">
					<iframe name="carga" src="inicio.html" width="805" height="716" scrolling="auto" frameborder="0" class="Slide" id="carga"></iframe>
        </div><!-- // #main -->
      <div class="clear"></div>
      </div><!-- // #container -->
    </div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>