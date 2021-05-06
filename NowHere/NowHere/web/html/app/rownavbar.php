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
