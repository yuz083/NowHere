<?php
		
        //code goes here
	include 'global.php';
	include 'db.php';
	$success =FALSE;
	$token  = $_POST["token"];

	$sql = "INSERT INTO push_token (token) VALUES ('$token')";
	$conn->query($sql);
		
	

	$conn->close();


	
?>