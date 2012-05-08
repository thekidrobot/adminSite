<?
include("includes/connection.php");
include("session.php");

//Delete one
if($_GET['del']!="" and is_numeric($_GET['del']))
{
	$query_rsDel = "SELECT * FROM livechannels WHERE id = ".$_GET["del"];
	$rsDel = $DB->Execute($query_rsDel);

	$message = "The user ".$_SESSION['username']." has deleted the channel '".$rsDel->fields['name']."' With ID ".$rsDel->fields['id'];
  
  //Borrar archivos existentes
	$gallery_upload_path = "data/images/";

  @unlink($gallery_upload_path.$rsDel->fields['big_pic']);
  @unlink($gallery_upload_path.$rsDel->fields['small_pic']);
  
	$query_rsDel = "DELETE FROM livechannels where id=".$_GET["del"];
	$rsDel = $DB->Execute($query_rsDel);

	writeToLog($message);
  
  redirect($currentPage);
}

//Delete multiple
$arrArchivos = $_POST['archivos'];
$U = count($arrArchivos);

if($U > 0)
{
 foreach($arrArchivos as $id)
 {
  $query_rsDel = "SELECT * FROM livechannels WHERE id = $id";
	$rsDel = $DB->Execute($query_rsDel);
  
	$message = "The user ".$_SESSION['username']." has deleted the channel '".$rsDel->fields['name']."' With ID ".$rsDel->fields['id'];
		
  //Borrar archivos existentes
  $gallery_upload_path = "data/images/";
	
  @unlink($gallery_upload_path.$rsDel->fields['big_pic']);
  @unlink($gallery_upload_path.$rsDel->fields['small_pic']);
  
  $query_rsDel = "DELETE FROM livechannels WHERE id = $id";
	$rsDel = $DB->Execute($query_rsDel);

	writeToLog($message);
	
  redirect($currentPage);
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
		 <h2><a href="#"><?=_("Live TV")?></a> &raquo; <a href="#" class="active"><?=_("View live channels")?></a></h2>
			
			<div class="album">
			 <table class="gallery paginate-2 max-pages-5">
			 <tr>
			 <?php
			 $sql_getData = "SELECT * FROM livechannels ORDER BY id DESC";
			 $rs_getData = $DB->Execute($sql_getData);
			 
			 $counter = 1;
			 
				while (!$rs_getData->EOF)
				{
					$thumb=getThumbnail($rs_getData->fields['small_pic']);
					
					$sql = "select code from ratings where id = ".$rs_getData->fields['rating'];
					$rsGetRating = $DB->execute($sql);
					
					?>
						<td>
							<div class="imageSingle">
								<div class="image">
									<a href="viewLiveDetail.php?id=<?=$rs_getData->fields['id']; ?>">
									<img src="data/images/<?=$thumb ?>" />
									</a>
								</div>
								<div class="footer">
									<b>Name : </b><?=$rs_getData->fields['name']; ?><br />
									<b>Rating : </b><?=$rsGetRating->fields['code']; ?><br />
									<b>Number : </b><?=$rs_getData->fields['number']; ?></td>
								</div>
							</div>
						<td>
					<?
					if ($counter%4 == 0){
						?>
						</tr>
						<tr>
					<?
					}
					$counter++;
					$rs_getData->MoveNext();
				}?>
				</tr>
			</table>
		</div>
		<script type="text/javascript" src="js/pagination.js"></script>
	 </div><!-- // #main -->
	<div class="clear"></div>
 </div><!-- // #container -->
 </div><!-- // #containerHolder -->
 <p id="footer"></p>
 </div><!-- // #wrapper -->
</body>
</html>