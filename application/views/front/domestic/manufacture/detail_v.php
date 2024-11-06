<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	
	<div class="container">
		<div class="sub-container">
			<div class="data-detail domestic"><!-- 국내데이터 class="domestic" -->
				<div class="sub-visual" style="background:url(/assets/front/images/bg_sv_detail1.jpg) center center no-repeat;background-size:cover;">
					<img src="/assets/front/images/bg_sv_detail1_m.jpg" alt="국내데이터 제조사 상세 bg" class="mo-only" />
				</div>
				<div class="inner">
					<div class="detail-area">
						<div class="detail-info">
							<div class="company-profile clear">
								<div class="profile-img"><?php echo !empty($info['logo_img']) ? '<img src="' . $info['logo_img'] . '" alt="로고이미지" />' : ''; ?></div>
								<dl class="profie-info">
								<dt><?php echo $info['company_name']; ?> <span><?php echo $info['company_name_eng']; ?></span><a href="javascript:;" class="btn-like <?php echo !empty($wish) && $wish['is_wish'] === 'y' ? 'on' : ''; ?>">관심기업</a></dt><!-- 관심기업 등록  class="on" common.js-->
									<dd>
										<div><?php echo nl2br($info['summary']); ?></div>
										<div class="hashtag">
											<ul>
											<?php
												$tags = explode(',', $info['tags']);
												foreach($tags as $row) {
													if(empty($row)) continue;
													echo '<li>' . $row . '</li>';
												}
											?>
											</ul>
										</div>
										<!-- <a href="6-request-write.html" class="btn-type5 btn-est">위탁생산 견적서 요청</a>20230324 링크 추가  -->
									</dd>
								</dl>
							</div>
							<a href="javascript:;" class="mo-only btn-toggle btn-detail">제조사 상세 정보</a>
							<div class="pc-only detail-company clear">
								<h3>기업 정보</h3>
								<div>
									<dl>
										<dt>대표자명</dt>
										<dd><?php echo $info['ceo_name']; ?></dd>
									</dl>
									<dl>
										<dt>표준산업분류</dt>
										<dd><?php echo $info['industrial_code']; ?></dd>
									</dl>
									<dl>
										<dt>설립일자</dt>
										<dd><?php echo $info['incorporation_at']; ?></dd>
									</dl>
								</div>
								<div>
									<dl>
										<dt>주소</dt>
										<dd><?php echo $info['addr']; ?></dd>
									</dl>
									<dl>
										<dt>홈페이지 주소</dt>
										<dd>
											<?php 
												if(empty($info['homepage'])) {
													'미등록';
												}
												else if(substr($info['homepage'], 0, 7) === 'http://' || substr($info['homepage'], 0, 8) === 'https://') {
													echo '<a href="' . $info['homepage'] . '" target="_blank">' . $info['homepage'] . '</a>';
												}
												else {
													echo '<a href="http://' . $info['homepage'] . '" target="_blank">' . $info['homepage'] . '</a>';
												}
											?>
										</dd>
									</dl>
									<dl>
										<dt>대표 번호</dt>
										<dd><?php echo $info['company_tel']; ?></dd>
									</dl>
									<dl>
										<dt>회사 소개서</dt>
										<dd class="btn-wrap">
											<?php
												if(empty($info['introduce_file'])) {
													echo '미등록';
												}
												else {
													echo '<a href="' . $info['introduce_file'] . '">" target="_blank" class="btn-download"><span class="pc-only">파일 </span>다운로드</a>';
												}
											?>
										</dd>
									</dl>
								</div>
							</div>
							<div class="btn-area-center">
								<a href="javascript:;" class="btn-inq2">제조사 <span>문의하기</span></a>
								<a href="#" onclick="javascript:fnGoQna(); return false;" class="btn-inq">푸드플라넷에 <span>문의하기</span></a>
							</div>
						</div>
						<div class="tab-area">
							<div class="swiper-container tabs">
								<ul class="tabs-wrapper swiper-wrapper">
									<li class="swiper-slide on"><a href="javascript:;">주요 정보</a></li>
									<li class="swiper-slide"><a href="javascript:;">제품 정보</a></li>
									<li class="swiper-slide"><a href="javascript:;">생산 정보</a></li>
									<li class="swiper-slide"><a href="javascript:;">설비 정보</a></li>
									<li class="swiper-slide"><a href="javascript:;">인증&middot;특허 정보</a></li>
									<li class="swiper-slide"><a href="javascript:;">유통&middot;수출 정보</a></li>
								</ul>
							</div>
							<div class="tab-container">
								<!-- 주요 정보 -->
								<div class="tab-cont on">
									<div class="cont-box">
										<h4 class="pc-only">업체 정보 요약</h4>
										<div class="clear">
											<div class="tb-type1">
												<dl>
													<dt>연 매출</dt>
													<dd>
														<?php 
															if(empty($info['sales_year'])) {
																echo '데이터준비중';
															}
															else {
																$tmp = explode('.', $info['sales_year']);
																if(empty($tmp[0]) && empty(round($tmp[1]))) {
																	echo '데이터준비중';
																}
																else {
																	echo (!empty($tmp[0]) ? $tmp[0] . '억' : '') . (!empty($tmp[1] && !empty(round($tmp[1]))) ? ' ' . round($tmp[1]) . (strlen($tmp[1]) == 1 ? '000' : '00') . '만' :'') . '원'; 
																}
															}
														?> 
													</dd>
												</dl>
												<dl>
													<dt>영업이익</dt>
													<dd>
														<?php 
															if(empty($info['biz_profits'])) {
																echo '데이터준비중';
															}
															else {
																$tmp = explode('.', $info['biz_profits']);
																if(empty($tmp[0]) && empty(round($tmp[1]))) {
																	echo '데이터준비중';
																}
																else {
																	echo (!empty($tmp[0]) ? $tmp[0] . '억' : '') . (!empty($tmp[1] && !empty(round($tmp[1]))) ? ' ' . round($tmp[1]) . (strlen($tmp[1]) == 1 ? '000' : '00') . '만' :'') . '원'; 
																}
															}
														?> 
													</dd>
												</dl>
											</div>
											<div class="tb-type1">											
												<dl>
													<dt>당기순이익</dt>
													<dd>
														<?php 
															if(empty($info['current_profits'])) {
																echo '데이터준비중';
															}
															else {
																$tmp = explode('.', $info['current_profits']);
																if(empty($tmp[0]) && empty(round($tmp[1]))) {
																	echo '데이터준비중';
																}
																else {
																	echo (!empty($tmp[0]) ? $tmp[0] . '억' : '') . (!empty($tmp[1] && !empty(round($tmp[1]))) ? ' ' . round($tmp[1]) . (strlen($tmp[1]) == 1 ? '000' : '00') . '만' :'') . '원'; 
																}
															}
														?> 
													</dd>
												</dl>
												<dl>
													<dt>신용등급</dt>
													<dd>
														<?php 
															if(empty($info['credit_rating'])) {
																echo '데이터준비중';
															}
															else {
														?>
															<span class="grade">
															<?php 
																echo $info['credit_rating']; 
															?>
															</span> 
															<span class="desc">재무일 : <?php echo $info['base_year']; ?></span>
														<?php
															}
														?>
													</dd>
												</dl>
											</div>
										</div>
									</div>
									<div class="cont-box2">
										<h4 class="pc-only">주요 제품</h4>
										<div class="tb-type1">
											<dl>
												<dt>주요 제품</dt>
												<dd><div class="ov-x"><?php echo $info['main_product']; ?></div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box2">
										<h4 class="pc-only">주요 OEM 거래처</h4>
										<div class="tb-type1">
											<dl>
												<dt>주요 OEM 거래처</dt>
												<dd><div class="ov-x"><?php echo $info['main_oem']; ?></div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box2">
										<h4 class="pc-only">유통 현황</h4>
										<div class="tb-type1">
											<dl>
												<dt>유통 채널</dt>
												<dd><div class="ov-x"><?php echo !empty($info['distribution_channel']) ? $info['distribution_channel'] : '데이터 준비중'; ?></div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box">
										<h4 class="pc-only">수출 현황</h4>
										<div class="tb-type1">
											<dl>
												<dt>수출 국가</dt>
												<dd><div class="ov-x"><?php echo !empty($info['export_nation']) ? $info['export_nation'] : '데이터 준비중'; ?></div></dd>
											</dl>
										</div>
									</div>
								</div>

								<!-- 제품 정보 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>제품 주요 정보</h4>
										<div class="tb-type1">
											<dl>
												<dt>자사 대표제품</dt>
												<dd><div class="ov-x"><?php echo !empty($nb['top']) ? $nb['top']['product_name'] : '데이터준비중'; ?></div></dd>
											</dl>
											<dl>
												<dt>식품유형</dt>
												<dd><div class="ov-x"><?php echo !empty($nb['top']) ? $nb['top']['product_type'] : '데이터준비중'; ?></div></dd>
											</dl>
											<dl>
												<dt>중량(단위)</dt>
												<dd><div class="ov-x"><?php echo !empty($nb['top']) ? round($nb['top']['weight']) . $nb['top']['unit'] : '데이터준비중'; ?></div></dd>
											</dl>
											<dl>
												<dt>보관방법</dt>
												<dd><div class="ov-x"><?php echo !empty($nb['top']) ? $nb['top']['storage'] : '데이터준비중'; ?></div></dd>
											</dl>
											<dl>
												<dt>소비기한</dt>
												<dd><div class="ov-x"><?php echo !empty($nb['top']) ? $nb['top']['expire_day'] : '데이터준비중'; ?></div></dd>
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
												<dd><div class="ov-x"><?php echo !empty($nb['top']) ? $nb['top']['qty'] . $nb['top']['qty_unit'] : '데이터준비중'; ?></div></dd>
											</dl>
											<dl>
												<dt>용기타입</dt>
												<dd><div class="ov-x"><?php echo !empty($nb['top']) ? $nb['top']['container_type'] : '데이터준비중'; ?></div></dd>
											</dl>
											<dl>
												<dt>채널별 납품현황</dt>
												<dd><div class="ov-x"><?php echo !empty($nb['top']) ? $nb['top']['channel_status'] : '데이터준비중'; ?></div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0">
										<h4>자사 제품 상세 정보</h4>
										<?php 
											if(empty($nb['list'])) {
												echo '<div class="nodata"><div>등록된 OEM 제품 정보가 없습니다.</div></div>';
											}
											else {
												echo '<div class="swiper pro-swiper pro-swiper2">';
												echo '	<ul class="swiper-wrapper">';
												foreach($nb['list'] as $row) {
										?>
												<li class="swiper-slide" onclick="javascript:goProductDetail('nb', '<?php echo $row['seq']; ?>'); return false;" style="cursor:pointer;">
													<div class="pro-img"><?php echo empty($row['prod_img']) ? '<img src="/assets/front/images/icon_noprofile.svg" alt="제품 이미지" />' : '<img src="' . $row['prod_img'] . '"  alt="제품 이미지" />'; ?></div>
													<div class="pro-cont">
														<div class="cate"><?php echo $row['category_name']; ?> </div>
														<div class="name"><?php echo $row['product_name']; ?></div>
														<div class="wgt"><?php echo round($row['weight']) > 0 ? round($row['weight']) . $row['unit'] : ''; ?></div>
													</div>
												</li>

										<?php
												}
												echo '	</ul>';
										?>
											<script>
												var pswiper2 = new Swiper(".pro-swiper2", {
												  observer: true,
												  observeParents: true,
												  slidesPerView: 2.1,
												  spaceBetween: 12,
												  breakpoints: {
													720: {
													  slidesPerView: 4,
													  spaceBetween: 24
													},
												  }
												});
											  </script>

										<?php
												echo '</div>';
											}
										?>
										<a href="#" onclick="javascript:goProduct('nb'); return false;" class="btn-type5 btn-more">자사 제품  더보기</a>
									</div>
									<div class="cont-box">
										<h4>위탁생산(OEM) 제품 현황 및 정보</h4>
										<div class="tb-type1">
											<dl>
												<dt>OEM 대표제품</dt>
												<dd><div class="ov-x"><?php echo !empty($oem['top']) ? $oem['top']['product_name'] : '데이터준비중'; ?></div></dd>
											</dl>
											<dl>
												<dt>식품유형</dt>
												<dd><div class="ov-x"><?php echo !empty($oem['top']) ? $oem['top']['product_type'] : '데이터준비중'; ?></div></dd>
											</dl>
											<dl>
												<dt>중량(단위)</dt>
												<dd><div class="ov-x"><?php echo !empty($oem['top']) ? round($oem['top']['weight']) . $oem['top']['unit'] : '데이터준비중'; ?></div></dd>
											</dl>
											<dl>
												<dt>보관방법</dt>
												<dd><div class="ov-x"><?php echo !empty($oem['top']) ? $oem['top']['storage'] : '데이터준비중'; ?></div></dd>
											</dl>
											<dl>
												<dt>소비기한</dt>
												<dd><div class="ov-x"><?php echo !empty($oem['top']) ? $oem['top']['expire_day'] : '데이터준비중'; ?></div></dd>
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
												<dd><div class="ov-x"><?php echo !empty($oem['top']) ? $oem['top']['qty'] . $oem['top']['qty_unit'] : '데이터준비중'; ?></div></dd>
											</dl>
											<dl>
												<dt>용기타입</dt>
												<dd><div class="ov-x"><?php echo !empty($oem['top']) ? $oem['top']['container_type'] : '데이터준비중'; ?></div></dd>
											</dl>
											<dl>
												<dt>채널별 납품현황</dt>
												<dd><div class="ov-x"><?php echo !empty($oem['top']) ? $oem['top']['channel_status'] : '데이터준비중'; ?></div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0">
										<h4>위탁생산(OEM) 제품 상세 정보</h4>
										<?php 
											if(empty($oem['list'])) {
												echo '<div class="nodata"><div>등록된 OEM 제품 정보가 없습니다.</div></div>';
											}
											else {
												echo '<div class="swiper pro-swiper pro-swiper2">';
												echo '	<ul class="swiper-wrapper">';
												foreach($oem['list'] as $row) {
										?>
												<li class="swiper-slide" onclick="javascript:goProductDetail('oem', '<?php echo $row['seq']; ?>'); return false;" style="cursor:pointer;">
													<div class="pro-img"><?php echo empty($row['prod_img']) ? '<img src="/assets/front/images/icon_noprofile.svg" alt="제품 이미지" />' : '<img src="' . $row['prod_img'] . '"  alt="제품 이미지" />'; ?></div>
													<div class="pro-cont">
														<div class="cate"><?php echo $row['category_name']; ?> </div>
														<div class="name"><?php echo $row['product_name']; ?></div>
														<div class="wgt"><?php echo round($row['weight']) > 0 ? round($row['weight']) . $row['unit'] : ''; ?></div>
													</div>
												</li>

										<?php
												}
												echo '	</ul>';
										?>
											<script>
												var pswiper2 = new Swiper(".pro-swiper2", {
												  observer: true,
												  observeParents: true,
												  slidesPerView: 2.1,
												  spaceBetween: 12,
												  breakpoints: {
													720: {
													  slidesPerView: 4,
													  spaceBetween: 24
													},
												  }
												});
											  </script>

										<?php
												echo '</div>';
											}
										?>

										<a href="#" onclick="javascript:goProduct('oem'); return false;" class="btn-type5 btn-more">위탁 제품  더보기</a>
									</div>
								</div>

								<!-- 생산 정보 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4 class="pc-only">대표제품 생산 정보</h4>
										<div class="clear">
											<div class="tb-type1 type5">
												<dl>
													<dt>대표제품 <span>일일 가능 생산량</span></dt>
													<dd class="blur"><?php echo $info['production_day']; ?> <span class="desc">(단위 : <?php echo $info['unit_day']; ?>)</span></dd>
												</dl>
											</div>
											<div class="tb-type1 type5">
												<dl>
													<dt>대표제품 <span>월 가능 생산량</span></dt>
													<dd class="blur"><?php echo $info['production_month']; ?> <span class="desc">(단위 : <?php echo $info['unit_month']; ?>)</span></dd>
												</dl>
											</div>
										</div>
										<div class="clear">
											<div class="tb-type1 type5">
												<dl>
													<dt>대표제품 <span>연 가능 생산량</span></dt>
													<dd class="blur"><?php echo $info['production_year']; ?> <span class="desc">(단위 : <?php echo $info['unit_year']; ?>)</span></dd>
												</dl>
											</div>
											<div class="tb-type1 type5">
												<dl>
													<dt>현재 CAPA</dt>
													<dd class="blur"><?php echo $info['capa']; ?><span class="desc">등록일 : <?php echo $info['capa_at']; ?></span></dd>
												</dl>
											</div>
										</div>
									</div>
								</div>

								<!-- 설비 정보 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>설비 정보 요약</h4>
										<div class="tb-type1 type5">
											<dl>
												<dt>설비 정보</dt>
												<dd><div class="ov-x blur"><?php echo $info['facilities_info']; ?></div></dd>
											</dl>
											<dl>
												<dt>포장기계 보유 현황</dt>
												<dd><div class="ov-x blur"><?php echo $info['packaging_machine']; ?></div></dd>
											</dl>
											<dl>
												<dt>기타 기계 보유 현황</dt>
												<dd><div class="ov-x blur"><?php echo $info['etc_machine']; ?></div></dd>
											</dl>
											<dl>
												<dt>이물질 검출기 보유 현황</dt>
												<dd><div class="ov-x blur"><?php echo $info['detection_machine']; ?></div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0">
										<h4>업체 등록 설비 정보</h4>
										<?php
											if(empty($facilities)) {
												echo '<div class="nodata"><div>등록된 설비 정보가 없습니다.</div></div>';
											}
											else {
												echo '<ul class="fi-list">';
												foreach($facilities as $row) {
										?>
												<li>
													<div class="fi-wrap">
														<div class="fi-img"><img src="<?php echo $row['img_url'] ; ?>" alt="설비이미지" /></div>
														<dl>
															<dt><?php echo $row['img_desc']; ?></dt>
															<dd>
															</dd>
														</dl>
													</div>
												</li>
										<?php
												}
												echo '</ul>';
											}
										?>
										
