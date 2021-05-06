<?php
		include_once('./global.php');
?>
<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img alt="image" src="img/logo_s.png"/>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold"><?php echo $_SESSION["Mem_Name"]?></span>
                            <span class="text-muted text-xs block">광고주 <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="profile.html">개인정보</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">로그아웃</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <img alt="image" src="img/logo_s2.png"/>
                    </div>
                </li>
              
               
				<li class="active">
                    <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">광고</span> </a>
                    <ul class="nav nav-second-level">
					    <li class="active"><a href="ad_list.php">광고목록</a></li>
                        
                        <li><a href="ad_new.php">광고등록</a></li>
              
                        <li><a href="ad_viewer_list.php">쿠폰수신자목록</a></li>
					</ul>
                </li>
            
      
            </ul>

        </div>
    </nav>