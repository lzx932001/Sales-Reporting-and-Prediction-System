<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <title>Analysis Module</title>
</head>

<body>
    <?php include("include/header.php");?>

    
    <?php
    include ('conn.php');
    
    // creating the folders to store the csv files
    $sales_folder = "../sales_records";
    if(!file_exists($sales_folder)){
        mkdir($sales_folder);
    }

    $category_folder = $sales_folder.'/Category';
    if(!file_exists($category_folder)){
        mkdir($category_folder);
    }

    $product_folder = $sales_folder.'/Product';
    if(!file_exists($product_folder)){
        mkdir($product_folder);
    }
    ?>

    <section id="product_chart">
        <div class="chart_container">
            <div class="chart-container" style="position: relative; height:80vh; width:70vw; ">
                <canvas id="myChart" width="500" height="200"></canvas>
                <select style="margin-top:1rem;" name="select" id="select">
                    <option value="" disabled hidden selected>Select Product</option>

                    <?php
                    $query = "SELECT product_id, product_name FROM product";
                    $result = $conn->query($query);
                    $rows = $result->fetch_assoc();
                    while($rows){  
                    ?>
                    
                    <option <?php if(isset($_GET['item'])){if($_GET['item'] == $rows['product_id']){ echo "selected";}}?> value="<?php echo $rows['product_id']?>"><?php echo $rows['product_name']?></option>
                    
                    <?php
                    $rows = $result->fetch_assoc();
                    }
                    ?>
                    
                </select>
                <br><br>
                <button class ="button1" onclick="window.print()">Print this page</button>
                <form class="csv_download_form" method="POST">
                    <input class ="button1" type="submit" value="Generate CSV" name="product_csv">
                </form>

            </div>  
        </div>

    </section>

    <section id="category_chart">
        <div class="chart_container">
            <div class="chart-container" style="position: relative; height:80vh; width:70vw; ">
                <canvas id="myChart2" width="500" height="200"></canvas>
                <select style="margin-top:1rem;" name="select2" id="select2">
                    <option value="" disabled hidden selected>Select Category</option>
                    <?php
                        $conn = @mysqli_connect("localhost", "root", "", "phpsreps");
                        $query = "SELECT category_id, category_name FROM category";
                        $result = $conn->query($query);
                        $rows = $result->fetch_assoc();
                        while($rows){
                    ?>
                    <option <?php if(isset($_GET['category'])){if($_GET['category'] == $rows['category_id']){ echo "selected";}}?> value="<?php echo $rows['category_id']?>"><?php echo $rows['category_name']?></option>
                    <?php
                        $rows = $result->fetch_assoc();
                        }
                    ?>
                </select>
                <br><br>
                <button class ="button1" onclick="window.print()">Print this page</button>
                <form class="csv_download_form" method="POST">
                    <input class ="button1" type="submit" value="Generate CSV" name="category_csv">
                </form>
            </div>  
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php
    $m = array("January", "February", "March", "April" ,"May", "June", "July", "August", "September", "October", "November", "December");

    // check if the item variable is set
    if(isset($_GET['item'])){
        $item = $_GET['item'];
    }else{
        $item = 1;
    }

    $query = "SELECT monthname(sales.date) AS month, product.product_name, SUM(sales_list.quantity) AS total FROM ((sales JOIN sales_list ON sales.sales_id = sales_list.sales_id) JOIN product ON sales_list.product_id = product.product_id) WHERE product.product_id = '$item' GROUP BY monthname(sales.date) ORDER BY  month(sales.date)";
    $result = $conn->query($query) or die("Unable to execute query");
    $num_rows = mysqli_num_rows($result);
    $rows = $result->fetch_array();
    $total = array();
    $months = array();

    $temp_total = array();

    if($num_rows < 1){
        $query = "SELECT * FROM product WHERE product_id = '$item'";
        $result = @mysqli_query($conn, $query);
        $rows = $result->fetch_array();
        $product_name =  $rows['product_name'];
    }else{
        while($rows){
            if($rows['month'])
            array_push($months, $rows['month']);
            array_push($total, (int)$rows['total']);
            $product_name = $rows['product_name'];
            $rows = $result->fetch_assoc();
        }
    }

    $index = 0;
    foreach($m as $j){

        if(sizeof($months) > 0){
            if($j == $months[$index]){
                array_push($temp_total, $total[$index]);

                if($index < sizeof($months)-1){
                    $index++;
                }

            }else{
                array_push($temp_total, 0);
            }
        }else{
            array_push($temp_total, 0);
        }
    }

    $working_data = array(
        $m,
        $temp_total
    );

    if(isset($_POST['product_csv'])){
        $filename = $product_folder.'/'.$product_name.'_monthly_sales.csv';
        $f = fopen($filename, 'w') ;

        foreach ($working_data as $row) {
            fputcsv($f, $row);   
        }

        fclose($f);
    }
    ?>

    <script>
        // selecting the select select input
        const select  = document.getElementById("select");

        // add change listener to the select input
        select.addEventListener("change", function(){
            window.location.href = "analysismodule.php?item=" + select.value + "&category=1#product_chart";
        })

        const name = <?php echo json_encode($product_name);?>;
        const total = <?php echo json_encode($temp_total);?>;
        const months = <?php echo json_encode($m);?>;
        const ctx = document.getElementById('myChart').getContext('2d');

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Total Sales',
                    data: total,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 20
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        fullSize: false,
                        text: name,
                        size: 100,
                        font: {
                            size: 25
                        }
                    }
                }
            }
        });
    </script>

    <?php
    if(isset($_GET['category'])){
        $category = $_GET['category'];
    }else{
        $category = 1;
    }

    $query = "SELECT monthname(sales.date) AS month, category.category_name, SUM(sales_list.quantity) AS total FROM (((sales JOIN sales_list ON sales.sales_id = sales_list.sales_id) JOIN product ON sales_list.product_id = product.product_id) JOIN category ON product.category_id = category.category_id) WHERE category.category_id = '$category' GROUP BY month ORDER BY month(sales.date)";
    $result = $conn->query($query) or die("Unable to execute query");
    $num_rows = mysqli_num_rows($result);
    $rows = $result->fetch_array();
    $total = array();
    $months = array();

    $temp_total = array();

    if($num_rows < 1){
        $query = "SELECT * FROM category WHERE category_id = '$category'";
        $result = @mysqli_query($conn, $query);
        $rows = $result->fetch_array();
        $category_name = $rows['category_name'];
    }else{
        while($rows){
            if($rows['month'])
            array_push($months, $rows['month']);
            array_push($total, (int)$rows['total']);
            $category_name = $rows['category_name'];
            $rows = $result->fetch_assoc();
        }
    }

    $index = 0;
    foreach($m as $j){
        if(sizeof($months) > 0){
            if($j == $months[$index]){
                array_push($temp_total, $total[$index]);

                if($index < sizeof($months)-1){
                    $index++;
                }
            }else{
                array_push($temp_total, 0);
            }
        }else{
            array_push($temp_total, 0);
        }
    }

    $working_data1 = array(
        $m,
        $temp_total
    );

    if(isset($_POST['category_csv'])){

        $filename = $category_folder.'/'.$category_name.'_monthly_sales.csv';
        $f = fopen($filename, 'w') ;

        foreach ($working_data1 as $row) {
            fputcsv($f, $row);   
        }

        fclose($f);
    }
    ?>

    <script>
        // selecting the select select input
        const select2  = document.getElementById("select2");

        // add change listener to the select input
        select2.addEventListener("change", function(){
            window.location.href = "analysismodule.php?item=1&category=" + select2.value + "#category_chart";
        })

        const category_name = <?php echo json_encode($category_name);?>;
        const category_total = <?php echo json_encode($temp_total);?>;
        const category_months = <?php echo json_encode($m);?>;
        const ctx2 = document.getElementById('myChart2').getContext('2d');

        const myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: category_months,
                datasets: [{
                    label: 'Total Sales',
                    data: category_total,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 20
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        fullSize: false,
                        text: category_name,
                        size: 100,
                        font: {
                            size: 25
                        }
                    }
                }
            }
        });
    </script>

    <section id="sales_table">
        <div>
            <h2>Sales table</h2>
            <div>
                <table>
                    <tr>
                        <th>Sales ID</th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                        <th>Date</th>
                    </tr>

                    <?php
                    $records = mysqli_query($conn, "SELECT sales.sales_id, category.category_name, product.product_name, sales_list.quantity, product.price, sales_list.quantity * product.price AS total, sales.date
                    FROM (((sales_list
                    INNER JOIN sales ON sales_list.sales_id=sales.sales_id)
                    INNER JOIN product ON sales_list.product_id=product.product_id)
                    INNER JOIN category on product.category_id=category.category_id) ORDER BY sales_id;"); // fetch data from database
                
                    if($records){
                        while($data = mysqli_fetch_array($records)){       
                    ?>
                        <tr>
                            <td><?php echo $data['sales_id']; ?></td>
                            <td><?php echo $data['category_name']; ?></td>
                            <td><?php echo $data['product_name']; ?></td>    
                            <td><?php echo $data['quantity']; ?></td>    
                            <td><?php echo $data['price']; ?></td>    
                            <td><?php echo $data['total']; ?></td>    
                            <td><?php echo $data['date']; ?></td>    
                        </tr>	
                    <?php
                        }
                    }
                    mysqli_close($conn);
                    ?>
                </table>
            </div>
        </div>
    </section>

    <?php include("include/footer.php");?>
</body>
</html>