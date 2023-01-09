<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="keywords" content="HTML5, tags"/>
    <title>Manage module</title>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
</head>

<?php include_once "include/header.php"; ?>

<body class="login_page">
  <br />
  <form id="loginForm" method="post" action="signup_process.php">
    <h2>Sign-up</h2>
    <p>
      <label for="username">Username&#58;</label>
      <input id="username" type="text" name="username" />
    </p>
    <p>
      <label for="password">Password&#58;</label>
      <input id="password" type="password" name="password" />
    </p>
    <p>
      <label for="role">Role&#58;</label>
      <select id="role" name="role">
        <option value=0>Admin</option>
        <option value=1>Staff</option>
      </select>
    </p>
    <input type="submit" value="signup" name="signup"/>
    </form>

</body>

</html>
