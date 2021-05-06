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
		if(empty($_GET["lon"]) || empty($_GET["lat"]) )
		{
			$sql = "SELECT count(Coupon_Download.Coupon_No) AS cnt, Event.Event_No, Event_Name, Region, Start_Date, End_Date, Pub_Coupon_Cnt from Coupon RIGHT OUTER join Event On Coupon.Event_No = Event.Event_No LEFT OUTER JOIN Coupon_Download ON Coupon_Download.Coupon_No = Coupon.Coupon_No WHERE NOW() >= Start_Date AND NOW() <= End_Date GROUP BY Event.Event_No ORDER BY Event.Event_No DESC;";
		}
		else
		{
			$y = $_GET["lon"];
			$x = $_GET["lat"];
			$sql = "SELECT count(Coupon_Download.Coupon_No) AS cnt, Event.Event_No, Event_Name, Region, Start_Date, End_Date, Pub_Coupon_Cnt from Coupon RIGHT OUTER join Event On Coupon.Event_No = Event.Event_No LEFT OUTER JOIN Coupon_Download ON Coupon_Download.Coupon_No = Coupon.Coupon_No WHERE NOW() >= Start_Date AND NOW() <= End_Date AND ST_Distance_Sphere(Point(Place_Y, Place_X), Point('$y', '$x')) < Radius GROUP BY Event.Event_No ORDER BY Event.Event_No DESC;";
			// $sql = "SELECT Event_No, Mem_No, Event_Name, Start_Date, End_Date, Place_X, Place_Y, Radius FROM Event WHERE ST_Distance_Sphere(Point(Place_Y, Place_X), Point('$y', '$x')) < Radius;";
		}
     
	  
        $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>지금!여기! | 내 주변 광고 목록 보기</title>

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
		.col-lg-12 {padding-right: 5px; padding-left: 5px;}
		
	
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
                    <h3>내 주변 광고 목록</h3>
                    
                </div>
            </div>
		
        <div class="row">
            <div class="col-lg-12">
                <div class="animated fadeInUp">

                    <div class="ibox">
                        <div class="ibox-title" >
                           <h5>현재 진행 중인 내 주변에 등록된 이벤트 목록입니다.</h5>
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
                                    <tr><!--
                                        <td class="project-status">
                                            <span class="label label-primary">진행중</span>
                                        </td>-->
                                        <td class="project-title" colspan=4 style="border-bottom: none;">
                                            <span class="label label-<?=$status_arr[0]?>"><?=$status_arr[1]?></span><a href="user_ad_detail.php?evtid=<?=$row["Event_No"]?>"> <?=$row["Event_Name"]?></a>
                                            <br/>
                                          
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td class="project-status">
	                                            <a href="user_ad_detail.php?evtid=<?=$row["Event_No"]?>"><span><?=$row["Region"]?></span>
	                                        </td>
                                        <td class="project-completion">
                                                <small>남은쿠폰: <?=$row["Pub_Coupon_Cnt"]-$row["cnt"]?></small>
                                                <div class="progress progress-mini">
                                                    <div style="width: <?=ceil($row["cnt"]/$row["Pub_Coupon_Cnt"]*100)?>%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-people">
                                            <small><!--<?=substr($row["Start_Date"],0,16) ?> ~ --><?=substr($row["End_Date"],2,14) ?></small>
                                        </td>
                                        <td class="project-actions">
                                            
                                            <a href="user_ad_detail.php?evtid=<?=$row["Event_No"]?>" class="btn btn-white btn-sm"><i class="fa fa-download"></i></a>
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
                                            이 근처에는 등록된 이벤트가 없습니다.
                                        </td>
									</tr>
									<?php
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

    <!-- Kakao Map-->
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=6848e0405638b8ab046254ac6c306b55&libraries=services"></script>
    
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

			get_current_address();
        });

	
		function get_current_address(){
		
		
			var output = document.getElementById("addressText");
			
			// HTML5의 geolocation으로 사용할 수 있는지 확인합니다 
			if (navigator.geolocation) {
				
				// GeoLocation을 이용해서 접속 위치를 얻어옵니다
				navigator.geolocation.getCurrentPosition(geo_success, geo_error);
	  
			} else { // HTML5의 GeoLocation을 사용할 수 없을때 마커 표시 위치와 인포윈도우 내용을 설정합니다           
			  
				var content = '<p>' + '위치 정보를 지원하지 않는 브라우저입니다.' + 	'</p>';
				output.innerHTML = content;
						
			}
		}
		//var content = '<div class="bAddr">' + '위치 정보를 가져오지 못했습니다.' + 	'</div>';
		//document.getElementById("addressText").innerHTML = content;
        function geo_success(position) {
               
			var lat = position.coords.latitude; // 위도
			var lon = position.coords.longitude; // 경도
          			
			// 주소-좌표 변환 객체를 생성합니다
			var geocoder = new daum.maps.services.Geocoder();	
			var output = document.getElementById("addressText");
			geocoder.coord2Address(lon, lat, function(result, status) {
				
				if (status === daum.maps.services.Status.OK) {
									
					var detailAddr = !!result[0].address ?  result[0].address.address_name  : '';
					var content = '<p> 현재 위치 : ' + detailAddr + 	'</p>';
					output.innerHTML = content;
					
			
				}
			});
		}
		
		function geo_error() {
			output.innerHTML = "Unable to retrieve your location";
		}

		


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
