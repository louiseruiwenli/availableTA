<?php
require "dbConfig.php";

if($_GET['action']=='update'){
  if($_GET['job']){
    $job = $_GET['job'];
  }else{
    $job = 0;
  }



  if($_GET['labID']){
    $labID = $_GET['labID'];
  }


  if($_GET['userID']){
    $userID = $_GET['userID'];
  }

  $sql_updatelab = (!$job) ? "UPDATE Lab SET TA_ID = '$userID' WHERE LabID = '$labID'" : "UPDATE Lab SET Prof_ID = '$userID' WHERE LabID = '$labID'";
  $result = mysqli_query($link, $sql_updatelab);

  if(isset($result)){
    echo json_encode('Update Success');
  }else{
    echo json_encode('Update Failure');
  }



}

if($_GET['action']=='delete'){
  if($_GET['job']){
    $job = $_GET['job'];
  }else{
    $job = 0;
  }


  if($_GET['labID']){
    $labID = $_GET['labID'];
  }

  $sql = (!$job) ? "UPDATE Lab SET TA_ID = null WHERE LabID = '$labID'" : "UPDATE Lab SET Prof_ID = null WHERE LabID = '$labID'";
  $result=mysqli_query($link, $sql);

  if(isset($result)){
    echo json_encode('Delete Success');
  }else{
    echo json_encode('Delete Failure');
  }

}
 ?>
