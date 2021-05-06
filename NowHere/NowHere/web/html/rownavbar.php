        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
       
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">지금!여기! 광고주 페이지입니다.</span>
                </li>
               
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html" class="dropdown-item">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> 16개의 알림이 있습니다.
                                    <span class="float-right text-muted small">4분전</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html" class="dropdown-item">
                                    <strong>모든 알림 보기</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <?php
                	if ($userid == "")
					{
				?>
                    <a href="logout.php">
                        <i class="fa fa-sign-in"></i>로그인
                    </a>
                <?php
            }
                    else
             {
                ?>	
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i>로그아웃
                    </a>
                <?php
                	}
                ?>
                </li>
            </ul>

        </nav>
        </div>
