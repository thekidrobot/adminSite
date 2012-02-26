  <?php
	$postArray = &$_POST ;
	$email = escape_value($postArray['email']);
	if(isset($_POST['Submit']))
  {// The form is submitted
		//Setup Validations
		$validator = new FormValidator();
		$validator->addValidation("email","email","The input for Email should be a valid email value");
            
    //Now, validate the form
    if($validator->ValidateForm())
    { 
			$password = genRandomString();
      
			$password_enc = md5($password);
              
      $query="UPDATE contact set password = '$password_enc' where email = '$email'";
      $r= mysql_query($query)or die("Error : ".mysql_error());
              
      if (mysql_affected_rows() > 0)
			{
              
				$id =mysql_insert_id();
				
				echo "<p><h2>Password request sent.</h2>";
				echo "A change password request was sent to $email</p>
							<br /><br />
							<a href = 'index.php'>Go to the home page</a>
							<br /><br />";
									 
				$query = mysql_query("SELECT firstname, middlename from contact where email = '$email'"); 
									
				while ($row = mysql_fetch_object($query))
				{
					$fname = $row->firstname;
					$lname = $row->middlename;                      
				}
				
				//For the mail
				$subject = "Welcome to ITL!";
		
				$msg="<p>Dear ".$fname." ".$lname.",<br />
							<br />
							<p><h2>Password change request.</h2>
							As per your password reset request, your new pasword is:
							$password. <br /><br />Note that the letters in the password are case sensitive. <br /> <br />
							-- <br/> Thanks,<br />
							The ITL Team</p>";
  
        sendemail($email,$subject,$msg);
      }
      else
			{
				echo "<br /><br />Invalid Input.<br />
							<a href = 'index.php'>Go to the home page</a>
							<br /><br />";
      }
    
		}
    else
    {
			echo "<p><h2>Please Complete the following:</h2>";
    
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err)
			{
					echo "$inp_err<br/>\n";
			}
			echo "</p>";
    }//else
  }//if(isset($_POST['Submit']))
	?>