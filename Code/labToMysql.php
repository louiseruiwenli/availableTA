<?php
require "dbConfig.php";

if(isset($_POST["Import"])){

        $filename=$_FILES["file"]["tmp_name"];

         if($_FILES["file"]["size"] > 0)
         {
            $file = fopen($filename, "r");
            if($file){
                while (($getData = fgetcsv($file, 10000, ",","'")) !== FALSE)
                 {


                   $sql = "INSERT into Lab (LabID, CourseNumber, Prof, CourseName, StartTime, EndTime, DayOfWeek, QuarterYear) values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."')";
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
                    }
                 }

            fclose($file);

            }
        }else{
            die("Unable to open file");
        }
    }


?>