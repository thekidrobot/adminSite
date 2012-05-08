<?php

include("includes/connection.php");
include("session.php");

if($_SESSION['role'] == 0)
{
	redirect('index.php');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include ("includes/head.php") ?>
	<body>
		<div id="wrapper">
		<h1><a href="#">&nbsp;</a></h1>
		<?php include("includes/mainnav.php") ?>
		<!-- // #end mainNav -->
		<div id="containerHolder">
			<div id="container">
				<div id="sidebar">
				 <?php include("includes/sidenav.php") ?>
				</div>    
				<!-- // #sidebar -->
		
				<div id="main">
					<h2><a href="#"><?=_("Reports")?></a> &raquo; <a href="#" class="active"><?=_("Log Viewer")?></a></h2>
				
					<?
						$logfiles = array();
							
						if ($handle = opendir('logs')) {
							while (false !== ($entry = readdir($handle))) {
								if ($entry != "." && $entry != ".." && (strpos($entry,'-') !== 0) && (strpos($entry,'_') !== 0)) {
									array_push($logfiles,$entry);
								}
							}
							closedir($handle);
						}
						
						asort($logfiles);
						
					?>
					
					<form method="post" name="logs" action="<?=$_SERVER[PHP_SELF]?>" class="jNice">
					
						<label><?=_("Select a log file to read")?> : </label><br /><br />
						<select name="logname" onChange="document.logs.submit()">
							<option value=""> -- Select one -- </option>
							<?php										
								foreach($logfiles as $key){
									?>
									<option <? if($_POST['logname'] == $key) echo "selected='selected'" ?> value="<?=$key?>"><?=$key?></option>
									<?
								}
							?>
						</select>
					</form>
					
					<br />
					<br />
		
					<?php
						if($_POST['logname']){
							?><h3>Contents for the log file <?=$_POST['logname']?></h3><?
						}
					?>
					<div class="logs"
							style="height:400px;
							width:800px;
							overflow:auto;
							margin-top:10px;">
					
					<?
					
					$filename = "logs/".$_POST['logname'];
					
					$showlog = file_get_contents($filename);
					echo "<pre>$showlog</pre>";
					
					?>
					</div>
					
				</div><!-- // #main -->
      <div class="clear"></div>
    </div><!-- // #container -->
    </div><!-- // #containerHolder -->
  <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>