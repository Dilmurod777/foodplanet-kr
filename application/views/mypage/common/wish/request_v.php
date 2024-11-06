<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('mypage/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>문의 발송하기</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
					<form id="frmSave">
						<input type="hidden" name="target_member_cd" value="<?php echo $info['member_cd']; ?>" />
                        <div class="ibox ">
							
							   <div class="ibox-content">
								   	<div class="form-group  row">
								   		<label class="col-lg-2 col-form-label">제목</label>
										<div class="col-lg-10 ">
											<input type="text" class="form-control" name="req_title" placeholder="제목을 입력해 주세요." />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">내용</label>
										<div class="col-lg-10">
											<textarea class="form-control" rows="10" name="req_contents"></textarea>
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">첨부파일</label>
										<div class="col-sm-4 filebox" id="attach_file_wrap">
										</div>
										<div class="col-sm-1">
											<input type="file" id="attach_file" name="attach_file" style="display:none" />
											<button type="button" class="btn btn-w-m btn-primary" onclick="$('#attach_file').click();">파일찾기</button>
										</div>
	                                </div>
	                            </div>
	                        
                        </div>
					</form>

					</div>
			</div>

			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">답변발송</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:fnCancel(); return false;">취소</button>
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

		if(file.size >= 10*1024*1024) {
			showAlert('10MB 이하로 등록해 주세요.');
			$(this).val('');
			return false;
		}
		var id=$(this).attr('id');
		var str = '<input type="text" value="' + file.name + '" class="form-control upload-title" disabled />'
				+ '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'' + id + '\', \'\');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>';
		$('#' + id + '_wrap').html(str);
	})
})

function fnCancel() {
	showConfirm('문의발송을 취소하시겠습니까?', function() { location.href='/mypage/wish/detail/<?php echo $info['member_cd']; ?>'; });
}

function fnClearFile(id, seq) {
	$('#' + id + '_wrap').html('');
	$('#' + id).val('');
	
	if(seq == '') return;

	var delete_file = new Array();
	if($('input[name=delete_file]').val() !== '') {
		delete_file = $('input[name=delete_file]').val().split(',');
	}
	delete_file.push(seq);
	$('input[name=delete_file]').val(delete_file.join(','));
}

function fnSave() {
	showConfirm('문의를 발송하시겠습니까?', function() {
		var form = $('#frmSave')[0];  
		var data = new FormData(form); 

		$.ajax({
			url: "/api/request/qna",
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
					showAlert(data.msg, function() { location.href='/mypage/wish/detail/<?php echo $info['member_cd']; ?>'; });
				}
				else if(data.result == 'login') {
					showAlert(data.msg, function() { location.href='/'; });
				}
				else {
					showAlert(data.msg);
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
		});
	});
}

</script>