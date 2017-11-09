<?php
require "dbConfig.php";
// Initialize the session
session_start();

  if($_GET['username']){
    $email = $_GET['username'];
    $sql = "SELECT ID,TAProf from User WHERE email = '$email'";
    $result=mysqli_query($link, $sql);

    $rows = array();
    if(isset($result)){
      while($row = mysqli_fetch_assoc($result)){
        $userID = $row['ID'];
        $job = $row['TAProf'];
        $_SESSION['job'] = $job;
        $rows[]= $row;
      }

      echo json_encode($rows);
    }else{
      echo json_encode('No result');
    }
  }

?>
