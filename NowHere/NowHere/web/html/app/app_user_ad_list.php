<?php
		
        //code goes here
		include 'global.php';
		include 'db.php';
		$userid = $_SESSION["Mem_No"];
		if ($userid == "")
		{
			header("location:login.php");
		}

		$sql = "SELECT Event_No, Mem_No, Event_Name, Start_Date, End_Date FROM Event";
		$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>지금!여기! | 광고 목록 보기</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

    <?php
		include_once('./user_navbar.php');
		include_once('./user_rownavbar.php');
	?>

            <div class="row   white-bg page-heading">
                <div class="col-sm-4">
                    <h2>전체 광고 목록</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">홈</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>광고/전체광고목록</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="  animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>등록된 모든 광고목록입니다.</h5>
                            
                        </div>
                        <div class="ibox-content">
                            
                            <div class="project-list">

                                <table class="table table-hover">
                                    <tbody>
									<?php 
											if ($result->num_rows > 0) 
											{ 
												while($row = $result->fetch_assoc())
												{
									?>
                                    <tr>
									<!--
                                        <td class="project-status">
                                            <span class="label label-primary">진행중</span>
                                        </td>  -->
                                        <td class="project-title">
                                            <a href="user_ad_detail.php?evtid=<?=$row["Event_No"]?>"><?=$row["Event_Name"]?></a>
                                            <br/>
                                          
                                        </td>
                                        <td class="project-completion">
                                                <small>48%</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-people">
                                            <small><?=substr($row["Start_Date"],5,5) ?> ~ <?=substr($row["End_Date"],5,5) ?></small> 
                                        </td>
                                        <td class="project-actions">
                                            <a href="user_ad_detail.php?evtid=<?=$row["Event_No"]?>" class="btn btn-white btn-sm"><i class="fa fa-download"></i> </a>
                                        </td>
                                    </tr>
                                    <?php
												}
											}
									?>
                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="float-right">
                
            </div>
            <div>
                <strong>Copyright</strong> 지금!여기!서비스 &copy; 2018
            </div>
        </div>

        </div>
        </div>
<?php 
	$conn->close();
?>
    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <script>
        $(document).ready(function(){

            $('#loading-example-btn').click(function () {
                btn = $(this);
                simpleLoad(btn, true)

                // Ajax example
//                $.ajax().always(function () {
//                    simpleLoad($(this), false)
//                });

                simpleLoad(btn, false)
            });
        });

        function simpleLoad(btn, state) {
            if (state) {
                btn.children().addClass('fa-spin');
                btn.contents().last().replaceWith(" Loading");
            } else {
                setTimeout(function () {
                    btn.children().removeClass('fa-spin');
                    btn.contents().last().replaceWith(" Refresh");
                }, 2000);
            }
        }
    </script>
</body>

</html>
