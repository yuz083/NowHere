<?php
		
        //code goes here
		include 'global.php';
		include 'db.php';
		include 'inc_status.php';

		$userid = $_SESSION["Mem_No"];
		if ($userid == "")
		{
			header("location:login.php");
		}

		$sql = "SELECT count(Coupon_Download.Coupon_No) AS cnt, Event.Event_No, Event_Name, Start_Date, End_Date, Pub_Coupon_Cnt from Coupon RIGHT OUTER join Event On Coupon.Event_No = Event.Event_No LEFT OUTER JOIN Coupon_Download ON Coupon_Download.Coupon_No = Coupon.Coupon_No WHERE Event.Mem_No= '$userid' GROUP BY Event.Event_No ORDER BY Event.Event_No DESC;";
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
	<style>
		.col-lg-12 {padding-right: 5px; padding-left: 5px;}
	</style>
</head>

<body>

    <div id="wrapper">

    <?php
		include_once('./navbar.php');
		include_once('./rownavbar.php');
	?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h3>광고 목록</h3>
                    
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>등록된 모든 광고목록입니다.</h5>
                            <div class="ibox-tools">
                                <a href="ad_new.php" class="btn btn-primary btn-xs">새 광고 등록</a>
                            </div>
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
													$status_arr=date_status($row["Start_Date"],$row["End_Date"]);
									?>
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-<?=$status_arr[0]?>"><?=$status_arr[1]?></span>
                                        </td>
                                        <td class="project-title">
                                            <a href="ad_detail.php?evtid=<?=$row["Event_No"]?>"><?=$row["Event_Name"]?></a>
                                            <br/>
                                          
                                        </td>
                                        <td class="project-completion">
                                                <small>다운로드: <?=$row["cnt"]?>/<?=$row["Pub_Coupon_Cnt"]?>(<?=ceil($row["cnt"]/$row["Pub_Coupon_Cnt"]*100)?>%)</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: <?=ceil($row["cnt"]/$row["Pub_Coupon_Cnt"]*100)?>%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-people">
                                            <small><?=substr($row["Start_Date"],2,16) ?> ~ <?=substr($row["End_Date"],2,16) ?></small> 
                                        </td>
                                        <td class="project-actions">
                                           <button id="push_<?=$row["Event_No"]?>" class="btn btn-white btn-sm" data-whatever="<?=$row["Event_No"]?>"><i class="fa fa-bullhorn"></i></button>
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

		$('[id^=push_]').on('click',function(){
			var evtid = $(this).data('whatever')
		  $.get("push_event.php?evtid=" + evtid, function(data, status){
			if (status="success")
			{
				alert("성공적으로 푸시 발송하였습니다");

			}
			else
				{
				alert("푸시 발송에 실패하였습니다");
				}
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
