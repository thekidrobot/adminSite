<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include ("includes/head.php") ?>
<body style="background:none !important">
			<table class="no-arrow rowstyle-alt colstyle-alt paginate-20 max-pages-3">
			<thead>
				<tr>
					<th class="sortable"><b><?=_("Channel name")?></b></th>
					<th class="sortable"><b><?=_("Grid name")?></b></th>
					<th class="sortable"><b><?=_("Description")?></b></th>
					<th class="sortable"><b><?=_("Rating")?></b></th>
					<th class="sortable"><b><?=_("Start Date")?></b></th>
					<th class="sortable"><b><?=_("Start Time")?></b></th>
					<th class="sortable"><b><?=_("End Date")?></b></th>
					<th class="sortable"><b><?=_("End Time")?></b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					
					$id = escape_value($_GET['id']);
					if(trim($id) == "" or !is_numeric($id) or $id == 0)
					{
						redirect("home.php");
					}
				
					$counter = 0;
					
					$sql = "SELECT DISTINCT gl.*
									FROM
									 grid_live gl,
									 livechannels lc,
									 packages_livechannels pl,
									 subscribers_packages sp
									WHERE
									 gl.channel_id = lc.id AND
									 lc.id = pl.resource_id AND
									 pl.package_id = sp.package_id AND
									 sp.subscriber_id = ".$_SESSION['id']." AND 
									 gl.channel_id = $id";
									 
					$rsGet = $DB->Execute($sql);
					
					while (!$rsGet->EOF)
					{
						$sql = "select name from livechannels where id = ".$rsGet->fields['channel_id'];
						$rsGetChannel = $DB->execute($sql);

						$sql = "select code from ratings where id = ".$rsGet->fields['rating'];
						$rsGetRating = $DB->execute($sql);
						
						$counter++;
						?>
						<tr <?php if($counter % 2) echo " class='odd'"?>>
							<td><b><?=$rsGetChannel->fields['name']?></b></td>
							<td><?=$rsGet->fields['grid_name']?></td>
							<td><?=$rsGet->fields['grid_description']?></td>
							<td><?=$rsGetRating->fields['code']?></td>
							<td><?=$rsGet->fields['start_date']?></td>
							<td><?=$rsGet->fields['start_time']?></td>
							<td><?=$rsGet->fields['end_date']?></td>
							<td><?=$rsGet->fields['end_time']?></td>
						</tr>
						<?php
						$rsGet->movenext();
					}  
					?>
			</tbody>
			</table>
</body>
</html>