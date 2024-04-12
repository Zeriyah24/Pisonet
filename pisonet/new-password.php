<!DOCTYPE html>
<html>
<head>
    <title>New Password</title>
    <link rel="stylesheet" type="text/css" href="new.css">
</head>
<body>

<div id="login-container">
    <h1>New Password</h1>

    <form action="login.php" method="post">
      <label for="currentpassword">Current Password:</label><br>
      <input type="text" id="currentpassword" name="currentpassword"><br><br>
        <label for="newpassword">NewPassword:</label><br>
        <input type="text" id="newpassword" name="newpassword"><br>
        <br>
        <input type="submit" value="Submit">
    </form>

</div>

</body>
</html>
