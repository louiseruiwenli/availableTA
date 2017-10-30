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
    <style type="text/css">
    unavailable
      {
        background-color:red;
      }
    body
    {
        font-family: arial;
    }

    th,td
    {
        margin: 0;
        text-align: center;
        border-collapse: collapse;
        outline: 1px solid #e3e3e3;
    }

    td
    {
        padding: 5px 10px;
    }

    th
    {
        background: #666;
        color: white;
        padding: 5px 10px;
    }

    td:hover
    {
        cursor: pointer;
        background: #666;
        color: white;
    }
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
          <li class="list-group-item"><a href="viewSchedule.php">View Schedule</a></li>
          <li class="list-group-item"><a href="editSchedule.php">Edit Schedule</a></li>
          <li class="list-group-item"><a href="logout.php">Logout</a></li>
        </ul>
      </div>
      <div class="col-md-8">
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

                <td><input type="checkbox" value="Mon_morning" name="timetable"/>&nbsp;</td>
                <td><input type="checkbox" value="Tue_morning" name="timetable"/>&nbsp;</td>
                <td><input type="checkbox" value="Wed_morning" name="timetable"/>&nbsp;</td>
                <td><input type="checkbox" value="Thu_morning" name="timetable"/>&nbsp;</td>
                <td><input type="checkbox" value="Fri_morning" name="timetable"/>&nbsp;</td>

        </tr>

        <tr>
            <th>2:15pm - 5:00pm</td>

                <td><input type="checkbox" value="Mon_afternoon" name="timetable"/>&nbsp;</td>
                <td><input type="checkbox" value="Tue_afternoon" name="timetable"/>&nbsp;</td>
                <td><input type="checkbox" value="Wed_afternoon" name="timetable"/>&nbsp;</td>
                <td><input type="checkbox" value="Thu_afternoon" name="timetable"/>&nbsp;</td>
                <td><input type="checkbox" value="Fri_afternoon" name="timetable"/>&nbsp;</td>

        </tr>

        <tr>
            <th>5:15pm - 8:00pm</td>

                <td><input type="checkbox" value="Mon_evening" name="timetable"/>&nbsp;</td>
                <td><input type="checkbox" value="Tue_evening" name="timetable"/>&nbsp;</td>
                <td><input type="checkbox" value="Wed_evening" name="timetable"/>&nbsp;</td>
                <td><input type="checkbox" value="Thu_evening" name="timetable"/>&nbsp;</td>
                <td><input type="checkbox" value="Fri_evening" name="timetable"/>&nbsp;</td>


        </tr>

    </table>

    <p align="center">Please check the box if you are not available.</p>

    <div style="text-align:center">
    <button class="btn btn-primary" onclick="myFunction()">Save Schedule</button>
    </div>
      </div>
    </div>

    <script>
    function myFunction() {
        var x = document.getElementsByName("timetable");
        var i;
        for (i = 0; i < x.length; i++) {
            if (x[i].type == "checkbox" && x[i].checked = true) {
                x[i].css('background-color',"red");
              }
            }
        }
    }
    </script>
</body>
</html>
