<?
include("includes/connection.php");
include("session.php");

$id = $_GET['id'];
$sql = "SELECT * FROM vodchannels WHERE id = $id";
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
			<h2><a href="#"><?=_("Video on demand")?></a> &raquo; <a href="#" class="active"><?=_("View VOD movie details")?></a></h2>
			<form method="post" enctype="multipart/form-data" action="<?php echo $currentPage; ?>" class="jNice">
				<fieldset>
					<p>
						<label><?=_("Actual Logo")?> : </label>
						<?php
						
							$actual_filename = $rsGet->fields['pic'];
							$actual_filename_thumb = getThumbnail($actual_filename);
													
							if(trim($actual_filename_thumb == "_small.")){
								$actual_filename_thumb = "default.jpg";
							}
						?>
						<img src="<?="data/images/".$actual_filename_thumb?>">
					</p>
					<p>
						<label><?=_("Movie Name")?> : </label>
						<input name="name" type="text" value="<?=$rsGet->fields['name']?>" class="text-long" readonly="readonly" />
					</p>
					<p>
						<label><?=_("Movie Description")?> : </label>
						<label><textarea name="description" cols="100" readonly="readonly" /><?=$rsGet->fields['description']?></textarea></label>
					</p>

					<p>
						<label><?=_("Movie STB URL")?> : </label>
						<input name="stb_url" type="text" value="<?=$rsGet->fields['stb_url']?>" class="text-long" readonly="readonly" />
					</p>
					
					<p>
						<label><?=_("Movie Download URL")?> : </label>
						<input name="download_url" type="text" value="<?=$rsGet->fields['download_url']?>" class="text-long" readonly="readonly" />
					</p>
										
					<p>
						<label><?=_("Movie PC URL")?> : </label>
						<input name="pc_url" type="text" value="<?=$rsGet->fields['pc_url']?>" class="text-long" readonly="readonly" />
					</p>
					<p>
						<label><?=_("Movie Director / Trainer")?> : </label>
						<input name="trainer" type="text" value="<?=$rsGet->fields['trainer']?>" class="text-long" readonly="readonly" />
					</p>
					<p>
						<label><?=_("Release Date")?> : </label>
						<input type="text" name="date_release" value="<?=$rsGet->fields['date_release']?>" class="text-medium" readonly="readonly" />
					</p>
					<p>
						<label><?=_("Keywords (Comma Separated)")?> : </label>
						<input name="keywords" type="text" value="<?=$rsGet->fields['keywords']?>" class="text-long" readonly="readonly" />
					</p>
					<p>
						<label><?=_("Price")?> : </label>
						<input name="price" type="text" maxlength="150" value="<?=$rsGet->fields['price']?>" class="text-small" readonly="readonly" />
					</p>
					<p>
						<label><?=_("Currency")?> : </label>
						<select name="currency" readonly="readonly">
							<?php
								$sql="select * from currencies where id = ".$rsGet->fields['currency'];
								$rsGetCurrencies=$DB->execute($sql);
								while(!$rsGetCurrencies->EOF){
									?>
										<option value="<?=$rsGetCurrencies->fields['id']?>"><?=$rsGetCurrencies->fields['code']."-".$rsGetCurrencies->fields['name']?></option>
									<?
									$rsGetCurrencies->movenext();
								}
							?>
						<select>
					</p>
					<p>
						<label><?=_("Rating")?> : </label>
						<select name="rating" readonly="readonly">
							<?php
								$sql="select * from ratings where id = ".$rsGet->fields['rating'];
								$rsGetRating=$DB->execute($sql);
								while(!$rsGetRating->EOF){
									?>
										<option value="<?=$rsGetRating->fields['id']?>"><?=$rsGetRating->fields['code']."-".$rsGetRating->fields['name']?></option>
									<?
									$rsGetRating->movenext();
								}
							?>
						<select>
						<p>
							<label>&nbsp;</label>
							<a href="editVod.php?edit=<?=$id?>"><input type="button" class="button-submit" value="<?=_("Click to edit")?>" /></a>
						</p>
				</fieldset>
			</form>	
		 
			 </div><!-- // #main -->
      <div class="clear"></div>
      </div><!-- // #container -->
    </div><!-- // #containerHolder -->
    <p id="footer"></p>
  </div><!-- // #wrapper -->
</body>
</html>