<!DOCTYPE html>
<html lang="en">
<head>
  <title> People Health Pharmacy </title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style/style.css" type="text/css" />

  <meta name="author" content="" />
</head>
<body class = "index_container">
<?php include_once "include/header.php"; ?>
  <h1 class = "para1">
      User Manual
  </h1>
  <p class = "para2">
  How to use Sales Module?
    <ol class = "usertable">
      <li>Sales table will display the sales record</li>
      <li>Add sales section is to add new record</li>
      <li>Edit button allows user to make changes if there is an error from the record</li>
      <li>Beware of the delete button, once it is clicked the specific record will permanently remove from the database</li>
    </ol>
  </p>

  <p class = "para2">
  How to use Inventory Module?
    <ol class = "usertable">
      <li>The table will show the product details</li>
      <li>At right side, the filter panel allows user to search by product name or category by using the dropdown menu</li>
      <li>After clicking Submit button, the relevant products or category will show in the inventory table</li>
      <li>For the edit button, user can update the quantity and per unit price of the product</li>
    </ol>
  </p>

  <p class = "para2">
  How to use Analysis Module?
    <ol class = "usertable">
      <li>Analysis Module shows the charts of each product and category</li>
      <li>User can select the product or category they want to see</li>
      <li>"Print this page" button allows user to print the analysis module</li>
      <li>The download button generates a CSV file of total sales</li>
      <li></li>
    </ol>
  </p>


<?php include("include/footer.php");?>
</body>
</html>



