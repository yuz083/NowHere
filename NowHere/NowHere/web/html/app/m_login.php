<?php
		
        //code goes here
		include 'global.php';
		include 'db.php';

		if (empty($_GET["User_ID"]) || empty( $_GET["Passwd"]))
		{
			$user_arr=array(
	        "status" => false,
	        "message" => "User_ID or  Passwd parameter missed"
	    	);
	    	echo json_encode($user_arr);
	    	die();
		}

		$userid =$_GET["User_ID"];
		$Passwd = $_GET["Passwd"];
		$sql = "SELECT Mem_No, User_ID, Password, Mem_Type, Mem_Name FROM Member WHERE User_ID = '$userid' AND Password='$Passwd'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) 
		{
			// output data of each row
			$row = $result->fetch_assoc(); 
			$user_arr=array(
	        "status" => true,
	        "message" => "Successfully Signup!",
	        "User_ID" => $row["User_ID"],
	        "Mem_Name" => $row["Mem_Name"],
	        "Mem_No" => $row["Mem_No"],
   			 );
			
		} 
		else {
			 $user_arr=array(
	        "status" => false,
	        "message" => "unknown user or wrong passwod !"
	    	);
		}
		$conn->close();

		echo json_encode($user_arr);


?>