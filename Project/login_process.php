<?php

//check if login button is clicked, go to login page if not login
if(isset($_POST["login"])){

//get username and password keyed in from login page
$username = $_POST["usrName"];
$password = $_POST["psw"];

//connect to useraccount DB and prepare for checking
$conn = mysqli_connect("localhost","root", "", "phpsreps");
$query = "SELECT * FROM useraccount WHERE username=?;";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $query)){
  header("Location:login_page.php");
  exit();
} else {
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);

  //check password
  if($row = mysqli_fetch_assoc($result)){
    $pwdCheck = $row['password'] == $password;

    if($pwdCheck == false){
      echo '<script> ';
      echo '  if (confirm("Wrong Password. Back to Login")) {';
      echo '    document.location = "login_page.php";';
      echo '  }';
      echo '</script>';
    }
    else if($pwdCheck == true){
      session_start();
      $_SESSION["login_status"] = true;
      $_SESSION["role"] = $row["role"];
      header("Location:dashboard.php"); //access granted
      exit();
    }
  }
  else{
    header("Location:login_page.php");
    exit();
  }
}
} 

?>
