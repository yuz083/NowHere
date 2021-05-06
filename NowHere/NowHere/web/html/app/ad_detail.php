<?php
		
        //code goes here
		include 'global.php';
		include 'db.php';
		include 'inc_status.php';
		$userid = $_SESSION["Mem_No"];
		$evtid = $_GET["evtid"];
		if ($userid == "")
		{
			header("location:login.php");
		}
		
		include 'inc_down_cnt.php';

		$sql = "SELECT Event_Name, Reg_Name, Event_Contact_No, Start_Date, End_Date, Event_Content, Place_X, Place_Y, Radius, Cat_Name, Event_Type_Name FROM Event LEFT JOIN (Category, Event_Type) ON Event.Category_No = Category.Category_No AND Event.Event_Type_Code = Event_Type.Event_Type_No WHERE Event.Event_No = '$evtid' ";
		
		$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>지금!여기! | 광고상세정보</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

	<!-- 다음지도 스타일 -->
	<style>
		.info {position:relative;top:5px;left:5px;border-radius:6px;border: 1px solid #ccc;border-bottom:2px solid #ddd;font-size:12px;padding:5px;background:#fff;list-style:none;margin:0;} 
		.info:nth-of-type(n) {border:0; box-shadow:0px 1px 2px #888;}    
		.info .label {display:inline-block;width:50px;}
		.number {font-weight:bold;color:#00a0e9;}
		@media (max-width: 992px) {
			#map {max-width:100%;height: 257px;flex:0 0 100%}
		}
		@media (max-width: 450px) {
			#page-wrapper {padding: 0 0px}
		}
		.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto { width: unset;}

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
                    <h3>광고상세정보</h3>
                    
                </div>
            </div>
   <?php 
			if ($result->num_rows > 0) 
			{ 
				$row = $result->fetch_assoc();
				$st = date_status($row["Start_Date"], $row["End_Date"]);
				
	?>
            <div class="col-lg-12">
                <div class=" wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                        <a href="ad_edit.php?evtid=<?=$evtid?>" class="btn btn-white btn-xs float-right">광고수정</a>
                                        <h3><?=$row["Event_Name"]?></h3>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-sm-right"><dt>상태:</dt> </div>
                                        <div class="col-sm-8 text-sm-left"><dd class="mb-1"><span class="label label-<?=$st[0]?>"><?=$st[1]?></span></dd></div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-sm-right"><dt>광고 담당자:</dt> </div>
                                        <div class="col-sm-8 text-sm-left"><dd class="mb-1"><?=$row["Reg_Name"]?></dd> </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-sm-right"><dt>담당자 전화번호:</dt> </div>
                                        <div class="col-sm-8 text-sm-left"> <dd class="mb-1"><?=$row["Event_Contact_No"]?></dd></div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-sm-right"><dt>이벤트 유형:</dt> </div>
                                        <div class="col-sm-8 text-sm-left"> <dd class="mb-1"><a href="#" class="text-navy"><?=$row["Event_Type_Name"]?></a> </dd></div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-sm-right"> <dt>이벤트 카테고리:</dt></div>
                                        <div class="col-sm-8 text-sm-left"> <dd class="mb-1"> <?=$row["Cat_Name"]?> </dd></div>
                                    </dl>
									<dl class="row mb-0">
                                        <div class="col-sm-4 text-sm-right">
                                            <dt>광고 시작일:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1"><?=substr($row["Start_Date"],0,16)?></dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-sm-right">
                                            <dt>광고 종료일:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1"> <?=substr($row["End_Date"],0,16)?></dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-sm-right">
                                            <dt>조회수:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1"> 12 회</dd>  
                                        </div>
                                    </dl>
									<dl class="row mb-0">
                                        <div class="col-sm-4 text-sm-right">
                                            <dt>쿠폰 다운로드수:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd>
                                                <div class="progress m-b-1">
                                                    <div style="width: <?=ceil($downcnt/$pubcnt*100)?>%;" class="progress-bar progress-bar-striped progress-bar-animated"></div>
                                                </div>
                                                <strong><?=$downcnt?> / <?=$pubcnt?>(<?=ceil($downcnt/$pubcnt*100)?>%)</strong>의 쿠폰이 소진되었습니다.
                                            </dd>
                                        </div>
                                    </dl>

                                </div>
								<div  class="col-sm-1" >
																	
                                </div>
                                <div  class="col-sm-4" id="map" >
																	
                                </div>
								
                            </div>
                     
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                

                                <div class="panel-body">

									<div class="ibox">
										<div class="ibox-content">
											
											
											<?=$row["Event_Content"]?>
		

										</div>
									</div>
                                </div>

                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
					}

	$conn->close();
?>                       
      
      

        </div>
        </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

	<!-- Kakao Map -->
	<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=6848e0405638b8ab046254ac6c306b55"></script>

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

	// 지도 API 표시
	var mapContainer = document.getElementById('map'); // 지도를 표시할 div 
	var centerPosition = new daum.maps.LatLng(<?=$row["Place_X"]?>, <?=$row["Place_Y"]?>);

    mapOption = { 
        center: centerPosition, // 지도의 중심좌표
        level: 7 // 지도의 확대 레벨 
    }; 

	var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

	  // 마우스로 오른쪽 클릭한 위치입니다 
	//var rClickPosition = mouseEvent.latLng; 

	// 원의 반경을 표시할 선 객체를 생성합니다
	//var polyline = new daum.maps.Polyline({
	//	path: [centerPosition, rClickPosition], // 선을 구성하는 좌표 배열입니다. 원의 중심좌표와 클릭한 위치로 설정합니다
	//	strokeWeight: 3, // 선의 두께 입니다
	//	strokeColor: '#00a0e9', // 선의 색깔입니다
	//	strokeOpacity: 1, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
	//	strokeStyle: 'solid' // 선의 스타일입니다
	//});
	
	// 원 객체를 생성합니다
	var circle = new daum.maps.Circle({ 
		center : centerPosition, // 원의 중심좌표입니다
		radius: <?=$row["Radius"]?>, // 원의 반지름입니다 m 단위 이며 선 객체를 이용해서 얻어옵니다
		strokeWeight: 1, // 선의 두께입니다
		strokeColor: '#00a0e9', // 선의 색깔입니다
		strokeOpacity: 0.5, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
		strokeStyle: 'solid', // 선의 스타일입니다
		fillColor: '#00a0e9', // 채우기 색깔입니다
		fillOpacity: 0.5  // 채우기 불투명도입니다 
	});
	
	var radius = Math.round(circle.getRadius()), // 원의 반경 정보를 얻어옵니다
		content = getTimeHTML(radius); // 커스텀 오버레이에 표시할 반경 정보입니다
	
	//var coord = new daum.maps.Coords(centerPosition.toCoords().getX + radius, centerPosition.toCoords().getY);

	//var labelPosition = coord.toLatLng();
		
	// 반경정보를 표시할 커스텀 오버레이를 생성합니다
	var radiusOverlay = new daum.maps.CustomOverlay({
		content: content, // 표시할 내용입니다
		position: centerPosition, // 표시할 위치입니다. 클릭한 위치로 설정합니다
		xAnchor: 0,
		yAnchor: 0,
		zIndex: 1 
	});  

	// 원을 지도에 표시합니다
	circle.setMap(map); 
	
	// 선을 지도에 표시합니다
	//polyline.setMap(map);
	
	// 반경 정보 커스텀 오버레이를 지도에 표시합니다
	radiusOverlay.setMap(map);


	// 그리기 상태를 그리고 있지 않는 상태로 바꿉니다
	drawingFlag = false;
	
	// 중심 좌표를 초기화 합니다  
	centerPosition = null;
	
	// 그려지고 있는 원, 선, 커스텀오버레이를 지도에서 제거합니다
	drawingCircle.setMap(null);
	drawingLine.setMap(null);   
	drawingOverlay.setMap(null);


	// 마우스 우클릭 하여 원 그리기가 종료됐을 때 호출하여 
	// 그려진 원의 반경 정보와 반경에 대한 도보, 자전거 시간을 계산하여
	// HTML Content를 만들어 리턴하는 함수입니다
	function getTimeHTML(distance) {

		// 도보의 시속은 평균 4km/h 이고 도보의 분속은 67m/min입니다
		var walkkTime = distance / 67 | 0;
		var walkHour = '', walkMin = '';

		// 계산한 도보 시간이 60분 보다 크면 시간으로 표시합니다
		if (walkkTime > 60) {
			walkHour = '<span class="number">' + Math.floor(walkkTime / 60) + '</span>시간 '
		}
		walkMin = '<span class="number">' + walkkTime % 60 + '</span>분'

	
		// 거리와 도보 시간, 자전거 시간을 가지고 HTML Content를 만들어 리턴합니다
		var content = '<ul class="info">';
		content += '    <li>';
		content += '        <span class="label">반경</span><span class="number">' + distance + '</span>m';
		content += '    </li>';
		content += '    <li>';
		content += '        <span class="label">도보</span>' + walkHour + walkMin;
		content += '    </li>';
		content += '</ul>'

		return content;
	}
    </script>
</body>

</html>
