<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>국내 데이터 - 제조사설비 수정</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							<form id="frmSave">
								<input type="hidden" name="seq" value="<?php echo $info['seq']; ?>" />
								<input type="hidden" name="biz_no" value="<?php echo $info['biz_no']; ?>" />
                                <div class="ibox-content">
                                    <div class="form-group  row">
										<label class="col-lg-2 col-form-label">회사명</label>
	                                    <div class="col-lg-4 ">
											<input type="text" class="form-control" maxlength="50" value="<?php echo $info['company_name']; ?>" />
	                                    </div>
                                        <label class="col-lg-2 col-form-label">사업자등록번호</label>
	                                    <div class="col-lg-4 ">
											<input type="text" class="form-control" maxlength="12" value="<?php echo $info['biz_no']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">설비명<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="img_desc" class="form-control" maxlength="100" value="<?php echo $info['img_desc']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">설비이미지<code>*</code></label>
	                                    <div class="col-sm-4" id="img_url_wrap">
											<input type="text" class="form-control" name="img_url" value="<?php echo $info['img_url']; ?>" readonly />
										</div>
										<div class="col-sm-1">
											<input type="file" id="img_url" name="img_url_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#img_url').click();">추가</button>
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
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/domestic/finance/list'; return false;">목록으로</button>
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

function fnSave()
{
	var form = $('#frmSave')[0];  
	var data = new FormData(form); 

	$.ajax({
		url: "/api/admin/domestic/facilities/edit",
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
                location.href='/admin/domestic/facilities/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });

   $('input[name=biz_no]').on('input', function() {
		$('input[name=chk_biz_no]').val('n');
   })
}

function fnCheckBizno() {
	$.ajax({
		url: "/api/admin/domestic/facilities/chk_bizno",
		type: "POST",
		data: {biz_no : $('input[name=biz_no]').val()},
		dataType : 'JSON',
		async : false,
		success:function(data){
       		if(data.result == 'login') {
       			alert('로그인이 필요합니다.')
                location.href='/admin/login';
       		}
       		else if(data.result== 'fail') {
                alert(data.msg);
				$('input[name=chk_biz_no]').val('n');
       		}
       		else {
                alert(data.msg);
				$('input[name=chk_biz_no]').val('y');
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
		url: "/api/admin/domestic/facilities/delete",
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
				location.href='/admin/domestic/facilities/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

</script>