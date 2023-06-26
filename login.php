<?php 

session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>

<body><form action="/events/menu.php" method="post">
  <p>Welcome to the BY's Registration System </p>
  <p>Please enter the password:</p>
  <p>
    <input name="password" type="password" id="password"  required>
    <br>
    <input type="submit" value="Submit">
  </p>
</form>

</body>
</html>
