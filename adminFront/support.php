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
			
		<h2><a href="#"><?=_("User Management")?></a> &raquo; <a href="#" class="active"><?=_("Raise a Ticket")?></a></h2>

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
			
			<form action="<?=$currentPage?>" method="post" class="jNice">
				<fieldset>
				<p>
					<label><?=_("Subscriber Name")?></label>
					<input type="text" name="usr_name" value="<?=$_SESSION['name']?>" readonly="readonly" class="text-long" />
				</p>

				<p>
					<label><?=_("Enquiry Type")?> : </label>
					<select name="enquiry_type">
						<option value="I'm feeling lonely"><?=_("I'm feeling lonely")?></option>
						<option value="I'm hungry"><?=_("I'm hungry")?></option>
						<option value="I'm bored"><?=_("I'm bored")?></option>
						<option value="I don't have friends"><?=_("I don't have friends")?></option>
						<option value="I don't know"><?=_("I don't know")?></option>
					</select>
				</p>

				<p>
					<label><?=_("Your enquiry")?> : </label>
					<label><textarea name="enquiry_text" cols="100"><?=$_POST['enquiry_text']?></textarea></label>
				</p>

				<p>
					<label>&nbsp;</label>
					<input type="hidden" value="<?=$_SESSION['id']?>" name="usr_id" />
					<input type="submit" value="<?=_("Update")?>" name="edit" />
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