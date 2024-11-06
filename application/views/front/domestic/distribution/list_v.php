<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="data-list domestic"><!-- 국내데이터 class="domestic" -->
				<div class="sub-visual type3"><!-- D:20230611 class="type3" 추가 -->
					<img src="/assets/front/images/bg_sv2_m.png" alt="국내데이터 타이틀bg" class="mo-only" /><!-- D:20230611 mo vs이미지 변경 -->
					<h2>
						<span>국내 유통사 데이터</span>
						<div>
							<span>국내 5만여 개 유통사를 카테고리별, </span>국내외 유통채널별로 검색할 수 있습니다.
							<div><span>유통사에 직접 문의하거나 </span>푸드플라넷에 의뢰하여</div>
							국내유통 및 해외유통을 <span>진행할 수도 있습니다.</span>
						</div>
					</h2>
				</div>
				<div class="inner">
					<div class="list-area">
						<div class="list-top">
							<div class="searchbox">
								<input type="text" id="keyword" value="" placeholder="검색어를 입력해주세요." class="ip-search" />
								<button class="btn-reset"><img src="/assets/front/images/btn_clear.svg"  alt="검색어삭제" /></button>
							</div>
							<div class="sorting">
								<select id="order_by" onchange="javascript:goPage(0); return false;">
<!--									<option value="">인기순</option> -->
									<option value="company_name">가나다순</option>
									<option value="created_at">등록순</option>
								</select>
							</div>
							<a href="#" onclick="javascript:fnGoQna(); return false;" class="btn-inq">푸드플라넷에 <span>문의하기</span></a>
							<div class="total" style="display:none">총 <span id="total_rows">0</span>개</div>
						</div>
						<div class="list-wrap clear">
							<a href="javascript:;" class="mo-only btn-filter">상세 검색</a> 
							<div class="filter">
								<div class="filter-inner">
									<h4>
										원하는 유통사를<div>찾으세요.</div>
										<a href="javascript:;" class="filter-reset"><span class="blind">필터초기화</span></a>
									</h4>
									<form id="frmSearch" method="post" >
										<input type="hidden"  name="offset" value="0" />
										<input type="hidden"  name="keyword" value="" />
										<input type="hidden"  name="order_by" value="" />
									<dl>
										<dt>표준산업</dt>
										<dd>
											<ul>
												<li>
													<input type="radio" id="fiter1-1" name="industrial_code" value="육류 도매업" />
													<label for="fiter1-1">육류 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-2" name="industrial_code" value="건어물 및 젓갈류 도매업" />
													<label for="fiter1-2">건어물 및 젓갈류 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-3" name="industrial_code" value="신선, 냉동 및 기타 수산물 도매업" />
													<label for="fiter1-3">신선, 냉동 및 기타 수산물 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-4" name="industrial_code" value="가공식품 도매업" />
													<label for="fiter1-4">가공식품 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-5" name="industrial_code" value="육류 가공식품 도매업" />
													<label for="fiter1-5">육류 가공식품 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-6" name="industrial_code" value="빵류, 과자류, 당류, 초콜릿 도매업" />
													<label for="fiter1-6">빵류, 과자류, 당류, 초콜릿 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-7" name="industrial_code" value="커피 및 차류 도매업" />
													<label for="fiter1-7">커피 및 차류 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-8" name="industrial_code" value="조미료 도매업" />
													<label for="fiter1-8">조미료 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-9" name="industrial_code" value="기타 가공식품 도매업" />
													<label for="fiter1-9">기타 가공식품 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-10" name="industrial_code" value="비알코올음료 도매업" />
													<label for="fiter1-10">비알코올음료 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-11" name="industrial_code" value="상품 종합 도매업" />
													<label for="fiter1-11">상품 종합 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-12" name="industrial_code" value="과실류 도매업" />
													<label for="fiter1-12">과실류 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-13" name="industrial_code" value="채소류, 서류 및 향신작물류 도매업" />
													<label for="fiter1-13">채소류, 서류 및 향신작물류 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-14" name="industrial_code" value="기타 신선식품 및 단순 가공식품 도매업" />
													<label for="fiter1-14">기타 신선식품 및 단순 가공식품 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-15" name="industrial_code" value="수산물 가공식품 도매업" />
													<label for="fiter1-15">수산물 가공식품 도매업</label>
												</li>
												<li>
													<input type="radio" id="fiter1-16" name="industrial_code" value="낙농품 및 동,식물성 유지 도매업" />
													<label for="fiter1-16">낙농품 및 동,식물성 유지 도매업</label>
 												</li>
											</ul>
											<a href="javascript:;" class="btn-more">더보기</a>
										</dd>
										<dt>국내 / 해외 </dt>
										<dd>
											<ul>
												<li>
													<input type="checkbox" id="fiter2-1" name="distribution_type[]" value="국내" />
													<label for="fiter2-1">국내</label>
												</li>
												<li>
													<input type="checkbox" id="fiter2-2" name="distribution_type[]" value="해외" />
													<label for="fiter2-2">해외</label>
												</li>
											</ul>
										</dd>
										<dt>매출</dt>
										<dd>
											<ul>
												<li>
													<input type="radio" id="fiter3-1" name="sales" value="1" />
													<label for="fiter3-1">1000억 이상</label>
												</li>
												<li>
													<input type="radio" id="fiter3-2" name="sales" value="2" />
													<label for="fiter3-2">500억 이상</label>
												</li>
												<li>
													<input type="radio" id="fiter3-3" name="sales" value="3" />
													<label for="fiter3-3">100억 이상</label>
												</li>
												<li>
													<input type="radio" id="fiter3-4" name="sales" value="4" />
													<label for="fiter3-4">50억 이상</label>
												</li>
												<li>
													<input type="radio" id="fiter3-5" name="sales" value="5" />
													<label for="fiter3-5">10억 이상</label>
												</li>
												<li>
													<input type="radio" id="fiter3-6" name="sales" value="6" />
													<label for="fiter3-6">기타</label>
												</li>
											</ul>
											<a href="javascript:;" class="btn-more">더보기</a>
										</dd>
										<dt>신용등급</dt>
										<dd>
											<ul>
												<li>
													<input type="radio" id="fiter4-1" name="rating" value="1" />
													<label for="fiter4-1">A이상</label>
												</li>
												<li>
													<input type="radio" id="fiter4-2" name="rating" value="2" />
													<label for="fiter4-2">BBB</label>
												</li>
												<li>
													<input type="radio" id="fiter4-3" name="rating" value="3" />
													<label for="fiter4-3">BB</label>
												</li>
												<li>
													<input type="radio" id="fiter4-4" name="rating" value="4" />
													<label for="fiter4-4">B</label>
												</li>
											</ul>
											<a href="javascript:;" class="btn-more">더보기</a>
										</dd>
									</dl>
									</form>
									<a href="javascript:;" class="btn-type4 btn-submit">완료</a><!-- D: 필터선택시 즉시반영이라서 완료버튼에 닫기기능 연결했습니다. common.js 필터선택완료 -->
								</div>
							</div>
							<div class="list" id="distribution_list">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script>
