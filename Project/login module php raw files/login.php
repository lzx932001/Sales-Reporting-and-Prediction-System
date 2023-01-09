<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

if(isset($_SESSION["username"])){

        header("location:index.php");
}

?>
<?php
	require 'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="Basic HTML elements"/>
	<meta name="keywords" content="HTML5, tags"/>
	<meta name="Adrian Wong Won Jie" content="Home"/>

	<title>Login</title>
	<link href="CSSfile/style.css" rel="stylesheet">
</head>

<body>
<?php include('include/navigator.php')?>

	<form method="POST" action="verify.php" style="margin-top:40px;margin-left:500px">
		<label for="right-label" class="right inline">Email</label>
		<input type="email" id="right-label" placeholder="yourmail@mail.com" name="username"> <br><br>
		<label for="right-label" class="right inline">Password</label>
		<input type="password" id="right-label" name="pwd"> <br><br>
		<input type="submit" id="right-label" value="Login" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
		<input type="reset" id="right-label" value="Reset" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
	</form>
<?php
	include ('include/footer.php');
?>


  </body>
  </html>