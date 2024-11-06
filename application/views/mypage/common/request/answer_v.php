<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('mypage/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>답변 발송하기</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							   <div class="ibox-content">
								   <div class="form-group  row">
                                        <label class="col-lg-12 col-form-label text-center" style="font-size:16px; fong-weight:bold;"><?php echo $info['req_title']; ?></label>
	                                </div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">문의 업체명</label>
										<label class="col-lg-4 col-form-label"><?php echo $info['req_company_name']; ?></label>
                                        <label class="col-lg-2 col-form-label">사업자등록번호</label>
										<label class="col-lg-4 col-form-label"><?php echo $info['req_biz_no']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">주소</label>
										<label class="col-lg-10 col-form-label "><?php echo $info['req_addr'] . ' ' . $info['req_addr_detail']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">대표자</label>
										<label class="col-lg-4 col-form-label"><?php echo $info['req_owner_name']; ?></label>
	                                	<label class="col-lg-2 col-form-label">대표 전화번호</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['req_company_tel']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">담당자명</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['req_employee_name']; ?></label>
	                                	<label class="col-lg-2 col-form-label">담당자 연락처</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['req_employee_tel']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">담당자 이메일</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['req_employee_email']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">문의내용</label>
										<label class="col-lg-10 col-form-label "><?php echo nl2br($info['req_contents']); ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">첨부파일</label>
										<label class="col-lg-4 col-form-label">
										<?php 
											if(!empty($file)) {
												echo '<a href="/api/common/file_download?file_path=' . $file[0]['new_filepath'] . '&org_file=' . $file[0]['org_filename'] . '" target="_blank">' . $file[0]['org_filename'] . '</a>';
											}
										?>
										</label>
	                                </div>

	                            </div>
	                        
                        </div>

                        <div class="ibox ">
							<div class="ibox-title">
								<h5>답변내용</h5>
							</div>  
						   	<div class="ibox-content">
							   	<form id="frmSave">
									<input type="hidden" name="request_seq" value="<?php echo $info['request_seq']; ?>" />
									<div class="ibox ">
										
										<div class="ibox-content">
												<div class="form-group  row">
													<label class="col-lg-2 col-form-label">제목</label>
													<div class="col-lg-10 ">
														<input type="text" class="form-control" name="ans_title" placeholder="제목을 입력해 주세요." />
													</div>
												</div>
												<div class="hr-line-dashed"></div>
												<div class="form-group  row">
													<label class="col-lg-2 col-form-label">내용</label>
													<div class="col-lg-10">
														<textarea class="form-control" rows="10" name="ans_contents"></textarea>
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

					</div>
			</div>

			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">답변하기</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/mypage/request/detail/<?php echo $info['request_seq']; ?>'; return false;">취소</button>
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
	showConfirm('답변발송을 취소하시겠습니까?', function() { location.href='/mypage/request/detail/<?php echo $info['request_seq']; ?>'; });
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
	showConfirm('답변을 발송하시겠습니까?', function() {
		var form = $('#frmSave')[0];  
		var data = new FormData(form); 

		$.ajax({
			url: "/api/request/ans",
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
					showAlert(data.msg, function() { location.href='/mypage/request/detail/<?php echo $info['request_seq']; ?>'; });
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