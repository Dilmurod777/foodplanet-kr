<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<style>
input[type=date] {
    height: 48px;
    border: 1px solid #dfdfdf;
    border-radius: 8px;
    box-sizing: border-box;
    color: #272727;
}	
</style>
<div class="container">
		<div class="sub-container">
			<div class="join-area step3">
				<div class="inner">
					<h2>회원가입</h2>
					<ul class="join-step clear">
						<li><div><div>1</div></div><span>TYPE SELECT</span></li>
						<li><div><div>2</div></div><span>BASIC INFO</span></li>
						<li class="on"><div><div>3</div></div><span>BASIC INFO</span></li>
					</ul>
					<div class="join-form">
						<h3>계정 정보 (선택 입력 가능)</h3>
						<form id="frmSave" method="post" action="/join/complete" enctype="multipart/form-data">
							<input type="hidden" name="<?php echo !empty($info) ? $info['hit_cnt'] : '0'; ?>" />
							<?php
								foreach($req as $key=>$val) {
									echo '<input type="hidden" name="' . $key . '" value="' . $val . '" />';
								}
							?>
							<div class="join-form-box">
								<div class="clear">
									<dl>
										<dt><label for="incorporation_at">설립일</label></dt>
										<dd><input type="date" pattern="\d{4}-\d{2}-\d{2}"  id="incorporation_at" name="incorporation_at" placeholder="YYYY-MM-DD" value="<?php echo !empty($info) ? $info['incorporation_at'] : ''; ?>" /></dd>
									</dl>
									<dl>
										<dt><label for="industrial_code">표준산업 분류코드</label></dt>
										<dd><input type="text" id="industrial_code" name="industrial_code" maxlength="5" placeholder="최대 5자의 숫자 입력 (ex. 12345)" value="<?php echo !empty($info) && strlen($info['industrial_code']) >=  5 ? substr($info['industrial_code'], -5) : ''; ?>" /></dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="facilities_scale">시설 규모</label></dt>
										<dd><input type="text" id="facilities_scale" name="facilities_scale" placeholder="백만원 단위로 입력 (ex. 약 4,567백만원)" /></dd>
									</dl>
									<dl>
										<dt><label for="net_profit">영업이익</label></dt>
										<dd><input type="text" id="biz_profit" name="biz_profit" placeholder="백만원 단위로 입력 (ex. 약 123백만원)" value="<?php echo !empty($info) ? $info['biz_profit'] : ''; ?>" /></dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="net_profit">순이익</label></dt>
										<dd><input type="text" id="net_profit" name="net_profit" placeholder="백만원 단위로 입력 (ex. 약 123백만원)" value="<?php echo !empty($info) ? $info['net_profit'] : ''; ?>" /></dd>
									</dl>
									<dl>
										<dt><label for="joinInfo-ch6">회사 소개서</label></dt>
										<dd>
											<div class="filebox">
												<input type="text" class="upload-title" value="" placeholder="JPG,PNG,PDF 파일 업로드" readonly />
												<label for="joinInfo-ch6">파일 선택</label> 
												<input type="file" id="joinInfo-ch6" name="introduce_file"  class="custom-file" />
												<button class="btn-reset"><img src="/assets/front/images/btn_clear.svg" alt="검색어삭제"></button>
											</div>
										</dd>
									</dl>
								</div>
								<div class="clear">
									<dl>
										<dt><label for="joinInfo-ch7">사업자 등록증 사본</label></dt>
										<dd>
											<div class="filebox">
												<input type="text" class="upload-title" value="" placeholder="JPG,PNG,PDF 파일 업로드" readonly />
												<label for="joinInfo-ch7">파일 선택</label> 
												<input type="file" id="joinInfo-ch7" name="bizcard_file" class="custom-file" />
												<button class="btn-reset"><img src="/assets/front/images/btn_clear.svg" alt="검색어삭제"></button>
											</div>
										</dd>
									</dl>
								</div>
							</div>
						</form>
						<div class="btn-area-center">
							<a href="#" onclick="javascript:fnPrev(); return false;" class="btn-prev">이전</a>
							<a href="#" onclick="javascript:fnNext(); return false;" class="btn-confirm">다음</a>
						</div>
						<div class="later-area">
							<a href="javascript:;" class="btn-layer" data-link="#layer-terms">회원가입 후 나중에 입력하기</a>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>                 

<script>
$(document).ready(function() {
	$('#industrial_code').on('input', function() {
		var str = $(this).val();
		str = str.replace(/\s/gi, "").replace(/[^0-9]/g, "");
		$(this).val(str);
	});

	$('input[type=file]').on('change', function() {
		if($('#files').val() == '') {
			return;
		}
		
		var file = $(this)[0].files[0];
		var ext = file.name.split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg', 'png', 'jpeg', 'pdf']) == -1) {
			showAlert('JPG,PNG,PDF 파일만 업로드 가능합니다.');
			$(this).val('');
			$(this).siblings(".upload-title").val('');
			$(this).parent(".filebox").removeClass("on");
			return false;
		}

		if(file.size >= 100*1024*1024) {
			showAlert('100MB 이하로 등록해 주세요.');
			$(this).val('');
			$(this).siblings(".upload-title").val('');
			$(this).parent(".filebox").removeClass("on");
			return false;
		}

    });    

});

function fnNext() {
	var form = $('#frmSave')[0];  
	var data = new FormData(form); 

	$.ajax({
			url: "/join/ajaxComplete",
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
	$('#frmSave').attr('method', 'post');
	$('#frmSave').attr('action', '/join/step2');
	$('#frmSave').submit();
}
</script>