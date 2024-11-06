<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

	<div class="container">
		<div class="sub-container">
			<div class="data-list product-data"><!-- 제품데이터 class="product-data" -->
				<div class="sub-visual type3"><!-- D:20230611 class="type3" 추가 -->
					<img src="/assets/front/images/bg_sv2_m.png" alt="국내데이터 타이틀bg" class="mo-only" /><!-- D:20230611 mo vs이미지 변경 -->
					<h2>
						<span>제품 데이터</span>
						<div>
							매 주 업데이트되는 신제품 정보가 궁금하지 않으신가요?
							<div>기업별, 카테고리별 제품 정보를 확인할 수 있을 뿐 아니라 제품별 제조사도 검색할 수 있습니다.</div>
							기획하고 싶은 제품이 있다면 푸드플라넷에 요청해 보세요.
							<div>기획부터 제조, 유통, 수출까지 원스톱으로 지원합니다.</div>
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
								<select id="order_by">
									<option value="hit_cnt">인기순</option>
									<option value="created_at">등록순</option>
									<option value="company_name">가나다순</option>
								</select>
							</div>
							<a href="#" onclick="javascript:fnGoQna(); return false;" class="btn-inq">푸드플라넷에 <span>문의하기</span></a>
						</div>
						<div class="list-wrap clear">
							<a href="javascript:;" class="mo-only btn-filter">상세 검색</a> 
							<div class="filter">
								<div class="filter-inner">
									<h4>
										원하는 제품을<div>찾으세요.</div>
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
													<input type="checkbox" id="category-<?php echo $row['sub_code']; ?>" name="category[]" value="<?php echo $row['sub_code']; ?>" />
													<label for="category-<?php echo $row['sub_code']; ?>"><?php echo $row['code_name']; ?></label>
												</li>
											<?php
												}
											?>
											</ul>
											<a href="javascript:;" class="btn-more">더보기</a>
										</dd>
										<dt>주요 기업 OEM 제품 </dt>
										<dd>
											<ul>
											<?php
												foreach($filter['company'] as $row) {
											?>
												<li>
													<input type="checkbox" id="company-<?php echo $row['sub_code']; ?>" name="company[]" value="<?php echo $row['code_name']; ?>" />
													<label for="company-<?php echo $row['sub_code']; ?>"><?php echo $row['code_name']; ?></label>
												</li>
											<?php
												}
											?>
											</ul>
											<a href="javascript:;" class="btn-more">더보기</a>
										</dd>
										<dt>보관방법</dt>
										<dd>
											<ul>
												<li>
													<input type="checkbox" id="fiter3-1" name="storage[]" value="상온" />
													<label for="fiter3-1">상온</label>
												</li>
												<li>
													<input type="checkbox" id="fiter3-2" name="storage[]" value="냉장"/>
													<label for="fiter3-2">냉장</label>
												</li>
												<li>
													<input type="checkbox" id="fiter3-3" name="storage[]" value="냉동" />
													<label for="fiter3-3">냉동</label>
												</li>
											</ul>
										</dd>
										<dt>신제품</dt>
										<dd>
											<ul>
												<li>
													<input type="checkbox" id="fiter4-1" name="new" value="y" />
													<label for="fiter4-1">신제품(30일)</label>
												</li>
											</ul>
										</dd>
										</dd>
										<dt>국가별 수출제품</dt>
										<dd>
											<ul>
											<?php
												foreach($filter['nation'] as $row) {
											?>
												<li>
													<input type="checkbox" id="nation-<?php echo $row['seq']; ?>" name="nation[]" value="<?php echo $row['seq']; ?>" />
													<label for="nation-<?php echo $row['seq']; ?>"><?php echo $row['nation_name']; ?></label>
												</li>
											<?php
												}
											?>
											</ul>
											<a href="javascript:;" class="btn-more">더보기</a>
										</dd>
									</dl>
									</form>
									<a href="javascript:;" class="btn-type4 btn-submit">완료</a><!-- D: 필터선택시 즉시반영이라서 완료버튼에 닫기기능 연결했습니다. common.js 필터선택완료 -->
								</div>
							</div>
							<div class="product-list-wrap">
								<ul class="product-list clear" id="product_list">
									
								</ul>
								<div class="btn-more-box"><a href="#" onclick="javascript:fnGetList(''); return false;" class="btn-type5">More</a></div>
							</div>
						</div>
					</div>
					</div>
			</div>
		</div>
	</div>
<form id="frmDetail" method="post" action="/product/detail">
	<input type="hidden" name="prod_type" value="" />
	<input type="hidden" name="detail_seq" value="" />
</form>

<script>
$(document).ready(function() {
	$('input[name="category[]"]').on('click', function() {
		fnGetList(0);
	})

	$('input[name="company[]"]').on('click', function() {
		fnGetList(0);
	})

	$('input[name="storage[]"]').on('click', function() {
		fnGetList(0);
	})

	$('input[name=new]').on('click', function() {
		fnGetList(0);
	})

	$('input[name="nation[]"]').on('click', function() {
		fnGetList(0);
	})

	$('#keyword').on('keypress', function(e) {
		if(e.keyCode == 13) {
			$('#frmSearch input[name=keyword]').val($(this).val());
			fnGetList(0);
		}
	})

	$(".filter-reset").each(function(e){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			$(".filter dt").removeClass("active");
			$(".filter dd").hide();
			$(".filter input[type=checkbox]").prop("checked", false);
			fnGetList(0);
		});
	});

	fnGetList(0);
});

function fnGetList(offset) {
	if(typeof(offset) !== 'undefined' && offset !== '') $('#frmSearch input[name=offset]').val(offset);
	$.ajax({
			url: "/api/common/product_list2",
			type: "POST",
			data: $('#frmSearch').serialize(),
			dataType : 'json',
			async : false,
			success: function(data) {
				var str = '';
				for(var i = 0;  i < data.list.length; i++) {
					var tags = data.list[i].tags.split(',');

					str += '<li>'
						+	'	<a href="/product/detail/' + data.list[i].product_type2 + '/' + data.list[i].seq + '">'
						+	'		<span class="img">' + (data.list[i].prod_img == '' ? '<img src="/assets/front/images/icon_noprofile.svg" alt="제품 이미지" />' : '<img src="' + data.list[i].prod_img + '"  alt="' + data.list[i].product_name + ' 이미지" />') + '</span>'
						+	'		<span class="cate"><span>' + (tags.length > 0 && tags[0] !== '' ? '#' + tags.join('#') : '') + '</span></span>'
						+	'		<span class="title">' +  data.list[i].product_name + '</span>'
						+	'		<span class="factory">' + data.list[i].company_name + '</span>'
						+	'	</a>'
						+	'</li>';
				}

				if($('#frmSearch input[name=offset]').val() == '0') {
					$('#product_list').html(str);
					$(window).scrollTop(0);
				}
				else {
					$('#product_list').append(str);
				}
				if(data.list.length < 16) {
					$('.btn-more-box').hide();
				}
				else {
					$('.btn-more-box').show();
				}
				$('#total_rows').html(commify(data.total_rows));
				var page = parseInt($('#frmSearch input[name=offset]').val());
				page += 16;
				$('#frmSearch input[name=offset]').val(page);
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});

}

function goDetail(stype, seq) {
	$('#frmDetail input[name=prod_type]').val(stype);
	$('#frmDetail input[name=detail_seq]').val(seq);
	$('#frmDetail').submit();
}
</script>