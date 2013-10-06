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

        $has_name;
        $matching_password;

        $valid_information = $has_name && $matching_password;

        if($valid_information){  
          $query = "INSERT INTO users(name, password, fact1, fact2, fact3) VALUES ('" . $_POST['name'] .
          "', '" . $_POST['password'] . "', '" . $_POST['fact1'] .
          "', '". $_POST['fact2'] . "', '" . $_POST_['fact3'] . "');";

          $customers_result = $db_server->query($query);
          if (!$customers_result) {
          	print ("<h1> There was an error:</h1> <p> " . $db_server->error . "</p>");
          } else {
          	 print "<h1> The new record is: </h1>";
          	 print "<h2>Name: " . $_POST['name'] . "</h2>";
          	 print "<p>User #: " . $db_server->insert_id . "</p>";
          	 print "<a href='index.php'>Return to Gallery</a>";
          }
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
