
<?php
	$sql = "SELECT count(Coupon_Download.Coupon_No) AS cnt, Event.Event_No, Pub_Coupon_Cnt from Coupon RIGHT OUTER JOIN Event ON Coupon.Event_No = Event.Event_No LEFT OUTER JOIN Coupon_Download ON Coupon_Download.Coupon_No = Coupon.Coupon_No WHERE Event.Event_No = '$evtid';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) 
	{ 
		$row = $result->fetch_assoc();
		$downcnt = $row["cnt"];
		$pubcnt=  $row["Pub_Coupon_Cnt"];
	}
?>