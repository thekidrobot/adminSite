<?
	include("includes/connection.php");
	include("session.php");

	//Restricted Page
	if($role == 0) redirect('index.php');
	
	//Delete one
	if($_GET['del']!="")
	{
		$query_rsDel = "SELECT * from administrador where IdAdministrador = ".$_GET["del"];
		$rsDel = $DB->Execute($query_rsDel);
  
		$message = "The user ".$_SESSION['username']." has deleted the admin '".$rsDel->fields['Login']."' With ID ".$rsDel->fields['IdAdministrador'];	
		
		$id = escape_value($_GET['del']);
		$sql = "delete from administrador where IdAdministrador = ".$id;
		$rsSet = $DB->Execute($sql);
		
		writeToLog($message);
	}
	
	//delete selected multiple
	$arrSubscribers = $_POST['subscribers'];
	$N = count($arrSubscribers);
	if($N > 0)
	{
		for($i=0; $i < $N; $i++)
		{
			$query_rsDel = "SELECT * from administrador where IdAdministrador = ".$arrSubscribers[$i];
			$rsDel = $DB->Execute($query_rsDel);
	  
			$message = "The user ".$_SESSION['username']." has deleted the admin '".$rsDel->fields['Login']."' With ID ".$rsDel->fields['IdAdministrador'];	
	
			$sql = "delete from administrador where IdAdministrador = ".$arrSubscribers[$i];
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
			<h2><a href="#"><?=_("Administrators")?></a> &raquo; <a href="#" class="active"><?=_("View administrators")?></a></h2>

			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<table class="no-arrow rowstyle-alt colstyle-alt paginate-10 max-pages-5">
			<thead>
				<tr>
					<th class="sortable"><b><?=_("Login")?></b></th>
					<th class="sortable"><b><?=_("Role")?></b></th>
					<th style="text-align:center">
						<input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$counter = 0;
					
					$sql = "SELECT * FROM administrador";
					$rsGet = $DB->Execute($sql);
					
					while (!$rsGet->EOF)
					{  
						$counter++;
						
						$id = $rsGet->fields['IdAdministrador'];
						$login = $rsGet->fields['Login'];
						$role = $rsGet->fields['Rol'];
						
						$sqlRoleName = "SELECT * FROM roles WHERE id = $role";
						$rsGetRoleName = $DB->execute($sqlRoleName);
						$roleName = $rsGetRoleName->fields['name'];
						
						?>
						<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td><a href="viewAdminDetail.php?usr_id=<?=$id?>"><?=$login?></a></td>
							<td><?=$roleName?></td>
							<td align="center">
								<input name='subscribers[]' type='checkbox' value="<?=$id?>" <? if ($id == $_SESSION['id']) echo "disabled='disabled'"; ?> ></td>
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