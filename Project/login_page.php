<!DOCTYPE html>
<html lang="en">
<head>
  <title> People Health Pharmacy </title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style/style.css" type="text/css" />
  <meta name="author" content="" />
</head>
<body class="login_page" onload="startTime()">
<div id="txt"></div>

<script>
function startTime() {
  const today = new Date();
  let h = today.getHours();
  let m = today.getMinutes();
  let s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
  setTimeout(startTime, 1000);
}

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>

<!-- login form -->
<form id="loginForm" method="post" action="login_process.php">
    <h2>Login</h2>
      <label for="username">Username&#58;</label>
      <input id="username" type="text" name="usrName" value="admin" />
    </p>
    <p>
      <label for="password">Password&#58;</label>
      <input id="password" type="password" name="psw" value="admin" />
    </p>
    <input type="submit" value="login" name="login" id="Login_button"/>
    <p>default account <br/> username: admin <br /> password: admin <br/><br />
      *Login to signup for new user.
    </p>

  </form>

   <!-- CREATE DB & DEFAULT ACCOUNT -->
   <?php
    //create connection server to create DB
    $conn = mysqli_connect("localhost", "root", "");

    //create DB
    $sql = "CREATE DATABASE phpsreps";
    @mysqli_query($conn, $sql);

    //close connection
    mysqli_close($conn);

    //create connection to DB
    $conn = mysqli_connect("localhost","root", "", "phpsreps");

    //sql to create useraccount table
    $sql = "CREATE TABLE useraccount (
    username VARCHAR(15) NOT NULL UNIQUE PRIMARY KEY,
    password CHAR(40) NOT NULL,
    role INT NOT NULL
    )";

    //create table
    mysqli_query($conn, $sql);

    //close connection
    mysqli_close($conn);

    //create connection to DB
    $conn = mysqli_connect("localhost","root", "", "phpsreps");

    //sql to create a default account for testing
    $user = "admin";
    $psw = "admin";
    $sql = "INSERT INTO useraccount
            (username, password, role)
            VALUES ('admin', 'admin', 0)";

    if(mysqli_query($conn, $sql)) {
    echo "Successfully create default account <br /> username: admin <br /> password: admin";
    }

    ?>
</body>
</html>