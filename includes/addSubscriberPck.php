<?php
	include("connection.php");
	include("general_functions.php");
	$usr_id = $_POST['usr_id'];
	parse_str($_POST['data']);
	for ($i = 0; $i < count($sortlist2); $i++)
	{
		$str = "INSERT 	ignore
						INTO 		subscribers_packages(subscriber_id,package_id)
						VALUES 	($usr_id,$sortlist2[$i])";
		$rsSet = $DB->execute($str);
		
		//Now, we'll query the videos from this package without a ticket
		$sql = "SELECT DISTINCT
						vc.id
					
						FROM
						 packages_vodchannels pv,
						 subscribers sc,
						 subscribers_packages sp,
						 vod_channels_categories vcc,												
						 vodchannels vc
						
						WHERE
						 vc.id = vcc.channel_id AND
						 pv.resource_id = vc.id AND
						 pv.package_id = sp.package_id AND
						 sp.subscriber_id = sc.id AND
						 sp.package_id = ".$sortlist2[$i]." AND 
						 sc.id = $usr_id AND
							(vc.id,sc.id)
							 NOT IN
							(SELECT DISTINCT
								vc.id, $usr_id 
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
								 tc.subscriber_id = $usr_id)";

		$rsGet = $DB->execute($sql);
		while (!$rsGet->EOF)
		{

			//For this videos, we'll create a ticket under the restriction zero
			//[The restriction zero is the default for unlimited access]
			
			$ticket = genRandomString();
			$vid_id = $rsGet->fields['id'];
			
			$sqlSetRestriction = "INSERT into tickets
													(subscriber_id,resource_id,
													 current_views,restriction_id,
													 ticket_number,creation_date,status)
													VALUES
													($usr_id,$vid_id,
													 0,0,
													 '$ticket',NOW(),1)";
													 
			$rsSetRestriction = $DB->execute($sqlSetRestriction);
			
			$rsGet->movenext();	
		}
	}
	
	sleep(1);
?>
		
