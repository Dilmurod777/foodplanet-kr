<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="board-write qna"><!-- qna 글쓰기 class="board-write qna" -->
				<div class="inner">
					<div class="write-area">
					<form id="frmSave">
						<h3>1:1 문의</h3>
						<div class="write-box">
							<div class="title-area">
								<input type="text" class="ip-title" placeholder="제목을 입력해주세요." name="title" />
								<span class="byte"><span id="char_cnt"></span>/30</span>
							</div>
							<div class="cont-area">
								<textarea cols="" rows="" name="contents" placeholder="내용을 입력해주세요." class="txt-cont"></textarea>
							</div>
						</div>
						<div class="write-box">
							<div class="title-area">
								<input type="text" name="email" class="ip-title ip-email" placeholder="답변 받을 이메일을 입력해주세요." />
							</div>
						</div>
						<div class="write-box">
							<div class="filebox">
								<input type="text" class="upload-title" value="" placeholder="최대 5MB 업로드 가능" readonly />
								<label for="joinInfo5">파일 첨부</label> 
								<input type="file" name="files" id="joinInfo5" class="custom-file" />
								<button class="btn-reset"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
							</div>
						</div>
						<div class="qna-agree-area">
							<input type="checkbox" id="qagree" />
							<label for="qagree">개인정보처리방침에 동의합니다.</label>
							<div>개인정보처리방침에 동의해주세요.</div>
						</div>
						<div class="btn-area-center">
							<a href="/board/faq" class="btn-prev">취소</a>
							<a href="#" id="btn_write" onclick="javascript:fnSave(); return false;" class="btn-confirm btn-disabled">문의하기</a><!-- class="btn-disabled" 버튼비활성 -->
						</div>
					</form>
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

	$('input[name=title]').on('input', function() {
		fnChkChar($(this), 30, 'char_cnt');
		fnCheckSave();
	})

	$('textarea[name=contents]').on('input', function() {
		fnCheckSave();
	})

	$('input[name=email]').on('input', function() {
		fnCheckSave();
	})

	$('#qagree').on('click', function() {
		fnCheckSave();
	})
})

function fnCheckSave() {
	if($('input[name=title]').val() !== '' && $('textarea[name=contents]').val() !== '' && $('input[name=email]').val() !== '' && $('#qagree').is(':checked')) {
		$('#btn_write').removeClass('btn-disabled');
	}
	else {
		$('#btn_write').addClass('btn-disabled');
	}
}

function fnSave() {
	if($('#btn_write').hasClass('btn-disabled')) return;

	if(!fnCheckEmail($('input[name=email]').val())) {
		showAlert('이메일 형식이 올바르지 않습니다.');
		return;
	}

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
					showAlert(data.msg, function() { location.href = '/board/faq'; });
				}
				else if(data.result == 'login') {
					showAlert(data.msg, function() { location.href = '/board/faq'; });
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