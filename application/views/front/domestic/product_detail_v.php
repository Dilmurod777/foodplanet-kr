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
								<?php
									if(empty($thumb)) {
										echo '<div class="nodata"><div>아직 등록된 사진이 없습니다.</div></div>';
									}
									else {
								?>
									<div class="swiper gallery">
										<div class="swiper-wrapper">
										<?php
										foreach($thumb as $row) {
											echo '<div class="swiper-slide"><img src="' . $row['new_imgpath'] . '" /></div>';
										}
										?>
										</div>
										<div class="swiper-pagination"></div>
									</div>
									<div thumbsSlider="" class="swiper galler-thumb">
										<div class="swiper-wrapper">
										<?php
										foreach($thumb as $row) {
											echo '<div class="swiper-slide"><img src="' . $row['new_imgpath'] . '" /></div>';
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
								<?php
									}
								?>
								</div>
							</div>
							<div class="pro-detail-right sticky-box">
								<dl class="profie-info">
									<dt><?php echo $info['product_name']; ?></dt>
									<dd>
										<div><?php echo !empty($info['product_summary']) ? $info['product_summary'] : '등록된 한줄 소개가 없습니다.'; ?></div>
										<div class="swiper hashtag">
										<?php
											if(empty($info['tags'])) {
												echo '<div class="nodata"><div>등록된 해시태그가 없습니다.</div></div>';
											}
											else {
										?>
												<ul class="swiper-wrapper">
										<?php
												$tags = explode(',',  $info['tags']);
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
										<?php
											}
										?>
											
										</div>
										<div class="detail-pro-info">
											<dl>
												<dt>제조사</dt>
												<dd><?php echo !empty($info['maker']) ? $info['maker'] : '미등록'; ?></dd>
											</dl>
											<dl>
												<dt>공급단가</dt>
												<dd><?php echo is_numeric($info['supply_price']) ? number_format($info['supply_price']) . '원' : '미등록'; ?>
											</dl>
											<dl>
												<dt>MOQ</dt>
												<dd><?php echo !empty($info['moq']) ? $info['moq'] : '미등록'; ?></dd>
											</dl>
											<dl>
												<dt>식품 유형</dt>
												<dd><?php echo !empty($info['food_type']) ? $info['food_type'] : '미등록'; ?></dd>
											</dl>
										</div>
										<?php
											if($info['member_cd'] !== $member['member_cd']) {
										?>
											<div class="btn-area"><div><a href="#" onclick="javascript:goRequest(); return false;" class="btn-type1 btn-apply">생산 의뢰하기</a></div></div>
										<?php
											}
										?>
									</dd>
								</dl>
							</div>
						</div>

						<div class="tab-area">
							<div class="swiper-container tabs scroller">
								<ul class="tabs-wrapper swiper-wrapper">
									<li class="swiper-slide on"><a href="#tab1">주요 정보</a></li>
									<li class="swiper-slide"><a href="#tab2">부자재 정보</a></li>
									<li class="swiper-slide"><a href="#tab3">수출 정보</a></li>
									<li class="swiper-slide"><a href="#tab4">상세 이미지</a></li>
									<li class="swiper-slide"><a href="#tab5">상품 정보</a></li>
									<li class="swiper-slide"><a href="#tab6">유사 제품</a></li>
								</ul>
							</div>
							<div class="tab-container">
								<!-- 주요 정보 -->
								<div class="tab-cont on">
									<div class="cont-box" id="tab1">
										<h4>자사 제품 현황 및 정보</h4>
										<div class="tb-type1 type4">
											<dl>
												<dt>브랜드</dt>
												<dd><div class="ov-x"><?php echo !empty($info['brand_name']) ? $info['brand_name'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>유통기한</dt>
												<dd><div class="ov-x"><?php echo !empty($info['expire_day']) ? $info['expire_day'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>채널별 납품 현황</dt>
												<dd><div class="ov-x"><?php echo !empty($info['channel']) ? $info['channel'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>납기일자</dt>
												<dd><div class="ov-x"><?php echo !empty($info['delivery_day']) ? $info['delivery_day'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>타 기업 거래 현황</dt>
												<dd><div class="ov-x">기업 명 출력</div></dd>
											</dl>

											<!-- 자사제품 only -->
											<?php 
												if($req['prod_type'] === 'own') {
													echo '<dl>';
													echo '<dt>용기 타입 및 입수</dt>';
													echo '<dd><div class="ov-x">' . (!empty($info['type_cnt']) ? $info['type_cnt'] : '미등록') . '</div></dd>';
													echo '</dl>';
												}
											?>
											
											<!-- //자사제품 only -->

											<!-- OEM제품 only -->
											<?php 
												if($req['prod_type'] === 'own') {
													echo '<dl>';
													echo '<dt>타입별 <span class="mo-br">상품 정보</span></dt>';
													echo '<dd>';
													echo '<ul class="type-li">';
													echo '<li><div class="ov-x"><strong>A 타입<span class="pc-only">별 세부 정보</span> : </strong>' . (!empty($info['type_a']) ? $info['type_a'] : '미등록') . '</div></li>';
													echo '<li><div class="ov-x"><strong>B 타입<span class="pc-only">별 세부 정보</span> : </strong>' . (!empty($info['type_b']) ? $info['type_b'] : '미등록') . '</div></li>';
													echo '<li><div class="ov-x"><strong>C 타입<span class="pc-only">별 세부 정보</span> : </strong>' . (!empty($info['type_c']) ? $info['type_c'] : '미등록') . '</div></li>';
													echo '</ul>';
													echo '</dd>';
													echo '</dl>';
												}
											?>
											<!-- //OEM제품 only -->
										</div>
									</div>
									<div class="cont-box bot0" id="tab2">
										<h4>제품 부자재 정보</h4>
										<div class="tb-type1 type4">
											<dl>
												<dt><span class="font-s">부자재 발주 <span>리드타임</span></span></dt>
												<dd><div class="ov-x"><?php echo !empty($info['material_leadtime']) ? $info['material_leadtime'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>부자재 MOQ</dt>
												<dd><div class="ov-x"><?php echo !empty($info['material_moq']) ? $info['material_moq'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>부자재별 단가</dt>
												<dd><div class="ov-x"><?php echo is_numeric($info['material_price']) ? number_format($info['material_price']) . '원' : '미등록'; ?></div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0" id="tab3">
										<h4>제품 수출 정보</h4>
										<div class="tb-type1 type4">
											<dl>
												<dt>수출 국가</dt>
												<dd><div class="ov-x"><?php echo !empty($info['export_nation']) ? $info['export_nation'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt><span class="font-s">수출 추가 <span>진행 중인 국가</span></span></dt>
												<dd><div class="ov-x"><?php echo !empty($info['export_proress']) ? $info['export_progress'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt><span class="font-s">ISO22000 <span>인증 여부</span></span></dt>
												<dd><div class="ov-x"><?php echo !empty($info['is_iso22000']) ? $info['is_iso22000'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt><span class="font-s">FDA 공장 <span>등록 여부</span></span></dt>
												<dd><div class="ov-x"><?php echo !empty($info['is_fda']) ? $info['is_fda'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>할랄 인증 여부</dt>
												<dd><div class="ov-x"><span class=""><?php echo !empty($info['is_halal']) ? $info['is_halal'] : '미등록'; ?></span></div></dd><!-- 인증완료시 class="cer-comp" -->
											</dl>
										</div>
									</div>
									<div class="cont-box bot0" id="tab4">
										<h4>제품 상세 이미지</h4>
										<?php
											if(empty($detail)) {
												echo '<div class="nodata" style="display:block"><div>등록된 이미지가 없습니다.</div></div>';
											}
											else {
												echo '<ul class="pro-img-list">';
												foreach($detail as $row) {
													echo '<li><img src="/api/common/img_view?img_path=' . $row['new_filepath'] . '" /></li>';
												}
												echo '</ul>';
											}
										?>
									</div>
									<div class="cont-box bot0" id="tab5">
										<h4>상품 정보 고시 (제품 라벨 정보)</h4>
										<?php
											if(empty($label)) {
												echo '<div class="nodata" style="display:block"><div>등록된 이미지가 없습니다.</div></div>';
											}
											else {
												echo '<ul class="pro-img-list">';
												foreach($label as $row) {
													echo '<li><img src="/api/common/img_view?img_path=' . $row['new_filepath'] . '" /></li>';
												}
												echo '</ul>';
											}
										?>
									</div>
									<div class="cont-box" id="tab6">
										<h4>유사 제품</h4>
										<?php
											if(empty($list)) {
												echo '<div class="nodata" style="display:block"><div>등록된 정보가 없습니다.</div></div>';
											}
											else {
										?>
											<div class="swiper pro-swiper reco-pro">
												<ul class="swiper-wrapper">
												<?php
													foreach($list as $row) {
												?>
													<li class="swiper-slide">
														<div class="pro-img"><?php echo empty($row['thumbnail_img']) ? '<img src="/assets/front/images/icon_noprofile.svg" alt="제품 이미지" />' : '<img src="/api/common/img_view?img_path='  . $row['thumbnail_img'] . '"  alt="' . $row['product_name'] . ' 이미지" />' ?></div>
														<div class="pro-cont">
															<div class="cate"><?php echo $row['food_type']; ?></div>
															<div class="name"><?php echo $row['product_name']; ?></div>
															<div class="wgt"><?php echo $row['product_summary']; ?></div>
														</div>
													</li>
												<?php
													}
												?>
												</ul>
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
											</div>
										<?php
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
<form id="frmRequest" method="post"  action="/request/write">
	<input type="hidden" name="member_cd" value="<?php echo $info['member_cd']; ?>" />
	<input type="hidden" name="detail_seq" value="<?php echo $info['detail_seq']; ?>" />
	<input type="hidden" name="product_type" value="<?php echo $req['prod_type'];  ?>" />
</form>

<script>
$(document).ready(function() {
	var bHeight = $(".tab-area").height() + 4;
	var $lankTitle = $(".tabs .swiper-slide a");
	$lankTitle.click(function(e){
		var target = $(this).parent();
		var idx = target.index();
		$lankTitle.parent().removeClass("on")
		target.addClass("on");
		muCenter(target);
		if($(this).closest(".tabs").hasClass("scroller")){
			var ww = $(window).width();
			var pdt = parseInt($(".tab-container").css('padding-top'));
			if(ww <= 720){
				var hh = $(".header").height() + $(".tabs").height();
			}else{
				var hh = $(".header").height() + $(".tabs").height() - pdt;
			};
			$("html, body").animate({
				scrollTop: $(".tab-area .tab-cont .cont-box").eq(idx).offset().top - hh
			}, 500);
		}else{
			$(".tab-area .tab-cont").removeClass("on");
			$(".tab-area .tab-cont").eq(idx).addClass("on");
		};
		return false;
	});

})

function muCenter(target){
			var snbwrap = $(".tabs-wrapper");
			var targetPos = target.position();
			var boxWidth = $(".tabs").width();
			var bHeight = $(".tab-area").height() + 4;
			var wrapWidths=0;
			var wrapWidth=0;
			snbwrap.find(".swiper-slide").each(function(){
				wrapWidths += $(this).outerWidth();
			});
			var wrapWidth = wrapWidths ;
			var selectTargetPos = targetPos.left + target.outerWidth()/2;
			var pos;
			if(selectTargetPos <= boxWidth/2){
				pos = 0
				//$(".gradi-left").addClass("gradi-hide");
			}else if(wrapWidth - selectTargetPos <= boxWidth/2){
				pos = wrapWidth-boxWidth;
				//$(".gradi-left").removeClass("gradi-hide");
				//$(".gradi-right").addClass("gradi-hide");
			}else{
				pos = targetPos.left - (boxWidth/2) + (target.outerWidth()/2);
				//$(".gradi-left").removeClass("gradi-hide");
				//$(".gradi-right").removeClass("gradi-hide");
			}
			if(wrapWidth > boxWidth) {
				setTimeout(function(){snbwrap.css({
					"transform": "translate3d("+ (pos*-1) +"px, 0, 0)",
					"transition-duration": "300ms"
				})}, 200);
			}
};

function goRequest() {
	$('#frmRequest').submit();
}

</script>