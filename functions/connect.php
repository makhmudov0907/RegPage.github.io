<?php

  $dbhost = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "zadachnik";

  $db = mysqli_connect($dbhost, $username, $password, $dbname);

  if (!$db) {
    die('Error connect to DataBase');
  }



 ?>
