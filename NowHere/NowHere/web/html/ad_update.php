<?php
		
        //code goes here
		include "global.php";
		include "db.php";
		include "getAddrFromCoords.php";

		$success =FALSE;

		$Event_No = $_POST["Event_No"];
		$Event_Name = $_POST["Event_Name"];
		$Category_No = $_POST["Category_No"];
		$Event_Type_No = $_POST["Event_Type_No"];
		$Start_Date = $_POST["Start_Date"];
		$End_Date = $_POST["End_Date"];
		$Reg_Name = $_POST["Reg_Name"];
		$Event_Contact_No = $_POST["Event_Contact_No"];
		$Target_Age = $_POST["Target_Age"];
		$Target_Gender = $_POST["Target_Gender"];
		$Pub_Coupon_Cnt = $_POST["Pub_Coupon_Cnt"];
		$Place_X = $_POST["Place_X"];
		$Place_Y = $_POST["Place_Y"];
		$Radius = $_POST["Radius"];
		$Event_Content = $_POST["editordata"];
		$Region = getRegion($Place_Y,$Place_X);
		//$Event_Content = "테스트입니다";

		$sql = "UPDATE Event SET Category_No = '$Category_No', Reg_Name = '$Reg_Name', Event_Name = '$Event_Name', Event_Type_Code = '$Event_Type_No', Event_Content = '$Event_Content' , Event_Contact_No = '$Event_Contact_No' , Start_Date = '$Start_Date' , End_Date = '$End_Date', Place_X = '$Place_X' ,Place_Y = '$Place_Y', Pub_Coupon_Cnt = '$Pub_Coupon_Cnt' , Target_Gender = '$Target_Gender' , Target_Age = '$Target_Age', Radius = '$Radius', Region = '$Region' WHERE Event_No = $Event_No";

		//$sql = "INSERT INTO Member (User_ID, Password, Mem_Name, Mem_Type, Reg_Date) VALUES ( '$User_ID', '$Password', '$Mem_Name', '$Mem_Type', NOW())";
		if ($conn->query($sql) === TRUE) 
		{
			//echo "New record created successfully";
			// 삽입 성공
			$success =TRUE;
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();
		
		header("location:ad_list.php");
?>