<!--										<a href="javascript:;" class="btn-type5 btn-more">설비 정보 더보기</a> -->
									</div>
								</div>

								<!-- 인증/특허 정보 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>품질 정보 요약</h4>
										<div class="tb-type2 type2">
											<dl>
												<dt>인증 현황</dt>
												<dd><div class="ov-x"><?php echo $info['certi']; ?></div></dd>
											</dl>
											<dl>
												<dt>특허 현황</dt>
												<dd>
													<div class="ovf-box">
														<dl>
															<dt><?php echo !empty($patent) ? $patent[0]['patent_name'] : ''; ?></dt>
															<dd>
															<?php
																foreach($patent as $row) {
																	echo '· ' . $row['patent_name'] . '<br />';
																}
															?>
															</dd>
														</dl>
													</div>
												</dd>
											</dl>
										</div>
										<div class="tb-type2 type2">
											<dl>
												<dt>FDA 공장등록 여부</dt>
												<dd><div class="ov-x"><?php echo $info['is_fda'] === 'y' ? '등록' : '미등록'; ?></div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box cer-cont-box bot0"><!-- 인증/특허정보 cer-cont-box -->
										<h4>업체 등록 인증 정보</h4>
										<?php 
											if(empty($cert)) {
												echo '<div class="nodata" style="display:none;"><div>등록된 인증 정보가 없습니다.</div></div>';
											}
											else {
												echo '<div class="swiper cer-swiper cer-swiper1">';
												echo '	<ul class="swiper-wrapper">';
												foreach($cert as $row) {
										?>
												<li class="swiper-slide">
													<div class="cer-box">
														<div class="cer-img"><?php echo !empty($row['cert_img']) ? '<img src="' . $row['cert_img'] . '" alt="인증서이미지" />' : ''; ?></div>
														<div class="cer-cont">
															<div class="name"><?php echo $row['cert_name']; ?></div>
															<div class="date"></div>
														</div>
													</div>
												</li>
										<?php
												}
												echo '	</ul>';
										?>
											<script>
												var ww = $(window).width();
												var ceswiper1 = undefined;
												function initSwiper1() {
												  if (ww <= 720 && ceswiper1 == undefined) {
													ceswiper1 = new Swiper(".cer-swiper1", {
													  observer: true,
													  observeParents: true,
													  slidesPerView: 1.6,
													  spaceBetween: 12,
													});
												  } else if (ww > 720 && ceswiper1 != undefined) {
													ceswiper1.destroy();
													ceswiper1 = undefined;
												  }
												}
												initSwiper1();
												$(window).on('resize', function () {
												  ww = $(window).width();
												  initSwiper1();
												});
											</script>
										<?php
												echo '</div>';
											}
										?>
