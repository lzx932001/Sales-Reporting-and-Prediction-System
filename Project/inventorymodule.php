<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="keywords" content="HTML5, tags"/>
    <title>inventory module</title>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    
</head>


<body>
<?php 
include("include/header.php");
?>

<aside>
<div>
<form action="inventorymodule.php">
    <fieldset>
        <legend>Filter Panel</legend>
        
        <label for="cat" >Search by:</label>
        <select id="cat" name="cat">
            <option value="" disabled selected>Search by</option>
            <option value="name">Product Name</option>
            <option value="category">Categories</option>
        </select><br><br>

        <!-- option 1 -->
        <div id="nameDiv" class="hide">
            <label for="pname">Product Name:</label><br>
            <input type="text" id="pname" name="pname"><br>
        </div>
        
        <!-- option 2 -->
        <div id="catDiv" class="hide">
            <label for="pname">Product Categories:</label><br>
            <select name="name" id="name">
                <option value="" disabled selected>Select Categories</option>
                <option value="All">All</option>
                <option value="Health">Health</option>
                <option value="Personal Care">Personal Care</option>
                <option value="Cosmetics">Cosmetics</option>
                <option value="Baby Care">Baby Care</option>
            </select>
        </div>

        <label for="order">Product Order:</label>
        <select id="product_order" name="product_order">
        <option value="" disabled selected>Select Order</option>
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
        </select><br><br>

        <label for="order">Price Order:</label>
        <select id="price_order" name="price_order">
        <option value="" disabled selected>Select Order</option>
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
        </select><br><br>

     <input type="submit" value="Submit">
    </fieldset>
   </form>
</div>
</aside>

<section class="inventory_section">
<h2>Inventory Table</h2>
<?php 
include "conn.php";

