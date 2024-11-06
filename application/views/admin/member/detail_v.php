<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>사용자 상세</h2>
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
                                        <label class="col-lg-2 col-form-label">회원상태</label>
	                                    <div class="col-lg-4 ">
											<?php 
												if($info['is_leave'] === 'y') {
													$tmp = '탈퇴회원&nbsp;&nbsp;&nbsp;' . $info['leaved_at'];
													if($info['leaved_type'] === '1') {
														$tmp .= ' (사용자탈퇴)';
													}
													else {
														$tmp .= ' (관리자강제탈퇴)';
													}
												}
												else if($info['is_block'] === 'y') {
													$tmp = '차단회원&nbsp;&nbsp;&nbsp;' . $info['blocked_at'];
												}
												else if($info['is_dormant'] === 'y') {
													$tmp = '휴면회원&nbsp;&nbsp;&nbsp;' . $info['dormanted_at'];
												}
												else {
													$tmp = '정상회원';
												}
											?>
											<input type="text"  value="<?php  echo $tmp; ?>" class="form-control" disabled />
	                                    </div>
										<?php 
											if($info['is_leave'] === 'y') {
												echo '<label class="col-lg-2 col-form-label">탈퇴사유</label>';
												echo '<label class="col-lg-4 col-form-label">';
												echo nl2br($info['leaved_memo']);
												echo '</label>';
											}
											else if($info['is_block'] === 'y') {
												echo '<label class="col-lg-2 col-form-label">차단사유</label>';
												echo '<label class="col-lg-4 col-form-label">';
												echo nl2br($info['blocked_memo']);
												echo '</label>';
											}
										?>

                                    </div>
	                                <div class="hr-line-dashed"></div>
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
	                                	<label class="col-sm-2 col-form-label">이름</label>
	                                    <div class="col-sm-4">
											<input type="text" class="form-control" name="name" id="name" value="<?php echo $info['name']; ?>" disabled />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">연락처</label>
	                                    <div class="col-lg-4">
											<input type="text" name="tel" id="tel"  value="<?php echo $info['tel']; ?>" class="form-control" disabled />
										</div>
	                                	<label class="col-sm-2 col-form-label">이메일</label>
	                                    <div class="col-sm-4">
											<input type="text" class="form-control" name="email" id="email" value="<?php echo $info['email']; ?>" disabled />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">관심사</label>
	                                    <div class="col-lg-4">
											<input type="text" name="interest" id="interest"  value="<?php echo $info['interest_name']; ?>" class="form-control" disabled />
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

	                            </div>
	                        
                        </div>
                    </div>
			</div>


			<div class="form-group text-center">
			<?php
				if($info['is_dormant'] === 'n') {
					if($info['is_block'] === 'n') {
						echo '<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnShowBlock(); return false;">회원차단</button>';
					}
					else {
						echo '<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnMemberUnblock(); return false;">차단해제</button>';
					}

					if($info['is_leave'] === 'n' ) {
						echo '<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnShowLeave(); return false;">회원탈퇴</button>';
					}
					else {
						echo '<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnMemberUnleave(); return false;">회원복원</button>';
					}
				}
			?>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/member/list'; return false;">목록으로</button>
			</div>
		</div>
    </div>
</div>

                <div class="modal inmodal fade" id="leaveModal" tabindex="-1" role="dialog"  aria-hidden="true">
	                <div class="modal-dialog modal-lg">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title msg_title">탈퇴사유 입력</h4>
                            </div>
                           	<div class="modal-body" >
                           	<form id="frmLeave" method="post">
                            	<input type="hidden" name="leaved_type" value="2" />
                            	<input type="hidden" name="seq" value="<?php echo $info['seq']; ?>" />
                                <div class="form-group  row">
                                	<div class="col-sm-1"></div>
                                    <div class="col-sm-10" id="cancelReason" style="max-height:600px; overflow:auto">
                                    	<textarea id="reason" name="leaved_memo" class="form-control" rows="7" style="resize:none"></textarea>
                                    </div>
                                	<div class="col-sm-1"></div>
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                            	<button type="button" class="btn btn-primary" onclick="javascript:fnMemberLeave();" >탈퇴</button>
                            	<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="modal inmodal fade" id="blockModal" tabindex="-1" role="dialog"  aria-hidden="true">
	                <div class="modal-dialog modal-lg">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title msg_title">차단사유 입력</h4>
                            </div>
                           	<div class="modal-body" >
                           	<form id="frmBlock" method="post">
                            	<input type="hidden" name="seq" value="<?php echo $info['seq']; ?>" />
                                <div class="form-group  row">
                                	<div class="col-sm-1"></div>
                                    <div class="col-sm-10" style="max-height:600px; overflow:auto">
                                    	<textarea name="blocked_memo" class="form-control" rows="7" style="resize:none"></textarea>
                                    </div>
                                	<div class="col-sm-1"></div>
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                            	<button type="button" class="btn btn-primary" onclick="javascript:fnMemberBlock();" >차단</button>
                            	<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
				
<form id="frmGo" method="post" action="/admin/member/edit">
    <input type="hidden" name="seq" value="" />
</form>
<script>
function goEdit(seq) {
	$('input[name=seq]').val(seq);	
	$('#frmGo').submit();
}

function fnShowLeave() {
	if(confirm('해당 회원을 탈퇴처리하시겠습니까?')) {
        $('#leaveModal').modal('show');
    }
}

function fnMemberLeave()
{
	if($.trim($('#reason').val()) == '') {
		alert('탈퇴사유를 입력해 주세요.');
		return;	
	}
	$.ajax({
       	type:'POST',
    	url:'/api/member/leave',
		data : $('#frmLeave').serialize(),
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
                location.href='/admin/member/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

function fnMemberUnleave()
{
	if(!confirm('해당 회원을 복원하시겠습니까?')) {
		return;
	}
	$.ajax({
       	type:'POST',
    	url:'/api/member/unleave',
		data : {seq : '<?php echo $info['seq']; ?>'},
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
                location.href='/admin/member/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

function fnShowBlock() {
	if(confirm('해당 회원을 차단처리하시겠습니까?')) {
        $('#blockModal').modal('show');
    }
}

function fnMemberBlock()
{
	if($.trim($('textarea[name=blocked_memo]').val()) == '') {
		alert('차단사유를 입력해 주세요.');
		return;	
	}
	$.ajax({
       	type:'POST',
    	url:'/api/member/block',
		data : $('#frmBlock').serialize(),
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
                location.href='/admin/member/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

function fnMemberUnblock()
{
	if(!confirm('해당 회원을 차단해제 하시겠습니까?')) {
		return;
	}
	$.ajax({
       	type:'POST',
    	url:'/api/member/unblock',
		data : {seq : '<?php echo $info['seq']; ?>'},
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
                location.href='/admin/member/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

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
			url: "/api/member/change_password2",
			type: "POST",
			data: {seq: '<?php echo $info['seq']; ?>', new_pw : $('#new_pw').val(), new_pw_confirm : $('#new_pw_confirm').val() },
			dataType : 'json',
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					alert(data.msg);
					fnCancelChangePw2();
				}
				else if(data.result == 'login') {
					alert(data.msg);
					location.href = '/';
				}
				else {
					alert(data.msg);
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

</script>