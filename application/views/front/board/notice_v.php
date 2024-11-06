<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="data-list board-list notice"><!-- 공지사항 class="board-list notice" -->
				<div class="sub-visual">
					<img src="/assets/front/images/bg_sv2_m.png" alt="분석레포트 타이틀bg" class="mo-only" />
					<h2>공지사항</h2>
				</div>
				<div class="inner">
					<div class="list-area">
						<ul class="rp-list-cate">
							<li>
								<input type="radio" id="rpNotice1" name="rp-notice" value="notice" checked />
								<label for="rpNotice1">전체</label>
							</li>
							<li>
								<input type="radio" id="rpNotice2" name="rp-notice" value="news" />
								<label for="rpNotice2">뉴스</label>
							</li>
							<li>
								<input type="radio" id="rpNotice3" name="rp-notice" value="event" />
								<label for="rpNotice3">이벤트</label>
							</li>
						</ul>
						<div class="list-top">
							<div class="searchbox">
								<input type="text" id="keyword" value="<?php echo !empty($req['keyword']) ? $req['keyword'] : ''; ?>" placeholder="검색어를 입력해주세요." class="ip-search" />
								<button type="button" class="btn-reset" onclick="javascript:fnInit();"><img src="/assets/front/images/btn_clear.svg"  alt="검색어삭제" /></button>
							</div>
							<div class="total">총 <span><?php echo number_format($total_rows); ?></span>개</div>
						</div>
						<div class="list-wrap">
							<dl>
								<dt>뉴스</dt>
								<dd>
									<ul class="news-list">
									<?php 
										if(count($news) > 0) {
											foreach($news as $row) {
									?>
										<li>
											<a href="/board/detail/<?php echo $row['notice_seq']; ?>">
												<span class="img"><img src="/api/common/img_view?img_path=<?php echo $row['thumbnail']; ?>" alt="{뉴스} 썸네일이미지"></span>
												<span class="news-cont">
													<span class="title"><?php echo $row['title']; ?></span>
													<span class="cont"><?php echo strip_tags($row['contents']); ?></span>
													<span class="date"><?php echo $row['created_at']; ?></span>
												</span>
											</a>
										</li>

									<?php
											}
										}
										else {
											echo '<li style="width:100%;  text-align:center; padding:50px 0;">조회된 내용이 없습니다.</li>';
										}
									?>
									</ul>
									<div class="btn-area-center">
										<a href="/board/news" class="btn-type5 btn-more">뉴스 더보기</a>
									</div>
								</dd>
							</dl>
							<dl>
								<dt>이벤트</dt>
								<dd>
									<div class="swiper event-swiper">
										<ul class="swiper-wrapper event-list">
										<?php
											if(count($event) > 0) {
												foreach($event as $row) {
										?>
											<li class="swiper-slide">
												<a href="/board/detail/<?php echo $row['notice_seq']; ?>">
													<span class="img"><img src="/api/common/img_view?img_path=<?php echo $row['thumbnail']; ?>" alt="썸네일이미지"></span>
													<span class="news-cont">
														<span class="title"><?php echo $row['title']; ?></span>
														<span class="date"><?php echo $row['created_at']; ?></span>
													</span>
												</a>
											</li>
										<?php
												}
											}
											else {
												echo '<li style="width:100%;  text-align:center; padding:50px 0;">조회된 내용이 없습니다.</li>';
											}
										?>
										</ul>
										<script>
											var evtswiper1 = new Swiper(".event-swiper", {
											  observer: true,
											  observeParents: true,
											  slidesPerView: 2.1,
											  spaceBetween: 12,
											  breakpoints: {
												720: {
												  slidesPerView: 3,
												  spaceBetween: 24
												},
											  }
											});
										</script>
									</div>
									<div class="btn-area-center">
										<a href="/board/event" class="btn-type5 btn-more">이벤트 더보기</a>
									</div>
								</dd>
							</dl>
						</div>
					</div>
					</div>
			</div>
		</div>
	</div>
<form id="frmSearch" method="get">
</form>
<script>
$(document).ready(function() {
	$('input[name=rp-notice]').on('click', function() {
		location.href = '/board/' + $(this).val();
	});

	$('#keyword').on('keypress', function(event) {
		if(event.keyCode == 13) {
			var community_type = $('input[name=com-cate]:checked').val();
			$('#frmSearch').attr('action', '/board/notice?keyword=' + $(this).val());
			$('#frmSearch').append('<input type="hidden" name="keyword" value="' + $(this).val() + '" />');
			$('#frmSearch').submit();
		}
	})
})

function fnInit() {
	<?php 
		if(!empty($req['keyword'])) {
	?>
	var community_type = $('input[name=com-cate]:checked').val();
	$('#frmSearch').attr('action', '/board/notice');
	$('#frmSearch').submit();
	<?php
		}
	?>
}

</script>