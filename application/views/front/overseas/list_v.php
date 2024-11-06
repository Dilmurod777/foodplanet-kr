<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

	<div class="container">
		<div class="sub-container">
			<div class="data-list overseas"><!-- 해외데이터 class="overseas" -->
				<div class="sub-visual">
					<img src="/assets/front/images/bg_sv2_m.png" alt="해외데이터 타이틀bg" class="mo-only" />
					<h2>해외데이터</h2>
				</div>
				<div class="inner">
					<div class="list-area">
						<div class="list-top">
							<div class="searchbox">
								<input type="text" id="keyword" value="" placeholder="검색어를 입력해주세요." class="ip-search" />
								<button class="btn-reset"><img src="/assets/front/images/btn_clear.svg"  alt="검색어삭제" /></button>
							</div>
							<div class="sorting">
								<select name="" id="order_by">
									<option value="">인기순</option>
									<option value="">가나다순</option>
									<option value="">제조사 가나다순</option>
								</select>
							</div>
							<div class="total">총 <span id="total_rows">0</span>개</div>
						</div>
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
										<input type="hidden"  name="keyword" value="" />
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
									<a href="javascript:;" class="btn-type4 btn-submit">완료</a><!-- D: 필터선택시 즉시반영이라서 완료버튼에 닫기기능 연결했습니다. common.js 필터선택완료 -->
								</div>
							</div>
							<div class="list" id="oversea_list">
								
							</div>
						</div>
					</div>
					</div>
			</div>
		</div>
	</div>
<script>
$(document).ready(function() {
	$('input[name="category[]"]').on('click', function() {
		goPage(0);
	})

	$('input[name="hscode[]"]').on('click', function() {
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
			goPage(0);
		});
	});

	goPage(0);
});

function goPage(page) {
	$('#frmSearch input[name=offset]').val(page);
	$.ajax({
			url: "/overseas/list_detail",
			type: "POST",
			data: $('#frmSearch').serialize(),
			async : false,
			success: function(data) {
				$('#oversea_list').html(data);
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

function goDetail(cd, no) {
	$('#frmDetail input[name=nation_seq]').val(no);
	$('#frmDetail').submit();
}
</script>