<?php
// Include config file
require "dbConfig.php";

//PHP header
//header("Content-Type: application/json");

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "GET"){

    // Check if username is empty
    if(empty(trim($_GET["username"]))){
        $username_err = 'Please enter username.';
        echo json_encode('EmptyUser');
    } else{
      if(empty(trim($_GET['password']))){
          $password_err = 'Please enter your password.';
          echo json_encode('EmptyPass');
      } else{
        $username = trim($_GET["username"]);
        $password = trim($_GET['password']);
      }
    }
    //echo "Username: $username";

    // Check if password is empty


    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT email, password FROM User WHERE email = '$username'";
        $result=mysqli_query($link, $sql);

        //if($stmt = mysqli_prepare($link, $sql)or die(mysqli_error($link))){
        if(isset($result)){
            // Bind variables to the prepared statement as parameters
            //mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            //$param_username = $username;

            //echo $param_username;
            $row = mysqli_fetch_assoc($result);
            $password_check = $row['password'];
            // Attempt to execute the prepared statement
            //if(mysqli_stmt_execute($stmt)){
                // Store result
                //mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                //if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    //mysqli_stmt_bind_result($stmt, $username, $hash_password);
                    //if(mysqli_stmt_fetch($stmt)){
                      //echo $password;
                      //echo $hash_password;
                        if($password === $password_check){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            echo json_encode('Login');

                            //header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                            echo json_encode('WrongPass');
                        }
                  //  }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                    echo json_encode('NoUser');
                }
            } else{
                echo json_encode('Error');
                //echo "Oops! Something went wrong. Please try again later.";
            }
}

        // Close statement
        //mysqli_stmt_close($stmt);
    //}

    // Close connection
    //mysqli_close($link);
//}
?>
