<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div id="frm">
      <form action="process.php" method="POST">
        <p>
          <label>Email:</label>
          <input type="text" id="email" name="email"  />
        </p>
        <p>
          <label>Full Name:</label>
          <input type="text" id="name" name="name"  />
        </p>
        <p>
          <label>Password:</label>
          <input type="password" id="pass" name="pass"  />
        </p>
        <p>
          <label>Phone:</label>
          <input type="text" id="phone" name="phone"  />
        </p>
        <p>
          <input type="submit" id="sign" value="Sign Up"  />
        </p>
      </form>
    </div>

  </body>
</html>
