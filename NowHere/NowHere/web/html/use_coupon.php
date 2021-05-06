<?php
		
        //code goes here
	include 'global.php';
	include 'db.php';
	$success =FALSE;
	
	
	if (empty( $_GET["c_no"]))
	{
		echo "no_param";
		die();
	}
	$cno = $_GET["c_no"]);
	$sql = "SELECT Start_Date, End_Date FROM Event INNER JOIN Coupon ON Event.Event_No = Coupon.Event_No WHERE Coupon.Coupon_No = '$cno'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) 							
	{
		$row = $result->fetch_assoc();
	}

	$now = date("Y-m-d H:i:s");
	$st = $row["Start_Date"];
	$end = $row["End_Date"];
				
	if ( $end < $now )
	{
		echo "after";
		$conn->close();
		die();
	}
	elseif ( $st > $now )
	{
		echo "before";
		$conn->close();
		die();
	}

	$coupon_no  = $_GET["c_no"];
	$sql = "UPDATE Coupon_Download SET Use_Stat = 2 WHERE Coupon_No = '$coupon_no'";
	if ($result = $conn->query($sql))
	{
		echo "success";
	}
	else
	{
		echo "error";
	}	
	

	$conn->close();


	
?>