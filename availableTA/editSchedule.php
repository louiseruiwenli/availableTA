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
if($job==="1"){
  header("location: index.php");
  exit;
}
$sql = "SELECT ID from User WHERE email = '$email'";
$result=mysqli_query($link, $sql);

if(isset($result)){
  $row = mysqli_fetch_row($result);
  $userID = $row[0];
}

if(isset($_POST['save_unavailschedule'])){
  $morning_array = "";
  $afternoon_array = "";
  $evening_array = "";
  if(isset($_POST['timetable_morning'])){
    $morning_array = $_POST['timetable_morning'];
  }
  if(isset($_POST['timetable_afternoon'])){
    $afternoon_array = $_POST['timetable_afternoon'];
  }
  if(isset($_POST['timetable_evening'])){
    $evening_array = $_POST['timetable_evening'];
  }
  if(is_array($morning_array)){
    foreach ($morning_array as $morning_day){
      $sql_update = "UPDATE Schedule SET Morning = '0' WHERE UserID = '$userID' and DayOfWeek = '".$morning_day."'";
      if(mysqli_query($link, $sql_update)){
        //header("location: editSchedule.php");
      }else{
        echo "ERROR: Could not able to execute $sql_updatephone. " . mysqli_error($link);
      }
    }
  }

  if(is_array($afternoon_array)){
    foreach ($afternoon_array as $afternoon_day){
      $sql_update = "UPDATE Schedule SET Afternoon = '0' WHERE UserID = '$userID' and DayOfWeek = '".$afternoon_day."'";
      if(mysqli_query($link, $sql_update)){
        //header("location: viewSchedule.php");
      }else{
        echo "ERROR: Could not able to execute $sql_updatephone. " . mysqli_error($link);
      }
    }
  }

  if(is_array($evening_array)){
    foreach ($evening_array as $evening_day){
      $sql_update = "UPDATE Schedule SET Evening = '0' WHERE UserID = '$userID' and DayOfWeek = '".$evening_day."'";
      if(mysqli_query($link, $sql_update)){

      }else{
        echo "ERROR: Could not able to execute $sql_updatephone. " . mysqli_error($link);
      }
    }
  }

  header("location: viewSchedule.php");
}


