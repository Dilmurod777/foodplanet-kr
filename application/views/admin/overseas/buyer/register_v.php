<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>해외 데이터 - 바이어 등록</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							<form id="frmSave">
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">국가선택<code>*</code></label>
	                                    <div class="col-lg-10 row">
										<?php
											foreach($nation as $row) {
												echo '<div class="col-lg-3 check_wrap">';
												echo '	<input type="radio" id="nation_seq_' .  $row['seq'] . '" name="nation_seq" value="' . $row['seq'] . '"  >';
												echo '	<label for="nation_seq_' .  $row['seq'] . '">' . $row['nation_name'] . '</label>';
												echo '</div>';
											}
										?>
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">품목선택<code>*</code></label>
	                                    <div class="col-lg-10 row">
										<?php
											foreach($product as $row) {
												echo '<div class="col-lg-3 check_wrap">';
												echo '	<input type="radio" id="product_seq_' .  $row['seq'] . '" name="product_seq" value="' . $row['seq'] . '"  >';
												echo '	<label for="product_seq_' .  $row['seq'] . '">' . $row['product_name'] . '</label>';
												echo '</div>';
											}
										?>
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">업체명<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="company_name" class="form-control" />
										</div>
	                                	<label class="col-sm-2 col-form-label">대표명<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="owner_name" class="form-control" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">카테고리<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="category" class="form-control" />
										</div>
	                                	<label class="col-sm-2 col-form-label">HSCODE<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="hscode" class="form-control" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">요청단위<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="volume_order" class="form-control" />
										</div>
	                                	<label class="col-sm-2 col-form-label">유효기간<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="available_period" class="form-control" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">상품명<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="product_name" class="form-control" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">상세내용<code>*</code></label>
	                                    <div class="col-sm-10" >
											<textarea name="desc" class="form-control" rows="3" ></textarea>
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">거래조건<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="trade_condition" class="form-control" />
										</div>
	                                	<label class="col-sm-2 col-form-label">유효기간<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="available_period" class="form-control" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">요청단위<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="volume_order" class="form-control" />
										</div>
	                                	<label class="col-sm-2 col-form-label">희망거래량<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="trade_volume" class="form-control" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">기업명<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="request_company_name" class="form-control" />
										</div>
	                                	<label class="col-sm-2 col-form-label">주요품목<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="main_product" class="form-control" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">주요수입국<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="main_income" class="form-control" />
										</div>
	                                	<label class="col-sm-2 col-form-label">한국과의 거래경험<code>*</code></label>
	                                    <div class="col-lg-4 row">
											<div class="col-lg-3 check_wrap">
												<input type="radio" id="is_korea_y" name="is_korea" value="y" checked >
												<label for="is_korea_y">유</label>
											</div>
											<div class="col-lg-3 check_wrap">
												<input type="radio" id="is_korea_n" name="is_korea" value="n"  >
												<label for="is_korea_n">무</label>
											</div>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">접속방법<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="contact" class="form-control" />
										</div>
	                                	<label class="col-sm-2 col-form-label">무역관 담당자<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="export_staff" class="form-control" />
										</div>
	                                </div>

	                            </div>
							</form>
                        </div>
                    </div>
			</div>


			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">저장</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/overseas/buyer/list'; return false;">목록으로</button>
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
		url: "/api/admin/overseas/buyer/register",
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
                location.href='/admin/overseas/buyer/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}


</script>