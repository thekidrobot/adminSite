<?php
	include("connection.php");
	$usr_id = $_POST['usr_id'];
	parse_str($_POST['data']);
	for ($i = 0; $i < count($sortlist); $i++) {
		$str = "delete 	from subscribers_packages
						where 	subscriber_id = $usr_id
						and 		package_id = $sortlist[$i]";
		$rsSet = $DB->execute($str);
		
		//Now, we'll remove all the tickets under the restriction zero for the VOD videos in this package.
		
		$sql = "SELECT DISTINCT
							vc.id
						 FROM
							packages_vodchannels pv,
							subscribers sc,
							subscribers_packages sp,
							vod_channels_categories vcc,
						 
							vodchannels vc,
							tickets tc,
							restrictions rc
						 
						 WHERE
							tc.restriction_id  = rc.id AND
							tc.subscriber_id = sc.id AND 
						
							vc.id = vcc.channel_id AND
							pv.resource_id = vc.id AND
							pv.package_id = sp.package_id AND
							sp.subscriber_id = sc.id AND 
												 
							vc.id = tc.resource_id AND
							tc.restriction_id  = rc.id AND
							tc.subscriber_id = $usr_id AND 
							tc.restriction_id = 0 AND 
							sp.package_id = $sortlist[$i]";
	
		$rsGet = $DB->execute($sql);
		while (!$rsGet->EOF)
		{
			$vid_id = $rsGet->fields['id'];
			
			$sqlSetRestriction = "DELETE FROM
														 tickets
														WHERE
														 subscriber_id = $usr_id AND
														 resource_id = $vid_id AND 
														 restriction_id = 0";
													 
			$rsSetRestriction = $DB->execute($sqlSetRestriction);
			
			$rsGet->movenext();	
		}
	}
	sleep(1);
?>
		
