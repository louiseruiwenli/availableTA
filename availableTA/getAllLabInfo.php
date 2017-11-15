<?php
require "dbConfig.php";

$sql_lablist = "SELECT LabID, CourseNumber, CourseName, TA_ID, Prof_ID FROM Lab";
$result_lablist=mysqli_query($link, $sql_lablist) or die($result_lablist);

$rows = array();
if(isset($result_lablist)){
  while($row = mysqli_fetch_assoc($result_lablist)){
    $rows[] = $row;
  }

  echo json_encode($rows);
}else{
  echo json_encode('Invalid query');
}

?>
