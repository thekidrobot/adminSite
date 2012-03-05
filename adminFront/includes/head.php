<?php
		//error_reporting(0);
    session_start();
    include('includes/connection.php');
    include('includes/general_functions.php');
		include("includes/formvalidator.php");
    
		$logged = isLoggedIn();
    if ($logged == false) redirect('index.php');
?>
<head>
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?=_("Welcome to RAMP")?></title>

<script type="text/javascript">

/***********************************************
* Disable "Enter" key in Form script- By Nurul Fadilah(nurul@REMOVETHISvolmedia.com)
* This notice must stay intact for use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/
                
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      

</script>
<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->

<link rel="stylesheet" href="css/custom.css" type="text/css" media="screen" title="default" />

<!-- Lightbox -->
<script src="js/jQuery.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="style/js/jNice.js"></script>

  <!--[if IE]>
  <style type="text/css">
  ul.fdtablePaginater {display:inline-block;}
  ul.fdtablePaginater {display:inline;}
  ul.fdtablePaginater li {float:left;}
  ul.fdtablePaginater {text-align:center;}
  table { border-bottom:1px solid #C1DAD7; }
	
  </style>
  <![endif]-->	

<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
  });
</script>

</head>