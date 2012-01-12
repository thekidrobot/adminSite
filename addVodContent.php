<?
	include("includes/connection.php");
	include("session.php");
	
	$msg = "";
	
	$cat_id = $_REQUEST['cat_id'];
	
	if(trim($cat_id) == "" or !is_numeric($cat_id) or $cat_id == 0)
	{
		redirect("viewVodCategories.php");
	}
	
	$sql = "select * from vodcategories where id = $cat_id";
	$rsGet = $DB->Execute($sql);
	
	//Add selected multiple
	$addItems = $_POST['addItems'];
	$N = count($addItems);
	
	if($N > 0)
	{		
		for($i=0; $i < $N; $i++)
		{
			$sql = "INSERT INTO vod_channels_categories (channel_id,category_id) VALUES (".$addItems[$i].",$cat_id)";
			$rsSet = $DB->execute($sql);
			$msg = _("Changes done!");
		} 
	}	
	
	//delete selected multiple
	$remItems = $_POST['remItems'];
	$N = count($remItems);
	if($N > 0)
	{
		$cat_id = $_POST['cat_id'];
		for($i=0; $i < $N; $i++)
		{
			$sql = "delete from vod_channels_categories where channel_id = ".$remItems[$i]." and category_id =".$cat_id;
			$rsSet = $DB->execute($sql);
		}
		$msg = _("Changes done!");
	}

	//Add All
	if (trim($_POST['a_all']) != ""){
		
		$cat_id = $_POST['cat_id'];
		
		$sql = "SELECT * FROM vodchannels where id not in
						(
							select 	channel_id from vod_channels_categories
							where		category_id = $cat_id
						)	ORDER 	BY id";
						
		$rsGet = $DB->execute($sql);
		
		while (!$rsGet->EOF)
		{
			$sql = "INSERT INTO vod_channels_categories (channel_id,category_id)
							VALUES (".$rsGet->fields['id'].",$cat_id)";
			$rsSet = $DB->execute($sql);
			
			$rsGet->movenext();
		}
		$msg = _("Changes done!");	
	}
	
	//Delete All
	if (trim($_POST['r_all']) != "")
	{
		$cat_id = $_POST['cat_id'];
		$sql = "delete from vod_channels_categories where category_id = $cat_id";
		$rsSet = $DB->execute($sql);
		$msg = _("Changes done!");
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
		
		<div id="main">

			<div id="headerDiv">
				<h2><a href="#"><?=_("VOD Categories")?></a> &raquo; <a href="#" class="active"><?=_("Add Content for ") ?><?=strtolower($rsGet->fields['name'])?></a></h2>
			</div>
			
			<div id="dhtmlgoodies_scrolldiv">
				<div id="scrolldiv_parentContainer">
					<div id="scrolldiv_content">

						<p id="changeNotification">
							<div id="activityIndicator" style="display:none; ">
								<img src="imagenes/loading_indicator.gif" style="margin-right:10px;" /><?=_("Updating data, please wait")?>...
							</div>
							<div id="completeIndicator" style="display:none; ">
								<?=_("Changes Done!") ?>
							</div>
							<?php if(trim($msg)!=""){
								?>
								<div align="center">
									<?=$msg?>
								</div>
								<?
							}
							?>
							<br />
						</p>
						<?
							$sql1 = "SELECT * FROM vodchannels where id not in
											(
												select 	channel_id from vod_channels_categories
												where		category_id = $cat_id
											)	ORDER 	BY id";

							$sql2 = "SELECT * FROM vodchannels where id in
											(
												select 	channel_id from vod_channels_categories
												where		category_id = $cat_id
											) ORDER BY id";	
					
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
							</div>

							<ul id="sortlist" style="height:<?=$height?>px;">
								<h4><?=_("Available videos")?></h4>
								<input type="hidden" value="<?=$cat_id?>" name="cat_id" /><br/><br/>
								<?php
								while (!$rsGetLeft->EOF)
								{  
								?>
									<li id="itemid_<?=$rsGetLeft->fields['id']?>">
									<input type="checkbox" name="addItems[]" value="<?=$rsGetLeft->fields['id']?>" />
									<?=$rsGetLeft->fields['name']?></li>
									<?php
									$rsGetLeft->movenext();
								}
							?>
							</ul>
						</form>
						
						<form action="<?=$currentPage?>" method="post">
							<div class="buttons_right">
								<input type="submit" name="r_selected" value="<?=_("<")?>" class="button-submit" /><br /><br />
								<input type="submit" name="r_all" class="button-submit" value="<?=_("<<")?>" />
								</a>
							</div>
						
							<ul id="sortlist2" style="height:<?=$height?>px;">
								<h4><?=_("Videos in category") ?> <?=ucfirst(strtolower($rsGet->fields['name']))?></h4>
								<input type="hidden" value="<?=$cat_id?>" name="cat_id" /><br/><br/>
								<?php
								while (!$rsGetRight->EOF)
								{
									?>
									<li id="itemid_<?=$rsGetRight->fields['id']?>">
									<input type="checkbox" name="remItems[]" value="<?=$rsGetRight->fields['id']?>" />
									<?=$rsGetRight->fields['name']?></li>
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
			<script type="text/javascript" src="style/js/scrollingInit.js"></script>
			</div>
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