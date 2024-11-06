<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>관리자 수정</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							<form id="frmSave">
								<input type="hidden" name="admin_seq" value="<?php echo $info['admin_seq']; ?>" />
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">관리자ID</label>
	                                    <div class="col-lg-4 row">
											<input type="text" value="<?php echo $info['admin_id']; ?>" class="form-control" disabled />
										</div>
                                        <label class="col-lg-2 col-form-label">관리자이름<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="admin_name"  value="<?php echo $info['admin_name']; ?>" class="form-control" />
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">관리자연락처<code>*</code></label>
	                                    <div class="col-lg-4 row">
											<input type="text" name="admin_tel" value="<?php echo $info['admin_tel']; ?>" class="form-control" maxlength="13" />
										</div>
                                        <label class="col-lg-2 col-form-label">관리자이메일<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="admin_email"  value="<?php echo $info['admin_email']; ?>" class="form-control" maxlength="100" />
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
										<label class="col-sm-2 col-form-label">비밀번호</label>
	                                    <div class="col-sm-10" id="pw_btn_wrap">
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnShowChangePw();">비밀번호변경</button>
	                                    </div>
	                                    <div class="col-sm-4" style="display:none; text-align:right;" id="pw_change_wrap">
											<input type="password" class="form-control" id="admin_pw" style="margin-bottom:10px" placeholder="신규 비밀번호" />
											<input type="password" class="form-control" id="admin_pw_confirm"  style="margin-bottom:10px" placeholder="비밀번호 확인" />
											<button type="button" class="btn btn-w-m btn-default" onclick="javascript:fnCancelChangePw();">취소</button>
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnChangePw();">수정</button>
	                                    </div>
                                    </div>

	                            </div>
							</form>
                        </div>
                    </div>
			</div>


			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">수정</button>
	           	<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnDelete(); return false;">삭제</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/admin/list'; return false;">목록으로</button>
			</div>
		</div>
    </div>
</div>

<script>
$(document).ready(function() {

})

function fnShowChangePw() {
	$('#old_pw').val('');
	$('#admin_pw').val('');
	$('#admin_pw_confirm').val('');

	$('#pw_btn_wrap').hide();
	$('#pw_change_wrap').show();
}

function fnCancelChangePw() {
	$('#pw_btn_wrap').show();
	$('#pw_change_wrap').hide();
}

function fnChangePw() {
	$.ajax({
			url: "/api/admin/admin/change_pw",
			type: "POST",
			data: {admin_seq: $('input[name=admin_seq]').val(), admin_pw : $('#admin_pw').val(), admin_pw_confirm : $('#admin_pw_confirm').val() },
			dataType : 'json',
			async : false,
			success: function(data) {
				if(data.result == 'login') {
					alert('로그인이 필요합니다.')
					location.href='/admin/login';
				}
				else if(data.result== 'fail') {
					alert(data.msg);
				}
				else {
					alert(data.msg);
					location.reload();
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}


function fnSave()
{
	$.ajax({
		url: "/api/admin/admin/edit",
		type: "POST",
		data: $('#frmSave').serialize(),
		dataType : 'JSON',
		success:function(data){
			if(data.result == 'login') {
       			alert('로그인이 필요합니다.')
                location.href='/admin/login';
       		}
       		else if(data.result== 'fail') {
                alert(data.msg);
       		}
       		else {
                alert(data.msg);
				location.href='/admin/admin/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

function fnDelete() {
	if(!confirm('삭제하시겠습니까?')) {
		return;
	}
	$.ajax({
		url: "/api/admin/admin/delete",
		type: "POST",
		data: {admin_seq : $('input[name=admin_seq]').val() },
		dataType : 'JSON',
		async : false,
		success:function(data){
       		if(data.result == 'login') {
       			alert('로그인이 필요합니다.')
                location.href='/admin/login';
       		}
       		else if(data.result== 'fail') {
                alert(data.msg);
       		}
       		else {
                alert(data.msg);
				location.href='/admin/admin/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

</script>