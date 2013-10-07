


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="">

    <title>Photo Gallery</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Photo Gallery</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="sign_up.php">Sign Up</a></li>
            <li><a href="create_album.php">Create Album</a></li>
            <li class="active"><a href="upload_photo.php">Add a Photo</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="starter-template">
        <h1>Add a Photo</h1>
        <p class="lead">Please enter Photo Information</p>
 
      <div align='left'>
        <form method='post' action='upload_photo.php' enctype="multipart/form-data" >
           <p>Photo Title <p>
           <input type='text' name='title' value=''/>
           <p>File</p>
            <input type='file' name="file" id="file" value=''/>
          <p>Your Name</p>
           <input type='text' name='name' value=''/>
          <p>Album Name</p>
           <input type='text' name='album_name' value=''/>
           <p>Your Password</p>
           <input type='password' name='password' value=''/><br>
           <input type='submit' name='add' value='Upload' />
         </form>
       </div> 

      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/assets/js/jquery.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>



<?php 
  require_once 'db_login.php';
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
          $check_album_result->data_seek(0);
          $album = $check_album_result->fetch_assoc();
          $album_id = $album['album_id'];

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
          //$query = "INSERT INTO photos(album_id, user_id, title, file) VALUES (". $album_id "', '". $user_id ."', '" . $_POST['title'] . "', '". $FILES['file']['name'] ."');";
          $query = "INSERT INTO photos(album_id, user_id, title, file) VALUES ('" . $album_id . "','". $user_id .
          "', '" . $_POST['title'] . "','". $_FILES['file']['name']."');";
          $photos_result = $db_server->query($query);
          if (!$photos_result) {
           /* If there was an error executing the query, the result will be false,
            otherwise its a mysql result resource. */
           print ("<h1> There was an error:</h1> <p> " . $db_server->error . "</p>");
          } else {
           print "<h1> The new record is: </h1>";
           print "<h2>Photo Title: " . $_POST['title'] . "</h2>";
           print "<p>Photo #: " . $db_server->insert_id . "</p>";
           print "<a href='index.php'>Return to Gallery</a>";
         }
        } else {
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
