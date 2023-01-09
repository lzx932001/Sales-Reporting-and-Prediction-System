<?php
    include "conn.php";

    $id = $_GET['id'];

    $sql = "DELETE FROM `sales_list` WHERE `sales_id` = $id;";
    $sql .= "DELETE FROM `sales` WHERE `sales_id`=$id;";
    // echo "<script type='text/javascript'>";
    // echo "var result; if(confirm('Are you sure you want to delete sales $id?'){result='true'}else{result='false'} document.getElementById('result').innerHTML = result);";
    // echo "</script>";
    if(mysqli_multi_query($conn, $sql)){
        echo "Record deleted successfully";
        header("location:salesmodule.php");
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>
