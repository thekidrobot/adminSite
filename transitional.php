<?
include("Connections/cnxRamp.php");
include("session.php");

$currentPage = $_SERVER["PHP_SELF"];
$strBusca = $_POST['strBusca'];
$condicion = $_POST['condicion'];
$whereCondicion="";

if($_POST['strBusca']!= "")
{
	switch ($condicion)
	{
		case "nombreArchivo":
		
			if($whereCondicion != "") $whereCondicion = " and ";
			$whereCondicion .= " archivos.nombreArchivo LIKE '%" . $strBusca . "%' ";
			break;
		
		case "tituloArchivo":
			if($whereCondicion != "") $whereCondicion .= " and ";
			$whereCondicion .= " archivos.titulo LIKE '%" . $strBusca . "%' ";
			break;
		
		case "temaArchivo":
			if($whereCondicion != "") $whereCondicion .= " and ";
			$whereCondicion .= " archivos.tema LIKE '%" . $strBusca . "%' ";
			break;
		
		case "fechaArchivo":
			if($whereCondicion != "") $whereCondicion .= " and ";
			$whereCondicion .= " archivos.fechaLanzamiento LIKE '%" . $strBusca . "%' ";
			break;	
	}
}

if($whereCondicion != "")	$whereCondicion = " where " . $whereCondicion;	

$maxRows_rsConsulta1 = 10;
$pageNum_rsConsulta1 = 0;
if (isset($_GET['pageNum_rsConsulta1'])) {
  $pageNum_rsConsulta1 = $_GET['pageNum_rsConsulta1'];
}
$startRow_rsConsulta1 = $pageNum_rsConsulta1 * $maxRows_rsConsulta1;

$query_rsConsulta1 = "SELECT * FROM archivos "  . $whereCondicion;
$query_limit_rsConsulta1 = sprintf("%s LIMIT %d, %d", $query_rsConsulta1, $startRow_rsConsulta1, $maxRows_rsConsulta1);
$rsConsulta1 = mysql_query($query_limit_rsConsulta1, $cnxRamp) or die(mysql_error());
$row_rsConsulta1 = mysql_fetch_assoc($rsConsulta1);

if (isset($_GET['totalRows_rsConsulta1'])) {
  $totalRows_rsConsulta1 = $_GET['totalRows_rsConsulta1'];
} else {
  $all_rsConsulta1 = mysql_query($query_rsConsulta1);
  $totalRows_rsConsulta1 = mysql_num_rows($all_rsConsulta1);
}
$totalPages_rsConsulta1 = ceil($totalRows_rsConsulta1/$maxRows_rsConsulta1)-1;

$queryString_rsConsulta1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsConsulta1") == false && 
        stristr($param, "totalRows_rsConsulta1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsConsulta1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsConsulta1 = sprintf("&totalRows_rsConsulta1=%d%s", $totalRows_rsConsulta1, $queryString_rsConsulta1);
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
		 <div id="wrapper">
	
				<h2><?=_("Find files")?></h2>
				<form method="post" action="<?=$currentPage?>" class="jNice">
					<fieldset>
					<p>
						<label><?=_("Select a search criteria")?></label>
						<input type="text" name="strBusca" value="<?=$strBusca ?>" class="text-long">
						<select name="condicion">
							<option value="nombreArchivo" <?php if ($condicion == "nombreArchivo") echo "selected='selected'" ?>><?=_("Filename")?></option>
							<option value="tituloArchivo" <?php if ($condicion == "tituloArchivo") echo "selected='selected'" ?>><?=_("Title")?></option>
							<option value="temaArchivo" <?php if ($condicion == "temaArchivo") echo "selected='selected'" ?>><?=_("Subject")?></option>
							<option value="fechaArchivo" <?php if ($condicion == "fechaArchivo") echo "selected='selected'" ?>><?=_("Release date")?></option>
						</select>
					</p>
					<input name="buscar" type="submit" value="<?=_("Find")?>" />
					</fieldset>
				</form>
				
				<table class="no-arrow rowstyle-alt colstyle-alt paginate-15 max-pages-5" >
					<thead>
						<tr>
						<th class="sortable-keep fd-column-0"><b><?=_("Title / Name")?></b></th>
						<th class="sortable-keep fd-column-1"><b><?=_("Trainer")?></b></th>
						<th class="sortable-keep fd-column-2"><b><?=_("Subject")?></b></th>
						<th class="sortable-keep fd-column-3"><b><?=_("Release Date")?></b></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$counter = 0;
					do
					{
						?>
						<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td>
								<a href="edicion.php?id_archivo=<?php echo $row_rsConsulta1['id_archivo']; ?>">
								<?php echo $row_rsConsulta1['titulo']; ?></a>
							</td>
							<td><?php echo $row_rsConsulta1['speaker']; ?></td>
							<td><?php echo $row_rsConsulta1['tema']; ?></td>
							<td><?php echo $row_rsConsulta1['fechaLanzamiento']; ?></td>
						</tr>
						<?php
						$counter++;
					}
					while ($row_rsConsulta1 = mysql_fetch_assoc($rsConsulta1)); ?>
					<?
						if(mysql_num_rows($rsConsulta1) == 0){
						?>
						<tr align="center">
							<td colspan="4"><?=_("No records found")?></td>
						</tr>
						<?
					}
					?>
					</tbody>
				</table>
				<script type="text/javascript" src="js/tablesort.js"></script>
				<script type="text/javascript" src="js/pagination.js"></script>

				</div>
			 </div><!-- // #main -->
      <div class="clear"></div>
      </div><!-- // #container -->
    </div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>