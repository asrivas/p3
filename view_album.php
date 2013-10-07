<?php 
  require_once 'db_login.php';
  $db_server = new mysqli($db_hostname, $db_username, $db_password, $db_database); 
  if ($db_server->connect_errno) {
   // connect_error returns the a string of the error from the latest sql command
    print ("<h1> There was an error:</h1> <p> " . $db_server->connect_error . "</p>");
  } else { 
   // We successfully connected to the database
   // The query is a php string 
    $photos_query = "SELECT * FROM photos WHERE photos.album_id=" . $_POST['album_id'];
   // query executes an sql query
    $photos_result = $db_server->query($photos_query);
  }
?>
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
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="sign_up.php">Sign Up</a></li>
            <li><a href="create_album.php">Create Album</a></li>
            <li><a href="upload_photo.php">Add a Photo</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="starter-template">
        <h1><?php print $_POST['album_name'] ?></h1>
        <p class="lead">Select a Photo to View</p>
<?php 
  if(!$photos_result){
    print ("<h1> There was an error:</h1> <p> " . $db_server->connect_error . "</p>");
  } else {
    $num_photos = $photos_result->num_rows;
  }

  for ($cur_photo_num = 0; $cur_photo_num < $num_photos; $cur_photo_num++){
    $photos_result->data_seek($cur_photo_num);
    $cur_photo = $photos_result->fetch_assoc();
    print_photo($cur_photo);
  }

?>

      </div><!--/.template-->

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/assets/js/jquery.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>

<?php function print_photo ($photo) { 
  print "<div align ='left'>";
  print "<form method='post' action='view_photo.php'>";
  print "<h2>" . $photo['title'] . "</h2>";
  print "<input type='hidden' name='id' value='" . $photo['user_id'] . "'/>";
  print "<input type='hidden' name='album_id' value='" . $photo['album_id'] . "'/>";
  print "<input type='hidden' name='title' value='" . $photo['title'] . "'/>";
  print "<input type='hidden' name='file' value='" . $photo['file'] . "'/>";
  print "<input type='submit' name='View Photo' value='View Photo' />";
  print "</form>"; 
  print "<div>";

  }

  $db_server->close(); 

?>
  </body>
</html>