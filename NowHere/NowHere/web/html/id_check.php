<?php
//DB연결
include "global.php";
include "db.php";

$chk_id = $_GET["chk_id"];

if($chk_id) 
{
	$sql ="select * from Member where User_ID='$chk_id'";
	
	$result = $conn->query($sql);
	if($result->num_rows == 0) {
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <title>지금!여기! | 로그인</title>
</head>
<body class="gray-bg">
	<font color=red><b><?=$chk_id?></b></font>는 사용가능합니다.
	<input type=button value="사용" onclick="insert_id('<?=$chk_id?>')">

	<script>
		function insert_id(mid) {
		opener.document.register.User_ID.value="<?=$chk_id?>";
		self.window.close();
		}
	</script>

	<?php  
	} else { 
	?>
		<font color=red><b><?=$chk_id?></b></font>는 사용 불가능합니다.
		<input type=button value="다시 검색" onclick="location.href='id_check.php?chk_id='; ">
	<?php
	}

} else { ?>

	<div class="ibox ">
					<div class="ibox-content">
		<div class="form-group  row">
			<label class="col-sm-3 col-form-label">아이디</label>
			<div class="col-sm-7"><input type="text" id ="User_ID" name="User_ID" class="form-control"></div>
			<button type="button" class="btn btn-outline btn-primary" onclick="id_check();">중복확인</button>				
		</div>
	</div>
	</div>

	<script>
		function id_check() {
			var f = document.getElementById("User_ID").value;
			if(!f) 
				{ alert('아이디를 먼저 입력하세요'); }
			else 
				{ location.href='id_check.php?chk_id='+f; }
		}
	</script>
</body>

<?php } ?>
