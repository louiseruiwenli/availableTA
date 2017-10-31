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
if(isset($_POST['request'])){
  $LabID=$_POST['request'][0];

}

$sql = "SELECT StartTime, DayOfWeek FROM Lab WHERE LabID = '$LabID'";
$result=mysqli_query($link, $sql);

$time = "";
$row = mysqli_fetch_row($result);

$startTime = $row[0];
$day = $row[1];

if($startTime==="9:15:00"){
  $time="Morning";
}else if($startTime==="14:15:00"){
  $time="Afternoon";
}else{
  $time="Evening";
}

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
          <li class="list-group-item"><a href="index.php">Home</a></li>
          <li class="list-group-item"><a href="viewProfile.php">View Profile</a></li>
          <li class="list-group-item"><a href="editProfile.php">Edit Profile</a></li>
          <li class="list-group-item <?php echo ($job)?'disabled':''?>"><a href="viewSchedule.php">View Schedule</a></li>
          <li class="list-group-item <?php echo ($job)?'disabled':''?>"><a href="editSchedule.php">Edit Schedule</a></li>
          <li class="list-group-item"><a href="logout.php">Logout</a></li>
        </ul>
      </div>
      <div class="col-md-8 text-left">
        <?php
        $sql_list = "SELECT UserID FROM Schedule WHERE $time = '1' AND DayOfWeek = '$day'";
        $result_list = mysqli_query($link, $sql_list);
        if(isset($result_list)){
          if(mysqli_num_rows($result_list)===0){
            echo "No available TA during this time period! Please contact professor.";
          }
          while($row = mysqli_fetch_array($result_list,MYSQLI_NUM)){
            $taID = $row[0];
            $sql_user = "SELECT Name, phone FROM User WHERE ID = '$taID' AND TAProf = '0'";
            $result_user = mysqli_query($link, $sql_user);
            if(isset($result_list)){
              $row_list = mysqli_fetch_array($result_user,MYSQLI_NUM);
              $name = $row_list[0];
              $phone = $row_list[1];
              echo "<p>Name: $name &nbsp; Phone: $phone<p>";
            }

           }
         }
         ?>
      </div>
    </div>
</body>
</html>
