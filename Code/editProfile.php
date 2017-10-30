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

if($phone == ""){
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
          <li class="list-group-item"><a href="viewSchedule.php">View Schedule</a></li>
          <li class="list-group-item"><a href="editSchedule.php">Edit Schedule</a></li>
          <li class="list-group-item"><a href="logout.php">Logout</a></li>
        </ul>
      </div>
      <div id="lablist" class = "col-md-8 text-left">
        <h3>Personal Information</h3>
        <p>Name: <?=$userName?></p>
        <p>Student ID: <?=$userID?></p>
        <p>Email: <?=$email?></p>
        <p>Job: <?=$job?></p>
        <?php
        if(isset($_POST["Save"])){
          $phone = $_POST['phone'];
          $sql_updatephone = "UPDATE User SET phone = '$phone' where email = '$email'";
          if(mysqli_query($link, $sql_updatephone)){
            echo "Records were updated successfully.";
          }else{
            echo "ERROR: Could not able to execute $sql_updatephone. " . mysqli_error($link);
          }

        }
         ?>
        <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
          <div class="form-group <?php echo ($phone==0) ? 'has-error' : ''; ?>">
              <label>Phone:<sup>*</sup></label>
              <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">

              <input type="submit" id="Save" name="Save" class="btn btn-primary button-loading" data-loading-text="Loading..." value="Save">
          </div>
        </form>


        <h3>Lab Information</h3>

        <div class = "container">
          <div class = "col-md-6">
            <form action = "editProfile.php" method = "post">
              <div class="form-group">
                <label>Choose your lab sessions:<sup>*</sup></label>

                  <?php
                  $sql_lablist = "SELECT LabID, CourseNumber, CourseName FROM Lab";
                  $result_lablist=mysqli_query($link, $sql_lablist) or die($result_lablist);
                  while($row = mysqli_fetch_array($result_lablist,MYSQLI_NUM)){

                    $LabID = $row[0];
                    $CourseNumber = $row[1];
                    $CourseName = $row[2];
                    echo '<p><input type="checkbox" name="boxes[]" value="'.$LabID.'">'.$LabID." ".$CourseNumber.'</option></p>';
                  }

                  if(isset($_POST['Update'])){
                    if(isset($_POST['boxes'])){
                      $lab_array = $_POST['boxes'];
                    }

                    foreach ($lab_array as $labid){
                      $sql_updatelab = "UPDATE Lab SET TA_ID = '$userID' WHERE LabID = '$labid'";
                      if(mysqli_query($link, $sql_updatelab)){
                        echo "Records were updated successfully.";
                      }else{
                        echo "ERROR: Could not able to execute $sql_updatephone. " . mysqli_error($link);
                      }
                    }
                  }
                  ?>


              </div>
              <button type="submit" id="submit" name="Update" class="btn btn-primary button-loading" data-loading-text="Loading...">Update</button>
            </form>
          </div>
          <div class="col-md-6">
            <h5>Your lab sessions:</h5>
            <?php
            $sql_labinfo = "SELECT LabID, CourseNumber, CourseName, StartTime, EndTime, DayOfWeek, QuarterYear FROM Lab WHERE TA_ID = '$userID'";
            $result_labinfo=mysqli_query($link, $sql_labinfo) or die($result_labinfo);
            while($row = mysqli_fetch_array($result_labinfo,MYSQLI_NUM)){
              $LabID = $row[0];
              $CourseNumber = $row[1];
              $CourseName = $row[2];
              echo "<div><p>$LabID&nbsp;$CourseNumber&nbsp;$CourseName</p><button class='btn-warning' onclick = deleteLab()>Delete</button></div>";
            }
            ?>
          </div>
      </div>

      </div>
      <div class="col-md-2">
      </div>
    </div>
</body>
</html>
