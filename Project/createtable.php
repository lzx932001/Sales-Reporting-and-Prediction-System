<?php
    include "conn.php";

    $sql = "CREATE TABLE IF NOT EXISTS`category`(
        `category_id` int(8) NOT NULL,
        `category_name` varchar(50) NOT NULL,
        PRIMARY KEY(`category_id`)
      );
      
      CREATE TABLE IF NOT EXISTS`product`(
        `product_id` int(8) NOT NULL,
        `product_name` varchar(100) NOT NULL,
        `category_id` int(8) NOT NULL,
        `price` DECIMAL(10,2) NOT NULL,
        PRIMARY KEY (`product_id`) ,
        FOREIGN KEY (`category_id`) REFERENCES `category`(`category_id`)
      );
      
      CREATE TABLE IF NOT EXISTS`inventory`(
        `product_id` int(8) NOT NULL,
        `stock` int(10) NOT NULL,
        PRIMARY KEY(`product_id`),
        FOREIGN KEY (`product_id`) REFERENCES `product`(`product_id`)
      );
      
      CREATE TABLE IF NOT EXISTS`sales` (
        `sales_id` int(8) NOT NULL AUTO_INCREMENT,
        `date` varchar(20) NOT NULL,
        PRIMARY KEY (`sales_id`)
      );
      
      CREATE TABLE IF NOT EXISTS`sales_list`(
        `sales_id` int(8) NOT NULL AUTO_INCREMENT,
        `product_id` int(8) NOT NULL,
        `quantity` int(8) NOT NULL,
        PRIMARY KEY(`sales_id`, `product_id`),
        FOREIGN KEY (`sales_id`) REFERENCES `sales`(`sales_id`),
        FOREIGN KEY (`product_id`) REFERENCES `product`(`product_id`)
      );

      CREATE TABLE IF NOT EXISTS`months`(
        `month_number` int(11),
        `month_name` varchar(20)
      );

      ALTER TABLE `sales` AUTO_INCREMENT=100;
      ALTER TABLE `sales_list` AUTO_INCREMENT=100;

    ";

    mysqli_multi_query($conn, $sql);

    mysqli_close($conn);

    include "conn.php";

    $insert = "INSERT INTO `category`(`category_id`, `category_name`) 
    VALUES 
    (1,'Health'),
    (2,'Personal Care'),
    (3,'Cosmetics'),
    (4,'Baby Care');
    
    INSERT INTO `product`(`product_id`, `product_name`, `category_id`, `price`) 
    VALUES 
    (1,'Vitamins',1,5),
    (2,'First Aid',1,6),
    (3,'Face Mask',1,7),
    (4,'Eye & Ear Care',1,8),
    (5,'Hand Wash',2,9),
    (6,'Bath Care',2,7),
    (7,'Feminine Care',2,4),
    (8,'Oral Care',2,6),
    (9,'Cotton',3,5),
    (10,'Fragance',3,7),
    (11,'Face',3,9),
    (12,'Lips',3,10),
    (13,'Baby Daipers',4,8),
    (14,'Baby Food',4,11),
    (15,'Baby Wipes',4,5);
    
    INSERT INTO `inventory`(`product_id`, `stock`) 
    VALUES
    (1, 20),
    (2, 20),
    (3, 20),
    (4, 20),
    (5, 20),
    (6, 20),
    (7, 20),
    (8, 20),
    (9, 20),
    (10, 20),
    (11, 20),
    (12, 20),
    (13, 20),
    (14, 20),
    (15, 20);";

    mysqli_multi_query($conn, $insert);

    mysqli_close($conn);
?>
