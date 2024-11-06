<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>관리자 등록</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							<form id="frmSave">
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">관리자ID<code>*</code></label>
	                                    <div class="col-lg-4 row">
											<input type="text" name="admin_id" value="" class="form-control" />
										</div>
                                        <label class="col-lg-2 col-form-label">관리자이름<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="admin_name"  value="" class="form-control" />
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">관리자연락처<code>*</code></label>
	                                    <div class="col-lg-4 row">
											<input type="text" name="admin_tel" value="" class="form-control" maxlength="13" />
										</div>
                                        <label class="col-lg-2 col-form-label">관리자이메일<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="admin_email"  value="" class="form-control" maxlength="100" />
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">비밀번호<code>*</code></label>
	                                    <div class="col-lg-4 row">
											<input type="password" name="admin_pw" value="" class="form-control" />
										</div>
                                        <label class="col-lg-2 col-form-label">비밀번호확인<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="password" name="admin_pw_confirm"  value="" class="form-control" />
	                                    </div>
                                    </div>

	                            </div>
							</form>
                        </div>
                    </div>
			</div>


			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">저장</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/admin/list'; return false;">목록으로</button>
			</div>
		</div>
    </div>
</div>

<script>
$(document).ready(function() {
	$('input[name=admin_tel]').on('input', function() {
		var str = $(this).val();
		str = str.replace(/\s/gi, "");
		str = fnMakePhone(str.replace(/[^0-9]/g, ""));
		$(this).val(str);
	});

})

function fnSave()
{
	$.ajax({
		url: "/api/admin/admin/register",
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


</script>