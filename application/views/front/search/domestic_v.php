<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->
<div class="container">
		<div class="sub-container">
			<div class="search-result"><!-- 검색결과 class="search-result" -->
				<div class="search-result-top">
					<div class="searchbox">
						<input type="text" value="<?php echo !empty($req) ? $req['search_text'] : ''; ?>" id="search_text" placeholder="" class="ip-search">
						<button class="btn-reset" style="display: none;"><img src="/assets/front/images/btn_clear.svg" alt="검색어삭제"></button>
					</div>
				</div>
				<div class="inner">
					<ul class="rp-list-cate">
						<li>
							<input type="radio" id="rpNotice1" name="rp-notice" value="">
							<label for="rpNotice1">통합 검색</label>
						</li>
						<li>
							<input type="radio" id="rpNotice2" name="rp-notice" value="domestic" checked="">
							<label for="rpNotice2">국내 데이터</label>
						</li>
						<li>
							<input type="radio" id="rpNotice3" name="rp-notice" value="overseas">
							<label for="rpNotice3">해외 데이터</label>
						</li>
						<li>
							<input type="radio" id="rpNotice4" name="rp-notice" value="community">
							<label for="rpNotice4">커뮤니티</label>
						</li>
					</ul>
				</div>
				<div class="data-list domestic"><!-- 국내데이터 class="domestic" -->
					<div class="inner">
						<div class="list-area">
							<div class="list-top">
								<div class="sorting">
									<select name="" id="order_by">
										<option value="hit_cnt">인기순</option>
										<option value="created_at">등록순</option>
										<option value="company_name">가나다순</option>
									</select>
								</div>
								<div class="total">“<?php echo !empty($req) ? $req['search_text'] : ''; ?>” 검색 결과 <span id="total_rows"></span>개의 제품을 찾았습니다.</div>
							</div>
							<div class="list-wrap clear">
								<a href="javascript:;" class="mo-only btn-filter">상세 검색</a> 
								<div class="filter">
									<div class="filter-inner">
										<h4>
											원하는 제조사를<div>찾으세요.</div>
											<a href="javascript:;" class="filter-reset"><span class="blind">필터초기화</span></a>
										</h4>
										<form id="frmSearch" method="post" action="/domestic/list" >
											<input type="hidden"  name="offset" value="0" />
											<input type="hidden"  name="order_by" value="hit_cnt" />
											<input type="hidden"  name="keyword" value="<?php echo !empty($req) ? $req['search_text'] : ''; ?>" />
										<dl>
											<dt>카테고리</dt>
											<dd>
												<ul>
												<?php
													foreach($filter['category'] as $row) {
												?>
													<li>
														<input type="checkbox" id="category-<?php echo $row['sub_code']; ?>" name="category[]" value="<?php echo $row['sub_code']; ?>" <?php !empty($req) && !empty($req['category']) && in_array($row['sub_code'], $req['category']) ? 'checked' : '' ?> />
														<label for="category-<?php echo $row['sub_code']; ?>"><?php echo $row['code_name']; ?></label>
													</li>
												<?php
													}
												?>
												</ul>
												<a href="javascript:;" class="btn-more">더보기</a>
											</dd>
											<dt>OEM 제조사</dt>
											<dd>
												<ul>
												<?php
													foreach($filter['company'] as $row) {
												?>
													<li>
														<input type="checkbox" id="company-<?php echo $row['sub_code']; ?>" name="company[]" value="<?php echo $row['sub_code']; ?>" <?php !empty($req) && !empty($req['company']) && in_array($row['sub_code'], $req['company']) ? 'checked' : '' ?> />
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
													<li>
														<input type="radio" id="fiter4-5" name="rating" value="5" <?php !empty($req) && !empty($req['rating']) && $req['rating'] === '5' ? 'checked' : '' ?> />
														<label for="fiter4-5">CCC</label>
													</li>
													<li>
														<input type="radio" id="fiter4-6" name="rating" value="6" <?php !empty($req) && !empty($req['rating']) && $req['rating'] === '6' ? 'checked' : '' ?> />
														<label for="fiter4-6">CC</label>
													</li>
													<li>
														<input type="radio" id="fiter4-7" name="rating" value="7" <?php !empty($req) && !empty($req['rating']) && $req['rating'] === '7' ? 'checked' : '' ?> />
														<label for="fiter4-7">C이하</label>
													</li>
												</ul>
												<a href="javascript:;" class="btn-more">더보기</a>
											</dd>
											<dt>생산 규모</dt>
											<dd>
												<ul>
													<li>
														<input type="radio" id="fiter5-1" name="manufacture" value="1" <?php !empty($req) && !empty($req['manufacture']) && $req['manufacture'] === '1' ? 'checked' : '' ?> />
														<label for="fiter5-1">300톤 이상</label>
													</li>
													<li>
														<input type="radio" id="fiter5-2" name="manufacture" value="2" <?php !empty($req) && !empty($req['manufacture']) && $req['manufacture'] === '2' ? 'checked' : '' ?> />
														<label for="fiter5-2">100톤 이상</label>
													</li>
													<li>
														<input type="radio" id="fiter5-3" name="manufacture" value="3" <?php !empty($req) && !empty($req['manufacture']) && $req['manufacture'] === '3' ? 'checked' : '' ?> />
														<label for="fiter5-3">50톤 이상</label>
													</li>
													<li>
														<input type="radio" id="fiter5-4" name="manufacture" value="4" <?php !empty($req) && !empty($req['manufacture']) && $req['manufacture'] === '4' ? 'checked' : '' ?> />
														<label for="fiter5-4">30톤 이상</label>
													</li>
													<li>
														<input type="radio" id="fiter5-5" name="manufacture" value="5" <?php !empty($req) && !empty($req['manufacture']) && $req['manufacture'] === '5' ? 'checked' : '' ?> />
														<label for="fiter5-5">10톤 이상</label>
													</li>
													<li>
														<input type="radio" id="fiter5-6" name="manufacture" value="6" <?php !empty($req) && !empty($req['manufacture']) && $req['manufacture'] === '6' ? 'checked' : '' ?> />
														<label for="fiter5-6">5톤 이상</label>
													</li>
													<li>
														<input type="radio" id="fiter5-7" name="manufacture" value="7" <?php !empty($req) && !empty($req['manufacture']) && $req['manufacture'] === '7' ? 'checked' : '' ?> />
														<label for="fiter5-7">5톤 미만</label>
													</li>
												</ul>
												<a href="javascript:;" class="btn-more">더보기</a>
											</dd>
										</dl>
										</form>
										<a href="javascript:;" class="btn-type4 btn-submit">완료</a><!-- D: 필터선택시 즉시반영이라서 완료버튼에 닫기기능 연결했습니다. common.js 필터선택완료 -->
									</div>
								</div>
								<div class="list"  id="domestic_list">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>   

<form id="frmDetail" method="post" action="/domestic/manufacture/detail">
	<input type="hidden" name="biz_no" value="" />
</form>
<form id="frmGoSearch2" method="post" action="/search/domestic">
    <input type="hidden" name="search_text" value="<?php echo !empty($req['search_text']) ? $req['search_text'] : ''; ?>" />
</form>
<script>
$(document).ready(function() {
	$('input[name="category[]"]').on('click', function() {
		goPage(0);
	})

	$('input[name="company[]"]').on('click', function() {
		goPage(0);
	})

	$('input[name=manufacture]').on('click', function() {
		goPage(0);
	})

	$('input[name=sales]').on('click', function() {
		goPage(0);
	})

	$('input[name=credit_rating]').on('click', function() {
		goPage(0);
	})

    $('input[name=rp-notice]').on('click', function(e) {
        if($(this).val() !== 'domestic') {
            $('#frmGoSearch2').attr('action', '/search/' + $(this).val());
            $('#frmGoSearch2').submit();
			e.preventDefault();
        }
    });

	$('#search_text').on('keypress', function(e) {
		if(e.keyCode == 13) {
			if($.trim($(this).val()) == '') {
				showAlert('검색어를 입력해 주세요.');
				return;
			}
			$('#frmGoSearch2 input[name=search_text]').val($(this).val());
			$('#frmGoSearch2').submit();
		}
	})

	$(".filter-reset").each(function(e){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			$(".filter dt").removeClass("active");
			$(".filter dd").hide();
			$(".filter input[type=checkbox]").prop("checked", false);
			goPage(0);
		});
	});

	$('#order_by').on('change', function() {
		goPage(0);
	})
	<?php
		if($total_rows <= 0) {
	?>
		openpop('#layer-nodata');
		$('#layer-nodata').show();
	<?php
		}
	?>

	goPage(0);
});

function goPage(page) {
	$('#frmSearch input[name=offset]').val(page);
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