if(isset($_POST['save_availschedule'])){
  $morning_array = "";
  $afternoon_array = "";
  $evening_array = "";
  if(isset($_POST['timetable_morning'])){
    $morning_array = $_POST['timetable_morning'];
  }
  if(isset($_POST['timetable_afternoon'])){
    $afternoon_array = $_POST['timetable_afternoon'];
  }
  if(isset($_POST['timetable_evening'])){
    $evening_array = $_POST['timetable_evening'];
  }

  if(is_array($morning_array)){
    foreach ($morning_array as $morning_day){
      $sql_update = "UPDATE Schedule SET Morning = '1' WHERE UserID = '$userID' and DayOfWeek = '".$morning_day."'";
      if(mysqli_query($link, $sql_update)){
        //header("location: viewSchedule.php");
      }else{
        echo "ERROR: Could not able to execute $sql_updatephone. " . mysqli_error($link);
      }
    }
  }
  if(is_array($afternoon_array)){
    foreach ($afternoon_array as $afternoon_day){
      $sql_update = "UPDATE Schedule SET Afternoon = '1' WHERE UserID = '$userID' and DayOfWeek = '".$afternoon_day."'";
      if(mysqli_query($link, $sql_update)){
        //header("location: viewSchedule.php");
      }else{
        echo "ERROR: Could not able to execute $sql_updatephone. " . mysqli_error($link);
      }
    }
  }
  if(is_array($evening_array)){
    foreach ($evening_array as $evening_day){
      $sql_update = "UPDATE Schedule SET Evening = '1' WHERE UserID = '$userID' and DayOfWeek = '".$evening_day."'";
      if(mysqli_query($link, $sql_update)){
        //header("location: viewSchedule.php");
      }else{
        echo "ERROR: Could not able to execute $sql_updatephone. " . mysqli_error($link);
      }
    }
  }

  header("location: viewSchedule.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AvailableTA</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/template.css">
    <link rel="stylesheet" type="text/css" href="css/schedule.css">
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
          <li class="list-group-item"><a href="viewSchedule.php">View/Edit Schedule</a></li>
          <li class="list-group-item"><a href="logout.php">Logout</a></li>
        </ul>
      </div>
      <div class="col-md-8">
        <form action = "editSchedule.php" method = "post">
        <table width="80%" align="center" >
        <div id="head_nav">
        <tr>
            <th>Time of Lab Period</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thrusday</th>
            <th>Friday</th>
        </tr>
        </div>

        <tr>
            <th>9:15am - 12:00am</th>
                <?php
                $week_array = array("M","T","W","R","F");
                foreach ($week_array as $day){
                  $sql_getSchedule = "SELECT Morning FROM Schedule WHERE UserID = '$userID' and DayOfWeek='$day'";
                  $result = mysqli_query($link, $sql_getSchedule);
                  if(isset($result)){
                    $row = mysqli_fetch_row($result);
                    $availibility = $row[0];
                  }

                  if($availibility==="1"){
                    echo "<td class='available'><input type='checkbox' value=$day name='timetable_morning[]'/>&nbsp;</td>";
                  }else{
                    echo "<td class='unavailable'><input type='checkbox' value=$day name='timetable_morning[]' checked/>&nbsp;</td>";
                  }
                }
                 ?>

        </tr>

        <tr>
            <th>2:15pm - 5:00pm</td>
              <?php

              $week_array = array("M","T","W","R","F");
              foreach ($week_array as $day){
                $sql_getSchedule = "SELECT Afternoon FROM Schedule WHERE UserID = '$userID' and DayOfWeek='$day'";
                $result = mysqli_query($link, $sql_getSchedule);
                if(isset($result)){
                  $row = mysqli_fetch_row($result);
                  $availibility = $row[0];
                }

                if($availibility==="1"){
                  echo "<td class='available'><input type='checkbox' value=$day name='timetable_afternoon[]'/>&nbsp;</td>";
                }else{
                  echo "<td class='unavailable'><input type='checkbox' value=$day name='timetable_afternoon[]' checked/>&nbsp;</td>";
                }
              }
               ?>

        </tr>

        <tr>
            <th>5:15pm - 8:00pm</td>
              <?php
              $week_array = array("M","T","W","R","F");
              foreach ($week_array as $day){
                $sql_getSchedule = "SELECT Evening FROM Schedule WHERE UserID = '$userID' and DayOfWeek='$day'";
                $result = mysqli_query($link, $sql_getSchedule);
                if(isset($result)){
                  $row = mysqli_fetch_row($result);
                  $availibility = $row[0];
                }

                if($availibility==="1"){
                  echo "<td class='available'><input type='checkbox' value=$day name='timetable_evening[]'/>&nbsp;</td>";
                }else{
                  echo "<td class='unavailable'><input type='checkbox' value=$day name='timetable_evening[]' checked/>&nbsp;</td>";
                }
              }
               ?>
        </tr>

    </table>


    <p align="center">Please check the box if you are NOT available.</p>

    <div style="text-align:center">
    <input class="btn btn-primary" type ="submit" name="save_unavailschedule" value="Save Schedule">
    </div>
    </form>

    <form action = "editSchedule.php" method = "post">
    <table width="80%" align="center" >
    <div id="head_nav">
    <tr>
        <th>Time of Lab Period</th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thrusday</th>
        <th>Friday</th>
    </tr>
    </div>

    <tr>
        <th>9:15am - 12:00am</th>
            <?php


            $week_array = array("M","T","W","R","F");
            foreach ($week_array as $day){
              $sql_getSchedule = "SELECT Morning FROM Schedule WHERE UserID = '$userID' and DayOfWeek='$day'";
              $result = mysqli_query($link, $sql_getSchedule);
              if(isset($result)){
                $row = mysqli_fetch_row($result);
                $availibility = $row[0];
              }

              if($availibility==="1"){
                echo "<td class='available'><input type='checkbox' value=$day name='timetable_morning[]' checked/>&nbsp;</td>";
              }else{
                echo "<td class='unavailable'><input type='checkbox' value=$day name='timetable_morning[]' />&nbsp;</td>";
              }
            }
             ?>

    </tr>

    <tr>
        <th>2:15pm - 5:00pm</td>
          <?php
          if(isset($_POST['save_availschedule'])){
            $afternoon_array = "";
            if(isset($_POST['timetable_afternoon'])){
              $afternoon_array = $_POST['timetable_afternoon'];
            }

            if(is_array($afternoon_array)){
              foreach ($afternoon_array as $afternoon_day){
                $sql_update = "UPDATE Schedule SET Afternoon = '1' WHERE UserID = '$userID' and DayOfWeek = '".$afternoon_day."'";
                if(mysqli_query($link, $sql_update)){
                  //header("location: viewSchedule.php");
                }else{
                  echo "ERROR: Could not able to execute $sql_updatephone. " . mysqli_error($link);
                }
              }
            }
          }

          $week_array = array("M","T","W","R","F");
          foreach ($week_array as $day){
            $sql_getSchedule = "SELECT Afternoon FROM Schedule WHERE UserID = '$userID' and DayOfWeek='$day'";
            $result = mysqli_query($link, $sql_getSchedule);
            if(isset($result)){
              $row = mysqli_fetch_row($result);
              $availibility = $row[0];
            }

            if($availibility==="1"){
              echo "<td class='available'><input type='checkbox' value=$day name='timetable_afternoon[]' checked/>&nbsp;</td>";
            }else{
              echo "<td class='unavailable'><input type='checkbox' value=$day name='timetable_afternoon[]' />&nbsp;</td>";
            }
          }
           ?>

    </tr>

    <tr>
        <th>5:15pm - 8:00pm</td>
          <?php


          $week_array = array("M","T","W","R","F");
          foreach ($week_array as $day){
            $sql_getSchedule = "SELECT Evening FROM Schedule WHERE UserID = '$userID' and DayOfWeek='$day'";
            $result = mysqli_query($link, $sql_getSchedule);
            if(isset($result)){
              $row = mysqli_fetch_row($result);
              $availibility = $row[0];
            }

            if($availibility==="1"){
              echo "<td class='available'><input type='checkbox' value=$day name='timetable_evening[]' checked/>&nbsp;</td>";
            }else{
              echo "<td class='unavailable'><input type='checkbox' value=$day name='timetable_evening[]' />&nbsp;</td>";
            }
          }
           ?>


     </tr>

     </table>


     <p align="center">Please check the box if you ARE available.</p>

     <div style="text-align:center">
     <input class="btn btn-primary" type ="submit" name="save_availschedule" value="Save Schedule">
     </div>
     </form>
    </div>
    </div>
</body>
</html>
