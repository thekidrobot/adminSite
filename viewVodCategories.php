<?
 include("includes/connection.php");
 include("session.php");

 //Delete multiple
 $arrArchivos = $_POST['archivos'];
 
 $U = count($arrArchivos);
 if($U > 0)
 {
	foreach($arrArchivos as $id)
	{
		 $sql = "SELECT * from vodcategories where id = $id";
		 $rsGet = $DB->execute($sql);

		 $message = "The user ".$_SESSION['username']." has deleted the category '".$rsGet->fields['name']."' With ID ".$id;
	 
		 //Borra de tabla hija
		 $str = "delete from vod_channels_categories where category_id = $id";
		 $strSet = $DB->execute($str);
		 //Borra de tabla padre
		 $str = "delete from vodcategories where id = $id";
		 $strSet = $DB->execute($str);

		 writeToLog($message);
		 
		 redirect($currentPage);
	}
 } 

 if (trim($_GET['del']) != "")
 {
	$id = $_GET['del'];
	
	$sql = "SELECT * from vodcategories where id = $id";
	$rsGet = $DB->execute($sql);

	$message = "The user ".$_SESSION['username']." has deleted the category '".$rsGet->fields['name']."' With ID ".$id;
	
	//Borra de tabla hija
	$str = "delete from vod_channels_categories where category_id = $id";
	$strSet = $DB->execute($str);
	//Borra de tabla padre
	$str = "delete from vodcategories where id = $id";
	$strSet = $DB->execute($str);

	writeToLog($message);
	
	redirect($currentPage);
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

		<div id="main">

			<h2><a href="#">VOD Categories</a> &raquo; <a href="#" class="active">View VOD categories</a></h2>
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">		
				<table class="no-arrow rowstyle-alt colstyle-alt paginate-10 max-pages-5">
				<thead>
				<tr>
					<th class="sortable"><b><?=_("Name / View Details")?></b></th>
					<th><b><?=_("Add Content")?></b></th>
					<th style="text-align:center">
						<input class="button-submit" type="submit" value="<?=_("Delete Selected")?>" name="borrar" onclick="return confirm('<?=_("Are you sure do you want to delete?")?>')" />
					</th>
				</tr>
			</thead>
			<tbody>	
				<?php
				$counter = 0;
				$sql = "SELECT * FROM vodcategories order by id";
				$rsGet = $DB->execute($sql);
				
				while (!$rsGet->EOF)
				{  
					$counter++;
					$id = $rsGet->fields['id'];
					$name = $rsGet->fields['name'];
					?>
					<tr <?php if($counter % 2) echo " class='alt'"?>>
						<td><a href="viewVodDetail.php?cat_id=<?=$id?>" ><?=ucfirst(strtolower($name))?></a></td>
						<td><a href="addVodContent.php?cat_id=<?=$id?>" >Add Content</a></td>
						<td align="center"><input name='archivos[]' type='checkbox' value="<?=$id?>"></td>
					</tr>
					<?php;
					$rsGet->movenext();
				}  
				?>
				</tbody>
			</table>
		</form>
	 	
		</div><!-- // #main -->
    <div class="clear"></div>
    </div><!-- // #container -->
		</div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
	<script type="text/javascript" src="js/tablesort.js"></script>
	<script type="text/javascript" src="js/pagination.js"></script>	
</body>
</html>