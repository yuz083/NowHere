<?php
		
        //code goes here
		include "global.php";
		include "db.php";
		include "getAddrFromCoords.php";

		$success =FALSE;

		$Mem_No = $_SESSION["Mem_No"];
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
		//$Event_Content = "테스트입니다";

		$Region = getRegion($Place_Y,$Place_X);

		$sql = "INSERT INTO Event (Mem_No, Category_No, Reg_Name, Event_Name, Event_Type_Code, Event_Content, Event_Contact_No, Start_Date, End_Date, Place_X,Place_Y, Pub_Coupon_Cnt, Target_Gender, Target_Age, Reg_Date, Radius, Region) VALUES ('$Mem_No', '$Category_No', '$Reg_Name', '$Event_Name', '$Event_Type_No', '$Event_Content', '$Event_Contact_No', '$Start_Date', '$End_Date', '$Place_X','$Place_Y', '$Pub_Coupon_Cnt', '$Target_Gender', '$Target_Age', NOW(), '$Radius', '$Region')";
		
		//$sql = "INSERT INTO Member (User_ID, Password, Mem_Name, Mem_Type, Reg_Date) VALUES ( '$User_ID', '$Password', '$Mem_Name', '$Mem_Type', NOW())";
		if ($conn->query($sql) === TRUE) 
		{
			//echo "New record created successfully";
			// 삽입 성공
			$Event_No = $conn->insert_id;
			$Pub_Coupon_Cnt =50;
			$coupon_array = array();

			for($i=0; $i <$Pub_Coupon_Cnt; $i++){
				$coupon = makeCoupon();
				array_push($coupon_array, $coupon);

			}

			for($i=0; $i < count($coupon_array); $i++){
				$sql ="INSERT INTO Coupon (Coupon_Code, Use_Limit_Date, Event_No) VALUES ('$coupon_array[$i]', '$End_Date', '$Event_No')";
				if (!$conn->query($sql)){
					//echo "coupon 등록 오류";
					$success = FALSE;
				}

				$success =TRUE;
			}
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();
		
		header("location:ad_list.php");

		
		function makeCoupon($j = 16){
		$string = "";
			for($i=0;$i < $j;$i++){
				srand((double)microtime()*1234567);
				$x = mt_rand(0,2);
				switch($x){
					case 0:$string.= chr(mt_rand(97,122));break;
					case 1:$string.= chr(mt_rand(65,90));break;
					case 2:$string.= chr(mt_rand(48,57));break;
				}
			}
		return strtoupper($string); //to uppercase
		}
?>
