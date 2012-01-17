<?
	include("includes/connection.php");
	include("session.php");

	$id = $_GET['usr_id'];
	
	if(trim($id) == "" or !is_numeric($id) or $id == 0)
	{
		redirect("viewSubscribers.php");
	}
	
	$sql = "SELECT distinct vc.id as id, vc.name as name
					FROM
						vodchannels vc,
						packages_vodchannels pv,
						subscribers sc,
						subscribers_packages sp
					WHERE
						pv.resource_id = vc.id AND
						pv.package_id = sp.package_id AND
						sp.subscriber_id = sc.id AND
						sc.id = $id";
						
	$rsGet = $DB->execute($sql);	
	
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
			<h2><a href="#"><?=_("Subscribers")?></a> &raquo; <a href="#" class="active"><?=_("Manage tickets")?></a></h2>

			<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="jNice">
			<fieldset>
			<table class="no-arrow rowstyle-alt colstyle-alt paginate-5 max-pages-5">
				<thead>
					<tr>
						<th class="sortable"><b><?=_("VOD Resource")?></b></th>
						<th class="sortable"><b><?=_("Restriction")?></b></th>
						<th ><b><?=_("Ticket Number")?></b></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$counter = 0;
					
					while (!$rsGet->EOF)
					{  
						$counter++;
						?>
						<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td><?=$rsGet->fields['name']?></a></td>
							<td>
								<select name="restriction">
								<?php
								$sql="select * from restrictions";
								$rsGetRestriction=$DB->execute($sql);
								while(!$rsGetRestriction->EOF){
									?>
										<option value="<?=$rsGetRestriction->fields['id']?>"><?=$rsGetRestriction->fields['name']?></option>
									<?
									$rsGetRestriction->movenext();
								}
								?>
								<select>
							</td>
							<td><input name="ticket" type="text" maxlength="10" value="" class="text-medium" readonly="readonly" /></td>
						</tr>
						<?php
						$rsGet->movenext();
					}  
					?>
				</tbody>
			</table>
			</fieldset>
			</form>

			<script type="text/javascript" src="js/tablesort.js"></script>
			<script type="text/javascript" src="js/pagination.js"></script>
			
		</div><!-- // #main -->
    <div class="clear"></div>
    </div><!-- // #container -->
		</div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>