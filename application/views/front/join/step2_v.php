<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->
<style>
.join-area .join-form-box .clear dl dd select {
    display: block;
    width: 100%;
    padding: 14px 16px;
	background: url(/assets/front/images/filter_arr.svg) 98% center no-repeat;
	background-size:20px;
}	
select {
    height: 48px;
    border: 1px solid #dfdfdf;
    border-radius: 8px;
    box-sizing: border-box;
    color: #272727;
}
.error {border : 1px solid red !important;}
span {display:none; font-size:14px; padding:5px 0 0 20px;}
.error_text {display:block; color:red;}
.complete_text {display:block; color:blue; }
</style>
	<div class="container">
		<div class="sub-container">
			<div class="join-area step2">
				<div class="inner">
					<h2>회원가입</h2>
					<ul class="join-step clear">
						<li><div><div>1</div></div><span>TYPE SELECT</span></li>
						<li class="on"><div><div>2</div></div><span>BASIC INFO</span></li>
						<!--<li><div><div>3</div></div><span>BASIC INFO</span></li>-->
					</ul>
					<div class="join-form">
						<h3>기본 정보</h3>
						<form id="frmSave">
							<input type="hidden" name="member_type" value="<?php echo $req['member_type']; ?>" />
							<div class="join-form-box">
								<div class="clear">
									<dl>
										<dt><label for="member_id" class="nec">아이디</label></dt>
										<dd>
											<input type="text" name="member_id" id="member_id" maxlength="100" maxlength="!5" />
											<input type="hidden" id="idChk" value="n" />
											<span></span>
										</dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="member_pw" class="nec">비밀번호</label></dt>
										<dd>
											<input type="password" name="member_pw" id="member_pw" maxlength="20" />
											<span></span>
										</dd>
									</dl>
									<dl>
										<dt><label for="member_pw_confirm" class="nec">비밀번호 재입력</label></dt>
										<dd>
											<input type="password" name="member_pw_confirm" id="member_pw_confirm" maxlength="20" />
											<span></span>
										</dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="nickname" class="nec">활동명 입력</label></dt>
										<dd>
											<input type="text" name="nickname" id="nickname" maxlength="15" />
											<input type="hidden" id="nicknameChk" value="n" />
											<span></span>
										</dd>
									</dl>
									<dl>
										<dt><label for="joinInfo5">프로필 이미지</label></dt>
										<dd>
											<div class="filebox">
												<input type="text" class="upload-title" value="" placeholder="jpg, png 파일 업로드" readonly />
												<label for="joinInfo5">파일 선택</label> 
												<input type="file" id="joinInfo5" name="profile_img" class="custom-file" />
												<button class="btn-reset"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
											</div>
										</dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="company_name" class="nec">회사명</label></dt>
										<dd>
											<input type="text" name="company_name" id="company_name" maxlength="50" />
											<span></span>
										</dd>
									</dl>
									<dl>
										<dt><label for="biz_no" class="nec">사업자등록번호</label></dt>
										<dd>
											<input type="text" name="biz_no" id="biz_no" maxlength="12" />
											<input type="hidden" id="biznoChk" value="n" />
											<span></spna>
										</dd>
									</dl>
								</div>
							</div>
							<div class="join-form-box">
								<div class="clear">
									<dl>
										<dt><label for="owner_name" class="nec">대표명</label></dt>
										<dd>
											<input type="text" name="owner_name" id="owner_name" maxlength="50" />
											<span></spna>
										</dd>
									</dl>
									<dl>
										<dt><label for="company_tel" class="nec">대표 전화번호</label></dt>
										<dd>
											<input type="text" name="company_tel" id="company_tel" maxlength="13" />
											<span></spna>
										</dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="company_email" class="nec">대표 이메일</label></dt>
										<dd>
											<input type="text" name="company_email" id="company_email" />
											<input type="hidden" id="chkCompanyEmail" value="n" maxlength="100" />
											<span></spna>
										</dd>
									</dl>
								</div>
							</div>
							<div class="join-form-box">
								<div class="clear">
									<dl>
										<dt><label for="joinInfo8" class="nec">국가명</label></dt>
										<dd>
											<select id="nation" name="nation">
												<option value="">선택해주세요.</option>
												<?php
													foreach($nation as $row) {
														echo '<option value="' . $row['sub_code'] . '">' . $row['code_name'] . '</option>';
													}
												?>
											</select>
											<span></spna>
										</dd>
									</dl>
									<dl>
										<dt><label for="joinInfo9" class="nec">업종</label></dt>
										<dd>
											<select id="industry" name="industry">
												<option value="">선택해주세요.</option>
												<?php
													foreach($industry as $row) {
														echo '<option value="' . $row['sub_code'] . '">' . $row['code_name'] . '</option>';
													}
												?>
											</select>
											<span></spna>
										</dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="joinInfo10" class="nec">업체구분</label></dt>
										<dd>
											<select id="company_type" name="company_type">
												<option value="">선택해주세요.</option>
												<?php
													foreach($company_type as $row) {
														echo '<option value="' . $row['sub_code'] . '">' . $row['code_name'] . '</option>';
													}
												?>
											</select>
											<span></spna>
										</dd>
									</dl>
								</div>
							</div>
							<div class="join-form-box">
								<div class="clear">
									<dl>
										<dt><label for="employee_name" class="nec">담당자명</label></dt>
										<dd>
											<input type="text" name="employee_name" id="employee_name" maxlength="50" />
											<span></spna>
										</dd>
									</dl>
									<dl>
										<dt><label for="employee_tel" class="nec">담당자 전화번호</label></dt>
										<dd>
											<input type="text" name="employee_tel" id="employee_tel" maxlength="!3" />
											<span></spna>
										</dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="employee_email" class="nec">담당자 이메일</label></dt>
										<dd>
											<input type="text" name="employee_email" id="employee_email" />
											<input type="hidden" id="chkEmployeeEmail" value="n" maxlength="100" />
											<span></spna>
										</dd>
									</dl>
									<dl>
										<dt><label for="homepage">회사 홈페이지 주소</label></dt>
										<dd><input type="text" name="homepage" id="homepage" maxlength="256" /></dd>
									</dl>
								</div>
							</div>
							<div class="join-form-box">
								<dl>
									<dt><label for="joinInfo15" class="nec">관심분야</label></dt>
									<dd>
										<label>
											<input type="radio" id="joinInfo15" name="interest1" value="manufacture" checked />
											<span>제조</span>
										</label>
										<label>
											<input type="radio" name="interest1" value="distribution" />
											<span>유통</span>
										</label>
										<label>
											<input type="radio" name="interest1" value="export" />
											<span>수출</span>
										</label>
										<label>
											<input type="radio" name="interest1" value="request" />
											<span>제품 요청</span>
										</label>
										<label>
											<input type="radio" name="interest1" value="etc" />
											<span>기타 </span>
											<input type="text" name="interest1_etc" class="txt-etc" readonly maxlength="50" />
										</label>
										<span id="interest_error"></span>
									</dd>
								</dl>
								<div class="clear">
									<dl>
										<dt><label for="interest_product" class="nec">관심제품</label></dt>
										<dd>
											<input type="text" name="interest_product" id="interest_product" maxlength="50" />
											<span></spna>
										</dd>
									</dl>
									<dl>
										<dt><label for="interest_nation" class="nec">관심수출국</label></dt>
										<dd>
											<input type="text" name="interest_nation" id="interest_nation" maxlength="50" />
											<span></spna>
										</dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="joinInfo18">사업자 등록증 사본</label></dt>
										<dd>
											<div class="filebox">
												<input type="text" class="upload-title" value="" placeholder="JPG,PNG,PDF 파일 업로드" readonly />
												<label for="joinInfo18">파일 선택</label> 
												<input type="file" id="joinInfo18" name="bizcard_file" class="custom-file" />
												<button class="btn-reset"><img src="/assets/front/images/btn_clear.svg" alt="삭제"></button>
											</div>
										</dd>
									</dl>
								</div>
							</div>
						</form>
						<div class="agree-area">
							계정을 생성하면 푸드플라넷의 <div><a href="javascript:;" class="btn-layer" data-link="#layer-terms">서비스 약관 </a>및 <a href="javascript:;" class="btn-layer" data-link="#layer-privacy">개인정보처리방침</a> 에 동의하게 됩니다.</div>
						</div>
						<div class="btn-area-center">
							<a href="#" onclick="javascript:fnPrev(); return false;" class="btn-prev">이전</a>
							<a href="#" onclick="javascript:fnNext(); return false;" class="btn-confirm btn-disabled">회원가입</a><!-- class="btn-disabled" 버튼비활성 -->
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>

