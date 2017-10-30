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
$sql = "SELECT ID,Name,email,TaProf,phone from User WHERE email = '".$email."'";
$result=mysqli_query($link, $sql);

if(isset($result)){
  $row = mysqli_fetch_array($result,MYSQLI_NUM);
  $userID = $row[0];
  $userName = $row[1];
  $TAProf = $row[3];
  $phone = $row[4];
}else{
  echo "<p>Error!</p>";
}
$job = "";
if($TAProf==0){
  $job = "TA";
}else{
  $job = "Professor";
}

if($phone == 0){
  $phone = "Please edit your phone number!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>

<body>
    <div class="page-header">
        <h1>AvailableTA</h1>
    </div>
    <div class = "container-flow">
      <div id="menu" class="col-md-2">
        <img>
        <ul class="list-group text-left nav nav-bar">
          <li class="list-group-item"><a href="home.php">Home</a></li>
          <li class="list-group-item"><a href="viewProfile.php">View Profile</a></li>
          <li class="list-group-item"><a href="editProfile.php">Edit Profile</a></li>
          <li class="list-group-item"><a href="ViewSchedule.php">View Schedule</a></li>
          <li class="list-group-item"><a href="EditSchedule.php">Edit Schedule</a></li>
          <li class="list-group-item"><a href="logout.php">Logout</a></li>
        </ul>
      </div>
      <div id="lablist" class = "col-md-8">
        <h3>Personal Information</h3>
        <p>Name: <?=$userName?></p>
        <p>Student ID: <?=$userID?></p>
        <p>Email: <?=$email?></p>
        <p>Job: <?=$job?></p>
        <p>Phone: <?=$phone?></p>


        <h3>Lab Information</h3>
        <?php
        $sql_labinfo = "SELECT LabID, CourseNumber, CourseName, StartTime, EndTime, DayOfWeek, QuarterYear FROM Lab WHERE TA_ID = '$userID'";
        $result_labinfo=mysqli_query($link, $sql_labinfo) or die($result_labinfo);
        if(!isset($result_labinfo)){
          $row = mysqli_fetch_array($result_labinfo,MYSQLI_NUM);
          $LabID = $row[0];
          $CourseNumber = $row[1];
          $CourseName = $row[2];
          echo "<div><h3>$CourseName</h3></div>";
        }else{
          echo "<p>Please choose your lab sessions in Edit Profile.</p>";
        }
        ?>

      </div>
      <div class="col-md-2">
      </div>
    </div>
</body>
</html>