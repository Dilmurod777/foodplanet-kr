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
							
								<div class="ibox-title">
		                            <h5>계정 기본 정보</h5>
	    	                    </div>  
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">회원레벨</label>
	                                    <div class="col-lg-4 ">
												<?php 
													$tmp = $info['level_name']; 
													if($info['status'] === 'apply') {
														$tmp .= ' - 사업자등록증 업로드 및 확인완료 (' . $info['status_at'] . ')';
													}
												?>
											<input type="text"  value="<?php  echo $tmp; ?>" class="form-control" disabled />
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
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">활동명</label>
	                                    <div class="col-sm-4">
											<input type="text" class="form-control" name="nickname" id="nickname" value="<?php echo $info['nickname']; ?>" />
										</div>
										<div class="col-sm-1">
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnChangeNickname();">수정</button>
	                                    </div>
	                                </div>

	                            </div>
	                        
                        </div>
                    </div>
			</div>

			<form id="frmSave">
	            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
								<div class="ibox-title">
		                            <h5>회사 기본 정보</h5>
	    	                    </div>  
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">회사명</label>
	                                    <div class="col-lg-4">
											<input type="text" class="form-control" value="<?php echo $info['company_name']; ?>" disabled />
										</div>
	                                	<label class="col-lg-2 col-form-label">사업자등록번호</label>
	                                    <div class="col-lg-4">
											<input type="text" class="form-control" value="<?php echo $info['biz_no']; ?>" disabled />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">대표자명</label>
	                                    <div class="col-lg-4">
											<input type="text" class="form-control" value="<?php echo $info['owner_name']; ?>" disabled />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">회사 대표 번호</label>
	                                    <div class="col-lg-4">
											<input type="text" class="form-control" value="<?php echo $info['company_tel']; ?>" disabled />
										</div>
	                                	<label class="col-lg-2 col-form-label">회사 대표 이메일</label>
	                                    <div class="col-lg-4">
											<input type="text" class="form-control" value="<?php echo $info['company_email']; ?>" disabled />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">홈페이지</label>
	                                    <div class="col-lg-10">
											<input type="text" class="form-control" name="homepage" value="<?php echo $info['homepage']; ?>" maxlength="255" />
										</div>
									</div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">담당자명</label>
	                                    <div class="col-lg-4">
											<input type="text" class="form-control" name="employee_name" value="<?php echo $info['employee_name']; ?>" maxlength="20" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">담당자 번호</label>
	                                    <div class="col-sm-4">
											<input type="text" class="form-control" name="employee_tel" value="<?php echo $info['employee_tel']; ?>" maxlength="13" />
										</div>
	                                	<label class="col-sm-2 col-form-label">담당자 이메일</label>
	                                    <div class="col-sm-4">
											<input type="Text" class="form-control" name="employee_email" value="<?php echo $info['employee_email']; ?>" maxlength="100" />
										</div>
	                                </div>
									<div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">회사소개서</label>
	                                    <div class="col-sm-4" id="introduce_file_wrap">
											<?php
												if(!empty($info['introduce_file'])) {
													echo '<a href="/api/common/file_download?file_path=' . $info['introduce_file'] . '" target="_blank">';
													echo '<input type="text" style="color:blue" value="'  . $info['introduce_file_name'] . '" class="form-control" disabled style="cursor:pointer">';
													echo '</a>';
												}
											?>
										</div>
										<div class="col-sm-1">
											<input type="file" id="introduce_file" name="introduce_file" style="display:none" />
											<button type="button" class="btn btn-w-m btn-primary" onclick="$('#introduce_file').click();">파일찾기</button>
	                                    </div>
	                                </div>

									<div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">사업자등록번호</label>
	                                    <div class="col-sm-4" id="bizcard_file_wrap">
											<?php
												if(!empty($info['bizcard_file'])) {
													echo '<a href="/api/common/file_download?file_path=' . $info['bizcard_file'] . '" target="_blank">';
													echo '<input type="text" style="color:blue" value="'  . $info['bizcard_file_name'] . '" class="form-control" disabled style="cursor:pointer">';
													echo '</a>';
												}
											?>
										</div>
										<div class="col-sm-1">
											<input type="file" id="bizcard_file" name="bizcard_file" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="$('#bizcard_file').click();">파일찾기</button>
	                                    </div>
	                                </div>

	                            </div>
	                        
                        </div>
                    </div>
				</div>			


				<div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
								<div class="ibox-title">
		                            <h5>회사 추가 정보</h5>
	    	                    </div>  
                                <div class="ibox-content">
	                                <div class="form-group  row">

	                                	<label class="col-lg-2 col-form-label">설립일</label>
	                                    <div class="col-lg-4">
										<input type="date" pattern="\d{4}-\d{2}-\d{2}" name="incorporation_at" value="<?php echo $info['incorporation_at']; ?>" class="form-control" />
										</div>
	                                	<label class="col-lg-2 col-form-label">표준산업 분류코드</label>
	                                    <div class="col-lg-4">
											<input type="text" name="industrial_code" value="<?php echo $info['industrial_code']; ?>" class="form-control" maxlength="5" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">국가 비즈니스 유형</label>
	                                    <div class="col-lg-4">
											<input type="text" name="nation_biz_type" value="<?php echo $info['nation_biz_type']; ?>" placeholder="국가별로 콤마(,) 구분하여 입력해 주세요" class="form-control" maxlength="200" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">국가 코트라 무역관 검증 유무</label>
	                                    <div class="col-lg-4">
											<input type="text" name="kotra_apply" value="<?php echo $info['kotra_apply']; ?>" class="form-control" placeholder="국가별 검증유무 입력해주세요." maxlength="200" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">직원수</label>
	                                    <div class="col-sm-4">
											<input type="text" class="form-control" name="staff_number" value="<?php echo $info['staff_number']; ?>" maxlength="100" />
										</div>
	                                	<label class="col-sm-2 col-form-label">순이익(단위:천원)</label>
	                                    <div class="col-sm-4">
											<input type="text" class="form-control" name="net_profit" value="<?php echo $info['net_profit']; ?>" maxlength="100" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">선하증권 및 기타 문서</label>
	                                    <div class="col-sm-4" id="etc_file_wrap">
											<?php
												if(!empty($info['etc_file'])) {
													echo '<a href="/api/common/file_download?file_path=' . $info['etc_file'] . '" target="_blank">';
													echo '<input type="text" style="color:blue" value="'  . $info['etc_file_name'] . '" class="form-control" disabled style="cursor:pointer">';
													echo '</a>';
												}
											?>
										</div>
										<div class="col-sm-1">
											<input type="file" id="etc_file" name="etc_file" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="$('#etc_file').click();">파일찾기</button>
	                                    </div>
	                                </div>


	                            </div>
	                        
                        </div>
                    </div>
				</div>				



			</form>


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
		if($('#files').val() == '') {
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

	$('#etc_file').on('change', function() {
		if($(this).val() == '') return;

		if($('#files').val() == '') {
			return;
		}
		
		var file = $(this)[0].files[0];
/*		var ext = file.name.split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg', 'png', 'jpeg', 'pdf', 'docs', 'xl' 'zip']) == -1) {
			showAlert('JPG,PNG,PDF,DOC, 파일만 업로드 가능합니다.');
			$(this).val('');
			return false;
		} */

		if(file.size >= 100*1024*1024) {
			showAlert('100MB 이하로 등록해 주세요.');
			$(this).val('');
			return false;
		}

		$('#etc_file_wrap').html('<input type="text" value="' + file.name + '" class="form-control" disabled />');
	})

	$('input[name=employee_tel]').on('input', function() {
		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		str = fnMakePhone(str.replace(/[^0-9]/g, ""));
		$(this).val(str);
	})
})

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
				showAlert(data.msg);
				if(data.result == 'succ') {
					fnCancelChangePw();
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
				showAlert(data.msg);
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});

	});
}

function fnSave() {
	showConfirm('수정한 내용을 저장하시겠습니까?', function() {

	});
}

function fnCancel() {
	showConfirm('수정한 내용을 취소하시겠습니까?', function() { location.reload(); });
}
</script>