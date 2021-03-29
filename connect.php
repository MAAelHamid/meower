<?php 
  $dsn = "mysql:host=localhost;dbname=mew";
  $user = "root";
  $pass = "root";
  $option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  );

  try {
    $con = new PDO($dsn,$user,$pass);
    $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "u are connected";
  } catch(PDOException $e) {
    echo "Failed" . $e->getMessage();
  }
?>