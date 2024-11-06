<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('mypage/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>기업 상세 정보 관리</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
			<form id="frmSave">
				<input type="hidden"  name="tab" value="<?php echo $tab; ?>" />
				<input type="hidden"  name="member_cd" value="<?php echo $member['member_cd']; ?>" />

				<div class="row">
                    <div class="col-lg-12">
						<div class="tabs-container">
							<ul class="nav nav-tabs" role="tablist">
								<li><a class="nav-link <?php echo $tab == 'manufacture' ? 'active' : ''; ?>" href="/mypage/company/manufacture">생산정보</a></li>
								<li><a class="nav-link <?php echo $tab == 'facilities' ? 'active' : ''; ?>" href="/mypage/company/facilities">설비정보</a></li>
								<li><a class="nav-link <?php echo $tab == 'cert' ? 'active' : ''; ?>" href="/mypage/company/cert">인증/특허 정보</a></li>
								<li><a class="nav-link <?php echo $tab == 'distribution' ? 'active' : ''; ?>" href="/mypage/company/distribution">유통/수출정보</a></li>
							</ul>
							<div class="tab-content">
								<?php $this->load->view('mypage/manufacture/company_tab/' . $tab . '_v'); ?>
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
	$(document).on('change', 'input[type=file]', function() {
		if($(this).val() == '') {
			return;
		}

		var id=$(this).attr('data-target');
		var file = $(this)[0].files[0];
		var ext = file.name.split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
			showAlert('JPG, PNG 파일만 업로드 가능합니다.');
			$(this).val('');
			return false;
		}
		$('#' + id).html('<input type="text" value="' + file.name + '" class="form-control" disabled />');
	})

})


function fnSave() {
	showConfirm('수정한 내용을 저장하시겠습니까?', function() {
		var form = $('#frmSave')[0];  
		var data = new FormData(form); 

		$.ajax({
			url: "/api/company/update",
			type: "POST",
			data: data,
			enctype: 'multipart/form-data',  
			processData: false,    
			contentType: false,      
			cache: false,           
			timeout: 600000,  
			success: function(data) {
				data = JSON.parse(data);
				if(data.result == 'succ') {
					showAlert(data.msg, function() { location.reload(); });
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