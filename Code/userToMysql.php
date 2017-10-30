<?php
require "dbConfig.php";

function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}

if(isset($_POST["Import"])){

        $filename=$_FILES["file"]["tmp_name"];
        $login_link = "http://www.students.engr.scu.edu/~rli/availableTA/login.php";


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
            }else{
                die("Unable to open file");
            }

             fclose($file);
         }
    }
?>
