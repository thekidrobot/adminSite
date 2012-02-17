<?php
	include('includes/head.php');
?>
<body> 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    
	<!-- Start: page-top -->
	<?php include('includes/page_top.php'); ?>
	<!-- End: page-top -->
</div>
<!-- End: page-top-outer -->
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
	<!--  start nav-outer -->
	<div class="nav-outer"> 
		<!-- start nav-right -->
		<?php include('includes/nav_right.php');?>
		<!-- end nav-right -->

		<!--  start nav -->
		<?php include('includes/nav.php'); ?>
		<!--  start nav -->
		
	</div>
	<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->
<div class="clear"></div>
 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1><?=_("Support Area")?></h1>
	</div>
	<!-- end page-heading -->

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<h2><?=_("Raise a ticket")?></h2>
			<h3><?=_("Be in touch with us")?></h3>

<?
	
	if($_POST['usr_id'] != "")
	{
		$id = $_POST['usr_id'];
		
		$postArray = &$_POST;
		
		$userid=escape_value($postArray['usr_id']);
		$username=escape_value($postArray['usr_name']);
		$enquiry_type=escape_value($postArray['enquiry_type']);
		$enquiry_text=nl2br(escape_value($postArray['enquiry_text']));
				
		$validator = new FormValidator();
		$validator->addValidation("enquiry_text","req",_("Please let us know your enquiry"));
		$validator->addValidation("enquiry_text","maxlen=500",_("The text should be less than 500 characters"));
		
		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err)
			{
				$err .= $inp_err."</br>";
			}
		}
		else
		{
			$email_admin = "produccionvzdc@gmail.com";
			
			$email_subscriber = $_SESSION['email'];
 
			 $mailcheck1 = spamcheck($email_admin);
			 $mailcheck2 = spamcheck($email_subscriber);
 
			 if ($mailcheck1==FALSE or $mailcheck2==FALSE){
				 $err = "Invalid email format. Please update your data with a valid email";
			 }
			 else
			 {
				
				$enquiry_text = $enquiry_text;
				
				 $sql = "INSERT INTO support_tickets
									(userid,enquiry_type,enquiry_text,
									 date_opened,status)
								 VALUES
									($userid,'$enquiry_type','$enquiry_text',NOW(),0)";
						 
				 $rsSet=$DB->execute($sql);
							
				 if($rsSet){
					 
					 $ticket_number = $DB->Insert_ID();
									 
					 //For the mail
					 $subject = nl2br($enquiry_type);
					
					 $enquiry_text = nl2br($enquiry_text);
		 
					 $msg="<p>$enquiry_text</p>
								 <br />
								 -- <br />
								 Regards,<br />
								 $username
								 <br />Mail: $email_subscriber
								 <br />Ticket Number: $ticket_number";				
				
					 $msg = nl2br($msg);

					 sendemail($email_admin,$subject,$msg);
					 sendemail($email_subscriber,$subject,$msg);

					 $msg = "Your ticket has been created with the number $ticket_number.<br />
									 A mail has been sent to the support team and to your inbox.";
									 
				}
			}			
		}
	}
	
?>
			
			<?
			if(trim($err) != ""){
			?>
				<p>
					<label><?=_("Please correct the following errors: ")?></label>
					<div><?=$err?></div>
				</p>						
			<?
			}
			elseif(trim($msg) != ""){
			?>
				<p>
					<div><?=$msg?></div>
				</p>						
			<?
			}
			?>
			
			<div id="custom_form">
				<form action="<?=$currentPage?>" method="post">
				<table align="left">
				<tr>
					<td><?=_("Subscriber Name")?></td>
					<td><input type="text" name="usr_name" value="<?=$_SESSION['name']?>" readonly="readonly" class="inp-form" /></td>
				</tr>

				<tr>
					<td><?=_("Enquiry Type")?> : </td>
					<td>
						<select name="enquiry_type" class="styledselect_form_1">
							<option value="I'm feeling lonely"><?=_("I'm feeling lonely")?></option>
							<option value="I'm hungry"><?=_("I'm hungry")?></option>
							<option value="I'm bored"><?=_("I'm bored")?></option>
							<option value="I don't have friends"><?=_("I don't have friends")?></option>
							<option value="I don't know"><?=_("I don't know")?></option>
						<select>
					</td>
				</tr>

				<tr>
					<td><?=_("Your enquiry")?> : </td>
					<td><textarea name="enquiry_text" class="form-textarea"><?=$_POST['enquiry_text']?></textarea></td>
				</tr>

				<tr>
					<td>&nbsp;</td>
 					<td>
					<input type="hidden" value="<?=$_SESSION['id']?>" name="usr_id" />
					<input type="submit" value="<?=_("Update")?>" name="edit" class="form-submit" />
					</td>
				</tr> 
				</table>
			</form>
			
			</div>
			
			</div>
			<!--  end table-content  -->
	
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<?php include('includes/footer.php'); ?>
<!-- end footer -->
 
</body>
</html>