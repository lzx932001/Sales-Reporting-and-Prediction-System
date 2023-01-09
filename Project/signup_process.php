<?php
//if signup is clicked
if(isset($_POST["signup"])){
  //create connection to  DB
  $conn = mysqli_connect("localhost","root", "", "phpreps");

  //sql to create a default account for testing
  $user = $_POST["username"];
  $psw = $_POST["password"];
  $role = $_POST["role"];
  $sql = "INSERT INTO useraccount
          (username, password, role)
          VALUES ('$user', '$psw', '$role')";

  //create user
  if(mysqli_query($conn, $sql)) {
    echo '<script> ';
    echo '  if (confirm("Signup Successfully. Back to Login Page")) {';
    echo '    document.location = "login_page.php";';
    echo '  }';
    echo '</script>';
    //close connection
    mysqli_close($conn);
  }
}
 ?>
