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

		
		$sql = "SELECT Coupon.Coupon_No, Coupon_Code, Use_Limit_Date FROM Coupon_Download INNER JOIN Coupon ON Coupon_Download.Coupon_No = Coupon.Coupon_No WHERE Coupon.Event_No = '$evtid' AND Coupon_Download.Mem_No = '$userid' ORDER BY Coupon_No ASC LIMIT 1 ;";

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
	
		<div class="modal-body">
		<?php 
			if ($success){
		?>
			<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=https%3A%2F%2Fwww.mynowhere.xyz.com%2F;<?=$row["Coupon_Code"]?>&choe=UTF-8" title="NowHere Coupon" />
					<div class="form-group"><label>쿠폰번호</label> Coupon.<input type="text" disabled  class="form-control" data-whatever="<?=$row["Coupon_No"]?>"  value="<?=$row["Coupon_Code"]?>" ></div>
					<div class="form-group"><label>사용기한</label> <input type="text" disabled  class="form-control" value="<?=$row["Use_Limit_Date"]?>" ></div>
		<?php
}
		else{
		?>
			<p><strong>쿠폰이 없습니다.</strong> </p>
		<?php
		}
		?>
		</div>
		<div class="modal-footer">
		<?php 
			if ($success){
	?>
				<button type="button" id="use_coupon" class="btn btn-white" name="use_coupon" value="Update">쿠폰사용</button>
		<?php 
			}
		?>
			<button type="button" class="btn btn-primary" data-dismiss="modal">닫기</button>
		</div>
		<script>

		$('#use_coupon').click(function(){
			var coupon_no = $('#use_coupon').data('whatever');
		  $.get("use_coupon.php?c_no=" & coupon_no, function(data, status){
				if (status="success")
				{
					if (data == "pass")
					{
						alert("사용기한이 지난 쿠폰입니다.");
					}
					else if (data == "before")
					{
						alert("이벤트 시작 전입니다.");
					}
					else
					{
						alert("쿠폰이 사용되었습니다.");
					}
				}
				else{
						alert("오류가 발생하였습니다.");
				}
			
		  });
	  });
				</script>	

</body>

</html>