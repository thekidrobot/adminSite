<?
include("Connections/cnxRamp.php");
include("session.php");

$query_rsArchivos = "SELECT * FROM archivos ORDER BY id_archivo DESC";
$rsArchivos = mysql_query($query_rsArchivos) or die(mysql_error($rsArchivos));
$row_rsArchivos = mysql_fetch_assoc($rsArchivos);

//Delete one
if($_GET["del"]!="" and is_numeric($_GET["del"]))
{
  $query_rsArchivo = "SELECT * FROM archivos WHERE id_archivo = ".$_GET["del"];
  $rsArchivo = mysql_query($query_rsArchivo) or die(mysql_error());
  $row_rsArchivo = mysql_fetch_assoc($rsArchivo);
  $totalRows_rsArchivo = mysql_num_rows($rsArchivo);
  
  //Borrar archivos existentes
  $gallery_upload_path = "../data/images/";
  
  $actual_filename = $row_rsArchivo['imagen'];
  $file_ext = substr($actual_filename, strrpos($actual_filename, '.') + 1);	
  //remove the ext
  $filename_strip= substr($actual_filename,0,strrpos($actual_filename, '.'));	
  //remove the _big
  $filename_strip= substr($actual_filename,0,strrpos($actual_filename, '_big'));
  //add the _small
  $filename_strip= $filename_strip."_small";	
  
  $actual_filename_thumb = $filename_strip.".".$file_ext;

  @unlink($gallery_upload_path.$actual_filename);
  @unlink($gallery_upload_path.$actual_filename_thumb);
  
  
  $sql = "DELETE FROM archivos where id_archivo=".$_GET["del"];
  mysql_query($sql);
  if (!headers_sent()) header('Location: '.$currentPage);
  else echo '<meta http-equiv="refresh" content="0;url='.$currentPage.'" />';
}

//Delete multiple
$arrArchivos = $_POST['archivos'];

$U = count($arrArchivos);
if($U > 0)
{
 foreach($arrArchivos as $id)
 {
  $query_rsArchivo = "SELECT * FROM archivos WHERE id_archivo = $id";
  $rsArchivo = mysql_query($query_rsArchivo) or die(mysql_error());
  $row_rsArchivo = mysql_fetch_assoc($rsArchivo);
  $totalRows_rsArchivo = mysql_num_rows($rsArchivo);
  
  //Borrar archivos existentes
  $gallery_upload_path = "../data/images/";
  
  $actual_filename = $row_rsArchivo['imagen'];
  $file_ext = substr($actual_filename, strrpos($actual_filename, '.') + 1);	
  //remove the ext
  $filename_strip= substr($actual_filename,0,strrpos($actual_filename, '.'));	
  //remove the _big
  $filename_strip= substr($actual_filename,0,strrpos($actual_filename, '_big'));
  //add the _small
  $filename_strip= $filename_strip."_small";	
  
  $actual_filename_thumb = $filename_strip.".".$file_ext;

  @unlink($gallery_upload_path.$actual_filename);
  @unlink($gallery_upload_path.$actual_filename_thumb);
  
  $sql = "DELETE FROM archivos where id_archivo=$id";
  mysql_query($sql);
  if (!headers_sent()) header('Location: '.$currentPage);
  else echo '<meta http-equiv="refresh" content="0;url='.$currentPage.'" />';
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
		<!-- h2 stays for breadcrumbs -->
		<!--<h2><a href="#">Dashboard</a> &raquo; <a href="#" class="active">Print resources</a></h2>
		<h2>&nbsp;</h2>-->
    
		<div id="main">
	
				<h2><?=_("View Files")?></h2>
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<table class="no-arrow rowstyle-alt colstyle-alt paginate-10 max-pages-5" >
						<thead>
							<tr>
								<th class="sortable-keep fd-column-0"><b><?=_("Edit")?></b></th>
								<th class="sortable-keep fd-column-1"><b><?=_("Description")?></b></th>
								<th class="sortable-keep fd-column-2"><b><?=_("Trainer")?></b></th>
								<th class="sortable-keep fd-column-3"><b><?=_("Subject")?></b></th>
								<th class="sortable-keep fd-column-4"><b><?=_("Release date")?></b></th>
								<th align="center" style="padding:5px 0px 5px 0px">
									<input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
								</th>
								<!--<th><b><?=_("Delete")?></b></th>-->
							</tr>
						</thead>
						<tbody>
						<?php
							$counter = 0;
							do
							{
							?>
							<tr <?php if($counter % 2) echo " class='alt'"?>>
								<td>
									<a href="edicion.php?id_archivo=<?php echo $row_rsArchivos['id_archivo']; ?>">
									<?=$row_rsArchivos['titulo']; ?>
									</a>
								</td>
								<td><a href="editImagen.php?arch=<?=$row_rsArchivos['id_archivo']; ?>"></a> <?=$row_rsArchivos['texto']; ?></td>
								<td><?=$row_rsArchivos['speaker']; ?></td>
								<td><?=$row_rsArchivos['tema']; ?></td>
								<td><?=$row_rsArchivos['fechaLanzamiento']; ?></td>
								<td align="center">
									<input name='archivos[]' type='checkbox' value="<?=$row_rsArchivos['id_archivo']?>">
								</td>
								<!--<td class="action"><a href="<?=$_SERVER['PHP_SELF']; ?>?del=<?=$row_rsArchivos['id_archivo']?>" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')"><?=_("Delete")?></a></td>-->
							</tr>
							<?php
								$counter++;
							}
							while ($row_rsArchivos = mysql_fetch_assoc($rsArchivos)); ?>
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