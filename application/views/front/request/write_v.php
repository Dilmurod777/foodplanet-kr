<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

    <div class="container">
		<div class="sub-container">
			<div class="board-write community"><!-- 커뮤니티 글쓰기 class="board-write community" -->
				<div class="inner">
					<div class="write-area">
                    <form id="frmSave">
						<input type="hidden" name="req_member_cd" value="<?php echo !empty($mem) ? $mem['member_cd'] : ''; ?>" />
						<input type="hidden" name="target_member_cd" value="<?php echo $info['member_cd']; ?>" />
						<input type="hidden" name="target_detail_seq" value="<?php echo !empty($prod) ? $prod['detail_seq'] : ''; ?>" />
						<h3>의뢰 작성</h3>

						<div class="write-box">
							<div class="title-area">
								<input type="text" class="ip-title" placeholder="제목을 입력해주세요." name="title" />
								<span class="byte"><span id="char_cnt1">0</span>/20</span>
							</div>
						</div>
						<div class="write-box">
							<dl>
								<dt>기본 정보</dt>
								<dd>
									<dl>
										<dt><label for="rq1">의뢰 업체명</label></dt>
										<dd><input type="text" id="rq1" class="ip-w100 request_input" name="req_company_name" maxlength="20" placeholder="최대 20자까지 입력가능합니다." value="<?php echo !empty($mem) ? $mem['company_name'] : ''; ?>" /></dd>
									</dl>
									<dl>
										<dt><label for="rq2">사업자등록번호</label></dt>
										<dd><input type="text" id="rq2" class="ip-w100 request_input" name="req_biz_no" maxlength="13" value="<?php echo !empty($mem) ? $mem['biz_no'] : ''; ?>" maxlength="12" /></dd>
									</dl>
									<dl>
										<dt><label for="rq3">의뢰 업체 주소</label></dt>
										<dd>
											<div class="rq-address">
												<input type="hidden" id="rq3_zonecode" name="req_zonecode" value="<?php echo !empty($mem) ? $mem['zonecode'] : ''; ?>" />
												<input type="text" id="rq3" class="ip-addr" name="req_addr" placeholder="주소를 검색해주세요"  readonly  onclick="javascript:fnSearchAddr('rq3'); return false;"  value="<?php echo !empty($mem) ? $mem['addr'] : ''; ?>"/>
												<a href="#" onclick="javascript:fnSearchAddr('rq3'); return false;" class="btn-zipcode">주소 검색</a>
												<input type="text" id="rq3" class="ip-w100 request_input" name="req_addr_detail" placeholder="상세 주소를 입력해주세요"  value="<?php echo !empty($mem) ? $mem['addr_detail'] : ''; ?>"/>
											</div>
										</dd>
									</dl>
								</dd>
							</dl>
						</div>
						<div class="write-box">
							<dl>
								<dt>기업 정보</dt>
								<dd>
									<dl>
										<dt><label for="rq2-1">대표자</label></dt>
										<dd><input type="text" id="rq2-1" class="ip-w100 request_input" name="req_owner_name" value="<?php echo !empty($mem) ? $mem['owner_name'] : ''; ?>" maxlength="20" /></dd>
									</dl>
									<dl>
										<dt><label for="rq2-2">대표 연락처</label></dt>
										<dd><input type="text" id="rq2-2" class="ip-w100 request_input" name="req_company_tel" value="<?php echo !empty($mem) ? $mem['company_tel'] : ''; ?>" maxlength="13" /></dd>
									</dl>
									<dl>
										<dt><label for="rq2-3">담당자</label></dt>
										<dd><input type="text" id="rq2-3" class="ip-w100 request_input" name="req_employee_name"  value="<?php echo !empty($mem) ? $mem['employee_name'] : ''; ?>" maxlength="20" /></dd>
									</dl>
									<dl>
										<dt><label for="rq2-4">담당자 연락처</label></dt>
										<dd><input type="text" id="rq2-4" class="ip-w100 request_input" name="req_employee_tel"  value="<?php echo !empty($mem) ? $mem['employee_tel'] : ''; ?>" maxlength="13" /></dd>
									</dl>
									<dl>
										<dt><label for="rq2-5">담당자 이메일</label></dt>
										<dd><input type="text" id="rq2-5" class="ip-w100 request_input" name="req_employee_email"  value="<?php echo !empty($mem) ? $mem['employee_email'] : ''; ?>" maxlength="100" /></dd>
									</dl>
								</dd>
							</dl>
						</div>
						<div class="write-box">
							<dl>
								<dt>견적 정보</dt>
								<dd>
									<dl>
										<dt><label for="rq3-1">견적 요청 제조사</label></dt>
										<dd><input type="text" id="rq3-1" class="ip-w100 request_input" name="target_company_name" value="<?php echo $info['company_name']; ?>" readonly /></dd>
									</dl>
									<dl>
										<dt><label for="rq3-2">견적 요청 상품</label></dt>
										<dd><input type="text" id="rq3-2" class="ip-w100 request_input" name="target_product_name" value="<?php echo !empty($prod) && !empty($prod['product_name']) ? $prod['product_name'] : ''; ?>" <?php echo !empty($prod['product_name']) ? 'readonly' : ''; ?> maxlength="50" /></dd>
									</dl>
									<dl>
										<dt><label for="rq3-3">수량</label></dt>
										<dd><input type="text" id="rq3-3" class="ip-w100 request_input" name="target_qty" /></dd>
									</dl>
									<dl>
										<dt><label for="rq3-4">단가</label></dt>
										<dd><input type="text" id="rq3-4" class="ip-w100 request_input" name="target_price" value="<?php echo !empty($prod) && !empty($prod['supply_price']) ? $prod['supply_price'] : ''; ?>" <?php echo !empty($prod) && !empty($prod['supply_price']) ? 'readonly' : ''; ?> /></dd>
									</dl>
									<dl>
										<dt><label for="rq3-5">총 합계(vat 포함)</label></dt>
										<dd><input type="text" id="rq3-5" class="ip-w100 request_input" name="target_total" readonly /></dd>
									</dl>
								</dd>
							</dl>
						</div>
						<div class="write-box">
							<dl>
								<dt>납품 정보</dt>
								<dd>
									<dl>
										<dt><label for="rq4-1">결제 조건</label></dt>
										<dd><input type="text" id="rq4-1" class="ip-w100 request_input" name="delivery_info" maxlength="100" /></dd>
									</dl>
									<dl>
										<dt><label for="rq4-2">납품 요청 일자</label></dt>
										<dd><input type="date" pattern="\d{4}-\d{2}-\d{2}" placeholder="YYYY-MM-DD" id="rq4-2" class="ip-w100 request_input" name="delivery_day" /></dd>
									</dl>
									<dl>
										<dt><label for="rq4-3">납품 장소</label></dt>
										<dd>
											<div class="rq-address">
												<input type="hidden" id="rq4-3_zonecode" name="delivery_zonecode" />
												<input type="text" id="rq4-3" class="ip-addr request_input" name="delivery_addr" placeholder="장소를 입력해주세요"  readonly  onclick="javascript:fnSearchAddr('rq4-3'); return false;" />
												<a href="#" onclick="javascript:fnSearchAddr('rq4-3'); return false;" class="btn-zipcode">장소 검색</a>
												<input type="text" id="rq4-4" class="ip-w100 request_input" name="delivery_addr_detail" placeholder="상세 주소를 입력해주세요" maxlength="100" />
											</div>
										</dd>
									</dl>
								</dd>
							</dl>
						</div>
						<div class="btn-area-center">
							<a href="#" onclick="javascript:history.back(); return false;" class="btn-prev">취소</a>
							<a href="#" onclick="javascript:fnSave(); return false;" class="btn-confirm">의뢰하기</a><!-- class="btn-disabled" 버튼비활성 -->
						</div>
                    </form>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
