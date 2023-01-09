<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

if (isset($_SESSION["username"])) {header ("location:index.php");}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="Basic HTML elements"/>
	<meta name="keywords" content="HTML5, tags"/>
	<meta name="Adrian Wong Won Jie" content="Home"/>

	<title>Home</title>
	<link href="CSSfile/style.css" rel="stylesheet">
</head>

<body>
<?php include('include/navigator.php')?>

    <form method="POST" action="insert.php" style="margin-top:130px;margin-left:500px;">
     
              <label for="right-label" class="right inline">First Name</label>
            
              <input type="text" id="right-label" placeholder="eg. John" name="fname"> <br><br>
            
              <label for="right-label" class="right inline">Last Name</label>
            
              <input type="text" id="right-label" placeholder="eg. Doe" name="lname"><br><br>
            
              <label for="right-label" class="right inline">Address</label>
            
              <input type="text" id="right-label" placeholder="eg. Kuching 93350" name="address"> <br><br>
            
              <label for="right-label" class="right inline">City</label>
            
              <input type="text" id="right-label" placeholder="eg Kuching" name="city"> <br><br>
            
              <label for="right-label" class="right inline">Pin Code</label>
            
              <input type="number" id="right-label" placeholder="eg 400056" name="pin"> <br><br>
            
              <label for="right-label" class="right inline">E-Mail</label>
            
              <input type="email" id="right-label" placeholder="eg yourmail@mail.com" name="email"> <br><br>
            
              <label for="right-label" class="right inline">Password</label>
            
              <input type="password" id="right-label" name="pwd"> <br><br>
            

            
              <input type="submit" id="right-label" value="Register" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
              <input type="reset" id="right-label" value="Reset" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;"> <br><br>
            </div>
          </div>
        </div>
      </div>
    </form>


    <div class="row" style="margin-top:10px;">
      <div class="small-12">
<?php
	include ('include/footer.php');
?>
      </div>
    </div>

  </body>
  </html>