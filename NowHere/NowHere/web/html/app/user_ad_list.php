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

		$sql =  "SELECT count(Coupon_Download.Coupon_No) AS cnt, Event.Event_No, Event_Name, Region, Start_Date, End_Date, Pub_Coupon_Cnt from Coupon RIGHT OUTER join Event On Coupon.Event_No = Event.Event_No LEFT OUTER JOIN Coupon_Download ON Coupon_Download.Coupon_No = Coupon.Coupon_No WHERE NOW() >= Start_Date AND NOW() <= End_Date GROUP BY Event.Event_No ORDER BY Event.Event_No DESC;";
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
	.project-list table tr td {padding: 5px 0 5px 0;}

	</style>
</head>

<body>

    <div id="wrapper">

    <?php
		include_once('./user_navbar.php');
		include_once('./user_rownavbar.php');
	?>

            <div class="row  border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h3>전체 광고이벤트 목록</h3>
                  
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>현재 진행중인 모든 광고이벤트 목록입니다.</h5>
                            
                        </div>
                        <div class="ibox-content">
                            
                            <div class="project-list">

                                <table class="table table-hover" >
                                    <tbody>
									<?php 
											if ($result->num_rows > 0) 
											{ 
												while($row = $result->fetch_assoc())
												{
													$status_arr=date_status($row["Start_Date"],$row["End_Date"]);
									?>
	                                    <tr>
	                                        
                                 			
                                    		<td class="project-title" colspan=4 style="border-bottom: none;">
                                    	 		<span class="label label-<?=$status_arr[0]?>"><?=$status_arr[1]?></span> <a href="user_ad_detail.php?evtid=<?=$row["Event_No"]?>"><?=$row["Event_Name"]?></a>
                                    		</td>
                                      	</tr>
                                      	<tr>
	                                    	<td class="project-status">
	                                            <a href="user_ad_detail.php?evtid=<?=$row["Event_No"]?>"><span><small><?=$row["Region"]?></small></span>
	                                        </td>
	                                        <td class="project-completion">
	                                                <small>남은쿠폰: <?=$row["Pub_Coupon_Cnt"]-$row["cnt"]?>/<?=$row["Pub_Coupon_Cnt"]?></small>
	                                                <div class="progress progress-mini">
	                                                    <div style="width: <?=ceil($row["cnt"]/$row["Pub_Coupon_Cnt"]*100)?>%;" class="progress-bar"></div>
	                                                </div>
	                                        </td>
	                                        <td class="project-people">
	                                           <small><!-- <?=substr($row["Start_Date"],2,13) ?> ~ --><?=substr($row["End_Date"],2,14) ?> </small>
	                                        </td>
                                  
		                                    <td class="project-actions">
	                                            <a href="user_ad_detail.php?evtid=<?=$row["Event_No"]?>" class="btn btn-white btn-sm"><i class="fa fa-download"></i></a>
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
