<?
	include("includes/connection.php");
	include("session.php");

	$usr_id = $_REQUEST['usr_id'];
	
	$sql = "select * from subscribers where id = $usr_id";
	$rsGet = $DB->Execute($sql);
	
	//Add selected multiple
	$addItems = $_POST['addItems'];
	$N = count($addItems);
	
	if($N > 0)
	{		
		for($i=0; $i < $N; $i++)
		{
			$sql = "INSERT INTO subscribers_packages
							(subscriber_id,package_id)
							VALUES ($usr_id,".$addItems[$i].")";
			$rsSet = $DB->execute($sql);
		} 
	}	
	
	//delete selected multiple	
	$remItems = $_POST['remItems'];
	$N = count($remItems);
	if($N > 0)
	{
		$usr_id = $_POST['usr_id'];
		for($i=0; $i < $N; $i++)
		{
			$sql = "delete from subscribers_packages
							where package_id = ".$remItems[$i]." and subscriber_id =".$usr_id;
			$rsSet = $DB->execute($sql);
		} 
	}
	
	//Add All
	if (trim($_POST['a_all']) != ""){
		
		$usr_id = $_POST['usr_id'];
		
		$sql = "SELECT * FROM packages where id not in
						(
							select 	package_id from subscribers_packages
							where		subscriber_id = $usr_id
						) ORDER BY id ";  					
						
		$rsGet = $DB->execute($sql);
		
		while (!$rsGet->EOF)
		{
			$sql = "INSERT INTO subscribers_packages (package_id,subscriber_id)
							VALUES (".$rsGet->fields['id'].",$usr_id)";
			$rsSet = $DB->execute($sql);
			
			$rsGet->movenext();
		}	
	}
	
	//Delete All
	if (trim($_POST['r_all']) != "")
	{
		$usr_id = $_POST['usr_id'];
		$sql = "delete from subscribers_packages where subscriber_id = $usr_id";
		$rsSet = $DB->execute($sql);
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
		<div id="main">
			<h2><a href="#"><?=_("Subscribers")?></a> &raquo; <a href="#" class="active"><?=_("Add packages")?></a></h2>
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
							$sql1 = "SELECT * FROM packages where id not in
											(
												select 	package_id from subscribers_packages
												where		subscriber_id = $usr_id
											) ORDER BY id ";
												 
							$sql2 = "SELECT * FROM packages where id in
											(
												select 	package_id from subscribers_packages
												where		subscriber_id = $usr_id
											) ORDER BY id ";
											 
							$rsGetLeft = $DB->execute($sql1);
							$rsGetRight = $DB->execute($sql2);
					
							$nleft = $rsGetLeft->numrows();
							$nright = $rsGetRight->numrows();
						 
							if($nleft >= $nright){
								if($nleft < 4) $height = $nleft * 68;
								else $height = $nleft * 38;	
							}
							else{
								if($nright < 4) $height = $nright * 68;
								else $height = $nright * 38;	
							}
						?>
						<form action="<?=$currentPage?>" method="post">	
							<div class="buttons_left">
								<input type="submit" name="a_all" value="<?=_(">>")?>" class="button-submit" />
								<br /><br />
								<input type="submit" name="a_selected" value="<?=_(">")?>" class="button-submit" />
								<input type="hidden" value="<?=$usr_id?>" name="usr_id" />
							</div>
						
							<ul id="sortlist" style="height:<?=$height?>px;">
								<h4><?=_("Available packages")?></h4>
								<br/>
								<?php  
								while (!$rsGetLeft->EOF)
								{  
									?>
									<li id="itemid_<?=$rsGetLeft->fields['id']?>">
										<input type="checkbox" name="addItems[]" value="<?=$rsGetLeft->fields['id']?>" />
										<?=$rsGetLeft->fields['name']?>	
									</li>
									<?php
									$rsGetLeft->movenext();	
								}  
								?>
								<br />
							</ul>
						</form>
					
						<form action="<?=$currentPage?>" method="post">
							<div class="buttons_right">
								<input type="submit" name="r_selected" value="<?=_("<")?>" class="button-submit" />
								<br /><br />
								<input type="submit" name="r_all" value="<?=_("<<")?>" class="button-submit" />
								<input type="hidden" value="<?=$usr_id?>" name="usr_id" />
							</div>
							<ul id="sortlist2" style="height:<?=$height?>px;">
								<h4><?=_("Packages for ")?> <?=$rsGet->fields['name']?></h4>
								<br/>
								<?php  
									while (!$rsGetRight->EOF)
									{  
										?>
										<li id="itemid_<?=$rsGetRight->fields['id']?>">
										<input type="checkbox" name="remItems[]" value="<?=$rsGetRight->fields['id']?>" />
										<?=$rsGetRight->fields['name']?>
										</li>
										<?php
										$rsGetRight->movenext();
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
			<br />
			<br />			

		</div><!-- // #main -->
    <div class="clear"></div>
    </div><!-- // #container -->
		</div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>