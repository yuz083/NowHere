<?php
		include_once('./global.php');
		if (!empty($_SESSION["Mem_No"]) && "" != $_SESSION["Mem_No"] )  //로그인 되어 있지 않음 있음.
		{
			if ($_SESSION["Mem_Type"] == 1 )
			{
				header("location:user_ad_list_by_pos.php");
			}
			else
			{
				header("location:user_ad_list.php");
			}
		}
			
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>지금!여기! | 로그인</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <img alt="image" src="img/logo.png"/>

            </div>
            <h3>지금!여기! 서비스에 오신걸 환영합니다.</h3>
            <p>광고 회원으로 가입하시면 광고를 등록하고 원하는 시간 원하는 위치에 배포할 수 있습니다.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>서비스를 이용하시려면 로그인 해주세요.</p>
            <form class="m-t" role="form" method="POST" action="login_process.php">
                <div class="form-group">
                    <input type="text" class="form-control" name='User_ID' placeholder="아이디" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control"  name='Passwd' placeholder="암호" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">로그인</button>

                <a href="#"><small>암호를 잊으셨나요?</small></a>
                <p class="text-muted text-center"><small>아이디가 없으신가요?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register_ad.php">회원 가입</a>
            </form>
            <p class="m-t"> <small>이 페이지는 Bootstrap 3 &copy; 2014으로 제작되었습니다.</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>
