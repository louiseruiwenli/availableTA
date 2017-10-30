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
$sql = "SELECT ID from User WHERE email = '$email'";
$result=mysqli_query($link, $sql);

if(isset($result)){
  $row = mysqli_fetch_row($result);
  $userID = $row[0];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AvailableTA</title>
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
        <?php
        $sql_labinfo = "SELECT LabID, CourseNumber, CourseName, StartTime, EndTime, DayOfWeek, QuarterYear FROM Lab WHERE TA_ID = '$userID'";
        $result_labinfo=mysqli_query($link, $sql_labinfo) or die($result_labinfo);
        if(isset($result_labinfo)){
          while($row = mysqli_fetch_array($result_labinfo,MYSQLI_NUM)){
            $LabID = $row[0];
            $CourseNumber = $row[1];
            $CourseName = $row[2];
            $StartTime = $row[3];
            $EndTime = $row[4];
            $DayOfWeek = $row[5];
            $QuarterYear = $row[6];
            echo "<div><p>$CourseName</p><button class='btn'>Request</button></div>";
          }
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
