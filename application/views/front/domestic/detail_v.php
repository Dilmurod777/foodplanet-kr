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
								<div class="profile-img">
								<?php
									if(!empty($info['logo_img'])) {
										echo '<img src="/api/common/img_view?img_path=' . $info['logo_img'] . '" alt="' . $info['company_name'] . ' 로고이미지" />';
									}
								?>
								</div>
								<dl class="profie-info">
									<dt><?php echo $info['company_name']; ?> <span><?php echo !empty($info['company_name_eng']) ? $info['company_name_eng'] : '미등록'; ?></span></dt>
									<dd>
										<div><?php echo $info['summary']; ?></div>
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
										<?php
											if(empty($member) || $info['member_cd'] !== $member['member_cd']) {
										?>
											<a href="#" onclick="javascript:$('#frmRequest').submit(); return false;" class="btn-type5 btn-est">견적서 요청</a>
										<?php
											}
										?>
									</dd>
								</dl>
							</div>
							<a href="javascript:;" class="mo-only btn-toggle btn-detail">제조사 상세 정보</a>
							<div class="pc-only detail-company clear">
								<div>
									<dl>
										<dt>대표자명</dt>
										<dd><?php echo $info['owner_name']; ?></dd>
									</dl>
									<dl>
										<dt>표준산업 분류코드</dt>
										<dd><?php echo $info['industrial_code']; ?></dd>
									</dl>
									<dl>
										<dt>설립연도</dt>
										<dd><?php echo $info['incorporation_at']; ?> <?php echo !empty($info['incorporation_year']) ? '(만 ' . $info['incorporation_year'] . '년)' : ''; ?></dd>
									</dl>
								</div>
								<div>
									<dl>
										<dt>주소</dt>
										<dd><?php echo $info['zonecode']; ?></dd>
									</dl>
									<dl>
										<dt>홈페이지 주소</dt>
										<dd>
											<?php 
												if(!empty($info['homepage'])) {
													$home = $info['homepage'];
													if(substr($home, 0, 7) !== 'http://' && substr($home, 0, 8) !== 'https://') {
														$home = 'http://' . $home;
													}
											?>
												<a href="<?php echo $home; ?>" target="_blank"><?php echo $info['homepage']; ?></a>
											<?php
												}
											?>
										</dd>
									</dl>
									<dl>
										<dt>회사 대표 전화번호</dt>
										<dd><?php echo $info['company_tel']; ?></dd>
									</dl>
								</div>
							</div>
						</div>
						<div class="tab-area">
							<div class="swiper-container tabs">
								<ul class="tabs-wrapper swiper-wrapper">
									<li class="swiper-slide on"><a href="javascript:;">기업 개요</a></li>
									<li class="swiper-slide"><a href="javascript:;">제품 정보</a></li>
									<li class="swiper-slide"><a href="javascript:;">생산 정보</a></li>
									<li class="swiper-slide"><a href="javascript:;">설비 정보</a></li>
									<li class="swiper-slide"><a href="javascript:;">인증&middot;특허 정보</a></li>
									<li class="swiper-slide"><a href="javascript:;">유통&middot;수출 정보</a></li>
								</ul>
							</div>
							<div class="tab-container">
								<!-- 기업 개요 -->
								<div class="tab-cont on">
									<div class="cont-box">
										<h4 class="pc-only">업체 정보 요약</h4>
										<div class="clear">
											<div class="tb-type1">
												<dl>
													<dt>시설 규모</dt>
													<dd><?php echo !empty($info['facilities_scale']) ? $info['facilities_scale'] : '미등록'; ?></dd>
												</dl>
												<dl>
													<dt>직원 수</dt>
													<dd><?php echo !empty($info['staff_number']) && is_numeric($info['staff_number']) ? number_format($info['staff_number']) . '명 <span class="desc">(' . $info['staff_updated_at'] . ' 기준)</span>' : '미등록'; ?></dd>
												</dl>
												<dl>
													<dt>연 매출</dt>
													<dd><?php echo !empty($info['year_sales']) && is_numeric($info['year_sales']) ? '<span class="' . $info['sales_arrow'] . '">' . number_format($info['year_sales']/1000) . '백만원</span> <span class="desc">(' . $info['sales_updated_at'] . '년 기준)</span>' : '미등록'; ?></dd>
												</dl>
											</div>
											<div class="tb-type1">
												<dl>
													<dt>영업이익</dt>
													<dd><?php echo !empty($info['biz_profit']) && is_numeric($info['biz_profit']) ? '<span class="' . $info['biz_profit_arrow'] . '">' . number_format($info['biz_profit']/1000) . '백만원</span> <span class="desc">(' . $info['biz_profit_updated_at'] . '년 기준)</span>' : '미등록'; ?></dd>
												</dl>
												<dl>
													<dt>순이익</dt>
													<dd><?php echo !empty($info['net_profit']) && is_numeric($info['net_profit']) ? '<span class="' . $info['net_profit_arrow'] . '">' . number_format($info['net_profit']/1000) . '백만원</span> <span class="desc">(' . $info['net_profit_updated_at'] . '년 기준)</span>' : '미등록'; ?></dd>
												</dl>
												<dl>
													<dt>회사 소개서</dt>
													<dd class="btn-wrap">
													<?php
														if(!empty($info['introduce_file'])) {
													?>
														<a href="/api/common/file_download?file_path=<?php echo $info['introduce_file']; ?>&org_name=<?php echo $info['introduce_file_name']; ?>" target="_blank" class="btn-download">
															<span class="pc-only">파일 </span>다운로드
														</a> 
														<span class="desc">등록<span class="pc-only">일 </span><?php echo $info['introduce_file_updated_at']; ?></span>
													<?php
														}
														else {
															echo '미등록';
														}
													?>
														
													</dd>
												</dl>
											</div>
										</div>
									</div>
								</div>

								<!-- 제품 정보 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>자사 제품 현황 및 정보</h4>
										<div class="tb-type1">
											<dl>
												<dt>주요 제품</dt>
												<dd><div class="ov-x"><?php echo !empty($info['own_product']) ? $info['own_product'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt><span class="pc-only">채널 별 납품 현황 및 납품처</span><span class="mo-only">납품 현황, 납품처</span></dt>
												<dd><div class="ov-x"><?php echo empty($info['channel_online']) && empty($info['channel_offline']) ? '미등록' : $info['channel_offline'] . ' ' . $info['channel_online']; ?></div></dd>
											</dl>
											<dl>
												<dt>오더 납기 일자</dt>
												<dd><div class="ov-x"><?php echo !empty($info['delivery_day']) ? $info['delivery_day'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>제품 <span class="pc-only">별</span> 오더 MOQ</dt>
												<dd><div class="ov-x"><?php echo !empty($info['order_moq']) ? $info['order_moq'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>NB 제품 현황</dt>
												<dd><div class="ov-x"><?php echo !empty($info['nb_product']) ? $info['nb_product'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>제품 별 공급 단가</dt>
												<dd><div class="ov-x"><?php echo !empty($info['supply_price']) ? $info['supply_price'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>용기 타입 및 입수</dt>
												<dd><div class="ov-x"><?php echo !empty($info['type_cnt']) ? $info['type_cnt'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>유통기한</dt>
												<dd><div class="ov-x"><?php echo !empty($info['expire_day']) ? $info['expire_day'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>식품 유형</dt>
												<dd><div class="ov-x"><?php echo !empty($info['main_product_name']) ? $info['main_product_name'] . (!empty($info['main_product_etc']) ? '(' . $info['main_product_etc'] . ')' : '') : '미등록'; ?></div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0">
										<h4>자사 제품 상세 정보</h4>
										<?php 
											if(empty($own)) {
										?>
											<div class="nodata" style="display:block;"><div>등록된 자사 제품 정보가 없습니다.</div></div>
										<?php
											}
											else {
										?>
											<div class="swiper pro-swiper pro-swiper1">
												<ul class="swiper-wrapper">
												<?php
													foreach($own as $row) {
												?>
													<li class="swiper-slide">
														<a href="#" onclick="javascript:goProductDetail('own', '<?php echo $row['detail_seq']; ?>'); return false;">
															<div class="pro-img">
															<?php
																if(!empty($row['thumbnail_img'])) {
															?>
																<img src="/api/common/img_view?img_path=<?php echo $row['thumbnail_img']; ?>" alt="제품 이미지" /></div>
															<?php
																}
																else {
															?>
																<img src="/assets/front/images/icon_noprofile.svg" alt="제품 이미지" /></div>
															
															<?php
																}
															?>
															<div class="pro-cont">
																<div class="cate"> <?php echo $row['food_type']; ?></div>
																<div class="name"><?php echo $row['product_name']; ?></div>
																<div class="wgt"><?php echo $row['type_cnt']; ?></div>
															</div>
														</a>
													</li>

												<?php
													}

												?>
												</ul>
												<script>
													var pswiper1 = new Swiper(".pro-swiper1", {
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
											</div>
											<a href="#" onclick="javascript:goProduct('own'); return false;" class="btn-type5 btn-more">자사 제품  더보기</a>

										<?php
											}
										?>
									</div>
									<div class="cont-box">
										<h4>위탁생산(OEM) 제품 현황 및 정보</h4>
										<div class="tb-type2">
											<dl>
												<dt class="btn-toggle"><span class="pc-only">제품 현황 및 정보</span><span class="mo-only">납품 현황, 납품처</span></dt>
												<dd>
													<dl>
														<dt>납품 현황 및 납품처</dt>
														<dd><?php echo empty($info['oem_channel_online']) && empty($info['oem_channel_offline']) ? '미등록' : $info['oem_channel_offline'] . ' ' . $info['oem_channel_online']; ?></dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">오더 <div>정보</div></dt>
												<dd>
													<dl>
														<dt>오더 납기 일자</dt>
														<dd><?php echo !empty($info['oem_delivery_day']) ? $info['oem_delivery_day'] : '미등록'; ?></dd>
													</dl>
													<dl>
														<dt>오더 MOQ</dt>
														<dd><?php echo !empty($info['oem_order_moq']) ? $info['oem_order_moq'] : '미등록'; ?></dd>
													</dl>
													<dl>
														<dt>타 기업 거래 현황</dt>
														<dd>미등록</dd>
													</dl>
													<dl>
														<dt><span class="font-s">준비중인 <span>신상품 현황</span></span></dt>
														<dd>미등록</dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">타입 별 <div>제품 정보</div></dt>
												<dd>
													<dl>
														<dt>A타입별 세부 정보</dt>
														<dd><?php echo !empty($info['oem_type_a']) ? $info['oem_type_a'] : '미등록'; ?></dd>
													</dl>
													<dl>
														<dt>B타입별 세부 정보</dt>
														<dd><?php echo !empty($info['oem_type_b']) ? $info['oem_type_b'] : '미등록'; ?></dd>
													</dl>
													<dl>
														<dt>C타입별 세부 정보</dt>
														<dd><?php echo !empty($info['oem_type_c']) ? $info['oem_type_c'] : '미등록'; ?></dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">부자재 <div>정보</div></dt>
												<dd>
													<dl>
														<dt>부자재 발주 리드 타임</dt>
														<dd><?php echo !empty($info['oem_sub_lead_time']) ? $info['oem_sub_lead_time'] : '미등록'; ?></dd>
													</dl>
													<dl>
														<dt>부자재 MOQ</dt>
														<dd><?php echo !empty($info['oem_sub_moq']) ? $info['oem_sub_moq'] : '미등록'; ?></dd>
													</dl>
													<dl>
														<dt>부자재 별 단가</dt>
														<dd><?php echo !empty($info['oem_sub_price']) ? $info['oem_sub_price'] : '미등록'; ?></dd>
													</dl>
												</dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0">
										<h4>위탁생산(OEM) 제품 상세 정보</h4>
										<?php
											if(empty($oem)) {
										?>
											<div class="nodata" style="display:block;"><div>등록된 위탁생산 제품 정보가 없습니다.</div></div>
										<?php
											}
											else {
										?>
											<div class="swiper pro-swiper pro-swiper2">
												<ul class="swiper-wrapper">
												<?php
													foreach($oem as $row) {
												?>
													<li class="swiper-slide">
														<a href="#" onclick="javascript:goProductDetail('oem', '<?php echo $row['detail_seq']; ?>'); return false;">
															<div class="pro-img">
															<?php
																if(!empty($row['thumbnail_img'])) {
															?>
																<img src="/api/common/img_view?img_path=<?php echo $row['thumbnail_img']; ?>" alt="제품 이미지" /></div>
															<?php
																}
																else {
															?>
																<img src="/assets/front/images/icon_noprofile.svg" alt="제품 이미지" /></div>
															
															<?php
																}
															?>
															<div class="pro-cont">
																<div class="cate"> <?php echo $row['food_type']; ?></div>
																<div class="name"><?php echo $row['product_name']; ?></div>
																<div class="wgt"><?php echo $row['type_cnt']; ?></div>
															</div>
														</a>
													</li>
												<?php
													}
												?>
												</ul>
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
											</div>
											<a href="#" onclick="javascript:goProduct('oem'); return false;" class="btn-type5 btn-more">위탁 제품  더보기</a>

										<?php
											}
										?>
									</div>
								</div>

								<!-- 생산 정보 -->
								<div class="tab-cont">
									<div class="pi-info">
										<div class="clear">
											<div class="chart-area <?php  echo empty($info['manufacture_day']) ? 'nodata' : ''; ?>">
											<?php
												if(empty($info['manufacture_day'])) {
											?>
												<div class="title-area">
													<h5>일일 가능 생산량<span>수집중...</span></h5>
													<div class="position"><span>정보없음</span></div>
												</div>
												<div class="chart bar">
													<span class="ho-line line1"></span>
													<span class="ho-line line2"></span>
													<span class="ho-line line3"></span>
													<span class="ho-line line4"></span>
													<span class="ho-line line5"></span>
													<dl class="data-mine">
														<dd>
															<div class="data-bar"><div class="blind">정보없음</div></div>
														</dd>
														<dt>기업명<div>정보없음</div></dt>
													</dl>
													<dl class="data-aver1">
														<dd>
															<div class="data-bar"><div class="blind">정보없음</div></div>
														</dd>
														<dt>동종 업종 평균<div>정보없음</div></dt>
													</dl>
													<dl class="data-aver2">
														<dd>
															<div class="data-bar"><div class="blind">정보없음</div></div>
														</dd>
														<dt>제조사 전체 평균<div>정보없음</div></dt>
													</dl>
													<div class="standard">2022.10 기준</div>
												</div>
											<?php
												}
												else {
											?>
												<div class="title-area">
													<h5>일일 가능 생산량</h5>
													<?php
														$max = $summary['day']['max_val'] > $summary['day_ind']['max_val'] ? $summary['day']['max_val'] : $summary['day_ind']['max_val'];
														$g1 = round($info['manufacture_day'] / $max);
														$g2 = round($summary['day']['avg_val'] / $max);
														$g3 = round($summary['day_ind']['avg_val'] / $max);
														$per = 100 - $g1;
													?>
														<div class="position"> 동종업체 <strong>상위 <?php  echo $per; ?>%</strong> <span><?php echo number_format($info['manufacture_day']) . '개'; ?></span></div>
												</div>
												<div class="chart bar">
													<span class="ho-line line1"></span>
													<span class="ho-line line2"></span>
													<span class="ho-line line3"></span>
													<span class="ho-line line4"></span>
													<span class="ho-line line5"></span>
													<dl class="data-mine">
														<dd>
															<div class="data-bar" style="height:<?php echo $g1; ?>%;"><div class="blind">14,500</div></div>
														</dd>
														<dt><?php echo $info['company_name'];  ?><div><?php echo number_format($info['manufacture_day']); ?></div></dt>
													</dl>
													<dl class="data-aver1">
														<dd>
															<div class="data-bar" style="height:<?php echo $g3; ?>%;"><div class="blind"><?php echo number_format($summary['day_ind']['avg_val']); ?></div></div>
														</dd>
														<dt>동종 업종 평균<div><?php echo number_format($summary['day_ind']['avg_val']); ?></div></dt>
													</dl>
													<dl class="data-aver2">
														<dd>
															<div class="data-bar" style="height:<?php echo $g2; ?>%;"><div class="blind"><?php echo number_format($summary['day']['avg_val']); ?></div></div>
														</dd>
														<dt>제조사 전체 평균<div><?php echo number_format($summary['day']['avg_val']); ?></div></dt>
													</dl>
													<div class="standard"></div>
												</div>

											<?php
											
												}
											?>
											</div>
											<div class="chart-area <?php  echo empty($info['manufacture_month']) ? 'nodata' : ''; ?>">
											<?php
												if(empty($info['manufacture_day'])) {
											?>
												<div class="title-area">
													<h5>현재 월 가능 생산량<span>수집중...</span></h5>
													<div class="position"><span>정보없음</span></div>
												</div>
												<div class="chart bar">
													<span class="ho-line line1"></span>
													<span class="ho-line line2"></span>
													<span class="ho-line line3"></span>
													<span class="ho-line line4"></span>
													<span class="ho-line line5"></span>
													<dl class="data-mine">
														<dd>
															<div class="data-bar"><div class="blind">정보없음</div></div>
														</dd>
														<dt>기업명<div>정보없음</div></dt>
													</dl>
													<dl class="data-aver1">
														<dd>
															<div class="data-bar"><div class="blind">정보없음</div></div>
														</dd>
														<dt>동종 업종 평균<div>정보없음</div></dt>
													</dl>
													<dl class="data-aver2">
														<dd>
															<div class="data-bar"><div class="blind">정보없음</div></div>
														</dd>
														<dt>제조사 전체 평균<div>정보없음</div></dt>
													</dl>
													<div class="standard">2022.10 기준</div>
												</div>
											<?php
												}
												else {
											?>
												<div class="title-area">
													<h5>현재 월 가능 생산량</h5>
													<?php
														$max = $summary['month']['max_val'] > $summary['month_ind']['max_val'] ? $summary['month']['max_val'] : $summary['month_ind']['max_val'];
														$g1 = round($info['manufacture_month'] / $max);
														$g2 = round($summary['month']['avg_val'] / $max);
														$g3 = round($summary['month_ind']['avg_val'] / $max);
													?>
														<div class="position"> 동종업체 <strong>상위 <?php  echo $per; ?>%</strong> <span><?php echo number_format($info['manufacture_month']) . '개'; ?></span></div>
												</div>
												<div class="chart bar">
													<span class="ho-line line1"></span>
													<span class="ho-line line2"></span>
													<span class="ho-line line3"></span>
													<span class="ho-line line4"></span>
													<span class="ho-line line5"></span>
													<dl class="data-mine">
														<dd>
															<div class="data-bar" style="height:<?php echo $g1; ?>%;"><div class="blind">14,500</div></div>
														</dd>
														<dt><?php echo $info['company_name'];  ?><div><?php echo number_format($info['manufacture_month']); ?></div></dt>
													</dl>
													<dl class="data-aver1">
														<dd>
															<div class="data-bar" style="height:<?php echo $g3; ?>%;"><div class="blind"><?php echo number_format($summary['month_ind']['avg_val']); ?></div></div>
														</dd>
														<dt>동종 업종 평균<div><?php echo number_format($summary['month_ind']['avg_val']); ?></div></dt>
													</dl>
													<dl class="data-aver2">
														<dd>
															<div class="data-bar" style="height:<?php echo $g2; ?>%;"><div class="blind"><?php echo number_format($summary['month']['avg_val']); ?></div></div>
														</dd>
														<dt>제조사 전체 평균<div><?php echo number_format($summary['month']['avg_val']); ?></div></dt>
													</dl>
													<div class="standard"></div>
												</div>

											<?php
											
												}
											?>
											</div>
											<div class="chart-area <?php  echo empty($info['manufacture_month']) ? 'nodata' : ''; ?>">
											<?php
												if(empty($info['manufacture_day'])) {
											?>
												<div class="title-area">
													<h5>현재 월 창고 적재가능 수량<span>수집중...</span></h5>
													<div class="position"><span>정보없음</span></div>
												</div>
												<div class="chart bar">
													<span class="ho-line line1"></span>
													<span class="ho-line line2"></span>
													<span class="ho-line line3"></span>
													<span class="ho-line line4"></span>
													<span class="ho-line line5"></span>
													<dl class="data-mine">
														<dd>
															<div class="data-bar"><div class="blind">정보없음</div></div>
														</dd>
														<dt>기업명<div>정보없음</div></dt>
													</dl>
													<dl class="data-aver1">
														<dd>
															<div class="data-bar"><div class="blind">정보없음</div></div>
														</dd>
														<dt>동종 업종 평균<div>정보없음</div></dt>
													</dl>
													<dl class="data-aver2">
														<dd>
															<div class="data-bar"><div class="blind">정보없음</div></div>
														</dd>
														<dt>제조사 전체 평균<div>정보없음</div></dt>
													</dl>
													<div class="standard">2022.10 기준</div>
												</div>
											<?php
												}
												else {
											?>
												<div class="title-area">
													<h5>현재 월 창고 적재가능 수량</h5>
													<?php
														$max = $summary['load']['max_val'] > $summary['load_ind']['max_val'] ? $summary['load']['max_val'] : $summary['load_ind']['max_val'];
														$g1 = round($info['load_cnt'] / $max);
														$g2 = round($summary['load']['avg_val'] / $max);
														$g3 = round($summary['load_ind']['avg_val'] / $max);
													?>
														<div class="position"> 동종업체 <strong>상위 <?php  echo $per; ?>%</strong> <span><?php echo number_format($info['load_cnt']) . '개'; ?></span></div>
												</div>
												<div class="chart bar">
													<span class="ho-line line1"></span>
													<span class="ho-line line2"></span>
													<span class="ho-line line3"></span>
													<span class="ho-line line4"></span>
													<span class="ho-line line5"></span>
													<dl class="data-mine">
														<dd>
															<div class="data-bar" style="height:<?php echo $g1; ?>%;"><div class="blind">14,500</div></div>
														</dd>
														<dt><?php echo $info['company_name'];  ?><div><?php echo number_format($info['load_cnt']); ?></div></dt>
													</dl>
													<dl class="data-aver1">
														<dd>
															<div class="data-bar" style="height:<?php echo $g3; ?>%;"><div class="blind"><?php echo number_format($summary['load_ind']['avg_val']); ?></div></div>
														</dd>
														<dt>동종 업종 평균<div><?php echo number_format($summary['load_ind']['avg_val']); ?></div></dt>
													</dl>
													<dl class="data-aver2">
														<dd>
															<div class="data-bar" style="height:<?php echo $g2; ?>%;"><div class="blind"><?php echo number_format($summary['load']['avg_val']); ?></div></div>
														</dd>
														<dt>제조사 전체 평균<div><?php echo number_format($summary['load']['avg_val']); ?></div></dt>
													</dl>
													<div class="standard"></div>
												</div>

											<?php
											
												}
											?>
											</div>											
											
										</div>
										<div class="chart-area nodata"><!-- 정보없음 class="nodata" -->
											<div class="title-area">
												<h5>연간 생산 실적</h5>
												<div class="position"><span>정보없음</span></div>
											</div>
											<canvas id="chart1" class="chart-js"></canvas>
											<Script>
												var ctx = document.getElementById('chart1').getContext('2d');
												var $labels_arr = ["<span>$0</span> None", "<span style='color:red'>$23.63</span> Handicap Accessible"];
												var chart = new Chart(ctx, {
													// The type of chart we want to create
													type: 'line',

													// The data for our dataset
													data: {
														labels: ["", "2016", "2017", "2018", "2019", "2020", "2021", "2022",  ""],
														datasets: [{
															label: "My First dataset",
															backgroundColor: 'rgba(0, 207, 202, 0.2)',
															borderColor: 'rgb(0, 207, 202)',
															pointBackgroundColor: 'rgb(0, 207, 202)',
															data: [null, 1000000, 1000000, 1000000, 1000000, 1000000, 1000000, 1000000, null],
															borderWidth: 1,
															pointRadius:3,
														}]
													},

													// Configuration options go here
													options: {
														responsive: true,
														//maintainAspectRatio: false,
														legend: {
															display: false,
														},
														scales: {
															y: {
																min: 0,
																max: 3000000,
																stepSize: 1000000
															}
														},
														elements: {
															line: {
																tension: 0
															}
													    }
													}
												});
											</script>
											<ul class="data-labels">
												<li>
													<div>
														<span>2016</span>
														<div>정보없음</div>
													</div>
												</li>
												<li>
													<div>
														<span>2017</span>
														<div>정보없음</div>
													</div>
												</li>
												<li>
													<div>
														<span>2018</span>
														<div>정보없음</div>
													</div>
												</li>
												<li>
													<div>
														<span>2019</span>
														<div>정보없음</div>
													</div>
												</li>
												<li>
													<div>
														<span>2020</span>
														<div>정보없음</div>
													</div>
												</li>
												<li>
													<div>
														<span>2021</span>
														<div>정보없음</div>
													</div>
												</li>
												<li>
													<div>
														<span>2022</span>
														<div>정보없음</div>
													</div>
												</li>
											</ul>
										</div>            
									</div>
								</div>

								<!-- 설비 정보 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>설비 정보 요약</h4>
										<div class="tb-type2">
											<dl>
												<dt class="btn-toggle">설비 정보</dt>
												<dd>
													<dl>
														<dt>모델, 라인 수</dt>
														<dd><?php echo !empty($info['model_lines']) ? $info['model_lines'] : '미등록'; ?></dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">포장 기계 <div>보유 현황</div></dt>
												<dd>
													<dl>
														<dt>밴드실러 기계</dt>
														<dd><?php echo !empty($info['pack_bandsealer']) ? $info['pack_bandsealer'] : '미등록'; ?></dd>
													</dl>
													<dl>
														<dt>용기용 포장 기계</dt>
														<dd><?php echo !empty($info['pack_container']) ? $info['pack_container'] : '미등록'; ?></dd>
													</dl>
													<dl>
														<dt>로타리 포장 기계</dt>
														<dd><?php echo !empty($info['pack_rotary']) ? $info['pack_rotary'] : '미등록'; ?></dd>
													</dl>
													<dl>
														<dt>파우치 형태</dt>
														<dd><?php echo !empty($info['pack_pouch']) ? $info['pack_pouch'] : '미등록'; ?></dd>
													</dl>
													<dl>
														<dt>롤 필름</dt>
														<dd><?php echo !empty($info['pack_rollfilm']) ? $info['pack_rollfilm'] : '미등록'; ?></dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">기타 기계 <div>보유 현황</div></dt>
												<dd>
													<dl>
														<dt>냉동 기계</dt>
														<dd><?php echo !empty($info['freeze_machine']) ? $info['freeze_machine'] : '미등록'; ?></dd>
													</dl>
													<dl>
														<dt>기타 기계</dt>
														<dd><?php echo !empty($info['etc_machine']) ? $info['etc_machine'] : '미등록'; ?></dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">이물질 검출기 <div>보유 현황</div></dt>
												<dd>
													<dl>
														<dt>엑스레이 검출기</dt>
														<dd><?php echo !empty($info['detector_xray']) ? $info['detector_xray'] : '미등록'; ?></dd>
													</dl>
													<dl>
														<dt>금속 검출기</dt>
														<dd><?php echo !empty($info['detector_metal']) ? $info['detector_metal'] : '미등록'; ?></dd>
													</dl>
												</dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0">
										<h4>업체 등록 설비 정보</h4>
										<?php
											if(empty($facilities)) {
										?>
											<div class="nodata" style="display:block;"><div>등록된 설비 정보가 없습니다.</div></div>
										<?php
											}
											else {
										?>
											<ul class="fi-list">
												<?php
													foreach($facilities as $row) {
												?>
												<li>
													<div class="fi-wrap">
														<div class="fi-img"><img src="<?php echo !empty($row['facilities_img']) ? '/api/common/img_view?img_path=' . $row['facilities_img'] : '/assets/front/images/icon_noprofile.svg'; ?>" alt="<?php echo $row['facilities_name']; ?> 이미지" /></div>
														<dl>
															<dt><?php echo $row['facilities_name']; ?></dt>
															<dd>
																<ul>
																	<li><?php echo $row['facilities_summary']; ?></li>
																	<li><?php echo is_numeric($row['facilities_cnt']) ? '보유대수 : ' . $row['facilities_cnt'] . '대' : '미등록'; ?></li>
																</ul>
															</dd>
														</dl>
													</div>
												</li>

												<?php
													}
												?>
											</ul>
										<?php
											}
										?>
										</ul>
										<a href="javascript:;" class="btn-type5 btn-more">설비 정보 더보기</a>
									</div>
								</div>

								<!-- 인증/특허 정보 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>품질 정보 요약</h4>
										<div class="tb-type2">
											<dl>
												<dt class="btn-toggle"><span class="pc-only">인증 현황</span><span class="mo-only">품질 인증 정보</span></dt>
												<dd>
													<dl class="cer-wrap">
														<dt>HACCP 현황</dt>
														<dd>
															<div class="cer-list">
																<span><?php echo !empty($info['haccp']) ? $info['haccp'] : '미등록'; ?></span>
															</div>
														</dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">특허 현황</dt>
												<dd>
													<dl class="cer-wrap">
														<dt>기타 인증 현황</dt>
														<dd>
														<?php 
															if(empty($info['etc_cert1_name']) && empty($info['etc_cert2_name']) && empty($info['etc_cert3_name'])) {
														?>
															<div class="cer-list">
																<span>미등록</span>
															</div>
														<?php
															}
															else if(!empty($info['etc_cert1_name'])) {
														?>
															<div class="cer-list">
																<span><?php echo $info['etc_cert1_name']; ?></span>
															</div>
														<?php
															}
															else if(!empty($info['etc_cert2_name'])) {
														?>
															<div class="cer-list">
																<span><?php echo $info['etc_cert2_name']; ?></span>
															</div>
														<?php
															}
															else if(!empty($info['etc_cert3_name'])) {
														?>
															<div class="cer-list">
																<span><?php echo $info['etc_cert3_name']; ?></span>
															</div>
														<?php
															}
														?>
													</dl>
													<dl>
														<dt>특허 정보</dt>
														<dd><?php echo !empty($info['patent_cnt']) ? $info['patent_cnt'] : '미등록'; ?></dd>
													</dl>
												</dd>
											</dl>
										</div>
									</div>
									<div class="cont-box cer-cont-box bot0"><!-- 인증/특허정보 cer-cont-box -->
										<h4>업체 등록 인증 정보</h4>
										<?php
											if(empty($cert)) {
										?>
											<div class="nodata" style="display:block;"><div>등록된 인증 정보가 없습니다.</div></div>
										<?php
											}
											else {
										?>
										<div class="swiper cer-swiper cer-swiper1">
											<ul class="swiper-wrapper">
												<!-- sample 반복 -->
											<?php 
												foreach($cert as $row) {
											?>
												<li class="swiper-slide">
													<div class="cer-box">
														<div class="cer-img"><img src="<?php echo !empty($row['cert_img']) ? '/api/common/img_view?img_path=' . $row['cert_img'] : '/assets/front/images/icon_noprofile.svg'; ?>" alt="<?php echo $row['cert_name']; ?> 인증서이미지" /></div>
														<div class="cer-cont">
															<div class="name"><?php echo $row['cert_name']; ?></div>
															<div class="date"><?php echo $row['created_at']; ?></div>
														</div>
													</div>
												</li>
											<?php
												}
											?>
												<!-- //sample 반복 -->
											</ul>
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
										</div>
										<a href="javascript:;" class="btn-type5 btn-more">인증 정보  더보기</a>

										<?php
											}
										?>
									</div>
									<div class="cont-box cer-cont-box"><!-- 인증/특허정보 cer-cont-box -->
										<h4>업체 등록 특허 정보</h4>
										<?php
											if(empty($patent)) {
										?>
											<div class="nodata" style="display:block;"><div>등록된 특허 정보가 없습니다.</div></div>

										<?php
											}
											else {
										?>
											<div class="swiper cer-swiper cer-swiper2">
												<ul class="swiper-wrapper">
													<!-- sample 반복 -->
													<li class="swiper-slide">
														<div class="cer-box">
															<div class="cer-img"><img src="<?php echo !empty($row['cert_img']) ? '/api/common/img_view?img_path=' . $row['cert_img'] : '/assets/front/images/icon_noprofile.svg'; ?>" alt="<?php echo $row['cert_name']; ?> 인증서이미지" /></div>
															<div class="cer-cont">
																<div class="name"><?php echo $row['cert_name']; ?></div>
																<div class="date"><?php echo $row['created_at']; ?></div>
															</div>
														</div>
													</li>
													<!--// sample 반복 -->
												</ul>
												<script>
													var ww = $(window).width();
													var ceswiper2 = undefined;
													function initSwiper2() {
													if (ww <= 720 && ceswiper2 == undefined) {
														ceswiper2 = new Swiper(".cer-swiper2", {
														observer: true,
														observeParents: true,
														slidesPerView: 1.6,
														spaceBetween: 12,
														});
													} else if (ww > 720 && ceswiper2 != undefined) {
														ceswiper2.destroy();
														ceswiper2 = undefined;
													}
													}
													initSwiper2();
													$(window).on('resize', function () {
													ww = $(window).width();
													initSwiper2();
													});
												</script>
											</div>
											<a href="javascript:;" class="btn-type5 btn-more">특허 정보  더보기</a>
										<?php
											}
										?>

									</div>
								</div>

								<!-- 유통/수출 정보 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>유통 현황</h4>
										<div class="tb-type2">
											<dl>
												<dt class="btn-toggle">유통 채널</dt>
												<dd>
													<dl>
														<dt>입첨 채널</dt>
														<dd><div class="ov-x"><?php echo !empty($info['channel_info']) ? $info['channel_info'] : '미등록'; ?></div></dd>
													</dl>
													<dl>
														<dt>채널 별 경쟁 제품 현황</dt>
														<dd><div class="ov-x"><?php echo !empty($info['competitive_product']) ? $info['competitive_product'] : '미등록'; ?></div></dd>
													</dl>
												</dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0">
										<h4>수출 현황</h4>
										<div class="tb-type1">
											<dl>
												<dt>수출 국가</dt>
												<dd><div class="ov-x"><?php echo !empty($info['export_nation']) ? $info['export_nation'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt><span class="font-s">자사 제품 <span>수출 국가</span></span> </dt>
												<dd><div class="ov-x"><?php echo !empty($info['own_nation']) ? $info['own_nation'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt>수출 진행사항</dt>
												<dd><div class="ov-x"><?php echo !empty($info['export_progress']) ? $info['export_progress'] : '미등록'; ?></div></dd>
											</dl>
											<dl>
												<dt><span class="font-s">OEM 제품 <span>수출 국가</span></span> </dt>
												<dd><div class="ov-x"><?php echo !empty($info['oem_nation']) ? $info['oem_nation'] : '미등록'; ?></div></dd>
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
<form id="frmProduct" method="post"  action="/domestic/product_list">
	<input type="hidden" name="member_cd" value="<?php echo $info['member_cd']; ?>" />
	<input type="hidden" name="biz_no" value="<?php echo $info['biz_no']; ?>" />
	<input type="hidden" name="prod_type" value="" />
	<input type="hidden" name="detail_seq" value="" />
</form>

<form id="frmRequest" method="post"  action="/request/write">
	<input type="hidden" name="member_cd" value="<?php echo $info['member_cd']; ?>" />
	<input type="hidden" name="detail_seq" value="" />
	<input type="hidden" name="product_type" value="" />
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

function goProduct(sType) {
	$('#frmProduct input[name=prod_type]').val(sType);
	$('#frmProduct').submit();
}

function goProductDetail(sType, seq) {
	$('#frmProduct').attr('method', 'post');
	$('#frmProduct').attr('action', '/domestic/product_detail');
	$('#frmProduct input[name=prod_type]').val(sType);
	$('#frmProduct input[name=detail_seq]').val(seq);
	$('#frmProduct').submit();
}

</script>