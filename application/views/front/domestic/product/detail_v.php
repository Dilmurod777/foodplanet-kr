<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

	<div class="container">
		<div class="sub-container">
			<div class="data-detail domestic product"><!-- 국내데이터 class="domestic" 제품 class="product" -->
				<div class="sub-visual"></div>
				<div class="inner">
					<div class="detail-area product-detail-area">
						<div class="gallery-wrap clear">
							<div class="pro-detail-left">
								<div class="pro-gallery">
									<div class="swiper gallery">
										<div class="swiper-wrapper">
										<?php
											foreach($img as $row) {
												echo '<div class="swiper-slide"><img src="' . $row['img_url'] . '" /></div>';
											}
										?>
										</div>
										<div class="swiper-pagination"></div>
									</div>
									<div thumbsSlider="" class="swiper galler-thumb">
										<div class="swiper-wrapper">
										<?php
											foreach($img as $row) {
												echo '<div class="swiper-slide"><img src="' . $row['img_url'] . '" /></div>';
											}
										?>
										</div>
									</div>
									<script>
										var swiperG1 = new Swiper(".galler-thumb", {
										  observer: true,
										  observeParents: true,
										  slidesPerView: 5,
										  watchSlidesProgress: true,
										});
										var swiperG2 = new Swiper(".gallery", {
										  observer: true,
										  observeParents: true,
										  spaceBetween: 24,
										  pagination: {
											el: ".swiper.gallery .swiper-pagination",
											type: "fraction",
										  },
										  thumbs: {
											swiper: swiperG1,
										  },
										});
									</script>
								</div>
							</div>
							<div class="pro-detail-right sticky-box">
								<dl class="profie-info">
									<dt><?php echo $info['product_name']; ?><a href="javascript:;" class="btn-like <?php echo !empty($wish) && $wish['is_wish'] === 'y' ? 'on' : ''; ?>">관심상품</a></dt>
									<dd>
										<div><?php echo $info['summary']; ?></div>
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
										<div class="detail-pro-info">
											<dl>
												<dt>제조사</dt>
												<dd><a href="#" onclick="javascript:$('#frmCompany').submit(); return false;" class="btn-producer"><?php echo $info['company_name']; ?></a></dd>
											</dl>
											<dl>
												<dt>공급단가</dt>
												<dd class="blur">0000</dd>
											</dl>
											<dl>
												<dt>MOQ</dt>
												<dd class="blur">0000</dd>
											</dl>
											<dl>
												<dt>식품 유형</dt>
												<dd><?php echo $info['product_type']; ?></dd>
											</dl>
										</div>
										<!--div class="btn-area"><div><a href="6-request-write.html" class="btn-type1 btn-apply">생산 의뢰하기</a></div></div-->
									</dd>
								</dl>
							</div>
						</div>

						<div class="tab-area">
							<div class="swiper-container tabs scroller">
								<ul class="tabs-wrapper swiper-wrapper">
									<li class="swiper-slide on"><a href="#tab1">주요 정보</a></li>
									<!--<li class="swiper-slide"><a href="#tab2">부자재 정보</a></li>
									<li class="swiper-slide"><a href="#tab3">수출 정보</a></li>-->
									<li class="swiper-slide"><a href="#tab4">상세 이미지</a></li>
									<li class="swiper-slide"><a href="#tab5">상품 정보</a></li>
									<li class="swiper-slide"><a href="#tab6">유사 제품</a></li>
								</ul>
							</div>
							<div class="tab-container">
								<!-- 주요 정보 -->
								<div class="tab-cont on">
									<div class="cont-box" id="tab1">
										<h4>제품 주요 정보</h4>
										<div class="tb-type1 type4">
											<dl>
												<dt>제품명</dt>
												<dd><div class="ov-x"><?php echo $info['product_name']; ?></div></dd>
											</dl>
											<dl>
												<dt>식품유형</dt>
												<dd><div class="ov-x"><?php echo $info['product_type']; ?></div></dd>
											</dl>
											<dl>
												<dt>중량(단위)</dt>
												<dd><div class="ov-x"><?php echo round($info['weight']) . $info['unit']; ?></div></dd>
											</dl>
											<dl>
												<dt>보관방법</dt>
												<dd><div class="ov-x"><?php echo $info['storage']; ?></div></dd>
											</dl>
											<dl>
												<dt>소비기한</dt>
												<dd><div class="ov-x"><?php echo $info['expire_day']; ?></div></dd>
											</dl>
											<dl>
												<dt>MOQ</dt>
												<dd><div class="ov-x blur">0000</div></dd>
											</dl>
											<dl>
												<dt>납기일자</dt>
												<dd><div class="ov-x blur">0000</div></dd>
											</dl>
											<dl>
												<dt>공급단가</dt>
												<dd><div class="ov-x blur">0000</div></dd>
											</dl>
											<dl>
												<dt>입수</dt>
												<dd><div class="ov-x"><?php echo $info['qty'] . $info['qty_unit']; ?></div></dd>
											</dl>
											<dl>
												<dt>용기타입</dt>
												<dd><div class="ov-x"><?php echo $info['container_type']; ?></div></dd>
											</dl>
											<dl>
												<dt>채널별 납품현황</dt>
												<dd><div class="ov-x"><?php echo $info['channel_status']; ?></div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0" id="tab4">
										<h4>제품 상세 이미지</h4>
										<?php 
											if(empty($detail)) {
												echo '<div class="nodata"><div>등록된 이미지가 없습니다.</div></div>';
											}
											else {										
												echo '<ul class="pro-img-list" style="text-align:center">';
												foreach($detail as $row) {
													echo '<li><img src="' . $row['img_url'] . '" /></li>';
												}
												echo '</ul>';
											}
										?>
									</div>
									<div class="cont-box bot0" id="tab5">
										<h4>상품 정보 고시 (제품 라벨 정보)</h4>
										<?php
											if(empty($label)) {
												echo '<div class="nodata"><div>등록된 이미지가 없습니다.</div></div>';
											}
											else {
												echo '<ul class="pro-img-list" style="text-align:center">';
												foreach($label as $row) {
													echo '<li><img src="' . $row['img_url'] . '" /></li>';
												}
												echo '</ul>';
											}
										?>
									</div>
									<div class="cont-box" id="tab6">
										<h4>유사 제품</h4>
										<?php
											if(empty($list)) {
												echo '<div class="nodata"><div>등록된 정보가 없습니다.</div></div>';
											}
											else {
												echo '<div class="swiper pro-swiper reco-pro">';
												echo '	<ul class="swiper-wrapper">';

												foreach($list as $row) {
										?>
												<li class="swiper-slide">
													<div class="pro-img"><img src="<?php echo empty($row['prod_img']) ? '/assets/front/images/icon_noprofile.svg' : $row['prod_img']; ?>" /></div>
													<div class="pro-cont">
														<div class="cate"> <?php echo $row['category']; ?></div>
														<div class="name"><?php echo $row['product_name']; ?></div>
														<div class="wgt"><?php echo $row['weight'] . $row['unit']; ?></div>
													</div>
												</li>

											<?php
												}

												echo '	</ul>';
											?>
											<script>
												var recopro = new Swiper(".reco-pro", {
												  observer: true,
												  observeParents: true,
												  slidesPerView: 2.03,
												  spaceBetween: 12,
												  breakpoints: {
													720: {
													  slidesPerView: 2.3,
													  spaceBetween: 28
													},
												  }
												});
											</script>

										<?php
												echo '</div>';
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<form id="frmCompany" method="post" action="/domestic/manufacture/detail">
	<input type="hidden" name="biz_no" value="<?php echo $info['biz_no']; ?>" />
</form>

	<!-- 관심기업 토스트팝업 -->
	<div class="layer-toast favorite-in" id="favorite1">
		<dl>
			<dt>관심제품 등록</dt>
			<dd>
				<?php echo $info['product_name']; ?> 관심제품으로 등록하였습니다.<br />
				관심제품은 마이페이지에서 확인하실 수 있습니다.
			</dd>
		</dl>
	</div>
	<div class="layer-toast favorite-out" id="favorite2">
		<dl>
			<dt>관심제품 삭제</dt>
			<dd>
				<?php echo $info['product_name']; ?> 관심제품에서 삭제되었습니다.<br />
				관심제품은 마이페이지에서 확인하실 수 있습니다.
			</dd>
		</dl>
	</div>

<script>
$(document).ready(function() {
	$(".btn-like").on('click', function(e){
		e.preventDefault();
		<?php
			if(empty($member)) {
		?>
			showAlert('로그인 후 이용해 주세요.');
		<?php
			}
			else {
		?>
			var isWish = 'y';
			if($(this).hasClass("on")){
				isWish = 'n';
			}else{
				isWish = 'y';
			};
			var obj = $(this);

			$.ajax({
					url: "/api/common/set_wish",
					type: "POST",
					data: {target_cd : '<?php echo $info['seq']; ?>', is_wish : isWish, target_type : '<?php echo $req['prod_type'] === 'nb' ? '2' : '3'; ?>'},
					async : false,
					dataType : 'json',
					success: function(data) {
						if(data.result == 'fail') {
							showAlert(data.msg);
						}
						else {
							if(isWish === 'n'){
								$(obj).removeClass("on");
								$(".dim").fadeIn();
								$(".favorite-out").fadeIn();
								setTimeout(function() {
									$(".dim").fadeOut();
									$(".favorite-out").fadeOut();
								}, 3000);
							}else{
								$(obj).addClass("on");
								$(".dim").fadeIn();
								$(".favorite-in").fadeIn();
								setTimeout(function() {
									$(".dim").fadeOut();
									$(".favorite-in").fadeOut();
								}, 3000);
							};
						}
					},
					error: function(result) {
						alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
					}
			});

		<?php
			}
		?>
	}); 
})

</script>
