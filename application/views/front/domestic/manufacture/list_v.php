<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

    <div class="container">
		<div class="sub-container">
			<div class="data-list domestic"><!-- 국내데이터 class="domestic" -->
				<div class="sub-visual type3"><!-- D:20230611 class="type3" 추가 -->
					<img src="/assets/front/images/bg_sv2_m.png" alt="국내데이터 타이틀bg" class="mo-only" /><!-- D:20230611 mo vs이미지 변경 -->
					<h2>
						<span>국내 제조사 데이터</span>
						<div>
							<span>제품, 생산, 설비, 인증/특허 및 </span>유통/수출, 제조사 가동 현황, 생산 능력 등
							<div><span>국내 3만여 제조사 데이터를 </span>카테고리별로 검색할 수 있습니다.</div>
							제조사에 직접 문의하거나 <span>푸드플라넷에 의뢰하여 </span>제품생산을 진행할 수도 있습니다. 
						</div>
					</h2>
				</div>
				<div class="inner">
					<div class="list-area">
						<dl class="update-area">
							<dt>업데이트된 제조사 정보를 확인하세요!</dt>
							<dd>
								<div class="swiper-button-next"></div>
								<div class="swiper-button-prev"></div>
								<div class="swiper upd-swiper">
									<ul class="swiper-wrapper">
									<?php
										foreach($list as $row) {
											echo '<li class="swiper-slide"><a href="#" onclick="javascript:goDetail(\'' . $row['biz_no'] . '\'); return false;"><img src="' . $row['logo_img'] . '" style="border:none;" /></a></li>';	
										}
									?>
									</ul>	
									<script>
										var updswiper = new Swiper(".upd-swiper", {
										  observer: true,
										  observeParents: true,
										  slidesPerView: "auto",
										  spaceBetween: 20,
										  navigation: {
											nextEl: ".update-area .swiper-button-next",
											prevEl: ".update-area .swiper-button-prev",
										  },
										  breakpoints: {
											900: {
											  slidesPerView: "auto",
											  spaceBetween: 20
											},
										  }
										});
									</script>
								</div>
							</dd>
						</dl>
						<div class="list-top">
							<div class="searchbox">
								<input type="text" value="" id="keyword" placeholder="검색어를 입력해주세요." class="ip-search" />
								<button class="btn-reset"><img src="/assets/front/images/btn_clear.svg"  alt="검색어삭제" /></button>
							</div>
							<div class="sorting">
								<select id="order_by" onchange="javascript:goPage(0); return false;">
									<option value="hit_cnt">인기순</option>
									<option value="created_at">등록순</option>
									<option value="company_name">가나다순</option>
								</select>
							</div>
							<a href="#" onclick="javascript:fnGoQna(); return false;" class="btn-inq">푸드플라넷에 <span>문의하기</span></a>
							<div class="total">총 <span id="total_rows">0</span>개</div>
						</div>
						<div class="list-wrap clear">
							<a href="javascript:;" class="mo-only btn-filter">상세 검색</a> 
							<div class="filter">
								<div class="filter-inner">
									<h4>
										원하는 제조사를<div>찾으세요.</div>
										<a href="javascript:;" class="filter-reset"><span class="blind">필터초기화</span></a>
									</h4>
									<form id="frmSearch" method="post" >
										<input type="hidden"  name="offset" value="0" />
										<input type="hidden"  name="keyword" value="" />
										<input type="hidden"  name="order_by" value="" />
									<dl>
										<dt>카테고리</dt>
										<dd>
											<ul>
											<?php
												foreach($filter['category'] as $row) {
											?>
												<li>
													<input type="radio" id="category-<?php echo $row['sub_code']; ?>" name="category" value="<?php echo $row['sub_code']; ?>"  />
													<label for="category-<?php echo $row['sub_code']; ?>"><?php echo $row['code_name']; ?></label>
												</li>
											<?php
												}
											?>
											</ul>
											<a href="javascript:;" class="btn-more">더보기</a>
										</dd>
										<dt>주요 기업 OEM 제조사 </dt>
										<dd>
											<ul>
											<?php
												foreach($filter['company'] as $row) {
											?>
												<li>
													<input type="radio" id="company-<?php echo $row['sub_code']; ?>" name="company" value="<?php echo $row['code_name']; ?>"  />
													<label for="company-<?php echo $row['sub_code']; ?>"><?php echo $row['code_name']; ?></label>
												</li>
											<?php
												}
											?>
											</ul>
											<a href="javascript:;" class="btn-more">더보기</a>
										</dd>
										<dt>매출</dt>
										<dd>
											<ul>
												<li>
													<input type="radio" id="fiter3-1" name="sales" value="1" <?php !empty($req) && !empty($req['sales']) && $req['sales'] === '1' ? 'checked' : '' ?> />
													<label for="fiter3-1">100억 이상</label>
												</li>
												<li>
													<input type="radio" id="fiter3-2" name="sales" value="2" <?php !empty($req) && !empty($req['sales']) && $req['sales'] === '2' ? 'checked' : '' ?> />
													<label for="fiter3-2">50억 이상</label>
												</li>
												<li>
													<input type="radio" id="fiter3-3" name="sales" value="3" <?php !empty($req) && !empty($req['sales']) && $req['sales'] === '3' ? 'checked' : '' ?> />
													<label for="fiter3-3">10억 이상</label>
												</li>
												<li>
													<input type="radio" id="fiter3-4" name="sales" value="4" <?php !empty($req) && !empty($req['sales']) && $req['sales'] === '4' ? 'checked' : '' ?> />
													<label for="fiter3-4">10억 미만</label>
												</li>
											</ul>
											<a href="javascript:;" class="btn-more">더보기</a>
										</dd>
										<dt>신용등급</dt>
										<dd>
											<ul>
												<li>
													<input type="radio" id="fiter4-1" name="rating" value="1" <?php !empty($req) && !empty($req['rating']) && $req['rating'] === '1' ? 'checked' : '' ?> />
													<label for="fiter4-1">A이상</label>
												</li>
												<li>
													<input type="radio" id="fiter4-2" name="rating" value="2" <?php !empty($req) && !empty($req['rating']) && $req['rating'] === '2' ? 'checked' : '' ?> />
													<label for="fiter4-2">BBB</label>
												</li>
												<li>
													<input type="radio" id="fiter4-3" name="rating" value="3" <?php !empty($req) && !empty($req['rating']) && $req['rating'] === '3' ? 'checked' : '' ?> />
													<label for="fiter4-3">BB</label>
												</li>
												<li>
													<input type="radio" id="fiter4-4" name="rating" value="4" <?php !empty($req) && !empty($req['rating']) && $req['rating'] === '4' ? 'checked' : '' ?> />
													<label for="fiter4-4">B</label>
												</li>
											</ul>
											<a href="javascript:;" class="btn-more">더보기</a>
										</dd>
										<dt>인증</dt>
										<dd>
											<ul>
												<li>
													<input type="checkbox" id="fiter5-1" name="cert[]" value="HACCP" <?php !empty($req) && !empty($req['cert']) && $req['cert'] === 'HACCP' ? 'checked' : '' ?> />
													<label for="fiter5-1">HACCP</label>
												</li>
												<li>
													<input type="checkbox" id="fiter5-2" name="cert[]" value="ISO9001" <?php !empty($req) && !empty($req['cert']) && $req['cert'] === 'ISO9001' ? 'checked' : '' ?> />
													<label for="fiter5-2">ISO9001</label>
												</li>
												<li>
													<input type="checkbox" id="fiter5-3" name="cert[]" value="ISO14001" <?php !empty($req) && !empty($req['cert']) && $req['cert'] === 'ISO14001' ? 'checked' : '' ?> />
													<label for="fiter5-3">ISO14001</label>
												</li>
												<li>
													<input type="checkbox" id="fiter5-4" name="cert[]" value="ISO22000" <?php !empty($req) && !empty($req['cert']) && $req['cert'] === 'ISO22000' ? 'checked' : '' ?> />
													<label for="fiter5-4">ISO22000</label>
												</li>
												<li>
													<input type="checkbox" id="fiter5-5" name="cert[]" value="FSSC22000" <?php !empty($req) && !empty($req['cert']) && $req['cert'] === 'FSSC22000' ? 'checked' : '' ?> />
													<label for="fiter5-5">FSSC22000</label>
												</li>
												<li>
													<input type="checkbox" id="fiter5-6" name="cert[]" value="HALAL" <?php !empty($req) && !empty($req['cert']) && $req['cert'] === 'HALAL' ? 'checked' : '' ?> />
													<label for="fiter5-6">HALAL</label>
												</li>
												<li>
													<input type="checkbox" id="fiter5-7" name="cert[]" value="VEGAN" <?php !empty($req) && !empty($req['cert']) && $req['cert'] === 'VEGAN' ? 'checked' : '' ?> />
													<label for="fiter5-7">VEGAN</label>
												</li>
											</ul>
											<a href="javascript:;" class="btn-more">더보기</a>
										</dd>
									</dl>
									</form>
									<a href="javascript:;" class="btn-type4 btn-submit">완료</a><!-- D: 필터선택시 즉시반영이라서 완료버튼에 닫기기능 연결했습니다. common.js 필터선택완료 -->
								</div>
							</div>
							<div class="list" id="domestic_list">

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>   
<form id="frmDetail" method="post" action="/domestic/manufacture/detail">
	<input type="hidden" name="member_cd" value="" />
	<input type="hidden" name="biz_no" value="" />
</form>
<script>
var old_sales = '';
var old_credit = '';
var old_cate = '';
var old_oem = '';
$(document).ready(function() {
	$('input[name=category]').on('click', function() {
		if(old_cate == $(this).val()) {
			$(this).prop('checked', false);
			old_cate = '';
		}
		else {
			old_cate = $(this).val();
		}
		goPage(0);
	})

	$('input[name=company]').on('click', function() {
		if(old_oem == $(this).val()) {
			$(this).prop('checked', false);
			old_oem = '';
		}
		else {
			old_oem = $(this).val();
		}
		goPage(0);
	})

	$('input[name=manufacture]').on('click', function() {
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

	$('input[name="cert[]"]').on('click', function() {
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
			url: "/domestic/manufacture/list_detail",
			type: "POST",
			data: $('#frmSearch').serialize(),
			async : false,
			success: function(data) {
				$('#domestic_list').html(data);
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

function goDetail(no) {
	$('#frmDetail input[name=biz_no]').val(no);
	$('#frmDetail').submit();
}
</script>