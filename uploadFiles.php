<?
include("includes/connection.php");
include("session.php");

$large_image_location = "resources/";
$gallery_upload_path = "resources/";

if (isset($_POST["upload"]))
{
 $IdVideo = $_POST['VideoId'];
 
 $extensionesPermitidas = array("pdf","doc","docx","xls","xslx", 
                                "ppt","pptx","rtf","avi","mp3",
                                "wmv","mov","jpg","jpeg","gif","png"); 
 
 //Get the file information & loop
 for($i=0;$i<count($_FILES['image']['name']);$i++)
 {
  $userfile_name = $_FILES['image']['name'][$i];
  $userfile_tmp = $_FILES['image']['tmp_name'][$i];
  $userfile_size = $_FILES['image']['size'][$i];
  $filename = basename($_FILES['image']['name'][$i]);

  $file_ext = substr($filename, strrpos($filename, '.') + 1);	
  //Remove the Extension
  $filename_strip= substr($filename,0,strrpos($filename, '.'));	
  
  if((!empty($_FILES["image"]['name'][$i])) && ($_FILES['image']['error'][$i] == 0))
  {
   if (!in_array($file_ext,$extensionesPermitidas)) 
   {
    $error= _("File extension not allowed. You can upload images, MSOffice, PDF and MP3 files.");
   }
   else
   {
    //Everything is ok, so we can upload the file.
    if (strlen($error)==0)
    {
     if (isset($_FILES['image']['name'][$i]))
     {
      //check if image exists
      if(is_file($gallery_upload_path.$userfile_name))
      {
       while (file_exists($gallery_upload_path .$filename_strip.".".$file_ext))
       {
        $filename_strip .= rand(10, 99);
       }
      }
      $filename=$filename_strip.".".$file_ext;
      $large_image_location=$gallery_upload_path .$filename;
      if (move_uploaded_file($userfile_tmp, $large_image_location))
      {
       @chmod($large_image_location, 0777);
       $sql="insert into vodchannels_resources (channel_id,resource_path) values($IdVideo,'$filename')";
       $setData = $DB->Execute($sql); 
      }      
     } //for loop
     $msg = _("Files uploaded sucessfully.");
     redirect($_SERVER['PHP_SELF']."?id=".$IdVideo);
    }    
   }
  } 
 }
}
elseif($_POST['delete'] == "delete"){
 $sql = "SELECT * from vodchannels_resources where id =".escape_value($_POST['resource_id']);
 $rsGet = $DB->Execute($sql);
  while(!$rsGet->EOF){
    $resource_id = $rsGet->fields['id'];
    $resource_path = $rsGet->fields['resource_path'];
    $rsGet->movenext();
  }
  $sql = "DELETE from vodchannels_resources where id = $resource_id";
  $DB->execute($sql);
  unlink($large_image_location.$resource_path);
  $msg = _("Files deleted sucessfully.");
  redirect($_SERVER['PHP_SELF']."?id=".$_POST['video_id']);  
}

//Display error message if there are any
if(strlen($error)>0)
{
  echo "<p>".$error."</p>";
}
else echo "<p>".$msg."</p>";

if ($_GET['id']){ ?>
<html>
 <head>
  <title>Upload Files</title>
  <link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->
 </head>
 <body>
 <h3><?=_("You can upload images, MSOffice, PDF and MP3 files")?></h3>
 <fieldset>
 <form name="photo" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
 File 1 <input type="file" name="image[]" size="30" /><br /><br />
 File 2 <input type="file" name="image[]" size="30" /><br /><br />
 File 3 <input type="file" name="image[]" size="30" /><br /><br />
 <input type="hidden" name="VideoId" value="<?=$_GET['id'];?>" />
 <input type="submit" name="upload" value="Upload" />
 </form>
 </fieldset>
 
 <h3><?=_("Available resources for this video: ")?></h3>
 <fieldset>
 <form name="files" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" onsubmit="return confirm('<?=_("Are you sure do you want to delete?")?>')">
 <table>
 <?php
  $sql = "select * from vodchannels_resources where channel_id = ".$_GET['id'];
  $rsGet = $DB->Execute($sql);
  while(!$rsGet->EOF){
    ?>
    <tr>
     <td>
      <a href="resources/<?=$rsGet->fields['resource_path']?>"><?=$rsGet->fields['resource_path']?></a>
     </td>
     <td>
      <input type="hidden" value="<?=$rsGet->fields['id']?>" name="resource_id" />
      <input type="hidden" value="<?=$_GET['id']?>" name="video_id" />
      <input type="submit" name="delete" value="delete">
     </td>
    <?
    $rsGet->movenext();
  }
 ?>
 </table>
 </form>
 </fieldset>
</body>
</html>
<?php
}
?>
