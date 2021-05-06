<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>여기! 어디! | 광고 등록</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/plugins/summernote/summernote-bs4.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">
<?php
  include_once('./php/navbar.php');
  ?>
  <?php
  include_once('./php/rownavbar.php');
  ?>
 

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>광고 등록</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <strong><a href="index.html">일반</a></strong>
                        </li>
                        <li class="breadcrumb-item">
                            <a>이벤트</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a>예약</a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content">

            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>광고 등록</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content no-padding">

                        <div class="summernote">
                            <h3>광고 내용 등록</h3>
                            광고 내용을 자유롭게 등록해주세요.
                            <br/>
                            <br/>
                            <!--<ul>
                                <li>Remaining essentially unchanged</li>
                                <li>Make a type specimen book</li>
                                <li>Unknown printer</li>
                            </ul>-->
                        </div>

                    </div>
                </div>
            </div>
            </div>
            <!--
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">

                        <div class="ibox-content">

                            <h2>
                                Summernote
                            </h2>
                            <p>
                                Super Simple WYSIWYG Editor on Bootstrap
                            </p>

                            <div class="alert alert-warning">
                                Full documentation for Summernote.js, including examples and API calls, keybored shortcuts, PHP Examples, Django installation, and Rails (gem) integration can be found at:
                                <a href="http://summernote.org/deep-dive/">http://summernote.org/deep-dive/</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        -->
        <button type="button" class="btn btn-w-m btn-primary">등록</button>


            </div>
        <div class="footer">
            <div class="float-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2018
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

    <!-- SUMMERNOTE -->
    <script src="js/plugins/summernote/summernote-bs4.js"></script>

    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

       });
    </script>

</body>

</html>
