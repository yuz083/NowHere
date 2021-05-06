<?php

	$servername = "3.16.244.195";
	$username = "LocalAD";
	$password = "!Inha12141635";
	$dbname = "LocalAD";   //데이터베이스 이름 중 하나
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	//$conn->set_charset("utf8");

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 



	//echo "Connected successfully";
	//function mq($sql)
	//{
	//	global $db;
	//	return $db->query($sql);
	//}

	//$sql = "SELECT* FROM Member";
	//$result = $conn->query($sql);
	//if ($result->num_rows > 0) 
	//{
		// output data of each row
	//	while($row = $result->fetch_assoc()) 
	//	{
	//		echo "id: " . $row["User_ID"]. " - Name: " . $row["Mem_Name"]. " " . $row["Mem_Type"]. "<br>";
	//	}
	//} 
	//else {
	//	echo "0 results";
	//}
	//$conn->close();
	
?>