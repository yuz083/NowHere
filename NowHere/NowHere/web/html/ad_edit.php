<?php
		
        //code goes here
		include 'global.php';
		include 'db.php';
		$userid = $_SESSION["Mem_No"];
		$evtid = $_GET["evtid"];
		if ($userid == "")
		{
			header("location:login.php");
		}

		if ($evtid == "")
		{
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}

		$sql = "SELECT * FROM Category;";
		$sql .= "SELECT * FROM Event_Type;";
		$sql .= "SELECT * FROM Event WHERE Event.Event_No = '$evtid';";

		if ($conn->multi_query($sql)) 
		{
			if ($result = $conn->store_result(MYSQLI_STORE_RESULT_COPY_DATA))
			{
				while ($row = $result->fetch_assoc()) {
						$catArray[] = $row;
				}

				if ($conn->next_result())
				{
					$result =	$conn->store_result(MYSQLI_STORE_RESULT_COPY_DATA);
						
					while ($row = $result->fetch_assoc()) {
						$typeArray[] = $row;
					}

					if ($conn->next_result())
					{
						$result = $conn->store_result(MYSQLI_STORE_RESULT_COPY_DATA);
					}
				}
			} 
		}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>지금!여기! | 광고 수정</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="css/plugins/summernote/summernote-bs4.css" rel="stylesheet">
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<style>
		.info {position:relative;top:5px;left:5px;border-radius:6px;border: 1px solid #ccc;border-bottom:2px solid #ddd;font-size:12px;padding:5px;background:#fff;list-style:none;margin:0;} 
		.info:nth-of-type(n) {border:0; box-shadow:0px 1px 2px #888;}    
		.info .label {display:inline-block;width:50px;}
		.number {font-weight:bold;color:#00a0e9;} 
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
				<h2>광고수정</h2>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="index.html">홈</a>
					</li>
					<li class="breadcrumb-item active">
						<strong>광고수정</strong>
					</li>
				</ol>
			</div>
		</div>
<?php 
			if ($result->num_rows > 0) 
			{ 
				$row = $result->fetch_assoc();
				
?>
		<div class="col-lg-12">
                    <div class="ibox ">
             
                        <div class="ibox-content">
                            <form role="form" id="form" method="POST" action="ad_update.php">
								<input type="hidden" name="Event_No" class="form-control" value="<?=$evtid?>">
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">제목</label>
                                    <div class="col-sm-10"><input type="text" name="Event_Name" class="form-control" value="<?=$row["Event_Name"]?>"></div>
                                </div>
							    <div class="form-group row"><label class="col-sm-2 col-form-label">이벤트 카테고리</label>
                                    <div class="col-md-4"><select class="form-control m-b" name="Category_No" >
                                       <?php 
											
											foreach ( $catArray as $v)
											{
												$selected ="";
												
												if ($v["Category_No"] == $row["Category_No"])
													$selected = "selected='selected'";

												echo "<option value=". $v["Category_No"]. " ".$selected . "> ". $v["Cat_Name"]." </option>";
											}
											
											
										?>
                                    </select>

                                    </div>
									<label class="col-sm-2 col-form-label">이벤트 타입</label>
                                    <div class="col-md-4"><select class="form-control m-b" name="Event_Type_No" >
                                        <?php 
											
											// output data of each row
											foreach ($typeArray as $v)
											{
												$selected ="";
												if ($v["Event_Type_No"] == $row["Event_Type_Code"])
													$selected = "selected='selected'";
												
												echo "<option value=". $v["Event_Type_No"]. " ".$selected . "> ". $v["Event_Type_Name"]." </option>";
											}
									
										?>
                                    </select>

                                    </div>
                                </div>
								<div class="form-group  row">
									<label for="dtp_input1" class="col-sm-2 col-form-label">시작일</label>
                                    <div class="col-md-4 input-group date form_datetime" data-date="<?=date("Y-m-d\TH:i:s\Z")?>" data-date-format="yyyy-mm-dd HH:ii" data-link-field="dtp_input1">
                                    <input type="text" class="form-control" name="Start_Date" value="<?=substr($row["Start_Date"],0,16)?>" readonly><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                                    <input type="hidden" id="dtp_input1" value="" /><br/>
									
									<label for="dtp_input2" class="col-sm-2 col-form-label">종료일</label>
                                    <div class="col-md-4 input-group date form_datetime" data-date="<?=date("Y-m-d\TH:i:s\Z")?>" data-date-format="yyyy-mm-dd HH:ii" data-link-field="dtp_input2">
                                    <input type="text" class="form-control" name="End_Date" value="<?=substr($row["End_Date"],0,16)?>" readonly><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                                    <input type="hidden" id="dtp_input2" value="" /><br/>

								</div>
								<div class="form-group  row"><label class="col-sm-2 col-form-label">담당자 이름</label>
                                    <div class="col-md-4"><input type="text" class="form-control" name="Reg_Name" value="<?=$row["Reg_Name"]?>"></div>
									<label class="col-sm-2 col-form-label">담당자 전화번호</label>
                                    <div class="col-md-4"><input type="text" class="form-control" name="Event_Contact_No" value="<?=$row["Event_Contact_No"]?>"></div>
								</div>
								<div class="form-group  row"><label class="col-sm-2 col-form-label">대상 연령대</label>
                                    <div class="col-md-4"><select class="form-control m-b" name="Target_Age" >
										<option value='0'> 구분안함 </option>
                                        <?php 
											for ($x = 10; $x <= 80; $x += 10)
											{
												// output data of each row
												$selected ="";
												if ($x == $row["Target_Age"])
													$selected = "selected='selected'";
												echo "<option value=". $x. " ".$selected. "> ". $x."대 </option>";
												
											}
										?>
                                    </select></div>

									<label class="col-sm-2 col-form-label">대상 성별</label>
                                    <div class="col-md-4"><select class="form-control m-b" name="Target_Gender" >
										<option value='0'> 구분안함 </option>
										<option value='1'> 남자만 </option>
										<option value='2'> 여자만 </option>
									</select>
									</div>
								</div>
                                <div class="form-group row"><label class="col-sm-2 col-form-label" >발행 쿠폰 수</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="Pub_Coupon_Cnt" value="<?=$row["Pub_Coupon_Cnt"]?>"> <span class="form-text m-b-none">발행할 총 쿠폰 수를 입력합니다.</span>
                                    </div>
                                </div>
                                
								<div class="form-group row"><label class="col-sm-2 col-form-label">이벤트 위치 및 반경</label>
									<div class="col-sm-6">
										
										 <figure>
											<div id="map" style="max-width:100%; height:300px;"></div>
										</figure>
                                    </div>
                                    <div class="col-sm-3">
										<label class="col-sm-3 col-form-label">위도</label><input type="text" class="form-control" id="Lat" name="Place_X" value="<?=$row["Place_X"]?>">
										<label class="col-sm-3 col-form-label">경도</label><input type="text" class="form-control" id="Lng" name="Place_Y" value="<?=$row["Place_Y"]?>">
										<label class="col-sm-3 col-form-label">반경</label><input type="text" class="form-control" id="Rad" name="Radius" value="<?=$row["Radius"]?>">
										
                                    </div>
                                </div>
								
								<div class="hr-line-dashed"></div>
								<textarea id="summernote" name="editordata">
									<?=$row["Event_Content"]?>
								</textarea>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white btn-sm" type="submit">취소</button>
                                        <button class="btn btn-primary btn-sm" type="submit">변경</button>
										
                                    </div>
                                </div>
								
                            </form>
							
                        </div>
				
                    </div>
        </div>
		
  
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
<script src="js/plugins/summernote/summernote-bs4.js"></script>

<!-- Jquery Validate -->
<script src="js/plugins/validate/jquery.validate.min.js"></script>
<!--- Kakao Map---->
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=6848e0405638b8ab046254ac6c306b55"></script>
<!-- Date Picker -->
<script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.ko.js"></script>

<script>



	$(document).ready(function(){

		$('#summernote').summernote();

		$('#loading-example-btn').click(function () {
			btn = $(this);
			simpleLoad(btn, true)

			// Ajax example
//                $.ajax().always(function () {
//                    simpleLoad($(this), false)
//                });

			simpleLoad(btn, false)

		});
		
		$("#form").validate({
                 rules: {
                     Event_Contact_No: {
                         number: true,
                         maxlength: 15
                     },
                     Event_Name: {
                         required: true,
                         maxlength: 60
                     },
					 Start_Date: {
                         required: true,
                         maxlength: 20
                     },
					 End_Date: {
                         required: true,
                         maxlength: 20
                     }
                 }
             });
	});
	
   $('.form_datetime').datetimepicker({
        language:  'ko',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });

	// 지도 API 표시
	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new daum.maps.LatLng(<?=$row["Place_X"]?>, <?=$row["Place_Y"]?>), // 지도의 중심좌표
        level: 7 // 지도의 확대 레벨 
    }; 

	var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

	
	// 지도에 마커와 인포윈도우를 표시하는 함수입니다
	function displayMarker(locPosition, message) {

		// 마커를 생성합니다
		var marker = new daum.maps.Marker({  
			map: map, 
			position: locPosition
		}); 
		
		var iwContent = message, // 인포윈도우에 표시할 내용
			iwRemoveable = true;

		// 인포윈도우를 생성합니다
		var infowindow = new daum.maps.InfoWindow({
			content : iwContent,
			removable : iwRemoveable
		});
		
		// 인포윈도우를 마커위에 표시합니다 
		infowindow.open(map, marker);
		
		// 지도 중심좌표를 접속위치로 변경합니다
		map.setCenter(locPosition);      
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

	var drawingFlag = false; // 원이 그려지고 있는 상태를 가지고 있을 변수입니다
	var centerPosition; // 원의 중심좌표 입니다
	var drawingCircle; // 그려지고 있는 원을 표시할 원 객체입니다
	var drawingLine; // 그려지고 있는 원의 반지름을 표시할 선 객체입니다
	var drawingOverlay; // 그려지고 있는 원의 반경을 표시할 커스텀오버레이 입니다
	var drawingDot; // 그려지고 있는 원의 중심점을 표시할 커스텀오버레이 입니다

	var circles = []; // 클릭으로 그려진 원과 반경 정보를 표시하는 선과 커스텀오버레이를 가지고 있을 배열입니다

	// 지도에 클릭 이벤트를 등록합니다
	daum.maps.event.addListener(map, 'click', function(mouseEvent) {
		
		removeCircles();
		// 클릭 이벤트가 발생했을 때 원을 그리고 있는 상태가 아니면 중심좌표를 클릭한 지점으로 설정합니다
		if (!drawingFlag) {    
			
			// 상태를 그리고있는 상태로 변경합니다
			drawingFlag = true; 
			
			// 원이 그려질 중심좌표를 클릭한 위치로 설정합니다 
			centerPosition = mouseEvent.latLng; 
			
			// 그려지고 있는 원의 반경을 표시할 선 객체를 생성합니다
			if (!drawingLine) {
				drawingLine = new daum.maps.Polyline({
					strokeWeight: 3, // 선의 두께입니다
					strokeColor: '#00a0e9', // 선의 색깔입니다
					strokeOpacity: 1, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
					strokeStyle: 'solid' // 선의 스타일입니다
				});    
			}
			
			// 그려지고 있는 원을 표시할 원 객체를 생성합니다
			if (!drawingCircle) {                    
				drawingCircle = new daum.maps.Circle({ 
					strokeWeight: 1, // 선의 두께입니다
					strokeColor: '#00a0e9', // 선의 색깔입니다
					strokeOpacity: 0.1, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
					strokeStyle: 'solid', // 선의 스타일입니다
					fillColor: '#00a0e9', // 채우기 색깔입니다
					fillOpacity: 0.2 // 채우기 불투명도입니다 
				});     
			}
			
			// 그려지고 있는 원의 반경 정보를 표시할 커스텀오버레이를 생성합니다
			if (!drawingOverlay) {
				drawingOverlay = new daum.maps.CustomOverlay({
					xAnchor: 0,
					yAnchor: 0,
					zIndex: 1
				});              
			}
		}
		});

	// 지도에 마우스무브 이벤트를 등록합니다
	// 원을 그리고있는 상태에서 마우스무브 이벤트가 발생하면 그려질 원의 위치와 반경정보를 동적으로 보여주도록 합니다
	daum.maps.event.addListener(map, 'mousemove', function (mouseEvent) {
			
		// 마우스무브 이벤트가 발생했을 때 원을 그리고있는 상태이면
		if (drawingFlag) {

			// 마우스 커서의 현재 위치를 얻어옵니다 
			var mousePosition = mouseEvent.latLng; 
			
			// 그려지고 있는 선을 표시할 좌표 배열입니다. 클릭한 중심좌표와 마우스커서의 위치로 설정합니다
			var linePath = [centerPosition, mousePosition];     
			
			// 그려지고 있는 선을 표시할 선 객체에 좌표 배열을 설정합니다
			drawingLine.setPath(linePath);
			
			// 원의 반지름을 선 객체를 이용해서 얻어옵니다 
			var length = drawingLine.getLength();
			
			if(length > 0) {
				
				// 그려지고 있는 원의 중심좌표와 반지름입니다
				var circleOptions = { 
					center : centerPosition, 
				radius: length,                 
				};
				
				// 그려지고 있는 원의 옵션을 설정합니다
				drawingCircle.setOptions(circleOptions); 
					
				// 반경 정보를 표시할 커스텀오버레이의 내용입니다
				var radius = Math.round(drawingCircle.getRadius()),   
				content = '<div class="info">반경 <span class="number">' + radius + '</span>m</div>';
				
				// 반경 정보를 표시할 커스텀 오버레이의 좌표를 마우스커서 위치로 설정합니다
				drawingOverlay.setPosition(mousePosition);
				
				// 반경 정보를 표시할 커스텀 오버레이의 표시할 내용을 설정합니다
				drawingOverlay.setContent(content);
				
				// 그려지고 있는 원을 지도에 표시합니다
				drawingCircle.setMap(map); 
				
				// 그려지고 있는 선을 지도에 표시합니다
				drawingLine.setMap(map);  
				
				// 그려지고 있는 원의 반경정보 커스텀 오버레이를 지도에 표시합니다
				drawingOverlay.setMap(map);
				
			} else { 
				
				drawingCircle.setMap(null);
				drawingLine.setMap(null);    
				drawingOverlay.setMap(null);
				
			}
		}     
	});     
		
	// 지도에 마우스 오른쪽 클릭이벤트를 등록합니다
// 원을 그리고있는 상태에서 마우스 오른쪽 클릭 이벤트가 발생하면
// 마우스 오른쪽 클릭한 위치를 기준으로 원과 원의 반경정보를 표시하는 선과 커스텀 오버레이를 표시하고 그리기를 종료합니다
daum.maps.event.addListener(map, 'rightclick', function (mouseEvent) {

    if (drawingFlag) {

        // 마우스로 오른쪽 클릭한 위치입니다 
        var rClickPosition = mouseEvent.latLng; 

        // 원의 반경을 표시할 선 객체를 생성합니다
        var polyline = new daum.maps.Polyline({
            path: [centerPosition, rClickPosition], // 선을 구성하는 좌표 배열입니다. 원의 중심좌표와 클릭한 위치로 설정합니다
            strokeWeight: 3, // 선의 두께 입니다
            strokeColor: '#00a0e9', // 선의 색깔입니다
            strokeOpacity: 1, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
            strokeStyle: 'solid' // 선의 스타일입니다
        });
        
        // 원 객체를 생성합니다
        var circle = new daum.maps.Circle({ 
            center : centerPosition, // 원의 중심좌표입니다
            radius: polyline.getLength(), // 원의 반지름입니다 m 단위 이며 선 객체를 이용해서 얻어옵니다
            strokeWeight: 1, // 선의 두께입니다
            strokeColor: '#00a0e9', // 선의 색깔입니다
            strokeOpacity: 0.1, // 선의 불투명도입니다 0에서 1 사이값이며 0에 가까울수록 투명합니다
            strokeStyle: 'solid', // 선의 스타일입니다
            fillColor: '#00a0e9', // 채우기 색깔입니다
            fillOpacity: 0.2  // 채우기 불투명도입니다 
        });
        
        var radius = Math.round(circle.getRadius()), // 원의 반경 정보를 얻어옵니다
            content = getTimeHTML(radius); // 커스텀 오버레이에 표시할 반경 정보입니다

        
        // 반경정보를 표시할 커스텀 오버레이를 생성합니다
        var radiusOverlay = new daum.maps.CustomOverlay({
            content: content, // 표시할 내용입니다
            position: rClickPosition, // 표시할 위치입니다. 클릭한 위치로 설정합니다
            xAnchor: 0,
            yAnchor: 0,
            zIndex: 1 
        });  

        // 원을 지도에 표시합니다
        circle.setMap(map); 
        
        // 선을 지도에 표시합니다
        polyline.setMap(map);
        
        // 반경 정보 커스텀 오버레이를 지도에 표시합니다
        radiusOverlay.setMap(map);

		//alert(centerPosition.getLat() +"-" + centerPosition.getLng() +"-" +radius);
        document.getElementById('Lat').value = centerPosition.getLat();
		document.getElementById('Lng').value = centerPosition.getLng();
		document.getElementById('Rad').value = radius;

        // 배열에 담을 객체입니다. 원, 선, 커스텀오버레이 객체를 가지고 있습니다
        var radiusObj = {
            'polyline' : polyline,
            'circle' : circle,
            'overlay' : radiusOverlay
        };
        
        // 배열에 추가합니다
        // 이 배열을 이용해서 "모두 지우기" 버튼을 클릭했을 때 지도에 그려진 원, 선, 커스텀오버레이들을 지웁니다
        circles.push(radiusObj);   
    
        // 그리기 상태를 그리고 있지 않는 상태로 바꿉니다
        drawingFlag = false;
        
        // 중심 좌표를 초기화 합니다  
        centerPosition = null;
        
        // 그려지고 있는 원, 선, 커스텀오버레이를 지도에서 제거합니다
        drawingCircle.setMap(null);
        drawingLine.setMap(null);   
        drawingOverlay.setMap(null);
    }
});    
    
// 지도에 표시되어 있는 모든 원과 반경정보를 표시하는 선, 커스텀 오버레이를 지도에서 제거합니다
function removeCircles() {         
    for (var i = 0; i < circles.length; i++) {
        circles[i].circle.setMap(null);    
        circles[i].polyline.setMap(null);
        circles[i].overlay.setMap(null);
    }         
    circles = [];
}

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

    // 자전거의 평균 시속은 16km/h 이고 이것을 기준으로 자전거의 분속은 267m/min입니다
    var bycicleTime = distance / 227 | 0;
    var bycicleHour = '', bycicleMin = '';

    // 계산한 자전거 시간이 60분 보다 크면 시간으로 표출합니다
    if (bycicleTime > 60) {
        bycicleHour = '<span class="number">' + Math.floor(bycicleTime / 60) + '</span>시간 '
    }
    bycicleMin = '<span class="number">' + bycicleTime % 60 + '</span>분'

    // 거리와 도보 시간, 자전거 시간을 가지고 HTML Content를 만들어 리턴합니다
    var content = '<ul class="info">';
    content += '    <li>';
    content += '        <span class="label">총거리</span><span class="number">' + distance + '</span>m';
    content += '    </li>';
    content += '    <li>';
    content += '        <span class="label">도보</span>' + walkHour + walkMin;
    content += '    </li>';
    content += '    <li>';
    content += '        <span class="label">자전거</span>' + bycicleHour + bycicleMin;
    content += '    </li>';
    content += '</ul>'

    return content;
}

	
</script>
</body>
<?php 
					}
	$result->free();
	$conn->close();
?>
</html>