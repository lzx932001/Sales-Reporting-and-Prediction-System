<?php

include 'config.php';

$id = $_GET['id']; // $id is now defined

		// or assuming your column is indeed an int
		// $id = (int)$_GET['id'];

		$result = mysqli_query($mysqli , "DELETE FROM enquiry WHERE id='".$id."'"); 	
		mysqli_close($mysqli);
		header("Location: view_enquiries.php");
?>