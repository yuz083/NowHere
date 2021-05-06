<?php
		
        //code goes here
		include 'global.php';
		include 'db.php';


        if (empty($_GET["evtid"]))
        {
            $ret=array(
	        "status" => false,
	        "message" => "evtid missed."
	    	);
	    	echo json_encode ($ret);
        }
        else
        {
			$evtid = $_GET["evtid"];

			$sql = "SELECT Event_Name, Reg_Name, Event_Contact_No, Start_Date, End_Date, Event_Content, Place_X, Place_Y, Radius, Cat_Name, Event_Type_Name FROM Event LEFT JOIN (Category, Event_Type) ON Event.Category_No = Category.Category_No AND Event.Event_Type_Code = Event_Type.Event_Type_No WHERE Event.Event_No = '$evtid' ";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) 
			{
				$row = $result->fetch_assoc(); 
				$ret=array(
		        "status" => true,
		        "message" => "success."
		    	);
		    	echo json_encode ($ret);
		    	echo json_encode ($row);
			}
			else
			{
				$ret=array(
		        "status" => false,
		        "message" => "evtid not exist."
		    	);
		    	echo json_encode ($ret);
			}
		}
		

?>