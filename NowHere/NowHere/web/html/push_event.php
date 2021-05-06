<?php
		
        //code goes here
		include 'global.php';
		include 'db.php';
		include('./httpful.phar');

		/*
		
		if (empty($_GET["evtid"]));
		{
			echo "no event id";
			die();
		}
*/
		$evtid = $_GET["evtid"];
		
		$sql = "SELECT token FROM push_token;";
		$result = $conn->query($sql);

		$to = "[";

	
		
		$regids = array();
		while ($row2 = $result->fetch_assoc())
		{
			$regids[] = $row2["token"];
		}
	
	
		$sql = "SELECT Event_Name, Reg_Name, Event_Contact_No, Start_Date, End_Date, Event_Content, Place_X, Place_Y, Radius, Cat_Name, Event_Type_Name FROM Event LEFT JOIN (Category, Event_Type) ON Event.Category_No = Category.Category_No AND Event.Event_Type_Code = Event_Type.Event_Type_No WHERE Event.Event_No = '$evtid' ";
		$res = $conn->query($sql);

		if ($res->num_rows > 0) 
		{ 
				$row = $res->fetch_assoc();
		}		
	
		
 
 		$arr = array();
		$arr['data'] = array();
		$arr['data']['title'] = "지금!여기! 이벤트 알림";
		$arr['data']['url'] = "https://www.mynowhere.xyz/app/push_ad_detail.php?evtid=".$evtid;
		$arr['data']['msg'] = substr(strip_tags($row["Event_Content"]),0,200);
		$arr['data']['body'] = $row["Event_Name"];
		$arr['data']['longitude'] = (real)$row["Place_Y"];
		$arr['data']['latitude'] =(real)$row["Place_X"];
		$arr['data']['distance'] = (real)$row["Radius"] ;
		$arr['registration_ids'] = $regids;
		
		$jsonMsg = json_encode($arr);
		//echo $jsonMsg ;

		// And you're ready to go!
		$request = \Httpful\Request::post('https://fcm.googleapis.com/fcm/send');
		$request->addHeader("Authorization","key=AAAA9yf8rDA:APA91bGkwI6zziFQVJ3tqDM4LhqlvBN_nlV8bax6LVInNvo-qiBgIDWzdrIGRh3-4IPSWLIVi49puLDL7EoDS7RFxd7MXJxRNBLoVmkXieyaj6cTsSo5otrlOgE8PF8LRjn1MeZs0_-A");
		$request->addHeader("Content-Type", "application/json");
		$request->body($jsonMsg);
		$response = $request->send();
		echo $response->code;
		//echo $response->raw_headers;

		$conn->close();


	
?>