<!--										<a href="javascript:;" class="btn-type5 btn-more">인증 정보  더보기</a> -->
									</div>
									<div class="cont-box cer-cont-box"><!-- 인증/특허정보 cer-cont-box -->
										<h4>업체 등록 특허 정보</h4>
										<?php 
											if(empty($patent)) {
												echo '<div class="nodata" style="display:none;"><div>등록된 특허 정보가 없습니다.</div></div>';
											}
											else {
												echo '<div class="swiper cer-swiper cer-swiper1">';
												echo '	<ul class="swiper-wrapper">';
												foreach($patent as $row) {
										?>
												<li class="swiper-slide">
													<div class="cer-box">
														<div class="cer-img"><?php echo !empty($row['patent_img']) ? '<img src="' . $row['patent_img'] . '" alt="특허이미지" />' : ''; ?></div>
														<div class="cer-cont">
															<div class="name"><?php echo $row['patent_name']; ?></div>
															<div class="date"></div>
														</div>
													</div>
												</li>
										<?php
												}
												echo '	</ul>';
										?>
											<script>
												var ww = $(window).width();
												var ceswiper1 = undefined;
												function initSwiper1() {
												  if (ww <= 720 && ceswiper1 == undefined) {
													ceswiper1 = new Swiper(".cer-swiper1", {
													  observer: true,
													  observeParents: true,
													  slidesPerView: 1.6,
													  spaceBetween: 12,
													});
												  } else if (ww > 720 && ceswiper1 != undefined) {
													ceswiper1.destroy();
													ceswiper1 = undefined;
												  }
												}
												initSwiper1();
												$(window).on('resize', function () {
												  ww = $(window).width();
												  initSwiper1();
												});
											</script>
										<?php
												echo '</div>';
											}
										?>
