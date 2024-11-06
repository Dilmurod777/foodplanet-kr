<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>QNA 상세</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">

					<div class="ibox ">
							<form id="frmSave">
								<input type="hidden" name="employee_email" value="<?php echo $info['employee_email']; ?>" />
								<input type="hidden" name="qna_seq" value="<?php echo $info['qna_seq']; ?>" />
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">제목</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="answer_title" value="<?php echo $info['answer_title']; ?>" />
										</div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">내용</label>
										<div class="col-lg-10">
											<textarea class="form-control" name="answer" rows="15"><?php echo $info['answer']; ?></textarea>
										</div>
                                    </div>
<!--	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">첨부파일</label>
	                                    <div class="col-sm-4" id="attach_file_wrap">
										</div>
										<div class="col-sm-1">
											<input type="file" id="attach_file" name="attach_file" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:$('#attach_file').click();">추가</button>
	                                    </div>
	                                </div> -->

	                            </div>
							</form>
	                        
                        </div>

					</div>
			</div>


			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnAnswer(); return false;">답변등록</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/board/qna_list'; return false;">취소</button>
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
		
		if(id == 'thumbnail_file') {
			var str = '<input type="text" value="' + file.name + '" class="form-control upload-title" disabled />';
		}
		else {
			var str = '<input type="text" value="' + file.name + '" class="form-control upload-title" disabled />'
				+ '<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile(\'' + id + '\', \'\');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>';
		}
		$('#' + id + '_wrap').html(str);
	})

})

function fnClearFile(id, seq) {
	$('#' + id + '_wrap').html('');
	$('#' + id).val('');
}

function fnAnswer()
{
	$.ajax({
       	type:'POST',
    	url:'/api/board/qna_answer',
		data : $('#frmSave').searialize(),
		dataType:"json",
		success:function(data){
       		if(typeof(data.result) == 'login') {
       			alert('로그인이 필요합니다.')
                location.href='/admin/login';
       		}
       		else if(data.result== 'fail') {
                alert(data.msg);
       		}
       		else {
                alert(data.msg);
                location.href='/admin/board/qna_list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

function fnAnswer()
{
	if($.trim($('input[name=answer_title]').val()) == '') {
		alert('제목을 입력해주세요.');
		return;
	}
	if($.trim($('textarea[name=answer]').val()) == '') {
		alert('내용을 입력해주세요.');
		return;
	}

	var form = $('#frmSave')[0];  
	var data = new FormData(form); 

	$.ajax({
		url: "/api/board/qna_answer",
		type: "POST",
		data: data,
		enctype: 'multipart/form-data',  
		processData: false,    
		contentType: false,      
		cache: false,           
		timeout: 600000,  
		success:function(data){
			data = JSON.parse(data);
       		if(data.result == 'login') {
       			alert('로그인이 필요합니다.')
                location.href='/admin/login';
       		}
       		else if(data.result== 'fail') {
                alert(data.msg);
       		}
       		else {
                alert(data.msg);
                location.href='/admin/board/qna_detail/<?php echo $info['qna_seq'];?>';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

</script>