<form id="frmNext" method="post" action="/join/step3">
</form>
<script>
$(document).ready(function() {
	$('input[name=member_id]').on('input', function() {
		$(this).siblings('span').removeClass('error_text');
		$(this).siblings('span').removeClass('complete_text');
		$(this).removeClass('error');

		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		str = str.replace(/[^a-zA-Z0-9]/gi,"");
		$(this).val(str);
		$('#idChk').val('n');
	})
	.on('blur', function() {
		if($('#idChk').val() == 'y') return;

		if($.trim($(this).val()) == '') {
			$(this).addClass('error');
			fnShowError($(this), '아이디를 입력해 주세요.', 'error_text');
			fnCheckSave();
			return;
		}

		$.ajax({
			url: "/member/ajaxCheckId",
			type: "POST",
			data: { member_id : $('input[name=member_id]').val() },
			dataType: "JSON",
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					$('#idChk').val('y');
					fnShowError($('input[name=member_id]'), data.msg, 'complete_text');
					fnCheckSave();
				}
				else {
					$('#idChk').val('n');
					fnShowError($('input[name=member_id]'), data.msg, 'error_text');
					$(this).addClass('error');
					fnCheckSave();
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
		});
		
	});

	$('input[name=member_pw]').on('input', function() {
		$(this).siblings('span').removeClass('error_text');
		$(this).removeClass('error');

		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		$(this).val(str);
	})
	.on('blur', function() {
		if(!fnCheckPw($(this).val())) {
			fnShowError($(this), '비밀번호는 영문,숫자,특수문자(@$!%*#?&) 혼합으로 6~20자로 입력해 주세요.', 'error_text');
			$(this).addClass('error');
		}

		if($(this).val() == $('input[name=member_pw_confirm]').val()) {
			$('input[name=member_pw_confirm]').siblings('.error_text').css('display', 'none');
			$('input[name=member_pw_confirm]').removeClass('error');
		}
		fnCheckSave();
	});

	$('input[name=member_pw_confirm]').on('input', function() {
		$(this).siblings('span').removeClass('error_text');
		$(this).removeClass('error');

		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		$(this).val(str);
	})
	.on('blur', function() {
		if($(this).val() !== $('input[name=member_pw]').val()) {
			fnShowError($(this), '비밀번호 확인이 일치하지 않습니다.', 'error_text');
			$(this).addClass('error');
		}
		fnCheckSave();
	});


	$('input[name=company_name]').on('input', function() {
		$(this).siblings('span').removeClass('error_text');
		$(this).siblings('span').removeClass('complete_text');
		$(this).removeClass('error');

		$('#profileurlCheck').val('n');
		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		str = str.replace(/[^ㄱ-힣a-zA-Z0-9]/gi,"");
		$(this).val(str);
	})
	.on('blur', function() {
		if($(this).val() == '') {
			fnShowError($(this), '회사이름을 입력해 주세요.', 'error_text');
			$(this).addClass('error');
		}
		fnCheckSave();
	});

	$('input[name=nickname]').on('input', function() {
		$(this).siblings('span').removeClass('error_text');
		$(this).siblings('span').removeClass('complete_text');
		$(this).removeClass('error');

		$('#profileurlCheck').val('n');
		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		str = str.replace(/[^ㄱ-힣a-zA-Z0-9]/gi,"");
		$(this).val(str);
	})
	.on('blur', function() {
		if($(this).val() == '') {
			fnShowError($(this), '활동명을 입력해 주세요.', 'error_text');
			$(this).addClass('error');
		}

		$.ajax({
			url: "/member/ajaxCheckNickname",
			type: "POST",
			data: { nickname : $('input[name=nickname]').val() },
			dataType: "JSON",
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					$('#nicknameChk').val('y');
					fnShowError($('input[name=nickname]'), data.msg, 'complete_text');
					fnCheckSave();
				}
				else {
					$('#nicknameChk').val('n');
					fnShowError($('input[name=nickname]'), data.msg, 'error_text');
					$(this).addClass('error');
					fnCheckSave();
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
		});
	});

	$('input[name=biz_no]').on('input', function() {
		$(this).siblings('span').removeClass('error_text');
		$(this).siblings('span').removeClass('complete_text');
		$(this).removeClass('error');

		var str = $(this).val();
		str = fnMakeBizno(str.replace(/\s/gi, "").replace(/[^0-9]/g, ""));
		$(this).val(str);
	})
	.on('blur', function() {
		if($(this).val() == '') {
			fnShowError($(this), '사업자등록번호를 입력해 주세요.', 'error_text');
			$(this).addClass('error');
			fnCheckSave();
			return;
		}
		else if(!fnCheckBizno($(this).val())) {
			fnShowError($(this), '사업자등록번호 형식이 올바르지 않습니다.', 'error_text');
			$(this).addClass('error');
			fnCheckSave();
			return;
		}
		$.ajax({
			url: "/member/ajaxCheckBizno",
			type: "POST",
			data: { 'biz_no' : $(this).val(), member_type : $('input[name=member_type]').val() },
			dataType: "JSON",
			async : false,
			success: function(data) {
				console.log(data);
				if(data.result == 'succ') {
					$('#biz_no').siblings('input').val('y');
					fnShowError($('#biz_no'), data.msg, 'complete_text');
					fnCheckSave();
					if(data.data != null && data.data.biz_no !== '') {
						$('input[name=company_name]').val(data.data.company_name);
						$('input[name=owner_name]').val(data.data.owner_name);
						$('input[name=company_tel]').val(data.data.company_tel);
						$('input[name=company_email]').val(data.data.company_email);
						$('input[name=homepage]').val(data.data.homepage);
					}
				}
				else {
					$('#biz_no').siblings('input').val('n');
					fnShowError($('#biz_no'), data.msg, 'error_text');
					$('#biz_no').addClass('error');
					fnCheckSave();
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
		});
	});

	$('input[name=company_email], input[name=employee_email]').on('input', function() {
		$(this).siblings('span').removeClass('error_text');
		$(this).siblings('span').removeClass('complete_text');
		$(this).removeClass('error');
		$(this).siblings('input').val('n');

		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		$(this).val(str);
	})
	.on('blur', function() {
		if($(this).val() == '') {
			fnShowError($(this), '이메일을 입력해 주세요.', 'error_text');
			$(this).addClass('error');
		}
		else if(!fnCheckEmail($(this).val())) {
			fnShowError($(this), '이메일 형식이 올바르지 않습니다.', 'error_text');
			$(this).addClass('error');
			$(this).siblings('input').val('n');
			fnCheckSave();
			return;
		}

		var sType = $(this).attr('id') == 'company_email' ? 'company' : 'employee';
		var obj = $(this);

		$.ajax({
			url: "/member/ajaxCheckEmail",
			type: "POST",
			data: { type : sType, 'email' : $(this).val() },
			dataType: "JSON",
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					$(obj).siblings('input').val('y');
					fnShowError($(obj), data.msg, 'complete_text');
					fnCheckSave();
				}
				else {
					$(obj).siblings('input').val('n');
					fnShowError($(obj), data.msg, 'error_text');
					$(obj).addClass('error');
					fnCheckSave();
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
		});
	});
	

	$('input[name=owner_name], input[name=employee_name]').on('input', function() {
		$(this).siblings('span').removeClass('error_text');
		$(this).siblings('span').removeClass('complete_text');
		$(this).removeClass('error');

		$('#profileurlCheck').val('n');
		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		str = str.replace(/[^ㄱ-힣a-zA-Z]/gi,"");
		$(this).val(str);
	})
	.on('blur', function() {
		if($(this).val() == '') {
			fnShowError($(this), '이름을 입력해 주세요.', 'error_text');
			$(this).addClass('error');
		}
		fnCheckSave();
	});

	$('input[name=company_tel], input[name=employee_tel]').on('input', function() {
		$(this).siblings('span').removeClass('error_text');
		$(this).siblings('span').removeClass('complete_text');
		$(this).removeClass('error');

		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		str = fnMakePhone(str.replace(/[^0-9]/g, ""));
		$(this).val(str);
	})
	.on('blur', function() {
		if($(this).val() == '') {
			fnShowError($(this), '전화번호를 입력해 주세요.', 'error_text');
			$(this).addClass('error');
		}
		else if(!fnCheckPhone($(this).val())) {
			fnShowError($(this), '전화번호 형식이 맞지 않습니다.', 'error_text');
			$(this).addClass('error');
		}
		fnCheckSave();
	}); 

	$('select').on('change', function() {
		fnCheckSave();
	})

	$('input[name=profile_img]').on('change', function() {
		if($('#files').val() == '') {
			return;
		}
		
		var file = $(this)[0].files[0];
		var ext = file.name.split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
			showAlert('JPG, PNG 파일만 업로드 가능합니다.');
			$(this).val('');
			$(this).siblings(".upload-title").val('');
			$(this).parent(".filebox").removeClass("on");
			return false;
		}

		if(file.size >= 5*1024*1024) {
			showAlert('5MB 이하로 등록해 주세요.');
			$(this).val('');
			$(this).siblings(".upload-title").val('');
			$(this).parent(".filebox").removeClass("on");
			return false;
		}

    });    

	$('input[name=bizcard_file]').on('change', function() {
		if($('#files').val() == '') {
			return;
		}
		
		var file = $(this)[0].files[0];
		var ext = file.name.split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg', 'png', 'jpeg', 'pdf']) == -1) {
			showAlert('JPG, PNG, PDF 파일만 업로드 가능합니다.');
			$(this).val('');
			$(this).siblings(".upload-title").val('');
			$(this).parent(".filebox").removeClass("on");
			return false;
		}

		if(file.size >= 5*1024*1024) {
			showAlert('5MB 이하로 등록해 주세요.');
			$(this).val('');
			$(this).siblings(".upload-title").val('');
			$(this).parent(".filebox").removeClass("on");
			return false;
		}

    });    

	$('input[name=interest_product]').on('blur', function() {
		if($(this).val() == '') {
			fnShowError($(this), '관심제품을 입력해 주세요.', 'error_text');
			$(this).addClass('error');
		}
		fnCheckSave()
	});

	$('input[name=interest_nation]').on('blur', function() {
		if($(this).val() == '') {
			fnShowError($(this), '관심수출국을 입력해 주세요.', 'error_text');
			$(this).addClass('error');
		}
		fnCheckSave()
	});

	$('input[name=interest1]').on('click', function() {
		if($(this).val() === 'etc') {
			$('input[name=interest_etc]').attr('readonly', false);
		}
		else {
			$('input[name=interest_etc]').attr('readonly', true);
			$('input[name=interest_etc]').val('');
		}
		fnCheckSave()
	})
});

