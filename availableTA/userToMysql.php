<?php
require "dbConfig.php";

function generatePassword($length = 8) {
    $chars = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9');
    $count = 62;

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= $chars[$index];
    }

    return $result;
}

if(isset($_POST["Import"])){

        $filename=$_FILES["file"]["tmp_name"];
        $login_link = "students.engr.scu.edu/~rli/availableTA/login.php";


         if($_FILES["file"]["size"] > 0)
         {
            $file = fopen($filename, "r");

            if($file){
                while (($getData = fgetcsv($file, 10000, ",","'")) !== FALSE)
                 {

                    $account_password = generatePassword();
                    $sql = "INSERT into User (ID, Name, email, password, TAProf) values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$account_password."','".$getData[3]."')";
                    $result = mysqli_query($link, $sql);

                    if(!isset($result))
                    {
                        echo "<script type=\"text/javascript\">
                                alert(\"Invalid File:Please Upload CSV File.\");
                                window.location = \"admin.html\"
                              </script>";
                    }
                    else {
                        echo "<script type=\"text/javascript\">
                            alert(\"CSV File has been successfully Imported.\");
                            window.location = \"admin.html\"
                            </script>";

                        //mail system
                        $to=$getData[2];
                        $mailHeaders = "From: availableTA\r\n";
                        $subject = 'Your availableTA account has been activated';
                        $message = "Your user name is :$getData[2]\nYour password is: ".$account_password."\nGo to this link:".$login_link;
                        mail($to, $subject, $message, $mailHeaders);

                        //create schedule schedule table
                        $week_array = array("M","T","W","R","F");
                        if($getData[3]=='0'){
                          foreach ($week_array as $day){
                              $sql_createSchedule = "INSERT into Schedule (UserID, DayOfWeek, Morning, Afternoon, Evening, QuarterYear) values ('".$getData[0]."','".$day."','1','1','1','".$getData[4]."')";
                              $result = mysqli_query($link, $sql_createSchedule);
                              if(!isset($result))
                              {
                                  echo "<script type=\"text/javascript\">
                                          alert(\"Error in creating schedule table\");
                                          window.location = \"admin.html\"
                                        </script>";
                              }
                              else {
                                  echo "<script type=\"text/javascript\">
                                      alert(\"Schedule table has been successfully created.\");
                                      window.location = \"admin.html\"
                                      </script>";
                              }
                          }
                        }
                    }
                 }
            }else{
                die("Unable to open file");
            }

            fclose($file);
         }
    }
?>
