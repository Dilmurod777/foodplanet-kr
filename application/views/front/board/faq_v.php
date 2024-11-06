<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="board-list qna"><!-- 문의하기 class="board-list qna" -->
				<div class="sub-visual">
					<img src="/assets/front/images/bg_sv2_m.png" alt="문의하기 bg" class="mo-only" />
					<h2>문의하기</h2>
				</div>
				<div class="inner">
					<div class="detail-area qna-area">
						<div class="tab-area">
							<div class="swiper-container tabs">
								<ul class="tabs-wrapper swiper-wrapper">
								<?php
									$name = '';
									foreach($category as $row) {
										if($row['sub_code'] === $selected) $name = $row['code_name'];
										echo '<li class="swiper-slide ' . ($row['sub_code'] === $selected ? 'on' : '') . '"><a href="/board/faq/' . $row['sub_code'] . '">' . $row['code_name'] . '</a></li>';

									}
								?>
								</ul>
							</div>
							<div class="tab-container">
								<!-- 자주묻는질문 -->
								<div class="tab-cont on">
									<div class="cont-box">
										<h4><?php echo $name; ?></h4>
								<?php
									foreach($list as $row) {
								?>
										<dl class="qna-list">
											<dt class="btn-toggle"><?php echo $row['title']; ?></dt>
											<dd>
												<?php echo $row['contents']; ?>
											</dd>
										</dl>
								<?php
									}
								?>
									</div>
								</div>

								<div class="btn-area-center">
									<a href="#" onclick="javascript:fnGoQna(); return false;" class="btn-confirm">1:1 문의</a><!-- 퍼블확인차 로그인유도 팝업을 연렬 / 개발하실때 삭제 필요 -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