function fnShowError(obj, msg, cls) {
	$(obj).siblings('span').removeClass('error_text');
	$(obj).siblings('span').removeClass('complete_text');
	$(obj).siblings('span').addClass(cls);
	$(obj).siblings('span').text(msg);
	if(cls == 'error_text') $(obj).addClass('error');
}

function fnCheckSave() {
	var bCheck = true;
	if($('#member_id').val() == '' || $('#idChk').val() == 'n') bCheck = false;
	if(!fnCheckPw($('#member_pw').val()) || $('#member_pw').val() !== $('input[name=member_pw_confirm]').val()) bCheck = false;
	if($('#nickname').val() == '' || $('#nicknameChk').val() == 'n') bCheck = false;
	if($('#company_name').val() == '') bCheck = false;
	if(!fnCheckBizno($('#biz_no').val()) || $('#biznoChk').val() == 'n') bCheck = false;
	if($('#nation').val() == '') bCheck = false;
	if($('#industry').val() == '') bCheck = false;
	if($('company_type').val() == '') bCheck = false;
	if($('#owner_name').val() == '') bCheck = false;
	if(!fnCheckPhone($('#company_tel').val())) bCheck = false;
	if(!fnCheckEmail($('#company_email').val()) || $('#chkCompanyEmail').val() == 'n') bCheck = false;
	if($('#employee_name').val() == '') bCheck = false;
	if(!fnCheckPhone($('#employee_tel').val())) bCheck = false;
	if(!fnCheckEmail($('#employee_email').val()) || $('#chkEmployeeEmail').val() == 'n') bCheck = false;
	if($('input[name=interest1]:checked').val() === 'etc' && $.trim($('input[name=interest_etc]').val()) === '') bCheck = false;
	if($.trim($('input[name=interest_product]').val()) === '') bCheck = false;
	if($.trim($('input[name=interest_nation]').val()) === '') bCheck = false;

	if(bCheck) {
		$('.btn-confirm').removeClass('btn-disabled');
	}
	else {
		$('.btn-confirm').addClass('btn-disabled');
	}
}

