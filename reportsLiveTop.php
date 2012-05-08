<?php

include("includes/connection.php");
include("session.php");

$limit = 50;

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
					<h2><a href="#"><?=_("Reports")?></a> &raquo; <a href="#" class="active"><?=_("Top $limit - Live")?></a></h2>

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
														vl.resource_id = lc.id 
													GROUP BY 
														resource_id
													ORDER BY
														number_of_views DESC
													LIMIT
														$limit";
							
								$counter = 0;
								$rsGet = $DB->Execute($sqlGet);
												
								while (!$rsGet->EOF)
								{
									$video_id = $rsGet->fields['id'];
									$video_name = $rsGet->fields['name'];
									?>
									<tr <?php if($counter % 2) echo " class='odd'"?>>									
										<td class="gallery clearfix">
											<a href="graphs/viewsPerDateLiveTop.php?vid=<?=$video_id?>&iframe=true&width=800&height=550" rel="prettyPhoto[details]" title="Views for the video <?=$video_name?>">
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
				</div><!-- // #main -->
      <div class="clear"></div>
    </div><!-- // #container -->
    </div><!-- // #containerHolder -->
  <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>