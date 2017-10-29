<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <META http-equiv="X-UA-Compatible" content="IE=8">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="jquery-3.1.1.min.js"></script>
    <script src="md5.min.js"></script>
    <script src="login.js"></script>
  </head>

  <body>
    <div id="frm">
      <form action="checklogin.php" method="POST">
        <p>
          <label>Email:</label>
          <input type="text" placeholder="username" id="username" name="username"  />
        </p>
        <p>
          <label>Password:</label>
          <input type="text" placeholder="password" id="password" name="password"  />
        </p>
          <input class="btn btn-default btn-orange" type="submit" name="Submit" value="Login">

      </form>
    </div>

  </body>
</html>
