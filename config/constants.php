<?php

  //Session is a way to store information to be used across multiple pages
  session_start();

  define('SERVER', "remotemysql.com");
  define('USERNAME', "MbudmRIygc");
  define('DB_NAME', "MbudmRIygc");
  define('PASSWORD', "GS60cOirnV");

  $conn = mysqli_connect(SERVER, USERNAME, PASSWORD) or die(mysqli_error());

  $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>