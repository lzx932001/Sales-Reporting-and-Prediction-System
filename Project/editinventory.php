<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Update inventory</title>
</head>
<?php include("include/header.php");?>

<body>
    <section>
        <h2>Edit Product</h2>

<?php
include "conn.php";

if(!isset($_GET["id"]))
{
    mysqli_close($conn);
    header("location:inventorymodule.php");
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * 
                                FROM (product INNER JOIN category
                                ON product.category_id=category.category_id
                                INNER JOIN inventory
                                ON product.product_id=inventory.product_id)
                                WHERE product.product_id='$id';
");

$data = mysqli_fetch_array($query);

echo "<form method='POST' action='editinventoryprocess.php'>";
echo "<fieldset>";
echo "<legend>Edit inventory</legend>";

echo "<div>";
echo "<label for='cat' style='width:500px;'>Category:&nbsp$data[5]</label>";
echo "<input type='hidden' id='cat' name='cat' value='$data[5]'>"  ;    
echo "</div>";

echo "<div>";
echo "<label for='product' style='width:500px;'>Product:&nbsp$data[1] </label> ";
echo "<input type='hidden' id='pname' name='pname' value='$data[1]'>"  ; 
echo "</div>";

echo "<div>";
echo "<label for='quantity'>Quantity: </label>";         ;
echo "<input type='text' id='quantity' name='quantity' value='$data[7]'>"  ;       
echo "</div>";
         
echo "<div>";
echo "<label for='quantity'>Per Unit Price: </label> ";
echo " <input type='text' id='price' name='price' value='$data[3]'>";         
echo "</div>";     

echo "<input type='hidden' name='id' value='$id'>"  ;  
     
echo "<div>";
echo "<input type='submit' name='update' value='Update'>";
echo "</div>";

echo "</fieldset>";        
     
?>

        </form>
    </section>
</body>
<?php include("include/footer.php");?>
</html>


