<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="data-detail board-detail report"><!-- 분석레포트 class="board-detail report" -->
				<div class="inner">
					<div class="detail-area">
						<div class="board-detail-top">
							<div class="bdt-inner">
								<div class="bdt-rp-cont">
									<div class="date"><?php echo $info['created_at']; ?></div>
									<div class="title"><?php echo $info['title']; ?></div>
									<div class="profile">
										<div class="img"></div>
										<div class="nick"><?php echo $info['created_by']; ?></div>
										<a href="#"  onclick="javascript:fnCopyUrl('/report/detail/<?php echo $info['report_seq']; ?>'); return false;" class="btn-share"><span>공유<span class="pc-only">하기</span></span></a>
									</div>
									<div class="thumb-img"><img src="/api/common/img_view?img_path=<?php echo $info['thumbnail']; ?>" alt="{제품명}이미지"></div>
									<div class="swiper hashtag">
										<ul class="swiper-wrapper">
										<?php
											$tags = explode(',', $info['tags']);
											foreach($tags as $row) {
												echo '<li class="swiper-slide">' . $row . '</li>';
											}
										?>
										</ul>
										<script>
											var hashswiper = new Swiper(".profie-info .hashtag", {
											  observer: true,
											  observeParents: true,
											  slidesPerView: "auto",
											  spaceBetween: 8,
											});
										</script>
									</div>
								</div>
							</div>
						</div>
						<div class="board-inner">
							<div class="borad-contents">
								<?php echo $info['contents']; ?>
							</div>
							<div class="dt-paging">
								<?php 
									if(!empty($info['prev_seq'])) {
										echo '<a href="/report/detail/' . $info['prev_seq'] . '" class="btn-prev">이전<span class="pc-only"> 글</span></a>';
									}
								?>
								<a href="/report/list" class="btn-list">목록으로</a>
								<?php 
									if(!empty($info['next_seq'])) {
										echo '<a href="/report/detail/' . $info['next_seq'] . '" class="btn-next">다음<span class="pc-only"> 글</span></a>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
