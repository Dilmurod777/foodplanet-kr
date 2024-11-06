
<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->
    <div class="container">
		<div class="sub-container">
			<div class="reset-area">
				<div class="inner">
					<h2>비밀번호 재설정하기</h2>
					<form id="frmSave">
                        <input type="hidden" name="token" value="<?php echo $token; ?>" />
						<div class="reset-form">
							<dl>
								<dt>비밀번호</dt>
								<dd><input type="password" id="resetInfo1" name="new_pw" /></dd>
								<dt>비밀번호 확인</dt>
								<dd><input type="password" id="resetInfo2" name="new_pw_confirm" /></dd>
							</dl>
							<div class="btn-area-center">
								<a href="#" onclick="javascript:fnResetChangePw(); return false;" class="btn-type4">재설정하기</a><!-- class="btn-disabled" 버튼활성화시 삭제 -->
							</div>
						</div>
					</form>		
				</div>
			</div>
		</div>
	</div>
<script>
$(document).ready(function() {
});


function fnResetChangePw() {
    if($('.btn-type4').hasClass('btn-disabled')) return;

    if($.trim($('input[name=new_pw]').val()) == '') {
        showAlert('신규 비밀번호를 입력해 주세요.');
        return;
    }
    if(!fnCheckPw($('input[name=new_pw]').val())) {
        showAlert('비밀번호는 영문,숫자,특수문자(@$!%*#?&) 혼합으로 6~20자로 입력해 주세요.');
        return;
    }
    if($('input[name=new_pw]').val() != $('input[name=new_pw_confirm]').val()) {
        showAlert('비밀번호 확인이 일치하지 않습니다.');
        return;
    }

	$.ajax({
		url: "/api/common/change_reset_pw",
		type: "POST",
		data: $('#frmSave').serialize(),
		dataType: "JSON",
		async : false,
		success: function(data) {
            console.log(data);
			if(data.result == 'succ') {
                showAlert(data.msg, function() { location.href = '/'; });
			}
			else {
				showAlert(data.msg);
			}
		},
		error: function(result) {
			showAlert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
		}
	});

}
</script>