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

                        $to=$getData[2];
                        $mailHeaders = "From: availableTA\r\n";
                        $subject = 'Your availableTA account has been activated';
                        $message = 'Your user name is :'.$getData[2].'\nYour password is: '.$account_password.'\nGo to this link: <a href='.$login_link ."'>".$login_link.'</a>';


                        mail($to, $subject, $message, $mailHeaders);
                    }
                 }
            }else{
                die("Unable to open file");
            }

             fclose($file);
         }
    }
?>