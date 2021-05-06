<?php
		
        //code goes here
		include "global.php";
		include "db.php";

		$success =FALSE;

		$User_ID = $_POST["User_ID"];
		$Password = $_POST["Passwd"];
		$Mem_Name = $_POST["Mem_Name"];
		$Mem_Type = $_POST["Mem_Type"];
		$Biz_No = $_POST["Biz_No"];
		$User_ID = $_POST["User_ID"];
		$Boss_Name = $_POST["Boss_Name"];
		$Contact = $_POST["Contact"];
		$Biz_No = $_POST["Biz_No"];
		$Biz_Type = $_POST["Biz_Type"];
		$Biz_Zip = $_POST["Biz_Zip"];
		$Biz_Addr = $_POST["Biz_Addr"];
		$Biz_Addr_Detail = $_POST["Biz_Addr_Detail"];

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
				$sql = "INSERT INTO Advertiser (Mem_no, Biz_No, Boss_Name, Biz_Zipcode, Biz_Addr, Biz_Addr_Detail, Contact_Phone, Biz_Type_Code) VALUES ( $Mem_No, '$Biz_No', '$Boss_Name', '$Biz_Zip', '$Biz_Addr', '$Biz_Addr_Detail', '$Contact', '$Biz_Type')";
				
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
									<button type="submit" formaction="register_ad.php?id=<?=$User_ID?>" class="btn btn-primary block full-width m-b">다시 시도</button>
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