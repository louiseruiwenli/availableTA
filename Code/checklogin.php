<?php
require "dbConfig.php";

// username and password sent from form
$myusername=$_POST['username'];
$mypassword=$_POST['password'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
//$myusername = mysql_real_escape_string($myusername);
//$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM User WHERE email='$myusername' and password='$mypassword'";
$result=mysqli_query($link, $sql);

if (!empty($result)) {
	session_start();
	$_SESSION['username']=$myusername;
	$_SESSION['password']=$mypassword;
	header("location:home.php");
}
else {
echo "Wrong Username or Password";
mysql_close();
}
?>