<?php
		
        //code goes here
		include 'global.php';
		include 'db.php';

		$userid = $_POST["User_ID"];
		$Passwd = $_POST["Passwd"];
		$sql = "SELECT Mem_No, User_ID, Password, Mem_Type, Mem_Name FROM Member WHERE User_ID = '$userid'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) 
		{
			// output data of each row
			$row = $result->fetch_assoc(); 
			if ( $Passwd == $row["Password"])
			{
				$_SESSION["User_ID"] = $userid;
				$_SESSION["Mem_Type"] = $row["Mem_Type"];
				$_SESSION["Mem_Name"] = $row["Mem_Name"];
				$_SESSION["Mem_No"] = $row["Mem_No"];
				if ( $_SESSION["Mem_Type"] == 2)
				{
					header("location:ad_list.php");
				}
				else
				{
					header("location:user_ad_list.php");
				}
			}
			else
			{
				// 암호가 틀림.
				header("location:login.php");
			}
		} 
		else {
			// 아이디가 존재하지 않음
			header("location:login.php");
		}
		$conn->close();

?>