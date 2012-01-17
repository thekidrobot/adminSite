<?
	include("includes/connection.php");
	include("session.php");

	$id = $_REQUEST['usr_id'];
	
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
	
	$sql = "select name from subscribers where id = $id";
	$rsGetName = $DB->execute($sql);

	
	if($_POST['save_tkt'] == 1)
	{
		$usr_id = escape_value($_POST['usr_id']);
		$vid_id = escape_value($_POST['vid_id']);
		$role_id = escape_value($_POST['restriction']);
		$ticket = genRandomString();
		
		$sql = "INSERT into tickets
						(subscriber_id,resource_id,restriction_id,
						ticket_number,creation_date,status)
						VALUES ($usr_id,$vid_id,$role_id,
						'$ticket',NOW(),1)";
	
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
			<h2><a href="#"><?=_("Subscribers")?></a> &raquo; <a href="#" class="active"><?=_("Manage tickets of ").$rsGetName->fields['name']; ?></a></h2>

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
						$vid_id = $rsGet->fields['id'];
						
						$sql ="select * from tickets
									 where subscriber_id = $id
									 and resource_id = ".$rsGet->fields['id'];
						
						$rsGetTicket = $DB->execute($sql);
						
						?>
						<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="jNice" onsubmit="return confirm('<?=_("Are you sure do you want to generate the ticket? This cannot be undone.")?>')">
						<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td><?=$rsGet->fields['name']?></a></td>
							<td>
								<select name="restriction">
								<?php
								$sql="select * from restrictions";
								$rsGetRestriction=$DB->execute($sql);
								while(!$rsGetRestriction->EOF){
									?>
										<option value="<?=$rsGetRestriction->fields['id']?>" <? if($rsGetRestriction->fields['id']==$rsGetTicket->fields['restriction_id']) echo "selected='selected'" ?>><?=$rsGetRestriction->fields['name']?></option>
									<?
									$rsGetRestriction->movenext();
								}
								?>
								<select>
							</td>
							<td>
								<input name="usr_id" type="hidden" value="<?=$id?>" />
								<input name="vid_id" type="hidden" value="<?=$vid_id?>" />
								<input name="save_tkt" type="hidden" value="1" />								
								<input name="ticket" type="text" maxlength="10" value="<?=$rsGetTicket->fields['ticket_number']?>" class="text-medium" readonly="readonly" />
								<?php if(trim($rsGetTicket->fields['ticket_number']) == ""){
									?>
									<input type="submit" value="" class="button-save" />
									<?
								}
								?>
							</td>
						</tr>
						</form>
						<?php
						$rsGet->movenext();
					}  
					?>
				</tbody>
			</table>

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