<?php
		
        //code goes here
		include "global.php";
		include "db.php";

		$success =FALSE;

    	$evtid = $_POST['evtid'];
		$Mem_No = $_SESSION["Mem_No"];
		$Coupon_No = $_POST["Coupon_No"];
		

		$sql = "INSERT INTO Coupon_Download (Mem_No, Coupon_No, Down_Date, Use_Stat) VALUES ('$Mem_No', '$Coupon_No', NOW(), '1')";

		
		if ($conn->query($sql) === TRUE) 
		{
			//echo "New record created successfully";
			// 삽입 성공
			header("location:user_ad_detail.php?evtid=$evtid");
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
			header("location:user_ad_list.php");
		}
		
		$conn->close();
		
		

		
		
?>
