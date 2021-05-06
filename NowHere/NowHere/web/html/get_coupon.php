<?php
		
        //code goes here
		include 'global.php';
		include 'db.php';
		$userid = $_SESSION["Mem_No"];
		$evtid = $_GET["Event_No"];
		if ($userid == "")
		{
			$success = FALSE;
		}

		if ($evtid == "")
		{
			$success = FALSE;
		}

		
		$sql = "SELECT Coupon_No, Coupon_Code, Use_Limit_Date FROM Coupon WHERE  NOT EXISTS (SELECT * FROM Coupon_Download WHERE Coupon_Download.Coupon_No = Coupon.Coupon_No) AND Event_No = '$evtid' ORDER BY Coupon_No ASC LIMIT 1 ;";

		if ($result = $conn->query($sql)) 
		{
			if ($result->num_rows > 0) 
			{ 
				$row = $result->fetch_assoc();
				$success = TRUE;
			}
			else
			{
				$success = FALSE;
			}
		}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modal</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="css/plugins/summernote/summernote-bs4.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
	<form method="post" action="download_coupon.php" role="form">
		<div class="modal-body">
		<?php 
			if ($success){
		?>
			<p><strong>발급될 쿠폰입니다. "쿠폰받기"를 눌러 다운로드 받으셔야 합니다.</strong> </p>
					<div class="form-group"><label>쿠폰번호</label> <input type="hidden" name="Coupon_No"  class="form-control" value="<?=$row["Coupon_No"]?>" ><input type="hidden" name="evtid"   class="form-control" value="<?=$evtid?>" ><input type="text" disabled  class="form-control" value="<?=$row["Coupon_Code"]?>" ></div>
					<div class="form-group"><label>사용기한</label> <input type="text" disabled  class="form-control" value="<?=$row["Use_Limit_Date"]?>" ></div>
		<?php
}
		else{
		?>
			<p><strong>모든 쿠폰이 소진되었습니다.</strong> </p>
		<?php
		}
		?>
		</div>
		<div class="modal-footer">
		<?php 
			if ($success){
	?>
				<button type="submit" class="btn btn-white" name="submit" value="Update">쿠폰받기</button>
		<?php 
			}
		?>
			<button type="button" class="btn btn-primary" data-dismiss="modal">닫기</button>
		</div>
	</form>								
</body>

</html>