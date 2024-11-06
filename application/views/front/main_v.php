<link rel="stylesheet" type="text/css" href="/assets/front/css/main.css" /><!-- main.css -->

<div class="container">
		<div class="main-container">
			<a href="/company/guide" class="quick-banner"><img src="/assets/front/images/quick_banner.png"  alt="푸드플라넷이 처음이신가요?" /></a>
			
			<!-- 메인 비주얼 배너 -->
			<div class="kv">
				<div class="swiper swiper-kv">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<img src="/assets/front/images/kv1.jpg" alt="kv" class="pc-only" />
						</div>
						<div class="swiper-slide">
							<img src="/assets/front/images/kv2.jpg" alt="kv" class="pc-only" />
						</div>
					</div>
<!--					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div> -->
				</div>
				<script>
/*					  var swiperKv = new Swiper(".swiper-kv", {
						observer: true,
						observeParents: true,
						loop: true,
						speed: 1000,
						slidesPerView: 1,
						spaceBetween: 0,
						effect: "fade",
						navigation: {
							nextEl: ".swiper-kv .swiper-button-next",
							prevEl: ".swiper-kv .swiper-button-prev",
						},
						autoplay: {
							delay: 2500,
							disableOnInteraction: false,
						},
					  }); */
				</script>
			</div>

			<!-- 메인 검색 -->
			<div class="main-contents fp-search">
				<div class="inner">
					<div class="searchbox">
						<input type="text" value="" placeholder="검색어를 입력해주세요." class="ip-search" onkeypress="javascript:if(event.keyCode == 13) { goSearch($(this).val());  return false; };"  >
						<button class="btn-reset" style="display: none;"><img src="/assets/front/images/btn_clear.svg" alt="검색어삭제"></button>
					</div>
					<dl>
						<dt>AI 추천 검색어</dt>
						<dd>
						<?php 
							foreach($search  as $row) {
								echo '<a href="#" onclick="javascript:goSearch(\'' . $row['keyword'] . '\'); return false;">' . $row['keyword'] . '</a>';
							}
						?>
						</dd>
					</dl>
				</div>
			</div>

			<!-- 회사 소개 -->
			<div class="main-contents fp-intro">
				<div class="inner">
					<h3>실용 데이터 솔루션, <span>푸드플라넷</span></h3>
					<div class="sub-h3"><span>국내외 100만 개 이상의 가공식품 제조사, </span>유통사, 제품 데이터를 제공하는 푸드플라넷<br />제조, 유통, 수출에 필요한 <span>실용 데이터를 확인해 보세요!</span></div>
					<div class="swiper swiper-intro">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<img src="/assets/front/images/icon_intro1.png" alt="" />
							<dl>
								<dt>국내 데이터</dt>
								<dd>시장의 요구사항에 대응하는<div>제조사, 유통사 데이터로</div>생산 능력 및 시장규모 파악 가능</dd>
							</dl>
						</div>
						<div class="swiper-slide">
							<img src="/assets/front/images/icon_intro3.png" alt="" />
							<dl>
								<dt>제품 데이터</dt>
								<dd>제품 발주 시 꼭 필요한 공급단가,<div>MOQ는 물론 납기일자, 채널별 납품현황</div>등의 유통 필수 데이터 제공</dd>
							</dl>
						</div>
						<div class="swiper-slide">
							<img src="/assets/front/images/icon_intro2.png" alt="" />
							<dl>
								<dt>해외 데이터</dt>
								<dd>수출에 필요한 주요 국가별 수출 정보부터<div>품목별 수출에 필요한 각종 서류, 법령 정보는</div>물론 시장 동향, 바이어 정보까지 제공</dd>
							</dl>
						</div>
						<div class="swiper-slide">
							<img src="/assets/front/images/icon_intro4.png" alt="" />
							<dl>
								<dt>분석 리포트</dt>
								<dd>푸드플라넷 표준 데이터를 기반으로<div>식품별 시장 동향, 전망 및 제조사 데이터</div>맞춤형 시장 전망 보고서로 제공</dd>
							</dl>
						</div>
					</div>
					<div class="swiper-pagination"></div>
				</div>
				<script>
					  var swiperIntro = new Swiper(".swiper-intro", {
						observer: true,
						observeParents: true,
						loop: true,
						speed: 500,
						slidesPerView: 1,
						pagination: {
							el: ".fp-intro .swiper-pagination",
						},
						breakpoints: {
							900: {
							  slidesPerView: 4,
							  loop: false,
							  autoplay:false,
							}
						  },
						/*autoplay: {
							delay: 2000,
							disableOnInteraction: false,
						},*/
					  });
				</script>
				</div>
			</div>

			<!-- 서비스 소개 -->
			<div class="main-contents fp-service">
				<div class="inner">
					<h3>이런 서비스 어떠세요?</h3>
					<div class="swiper swiper-service">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<dl onclick="javascript:location.href='/domestic/manufacture/list';" style="cursor:pointer">
									<dt>
										<div>
											<div>우리 회사에 맞는<div>제조사·유통사 찾기</div></div>
										</div>
									</dt>
									<dd>식품산업 현장에서 필요한<div>실용 데이터!</div>카테고리 분류로 원하는<div>정보를 쉽게 검색</div></dd>
								</dl>
							</div>
							<div class="swiper-slide">
								<dl onclick="javascript:location.href='/product/list';" style="cursor:pointer">
									<dt>
										<div>
											<div>제품 데이터 보기</div>
										</div>
									</dt>
									<dd>기업별, 카테고리별로<div>수많은 제품 데이터를</div>손쉽게 확인!<div>제품별 제조사까지 검색 가능!</div></dd>
								</dl>
							</div>
							<div class="swiper-slide">
								<dl onclick="javascript:fnGoQna();" style="cursor:pointer">
									<dt>
										<div>
											<div>우리 회사에 맞는<div>제조사·유통사</div>매칭요청하기</div>
										</div>
									</dt>
									<dd>제품을 소싱하고 싶어요!<div>해외 수출에 관심이 있어요!</div>비즈니스 니즈에 가장 잘 맞는<div>파트너와 연결해 드립니다.</div></dd>
								</dl>
							</div>
							<div class="swiper-slide">
								<dl onclick="javascript:fnGoQna();" style="cursor:pointer">
									<dt>
										<div>
											<div>요청하기</div>
										</div>
									</dt>
									<dd>새로운 제품을<div>출시하고 싶어요!</div>제품 기획부터 수출까지<div>모든 과정을 한 번에!</div></dd>
								</dl>
							</div>
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<script>
						  var swiperService = new Swiper(".swiper-service", {
							observer: true,
							observeParents: true,
							loop: true,
							speed: 500,
							slidesPerView: 1,
							spaceBetween: 29,
							pagination: {
								el: ".fp-service .swiper-pagination",
							},
							breakpoints: {
								900: {
								  slidesPerView: 4,
								  loop: false,
								  autoplay:false,
								}
							  },
						  });
					</script>
				</div>
			</div>

			<!-- 추천 신제품 -->
			<div class="main-contents fp-new">
				<div class="inner">
					<h3>추천 신제품</h3>
					<div class="sub-h3">푸드플라넷이 추천드리는 <span>금주의 신제품 TOP 5를 소개합니다.</span></div>
					<div class="newp-wrap">
						<div class="swiper swiper-newp">
							<div class="swiper-wrapper">
							<?php
								foreach($product as $row) {
							?>
								<div class="swiper-slide">
									<div class="img"><img src="<?php echo $row['prod_img']; ?>" alt="추천 신제품" /></div>
									<div class="pro-maker"><?php echo $row['company_name']; ?></div>
									<div class="pro-title"><?php echo $row['product_name']; ?></div>
									<a href="/product/detail/<?php echo $row['product_type2'] === '1' ? 'nb' : 'oem'; ?>/<?php echo $row['product_seq']; ?>" class="btn-more">more</a>
								</div>
							<?php
								}
							?>
							</div>
						</div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
						<script>
							  var swiperNewp = new Swiper(".swiper-newp", {
								observer: true,
								observeParents: true,
								loop: true,
								speed: 1000,
								slidesPerView: 2,
								centeredSlides: true,
								spaceBetween: 0,
								navigation: {
									nextEl: ".fp-new .swiper-button-next",
									prevEl: ".fp-new .swiper-button-prev",
								},
								breakpoints: {
									900: {
									  slidesPerView: 5,
									  centeredSlides: false,
									  spaceBetween: 0,
									}
								},
							  });
						</script>
					</div>
				</div>
			</div>

			<!-- 츠찬/키워드 -->
			<div class="main-contents fp-recom">
				<div class="inner">
					<div class="clear">
						<div class="reco-wrap">
							<h3>추천 <strong>제조사</strong></h3>
							<div class="img"><img src="<?php echo $company['img_url']; ?>" alt="추천제조사"></div>
							<dl>
								<dt><?php echo $company['title']; ?></dt>
								<dd>
									<div class="cont"><?php echo nl2br($company['desc']); ?></div>
									<a href="#" onclick="javascript:$('#frmRecommendCompanyLink').submit(); return false;" class="btn-more">자세히보기</a>
									<form id="frmRecommendCompanyLink" method="post" action="/domestic/manufacture/detail">
										<input type="hidden" name="biz_no" value="<?php echo $company['link_url']; ?>" />
									</form>
									
								</dd>
							</dl>
						</div>
						<div class="reco-wrap notice">
							<h3>추천 <strong>공고</strong></h3>
							<div class="img"><img src="<?php echo $notice['img_url']; ?>" alt="추천제조사"></div>
							<dl>
								<dt><?php echo $notice['title']; ?></dt>
								<dd>
									<div class="cont"><?php echo nl2br($notice['desc']); ?></div>
									<a href="<?php echo $notice['link_url']; ?>" class="btn-more">자세히보기</a>
								</dd>
							</dl>
						</div>
						<div class="reco-wrap keywords">
							<h3>인기 키워드 <strong>TOP 10</strong></h3>
							<div class="key-wrap">
								<dl>
									<dt><div>제품</div></dt>
									<dd>
										<ol>
										<?php 
											$idx = 1;
											foreach($keyword1 as $row) {
												echo '<li><a href="#" onclick="javascript:goSearch(\'' . $row['keyword'] . '\'); return false;"><span>' . ($idx++) . '.</span>' . $row['keyword'] . '</a></li>';
											}
										?>
										</ol>
									</dd>
								</dl>
								<dl>
									<dt><div>태그</div></dt>
									<dd>
										<ol>
										<?php 
											$idx = 1;
											foreach($keyword2 as $row) {
												echo '<li><a href="#" onclick="javascript:goSearch(\'' . $row['keyword'] . '\'); return false;"><span>' . ($idx++) . '.</span>' . $row['keyword'] . '</a></li>';
											}
										?>
										</ol>
									</dd>
								</dl>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- 설명 -->
			<div class="main-contents fp-intro2">
				<div class="inner">
					<div class="sub-h3">현장에 필요한 맞춤형 실용 데이터부터 <span>제품 기획, 제조, 유통, 수출까지</span></div>
					<h3>가공식품 산업의 모든 것, <span>지금 <strong>푸드플라넷</strong>과 함께 하세요.</span></h3>
					<div class="swiper swiper-intro2">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<img src="/assets/front/images/icon_desc1.png" alt="" />
								<dl>
									<dt>
										<div>
											<div>
												현장에 필요한<div>맞춤형 실용 데이터</div>
											</div>
										</div>
									</dt>
									<dd>제조사·유통사·원료·부자재 공급사<div>국내외 시장  동향, 수출, 인증 등</div></dd>
								</dl>
