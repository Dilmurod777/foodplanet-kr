<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>해외 데이터 - 국가 수정</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							<form id="frmSave">
								<input type="hidden" name="seq" value="<?php echo $info['seq']; ?>" />
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">국가명<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="nation_name"  value="<?php echo $info['nation_name']; ?>" class="form-control" />
	                                    </div>
                                        <label class="col-lg-2 col-form-label">국가명(영문)<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="nation_name_eng"  value="<?php echo $info['nation_name_eng']; ?>" class="form-control" />
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">국가코드<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="nation_code"  value="<?php echo $info['nation_code']; ?>" class="form-control" />
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">국가이미지<code>*</code></label>
	                                    <div class="col-sm-4" id="logo_img_wrap">
											<input type="text" class="form-control" value="<?php echo $info['logo_img']; ?>" disabled />
										</div>
										<div class="col-sm-1">
											<input type="file" id="logo_img" name="logo_img_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:$('#logo_img').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">백그라운드이미지<code>*</code></label>
	                                    <div class="col-sm-4" id="background_img_wrap">
											<input type="text" class="form-control" value="<?php echo $info['background_img']; ?>" disabled />
										</div>
										<div class="col-sm-1">
											<input type="file" id="background_img" name="background_img_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:$('#background_img').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">국기이미지<code>*</code></label>
	                                    <div class="col-sm-4" id="flag_img_wrap">
											<input type="text" class="form-control" value="<?php echo $info['flag_img']; ?>" disabled />
										</div>
										<div class="col-sm-1">
											<input type="file" id="flag_img" name="flag_img_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:$('#flag_img').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">소속대륙<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="continent"  value="<?php echo $info['continent']; ?>" class="form-control" />
	                                    </div>
                                        <label class="col-lg-2 col-form-label">언어<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="language"  value="<?php echo $info['language']; ?>" class="form-control" />
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">통화<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="currency"  value="<?php echo $info['currency']; ?>" class="form-control" />
	                                    </div>
                                        <label class="col-lg-2 col-form-label">FTA 상황<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="fta_status"  value="<?php echo $info['fta_status']; ?>" class="form-control" />
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
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/overseas/nation/list'; return false;">목록으로</button>
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
		var id=$(this).attr('id');
		
		var file = $(this)[0].files[0];
		var ext = file.name.split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
			alert('JPG, PNG 파일만 업로드 가능합니다.');
			$(this).val('');
			return false;
		}


		if(file.size >= 10*1024*1024) {
			alert('10MB 이하로 등록해 주세요.');
			$(this).val('');
			return false;
		}

		var str = '<input type="text" value="' + file.name + '" class="form-control upload-title" disabled />';
		$('#' + id + '_wrap').html(str);
	})

})

function fnClearFile(id, seq) {
	$('#' + id + '_wrap').html('');
	$('#' + id).val('');
}

function fnSave()
{
	var form = $('#frmSave')[0];  
	var data = new FormData(form); 

	$.ajax({
		url: "/api/admin/overseas/nation/edit",
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
                location.href='/admin/overseas/nation/list';
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
		url: "/api/admin/overseas/nation/delete",
		type: "POST",
		data: {seq : $('input[name=seq]').val() },
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
				location.href='/admin/overseas/nation/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

</script>