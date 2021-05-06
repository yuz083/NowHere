<?php
		
        //code goes here
		include "global.php";
		include "db.php";

		$success =FALSE;


		$User_ID = $_POST["User_ID"];
		$Password = $_POST["Passwd"];
		$Mem_Name = $_POST["Mem_Name"];
		$Mem_Type = 1;
		if ($_POST["b_year"] == "n" || $_POST["b_month"] == "n" || $_POST["b_day"] == "n"  ){
			$Born_Date = "";
		}
		else
		{
			$Born_Date = substr($_POST["b_year"],2,2).$_POST["b_month"].$_POST["b_day"];
		}

		$Email = $_POST["Email"];
		$Cell_Phone = $_POST["Cell_Phone"];
		$Zip_Code = $_POST["Zip_Code"];
		$Addr = $_POST["Addr"];
		$Addr_Detail = $_POST["Addr_Detail"];
		$Gender = $_POST["Gender"];


		$sql = "INSERT INTO Member (User_ID, Password, Mem_Name, Mem_Type, Reg_Date) VALUES ( '$User_ID', '$Password', '$Mem_Name', '$Mem_Type', NOW())";
		if ($conn->query($sql) === TRUE) 
		{
			//echo "New record created successfully";
			$sql = "SELECT Mem_No FROM Member WHERE User_ID = '$User_ID'";
			$result = $conn->query($sql);
			if ($result->num_rows == 1) 
			{
				$row = $result->fetch_assoc(); 
				$Mem_No = $row["Mem_No"];
				$sql = "INSERT INTO Person (Mem_no, Born_Date, Zip_Code, Addr, Addr_Detail, Cell_Phone, Email, Gender) VALUES ( $Mem_No, '$Born_Date', '$Zip_Code', '$Addr', '$Addr_Detail', '$Cell_Phone', '$Email', '$Gender')";
				
				if ($conn->query($sql) === TRUE)
				{
					// 삽입 성공
					$success =TRUE;
				}
				else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
			else
			{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$conn->close();

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>지금!여기! | 가입 성공</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">
					<?php if ($success == TRUE ){ ?>
                    <h2 class="font-bold">가입을 축하합니다.</h2>

                    <p>
				
                        가입을 축하드립니다. 지금부터 지금!여기! 서비스를 이용하실 수 있습니다. 
					<?php } else { ?>
					<h2 class="font-bold">문제가 발생하였습니다.</h2>

                    <p>
						사용자 등록에 실패하였습니다. 다시 등록해주시기 바랍니다.
					<?php } ?>
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                        	<form>
 
                                <?php if ($success == TRUE ){ ?>                         
									<button type="submit" formaction="login.php?id=<?=$User_ID?>" class="btn btn-primary block full-width m-b">로그온 하기</button>
								<?php } else { ?>
									<button type="submit" formaction="register.php?id=<?=$User_ID?>" class="btn btn-primary block full-width m-b">다시 시도</button>
								<?php } ?>
							</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright  Company
            </div>
            <div class="col-md-6 text-right">
               <small>© 2014-2015</small>
            </div>
        </div>
    </div>

</body>

</html>