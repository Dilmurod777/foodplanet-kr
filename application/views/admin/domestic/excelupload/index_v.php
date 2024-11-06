
<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>국내 데이터 엑셀 업로드</h2>
                </div>
            </div>

        	<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
                	<div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">제조사업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmCompanyM" action="/api/admin/domestic/excelupload/companym">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmCompanyM'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">유통사업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmCompanyD" action="/api/admin/domestic/excelupload/companyd">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmCompanyD'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">자사제품업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmNBProduct" action="/api/admin/domestic/excelupload/nbproduct">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmNBProduct'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">OEM제품업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmOEMProduct" action="/api/admin/domestic/excelupload/oemproduct">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmOEMProduct'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">제조사금융정보업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmFinance" action="/api/admin/domestic/excelupload/finance">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmFinance'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">생산장비정보업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmFacilities" action="/api/admin/domestic/excelupload/facilities">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmFacilities'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">인증정보업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmCert" action="/api/admin/domestic/excelupload/cert">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmCert'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">특허정보업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmPatent" action="/api/admin/domestic/excelupload/patent">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmPatent'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">이미지업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmImage" action="/api/admin/domestic/excelupload/productimg">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmImage'); return false;">등록</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                	</div>
            	</div>
                
                                
        	</div>
        	
        </div>
    </div>
<script>
$(document).ready(function () {
    $('#keyword').on('keypress', function(event) {
        if(event.keyCode == '13') { 
            goPage(0); 
            event.preventDefault(); 
        }
    })

    $('select[name=is_matching]').on('change', function() {
        goPage(0);
    })

});

function goPage(offset) {
	$('#frmSearch').attr('action', '/admin/domestic/list');
	$('input[name=offset]').val(offset);
	$('#frmSearch').submit();
}

function goDetail(seq) {
	$('input[name=biz_no]').val(seq);	
	$('#frmSearch').attr('action', '/admin/domestic/detail');
	$('#frmSearch').submit();
}

function fnUpload(frm) {
	if($('#' + frm + ' input[name=files]').val() == '') {
		alert('업로드할 파일을 선택해 주세요.');
		exit;
	}

    var form = $('#' + frm)[0];  
	var data = new FormData(form); 

	$.ajax({
		url: $('#' + frm).attr('action'),
		type: "POST",
		data: data,
		enctype: 'multipart/form-data',  
		processData: false,    
		contentType: false,      
		cache: false,           
		timeout: 600000,  
		success:function(data){
            console.log(data);
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
//                location.href='/admin/report/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });

}
</script>