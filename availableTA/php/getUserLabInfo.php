<?php
require "dbConfig.php";

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
    $rows[] = $row;
  }
  echo json_encode($rows);

}else{
  echo json_encode('No result');
}

?>