$(document).ready(function() {
	$('input.request_input').on('focus', function() {
		<?php 
			if(empty($member)) {
		?>
			showAlert('로그인 이후 작성 가능합니다.');
			$(this).blur();
		<?php
			}
		?>
	})

	$('input[name=title]').on('input', function() {
		fnChkChar($(this), 20, 'char_cnt1');
	})

	$('input[name=req_bizno]').on('input', function() {

		var str = $(this).val();
		str = fnMakeBizno(str.replace(/\s/gi, "").replace(/[^0-9]/g, ""));
		$(this).val(str);
	})

	$('input[name=target_qty], input[name=target_price]').on('input', function() {
		var qty = $('input[name=target_qty]').val().replace(/\s/gi, "").replace(/[^0-9]/g, "");
		var price = $('input[name=target_price]').val().replace(/\s/gi, "").replace(/[^0-9]/g, "");

		$('input[name=target_qty]').val(commify(qty));
		$('input[name=target_price]').val(commify(price));
		if(qty !== '' && price !== '') {
			$('input[name=target_total]').val(commify(Math.round(price * qty * 1.1)));
		}
		else {
			$('input[name=target_total]').val('');
		}
	});
})

function fnSearchAddr(id) {
	execDaumPostcode($('#' + id + '_zonecode'), $('#' + id));
}

function fnSave() {
	$.ajax({
			url: "/api/request/register",
			type: "POST",
			data: $('#frmSave').serialize(),
			dataType: 'json',
			success: function(data) {
				if(data.result == 'succ') {
					showAlert(data.msg, function() { history.back(); });
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