if(!isset($_GET['cat']))
{
    // without search or search submitted without search by selection

    echo "<div>";
    echo "<table style='border:2;\'>";
    echo "<tr>";
    echo "<th>Category</th>";
    echo "<th>Product</th>";
    echo "<th>Quantity</th>";
    echo "<th>Per unit price</th>";
    echo "<th colspan='2'>Action</th>";

    echo "</tr>";
    echo "</table>";
    echo "</div>";
}
else
{
    // if search with selection
    $cat = $_GET['cat'];

    if($cat == "name")
    {
        $pname = $_GET['pname'];      

        if($pname == "")
        {
            // if no product name is keyed in
            echo "<div>";
            echo "<table style='border:2;\'>";
            echo "<tr>";
            echo "<th>Category</th>";
            echo "<th>Product</th>";
            echo "<th>Quantity</th>";
            echo "<th>Per unit price</th>";
            echo "<th colspan='2'>Action</th>";
        
            echo "</tr>";
            echo "</table>";
            echo "</div>";
        }
        elseif (isset($_GET['product_order']))
        {
            $product_order = $_GET['product_order'];

            // if there is product name
            $query = mysqli_query($conn, "SELECT * 
                                            FROM (product INNER JOIN category
                                            ON product.category_id=category.category_id
                                            INNER JOIN inventory
                                            ON product.product_id=inventory.product_id)
                                            WHERE product.product_name LIKE'%$pname%'
                                            ORDER BY product.product_name $product_order;
                                ");

            echo "<div>";
            echo "<table style='border:2;\'>";
            echo "<tr>";
            echo "<th>Category</th>";
            echo "<th>Product</th>";
            echo "<th>Quantity</th>";
            echo "<th>Per unit price</th>";
            echo "<th colspan='2'>Action</th>";
            echo "</tr>";

            while ($data = mysqli_fetch_array($query)) 
            {         
            echo "<tr>";
            echo "<td>$data[5]</td>";
            echo "<td>$data[1]</td>";
            echo "<td>$data[7]</td>";
            echo "<td>$data[3]</td>";
            echo "<td><a href='editinventory.php?id=$data[0]' name='id'>Edit</a></td>";
            echo "</tr>";
            }

            echo "</table>";
            echo "</div>";
        }
        elseif (isset($_GET['price_order']))
        {
            $price_order = $_GET['price_order'];

            $query = mysqli_query($conn, "SELECT * 
                                        FROM (product INNER JOIN category
                                        ON product.category_id=category.category_id
                                        INNER JOIN inventory
                                        ON product.product_id=inventory.product_id)
                                        WHERE product.product_name LIKE'%$pname%'
                                        ORDER BY product.price $price_order;
                                        ");
            
            echo "<div>";
            echo "<table style='border:2;\'>";
            echo "<tr>";
            echo "<th>Category</th>";
            echo "<th>Product</th>";
            echo "<th>Quantity</th>";
            echo "<th>Per unit price</th>";
            echo "<th colspan='2'>Action</th>";
            echo "</tr>";

            while ($data = mysqli_fetch_array($query)) 
            {         
                echo "<tr>";
                echo "<td>$data[5]</td>";
                echo "<td>$data[1]</td>";
                echo "<td>$data[7]</td>";
                echo "<td>$data[3]</td>";
                echo "<td><a href='editinventory.php?id=$data[0]' name='id'>Edit</a></td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "</div>";
        }
        else
        {
            $query = mysqli_query($conn, "SELECT * 
                                            FROM (product INNER JOIN category
                                            ON product.category_id=category.category_id
                                            INNER JOIN inventory
                                            ON product.product_id=inventory.product_id)
                                            WHERE product.product_name LIKE'%$pname%';
                                            ");
                
                echo "<div>";
                echo "<table style='border:2;\'>";
                echo "<tr>";
                echo "<th>Category</th>";
                echo "<th>Product</th>";
                echo "<th>Quantity</th>";
                echo "<th>Per unit price</th>";
                echo "<th colspan='2'>Action</th>";
                echo "</tr>";

                while ($data = mysqli_fetch_array($query)) 
                {         
                    echo "<tr>";
                    echo "<td>$data[5]</td>";
                    echo "<td>$data[1]</td>";
                    echo "<td>$data[7]</td>";
                    echo "<td>$data[3]</td>";
                    echo "<td><a href='editinventory.php?id=$data[0]' name='id'>Edit</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "</div>";
        }   
    }

    if($cat == "category")
    {
        // if search selection is category
        if(!isset($_GET['name']))
        {
            // if no category is selected
            echo "<div>";
            echo "<table style='border:2;\'>";
            echo "<tr>";
            echo "<th>Category</th>";
            echo "<th>Product</th>";
            echo "<th>Quantity</th>";
            echo "<th>Per unit price</th>";
            echo "<th colspan='2'>Action</th>";
        
            echo "</tr>";
            echo "</table>";
            echo "</div>";
        }
        elseif ($_GET['name'] == "All") 
        {
            // if category is selected
            $name = $_GET['name'];
            $product_order = "ASC";

            if(isset($_GET['product_order']))
            {
                $product_order = $_GET['product_order'];

                $query = mysqli_query($conn, "SELECT * 
                                            FROM (product INNER JOIN category
                                            ON product.category_id=category.category_id
                                            INNER JOIN inventory
                                            ON product.product_id=inventory.product_id)
                                            ORDER BY product.product_name $product_order;
                                            ");

            echo "<div>";
            echo "<table style='border:2;\'>";
            echo "<tr>";
            echo "<th>Category</th>";
            echo "<th>Product</th>";
            echo "<th>Quantity</th>";
            echo "<th>Per unit price</th>";
            echo "<th colspan='2'>Action</th>";
            echo "</tr>";

            while ($data = mysqli_fetch_array($query)) 
            {         
                echo "<tr>";
                echo "<td>$data[5]</td>";
                echo "<td>$data[1]</td>";
                echo "<td>$data[7]</td>";
                echo "<td>$data[3]</td>";
                echo "<td><a href='editinventory.php?id=$data[0]' name='id'>Edit</a></td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "</div>";
            }
            elseif(isset($_GET['price_order']))
            {
                $price_order = $_GET['price_order'];

                $query = mysqli_query($conn, "SELECT * 
                                            FROM (product INNER JOIN category
                                            ON product.category_id=category.category_id
                                            INNER JOIN inventory
                                            ON product.product_id=inventory.product_id)
                                            ORDER BY product.price $price_order;
                                            ");
                
                echo "<div>";
                echo "<table style='border:2;\'>";
                echo "<tr>";
                echo "<th>Category</th>";
                echo "<th>Product</th>";
                echo "<th>Quantity</th>";
                echo "<th>Per unit price</th>";
                echo "<th colspan='2'>Action</th>";
                echo "</tr>";

                while ($data = mysqli_fetch_array($query)) 
                {         
                    echo "<tr>";
                    echo "<td>$data[5]</td>";
                    echo "<td>$data[1]</td>";
                    echo "<td>$data[7]</td>";
                    echo "<td>$data[3]</td>";
                    echo "<td><a href='editinventory.php?id=$data[0]' name='id'>Edit</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "</div>";
            }
            else 
            {
                $query = mysqli_query($conn, "SELECT * 
                                            FROM (product INNER JOIN category
                                            ON product.category_id=category.category_id
                                            INNER JOIN inventory
                                            ON product.product_id=inventory.product_id)
                                            ORDER BY product.product_name $product_order;
                                            ");
                
                echo "<div>";
                echo "<table style='border:2;\'>";
                echo "<tr>";
                echo "<th>Category</th>";
                echo "<th>Product</th>";
                echo "<th>Quantity</th>";
                echo "<th>Per unit price</th>";
                echo "<th colspan='2'>Action</th>";
                echo "</tr>";

                while ($data = mysqli_fetch_array($query)) 
                {         
                    echo "<tr>";
                    echo "<td>$data[5]</td>";
                    echo "<td>$data[1]</td>";
                    echo "<td>$data[7]</td>";
                    echo "<td>$data[3]</td>";
                    echo "<td><a href='editinventory.php?id=$data[0]' name='id'>Edit</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "</div>";
            }

            
        }
        else
        {
            // if category is selected
            $name = $_GET['name'];
            $product_order = "ASC";
            $price_order = "";

            if(isset($_GET['product_order']))
            {
                $product_order = $_GET['product_order'];

                $query = mysqli_query($conn, "SELECT * 
                                            FROM (product INNER JOIN category
                                            ON product.category_id=category.category_id
                                            INNER JOIN inventory
                                            ON product.product_id=inventory.product_id)
                                            WHERE category.category_name='$name'
                                            ORDER BY product.product_name $product_order;
                                            ");
                
                echo "<div>";
                echo "<table style='border:2;\'>";
                echo "<tr>";
                echo "<th>Category</th>";
                echo "<th>Product</th>";
                echo "<th>Quantity</th>";
                echo "<th>Per unit price</th>";
                echo "<th colspan='2'>Action</th>";
                echo "</tr>";

                while ($data = mysqli_fetch_array($query)) 
                {         
                    echo "<tr>";
                    echo "<td>$data[5]</td>";
                    echo "<td>$data[1]</td>";
                    echo "<td>$data[7]</td>";
                    echo "<td>$data[3]</td>";
                    echo "<td><a href='editinventory.php?id=$data[0]' name='id'>Edit</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "</div>";
            }
            elseif(isset($_GET['price_order']))
            {
                $price_order = $_GET['price_order'];

                $query = mysqli_query($conn, "SELECT * 
                                            FROM (product INNER JOIN category
                                            ON product.category_id=category.category_id
                                            INNER JOIN inventory
                                            ON product.product_id=inventory.product_id)
                                            WHERE category.category_name='$name'
                                            ORDER BY product.price $price_order;
                                            ");
                
                echo "<div>";
                echo "<table style='border:2;\'>";
                echo "<tr>";
                echo "<th>Category</th>";
                echo "<th>Product</th>";
                echo "<th>Quantity</th>";
                echo "<th>Per unit price</th>";
                echo "<th colspan='2'>Action</th>";
                echo "</tr>";

                while ($data = mysqli_fetch_array($query)) 
                {         
                    echo "<tr>";
                    echo "<td>$data[5]</td>";
                    echo "<td>$data[1]</td>";
                    echo "<td>$data[7]</td>";
                    echo "<td>$data[3]</td>";
                    echo "<td><a href='editinventory.php?id=$data[0]' name='id'>Edit</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "</div>";
            }
            else 
            {
                $query = mysqli_query($conn, "SELECT * 
                                            FROM (product INNER JOIN category
                                            ON product.category_id=category.category_id
                                            INNER JOIN inventory
                                            ON product.product_id=inventory.product_id)
                                            WHERE category.category_name='$name'
                                            ORDER BY product.product_name $product_order;
                                            ");
                
                echo "<div>";
                echo "<table style='border:2;\'>";
                echo "<tr>";
                echo "<th>Category</th>";
                echo "<th>Product</th>";
                echo "<th>Quantity</th>";
                echo "<th>Per unit price</th>";
                echo "<th colspan='2'>Action</th>";
                echo "</tr>";

                while ($data = mysqli_fetch_array($query)) 
                {         
                    echo "<tr>";
                    echo "<td>$data[5]</td>";
                    echo "<td>$data[1]</td>";
                    echo "<td>$data[7]</td>";
                    echo "<td>$data[3]</td>";
                    echo "<td><a href='editinventory.php?id=$data[0]' name='id'>Edit</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "</div>";
            }

            
        }
        
    }
}
?>
</section>
<?php include("include/footer.php");?>
<script src="js/main.js"></script>
</body>
</html>