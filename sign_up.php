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
            <li class="active"><a href="sign_up.php">Sign Up</a></li>
            <li><a href="create_album.php">Create Album</a></li>
            <li><a href="upload_photo.php">Add a Photo</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="starter-template">
        <h1>Register</h1>
        <p class="lead">Please enter your information</p>
<?php 
       print "<div align='left'>";
       print "<form method='post' action='add_user.php'>";
       print "<p>Name <p>";
       print "<input type='text' name='name' value=''/>";
       print "<p>Password (must contain)</p>";
       print "<input type='password' name='password' value=''/>";
       print "<p>Please enter your password again</p>";
       print "<input type='password' name='confirm_password' value=''/>";
       print "<p>Personal Information</p> ";
       print "<p>Fact 1</p> ";
       print "<input type='text' name='fact1' value=''/><br>";
       print "<p>Fact 2</p> ";
       print "<input type='text' name='fact2' value=''/><br>";
       print "<p>Fact 3</p> ";
       print "<input type='text' name='fact3' value=''/><br>";
       print "<input type='submit' name='add' value='Register' />";
       print "</form>"; 
       print "</div>"; 

?>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/assets/js/jquery.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
