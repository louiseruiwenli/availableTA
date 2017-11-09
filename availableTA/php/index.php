<?php
require "dbConfig.php";
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  //header("location: login.html");
  //exit;
}

if(isset($_SERVER["REQUEST_METHOD"] == "GET")){
  if($_GET['username']){
    $email = $_GET['username'];
    $sql = "SELECT ID,TAProf from User WHERE email = '$email'";
    $result=mysqli_query($link, $sql);

    if(isset($result)){
      $row = mysqli_fetch_row($result);
      $userID = $row[0];
      $job = $row[1];
      $_SESSION['job'] = $job;

      echo json_encode($result);
    }else{
      echo json_encode('No result');
    }
  }
}
?>
