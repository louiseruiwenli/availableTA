<?php
require "dbConfig.php";

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
$email = $_SESSION['username'];
$job = $_SESSION['job'];

if(isset($_POST['delete'])){
  $LabID=$_POST['delete'][0];

}

$sql = (!$job) ? "UPDATE Lab SET TA_ID = null WHERE LabID = '$LabID'" : "UPDATE Lab SET Prof_ID = null WHERE LabID = '$LabID'";
$result=mysqli_query($link, $sql);

if(isset($result)){
  header("location: editProfile.php");
  exit;
}else{
  echo "<p>Error</p>";
}
?>
