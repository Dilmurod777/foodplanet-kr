
<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>해외 데이터 엑셀 업로드</h2>
                </div>
            </div>

        	<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
                	<div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">국가업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmNation" action="/api/admin/overseas/excelupload/nation">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmNation'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">국가채널업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmChannel" action="/api/admin/overseas/excelupload/channel">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmChannel'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">제품업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmNBProduct" action="/api/admin/overseas/excelupload/product">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmNBProduct'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">국가TOP제품업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmTopProduct" action="/api/admin/overseas/excelupload/topproduct">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmTopProduct'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">국가별제품정보업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmNP" action="/api/admin/overseas/excelupload/np">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmNP'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">국가별제품HSCODE업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmHscode" action="/api/admin/overseas/excelupload/hscode">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmHscode'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">서류업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmDocument" action="/api/admin/overseas/excelupload/document">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmDocument'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">법령업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmLaw" action="/api/admin/overseas/excelupload/law">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmLaw'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">국가별수입요건업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmRequirement" action="/api/admin/overseas/excelupload/requirement">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmRequirement'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">시장동향업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmTrends" action="/api/admin/overseas/excelupload/trends">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmTrends'); return false;">등록</button>
                                    </div>
                                </div>
	                            <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                    <label class="col-lg-2 col-form-label">바이어업로드</label>
	                                <div class="col-lg-4 ">
                                    <form id="frmBuyer" action="/api/admin/overseas/excelupload/buyer">
                                        <input type="file" name="files"  value="" class="form-control" accept=".xlsx, .xls, .csv" />
                                    </form>
	                                </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success" onclick="javascript:fnUpload('frmBuyer'); return false;">등록</button>
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