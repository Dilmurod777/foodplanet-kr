<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>해외 데이터 - 국가별품목 등록</h2>
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
										<input type="hidden" name="product_name" value="" />
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">HSCODE<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="hscode" class="form-control" />
										</div>
	                                	<label class="col-sm-2 col-form-label">금액<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="price" class="form-control onlyNumber2" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">순서<code>*</code></label>
	                                    <div class="col-sm-4" >
											<input type="text" name="order_no" class="form-control onlyNumber" />
										</div>
	                                </div>

	                            </div>
							</form>
                        </div>
                    </div>
			</div>


			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">저장</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/overseas/top/list'; return false;">목록으로</button>
			</div>
		</div>
    </div>
</div>

<script>
$(document).ready(function() {
	$('input[name=product_seq]').on('click', function() {
		var str = $(this).siblings('label').text();
		$('input[name=product_name]').val(str);
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
		url: "/api/admin/overseas/top/register",
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
                location.href='/admin/overseas/top/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}


</script>