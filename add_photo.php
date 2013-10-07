<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php require_once 'db_login.php'; ?>
<html> 
  <head> 
    <title>Album Added</title>
    <meta charset="utf-8" />
  </head> 
  <body>
<?php 
	if (isset ($_POST['add'])){
     // Creating a mysqli object establishes a database connection
    	$db_server = new mysqli($db_hostname, $db_username, $db_password, $db_database); 
     // We can call connect_errno to see If the connection failed- zero means no error occurred
     	if ($db_server->connect_errno) {
       // connect_error returns the a string of the error from the latest sql command
       	print ("<h1> There was an error:</h1> <p> " . $db_server->connect_error . "</p>");
     	} else { 

     		$has_title = $_POST['title'] != "";
        	$get_user_query = "SELECT * FROM users where users.name=\"" . $_POST['name'] . "\"";
        	$get_user_result = $db_server->query($get_user_query);
        	if(!$get_user_result){
          		print "Please enter a valid user";
          		$has_user = false;
        	}

          	$get_user_result->data_seek(0);
          	$user = $get_user_result->fetch_assoc();
          	$user_id = $user['id'];
          	$password = $user['password'];
          	$matching_password = ($password == $_POST['password']);

          	$check_album_query = "SELECT * FROM albums where albums.album_name=\"" . $_POST['album_name'] . "\" and albums.user_id=" . $user_id;
          	$check_album_result = $db_server->query($check_album_query);
          	$has_album = true;
          	if(!$check_album_result){
          		print "Please enter a valid album";
          		$has_album = false;
        	}

////////////////////////////////////////////////////////////////////////
          $uploaded = false;

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

echo $_FILES['file']['name'];
echo $_FILES["file"]["error"];
echo ($_FILES["file"]["type"]);
//echo ($_FILES["file"]["type"] == "image/jpg");

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& in_array($extension, $allowedExts))
{
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
 //   echo "Upload: " . $_FILES["file"]["name"] . "<br>";
 //   echo "Type: " . $_FILES["file"]["type"] . "<br>";
 //   echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
 //   echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("photos/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
     "photos/" . $_FILES["file"]["name"]);
      $uploaded = true;
     echo "Stored in: " . "photos/" . $_FILES["file"]["name"];
      }
    }
}
else
{
  if(isset($_POST['add'])){
    echo "Invalid file";
    echo $_FILES['file']['name'];
  }
}

////////////////////////////////////////////////////////////////////////



     		$valid_information = $has_title && $matching_password && $has_album && $uploaded; 
     		if($valid_information){

     		} else {
     			print $_FILES['file']['name'];
     			print "\nmatching password " . $matching_password;
     			print "\nhas_album " . $has_album;
     			print "\nuploaded " . $uploaded; 
     			print "<a href='upload_photo.php'>There was an error, try again</a>";
     		}

     	}





        $db_server->close();
     	if ($db_server->connect_errno) {
       	// connect_error returns the a string of the error from the latest sql command

       		print ("<h1> There was an error:</h1> <p> " . $db_server->connect_error . "</p>");
     	} 	
    }
?>

  </body>
</html>