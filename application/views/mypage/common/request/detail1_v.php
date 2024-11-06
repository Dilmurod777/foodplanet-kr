<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('mypage/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>의뢰상세</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							
								<div class="ibox-content text-right" id="btn_wish">
				                       	
							   </div>
							   <div class="ibox-content">
								   <div class="form-group  row">
                                        <label class="col-lg-12 col-form-label text-center" style="font-size:16px; fong-weight:bold;"><?php echo $info['req_title']; ?></label>
	                                </div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">의뢰 업체명</label>
										<label class="col-lg-4 col-form-label"><?php echo $info['req_biz_no']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">주소</label>
										<label class="col-lg-10 col-form-label "><?php echo $info['req_addr'] . ' ' . $info['req_addr_detail']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">대표자</label>
										<label class="col-lg-4 col-form-label"><?php echo $info['req_owner_name']; ?></label>
	                                	<label class="col-lg-2 col-form-label">대표 전화번호</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['req_company_tel']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">담당자명</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['req_employee_name']; ?></label>
	                                	<label class="col-lg-2 col-form-label">담당자 연락처</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['req_employee_tel']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">담당자 이메일</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['req_employee_email']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">견적요청 상품</label>
										<label class="col-lg-10 col-form-label "><?php echo $info['target_product_name']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">수량</label>
										<label class="col-lg-4 col-form-label"><?php echo number_format($info['target_qty']); ?></label>
	                                	<label class="col-lg-2 col-form-label">단가</label>
										<label class="col-lg-4 col-form-label"><?php echo number_format($info['target_price']); ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">총합계(부가세포함)</label>
										<label class="col-lg-4 col-form-label "><?php echo number_format($info['target_qty'] * $info['target_price'] * 1.1); ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">결제조건</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['delivery_info']; ?></label>
	                                	<label class="col-lg-2 col-form-label">납품요청 일자</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['delivery_day']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">납품 장소</label>
										<label class="col-lg-10 col-form-label"><?php echo $info['delivery_addr'] . ' ' . $info['delivery_addr_detail']; ?></label>
	                                </div>

	                            </div>
	                        
                        </div>
                    </div>
			</div>

			<div class="form-group text-center">
				<?php
					if($info['target_member_cd'] === $member['member_cd']) {
				?>
		           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:location.href='/mypage/request/estimate/<?php echo $info['request_seq']; ?>'; return false;">견적서 발송하기</button>
				<?php
					}
				?>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:fnCancel(); return false;">목록으로</button>
			</div>
		</div>
    </div>
</div>
<script>
$(document).ready(function() {
	fnGetWish();
})
function fnCancel() {
	showConfirm('취소하시겠습니까?', function() { history.back(); });
}

function fnGetWish() {
	$.ajax({
			url: "/api/wish/get",
			type: "POST",
			data: {source_cd : '<?php echo $member['member_cd']; ?>', target_cd : '<?php echo $info['target_member_cd'] === $member['member_cd'] ? $info['req_member_cd'] : $info['target_member_cd']; ?>'},
			dataType : 'json',
			async : false,
			success: function(data) {
				if(data == null || data == '' || data.is_wish === 'n') {
					$('#btn_wish').html('<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnUpdateWish(\'y\'); return false;">관심기업 등록</button>');
				}
				else {
					$('#btn_wish').html('<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnUpdateWish(\'n\'); return false;">관심기업 취소</button>');
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

function fnUpdateWish(is_wish) {
	$.ajax({
			url: "/api/wish/update",
			type: "POST",
			data: {source_cd : '<?php echo $member['member_cd']; ?>', target_cd : '<?php echo $info['target_member_cd'] === $member['member_cd'] ? $info['req_member_cd'] : $info['target_member_cd']; ?>', is_wish: is_wish},
			dataType : 'json',
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					if(is_wish === 'n') {
						$('#btn_wish').html('<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnUpdateWish(\'y\'); return false;">관심기업 등록</button>');
					}
					else {
						$('#btn_wish').html('<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnUpdateWish(\'n\'); return false;">관심기업 취소</button>');
					}
				}
				else if(data.result == 'login') {
					showAlert(data.msg, function() { location.href='/'});
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