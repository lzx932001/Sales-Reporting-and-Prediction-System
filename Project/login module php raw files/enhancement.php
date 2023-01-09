

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="Basic HTML elements"/>
	<meta name="keywords" content="HTML5, tags"/>
	<meta name="Adrian Wong Won Jie" content="Home"/>

	<title>ENHANCEMENTS</title>
	<link href="CSSfile/style.css" rel="stylesheet">
</head>

<body>
<?php include('include/navigator.php')?>
<article>
	<h1 class="enhancement">ENHANCEMENTS</h1>
	<table class="enhancement">
	

	<table>
		<tr><td>1. Login- User can now login using email address and password.</td>
			<td><a href="login.php" class="link">SignIn</a></td>
		</tr>
		
		<tr><td>2. User can now register on the website.</td>
			<td><a href="register.php" class="link">SignUp</a></td>
		</tr>
		
		<tr><td>3. Only Admin can view "ALL ENQUIRIES" AND "ALL USERS" tabs on navigation once logged in.</td>
			<td><a href="index.php" class="link">Index</a></td>
		</tr>
		<tr><td>4. Admin can view information about all the users and remove user.</td>
			<td><a href="view_users.php" class="link">All Users</a></td>
		</tr>
		
		<tr><td>5. Admin can view information about all the enquiries and remove enquiry.</td>
			<td><a href="view_enquiries.php" class="link">All Enquiries</a></td>
		</tr>
	</table>
</table>

	</article>
	
<h2>Email address for admin: admin@huawei.com</h2>
<h2>Password for admin: 123</h2>

 <?php
	include ('include/footer.php');
?>


  </body>
  </html>