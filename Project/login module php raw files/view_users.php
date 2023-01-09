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

?>
    <div class="row" >
      <div class="large-12">
        <h3 style="margin-top:100px;text-align:center;">Active Users</h3>
        <hr>
		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" style="margin-top:20px;width:40%;margin-left:30%;">
		<table id="myTable" class="table table-active">
			<tr class="header">
				<th style="width:20%;">Name</th>
				<th style="width:20%;">ID</th>
				<th style="width:20%;">Address</th>
				<th style="width:20%;">City</th>
				<th style="width:20%;">Email</th>
				<th style="width:20%;">Remove User</th>
				
			</tr>
  
        <?php
          $user = $_SESSION["username"];
          $result = mysqli_query($conn , 'SELECT * FROM users where type="user"');
          if($result) {
            while($obj = $result->fetch_object()) {
              //echo '<div class="large-6">';
			  echo '<tr>';
              echo '<td>'.$obj->fname.'</td>';
			  echo '<td>'.$obj->id.'</td>';
			  echo '<td>'.$obj->address.'</td>';
			  echo '<td>'.$obj->city.'</td>';
			  echo '<td>'.$obj->email.'</td>';
              
			  echo '<td><a href="delete-user.php?id=' .$obj->id. '"><button>Delete</button></a>';
			  echo '</td>';
		  
			  echo'</tr>';

            }
          }
        ?>
		</table>
      </div>
    </div>




    <div class="row" style="margin-left:60px;">
      <div class="small-12">

        

      </div>
    </div>

	<script>
		function myFunction() {
		  var input, filter, table, tr, td, i;
		  input = document.getElementById("myInput");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("myTable");
		  tr = table.getElementsByTagName("tr");
		  for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
			if (td) {
			  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			  } else {
				tr[i].style.display = "none";
			  }
			}       
		  }
		}
		</script>	

<?php include('include/footer.php')?>
</body>
</html>