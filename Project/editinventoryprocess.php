<?php

if(isset($_POST["id"])){
    include "conn.php";

    $cat = $_POST["cat"];
    $pname = $_POST["pname"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $id = $_POST["id"];

    $edit = mysqli_query($conn, "UPDATE inventory SET stock=$quantity WHERE product_id=$id");
    $edit2 = mysqli_query($conn, "UPDATE product SET price=$price WHERE product_id=$id");
    if($edit && $edit2)
    {
        mysqli_close($conn);
        header("location:inventorymodule.php");
        exit;
    }
    else
    {
        echo mysqli_error();
    }
}
?>