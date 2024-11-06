<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>사용자 수정</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							
								<div class="ibox-title">
		                            <h5>계정 기본 정보</h5>
	    	                    </div>  
                                <div class="ibox-content">
                                    <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">회원번호</label>
	                                    <div class="col-lg-4">
											<input type="text" class="form-control" value="<?php echo $info['seq']; ?>" disabled />
										</div>
	                                	<label class="col-lg-2 col-form-label">회원타입</label>
	                                    <div class="col-lg-4">
											<input type="text" class="form-control" value="<?php echo $info['member_type_name']; ?>" disabled />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">아이디</label>
	                                    <div class="col-lg-4">
											<input type="text"  value="<?php echo $info['member_id']; ?>" class="form-control" disabled />
										</div>
	                                	<label class="col-lg-2 col-form-label">이름</label>
	                                    <div class="col-lg-4">
											<input type="text"  value="<?php echo $info['name']; ?>" class="form-control" disabled />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">연락처</label>
	                                    <div class="col-lg-4">
											<input type="text"  value="<?php echo $info['tel']; ?>" class="form-control" disabled />
										</div>
	                                	<label class="col-lg-2 col-form-label">이메일</label>
	                                    <div class="col-lg-4">
											<input type="text"  value="<?php echo $info['email']; ?>" class="form-control" disabled />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">비밀번호</label>
	                                    <div class="col-sm-10" id="pw_btn_wrap">
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnShowChangePw2();">비밀번호변경</button>
	                                    </div>
	                                    <div class="col-sm-4" style="display:none; text-align:right;" id="pw_change_wrap">
											<input type="password" class="form-control" id="new_pw" style="margin-bottom:10px" placeholder="신규 비밀번호" />
											<input type="password" class="form-control" id="new_pw_confirm"  style="margin-bottom:10px" placeholder="비밀번호 확인" />
											<button type="button" class="btn btn-w-m btn-default" onclick="javascript:fnCancelChangePw2();">취소</button>
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnChangePw2();">수정</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">프로필이미지</label>
	                                    <div class="col-sm-4" id="profile_img_wrap">
											<?php
												if(!empty($info['profile_img'])) {
													echo '<a href="/api/common/img_view?img_path=' . $info['profile_img'] . '" target="_blank">';
													echo '<input type="text" value="'  . $info['profile_img_name'] . '" class="form-control" disabled style="cursor:pointer;color:blue">';
													echo '</a>';
												}
											?>
										</div>
										<div class="col-sm-1">
											<input type="file" id="profile_img_file" style="display:none"  accept="image/jpg, image/jpeg, image/png"  />
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:showConfirm('프로필 이미지를 수정하시겠습니까?', function(){ $('#profile_img_file').click();});">수정</button>
	                                    </div>
	                                </div>
	                            </div>
	                        
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
		if($(this).val() == '') return;
		
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

		var data = new FormData(); 
		data.append('profile_img', $(this)[0].files[0]);
		$.ajax({
			url: "/api/member/change_profile_img",
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
					$('#profile_img_wrap').html('<a href="/api/common/img_view?img_path=' + data.data.filepath + data.data.newname + '" target="_blank">' 
												+ '<input type="text" value="' + data.data.orgname + '" class="form-control" disabled style="cursor:pointer;color:blue;">' + '</a>');
				}
				else {
					showAlert(data.msg);
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
		});
		
	})

	$('#introduce_file').on('change', function() {
		if($(this).val() == '') return;

		if($('#files').val() == '') {
			return;
		}
		
		var file = $(this)[0].files[0];
		var ext = file.name.split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg', 'png', 'jpeg', 'pdf']) == -1) {
			showAlert('JPG,PNG,PDF 파일만 업로드 가능합니다.');
			$(this).val('');
			return false;
		}

		if(file.size >= 100*1024*1024) {
			showAlert('100MB 이하로 등록해 주세요.');
			$(this).val('');
			return false;
		}

		$('#introduce_file_wrap').html('<input type="text" value="' + file.name + '" class="form-control" disabled />');
	})

	$('#bizcard_file').on('change', function() {
		if($(this).val() == '') return;

		if($('#files').val() == '') {
			return;
		}
		
		var file = $(this)[0].files[0];
		var ext = file.name.split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg', 'png', 'jpeg', 'pdf']) == -1) {
			showAlert('JPG,PNG,PDF 파일만 업로드 가능합니다.');
			$(this).val('');
			return false;
		}

		if(file.size >= 100*1024*1024) {
			showAlert('100MB 이하로 등록해 주세요.');
			$(this).val('');
			return false;
		}

		$('#bizcard_file_wrap').html('<input type="text" value="' + file.name + '" class="form-control" disabled />');
	})

	$('#logo_img_file').on('change', function() {
		if($(this).val() == '') return;
		
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

		$('#logo_img_wrap').html('<input type="text" value="' + file.name + '" class="form-control" disabled />');
	})

	$('#top_img_file').on('change', function() {
		if($(this).val() == '') return;
		
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

		$('#top_img_wrap').html('<input type="text" value="' + file.name + '" class="form-control" disabled />');
	})

	$('#etc_file').on('change', function() {
		if($(this).val() == '') return;
		
		var file = $(this)[0].files[0];
		if(file.size >= 100*1024*1024) {
			showAlert('100MB 이하로 등록해 주세요.');
			$(this).val('');
			return false;
		}

		$('#etc_file_wrap').html('<input type="text" value="' + file.name + '" class="form-control" disabled />');
	})

	$('input[name=tags]').on('input', function() {
		var str = $(this).val();
//		str = str.replace(/\s/gi, "");
		
		var tags = str.split(',');
		if(tags.length > 5) {
			showAlert('최대 5개까지만 등록가능합니다.');
			tags.pop();			
		}

/*		for(var i = 0; i < tags.length; i++) {
			tags[i] = $.trim(tags[i]);
		} */
		$(this).val(tags.join(','));
	});


	$('input[name=employee_tel]').on('input', function() {
		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		str = fnMakePhone(str.replace(/[^0-9]/g, ""));
		$(this).val(str);
	})
})

function fnShowChangePw2() {
	$('#old_pw').val('');
	$('#new_pw').val('');
	$('#new_pw_confirm').val('');

	$('#pw_btn_wrap').hide();
	$('#pw_change_wrap').show();
}

function fnCancelChangePw2() {
	$('#pw_btn_wrap').show();
	$('#pw_change_wrap').hide();
}

function fnChangePw2() {
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

function fnChangeNickname() {
	showConfirm('활동명을 변경하시겠습니까?', function() {
		$.ajax({
			url: "/api/member/change_nickname",
			type: "POST",
			data: {nickname : $('#nickname').val() },
			dataType : 'json',
			async : false,
			success: function(data) {
				if(data.result == 'login') {
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