<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="keywords" content="HTML5, tags"/>
    <title>Sales module</title>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
  </head>
  
  <?php include("include/header.php");?>
  <body>
  <section class="sales_section">
    <div>
      <h2>Sales table</h2>
      <table>
        <tr>
          <th>Sales ID</th>
          <th>Category</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Total</th>
          <th>Date</th>
          <th colspan="2">Action</th>
        </tr>
        <?php

        include "conn.php";
        $records = mysqli_query($conn, "SELECT sales.sales_id, category.category_name, product.product_name, sales_list.quantity, product.price, sales_list.quantity * product.price AS total, sales.date
        FROM (((sales_list
        INNER JOIN sales ON sales_list.sales_id=sales.sales_id)
        INNER JOIN product ON sales_list.product_id=product.product_id)
        INNER JOIN category on product.category_id=category.category_id) ORDER BY sales_id;"); // fetch data from database
          
        if($records){
          while($data = mysqli_fetch_array($records))
          {
        ?>
        <tr>
          <td><?php echo $data['sales_id']; ?></td>
          <td><?php echo $data['category_name']; ?></td>
          <td><?php echo $data['product_name']; ?></td>    
          <td><?php echo $data['quantity']; ?></td>    
          <td><?php echo $data['price']; ?></td>    
          <td><?php echo $data['total']; ?></td>    
          <td><?php echo $data['date']; ?></td>    
          <td><a href="editsales.php?id=<?php echo $data['sales_id']; ?>" name="edit">Edit</a></td>
          <td><a href="deletesales.php?id=<?php echo $data['sales_id']; ?>" name="delete">Delete</a></td>
        </tr>	
        <?php
          }
        }
        mysqli_close($conn);
        ?>
      </table>
    </div>
  </section>

  <aside>
    <div>
      <h2>Add sales</h2>
      <form action = "addsales.php" method="POST">
        <fieldset>
          <legend>Add sales</legend>

          <div>
            <label for="id">Sales Id: </label>
            <?php
              include "conn.php";
              
              $sql = mysqli_query($conn, "SELECT COUNT(*) AS Count FROM sales");
              $data = mysqli_fetch_array($sql);
              $count = $data['Count'];
              mysqli_close($conn);

              if($count >= 1){
                include "conn.php";

                $sql = mysqli_query($conn, "SELECT *FROM sales ORDER BY sales_id DESC LIMIT 1");
                $data = mysqli_fetch_array($sql);
                $id = $data['sales_id'] + 1;
                echo "<span>$id</span>"; 
                
                mysqli_close($conn);  
              }else{
                echo "<span>100</span>";   
              }

            ?>
          </div>

          <div>
            <label for="cat">Product: </label>
            <select id="cat" name="cat">
              <option value="" disabled selected>Select Product</option>
              <optgroup label="Health">
                <option value="1,1">Vitamins</option>
                <option value="1,2">First Aid</option>
                <option value="1,3">Face Masks & Gloves</option>
                <option value="1,4">Eye & Ear Care</option>
              <optgroup label="Personal Care">
                <option value="2,5">Hand Wash & Sanitizer</option>
                <option value="2,6">Bath Care</option>
                <option value="2,7">Feminine Care</option>
                <option value="2,8">Oral Care</option>
              <optgroup label="Cosmetics">
                <option value="3,9">Cotton</option>
                <option value="3,10">Fragance</option>
                <option value="3,11">Face</option>
                <option value="3,12">Lips</option>
              <optgroup label="Baby Care">
                <option value="4,13">Baby Daipers</option>
                <option value="4,14">Baby Food</option>
                <option value="4,15">Baby Wipes</option>
            </select>
          </div>

          <div>
            <label for="quantity">Quantity: </label> 
            <input type="number" id="quantity" name="quantity" value="1">
          </div>
          
          <div>
            <label for="date">Date: </label> 
            <input type="date" name="date" id="date" value="<?php date_default_timezone_set('Asia/Kuching'); echo date('Y-m-d');?>">
          </div>

          <div>
            <input type="submit" value="Submit">
          </div>

        </fieldset>
      </form>
    </div>
  </aside>
  <?php include("include/footer.php");?>
</body>
</html>

