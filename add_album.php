<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php require_once 'db_login.php'; ?>
<html> 
  <head> 
    <title>Registration Complete</title>
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

        $has_name = $_POST['album_name'] != "";

        $user_query = "SELECT * FROM users WHERE users.name=". $_POST['name'];
        // query executes an sql query
        $user_result = $db_server->query($user_query);
        $user_result->data_seek(0);
        $user = $user_result->fetch_assoc();

        $correct_password = $user['password'] == $_POST['password'];

        $valid_information = $has_name && $correct_password;

        if($valid_information){  
          $query = "INSERT INTO albums(user_id, album_name) VALUES ('" . $user['id'] .
          "', '" . $_POST['album_name'] . "');";

          $customers_result = $db_server->query($query);
          if (!$customers_result) {
          	print ("<h1> There was an error:</h1> <p> " . $db_server->error . "</p>");
          } else {
          	 print "<h1> The new record is: </h1>";
          	 print "<h2>Album Name: " . $_POST['album_name'] . "</h2>";
          	 print "<a href='index.php'>Return to Gallery</a>";
          }
        } else {
          print "There was an error, please check the user name, album name or password";
          print "<a href='create_album.php'>Try Again.</a>";
        }
      } 
     // You should always close server connections when you're done
     $db_server->close();
     if ($db_server->connect_errno) {
       // connect_error returns the a string of the error from the latest sql command
       print ("<h1> There was an error:</h1> <p> " . $db_server->connect_error . "</p>");
     } 
   }

?> 
  </body>
</html>
