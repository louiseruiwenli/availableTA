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
      <form action="process.php" method="POST">
        <p>
          <label>Email:</label>
          <input type="text" placeholder="username" id="email" name="email"  />
        </p>
        <p>
          <label>Password:</label>
          <input type="text" placeholder="password" id="password" name="password"  />
        </p>
          <button type="button" onclick="login();" id="login">Login</button>

      </form>
    </div>

  </body>
</html>
