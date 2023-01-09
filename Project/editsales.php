<?php
include "conn.php";

$id = $_GET['id'];

$query = "SELECT `sales`.`sales_id`, `category`.`category_name`, `product`.`product_id`, `product`.`product_name`,`sales_list`.`quantity`, `product`.`price`, `sales_list`.`quantity`*`product`.`price` AS `total`, `sales`.`date` 
FROM (((`sales_list`
INNER JOIN `sales` ON `sales_list`.`sales_id`=`sales`.`sales_id`)
INNER JOIN `product` ON `sales_list`.`product_id`=`product`.`product_id`)
INNER JOIN `category` on `product`.`category_id`=`category`.`category_id`) WHERE `sales`.`sales_id`='$id'";

$result = @mysqli_query($conn, $query);

$data = mysqli_fetch_array($result);

if(isset($_POST['update']))
{
    $product = $_POST['cat'];
    $qty = $_POST['quantity'];
    $date = $_POST['date'];

    $product_data = explode(",", $product);
    $category_id = $product_data[0];
    $product_id = $product_data[1];
    echo "Product ID: ".$product_id."<br>";
    
    $query = "SELECT * FROM sales_list WHERE sales_id = '$id'";
    $result1 = @mysqli_query($conn, $query);
    $data1 = @mysqli_fetch_assoc($result1);
    $previous_qty = (int)$data1['quantity'];
    echo "Previous qty: ".$previous_qty;

    $edit = mysqli_query($conn, "UPDATE `sales` SET `date`='$date' WHERE `sales_id`='$id'");
    $edit2 = mysqli_query($conn, "UPDATE `sales_list` SET `product_id`='$product_id', `quantity`='$qty' WHERE `sales_id` = $id;");

    $query = "SELECT * FROM sales_list WHERE product_id = '$product_id'";
    $result1 = @mysqli_query($conn, $query);
    $data1 = @mysqli_fetch_assoc($result1);
    $updated_qty = (int)$data1['quantity'];
    echo "<br>Updated qty: ".$updated_qty;
    
    $change = abs($updated_qty - $previous_qty);
    echo "<br>Change ".$change."<br>";

    $query = "SELECT * FROM inventory WHERE product_id = '$product_id'";
    $result1 = @mysqli_query($conn, $query);
    $inv_data = @mysqli_fetch_assoc($result1);
    $stock = $inv_data['stock'];

    if($previous_qty > $updated_qty){
        $stock = $stock + $change;
    }else{
        $stock = $stock - $change;
    }

    $query = "UPDATE inventory SET stock = '$stock' WHERE product_id = '$product_id'";
    @mysqli_query($conn, $query) or die('Not updated');

    if($edit && $edit2)
    {
        mysqli_close($conn);
        header("location:salesmodule.php");
    }
    else
    {
        echo mysqli_error();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Update Sales</title>
</head>

<?php include("include/header.php");?>
<body>
    <section class="edit_sales_container">
        <h2>Edit Sales</h2>
        
        <form method="POST" id="edit_form">
            <fieldset>
                <legend>Edit sales</legend>
        
                <div>
                    <label for="id">Sales Id: </label>
                    <p style="display:inline;"><?php echo $data['sales_id'] ?></p>
                </div>
        
                <div>
                    <label for="cat">Product: </label>
                    <select id="cat" name="cat">
                        <optgroup label="Health">
                        <option value="1,1" <?php if($data['product_id'] == 1){echo "selected";}?>>Vitamins</option>
                        <option value="1,2" <?php if($data['product_id'] == 2){echo "selected";}?>>First Aid</option>
                        <option value="1,3" <?php if($data['product_id'] == 3){echo "selected";}?>>Face Masks & Gloves</option>
                        <option value="1,4" <?php if($data['product_id'] == 4){echo "selected";}?>>Eye & Ear Care</option>
                        <optgroup label="Personal Care">
                        <option value="2,5" <?php if($data['product_id'] == 5){echo "selected";}?>>Hand Wash & Sanitizer</option>
                        <option value="2,6" <?php if($data['product_id'] == 6){echo "selected";}?>>Bath Care</option>
                        <option value="2,7" <?php if($data['product_id'] == 7){echo "selected";}?>>Feminine Care</option>
                        <option value="2,8" <?php if($data['product_id'] == 8){echo "selected";}?>>Oral Care</option>
                        <optgroup label="Cosmetics">
                        <option value="3,9" <?php if($data['product_id'] == 9){echo "selected";}?>>Cotton</option>
                        <option value="3,10" <?php if($data['product_id'] == 10){echo "selected";}?>>Fragance</option>
                        <option value="3,11" <?php if($data['product_id'] == 11){echo "selected";}?>>Face</option>
                        <option value="3,12" <?php if($data['product_id'] == 12){echo "selected";}?>>Lips</option>
                        <optgroup label="Baby Care">
                        <option value="4,13" <?php if($data['product_id'] == 13){echo "selected";}?>>Baby Daipers</option>
                        <option value="4,14" <?php if($data['product_id'] == 14){echo "selected";}?>>Baby Food</option>
                        <option value="4,15" <?php if($data['product_id'] == 15){echo "selected";}?>>Baby Wipes</option>
                    </select>
                </div>
        
                <div>
                    <label for="quantity">Quantity: </label> 
                    <input type="text" id="quantity" name="quantity" value="<?php echo $data['quantity'];?>">
                </div>
        
                <div>
                    <label for="total">Total: </label> 
                    <p style="display:inline;"><?php echo $data['total'] ?></p>
                </div>
        
                <div>
                    <label for="date">Date: </label> 
                    <input type="date" name="date" id="date" value="<?php echo $data['date'];?>">
                </div>
        
                <div>
                    <input type="submit" name="update" value="Update">
                </div>
        
            </fieldset>
        </form>
    </section>
</body>
<?php include("include/footer.php");?>
</html>


