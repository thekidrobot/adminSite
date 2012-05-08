<?
	include("includes/connection.php");
	include("session.php");
	
	//Delete one
	if($_GET['del']!="")
	{
		$query_rsDel = "SELECT * FROM restrictions WHERE id = ".$_GET["del"];
		$rsDel = $DB->Execute($query_rsDel);
		
		$message = "The user ".$_SESSION['username']." has deleted the restriction '".$rsDel->fields['name']."' With ID ".$rsDel->fields['id'];
		
		$id = escape_value($_GET['del']);
		$sql = "delete from restrictions where id = $id and id
						not in(select distinct restriction_id from tickets)";
		$rsSet = $DB->Execute($sql);
		
		writeToLog($message);
	}
	
	//delete selected multiple
	$arrRules = $_POST['rules'];
	$N = count($arrRules);
	if($N > 0)
	{
		for($i=0; $i < $N; $i++)
		{
			$query_rsDel = "SELECT * FROM restrictions WHERE id = ".$arrRules[$i];
			$rsDel = $DB->Execute($query_rsDel);
			
			$message = "The user ".$_SESSION['username']." has deleted the restriction '".$rsDel->fields['name']."' With ID ".$rsDel->fields['id'];	
			
			$sql = "delete from restrictions where id = ".$arrRules[$i]." and id
							not in(select distinct restriction_id from tickets)";
			$rsSet = $DB->Execute($sql);
			
			writeToLog($message);	
		} 
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
			<h2><a href="#"><?=_("Restrictions")?></a> &raquo; <a href="#" class="active"><?=_("View restriction rules")?></a></h2>

			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<table class="no-arrow rowstyle-alt colstyle-alt paginate-10 max-pages-5">
			<thead>
				<tr>
					<th class="sortable"><b><?=_("Name")?></b></th>
					<th class="sortable"><b><?=_("Duration (in days)")?></b></th>
					<th class="sortable"><b><?=_("Max Views")?></b></th>
					<th style="text-align:center">
						<input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$counter = 0;
					
					$sql = "SELECT * FROM restrictions";
					$rsGet = $DB->Execute($sql);
					
					while (!$rsGet->EOF)
					{  
						$counter++;
						
						$cntRestrictions = 0;
						$readonly = "";
						$sql= "select restriction_id from tickets where restriction_id = ".$rsGet->fields['id'];
						$rsGetRestrictions = $DB->execute($sql);
						$cntRestrictions = $rsGetRestrictions->RecordCount();
						if($cntRestrictions > 0){
							$readonly = "disabled='disabled'";
						}
						?>
						<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td><a href="viewRestrictionDetail.php?id=<?=$rsGet->fields['id']?>"><?=$rsGet->fields['name']?></a></td>
							<td><?=$rsGet->fields['duration']?></td>
							<td><?=$rsGet->fields['max_views']?></td>
							<td align="center"><input name='rules[]' type='checkbox' value="<?=$rsGet->fields['id']?>" <?=$readonly?>></td>
						</tr>
						<?php
						$rsGet->movenext();
					}  
					?>
			</tbody>
			</table>
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