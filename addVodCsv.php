<?php

include("includes/connection.php");
include("session.php");

$csvName = "vodTemplate.csv";

if($_POST['setCsv'] == 1)
{
	$allowed_extensions = array("csv");	
	$max_allowed_file_size = 2048; // size in KB
  		  
  //File validation
	//Get the name
  $filename = basename($_FILES['grid']['name']);
  
	if(trim($filename) == "")
  {
    $msg .= "\n Please upload a CSV file.\n <br />";
  }
  
	//get the extension
  $filetype = substr($filename,strrpos($filename,'.') + 1);
  //Get the size in KBs
  $filesize = $_FILES["grid"]["size"]/1024;

  //Validate Size
  if($filesize > $max_allowed_file_size )
  {
    $msg.= "\n The size of the CSV file should be less than $max_allowed_file_size/1024 MB\n <br />";
  }
    		 
  //Validate Extension
  $allowed_ext = false;
  
  for($i=0; $i<sizeof($allowed_extensions); $i++)
  {
    if(strcasecmp($allowed_extensions[$i],$filetype) == 0)
    {
      $allowed_ext = true;
    }
  }
   
  if(!$allowed_ext)
  {
    $msg.=  "\n The uploaded file don't have a supported file type. Only the following file types are supported: <b>".implode(',',$allowed_extensions)."</b>\n <br />";
  }

  if(trim($msg) == '')
  {
		if ($_FILES["grid"]["error"] > 0)
		{
			$msg="Return Code: " . $_FILES["grid"]["error"] . "<br />";
		}
		else
		{
      $path_csv = implode("/", (explode('/', $_SERVER["SCRIPT_FILENAME"], -1)));

			$filepath = $path_csv.'/'."gridLive.csv";
			
			if (file_exists($filepath))
			{
				unlink($filepath);
			}
			
			$tmp_path = $_FILES["grid"]["tmp_name"];
			if(!move_uploaded_file($tmp_path,$filepath))
			{
				$msg.= "Error uploading file: " . $_FILES["grid"]["error"] . "<br />";
			}
			else
			{
        if (($handle = fopen($filepath, "r")) !== FALSE)
        {
          $insert_query_prefix = "INSERT INTO vodchannels
																	(big_pic,small_pic,name,description,stb_url,download_url,
																	pc_url,local_url,trainer,date_release,keywords,
																	rating,price,currency)\nVALUES";
					
          while (($data = fgetcsv($handle, $max_line_length, ";","'")) !== FALSE)
          {
            while (count($data)<count($columns)) array_push($data, NULL);
            $query = "$insert_query_prefix ('','','".join("','",$data)."','',NOW(),'',1,0,1);";
            $rsSet = $DB->execute($query);

            $msg = "File processed sucessfully";
          }
					
					$message = "The user ".$_SESSION['username']." has uploaded a new .csv file for VOD Channels.";
					writeToLog($message);
					
          fclose($handle);
        }
  		}
		}   
  }  
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include ("includes/head.php") ?>
	<body>
		<div id="wrapper">
		<h1><a href="#">&nbsp;</a></h1>
		<?php include("includes/mainnav.php") ?>
		<!-- // #end mainNav -->
		<div id="containerHolder">
			<div id="container">
				<div id="sidebar">
				 <?php include("includes/sidenav.php") ?>
				</div>    
				<!-- // #sidebar -->
		
				<div id="main">
					<h2><a href="#"><?=_("Video on demand")?></a> &raquo; <a href="#" class="active"><?=_("Import VOD Grid")?></a></h2>
					<form method="post" action="<?=$currentPage?>" class="jNice" enctype="multipart/form-data">
						<fieldset>
						<?php
						if($msg!="")
						{
							?>
							<p>
								<label><?=_("Message")?></label>
								<?=$msg?>
							</p>							
							<?
						}
						?>	
						<p>
							<label><?=_("Download the CSV Template")?></label>
							<b><a href="<?=$csvName?>"><?=_("Download")?></a></b>
						</p>
						<p>
							<label><?=_("Import CSV File")?></label>
							<input type="file" name="grid" readonly="readonly" />
						</p>
						<p>
							<label>&nbsp;</label>
							<input type="hidden" name="setCsv" value="1" />
							<input name="import" type="submit" value="<?=_("Import")?>" />
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