<?php
require "dbConfig.php";

if($_GET['labID']){
  $labID = $_GET['labID'];
}

$sql = "SELECT StartTime, DayOfWeek FROM Lab WHERE LabID = '$labID'";
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


$sql_TAlist = "SELECT distinct UserID FROM Schedule WHERE $time = 1 AND DayOfWeek = '$day'";
$result_TAlist=mysqli_query($link, $sql_TAlist) or die($result_TAlist);


if(isset($result_TAlist)){
  if(mysqli_num_rows($result_TAlist)==0){
    $sql_profID = "SELECT Prof_ID FROM Lab WHERE LabID = '$labID'";
    $result_profID=mysqli_query($link, $sql_profID);
    if(isset($result_profID)){
      $row = mysqli_fetch_assoc($result_profID);
      $ProfID = $row['Prof_ID'];

      $sql_profInfo = "SELECT email FROM User WHERE ID = '$ProfID'";
      $result_profInfo = mysqli_query($link, $sql_profInfo);

      if(mysqli_num_rows($result_profInfo)>0){
          $row_prof = mysqli_fetch_assoc($result_profInfo);
          $prof_email = $row_prof['email'];

          //mail system
          $to=$prof_email;
          $mailHeaders = "From: availableTA\r\n";
          $subject = 'One of your lab does not have TA available';
          $message = "One of your TA has sent a request for substitute, but the system shows no available TA during the lab period. Please find another solution as soon as possible. The lab session ID is".$labID;
          mail($to, $subject, $message, $mailHeaders);
      }
    }else{
      echo json_encode("Error");
    }
    echo json_encode("No Result");
  }else{
    $rows = array();
    while($row = mysqli_fetch_array($result_TAlist,MYSQLI_NUM)){
      $taID = $row[0];
      $sql_user = "SELECT Name, email, phone FROM User WHERE ID = '$taID' AND TAProf = '0'";
      $result_user = mysqli_query($link, $sql_user);
      if(isset($result_user)){
        while($row= mysqli_fetch_assoc($result_user)){
          $rows[] = $row;
        }
      }
    }
    echo json_encode($rows);
  }

}else{
   echo json_encode("Error");
}

?>
