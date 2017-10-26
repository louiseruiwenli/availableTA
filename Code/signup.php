<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login Page</title>
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
