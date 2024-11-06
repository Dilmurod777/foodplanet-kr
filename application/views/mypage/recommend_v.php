<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('mypage/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>새로운 멤버 초대</h2>
				<div>동료를 초대해 푸드플라넷의 정보를 공유해 보세요.</div>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							<form id="frmSave">
                                <div class="ibox-content">
									<div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">성명</label>
	                                    <div class="col-lg-4">
											<input type="text"  value="" class="form-control" name="name" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">이메일</label>
	                                    <div class="col-lg-4">
											<input type="text"  value="" class="form-control" name="email" maxlength="100" />
										</div>
										<div class="col-sm-1">
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave();">멤버초대</button>
	                                    </div>
	                                </div>

	                            </div>
							</form>
                        </div>
                    </div>
			</div>

		</div>
    </div>
</div>
<script>
function fnSave() {
	$.ajax({
			url: "/api/common/recommend",
			type: "POST",
			data: $('#frmSave').serialize(),
			dataType : 'json',
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					showAlert(data.msg, function() { location.reload(); });
				}
				else if(data.result == 'login') {
					showAlert(data.msg, function() { location.href = '/'; });
				}
				else {
					showAlert(data.msg);
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}


</script>