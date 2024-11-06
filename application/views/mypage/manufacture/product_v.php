<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('mypage/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>제품관리</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
			<form id="frmSave">
				<input type="hidden"  name="tab"  value="<?php echo $tab; ?>" />
				<input type="hidden"  name="member_cd"  value="<?php echo $member['member_cd']; ?>" />

				<div class="row">
                    <div class="col-lg-12">
						<div class="tabs-container">
							<ul class="nav nav-tabs" role="tablist">
								<li><a class="nav-link <?php echo $tab == 'own' ? 'active' : ''; ?>" href="/mypage/product/own">자사제품 대표정보</a></li>
								<li><a class="nav-link <?php echo $tab == 'ownlist' ? 'active' : ''; ?>" href="/mypage/product/ownlist">자사제품 등록</a></li>
								<li><a class="nav-link <?php echo $tab == 'oem' ? 'active' : ''; ?>" href="/mypage/product/oem">위탁생산제품 대표정보</a></li>
								<li><a class="nav-link <?php echo $tab == 'oemlist' ? 'active' : ''; ?>" href="/mypage/product/oemlist">위탁생산제품 등록</a></li>
							</ul>
							<div class="tab-content">
								<?php $this->load->view('mypage/manufacture/product_tab/' . $tab . '_v'); ?>
							</div>


						</div>
                    </div>
				</div>			


			</form>


			<div class="form-group text-center">
				<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">저장</button>
				<button type="button" class="btn btn-w-m btn-default" onclick="javascript:fnCancel(); return false;">취소</button>
			</div>
		</div>
    </div>
</div>
<script>
$(document).ready(function() {

})

function fnSave() {
	showConfirm('수정한 내용을 저장하시겠습니까?', function() {
		$.ajax({
			url: "/api/product/update",
			type: "POST",
			data: $('#frmSave').serialize(),
			dataType : 'json',
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					showAlert(data.msg, function() { location.reload(); })
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

	});
}

function fnCancel() {
	showConfirm('수정한 내용을 취소하시겠습니까?', function() { location.reload(); });
}
</script>