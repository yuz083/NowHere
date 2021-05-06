<?php
//DB연결
include "global.php";
include "db.php";

$chk_id = $_GET["chk_id"];

if($chk_id) 
{
	$sql ="select * from Member where User_ID='$chk_id'";
	
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		
		http_response_code(404);
	}

} 

?>