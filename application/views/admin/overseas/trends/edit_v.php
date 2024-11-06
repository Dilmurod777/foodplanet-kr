<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>해외 데이터 - 시장동향 수정</h2>
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
                                        <label class="col-lg-2 col-form-label">국가선택<code>*</code></label>
	                                    <div class="col-lg-10 row">
										<?php
											foreach($nation as $row) {
												echo '<div class="col-lg-3 check_wrap">';
												echo '	<input type="radio" id="nation_seq_' .  $row['seq'] . '" name="nation_seq" value="' . $row['seq'] . '" ' . ($info['nation_seq'] === $row['seq'] ? 'checked' : '') . ' >';
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
												echo '	<input type="radio" id="product_seq_' .  $row['seq'] . '" name="product_seq" value="' . $row['seq'] . '" ' . ($info['product_seq'] === $row['seq'] ? 'checked' : '') . ' >';
												echo '	<label for="product_seq_' .  $row['seq'] . '">' . $row['product_name'] . '</label>';
												echo '</div>';
											}
										?>
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">제목<code>*</code></label>
	                                    <div class="col-sm-10" >
											<input type="text" name="title" class="form-control" value="<?php echo $info['title']; ?>" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">연결주소<code>*</code></label>
	                                    <div class="col-sm-10" >
											<input type="text" name="link_url" class="form-control" value="<?php echo $info['link_url']; ?>" />
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
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/overseas/trends/list'; return false;">목록으로</button>
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
		url: "/api/admin/overseas/trends/edit",
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
                location.href='/admin/overseas/trends/list';
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
		url: "/api/admin/overseas/trends/delete",
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
				location.href='/admin/overseas/trends/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

</script>