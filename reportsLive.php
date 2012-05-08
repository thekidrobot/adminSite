<?php

include("includes/connection.php");
include("session.php");

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
					<h2><a href="#"><?=_("Reports")?></a> &raquo; <a href="#" class="active"><?=_("Reports by user - Live Channels")?></a></h2>
				
					<form method="post" name="subscribers" action="<?=$_SERVER[PHP_SELF]?>" class="jNice">
					
						<label><?=_("Select a subscriber")?> : </label><br /><br />
						<select name="subscriber" onChange="document.subscribers.submit()">
							<option value=""> -- Select one -- </option>
							<?php
								$sql = "SELECT * FROM subscribers";
								
								$rsGet = $DB->execute($sql);
								
								while (!$rsGet->EOF)
								{
									$subscriber_id = $rsGet->fields['id'];
									$subscriber_name = $rsGet->fields['name'];
									
									?>
									<option <? if($_POST['subscriber'] == $subscriber_id) echo "selected='selected'" ?> value="<?=$subscriber_id?>">
										<?=$subscriber_name?>
									</option>
									<?
									$rsGet->movenext();
								}
							?>
						</select>
					</form>
					
					<br />
					<br />
		
					<?php
						if($_POST['subscriber'])
						{
							$subscriber_id = $_POST['subscriber'];
							$sql = "SELECT * FROM subscribers where id = $subscriber_id";
								
							$rsGet = $DB->execute($sql);
								
							while (!$rsGet->EOF)
							{
								$subscriber_id = $rsGet->fields['id'];
								$subscriber_name = $rsGet->fields['name'];
								$rsGet->movenext();
							}
							?><h3><?=_("Historic of live videos for the user ")?><?=$subscriber_name?></h3><?
						?>
						<table>
						<thead>
							<tr>
								<th class="sortable"><b><?=_("Video Name")?></b></th>
								<th class="sortable"><b><?=_("Number of views")?></b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								
								$sqlGet = "SELECT 
														lc.name,
														lc.id,
														COUNT(resource_id) AS number_of_views
													FROM 
														views_livechannels vl, 
														livechannels lc
													WHERE 
														vl.resource_id = lc.id AND 
														vl.subscriber_id = $subscriber_id 
													GROUP BY 
														resource_id";
							
								$counter = 0;
								$rsGet = $DB->Execute($sqlGet);
												
								while (!$rsGet->EOF)
								{
									$video_id = $rsGet->fields['id'];
									$video_name = $rsGet->fields['name'];
									?>
									<tr <?php if($counter % 2) echo " class='odd'"?>>									
										<td class="gallery clearfix">
											<a href="graphs/viewsPerDateUserLive.php?uid=<?=$subscriber_id?>&vid=<?=$video_id?>&iframe=true&width=800&height=550" rel="prettyPhoto[details]" title="Views for the video <?=$video_name?>">
											<?=$rsGet->fields['name']?>
											</a>
										</td>
										<td><?=$rsGet->fields['number_of_views']?></td>
									</tr>
									<?php
									$rsGet->movenext();
									$counter++;
								}
								if ($counter == 0)
								{
									?>
									<tr>
										<td colspan="2" align="center"><?=_("No records found")?></td>
									</tr>
									<?
								}
								?>
						</tbody>
						</table>
						
						<?						
						}
					?>
				<script type="text/javascript" src="js/pagination.js"></script>
				</div><!-- // #main -->
      <div class="clear"></div>
    </div><!-- // #container -->
    </div><!-- // #containerHolder -->
  <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>