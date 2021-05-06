<?php
		include_once('./global.php');
		include_once('./db.php');
		$sql = "SELECT * FROM Biz_Type";
		$result = $conn->query($sql);		
	
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>지금!여기! | 회원가입</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<Style>
		body { margin: 20px}
		@media (max-width: 576px) {
		.col-sm-5,
		 .col-sm-4 { max-width: 70%;}
		}

		@media (max-width: 576px) {
		 
		 .col-sm-2 { max-width: 30%;}
		}

		@media (max-width: 576px) {
		 
		 .col-sm-3 { max-width: 50%;}
		}

	</Style>
</head>

<body class="gray-bg">

    <div class="register-box loginscreen  text-center   animated fadeInDown">

        <div>
            <h3>회원 가입</h3>
            <p>서비스를 이용하시려면 회원가입하세요.</p>
				<div class="tabs-container">
                        <ul class="nav nav-tabs" role="tablist">
                            <li><a class="nav-link"  href="register.php">개인회원</a></li>
                            <li><a class="nav-link active" >광고회원</a></li>
                        </ul>
                </div>
            <div class="ibox ">
				<div class="ibox-content">
					<form class="m-t" role="form" id="register" name="register" method="POST" action="register_process.php">
						
						<div class="form-group  row">
							<div class="col-sm-4"><input type="text" id="User_ID" name="User_ID"placeholder="ID" class="form-control"></div>
							<button type="button" class="btn btn-outline btn-primary" id="btnCheck">중복확인</button>
							
						</div>
						<div class="form-group  row">
							<div class="col-sm-7"><input type="password" id="Passwd" name="Passwd" placeholder="암호"  class="form-control"></div>
						</div>
						<div class="form-group  row">
							<div class="col-sm-7"><input type="password" id="ConfirmPwd" name="ConfirmPwd" placeholder="암호확인"  class="form-control"></div>
						</div>
						<div class="form-group  row">
							<div class="col-sm-7"><input type="text" id="Mem_Name" name="Mem_Name" placeholder="이름"  class="form-control"><input type="hidden" name="Mem_Type" value="2"></div>
						</div>
						<div class="form-group  row">
							<div class="col-sm-3"><input type="text" id="Biz_No"  name="Biz_No" placeholder="사업자번호" class="form-control"></div>
							
							<div class="col-sm-3"><input type="text" id="Boss_Name" name="Boss_Name" placeholder="대표자이름" class="form-control"></div>
						</div>
						<div class="form-group  row">
							<div class="col-sm-7"><input type="text" id="Contact" name="Contact" placeholder="전화번호" class="form-control"></div>
							<label class="col-form-label">- 없이 입력</label>
						</div>
						<div class="form-group  row">
							<div class="col-sm-4"><select placeholder="업종" class="form-control m-b" name="Biz_Type">
								<option value=0> 업종선택 </option>
							<?php 

								if ($result->num_rows > 0) 
								{
									// output data of each row
									while($row = $result->fetch_assoc())
									{
										echo "<option value=". $row["Biz_Type_Code"]. "> ". $row["Biz_Type_Name"]." </option>";
									}
								}

								$conn->close();
							?>
                                    
                                    </select>
							</div>
							
		
						
						</div>
						
						<div class="form-group  row">
							
								<div class="col-sm-4"><input type="text" id="Biz_Zip" name="Biz_Zip" placeholder="우편번호" class="form-control"></div>
								<div> 
									<button type="button" onclick="execDaumPostcode()" class="btn btn-outline btn-primary">찾아보기</button> 
								</div>
							
						</div>

						<!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
						<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
						<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
						</div>


						<div class="form-group  row">
							<div class="col-sm-9"><input type="text" id="Biz_Addr" name="Biz_Addr" placeholder="주소" class="form-control"></div>
						</div>
						<div class="form-group  row">
							<div class="col-sm-9"><input type="text" id="Biz_Addr_Detail" name="Biz_Addr_Detail" placeholder="상세주소" class="form-control"></div>
						</div>
					
						<div class="ibox">
							<div class="ibox-title">
								<h5>개인정보 수집 및 이용 동의</h5>
								<div class="ibox-tools">
									<label>약관보기</label>
									<a class="collapse-link">
										<i class="fa fa-chevron-up"></i>
									</a>		  
								</div>
							</div>
							<div class="ibox-content" style="">
							
								<div class="scroll_content" style="overflow: hidden; width: auto; height: 200px;">
									 <h4><strong>1. 개인정보의 수집 및 이용목적</strong></h2>
										<p class="depth_01">회원에게 온라인 광고 정보를 전달하는 온라인 전단지 사이트인 지금!여기!는 효과적인 정보전달에 적합한 서비스를 제공하기 위하여 개인정보를 수집하고 있으며 수집된 정보를 아래와 같이 이용하고 있습니다. 이용자가 제공한 모든 정보는 하기 목적에 필요한 용도 이외로는 사용되지 않으며 이용 목적이 변경될 시에는 사전 동의를 구할 것입니다.</p>
										<ol class="depth_01">
											<li>
												1) 회원관리
												<p class="depth_02">회원제 서비스 이용에 따른 본인확인, 본인의 의사확인, 고객문의에 대한 응답, 새로운 정보의 소개 및 고지사항 전달</p>
											</li>
											<li>
												2) 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산
												<p class="depth_02">본인인증, 광고 홍보 정보의 매칭 및 컨텐츠 제공을 위한 개인식별, 회원간의 상호 연락, 구매 및 요금 결제, 물품 및 증빙발송, 부정 이용방지와 비인가 사용방지</p>
											</li>
											<li>
												3) 서비스 개발 및 마케팅·광고에의 활용
												<p class="depth_02">맞춤 서비스 제공, 서비스 안내 및 이용권유, 서비스 개선 및 신규 서비스 개발을 위한 통계 및 접속빈도 파악, 통계학적 특성에 따른 광고 게재, 이벤트 정보 및 참여기회 제공</p>
											</li>
											<li>4) 고용 및 취업동향 파악을 위한 통계학적 분석</li>
										</ol>

										<h4><strong>2. 수집하는 개인정보 항목 및 수집방법</strong></h2>
										<p class="depth_01">"사이트"에서는 별도의 회원가입 절차 없이 특정 유료 서비스를 제외한 대부분의 컨텐츠에 자유롭게 접근할 수 있으며, 회원제 서비스를 이용하시려면 필수항목을 입력하여야 하며 선택항목을 입력하지 않더라도 서비스 이용에 제한을 두지 않습니다.</p>
										<ol class="depth_01">
											<li>
												가. 수집하는 개인정보의 항목
												<ol class="depth_02">
													<li>
														1) 회원가입 시 수집하는 항목
														<ul class="depth_03">
															<li class="icon">필수항목: 가입자명, 본인인증정보, 아이디, 비밀번호, 전화번호, e-메일, 사업자등록번호, 회사명, 회사주소</li>
															<li class="icon">선택항목: 이메일 수신 설정, 가입경로</li>
														</ul>
													</li>
													<li>
														2) 광고정보 등록 시 수집하는 항목담당자의 정보는 광고 이외의 용도로 이용할 수 없으며, 신청하신 서비스의 원활한 이용과 정보도용 및 허위정보 게재로 인한 피해를 방지하기 위해 광고담당자의 개인정보를 확인하고 있습니다.
														<ul class="depth_03">
															<li class="icon">광고 등록 시: 담당자 이름, 연락처(전화번호/휴대폰번호) , e-메일</li>
															<li class="icon">광고 신청 시: 회사명, 담당자 이름, 전화번호, e-메일</li>
														</ul>
													</li>
													<li>
														3) 모바일 서비스 이용 시 수집되는 항목
														<ul class="depth_03">
															<li class="icon">광고 위치 매칭 : 모바일 사용자의 위치 정보</li>
															<li class="icon">모바일 서비스의 특성상 단말기 모델 정보가 수집될 수 있으나,이는 개인을 식별할 수 없는 형태입니다.</li>
														</ul>
													</li>
													<li>4) 서비스 이용과정이나 사업처리 과정에서 아래와 같은 정보들이 자동으로 생성되어 수집될 수 있습니다.-IP Address, 쿠키, 방문 일시, 서비스 이용 기록, 불량 이용 기록</li>
												</ol>
											</li>
											<li>
												나. 개인정보 수집방법<br>
												- 홈페이지, 서비스 이용, 이벤트 응모, 팩스, 우편, 전화, 고객센터 문의하기
											</li>
										</ol>

										<h4><strong>3. 개인정보의 보유 및 이용기간</strong></h2>
										<p class="depth_01">
											"사이트"는 회원가입일로부터 서비스를 제공하는 기간 동안에 한하여 이용자의 개인정보를 보유 및 이용하게 됩니다. 회원탈퇴를 요청하거나 개인정보의 수집 및 이용에 대한 동의를 철회하는 경우, 수집 및 이용목적이 달성되거나 이용기간이 종료한 경우 개인정보를 지체 없이 파기합니다.<br>
											단, 다음의 경우에 대해서는 각각 명시한 이유와 기간 동안 보존합니다.
										</p>
										<ol class="depth_01">
											<li>1) 상법 등 관계법령의 규정에 의하여 보존할 필요가 있는 경우 법령에서 규정한 보존기간 동안 거래내역과 최소한의 기본정보를 보유합니다.<br>이 경우 회사는 보관하는 정보를 그 보관의 목적으로만 이용합니다.</li>
											<ol class="depth_02">
												<li>① 계약 또는 청약철회 등에 관한 기록: 5년</li>
												<li>② 대금결제 및 재화 등의 공급에 관한 기록: 5년</li>
												<li>③ 소비자의 불만 또는 분쟁처리에 관한 기록: 3년</li>
												<li>④ 부정이용 등에 관한 기록: 5년</li>
												<li>⑤ 웹사이트 방문기록(로그인 기록, 접속기록): 3개월</li>
											</ol>
											<li>2) 보유기간을 미리 공지하고 그 보유기간이 경과하지 아니한 경우와 개별적으로 동의를 받은 경우에는 약정한 기간 동안 보유합니다.</li>
											<li>3) 개인정보보호를 위하여 이용자가 선택한 개인정보 보유기간(1년, 3년, 회원탈퇴시) 동안 "사이트"를 이용하지 않은 경우, "아이디"를 "휴면계정"로 분리하여 해당 계정의 이용을 중지할 수 있습니다.</li>
										</ol>
								</div>
								
							</div>
						<div>
						<div class="form-group">
								<div class="checkbox i-checks"><label> <input type="checkbox" name="Agree_YN"><i></i> 약관에 동의 </label></div>
						</div>
			
						<button type="submit" class="btn btn-primary block full-width m-b">가  입</button>

						<p class="text-muted text-center"><small>이미 가입하셨나요?</small></p>
						<a class="btn btn-sm btn-white btn-block" href="login.php">로그인</a>
					</form>
					<p class="m-t"> <small>여기!지금은 Bootstrap 3 &copy; 2014 으로 작업되었습니다.</small> </p>
				</div>
			</div>
        </div>
    </div>

	<!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
	<!-- Chosen -->
    <script src="js/plugins/chosen/chosen.jquery.js"></script>
	<script src="js/plugins/slimscroll/jquery.slimscroll.js"></script>
	<!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<!-- Jquery Validate -->
	<script src="js/plugins/validate/jquery.validate.min.js"></script>
	<!-- 다음 우편번호 -->
	<script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
    <script>
        $(document).ready(function(){
			// Add slimscroll to element
			$('.scroll_content').slimscroll({
				height: '200px'
			});

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
			
			$("#register").validate({
                 rules: {
                     User_ID: {
                        required: true,
                        maxlength: 16,
					 	minlength: 5
                    },
                    Passwd: {
                        required: true,
                        maxlength: 32,
					    minlength: 6
                    },
                    ConfirmPwd: {
 					 	required: true,
                        maxlength: 32,
					    minlength: 6,
					    equalTo: "#Passwd"
                    },
					Biz_No: {
                         required: true,
						 digits: true,
                         maxlength: 10,
					     minlength: 10
                    },

                    Contact: {
                    	 digits: true
                    },
                    agree: "required",
                    Mem_Name : "required"
                 },
                  messages: {
					User_ID: {
                        required: "아이디를 입력하세요.",
                        minlength: "5글자 이상 입력하세요."
                    },
                    Passwd: {
                        required: "암호를 입력하세요.",
                        minlength: "6글자 이상 입력하세요."
                    },
                    ConfirmPwd: {
 					 	required: "암호를 입력하세요.",
                        minlength: "6글자 이상 입력하세요.",
					    equalTo: "암호와 일치하지 않습니다."
                    },

					Biz_No: {
						 required: "사업자번호를 입력하세요.",
                         digits: "10자리 숫자만 입력하세요.",
                         maxlength: "10자리 숫자만 입력하세요.",
					     minlength: "10자리 숫자만 입력하세요."
                    },
                    
                    Contact: {
                    	 digits: "숫자만 입력하세요."
                    },

                    agree: "약관에 동의해야 합니다." ,
                    Mem_Name: "이름을 입력해주세요."                     	
                   
                 }
             });
		
        });	

        $('.chosen-select').chosen({width: "100%"});

		$("#btnCheck").click(function(){
			  if ($("#User_ID").valid())
			  {
			  	   $.ajax({url: "id_check.php?chk_id="+$("#User_ID").val(), success: function(result){
			  			alert("사용 가능한 ID 입니다.");
			  			$("#idchecked").val(result);
			  		}, error: function(){
			  			alert("사용할 수 없는 ID 입니다.");
			  			$("#User_ID").val("");
			  			$("#User_ID").focus();
			  		}});
			  }

			
		});
		
		
	    // 우편번호 찾기 화면을 넣을 element
	    var element_layer = document.getElementById('layer');

	    function closeDaumPostcode() {
	        // iframe을 넣은 element를 안보이게 한다.
	        element_layer.style.display = 'none';
	    }

	    function execDaumPostcode() {
	        new daum.Postcode({
	            oncomplete: function(data) {
	                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

	                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
	                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
	                var addr = ''; // 주소 변수
	                var extraAddr = ''; // 참고항목 변수
	                

	                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
	                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
	                    addr = data.roadAddress;
	                } else { // 사용자가 지번 주소를 선택했을 경우(J)
	                    addr = data.jibunAddress;
	                }

	                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
	                if(data.userSelectedType === 'R'){
	                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
	                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
	                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
	                        extraAddr += data.bname;
	                    }
	                    // 건물명이 있고, 공동주택일 경우 추가한다.
	                    if(data.buildingName !== '' && data.apartment === 'Y'){
	                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
	                    }
	                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
	                    if(extraAddr !== ''){
	                        extraAddr = ' (' + extraAddr + ')';
	                    }
	                   
	                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
						addr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
	                
	                }

	                // 우편번호와 주소 정보를 해당 필드에 넣는다.
	                document.getElementById("Biz_Zip").value = data.zonecode;
	                document.getElementById("Biz_Addr").value = addr;
	                // 커서를 상세주소 필드로 이동한다.
	                document.getElementById("Biz_Addr_Detail").focus();

	                // iframe을 넣은 element를 안보이게 한다.
	                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
	                element_layer.style.display = 'none';
	            },
	            width : '100%',
	            height : '100%',
	            maxSuggestItems : 5
	        }).embed(element_layer);

	        // iframe을 넣은 element를 보이게 한다.
	        element_layer.style.display = 'block';

	        // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
	        initLayerPosition();
	    }

	    // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
	    // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
	    // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
	    function initLayerPosition(){
	        var width = 300; //우편번호서비스가 들어갈 element의 width
	        var height = 400; //우편번호서비스가 들어갈 element의 height
	        var borderWidth = 5; //샘플에서 사용하는 border의 두께

	        // 위에서 선언한 값들을 실제 element에 넣는다.
	        element_layer.style.width = width + 'px';
	        element_layer.style.height = height + 'px';
	        element_layer.style.border = borderWidth + 'px solid';
	        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
	        element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
	        element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
	    }


    </script>
</body>

</html>
