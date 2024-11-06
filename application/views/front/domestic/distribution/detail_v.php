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
									<dt><?php echo $info['company_name']; ?> <span><?php echo $info['company_name_eng']; ?></span><a href="javascript:;" class="btn-like">관심기업</a></dt><!-- 관심기업 등록  class="on" common.js-->
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
								<a href="javascript:;" class="btn-inq">푸드플라넷에 <span>문의하기</span></a>
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
													<dt>연 매출</dt>
													<dd><?php echo $info['sales_year']; ?> <span class="desc">(단위 : 억원)</span></dd>
												</dl>
												<dl>
													<dt>영업이익</dt>
													<dd><?php echo $info['biz_profits']; ?> <span class="desc">(단위 : 억원)</span></dd>
												</dl>
											</div>
											<div class="tb-type1">											
												<dl>
													<dt>당기순이익</dt>
													<dd><?php echo $info['current_profits']; ?> <span class="desc">(단위 : 억원)</span></dd>
												</dl>
												<dl>
													<dt>신용등급</dt>
													<dd><span class="grade"><?php echo $info['credit_rating']; ?></span> <span class="desc">재무일 : <?php echo $info['base_year']; ?></span></dd>
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
												<dd><div class="ov-x"><?php echo $info['distribution_channel']; ?></div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box">
										<h4 class="pc-only">수출 현황</h4>
										<div class="tb-type1">
											<dl>
												<dt>수출 국가</dt>
												<dd><div class="ov-x"><?php echo $info['export_nation']; ?></div></dd>
											</dl>
										</div>
									</div>
								</div>

								<!-- 제품 정보 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>자사 제품 현황 및 정보</h4>
										<div class="tb-type1">
											<dl>
												<dt>자사 대표 제품</dt>
												<dd><div class="ov-x">꿀유자생강차, 캐모마일 릴렉싱 프레쉬, 파우치 음료 등</div></dd>
											</dl>
											<dl>
												<dt><span class="pc-only">채널 별 납품 현황 및 납품처</span><span class="mo-only">납품 현황, 납품처</span></dt>
												<dd><div class="ov-x">오프라인 마트(코스트코, 랜더스, S&R), 편의점(GS25 등)</div></dd>
											</dl>
											<dl>
												<dt>오더 납기 일자</dt>
												<dd><div class="ov-x">발주 후 5주 리드타임</div></dd>
											</dl>
											<dl>
												<dt>제품 <span class="pc-only">별</span> 오더 MOQ</dt>
												<dd><div class="ov-x">제품별 3,600병</div></dd>
											</dl>
											<dl>
												<dt>NB 제품 현황</dt>
												<dd><div class="ov-x">Balance Grow, MAMA’s CHOICE, 구쁘드</div></dd>
											</dl>
											<dl>
												<dt>제품 별 공급 단가</dt>
												<dd><div class="ov-x">제품별 상이</div></dd>
											</dl>
											<dl>
												<dt>용기 타입 및 입수</dt>
												<dd><div class="ov-x">유리병</div></dd>
											</dl>
											<dl>
												<dt>유통기한</dt>
												<dd><div class="ov-x">12개월</div></dd>
											</dl>
											<dl>
												<dt>식품 유형</dt>
												<dd><div class="ov-x">액상차류, 음료류, 커피류, 가공식품류</div></dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0">
										<h4>자사 제품 상세 정보</h4>
										<div class="nodata" style="display:none;"><div>등록된 자사 제품 정보가 없습니다.</div></div>
										<div class="swiper pro-swiper pro-swiper1">
											<ul class="swiper-wrapper">
												<li class="swiper-slide">
													<div class="pro-img"><img src="../resources/images/dummy_pro1.jpg" alt="{제품명}이미지" /></div>
													<div class="pro-cont">
														<div class="cate"> 액상차</div>
														<div class="name">꿀자몽차</div>
														<div class="wgt">1kg</div>
													</div>
												</li>
												<li class="swiper-slide">
													<div class="pro-img"><img src="../resources/images/dummy_pro2.jpg" alt="{제품명}이미지" /></div>
													<div class="pro-cont">
														<div class="cate"> 액상차</div>
														<div class="name">꿀유자생강차</div>
														<div class="wgt">1kg</div>
													</div>
												</li>
												<li class="swiper-slide">
													<div class="pro-img"><img src="../resources/images/dummy_pro3.jpg" alt="{제품명}이미지" /></div>
													<div class="pro-cont">
														<div class="cate"> 액상차</div>
														<div class="name">꿀레몬차</div>
														<div class="wgt">1kg</div>
													</div>
												</li>
												<li class="swiper-slide">
													<div class="pro-img"><img src="../resources/images/dummy_pro4.jpg" alt="{제품명}이미지" /></div>
													<div class="pro-cont">
														<div class="cate"> 액상차</div>
														<div class="name">꿀생강차</div>
														<div class="wgt">1kg</div>
													</div>
												</li>
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
										<a href="javascript:;" class="btn-type5 btn-more">자사 제품  더보기</a>
									</div>
									<div class="cont-box">
										<h4>위탁생산(OEM) 제품 현황 및 정보</h4>
										<div class="tb-type2">
											<dl>
												<dt class="btn-toggle"><span class="pc-only">제품 현황 및 정보</span><span class="mo-only">납품 현황, 납품처</span></dt>
												<dd>
													<dl>
														<dt>납품 현황 및 납품처</dt>
														<dd>Costco 납품</dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">오더 <div>정보</div></dt>
												<dd>
													<dl>
														<dt>오더 납기 일자</dt>
														<dd>발주 후 5주</dd>
													</dl>
													<dl>
														<dt>오더 MOQ</dt>
														<dd>3,600병</dd>
													</dl>
													<dl>
														<dt>타 기업 거래 현황</dt>
														<dd>Costco</dd>
													</dl>
													<dl>
														<dt><span class="font-s">준비중인 <span>신상품 현황</span></span></dt>
														<dd>없음</dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">타입 별 <div>제품 정보</div></dt>
												<dd>
													<dl>
														<dt>A타입별 세부 정보</dt>
														<dd>유리병 타입 2개입 포장</dd>
													</dl>
													<dl>
														<dt>B타입별 세부 정보</dt>
														<dd>유리병 타입 1개입 포장</dd>
													</dl>
													<dl>
														<dt>C타입별 세부 정보</dt>
														<dd>없음</dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">부자재 <div>정보</div></dt>
												<dd>
													<dl>
														<dt>부자재 발주 리드 타임</dt>
														<dd>동판 포함 4주</dd>
													</dl>
													<dl>
														<dt>부자재 MOQ</dt>
														<dd>유리병 7,200개</dd>
													</dl>
													<dl>
														<dt>부자재 별 단가</dt>
														<dd>3,500,000원 (유리병 7,200개)</dd>
													</dl>
												</dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0">
										<h4>위탁생산(OEM) 제품 상세 정보</h4>
										<div class="nodata" style="display:none;"><div>등록된 자사 제품 정보가 없습니다.</div></div>
										<div class="swiper pro-swiper pro-swiper2">
											<ul class="swiper-wrapper">
												<li class="swiper-slide">
													<div class="pro-img"><img src="../resources/images/dummy_pro5.jpg" alt="{제품명}이미지" /></div>
													<div class="pro-cont">
														<div class="cate"> 액상차</div>
														<div class="name">Honey Citron Tea</div>
														<div class="wgt">1kg</div>
													</div>
												</li>
												<li class="swiper-slide">
													<div class="pro-img"><img src="../resources/images/dummy_pro6.jpg" alt="{제품명}이미지" /></div>
													<div class="pro-cont">
														<div class="cate"> 액상차</div>
														<div class="name">Honey Ginger Tea</div>
														<div class="wgt">1kg</div>
													</div>
												</li>
												<li class="swiper-slide">
													<div class="pro-img"><img src="../resources/images/dummy_pro7.jpg" alt="{제품명}이미지" /></div>
													<div class="pro-cont">
														<div class="cate"> 액상차</div>
														<div class="name">Honey  Citron &amp; Ginger Tea</div>
														<div class="wgt">1kg</div>
													</div>
												</li>
												<li class="swiper-slide">
													<div class="pro-img"><img src="../resources/images/dummy_pro8.jpg" alt="{제품명}이미지" /></div>
													<div class="pro-cont">
														<div class="cate"> 액상차</div>
														<div class="name">Honey Citron Tea</div>
														<div class="wgt">1kg</div>
													</div>
												</li>
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
										<a href="javascript:;" class="btn-type5 btn-more">위탁 제품  더보기</a>
									</div>
								</div>

								<!-- 생산 정보 -->
								<div class="tab-cont">
									<div class="pi-info">
										<div class="clear">
											<div class="chart-area">
												<div class="title-area">
													<h5>일일 가능 생산량</h5>
													<div class="position">동종업체 <strong>상위 10%</strong> <span>14,500개</span></div>
												</div>
												<div class="chart bar">
													<span class="ho-line line1"></span>
													<span class="ho-line line2"></span>
													<span class="ho-line line3"></span>
													<span class="ho-line line4"></span>
													<span class="ho-line line5"></span>
													<dl class="data-mine">
														<dd>
															<div class="data-bar" style="height:70%;"><div class="blind">14,500</div></div>
														</dd>
														<dt>바이오포트코리아<div>14,500</div></dt>
													</dl>
													<dl class="data-aver1">
														<dd>
															<div class="data-bar" style="height:53%;"><div class="blind">12,000</div></div>
														</dd>
														<dt>동종 업종 평균<div>12,000</div></dt>
													</dl>
													<dl class="data-aver2">
														<dd>
															<div class="data-bar" style="height:35%;"><div class="blind">9,750</div></div>
														</dd>
														<dt>제조사 전체 평균<div>9,750</div></dt>
													</dl>
													<div class="standard">2022.10 기준</div>
												</div>
											</div>
											<div class="chart-area">
												<div class="title-area">
													<h5>현재 월 가능 생산량</h5>
													<div class="position">동종업체 <strong>상위 5%</strong> <span>10,000개</span></div>
												</div>
												<div class="chart bar">
													<span class="ho-line line1"></span>
													<span class="ho-line line2"></span>
													<span class="ho-line line3"></span>
													<span class="ho-line line4"></span>
													<span class="ho-line line5"></span>
													<dl class="data-mine">
														<dd>
															<div class="data-bar" style="height:52%;"><div class="blind">10,000</div></div>
														</dd>
														<dt>바이오포트코리아<div>10,000</div></dt>
													</dl>
													<dl class="data-aver1">
														<dd>
															<div class="data-bar" style="height:40%;"><div class="blind">6,000</div></div>
														</dd>
														<dt>동종 업종 평균<div>6,000</div></dt>
													</dl>
													<dl class="data-aver2">
														<dd>
															<div class="data-bar" style="height:48%;"><div class="blind">9,260</div></div>
														</dd>
														<dt>제조사 전체 평균<div>9,260</div></dt>
													</dl>
													<div class="standard">2022.10 3주차기준</div>
												</div>
											</div>
											<div class="chart-area">
												<div class="title-area">
													<h5>현재 월 창고 적재가능 수량</h5>
													<div class="position">동종업체 <strong>상위 65%</strong> <span>72,500개</span></div>
												</div>
												<div class="chart bar">
													<span class="ho-line line1"></span>
													<span class="ho-line line2"></span>
													<span class="ho-line line3"></span>
													<span class="ho-line line4"></span>
													<span class="ho-line line5"></span>
													<dl class="data-mine">
														<dd>
															<div class="data-bar" style="height:19%;"><div class="blind">10,000</div></div>
														</dd>
														<dt>바이오포트코리아<div>72,500</div></dt>
													</dl>
													<dl class="data-aver1">
														<dd>
															<div class="data-bar" style="height:35%;"><div class="blind">150,000</div></div>
														</dd>
														<dt>동종 업종 평균<div>150,000</div></dt>
													</dl>
													<dl class="data-aver2">
														<dd>
															<div class="data-bar" style="height:53%;"><div class="blind">194,000</div></div>
														</dd>
														<dt>제조사 전체 평균<div>194,000</div></dt>
													</dl>
													<div class="standard">2022.10 3주차기준</div>
												</div>
											</div>
										</div>
										<div class="chart-area">
											<div class="title-area">
												<h5>연간 생산 실적</h5>
												<div class="position">동종업체 <strong>상위 10%</strong> <span>3,000,000개</span></div>
											</div>
											<canvas id="chart1" class="chart-js"></canvas>
											<script>
												var ctx = document.getElementById('chart1').getContext('2d');
												var $labels_arr = ["<span>$0</span> None", "<span style='color:red'>$23.63</span> Handicap Accessible"];
												var chart = new Chart(ctx, {
													// The type of chart we want to create
													type: 'line',

													// The data for our dataset
													data: {
														labels: ["", "2016", "2017", "2018", "2019", "2020", "2021", "2022",  ""],//앞뒤 빈칸하나씩
														datasets: [{
															label: "My First dataset",
															backgroundColor: 'rgba(0, 207, 202, 0.2)',
															borderColor: 'rgb(0, 207, 202)',
															pointBackgroundColor: 'rgb(0, 207, 202)',
															data: [null, 1700000, 1900000, 2400000, 2000000, 2200000, 2700000, 3000000, null],//앞뒤 빈칸하나씩
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
														<div>1,700,000</div>
													</div>
												</li>
												<li>
													<div>
														<span>2017</span>
														<div>1,900,000</div>
													</div>
												</li>
												<li>
													<div>
														<span>2018</span>
														<div>2,400,000</div>
													</div>
												</li>
												<li>
													<div>
														<span>2019</span>
														<div>2,000,000</div>
													</div>
												</li>
												<li>
													<div>
														<span>2020</span>
														<div>2,200,000</div>
													</div>
												</li>
												<li>
													<div>
														<span>2021</span>
														<div>2,700,000</div>
													</div>
												</li>
												<li>
													<div>
														<span>2022</span>
														<div>3,000,000</div>
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
														<dd>총 2개</dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">포장 기계 <div>보유 현황</div></dt>
												<dd>
													<dl>
														<dt>밴드실러 기계</dt>
														<dd>없음</dd>
													</dl>
													<dl>
														<dt>용기용 포장 기계</dt>
														<dd>반자동 용기용 포장 기계</dd>
													</dl>
													<dl>
														<dt>로타리 포장 기계</dt>
														<dd>자동 로타리 포장 기계</dd>
													</dl>
													<dl>
														<dt>파우치 형태</dt>
														<dd>병</dd>
													</dl>
													<dl>
														<dt>롤 필름</dt>
														<dd>없음</dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">기타 기계 <div>보유 현황</div></dt>
												<dd>
													<dl>
														<dt>냉동 기계</dt>
														<dd>없음</dd>
													</dl>
													<dl>
														<dt>기타 기계</dt>
														<dd>없음</dd>
													</dl>
												</dd>
											</dl>
											<dl>
												<dt class="btn-toggle">이물질 검출기 <div>보유 현황</div></dt>
												<dd>
													<dl>
														<dt>엑스레이 검출기</dt>
														<dd>없음</dd>
													</dl>
													<dl>
														<dt>금속 검출기</dt>
														<dd>없음</dd>
													</dl>
												</dd>
											</dl>
										</div>
									</div>
									<div class="cont-box bot0">
										<h4>업체 등록 설비 정보</h4>
										<div class="nodata" style="display:none;"><div>등록된 설비 정보가 없습니다.</div></div>
										<ul class="fi-list">
											<li>
												<div class="fi-wrap">
													<div class="fi-img"><img src="../resources/images/dummy_fi01.jpg" alt="{설비명}이미지" /></div>
													<dl>
														<dt>배합 (배합탱크)</dt>
														<dd>
															<ul>
																<li>용량 : 5,000L</li>
																<li>보유대수 : 4대</li>
															</ul>
														</dd>
													</dl>
												</div>
											</li>
											<li>
												<div class="fi-wrap">
													<div class="fi-img"><img src="../resources/images/dummy_fi02.jpg" alt="{설비명}이미지" /></div>
													<dl>
														<dt>살균 공정 (튜블라살균기)</dt>
														<dd>
															<ul>
																<li>기기명 : 초고온 순간살균기 (UHT)</li>
																<li>보유대수 : 2대</li>
															</ul>
														</dd>
													</dl>
												</div>
											</li>
											<li>
												<div class="fi-wrap">
													<div class="fi-img"><img src="../resources/images/dummy_fi03.jpg" alt="{설비명}이미지" /></div>
													<dl>
														<dt>충진 (로터리)</dt>
														<dd>
															<ul>
																<li>기기명 : 액상충진기</li>
																<li>보유대수 : 4대</li>
															</ul>
														</dd>
													</dl>
												</div>
											</li>
											<li>
												<div class="fi-wrap">
													<div class="fi-img"><img src="../resources/images/dummy_fi04.jpg" alt="{설비명}이미지" /></div>
													<dl>
														<dt>냉각</dt>
														<dd>
															<ul>
																<li>기기명 : 냉각장치</li>
															</ul>
														</dd>
													</dl>
												</div>
											</li>
											<li>
												<div class="fi-wrap">
													<div class="fi-img"><img src="../resources/images/dummy_fi05.jpg" alt="{설비명}이미지" /></div>
													<dl>
														<dt>X-ray 검출기</dt>
														<dd>
															<ul>
																<li>기기명 X-ray 영상검출기</li>
															</ul>
														</dd>
													</dl>
												</div>
											</li>
											<li>
												<div class="fi-wrap">
													<div class="fi-img"><img src="../resources/images/dummy_fi06.jpg" alt="{설비명}이미지" /></div>
													<dl>
														<dt>금속 검출기</dt>
														<dd>
															<ul>
																<li>기기명 : 금속검출장비</li>
															</ul>
														</dd>
													</dl>
												</div>
											</li>
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
																<img src="../resources/images/img_cer1.png" alt="HACCP인증로고" />
																<span>HACCP 인증 완료 (총 9종)</span>
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
															<div class="cer-list">
																<img src="../resources/images/img_cer2.png" alt="FSSC22000 인증로고" />
																<span>FSSC22000 인증 완료</span>
															</div>
															<div class="cer-list">
																<img src="../resources/images/img_cer3.png" alt="HALAL 인증로고" />
																<span>HALAL 인증 완료</span>
															</div>
															<div class="cer-list">
																<img src="../resources/images/img_cer4.png" alt="KOSHER 인증로고" />
																<span>KOSHER 인증 완료</span>
															</div>
														</dd>
													</dl>
													<dl>
														<dt>특허 정보</dt>
														<dd>총 5종</dd>
													</dl>
												</dd>
											</dl>
										</div>
									</div>
									<div class="cont-box cer-cont-box bot0"><!-- 인증/특허정보 cer-cont-box -->
										<h4>업체 등록 인증 정보</h4>
										<div class="nodata" style="display:none;"><div>등록된 인증 정보가 없습니다.</div></div>
										<div class="swiper cer-swiper cer-swiper1">
											<ul class="swiper-wrapper">
												<!-- sample 반복 -->
												<li class="swiper-slide">
													<div class="cer-box">
														<div class="cer-img"><img src="../resources/images/dummy_cer1.jpg" alt="{인증명}인증서이미지" /></div>
														<div class="cer-cont">
															<div class="name">HALAL 인증</div>
															<div class="date">2022,03,15</div>
														</div>
													</div>
												</li>
												<!-- //sample 반복 -->
												<li class="swiper-slide">
													<div class="cer-box">
														<div class="cer-img"><img src="../resources/images/dummy_cer2.jpg" alt="{인증명}인증서이미지" /></div>
														<div class="cer-cont">
															<div class="name">코셔</div>
															<div class="date">2022,03,15</div>
														</div>
													</div>
												</li>
												<li class="swiper-slide">
													<div class="cer-box">
														<div class="cer-img"><img src="../resources/images/dummy_cer3.jpg" alt="{인증명}인증서이미지" /></div>
														<div class="cer-cont">
															<div class="name">FSSC22000</div>
															<div class="date">2022,03,15</div>
														</div>
													</div>
												</li>
												<li class="swiper-slide">
													<div class="cer-box">
														<div class="cer-img"><img src="../resources/images/dummy_cer1.jpg" alt="{인증명}인증서이미지" /></div>
														<div class="cer-cont">
															<div class="name">HALAL 인증</div>
															<div class="date">2022,03,15</div>
														</div>
													</div>
												</li>
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
									</div>
									<div class="cont-box cer-cont-box"><!-- 인증/특허정보 cer-cont-box -->
										<h4>업체 등록 특허 정보</h4>
										<div class="nodata" style="display:none;"><div>등록된 특허 정보가 없습니다.</div></div>
										<div class="swiper cer-swiper cer-swiper2">
											<ul class="swiper-wrapper">
												<!-- sample 반복 -->
												<li class="swiper-slide">
													<div class="cer-box">
														<div class="cer-img"><img src="../resources/images/dummy_pat1.jpg" alt="{특허명}특허증이미지" /></div>
														<div class="cer-cont">
															<div class="name">오미자 추출물을 포함하는 관절염 관절염 관절염 관절염 관절염</div>
															<div class="date">2021,10,08</div>
														</div>
													</div>
												</li>
												<!--// sample 반복 -->
												<li class="swiper-slide">
													<div class="cer-box">
														<div class="cer-img"><img src="../resources/images/dummy_pat2.jpg" alt="{특허명}특허증이미지" /></div>
														<div class="cer-cont">
															<div class="name">오미자 추출물을 포함하는 근위축 오미자 추출물을 포함하는 근위축</div>
															<div class="date">2021,10,08</div>
														</div>
													</div>
												</li>
												<li class="swiper-slide">
													<div class="cer-box">
														<div class="cer-img"><img src="../resources/images/dummy_pat3.jpg" alt="{특허명}특허증이미지" /></div>
														<div class="cer-cont">
															<div class="name">유근피 추출물을 유효성분으로 유근피 추출물을 유효성분으로</div>
															<div class="date">2021,10,08</div>
														</div>
													</div>
												</li>
												<li class="swiper-slide">
													<div class="cer-box">
														<div class="cer-img"><img src="../resources/images/dummy_pat1.jpg" alt="{특허명}특허증이미지" /></div>
														<div class="cer-cont">
															<div class="name">오미자 추출물을 포함하는 관절염 관절염 관절염 관절염 관절염</div>
															<div class="date">2021,10,08</div>
														</div>
													</div>
												</li>
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
														<dd><div class="ov-x">Costco, GS25, 세븐일레븐</div></dd>
													</dl>
													<dl>
														<dt>채널 별 경쟁 제품 현황</dt>
														<dd><div class="ov-x">주요 국가 Amazon 내 상품</div></dd>
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
												<dd><div class="ov-x">미국, 중국, 필리핀, 대만, 호주, 영국 등</div></dd>
											</dl>
											<dl>
												<dt><span class="font-s">자사 제품 <span>수출 국가</span></span> </dt>
												<dd><div class="ov-x">미국, 필리핀</div></dd>
											</dl>
											<dl>
												<dt>수출 진행사항</dt>
												<dd><div class="ov-x">EU 수출 준비 중 (2022년 10월 기준)</div></dd>
											</dl>
											<dl>
												<dt><span class="font-s">OEM 제품 <span>수출 국가</span></span> </dt>
												<dd><div class="ov-x">중국, 대만, 호주, 영국</div></dd>
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
	<input type="hidden" name="biz_no" value="<?php echo $info['biz_no']; ?>" />
	<input type="hidden" name="prod_type" value="" />
	<input type="hidden" name="detail_seq" value="" />
</form>

<form id="frmRequest" method="post"  action="/request/write">
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

			$.ajax({
					url: "/api/domestic/manufacture/list_detail",
					type: "POST",
					data: {target_cd : '<?php echo $info['biz_no']; ?>', is_wish : isWish},
					async : false,
					dataType : 'json';
					success: function(data) {
						if(data.result == 'fail') {
							showAlert(data.msg);
						}
						else {
							if($(this).hasClass("on")){
								$(this).removeClass("on");
							}else{
								$(this).addClass("on");
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