var old_sales = '';
var old_credit = '';
var old_industry = '';
$(document).ready(function() {
	$('input[name=industrial_code]').on('click', function() {
		if(old_industry == $(this).val()) {
			$(this).prop('checked', false);
			old_industry = '';
		}
		else {
			old_industry = $(this).val();
		}
		goPage(0);
	})

	$('input[name="distribution_type[]"]').on('click', function() {
		goPage(0);
	})

	$('input[name=sales]').on('click', function(e) {
		if(old_sales == $(this).val()) {
			$(this).prop('checked', false);
			old_sales = '';
		}
		else {
			old_sales = $(this).val();
		}
		goPage(0);
	})

	$('input[name=rating]').on('click', function() {
		if(old_credit == $(this).val()) {
			$(this).prop('checked', false);
			old_credit = '';
		}
		else {
			old_credit = $(this).val();
		}
		goPage(0);
	})

	$('#keyword').on('keypress', function(e) {
		if(e.keyCode == 13) {
			$('#frmSearch input[name=keyword]').val($(this).val());
			goPage(0);
		}
	})

	$(".filter-reset").each(function(e){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			$(".filter dt").removeClass("active");
			$(".filter dd").hide();
			$(".filter input[type=checkbox]").prop("checked", false);
			$(".filter input[type=radio]").prop("checked", false);
			goPage(0);
		});
	});

	goPage(0);
});

function goPage(page) {
	$('#frmSearch input[name=offset]').val(page);
	$('#frmSearch input[name=keyword]').val($('#keyword').val());
	$('#frmSearch input[name=order_by]').val($('#order_by').val());
	$.ajax({
			url: "/domestic/distribution/list_detail",
			type: "POST",
			data: $('#frmSearch').serialize(),
			async : false,
			success: function(data) {
				$('#distribution_list').html(data);
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

</script>