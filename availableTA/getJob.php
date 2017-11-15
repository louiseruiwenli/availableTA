<?php
require "dbConfig.php";

  if($_GET['username']){
    $email = $_GET['username'];
    $sql = "SELECT ID,TAProf from User WHERE email = '$email'";
    $result=mysqli_query($link, $sql);

    $rows = array();
    if(isset($result)){
      while($row = mysqli_fetch_assoc($result)){
        $rows[]= $row;
      }

      echo json_encode($rows);
    }else{
      echo json_encode('No result');
    }
  }

?>
