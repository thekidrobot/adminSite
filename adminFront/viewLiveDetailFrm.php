<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include ("includes/head.php") ?>
<body style="background:none !important">
		<?php
			$id = escape_value($_GET['id']);
			if(trim($id) == "" or !is_numeric($id) or $id == 0)
			{
				redirect("home.php");
			}
			$sql = "SELECT lc.*
							FROM
							 livechannels lc,
							 packages_livechannels pl,
							 subscribers_packages sp
							WHERE
							 lc.id = pl.resource_id AND
							 pl.package_id = sp.package_id AND
							 sp.subscriber_id = ".$_SESSION['id']." AND 
							 lc.id = $id 
							 ORDER BY lc.id DESC";
													
			$getData = $DB->Execute($sql);
		?>
			
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
			<tr>
				<th valign="top"><?=_("Actual Logo")?> : </th>
				<td>
					<?php
						$actual_filename = $getData->fields['small_pic'];
						$thumb = getThumbnail($actual_filename);
					?>
					<img style="margin-top:15px;" src="<?="../data/images/".$thumb?>">
				</td>
			</tr>
				
			<tr>
				<th valign="top"><?=_("Channel Name")?> : </th>
				<td><?=$getData->fields['name']?></td>
			</tr>

			<tr>
				<th valign="top"><?=_("Channel Number")?> : </th>
				<td><?=$getData->fields['number']?></td>
			</tr>

			<tr>
				<th valign="top"><?=_("Channel Description")?> : </th>
				<td><?=$getData->fields['description']?></td>
			</tr>			
			
			<tr>
				<th valign="top"><?=_("Price")?></th>
				<td><?=$getData->fields['price']?></td>
			</tr>


			<tr>
				<th valign="top"><?=_("Currency")?> :</th>
				<td>
				<?php
					$sql="select * from currencies where id = ".$getData->fields['currency'];
					$rsGet=$DB->execute($sql);
					while(!$rsGet->EOF)
					{
						echo $rsGet->fields['code'] ."-". $rsGet->fields['name'];	
						$rsGet->movenext();
					}
					?>
				</td>
			</tr>

			<tr>
				<th valign="top"><?=_("Rating")?> : </th>
					<td>
					<?php
					  $sql="select * from ratings where id = ".$getData->fields['rating'];
					  $rsGet=$DB->execute($sql);
					  while(!$rsGet->EOF){
					   echo $rsGet->fields['code'] ."-". $rsGet->fields['name'];
					   $rsGet->movenext();
						}
					 ?>
					</td>
			</tr>
		</table>

</body>
</html>