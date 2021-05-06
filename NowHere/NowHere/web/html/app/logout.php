<?php
		
        //code goes here
		include 'global.php';
		include 'db.php';

		if ( $_SESSION["Mem_No"] != "")
		{
			$_SESSION["User_ID"] = "";
			$_SESSION["Mem_Type"] = "";
			$_SESSION["Mem_Name"] = "";
			$_SESSION["Mem_No"] = "";
		}

		header("location:login.php");
		
?>