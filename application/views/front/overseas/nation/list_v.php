<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="data-list overseas"><!-- 해외데이터 class="overseas" -->
				<div class="sub-visual type2"><!-- D:20230611 class="type2" 추가 -->
					<img src="/assets/front/images/bg_sv2_m.png" alt="해외데이터 타이틀bg" class="mo-only" />
					<h2>
						<span>해외데이터</span>
						<div>
							국가별 주요 수출 품목, 해외 유통 <span>채널별 수출 제품 데이터,</span>
							<div>주요수출 국가별/품목별 수출 규제, <span>국가별 바이어 정보 등 검색할 수 있습니다.</span></div>
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
									<option value="hit_cnt" <?php echo $req['order_by'] === 'hit_cnt' ? 'selected' : ''; ?> >인기순</option>
									<option value="created_at" <?php echo $req['order_by'] === 'created_at' ? 'selected' : ''; ?> >등록일순</option>
									<option value="nation_name" <?php echo $req['order_by'] === 'nation_name' ? 'selected' : ''; ?> >가나다순</option>
								</select>
							</div>
							<a href="javascript:;" class="btn-inq">푸드플라넷에 <span>문의하기</span></a>
							<div class="total">총 <span>15</span>개</div>
						</div>
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
<form id="frmSearch" method="post" action="/overseas/list">
	<input type="hidden" name="offset" />
	<input type="hidden" name="keyword" />
	<input type="hidden" name="order_by" />
</form>
<script>
$(document).ready(function() {
	$('#keyword').on('keypress', function(e) {
		if(e.keyCode == 13) {
			$('#frmSearch input[name=keyword]').val($(this).val());
			goPage(0);
		}
	})

	$('#order_by').on('change', function(e) {
		$('#frmSearch input[name=order_by]').val($(this).val());
		goPage(0);
	})
});

function goPage(page) {
	$('#frmSearch input[name=offset]').val(page);
	$('#frmSearch').submit();
}

function goDetail(cd, no) {
	$('#frmDetail input[name=nation_seq]').val(no);
	$('#frmDetail').submit();
}
</script>