<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('mypage/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>계정기본정보 관리</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							<form id="frmSave">
								<input type="hidden" name="seq" value="<?php echo $info['seq']; ?>" />
								<input type="hidden" name="del_profile_img" value="" />
								<div class="ibox-title">
		                            <h5>계정 기본 정보</h5>
	    	                    </div>  
                                <div class="ibox-content">
									<div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">아이디</label>
	                                    <div class="col-lg-4">
											<input type="text"  value="<?php echo $info['member_id']; ?>" class="form-control" disabled />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">회원레벨</label>
	                                    <div class="col-lg-4 ">
											정회원
	                                    </div>
	                                	<label class="col-lg-2 col-form-label">회원타입</label>
	                                    <div class="col-lg-4">
											<input type="text" class="form-control" value="<?php echo $info['member_type_name']; ?>" disabled />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">비밀번호</label>
	                                    <div class="col-sm-10" id="pw_btn_wrap">
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnShowChangePw();">비밀번호변경</button>
	                                    </div>
	                                    <div class="col-sm-4" style="display:none; text-align:right;" id="pw_change_wrap">
											<input type="password" class="form-control" id="old_pw" style="margin-bottom:10px" placeholder="현재 비밀번호" />
											<input type="password" class="form-control" id="new_pw" style="margin-bottom:10px" placeholder="신규 비밀번호" />
											<input type="password" class="form-control" id="new_pw_confirm"  style="margin-bottom:10px" placeholder="비밀번호 확인" />
											<button type="button" class="btn btn-w-m btn-default" onclick="javascript:fnCancelChangePw();">취소</button>
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnChangePw();">수정</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">성명</label>
	                                    <div class="col-lg-4 ">
											<input type="text" class="form-control" value="<?php echo $info['name']; ?>" maxlength="20" />
	                                    </div>
	                                	<label class="col-lg-2 col-form-label">전화번호</label>
	                                    <div class="col-lg-4">
											<input type="text" class="form-control" value="<?php echo $info['tel']; ?>" maxlength="13" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">이메일</label>
	                                    <div class="col-lg-4">
											<input type="text"  value="<?php echo $info['email']; ?>" class="form-control" maxlength="100" />
										</div>
	                                	<label class="col-lg-2 col-form-label">주요관심사</label>
	                                    <div class="col-lg-4">
											<select id="interest" name="interest" class="form-control">
												<option value="">선택해주세요.</option>
												<?php
													foreach($interest as $row) {
														echo '<option value="' . $row['sub_code'] . '" ' . ($row['sub_code'] === $info['interest_cd'] ? 'selected' : '') . '>' . $row['code_name'] . '</option>';
													}
												?>
											</select>
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">프로필이미지</label>
	                                    <div class="col-sm-4" id="profile_img_file_wrap">
											<?php
												if(!empty($info['profile_img'])) {
													echo '<a href="/api/common/img_view?img_path=' . $info['profile_img'] . '" target="_blank">';
													echo '<input type="text" value="'  . $info['profile_img_name'] . '" class="form-control" disabled style="cursor:pointer;color:blue">';
													echo '</a>';
													echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'profile_img_file\', \'y\');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>';
												}
											?>
										</div>
										<div class="col-sm-1">
											<input type="file" id="profile_img_file" name="profile_img" style="display:none"  accept="image/jpg, image/jpeg, image/png"  />
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:$('#profile_img_file').click();">수정</button>
	                                    </div>
	                                </div>

	                            </div>
							</form>
                        </div>
                    </div>
			</div>


			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">저장</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:fnCancel(); return false;">취소</button>
			</div>
		</div>
    </div>
</div>
<script>
$(document).ready(function() {
	$('#profile_img_file').on('change', function() {
		if($(this).val() == '') {
			return;
		}
		
		var file = $(this)[0].files[0];
		var ext = file.name.split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
			showAlert('JPG, PNG 파일만 업로드 가능합니다.');
			$(this).val('');
			return false;
		}

		if(file.size >= 5*1024*1024) {
			showAlert('5MB 이하로 등록해 주세요.');
			$(this).val('');
			return false;
		}

		var id=$(this).attr('id');
		var str = '<input type="text" value="' + file.name + '" class="form-control upload-title" disabled />'
				+ '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'' + id + '\', \'\');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>';
		$('#' + id + '_wrap').html(str);

	})

})

function fnClearFile(id, val) {
	$('#' + id + '_wrap').html('');
	$('#' + id).val('');
	if(val != '') $('input[name=del_profile_img]').val('y');
}

function fnShowChangePw() {
	$('#old_pw').val('');
	$('#new_pw').val('');
	$('#new_pw_confirm').val('');

	$('#pw_btn_wrap').hide();
	$('#pw_change_wrap').show();
}

function fnCancelChangePw() {
	$('#pw_btn_wrap').show();
	$('#pw_change_wrap').hide();
}

function fnChangePw() {
	$.ajax({
			url: "/api/member/change_password",
			type: "POST",
			data: {old_pw : $('#old_pw').val(), new_pw : $('#new_pw').val(), new_pw_confirm : $('#new_pw_confirm').val() },
			dataType : 'json',
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					showAlert(data.msg, function() { fnCancelChangePw(); });
				}
				else if(data.result == 'login') {
					showAlert(data.msg, function() { location.href = '/'; });
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

function fnSave() {
	showConfirm('수정한 내용을 저장하시겠습니까?', function() {
		var form = $('#frmSave')[0];  
		var data = new FormData(form); 

		$.ajax({
			url: "/api/member/update",
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
					showAlert(data.msg, function() { location.reload(); });
				}
				else if(data.result == 'login') {
					showAlert(data.msg, function() { location.href = '/'; });
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

function fnCancel() {
	showConfirm('수정한 내용을 취소하시겠습니까?', function() { location.reload(); });
}
</script>