<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">

			<div class="search-result"><!-- 검색결과 class="search-result" -->
				<div class="search-result-top">
					<div class="searchbox">
						<input type="text" id="search_text" value="<?php echo !empty($req['search_text']) ? $req['search_text'] : ''; ?>" placeholder="" class="ip-search">
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
							<input type="radio" id="rpNotice3" name="rp-notice" value="overseas">
							<label for="rpNotice3">해외 데이터</label>
						</li>
						<li>
							<input type="radio" id="rpNotice4" name="rp-notice" checked value="community">
							<label for="rpNotice4">커뮤니티</label>
						</li>
					</ul>
				</div>
			</div>
			<div class="data-list board-list community"><!-- 커뮤니티 class="board-list community" -->
				<div class="inner">
					<div class="list-area">
						<div class="list-top">
							<div class="sorting">
									<select name="">
										<option value="">인기순</option>
										<option value="">가나다순</option>
										<option value="">제조사 가나다순</option>
									</select>
								</div>
							<div class="total">“<?php echo !empty($req['search_text']) ? $req['search_text'] : ''; ?>” 검색 결과 <span><?php echo $total_rows; ?></span>개의 글을 찾았습니다.</div>
						</div>
						<div class="list-wrap">
							<div class="community-list"><!-- 커뮤니티 class="community-list" -->
								<div class="tb-type-board">
									<ul class="detail-title clear">
										<li>번호</li>
										<li>분류</li>
										<li>제목</li>
										<li>작성자</li>
										<li>조회수</li>
									</ul>
									<div class="detail-cont">
									<?php
										if(count($list) > 0) {
											foreach($list as $row) {
									?>
											<a href="/community/detail/<?php echo $row['community_seq']; ?>">
												<ul>
													<li><?php echo $num--; ?></li>
													<li><?php echo $row['community_type_name']; ?></li>
													<li><div class="com-title"><?php echo $row['title']; ?></div><div class="rp-count">[<?php echo $row['reply_cnt']; ?>]</div></li>
													<li><?php echo $row['nickname']; ?></li>
													<li><?php echo number_format($row['hit_cnt']); ?></li>
												</ul>
											</a>
									<?php
											}
										}
										else {
											echo '<ul><li style="width:100%; text-align:center; padding:50px 0;">검색 결과가 없습니다.</li>';
										}
									?>
									</div>
								</div>
							</div>
							<div class="paging">
								<?php echo $pagination; ?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<form id="frmSearch" method="post" action="/search/community" >
	<input type="hidden" name="search_text" value="<?php echo !empty($req) ? $req['search_text'] : ''; ?>" />
	<input type="hidden" name="offset" value="<?php echo !empty($req) ? $req['offset'] : ''; ?>" />
	<input type="hidden" name="order_by" value="<?php echo !empty($req) ? $req['order_by'] : ''; ?>"  />
</form>
<form id="frmGoSearch2" method="post" action="/search/domestic">
    <input type="hidden" name="search_text" value="<?php echo !empty($req['search_text']) ? $req['search_text'] : ''; ?>" />
</form>
<script>
$(document).ready(function() {
	$('input[name=com-cate]').on('click', function() {
		$('#frmSearch').attr('action', '/community/list/' + $(this).val());
		$('#frmSearch').submit();
	})

    $('input[name=rp-notice]').on('click', function(e) {
        if($(this).val() !== 'community') {
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
			$('#frmSearch input[name=search_text]').val($(this).val());
			goPage(0);
		}
	})

	<?php
		if($total_rows <= 0) {
	?>
		openpop('.layer-nodata');
		$('#layer-nodata').show();
	<?php
		}
	?>

})

function goPage(page) {
	$('#frmSearch input[name=offset]').val(page);
	$('#frmSearch').submit();
}

</script>