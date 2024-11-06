<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="board-write community"><!-- 커뮤니티 글쓰기 class="board-write community" -->
				<div class="inner">
				<form id="frmSave">
					<div class="write-area">
						<h3>글 작성</h3>
						<div class="write-box">
							<div class="cate-area">
								<a href="javascript:;" class="btn-cate mo-only"><div style="display:inline-block;" id="mo_selected"><?php echo $types[0]['code_name']; ?></div><span>선택</span></a><!-- D: 카테고리 선택 common.js -->
								<div class="wrt-cate-layer">
									<div class="title-cate">카테고리 선택</div>
									<ul class="wrt-cate-list">
									<?php
										$idx = 0;
										foreach($types as $row) {
									?>
										<li>
											<input type="radio" id="wrtCate<?php echo $row['sub_code']; ?>" name="community_type" value="<?php echo $row['sub_code']; ?>" <?php echo $idx == 0 ? 'checked' : ''; ?> />
											<label for="wrtCate<?php echo $row['sub_code']; ?>"><?php echo $row['code_name']; ?></label>
										</li>
									<?php
											$idx++;
										}
									?>
									</ul>
									<a href="javascript:;" class="btn-type4 btn-submit">선택 완료</a><!-- class="btn-disabled" 버튼비활성, 선택완료버튼에 닫기기능 연결했습니다. common.js 카테고리선택완료-->
								</div>
							</div>
						</div>
						<div class="write-box">
							<div class="title-area">
								<input type="text" class="ip-title" placeholder="제목을 입력해주세요." name="title" />
								<span class="byte"><span id="char_cnt"></span>/30</span>
							</div>
							<div class="cont-area">
								<textarea cols="" rows="" placeholder="내용을 입력해주세요." class="txt-cont" name="contents"></textarea>
							</div>
						</div>
						<div class="write-box">
							<div class="filebox">
								<input type="text" class="upload-title" value="" placeholder="최대 5MB 업로드 가능" readonly />
								<label for="joinInfo5">파일 첨부</label> 
								<input type="file" id="joinInfo5" name="files" class="custom-file" />
								<button class="btn-reset"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
							</div>
						</div>
						<div class="btn-area-center">
							<a href="/community/list" class="btn-prev">취소</a>
							<a href="#" onclick="javascript:fnSave(); return false;" id="btn_write" class="btn-confirm btn-disabled">작성하기</a><!-- class="btn-disabled" 버튼비활성 -->
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>

<script>
$(document).ready(function() {
	$('input[name=community_type]').on('click', function() {
		$('#mo_selected').html($(this).siblings('label').text());
	})

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
})

function fnCheckSave() {
	if($('input[name=title]').val() !== '' && $('textarea[name=contents]').val() !== '') {
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
			url: "/api/community/register",
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
					showAlert(data.msg, function() { location.href = '/community/list'; });
				}
				else if(data.result == 'login') {
					showAlert(data.msg, function() { location.href = '/community/list'; });
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