function fnNext() {
	var bCheck = true;
	if($('#member_id').val() == '') {
		fnShowError($('#member_id'), '아이디를 입력해 주세요.', 'error_text');
		bCheck = false;
	}
	else if($('#idChk').val() == 'n') {
		fnShowError($('#member_id'), '이미 사용중인 아이디입니다.', 'error_text');
		bCheck = false;
	}
	if(!fnCheckPw($('#member_pw').val()) || $('#member_pw').val() !== $('input[name=member_pw_confirm]').val()) {
		fnShowError($('#member_pw'), '비밀번호를 입력해 주세요.', 'error_text');
		bCheck = false;
	}
	if($('#nickname').val() == '') {
		fnShowError($('#nickname'), '활동명을 입력해 주세요.', 'error_text');
		bCheck = false;
	}
	else if($('#nicknameChk').val() =='n') {
		fnShowError($('#member_id'), '이미 사용중인 활동명입니다.', 'error_text');
		bCheck = false;
	}
	if($('#company_name').val() == '') {
		fnShowError($('#company_name'), '회사명을 입력해 주세요.', 'error_text');
		bCheck = false;
	}
	if(!fnCheckBizno($('#biz_no').val())) {
		fnShowError($('#biz_no'), '사업자등록번호를 입력해 주세요.', 'error_text');
		bCheck = false;
	}
	else if($('#biznoChk').val() == 'n') {
		fnShowError($('#biz_no'), '이미 사용중인 사업자등록번호입니다.', 'error_text');
		bCheck = false;
	}
	if($('#nation').val() == '') {
		fnShowError($('#nation'), '국가를 선택해 주세요.', 'error_text');
		bCheck = false;
	}
	if($('#industry').val() == '') {
		fnShowError($('#industry'), '업종을 선택해 주세요.', 'error_text');
		bCheck = false;
	}
	if($('#company_type').val() == '') {
		fnShowError($('#company_type'), '회사종류를 선택해 주세요.', 'error_text');
		bCheck = false;
	}
	if($('#owner_name').val() == '') {
		fnShowError($('#owner_name'), '대표자명을 입력해 주세요.', 'error_text');
		bCheck = false;
	}
	if(!fnCheckPhone($('#company_tel').val())) {
		fnShowError($('#company_tel'), '대표 전화번호를 입력해 주세요.', 'error_text');
		bCheck = false;
	}
	if(!fnCheckEmail($('#company_email').val())) {
		fnShowError($('#company_email'), '대표 이메일을 입력해 주세요.', 'error_text');
		bCheck = false;
	}
	else if($('#chkCompanyEmail').val() == 'n') {
		fnShowError($('#company_email'), '이미 사용중인 이메일입니다.', 'error_text');
		bCheck = false;
	}
	if($('#employee_name').val() == '') {
		fnShowError($('#employee_name'), '담당자명을 입력해 주세요.', 'error_text');
		bCheck = false;
	}
	if(!fnCheckPhone($('#employee_tel').val())) {
		fnShowError($('#employee_tel'), '담당자 연락처를 입력해 주세요.', 'error_text');
		bCheck = false;
	}
	if(!fnCheckEmail($('#employee_email').val())) {
		fnShowError($('#employee_email'), '담당자 이메일을 입력해 주세요.', 'error_text');
		bCheck = false;
	}
	else if($('#chkEmployeeEmail').val() == 'n') {
		fnShowError($('#employee_email'), '이미 사용중인 이메일입니다.', 'error_text');
		bCheck = false;
	}
	if($('input[name=interest1]').val() === '' || ($('input[name=interest1]').val() === 'etc' && $.trim($('input[name=interest_etc]').val()) === '')) {
		$('#interest_error').html('관심분야를 선택해 주세요.');
		$('#interest_error').removeClass('error_text');
		$('#interest_error').removeClass('complete_text');
		$('#interest_error').addClass('error_text');
		bCheck = false;
	}
	if($.trim($('input[name=interest_product]').val()) === '') {
		fnShowError($('input[name=interest_product]'), '관심제품을 입력해주세요.', 'error_text');
		bCheck = false;
	}
	if($.trim($('input[name=interest_nation]').val()) === '') {
		fnShowError($('input[name=interest_nation]'), '관심수출국가를 입력해주세요.', 'error_text');
		bCheck = false;
	}

	if(!bCheck) return;

	var form = $('#frmSave')[0];  
	var data = new FormData(form); 

	$.ajax({
			url: "/join/ajaxJoin",
			type: "POST",
			data: data,
			enctype: 'multipart/form-data',  
			processData: false,    
        	contentType: false,      
        	cache: false,           
        	timeout: 600000,  
			success: function(data) {
				data = JSON.parse(data);
				if(data.result == 'succ') {
					location.href='/join/complete';
				}
				else {
					showAlert(data.msg);
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});

}

function fnPrev() {
	location.href = '/join/step1';
}
</script>