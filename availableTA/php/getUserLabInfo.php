<?php
require "dbConfig.php";
session_start();

if(isset($_GET['job'])){
  $job = $_GET['job'];
}

if(isset($_GET['userID'])){
  $userID = $_GET['userID'];
}

$sql_labinfo = (!$job) ? "SELECT LabID, CourseNumber, CourseName, StartTime, EndTime, DayOfWeek, QuarterYear FROM Lab WHERE TA_ID = '$userID'" : "SELECT LabID, CourseNumber, CourseName, StartTime, EndTime, DayOfWeek, QuarterYear FROM Lab WHERE Prof_ID = '$userID'";
$result_labinfo=mysqli_query($link, $sql_labinfo) or die($result_labinfo);

$rows = array();
if(isset($result_labinfo)){

  while($row = mysqli_fetch_assoc($result_labinfo)){
    $LabID = $row[0];
    $CourseNumber = $row[1];
    $CourseName = $row[2];
    $StartTime = $row[3];
    $EndTime = $row[4];
    $DayOfWeek = $row[5];
    $QuarterYear = $row[6];

    $rows[] = $row;
  }
  echo json_encode($rows);

    //$_SESSION['LabID'] = $LabID;

}else{

  echo json_encode('No result');
}

?>
