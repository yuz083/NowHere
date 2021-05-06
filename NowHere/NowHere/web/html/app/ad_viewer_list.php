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
		

		

		$sql = "SELECT Event_No,Event_Name FROM Event WHERE Event.Mem_No = '$userid' ORDER BY Event_No DESC;";

		if ($result = $conn->query($sql)){
			while ($row = $result->fetch_assoc()) {
						$catArray[] = $row;
				}
		}

		if (empty($_GET["evtid"]))
		{
			$evtid = $catArray[0]["Event_No"];
		}
		else
		{
			$evtid = $_GET["evtid"];
		}
		include 'inc_down_cnt.php';
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>지금!여기! | 쿠폰 수신자 보기 </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
<style>
		.col-lg-12 {padding-right: 5px; padding-left: 5px;}
		.label{padding: 0 0}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td { padding: 2px}
	</style>


</head>

<body>

    <div id="wrapper">
	
  <?php
		include_once('./navbar.php');
		include_once('./rownavbar.php');
	?>
    


            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h3>쿠폰 발급 내역</h3>
                   
                </div>
                <div class="col-lg-2">

                </div>
            </div>

        <div class="animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">

                            <div class="m-b-lg">

							<div class="form-group row"><label class="col-sm-2 col-form-label">관리할 이벤트</label>

                                    <div class="col-sm-10"><select class="form-control m-b" id="sel_event">
                                        <option value=0 >선택하세요...</option>
											<?php
											foreach ( $catArray as $v)
											{
												$selected ="";
												
												if ($v["Event_No"] == $evtid)
													$selected = "selected='selected'";

												echo "<option value=". $v["Event_No"]. " ".$selected . "> ". $v["Event_Name"]." </option>";
											}
											?>
                                        
                                    </select></div>
							</div>
                                
                                <div class="m-t-md">

                                  
<?php
	$sql = "SELECT Coupon.Coupon_No, Coupon_code, Member.Mem_No, Mem_Name, User_ID, Down_Date, Use_Stat FROM Coupon LEFT OUTER JOIN Coupon_Download On Coupon.Coupon_No = Coupon_Download.Coupon_No LEFT OUTER JOIN Member ON Member.Mem_No = Coupon_Download.Mem_No Where Coupon.Event_No ='$evtid';";

	
	if ($result = $conn->query($sql)){
		?>
			 <strong>총 <?=$pubcnt?>장 중 <?=$downcnt?>장의 쿠폰이 다운로드 되었습니다. (<?=$downcnt/$pubcnt*100?>%) </strong>


                                  



                                </div>

                            </div>

                            <div class="table-responsive">
                            <table class="table table-hover issue-tracker">
                                <tbody>
								<?php
			while ($row = $result->fetch_assoc()) {
?>
                                <tr>
                                    <td style="width: 5%">
									<?php $st = statusString($row["Use_Stat"]); ?>
                                        <span class="label <?=$st[0]?>"><?=$st[1]?></span>
                                    </td>
                                    <td class="issue-info" style="width: 25%">
                                        <a href="#">
                                           <?= $row["Coupon_code"]?>
                                        </a>

                                    </td>
                                    <td style="width: 25%">
                                        <?= $row["Mem_Name"]?>
                                    </td>
								<!--<td style="width: 15%">	<span class="text-muted">
                                        <?= $row["User_ID"]?> </span>
                                    </td> -->
                                    <td style="width: 30%">
                                       <small><?= substr($row["Down_Date"],2,16)?><small>
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

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>

    <!-- Peity demo data -->
    <script src="js/demo/peity-demo.js"></script>

	<script>
	$('#sel_event').on('change', function (e) {
		var optionSelected = $("option:selected", this);
		var valueSelected = this.value;
		location.href = "ad_viewer_list.php?evtid=" + valueSelected;
	});
	</script>
</body>

</html>
