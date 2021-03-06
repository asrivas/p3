<?php 
  require_once 'db_login.php';
  $db_server = new mysqli($db_hostname, $db_username, $db_password, $db_database); 
  if ($db_server->connect_errno) {
   // connect_error returns the a string of the error from the latest sql command
    print ("<h1> There was an error:</h1> <p> " . $db_server->connect_error . "</p>");
  } else { 
   // We successfully connected to the database
   // The query is a php string 
    $albums_query = "SELECT * FROM albums WHERE albums.user_id=" . $_POST['id'];
   // query executes an sql query
    $albums_result = $db_server->query($albums_query);
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
        <h1>Welcome to <?php print $_POST['name'] ?> 's Gallery</h1>
        <p class="lead">Select an album to view</p>
<?php 
  if(!$albums_result){
    print ("<h1> There was an error:</h1> <p> " . $db_server->connect_error . "</p>");
  } else {
    $num_albums = $albums_result->num_rows;
  }

  for ($cur_album_num = 0; $cur_album_num < $num_albums; $cur_album_num++){
    $albums_result->data_seek($cur_album_num);
    $cur_album = $albums_result->fetch_assoc();
    print_album($cur_album);
  }

?>

      </div><!--/.template-->

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/assets/js/jquery.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>

<?php function print_album ($album) { 
  print "<div align ='left'>";
  print "<form method='post' action='view_album.php'>";
  print "<h2>" . $album['album_name'] . "</h2>";
  print "<input type='hidden' name='id' value='" . $album['user_id'] . "'/>";
  print "<input type='hidden' name='album_id' value='" . $album['album_id'] . "'/>";
    print "<input type='hidden' name='album_name' value='" . $album['album_name'] . "'/>";
  print "<input type='submit' name='View Albums' value='View Album' />";
  print "</form>"; 
  print "<div>";

  }

  $db_server->close(); 

?>
  </body>
</html>