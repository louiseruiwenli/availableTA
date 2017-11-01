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
$sql = "SELECT ID,TAProf from User WHERE email = '$email'";
$result=mysqli_query($link, $sql);

if(isset($result)){
  $row = mysqli_fetch_row($result);
  $userID = $row[0];
  $job = $row[1];
}

$_SESSION['job'] = $job;


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
          <li class="list-group-item"><a href="index.php">Home</a></li>
          <li class="list-group-item"><a href="viewProfile.php">View Profile</a></li>
          <li class="list-group-item"><a href="editProfile.php">Edit Profile</a></li>
          <li class="list-group-item <?php echo ($job)?'disabled':''?>"><a href="viewSchedule.php">View Schedule</a></li>
          <li class="list-group-item <?php echo ($job)?'disabled':''?>"><a href="editSchedule.php">Edit Schedule</a></li>
          <li class="list-group-item"><a href="logout.php">Logout</a></li>
        </ul>
      </div>
      <div id="lablist" class = "col-md-8">
        <?php
        $sql_labinfo = (!$job) ? "SELECT LabID, CourseNumber, CourseName, StartTime, EndTime, DayOfWeek, QuarterYear FROM Lab WHERE TA_ID = '$userID'" : "SELECT LabID, CourseNumber, CourseName, StartTime, EndTime, DayOfWeek, QuarterYear FROM Lab WHERE Prof_ID = '$userID'";
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
            //$_SESSION['LabID'] = $LabID;
            echo "<form action='taList.php' method='post'>";
            echo "<div class='col-md-4 text-left'>
                  <div>$CourseNumber&nbsp;$CourseName</div>
                  <button type='submit' class='btn' name='request[]' value='$LabID'>Request</button></div>";
            echo "</form>";
          }
        }else{
          echo "<p>Please choose your lab sessions in Edit Profile.</p>";
        }

        ?>

      </div>
      <div class="col-md-2">
        <h3>List of all TAs: </h3>
        <?php
          $sql_ta = "SELECT Name FROM User WHERE TAProf = '0'";
          $result_ta = mysqli_query($link, $sql_ta) or die($result_ta);
          if(isset($result_ta)){
            while($row = mysqli_fetch_array($result_ta,MYSQLI_NUM)){
              $TA_name = $row[0];
              echo "<p>$TA_name</p>";
            }
          }
         ?>
      </div>
    </div>
</body>
</html>
