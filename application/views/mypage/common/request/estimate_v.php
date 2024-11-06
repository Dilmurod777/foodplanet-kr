<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('mypage/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>견적서 발송하기</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
					<form id="frmSave">
						<input type="hidden" name="request_seq" value="<?php echo $req['request_seq']; ?>" />
                        <div class="ibox ">
							
							   <div class="ibox-content">
								   <div class="form-group  row">
										<div class="col-lg-12 ">
											<input type="text" class="form-control" name="req_title" placeholder="제목을 입력해 주세요." />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">공급자 업체명</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="req_company_name" value="<?php echo $info['company_name']; ?>" />
										</div>
                                        <label class="col-lg-2 col-form-label">사업자등록번호</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="req_biz_no" value="<?php echo $info['biz_no']; ?>" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">주소</label>
										<div class="col-lg-5">
											<input type="hidden" name="req_zonecode" value="<?php echo $info['zonecode']; ?>" />
											<input type="text" class="form-control" name="req_addr" value="<?php echo $info['addr']; ?>" placeholder="기본주소" />
										</div>
										<div class="col-lg-5">
											<input type="text" class="form-control" name="req_addr_detail" value="<?php echo $info['addr_detail']; ?>" placeholder="상세주소" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">대표자</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="req_owner_name" value="<?php echo $info['owner_name']; ?>" />
										</div>
                                        <label class="col-lg-2 col-form-label">대표변호</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="req_company_tel" value="<?php echo $info['company_tel']; ?>" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">담당자명</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="req_employee_name" value="<?php echo $info['employee_name']; ?>" />
										</div>
                                        <label class="col-lg-2 col-form-label">담당자 연락처</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="req_employee_tel" value="<?php echo $info['employee_tel']; ?>" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">담당자 이메일</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="req_employee_email" value="<?php echo $info['employee_email']; ?>" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">품명</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="target_product_name" value="<?php echo $req['target_product_name']; ?>" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">수량</label>
										<div class="col-lg-4">
											<input type="text" class="form-control commifyNumber" name="target_qty" value="<?php echo number_format($req['target_qty']); ?>" />
										</div>
                                        <label class="col-lg-2 col-form-label">단가</label>
										<div class="col-lg-4">
											<input type="text" class="form-control commifyNumber" name="target_price" value="<?php echo number_format($req['target_price']); ?>" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">공급가액</label>
										<div class="col-lg-4">
											<?php
												$total = $req['target_qty'] * $req['target_price'];
												$vat = $total * 0.1;
											?>
											<input type="text" class="form-control" name="target_total_price" value="<?php echo number_format($total); ?>" />
										</div>
                                        <label class="col-lg-2 col-form-label">부가세액</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="target_total_vat" value="<?php echo number_format($vat); ?>" readonly />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">합계금액</label>
										<div class="col-lg-4">
											<input type="text" class="form-control" name="target_total_sum" value="<?php echo number_format($total + $vat); ?>" readonly />
										</div>
									</div>
	                            </div>
	                        
                        </div>
					</form>

					</div>
			</div>

			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">발송</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:fnCancel(); return false;">취소</button>
			</div>
		</div>
    </div>
</div>
<script>
$(document).ready(function() {
	$('input[name=target_qty], input[name=target_price]').on('input', function() {
		var qty = $('input[name=target_qty]').val().replace(/\s/gi, "").replace(/[^0-9]/g, "");
		var price = $('input[name=target_price]').val().replace(/\s/gi, "").replace(/[^0-9]/g, "");

		$('input[name=target_qty]').val(commify(qty));
		$('input[name=target_price]').val(commify(price));
		if(qty !== '' && price !== '') {
			var total = price * qty;
			var vat = total * 0.1;
			var sum = total + vat;
			$('input[name=target_total_price]').val(commify(Math.round(total)));
			$('input[name=target_total_vat]').val(commify(Math.round(vat)));
			$('input[name=target_total_sum]').val(commify(Math.round(sum)));
		}
		else {
			$('input[name=target_total]').val('');
		}
	});

	$('input[name=target_total_price]').on('input', function() {
		var val = $(this).val().replace(/\s/gi, "").replace(/[^0-9]/g, "");
		if(val !== '') {
			var vat = parseInt(val) * 0.1;
			var sum = parseInt(val) + vat;
			console.log(vat);
			console.log(sum);
			$(this).val(commify(val));
			$('input[name=target_total_vat]').val(commify(Math.round(vat)));
			$('input[name=target_total_sum]').val(commify(Math.round(sum)));
		}
		else {
			$(this).val('');
		}
	})

})
function fnCancel() {
	showConfirm('취소하시겠습니까?', function() { location.href='/mypage/request/detail/<?php echo $req['request_seq']; ?>'; });
}

function fnSave() {
	showConfirm('견적서를 발송하시겠습니까?', function() {
		$.ajax({
			url: "/api/request/estimate",
			type: "POST",
			data: $('#frmSave').serialize(),
			dataType : 'json',
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					showAlert(data.msg, function() { location.href='/mypage/request/list'; });
				}
				else if(data.result == 'login') {
					showAlert(data.msg, function() { location.href='/'; });
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

</script>