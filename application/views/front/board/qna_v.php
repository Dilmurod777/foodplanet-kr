<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

	<div class="container">
		<div class="sub-container">
			<div class="board-write qna qna-new"><!-- qna 글쓰기 class="board-write qna" -->
				<div class="inner">
					<div class="write-area join-area">
						<h3>문의·요청하기</h3>
						<div class="join-form">
							<div class="nec-noti"><span>필수 입력 항목</span></div>
							<form id="frmSave">
								<div class="join-form-box">
									<dl>
										<dt><label for="inqinfo1" class="nec">기업명</label></dt>
										<dd><input type="text" name="company_name" id="inqinfo1" placeholder="기업명을 입력해주세요" class="w100" value="" maxlength="50" /></dd>
									</dl>
									<dl>
										<dt><label for="inqinfo2" class="nec">담당자명</label></dt>
										<dd><input type="text" name="employee_name" id="inqinfo2" placeholder="담당자명을 입력해주세요" class="w100" value="" maxlength="50" /></dd>
									</dl>
									<dl>
										<dt><label for="inqinfo3" class="nec">담당자 연락처</label></dt>
										<dd><input type="text" name="employee_tel" id="inqinfo3" placeholder="담당자 연락처를 입력해주세요" class="w100" value="" maxlength="13" /></dd>
									</dl>
									<dl>
										<dt><label for="inqinfo4" class="nec">이메일</label></dt>
										<dd><input type="text" name="employee_email" id="inqinfo4" placeholder="답변 받을 이메일을 입력해주세요" class="w100" value="" maxlength="100" /></dd>
									</dl>
									<dl>
										<dt><label for="inqinfo5" class="nec">내용</label></dt>
										<dd><textarea name="contents" cols="" rows="" id="inqinfo5" placeholder="답변 받을 이메일을 입력해주세요" class="w100"></textarea></dd>
									</dl>
									<dl>
										<dt><label for="inqinfo6">파일 첨부</label></dt>
										<dd>
											<div class="filebox-wrap">
												<div class="filebox">
													<input type="text" class="upload-title" value="" placeholder="최대 5MB 업로드 가능" readonly />
													<label for="inqinfo6">파일첨부</label> 
													<input type="file" name="files" id="inqinfo6" class="custom-file" />
													<button class="btn-reset"><img src="../resources/images/btn_clear.svg" alt="파일초기화"></button>
												</div>
											</div>
										</dd>
									</dl>
								</div>
							</form>
							<div class="qna-agree-area">
								<input type="checkbox" id="qagree" />
								<label for="qagree">개인정보처리방침에 동의합니다.</label>
								<div>개인정보처리방침에 동의해주세요.</div>
							</div>
							<div class="btn-area-center">
								<a href="#" onclick="javascript:history.back(); return false;" class="btn-prev">취소</a>
								<a id="btn_write" href="#" onclick="javascript:fnSave(); return false;" class="btn-confirm btn-disabled">문의하기</a><!-- class="btn-disabled" 버튼비활성 -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
$(document).ready(function() {
	$('input[type=file]').on('change', function() {
		if($(this).val() == '') {
			return;
		}
		
		var file = $(this)[0].files[0];
		var ext = file.name.split('.').pop().toLowerCase();

		if(file.size >= 5*1024*1024) {
			showAlert('5MB 이하로 등록해 주세요.');
			$(this).val('');
			$(this).siblings(".upload-title").val('');
			$(this).parent(".filebox").removeClass("on");
			return false;
		}

    });    

	$('input').on('input', function() {
		fnCheckSave();
	})

	$('textarea[name=contents]').on('input', function() {
		fnCheckSave();
	})

	$('#qagree').on('click', function() {
		fnCheckSave();
	})

	$('input[name=employee_tel]').on('input', function() {
		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		str = fnMakePhone(str.replace(/[^0-9]/g, ""));
		$(this).val(str);
		fnCheckSave();
	})
})

function fnCheckSave() {
	var bCheck = true;
	if($.trim($('input[name=company_name]').val()) === '') bCheck = false;
	if($.trim($('input[name=employee_name]').val()) === '') bCheck = false;
	if(!fnCheckPhone($('input[name=employee_tel]').val())) bCheck = false;
	if(!fnCheckEmail($('input[name=employee_email]').val())) bCheck = false;
	if($.trim($('textarea[name=contents]').val()) === '') bCheck = false;
	if(!$('#qagree').is(':checked')) bCheck = false;

	if(bCheck) {
		$('#btn_write').removeClass('btn-disabled');
	}
	else {
		$('#btn_write').addClass('btn-disabled');
	}
}

function fnSave() {
	if($('#btn_write').hasClass('btn-disabled')) return;

	var form = $('#frmSave')[0];  
	var data = new FormData(form); 

	$.ajax({
			url: "/api/board/qna_register",
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
					showAlert(data.msg, function() { location.href = '<?php echo $back_url; ?>'; });
				}
				else if(data.result == 'login') {
					showAlert(data.msg, function() { location.href = '<?php echo $back_url; ?>'; });
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
</script>