<!--								<a href="javascript:;" class="btn-more">more</a> -->
							</div>
							<div class="swiper-slide">
								<img src="/assets/front/images/icon_desc2.png" alt="" />
								<dl>
									<dt>
										<div>
											<div>
												식품 비지니스<div>전문성</div>
											</div>
										</div>
									</dt>
									<dd>식품 관세사 ∙ 식품 전문가들이 <div>함께 합니다</div></dd>
								</dl>
<!--								<a href="javascript:;" class="btn-more">more</a> -->
							</div>
							<div class="swiper-slide">
								<img src="/assets/front/images/icon_desc3.png" alt="" />
								<dl>
									<dt>
										<div>
											<div>
												고객사와 동반성장
											</div>
										</div>
									</dt>
									<dd>고객사의 시장 진출과 <div>성장을 돕습니다</div></dd>
								</dl>
<!--								<a href="javascript:;" class="btn-more">more</a> -->
						</div>
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<script>
						  var swiperIntro2 = new Swiper(".swiper-intro2", {
							observer: true,
							observeParents: true,
							loop: true,
							speed: 500,
							slidesPerView: 1,
							spaceBetween: 20,
							pagination: {
								el: ".fp-intro2 .swiper-pagination",
							},
							breakpoints: {
								900: {
								  slidesPerView: 3,
								  loop: false,
								  autoplay:false,
								  spaceBetween: 117,
								}
							  },
						  });
					</script>
				</div>
			</div>

			<!-- 멤버쉽 -->
			<div class="main-contents fp-join">
				<div class="inner">
					<span>멤버쉽 가입하고 <span>지금 시작하세요!</span></span>
					<a href="/join/step1">멤버쉽 가입하기</a>
				</div>
			</div>

			<!-- 생생후기 -->
			<div class="main-contents fp-review">
				<div class="inner">
					<h3>회원사의 생생후기</h3>
					<div class="swiper swiper-review">
						<div class="swiper-wrapper">
						<?php
							foreach($review as $row) {
						?>
							<div class="swiper-slide">
								<dl>
									<dt><?php echo $row['title']; ?></dt>
									<dd>
										<div class="cont"><?php echo nl2br($row['desc']); ?></div>
										<a href="<?php echo $row['link_url']; ?>" class="btn-more">자세히보기</a>
									</dd>
								</dl>
							</div>
						<?php
							}
						?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<script>
						  var swiperReview = new Swiper(".swiper-review", {
							observer: true,
							observeParents: true,
							loop: true,
							speed: 500,
							slidesPerView: 1,
							spaceBetween: 26,
							pagination: {
								el: ".fp-review .swiper-pagination",
							},
							breakpoints: {
								900: {
								  slidesPerView: 4,
								  loop: false,
								  autoplay:false,
								}
							  },
						  });
					</script>
				</div>
			</div>

			<!-- 뉴스레터  -->
			<div class="main-contents fp-letter">
				<div class="inner">
					<h3>Newsletter request</h3>
					<div class="sub-h3"><span>식품 비즈니스 트렌드와 </span>인사이트가 궁금하신가요?<div>지금 <strong>뉴스레터</strong>를 <span>신청하세요!</span></div></div>
					<div class="letter-area">
						<input type="text" class="ip-mail" id="newsletter_email" placeholder="이메일 주소" />
						<a href="#" onclick="javascript:fnNewsletter(); return false;" class="btn-apply">구독 신청</a>
					</div>
					<div class="letter-agree">
						<label class="agree">
							<input type="checkbox" id="newsletter_agree" />
							<span>개인정보처리방침 이용동의</span>
						</label>
						<a href="javascript:;" class="btn-layer" data-link="#layer-privacy">[ 자세히 ]</a>
					</div>
				</div>
			</div>
		</div>
	</div>

<script>
function fnNewsletter() {
	if(!$('#newsletter_agree').is(':checked')) {
		showAlert('개인정보 처리방침에 동의해 주세요.');
		return;
	}
	if($('#newsletter_email').val() == '') {
		showAlert('이메일을 입력해 주세요.');
		return;
	}
	if(!fnCheckEmail($('#newsletter_email').val())) {
		showAlert('이메일 형식이 올바르지 않습니다.');
		return;
	}

	$.ajax({
		url: "/api/common/newsletter",
		type: "POST",
		data: { 'email' : $('#newsletter_email').val() },
		dataType: "JSON",
		async : false,
		success: function(data) {
			showAlert(data.msg);
			if(data.result == 'succ') {
				$('#newsletter_email').val('');
				$('#newsletter_agree').prop('checked', false);
			}
		},
		error: function(result) {
			showAlert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
		}
	});
}
</script>