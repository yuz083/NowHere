<?php
		
    //code goes here
	include 'global.php';
	include 'db.php';

	
	if(empty($_GET["x"]) || empty($_GET["y"]) )
	{
		$sql = "SELECT Event_No, Mem_No, Event_Name, Start_Date, End_Date, Place_X, Place_Y, Radius FROM Event;";
	}
	else
	{
		$x = $_GET["x"];
		$y = $_GET["y"];
		$sql = "SELECT Event_No, Mem_No, Event_Name, Start_Date, End_Date, Place_X, Place_Y, Radius FROM Event WHERE ST_Distance_Sphere(Point(Place_Y, Place_X), Point('$y', '$x')) < Radius;";
	}

	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{ 
		$ret = array(
				"status" => "success",
				"count" => "$result->num_rows"
			);
		echo json_encode($ret);

		while($row = $result->fetch_assoc())
		{
			
			echo json_encode($row);
	 		
		}
	}
 
	$conn->close();
?>

