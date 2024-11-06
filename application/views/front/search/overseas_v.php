<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

	<div class="container">
		<div class="sub-container">
			<div class="search-result data-list overseas"><!-- 검색결과 class="search-result" -->
				<div class="search-result-top">
					<div class="searchbox">
						<input type="text" id="search_text" value="<?php echo !empty($req) ? $req['search_text'] : ''; ?>" placeholder="" class="ip-search">
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
							<input type="radio" id="rpNotice2" name="rp-notice" value="domestic">
							<label for="rpNotice2">국내 데이터</label>
						</li>
						<li>
							<input type="radio" id="rpNotice3" name="rp-notice" checked value="overseas">
							<label for="rpNotice3">해외 데이터</label>
						</li>
						<li>
							<input type="radio" id="rpNotice4" name="rp-notice" value="community">
							<label for="rpNotice4">커뮤니티</label>
						</li>
					</ul>
				</div>
				<div class="inner">
					<div class="list-area">
						<div class="list-top">
							<div class="sorting">
								<select name="" id="order_by">
									<option value="hit_cnt">인기순</option>
									<option value="created_at">등록일</option>
									<option value="nation_name">가나다순</option>
								</select>
							</div>
							<div class="total">“<?php echo !empty($req) ? $req['search_text'] : ''; ?>” 검색 결과 <span><?php echo $total_rows;?></span>개의 제품을 찾았습니다.</div>
						</div>
						<!--
						<div class="list-wrap clear">
							<a href="javascript:;" class="mo-only btn-filter">상세 검색</a> 
							<div class="filter">
								<div class="filter-inner">
									<h4>
										원하는 품목을<div>찾으세요.</div>
										<a href="javascript:alert('필터리셋!');" class="filter-reset"><span class="blind">필터초기화</span></a>
									</h4>
									<form id="frmSearch" method="post" action="/domestic/list" >
										<input type="hidden"  name="offset" value="0" />
										<input type="hidden"  name="order_by"  value="hit" />
										<input type="hidden"  name="keyword" value="<?php echo !empty($req) ? $req['search_text'] : ''; ?>" />
									<dl>
										<dt>카테고리 (대표품목)</dt>
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
										<dt>상세 HS Code</dt>
										<dd>
											<ul>
											<?php
												foreach($filter['hscode'] as $row) {
											?>
												<li>
													<input type="checkbox" id="company-<?php echo $row['sub_code']; ?>" name="hscode[]" value="<?php echo $row['sub_code']; ?>" <?php !empty($req) && !empty($req['company']) && in_array($row['sub_code'], $req['company']) ? 'checked' : '' ?> />
													<label for="company-<?php echo $row['sub_code']; ?>"><?php echo $row['code_name']; ?></label>
												</li>
											<?php
												}
											?>
											</ul>
											<a href="javascript:;" class="btn-more">더보기</a>
										</dd>
									</dl>
									</form>
									<a href="javascript:;" class="btn-type4 btn-submit">완료</a>
								</div>
							</div>
							<div class="list" id="oversea_list">
								
							</div>
						</div> -->
						<div class="list-wrap clear">
							<div class="list">
								<ul class="list-cont">
									<!-- sample 반복 -->
									<?php 
										foreach($list as $row) {
									?>
										<li>
											<a href="/overseas/nation/detail/<?php echo $row['seq']; ?>">
												<span class="flags"><img src="<?php echo $row['logo_img']; ?>" alt="국기이미지" /></span>
												<span class="flags-cont">
													<span class="title1"><?php echo $row['continent']; ?></span>
													<span class="title2"><?php echo $row['nation_name']; ?></span>
													<span class="items"><?php echo !empty($row['product_name']) ? str_replace(',', ', ', $row['product_name']) : '&nbsp;'; ?></span>
												</span>
											</a>
										</li>
									<?php
										}
									?>
									<!-- //sample 반복 -->
								</ul>
								<div class="paging"><?php echo $pagination; ?></div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

<form id="frmDetail" method="post" action="/domestic/detail">
	<input type="hidden" name="member_cd" value="" />
	<input type="hidden" name="biz_no" value="" />
</form>
<form id="frmGoSearch2" method="post" action="/search/domestic">
    <input type="hidden" name="search_text" value="<?php echo !empty($req['search_text']) ? $req['search_text'] : ''; ?>" />
</form>
<form id="frmSearch" method="post" action="/search/overseas" >
	<input type="hidden"  name="offset" value="0" />
	<input type="hidden"  name="order_by"  value="hit_cnt" />
	<input type="hidden"  name="keyword" value="<?php echo !empty($req) ? $req['search_text'] : ''; ?>" />
	<input type="hidden"  name="search_text" value="<?php echo !empty($req) ? $req['search_text'] : ''; ?>" />
</form>
<script>
$(document).ready(function() {
	$('input[name="category[]"]').on('click', function() {
		goPage(0);
	})

	$('input[name="hscode[]"]').on('click', function() {
		goPage(0);
	})

    $('input[name=rp-notice]').on('click', function(e) {
        if($(this).val() !== 'overseas') {
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
			$('#frmSearch input[name=keyword]').val($(this).val());
			$('#frmSearch input[name=search_text]').val($(this).val());
			goPage(0);
		}
	})

	$('#order_by').on('change', function() {
		goPage(0);
	});

	<?php
		if($total_rows <= 0) {
	?>

		openpop('#layer-nodata');
		$('#layer-nodata').show();
	<?php
		}
	?>

//	goPage(0);
});

function goPage(page) {
	$('#frmSearch input[name=offset]').val(page);
	$('#frmSearch input[name=order_by]').val($('#order_by').val());
	$('#frmSearch').submit();
}

function goDetail(no) {
	$('#frmDetail input[name=nation_seq]').val(no);
	$('#frmDetail').submit();
}

</script>