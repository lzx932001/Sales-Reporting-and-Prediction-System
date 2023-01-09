<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="view_enquiries"/>
	<meta name="keywords" content="HTML5, tags"/>
	<meta name="Tan Jun Wee" content="Enquiry"/>

	<title>Enquiry</title>
	<link href="CSSfile/style.css" rel="stylesheet">
	<script src= "jsfiles/script.js"></script>
	
	
</head>

<body>
<?php include('include/navigator.php');?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Enquiry";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT * FROM enquiry";
$result = mysqli_query($conn , $sql); 

//return number of rows in table
$resultCheck = mysqli_num_rows($result);
?>

<table id="acenter" style="margin-top:20px;">
<thead><tr><th style="width:10%;">Firstname</th>
			<th style="width:10%;">Lastname</th>
			<th style="width:10%;">Email</th><th>Phone</th>
			<th style="width:10%;">Product</th><th>Productname</th>
			<th style="width:10%;">comments</th>
			<th style="width:10%;">Remove</th></tr></thead>
<tbody>
<?php
        while($row = mysqli_fetch_assoc($result)){
?>       
        <tr>
        <td><?php echo $row["firstname"]; ?></td>
        <td><?php echo $row["lastname"]; ?></td> 
        <td><?php echo $row["email"]; ?></td> 
        <td><?php echo $row["phone"]; ?></td> 
        <td><?php echo $row["product"]; ?></td> 
        <td><?php echo $row["productname"]; ?></td>
		<td><?php echo $row["comments"]; ?></td>
		<td><a href="delete-enquiry.php?id=<?php echo $row["id"]; ?>"><button>Delete</button></a>
        </tr>
<?php
 };
?>    
</tbody>
</table>


<?php include('include/footer.php')?>
</body>
</html>