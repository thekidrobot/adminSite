<?
include("includes/connection.php");
include("session.php");

//Delete one
if($_GET['del']!="" and is_numeric($_GET['del']))
{
	$query_rsDel = "SELECT * FROM livechannels WHERE id = ".$_GET["del"];
	$rsDel = $DB->Execute($query_rsDel);
  $actual_filename = $rsDel->fields['pic'];
  
  //Borrar archivos existentes
	$gallery_upload_path = "data/images/";

	$actual_filename_thumb = getThumbnail($actual_filename);	

  @unlink($gallery_upload_path.$actual_filename);
  @unlink($gallery_upload_path.$actual_filename_thumb);
  
	$query_rsDel = "DELETE FROM livechannels where id=".$_GET["del"];
	$rsDel = $DB->Execute($query_rsDel);
  
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
  $actual_filename = $rsDel->fields['pic'];
  
  //Borrar archivos existentes
  $gallery_upload_path = "data/images/";

	$actual_filename_thumb = getThumbnail($actual_filename);
	
  @unlink($gallery_upload_path.$actual_filename);
  @unlink($gallery_upload_path.$actual_filename_thumb);
  
  $query_rsDel = "DELETE FROM livechannels WHERE id = $id";
	$rsDel = $DB->Execute($query_rsDel);
	
  redirect($currentPage);
 }
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
		 <h2><a href="#"><?=_("Video on demand")?></a> &raquo; <a href="#" class="active"><?=_("View VOD movies")?></a></h2>
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<table class="no-arrow rowstyle-alt colstyle-alt paginate-10 max-pages-5" >
			 <thead>
				<tr>
				 <th class="sortable-keep fd-column-0"><b><?=_("Edit")?></b></th>
				 <th class="sortable-keep fd-column-0"><b><?=_("Name")?></b></th>
				 <th class="sortable-keep fd-column-1"><b><?=_("Description")?></b></th>
				 <th class="sortable-keep fd-column-2"><b><?=_("Rating")?></b></th>
				 <th align="center" style="padding:5px 0px 5px 0px">
				 <input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
				</th>
			 </tr>
			</thead>
			<tbody>
			 <?php
			 $sql_getData = "SELECT * FROM livechannels ORDER BY id DESC";
			 $rs_getData = $DB->Execute($sql_getData);
			 while (!$rs_getData->EOF)
			 {
				$thumb=getThumbnail($rs_getData->fields['pic']);
				
				?>
				<tr <?php if($counter % 2) echo " class='alt'"?>>
				 <td>
					<a href="editLive.php?id_archivo=<?=$rs_getData->fields['id']; ?>">
					<img src="data/images/<?=$thumb ?>" />
					</a>
				 </td>
				 <td><?=$rs_getData->fields['description']; ?></td>
				 <td><?=$rs_getData->fields['description']; ?></td>
				 <td><?=$rs_getData->fields['rating']; ?></td>
				 <td align="center">
					<input name='archivos[]' type='checkbox' value="<?=$rs_getData->fields['id']?>">
				 </td>
				</tr>
				<?php
				$counter++;
				$rs_getData->MoveNext();
			 }?>
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