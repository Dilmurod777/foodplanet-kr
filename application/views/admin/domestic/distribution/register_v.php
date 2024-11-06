<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>국내 데이터 - 유통사 등록</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							<form id="frmSave">
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">사업자등록번호<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="biz_no" class="form-control" maxlength="12" />
											<input type="hidden" name="chk_biz_no" value="n" />
	                                    </div>
										<div class="col-lg-1">
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnCheckBizno();">중복확인</button>
										</div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">회사명<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="company_name" class="form-control" maxlength="50" />
	                                    </div>
										<label class="col-sm-2 col-form-label">산업분류코드<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="industrial_code" class="form-control" maxlength="100" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">주요제품<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="main_product" class="form-control" maxlength="100" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">유통유형<code>*</code></label>
										<div class="col-sm-4 row">
											<div class="col-lg-3 check_wrap">
												<input type="checkbox" id="distribution_type_1" name="distribution_type[]" value="국내" >
												<label for="distribution_type_1">국내</label>
											</div>
											<div class="col-lg-3 check_wrap">
												<input type="checkbox" id="distribution_type_2" name="distribution_type[]" value="해외" >
												<label for="distribution_type_2">해외</label>
											</div>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">연매출</label>
										<div class="col-sm-4">
											<input type="text" name="sales_year" class="form-control" maxlength="50" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">연매출 기준년</label>
										<div class="col-sm-4">
											<input type="text" name="sales_at" class="form-control onlyNumber" maxlength="4" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">신용등급</label>
										<div class="col-sm-4">
											<input type="text" name="credit_rating" class="form-control" maxlength="10" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">신용등급 기준연도</label>
										<div class="col-sm-4">
											<input type="text" name="rating_at" class="form-control onlyNumber" maxlength="4" />
	                                    </div>
	                                </div>

	                            </div>
							</form>
                        </div>
                    </div>
			</div>


			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">저장</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/domestic/distribution/list'; return false;">목록으로</button>
			</div>
		</div>
    </div>
</div>

<script>
$(document).ready(function() {
})

function fnSave()
{
	var form = $('#frmSave')[0];  
	var data = new FormData(form); 

	$.ajax({
		url: "/api/admin/domestic/distribution/register",
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
                location.href='/admin/domestic/distribution/list';
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
		url: "/api/admin/domestic/distribution/chk_bizno",
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
</script>