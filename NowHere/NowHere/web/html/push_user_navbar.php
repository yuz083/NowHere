<?php
		include_once('./global.php');
?>
<script>
		
	function onAdlistByPos(){

		
		// HTML5의 geolocation으로 사용할 수 있는지 확인합니다 
		if (navigator.geolocation) {
			
			// GeoLocation을 이용해서 접속 위치를 얻어옵니다
			navigator.geolocation.getCurrentPosition(success, error);

		} else { // HTML5의 GeoLocation을 사용할 수 없을때 마커 표시 위치와 인포윈도우 내용을 설정합니다           
		  
			location.replace("user_ad_list_by_pos.php?coords=no");
					
		}
	}

	function success(position) {
		   
		var lat = position.coords.latitude; // 위도
		var lon = position.coords.longitude; // 경도
				
		location.replace( "user_ad_list_by_pos.php?coords=yes&lat=" + lat +"&lon=" + lon);
	}

	function error() {
		location.replace("user_ad_list_by_pos.php?coords=no");
	}

</script>
<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img alt="image"  src="img/logo_s.png"/>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold"><?php echo $_SESSION["Mem_Name"]?></span>
                            <span class="text-muted text-xs block">사용자 <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="profile.html">개인정보</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">로그아웃</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                      <img alt="image"  src="img/logo_s2.png"/>
                    </div>
                </li>
              
               
				<li class="active">
                    <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">광고</span> </a>
                    <ul class="nav nav-second-level">
					    <li><a href="user_ad_list.php">전체 이벤트</a></li>
                        
                        <li><a href="#" onclick="javascript:onAdlistByPos();">내 주변 이벤트</a></li>
              
                        <li><a href="user_ad_down.php">쿠폰 받은 이벤트</a></li>
					</ul>
                </li>
            
            </ul>

        </div>
    </nav>

