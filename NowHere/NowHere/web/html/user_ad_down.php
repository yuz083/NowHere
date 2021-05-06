<?php
        
        //code goes here
        include 'global.php';
        include 'db.php';
		include 'inc_status.php';

        $Mem_No = $_SESSION["Mem_No"];
        if ($Mem_No == "")
        {
            header("location:login.php");
        }
	
		$sql = "SELECT DISTINCT Event.Event_No, Event.Event_Name, Event.Region, Event.Start_Date, Event.End_Date FROM Coupon INNER JOIN Coupon_Download ON Coupon.Coupon_No = Coupon_Download.Coupon_No INNER JOIN Event ON Coupon.Event_no = Event.Event_No Where Coupon_Download.Mem_No = ". $Mem_No. " GROUP BY Event.Event_No, Coupon.Coupon_No;";
		
		
       // $sql = "SELECT Event_No, Mem_No, Event_Name, Start_Date, End_Date FROM Event";
        $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>지금!여기! | 쿠폰 다운로드한 목록 </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<style>
		.map_wrap {position:relative;width:100%;height:350px;}
		.title {font-weight:bold;display:block;}
		.hAddr {position:absolute;left:10px;top:10px;border-radius: 2px;background:#fff;background:rgba(255,255,255,0.8);z-index:1;padding:5px;}
		#centerAddr {display:block;margin-top:2px;font-weight: normal;}
		.bAddr {padding:5px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;}
	</style>

</head>

<body>

		
    <div id="wrapper">

    <?php
        include_once('./user_navbar.php');
        include_once('./user_rownavbar.php');
    ?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>쿠폰 다운로드한 목록</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">홈</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>이벤트 /쿠폰 다운로드한 목록</strong>
                        </li>
                    </ol>
                </div>
            </div>
		
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title" >
                           <h5>쿠폰 다운로드한 이벤트 목록입니다.</h5>
						          <div id="addressText" class="text-navy" ></div>    
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
                                            <a href="user_ad_detail.php?evtid=<?=$row["Event_No"]?>"><?=$row["Event_Name"]?></a>
                                            <br/>
                                          
                                        </td>
                                        <td class="project-completion">
                                              <span><?=$row["Region"]?></span>
                                        
                                        </td> 
                                        <td class="project-people">
                                            <?=substr($row["Start_Date"],0,16) ?> ~ <?=substr($row["End_Date"],0,16) ?> 
                                        </td>
                                        <td class="project-actions">
                                            
                                            <button type="button" class="btn btn-white btn-sm" data-toggle="modal" data-target="#myModal" data-whatever = "<?=$row["Event_No"]?>"><i class="fa fa-search"></i>쿠폰보기</a>
                                        </td>
                                    </tr>
                                    <?php
                                                }
                                            }
											else
											{

                                    ?>
									<tr>
                                        <td class="project-title">
                                            쿠폰을 받은 이벤트가 없습니다.
                                        </td>
									</tr>
									<?php
											}
									?>
                                    </tbody>
                                </table>
			<!-- 모달  
										 <div class="text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Launch demo modal
                            </button>
                                </div> -->
                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                     
                                            <h5 class="modal-title">쿠폰 보기</h5>
                                            
                                        </div>
										<div class="dash">
										 <!-- Content goes in here -->
										</div>
                                    </div>
                                </div>
                            </div>

				<!--	모달		-->
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


		$('#myModal').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget) // Button that triggered the modal
			  var evtid = button.data('whatever') // Extract info from data-* attributes
			  var modal = $(this);
			  var dataString = 'Event_No=' + evtid;
	 
				$.ajax({
					type: "GET",
					url: "get_coupon_info.php",
					data: dataString,
					cache: false,
					success: function (data) {
						console.log(data);
						modal.find('.dash').html(data);
					},
					error: function(err) {
						console.log(err);
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
<?php
        
        //code goes here
        include 'global.php';
        include 'db.php';
		include 'inc_status.php';

        $Mem_No = $_SESSION["Mem_No"];
        if ($Mem_No == "")
        {
            header("location:login.php");
        }
	
		$sql = "SELECT DISTINCT Event.Event_No, Event.Event_Name, Event.Start_Date, Event.End_Date FROM Coupon INNER JOIN Coupon_Download ON Coupon.Coupon_No = Coupon_Download.Coupon_No INNER JOIN Event ON Coupon.Event_no = Event.Event_No Where Coupon_Download.Mem_No = ". $Mem_No. " GROUP BY Event.Event_No, Coupon.Coupon_No;";
		
		
       // $sql = "SELECT Event_No, Mem_No, Event_Name, Start_Date, End_Date FROM Event";
        $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>지금!여기! | 쿠폰 다운로드한 목록 </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<style>
		.map_wrap {position:relative;width:100%;height:350px;}
		.title {font-weight:bold;display:block;}
		.hAddr {position:absolute;left:10px;top:10px;border-radius: 2px;background:#fff;background:rgba(255,255,255,0.8);z-index:1;padding:5px;}
		#centerAddr {display:block;margin-top:2px;font-weight: normal;}
		.bAddr {padding:5px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;}
	</style>

</head>

<body>

		
    <div id="wrapper">

    <?php
        include_once('./user_navbar.php');
        include_once('./user_rownavbar.php');
    ?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>쿠폰 다운로드한 목록</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">홈</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>이벤트 /쿠폰 다운로드한 목록</strong>
                        </li>
                    </ol>
                </div>
            </div>
		
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title" >
                           <h5>쿠폰 다운로드한 이벤트 목록입니다.</h5>
						          <div id="addressText" class="text-navy" ></div>    
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
                                            <a href="user_ad_detail.php?evtid=<?=$row["Event_No"]?>"><?=$row["Event_Name"]?></a>
                                            <br/>
                                          
                                        </td>
                                      <!--  <td class="project-completion">
                                                <small>다운로드 수: 48%</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                        </td> -->
                                        <td class="project-people">
                                            <?=substr($row["Start_Date"],0,16) ?> ~ <?=substr($row["End_Date"],0,16) ?> 
                                        </td>
                                        <td class="project-actions">
                                            
                                            <button type="button" class="btn btn-white btn-sm" data-toggle="modal" data-target="#myModal" data-whatever = "<?=$row["Event_No"]?>"><i class="fa fa-search"></i>쿠폰보기</a>
                                        </td>
                                    </tr>
                                    <?php
                                                }
                                            }
											else
											{

                                    ?>
									<tr>
                                        <td class="project-title">
                                            쿠폰을 받은 이벤트가 없습니다.
                                        </td>
									</tr>
									<?php
											}
									?>
                                    </tbody>
                                </table>
			<!-- 모달  
										 <div class="text-center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Launch demo modal
                            </button>
                                </div> -->
                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                     
                                            <h5 class="modal-title">쿠폰 보기</h5>
                                            
                                        </div>
										<div class="dash">
										 <!-- Content goes in here -->
										</div>
                                    </div>
                                </div>
                            </div>

				<!--	모달		-->
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


		$('#myModal').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget) // Button that triggered the modal
			  var evtid = button.data('whatever') // Extract info from data-* attributes
			  var modal = $(this);
			  var dataString = 'Event_No=' + evtid;
	 
				$.ajax({
					type: "GET",
					url: "get_coupon_info.php",
					data: dataString,
					cache: false,
					success: function (data) {
						console.log(data);
						modal.find('.dash').html(data);
					},
					error: function(err) {
						console.log(err);
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
