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
.btn {
	display: inline-block;
    font-size: 15px;
    color: #00cfca;
    margin: 0;
    border-radius: 8px;
    border: 1px solid #00cfca;
    padding: 13px 0;
    width: 100px;
    text-align: center;
    box-sizing: border-box;
	position:absolute;
	right:0;
	top:0;
}
#auth_timer {
	color:red;
	position:absolute;
	right:110px;
	top:15px;
}
</style>
	<div class="container">
		<div class="sub-container">
			<div class="join-area step2">
				<div class="inner">
					<h2>회원가입</h2>
					<div class="join-form">
						<h3>기본 정보</h3>
						<form id="frmSave">
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
										<dt><label for="name" class="nec">성명</label></dt>
										<dd>
											<input type="text" name="name" id="name" maxlength="50" />
											<span></spna>
										</dd>
									</dl>
									<dl>
										<dt><label for="tel" class="nec">전화번호</label></dt>
										<dd>
											<input type="text" name="tel" id="tel" maxlength="13" />
											<input type="hidden" id="telChk" value="n" />
											<span></spna>
										</dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="email" class="nec">이메일</label></dt>
										<dd style="position:relative;">
											<input type="text" name="email" id="email" />
											<input type="hidden" id="chkEmail" value="n" />
											<button class="btn" type="button" id="btn_send_auth" onclick="javascript:fnSendAuthMail();">이메일 인증</button>
											<span></spna>
										</dd>
									</dl>
									<dl id="auth_wrap" style="display:none; padding-top:10px; clear:both; margin:0;">
										<dt></dt>
										<dd style="position:relative;">
											<input type="text" name="auth_num" id="auth_num" maxlength="6" />
											<label id="auth_timer">3:00</label>
											<button class="btn" type="button" id="btn_chk_auth" onclick="javascript:fnCheckAuthMail();">인증</button>
											<span></spna>
										</dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="" class="nec">회원타입</label></dt>
										<dd>
											<label>
												<input type="radio" name="member_type" value="1" checked />
												<span>기업</span>
											</label>
											<label>
												<input type="radio" name="member_type" value="2" />
												<span>개인사업자</span>
											</label>
											<label>
												<input type="radio" name="member_type" value="3" />
												<span>개인</span>
											</label>
										</dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="joinInfo8" class="nec">주요관심사</label></dt>
										<dd>
											<select id="interest" name="interest">
												<option value="">선택해주세요.</option>
												<?php
													foreach($interest as $row) {
														echo '<option value="' . $row['sub_code'] . '">' . $row['code_name'] . '</option>';
													}
												?>
											</select>
											<span></spna>
										</dd>
									</dl>
								</div>
							</div>
						</form>
						<div class="agree-area">
							계정을 생성하면 푸드플라넷의 <div><a href="javascript:;" class="btn-layer" data-link="#layer-terms">서비스 약관 </a>및 <a href="javascript:;" class="btn-layer" data-link="#layer-privacy">개인정보처리방침</a> 에 동의하게 됩니다.</div>
						</div>
						<div class="btn-area-center">
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
var timer1 = null;

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


	$('input[name=name]').on('input', function() {
		$(this).siblings('span').removeClass('error_text');
		$(this).siblings('span').removeClass('complete_text');
		$(this).removeClass('error');

		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		str = str.replace(/[^ㄱ-힣a-zA-Z0-9]/gi,"");
		$(this).val(str);
	})
	.on('blur', function() {
		if($(this).val() == '') {
			fnShowError($(this), '성명을 입력해 주세요.', 'error_text');
			$(this).addClass('error');
		}
		fnCheckSave();
	});

	$('input[name=tel]').on('input', function() {
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
			fnCheckSave();
		}
		else if(!fnCheckPhone($(this).val())) {
			fnShowError($(this), '전화번호 형식이 맞지 않습니다.', 'error_text');
			$(this).addClass('error');
			fnCheckSave();
		}
		else {
			$.ajax({
				url: "/member/ajaxCheckTel",
				type: "POST",
				data: { tel : $('input[name=tel]').val() },
				dataType: "JSON",
				async : false,
				success: function(data) {
					if(data.result == 'succ') {
						$('#telChk').val('y');
						fnShowError($('input[name=tel]'), data.msg, 'complete_text');
						fnCheckSave();
					}
					else {
						$('#telChk').val('n');
						fnShowError($('input[name=tel]'), data.msg, 'error_text');
						$(this).addClass('error');
						fnCheckSave();
					}
				},
				error: function(result) {
					alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
				}
			});			
		}
	}); 

	$('input[name=email]').on('input', function() {
		$(this).siblings('span').removeClass('error_text');
		$(this).removeClass('error');
		$('#chkEmail').val('n');
		$('#btn_send_auth').html('이메일 인증');
		$('#btn_send_auth').attr('disabled', false);
		$('#auth_wrap').hide();
		clearInterval(timer1);
	});

	$('input[name=auth_num]').on('input', function() {
		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		str = str.replace(/[^0-9]/g, "");
		$(this).val(str);
	})

	$('select').on('change', function() {
		fnCheckSave();
	})

	$('input[name=member_type]').on('click', function() {
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
	if($('#name').val() == '') bCheck = false;
	if(!fnCheckPhone($('#tel').val()) || $('#telChk').val() == 'n') bCheck = false;
	if(!fnCheckEmail($('#email').val()) || $('#chkEmail').val() == 'n') bCheck = false;
	if($('#interest').val() == '') bCheck = false;

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
	if($('#name').val() == '') {
		fnShowError($('#name'), '성명을 입력해 주세요.', 'error_text');
		bCheck = false;
	}
	if($('#interest').val() == '') {
		fnShowError($('#interest'), '주요관심사를 선택해 주세요.', 'error_text');
		bCheck = false;
	}
	if(!fnCheckPhone($('#tel').val())) {
		fnShowError($('#tel'), '연락처 형식이 올바르지 않습니다.', 'error_text');
		bCheck = false;
	}
	else if($('#chkTel').val() == 'n') {
		fnShowError($('#tel'), '이미 등록된 연락처 입니다.', 'error_text');
		bCheck = false;
	}
	if(!fnCheckEmail($('#email').val())) {
		fnShowError($('#email'), '이메일 형식이 올바르지 않습니다.', 'error_text');
		bCheck = false;
	}
	else if($('#chkEmail').val() == 'n') {
		fnShowError($('#email'), '이메일을 인증해주세요.', 'error_text');
		bCheck = false;
	}

	if(!bCheck) return;

	$.ajax({
			url: "/join/ajaxJoin",
			type: "POST",
			data: $('#frmSave').serialize(),
			dataType : 'JSON',
			async : false,
			success: function(data) {
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

function fnSendAuthMail()
{
	if(!fnCheckEmail($('#email').val())) {
		fnShowError($('#email'), '이메일 형식이 올바르지 않습니다.', 'error_text');
		return false;
	}
	
	clearInterval(timer1);
	cnt = 180;
	$.ajax({
		url: "/api/common/auth_send",
		type: "POST",
		data: { email : $('input[name=email]').val() },
		dataType: "JSON",
		async : false,
		success: function(result) {
			if(result.result == 'succ') {
				$('#btn_send_auth').html('재발송');
				$('#btn_chk_auth').attr('disabled', false); 
				$('#auth_wrap').show();

				timer1 = setInterval(function() { //실행할 스크립트 
					cnt--;

					var div = parseInt(cnt / 60);
					var mod = cnt % 60;

					$('#auth_timer').html(div + ':' + (mod < 10 ? '0' : '') + mod);
					if(cnt <= 0) {
						clearInterval(timer1);
						$('#btn_chk_auth').attr('disabled', true);
					}
				}, 1000);
			}
			else {
				fnShowError($('#email'), result.msg, 'error_text');
			}
		},
		error: function(result) {
			alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
		}
	});
}

function fnCheckAuthMail()
{
	$.ajax({
		url: "/api/common/auth_check",
		type: "POST",
		data: { email : $('input[name=email]').val()
				, auth_num : $('input[name=auth_num]').val() },
		dataType: "JSON",
		async : false,
		success: function(result) {
			if(result.result == 'succ') {
				$('#btn_send_auth').html('인증완료');
				$('#btn_send_auth').attr('disabled', true);
				$('#auth_wrap').hide();
				$('#chkEmail').val('y');
				clearInterval(timer1);
				fnCheckSave();
			}
			else {
				showAlert(result.msg);
			}
		},
		error: function(result) {
			alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
		}
	});
}

</script>