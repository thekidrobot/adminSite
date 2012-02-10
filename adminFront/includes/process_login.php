<?php 

include('general_functions.php');

foreach($_POST as $key=>$value)
{
 $$key=$value;
}

if(trim($username)!="" and trim($password)!="")
{
  $error = auth_user($username,$password);
}

//user authentication
function auth_user($username,$password)
{
  
  $error = true;
  
	$sql = "SELECT * FROM subscribers where login='".escape_value($username)."'
					AND password='".md5(escape_value($password))."'";
	
	$rsGet=$DB->execute($sql);
	
	if($rsGet->numrows() <= 0)
	{
	 $error = true;
	 $_SESSION['valid'] = 0;
	}
	else
	{
		while(!$rsGet->EOF)
		{
		 //IF YOU NEED DATA FROM THE USER,
		 //PULL IT FROM HERE, DONT PUT CRAP IN THE CODE.
		 //SESSION VARIABLES WERE INVENTED WITH THIS PURPOSE.
		 //$_SESSION['id'] = $rsGet->fields['id'];
		 //$_SESSION['surname'] = $rsGet->fields['surname'];
		 //$_SESSION['other_name'] = $rsGet->fields['other_name'];
		 //$_SESSION['company'] = $rsGet->fields['company'];
		 //$_SESSION['type'] = $rsGet->fields['type'];
		 //$_SESSION['login'] = $rsGet->fields['login'];
		 //$_SESSION['email'] = $rsGet->fields['email'];
		 //$_SESSION['status'] = $rsGet->fields['status'];
		 $_SESSION['valid'] = 1;
		}
    $error = false;
    redirect('text.php');
  }
  return $error;
}

?>