<!--										<a href="javascript:;" class="btn-type5 btn-more">특허 정보  더보기</a> -->
									</div>
								</div>

								<!-- 유통/수출 정보 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>유통 현황</h4>
										<div class="tb-type1 type5">
											<dl>
												<dt>유통 채널</dt>
												<dd><div class="ov-x"><?php echo $info['distribution_channel']; ?></div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0">
										<h4>수출 현황</h4>
										<div class="tb-type1">
											<dl>
												<dt>수출 국가</dt>
												<dd><div class="ov-x"><?php echo $info['export_nation']; ?></div></dd>
											</dl>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
   
	<!-- 관심기업 토스트팝업 -->
	<div class="layer-toast favorite-in" id="favorite1">
		<dl>
			<dt>관심기업 등록</dt>
			<dd>
				<?php echo $info['company_name']; ?> 관심기업으로 등록하였습니다.<br />
				관심기업은 마이페이지에서 확인하실 수 있습니다.
			</dd>
		</dl>
	</div>
	<div class="layer-toast favorite-out" id="favorite2">
		<dl>
			<dt>관심기업 삭제</dt>
			<dd>
				<?php echo $info['company_name']; ?> 관심기업에서 삭제되었습니다.<br />
				관심기업은 마이페이지에서 확인하실 수 있습니다.
			</dd>
		</dl>
	</div>

<form id="frmProduct" method="post"  action="/domestic/product/list">
	<input type="hidden" name="biz_no" value="<?php echo $info['biz_no']; ?>" />
	<input type="hidden" name="prod_type" value="" />
	<input type="hidden" name="product_seq" value="" />
	<input type="hidden" name="detail_seq" value="" />
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
					data: {target_cd : '<?php echo $info['biz_no']; ?>', target_type : '1', is_wish : isWish},
					async : false,
					dataType : 'json',
					success: function(data) {
						if(data.result == 'fail') {
							showAlert(data.msg);
						}
						else {
							if($(obj).hasClass("on")){
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

function goProduct(sType) {
	$('#frmProduct').attr('action', '/domestic/product/list');
	$('#frmProduct input[name=prod_type]').val(sType);
	$('#frmProduct').submit();
}

function goProductDetail(sType, seq) {
	$('#frmProduct').attr('method', 'post');
	$('#frmProduct').attr('action', '/domestic/product/detail');
	$('#frmProduct input[name=prod_type]').val(sType);
	$('#frmProduct input[name=detail_seq]').val(seq);
	$('#frmProduct').submit();
}

</script>