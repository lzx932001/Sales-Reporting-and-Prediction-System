<?php
  session_start();
  if(!$_SESSION["login_status"] == true){
    header("Location:login_page.php");
  }
  include "conn.php";
  
  $sql = mysqli_query($conn, "SELECT * FROM sales");
  if(!$sql){
    include "createtable.php";
  }else{
    mysqli_close($conn);
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> PHP </title>
  <meta charset="utf-8" />
  <meta name="author" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	<header>
		<div class="navigationbar">
			<nav>
				<a id="logo" href="index.php">People Health Pharmacy</a>
				<div class="link">
          <a href="salesmodule.php">Sales</a>
          <a href="dashboard.php">Dashboard</a>
          <a href="inventorymodule.php">Inventory</a>
          <a href="analysismodule.php">Analysis</a>
          <a href="logout_process.php">Logout</a>
				</div>
			</nav>
		</div>
	</header>
</body>
</html>