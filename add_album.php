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
       // We successfully connected to the database
       // The query is a php string 

        $has_name = $_POST['name'] != "";
        $get_user_query = "SELECT * FROM users where users.name=\"" . $_POST['name'] . "\"";
        $get_user_result = $db_server->query($get_user_query);
        $has_user = true;
        if(!$get_user_result){
          print "Please enter a valid user";
          $has_user = false;
        }
          $get_user_result->data_seek(0);
          $user = $get_user_result->fetch_assoc();
          $user_id = $user['id'];
          $password = $user['password'];
          $matching_password = ($password == $_POST['password']);

          $query = "INSERT INTO albums(user_id, album_name) VALUES ('" . $user_id .
          "', '" . $_POST['album_name'] . "');";

          //print "$password: ";
          //print $password;
          //print "post password";
          //print $_POST['password'];
          //$matching_password = true;
          $valid_information = $has_name && $has_user && $matching_password;

        if($valid_information){
          $albums_result = $db_server->query($query);
          if (!$albums_result) {
        	 /* If there was an error executing the query, the result will be false,
        	  otherwise its a mysql result resource. */
        	 print ("<h1> There was an error:</h1> <p> " . $db_server->error . "</p>");
          } else {
        	 print "<h1> The new record is: </h1>";
        	 print "<h2>Album Name: " . $_POST['album_name'] . "</h2>";
        	 print "<p>Album #: " . $db_server->insert_id . "</p>";
        	 print "<a href='index.php'>Return to Gallery</a>";
         }
        }else {
            print "<a href='create_album.php'>There was an error, try again</a>";
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