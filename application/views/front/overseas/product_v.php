<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="data-detail overseas products"><!-- 해외데이터 class="overseas" --><!-- 품목 class="products" -->
				<div class="sub-visual" style="background:url(<?php echo !empty($info['background_img']) ? '/api/common/img_view?img_path=' . $info['background_img'] : ''; ?>) center center no-repeat;background-size:cover;">
					<img src="/assets/front/images/bg_sv_detail_pr1_m.jpg" alt="해외데이터 품목 상세 bg" class="mo-only" />
				</div>
				<div class="inner">
					<div class="detail-area">
						<div class="detail-info">
							<div class="company-profile clear">
								<div class="profile-img">
								<?php echo !empty($info['product_img']) ? '<img src="/api/common/img_view?img_path=' . $info['product_img'] . '" alt="품목이미지" />' : ''; ?>
								</div>
								<dl class="profie-info">
									<dt><?php echo $info['product_name']; ?> <span><?php echo $info['product_name_eng']; ?></span></dt>
									<dd>
										<div><?php echo $info['desc']; ?></div>
									</dd>
								</dl>
							</div>
							<a href="javascript:;" class="mo-only btn-toggle btn-detail">상세 정보</a>
							<div class="pc-only detail-company clear">
								<div>
									<dl>
										<dt>소속 HS Code</dt>
										<dd><?php echo $info['hscode']; ?></dd>
									</dl>
									<dl>
										<dt><?php echo $nation['nation_name']; ?> HS Code</dt>
										<dd><?php echo $info['hscode_nation']; ?></dd>
									</dl>
									<dl>
										<dt>세율</dt>
										<dd><?php echo $info['tax_rate']; ?></dd>
									</dl>
								</div>
								<div class="btn-area mo-only">
									<a href="javascript:;" class="btn-type5 btn-chk-nat">수출 국가 선택</a>
								</div>
								<dl class="filter-nat">
									<dt>수출 국가 선택</dt>
									<dd>
										<ul class="clear">
										<li>
												<input type="radio" id="nat1" name="filter_nat" /><!-- 20230324 checkbox > radio 일괄변경  -->
												<label for="nat1"><span class="nat-tag"><img src="/assets/front/images/flag_nat1.png" /></span><span>미국</span></label>
											</li>
											<li>
												<input type="radio" id="nat2" name="filter_nat" />
												<label for="nat2"><span class="nat-tag"><img src="/assets/front/images/flag_nat2.png" /></span><span>중국</span></label>
											</li>
											<li>
												<input type="radio" id="nat3" name="filter_nat" />
												<label for="nat3"><span class="nat-tag"><img src="/assets/front/images/flag_nat3.png" /></span><span>일본</span></label>
											</li>
											<li>
												<input type="radio" id="nat4" name="filter_nat" />
												<label for="nat4"><span class="nat-tag"><img src="/assets/front/images/flag_nat4.png" /></span><span>대만</span></label>
											</li>
											<li>
												<input type="radio" id="nat5" name="filter_nat" />
												<label for="nat5"><span class="nat-tag"><img src="/assets/front/images/flag_nat5.png" /></span><span>베트남</span></label>
											</li>
											<li>
												<input type="radio" id="nat6" name="filter_nat" />
												<label for="nat6"><span class="nat-tag"><img src="/assets/front/images/flag_nat6.png" /></span><span>홍콩</span></label>
											</li>
											<li>
												<input type="radio" id="nat8" name="filter_nat" />
												<label for="nat8"><span class="nat-tag"><img src="/assets/front/images/flag_nat8.png" /></span><span>인도네시아</span></label>
											</li>
											<li>
												<input type="radio" id="nat9" name="filter_nat" />
												<label for="nat9"><span class="nat-tag"><img src="/assets/front/images/flag_nat9.png" /></span><span>러시아</span></label>
											</li>
											<li>
												<input type="radio" id="nat10" name="filter_nat" />
												<label for="nat10"><span class="nat-tag"><img src="/assets/front/images/flag_nat11.png" /></span><span>EU</span></label>
											</li>
										</ul>
										<a href="javascript:;" class="nat-reset"><span class="pc-only">초기화</span></a>
										<a href="javascript:;" class="btn-type4 btn-submit">완료</a><!-- D: 리스트필터와 동일하게 완료버튼에 닫기기능 연결했습니다. common.js 국가필터선택완료 -->
									</dd>
								</dl>
							</div>
						</div>
						<div class="tab-area">
							<div class="swiper-container tabs">
								<ul class="tabs-wrapper swiper-wrapper">
									<li class="swiper-slide on"><a href="javascript:;"><span class="pc-only">품목별 소속 </span>HS CODE</a></li>
									<li class="swiper-slide"><a href="javascript:;"><span class="pc-only">수입지 </span>수입제한요건</a></li>
									<li class="swiper-slide"><a href="javascript:;"><span class="pc-only">수입제한요건 </span>표준화서류</a></li>
									<li class="swiper-slide"><a href="javascript:;">시장 동향</a></li>
									<li class="swiper-slide"><a href="javascript:;">바이어 정보</a></li>
								</ul>
							</div>
							<div class="tab-container">
								<!-- HS CODE -->
								<div class="tab-cont on">
									<div class="cont-box">
										<h4><span><?php echo $info['product_name']; ?></span>의 HS CODE에 따른 상품 개요</h4>
										<div class="tb-type1 type2">
										<?php
											foreach($pi02 as $row) {
										?>
											<dl>
												<dt><?php echo $row['hscode']; ?></dt>
												<dd><?php echo $row['desc']; ?></dd>
											</dl>
										<?php
											}
										?>
										</div>
									</div>
								</div>

								<!-- 수입제한조건 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>수입 제한 요건</h4>
										<div class="tb-type4 type3">
											<ul class="tb-title clear">
												<li>구분</li>
												<li>품목명</li>
												<li>관련 HS 요건</li>
												<li>제목</li>
											</ul>
											<ul class="tb-list-cont">
												<!-- sample 반복 -->
											<?php
												$idx = 1;
												foreach($ei01 as $row) {
											?>
												<li>
													<div class="tb-wrap">
														<div class="num"><?php echo $idx++; ?></div>
														<div class="pro1"><?php echo $row['product_name']; ?></div>
														<div class="title"><a href="#" onclick="javascript:fnShowEi01('<?php echo str_replace('"', '\\\'', json_encode($row)); ?>'); return false;" data-link="#layer-restrict" class="btn-pc-layer"><?php echo $row['title']; ?></a></div>
														<div class="pro2"><?php echo $row['hscode']; ?></div>
													</div>
												</li>
											<?php
												}
											?>
												<!-- //sample 반복 -->
											</ul>
										</div>
<!--									<div class="btn-more-box"><a href="javascript:;" class="btn-type5">More</a></div> -->
									</div>
								</div>

								<!-- 수입제한조건 표준화서류 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>표준화 서류</h4>
										<div class="tb-type4 type3">
											<ul class="tb-title clear">
												<li>구분</li>
												<li>국가명</li>
												<li>관련 HS CODE</li>
												<li>근거 법령</li>
											</ul>
											<ul class="tb-list-cont">
												<!-- sample 반복 -->
											<?php 
												foreach($ei02 as $row) {
											?>
												<li>
													<div class="tb-wrap">
														<div class="num">1</div>
														<div class="pro1"><?php echo $row['nation_name']; ?></div>
														<div class="title"><a href="#" onclick="javascript:fnShowEi02('<?php echo str_replace('"', '\\\'', json_encode($row)); ?>'); return false;" data-link="#layer-restrict2" class="btn-pc-layer"><?php echo $row['law']; ?></a></div><!-- 20230324 링크수정 -->
														<div class="pro2"><?php echo $row['hscode']; ?></div>
													</div>
												</li>

											<?php
												}
											?>
												<!-- //sample 반복 -->

											</ul>
										</div>
<!--										<div class="btn-more-box"><a href="javascript:;" class="btn-type5">More</a></div> -->
									</div>
								</div>

								<!-- 시장동향 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>시장 동향</h4>
										<div class="tb-type3 type2">
											<ul class="detail-title clear">
												<li>번호</li>
												<li>제목</li>
												<li>조회수</li>
											</ul>
											<div class="detail-cont">
											<?php
												$idx = 1;
												foreach($mi01 as $row) {
													echo '<ul>';
													echo '	<li>' . $idx++ . '</li>';
													echo '	<li><a href="#" onclick="javascript:fnLink(\'' . $row['seq']  . '\', \'' . $row['url_link'] . '\'); return false">' . $row['title'] . '</a></li>';
													echo '	<li>' . number_format($row['hit_cnt']) . '</li>';
													echo '</ul>';
												}
											?>
											</div>
										</div>
										<div class="btn-more-box"><a href="javascript:;" class="btn-type5">More</a></div>
									</div>
								</div>

								<!-- 바이어 정보 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>바이어 정보</h4>
										<div class="tb-type4 type2">
											<ul class="tb-title clear">
												<li>Company Name</li>
												<li>CEO</li>
												<li>Category</li>
												<li>HS CODE</li>
												<li>Volume of order</li>
												<li>Available Period</li>
											</ul>
											<ul class="tb-list-cont">
												<!-- sample 반복 -->
												<?php
													foreach($bi as $row) {
												?>
												<li>
													<dl>
														<dt class="btn-tb-list">
															<div class="title"><?php echo $row['company_name']; ?></div>
															<div class="cate1 mo-only"><?php  echo $row['ceo_name']; ?></div>
															<div class="cate2 mo-only"><?php echo $row['category']; ?></div>
															<a href="#" onclick="javascript:fnShowBuyer('<?php echo str_replace('"', '\\\'', json_encode($row)); ?>'); return false;" data-link="#layer-buyer" class="btn-pc-layer pc-only"><span class="blind">바이어 정보</span></a>
														</dt>
														<dd>
															<dl>
																<dt>CEO</dt>
																<dd><?php  echo $row['ceo_name']; ?></dd>
															</dl>
															<dl>
																<dt>Category</dt>
																<dd><?php echo $row['category']; ?></dd>
															</dl>
															<dl>
																<dt>HS CODE</dt>
																<dd><?php echo $row['category_hscode']; ?></dd>
															</dl>
															<dl>
																<dt>Volume of order</dt>
																<dd><?php  echo $row['trade_volume']; ?></dd>
															</dl>
															<dl>
																<dt>Available Period</dt>
																<dd><?php  echo $row['available_period']; ?></dd>
															</dl>
															<a href="#" onclick="javascript:fnShowBuyer('<?php echo str_replace('"', '\\\'', json_encode($row)); ?>'); return false" data-link="#layer-buyer" class="btn-pc-layer btn-layer"><span class="blind">바이어 정보</span></a>
														</dd>
													</dl>
												</li>
												<?php 	} ?>
												<!-- sample 반복 -->

											</ul>
										</div>
<!--										<div class="btn-more-box"><a href="javascript:;" class="btn-type5">More</a></div> -->
									</div>
								</div>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
function fnLink(seq, link) {
	window.open(link, '_blank');

	$.ajax({
			url: "/overseas/hit_cnt",
			type: "POST",
			data: {seq : seq},
			dataType : 'json',
			success: function(data) {
//				location.href = link;
			},
			error: function(result) {
//				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});

}

function fnShowBuyer(data) {
	data = data.replace(/'/g, '"');
	data =  JSON.parse(data);

	$('#company_name_title').html(data.company_name);
	$('#company_name').html(data.company_name);
	$('#buy_product').html(data.buy_product);
	$('#desc').html(data.desc);
	$('#trade_condition').html(data.trade_condition);
	$('#trade_volume').html(data.trade_volume);
	$('#main_product').html(data.main_product);
	$('#main_nation').html(data.main_nation);
	$('#korea_relation').html(data.korea_relation == 'y' ? '유' : (data.korea_relation == 'n' ? '무' : ''));
	$('#concat').html(data.contact);
	$('#trade_staff').html(data.trade_staff);

	$('.type-pc-layer .layer-cont').scrollTop(0);
}

function  fnShowEi01(data) {
	data = data.replace(/'/g, '"').replace(/(\n|\r\n)/g, '<br>').replace(/\t/gi, " ");
	data =  JSON.parse(data);
	$('#ei01_title').html(data.title);
	$('#ei01_desc').html(data.desc);
	$('#ei01_document').html(data.document);
}

function  fnShowEi02(data) {
	data = data.replace(/'/g, '"').replace(/(\n|\r\n)/g, '<br>').replace(/\t/gi, " ");
	data =  JSON.parse(data);

	$('#ei02_law').html(data.law);
	$('#ei02_desc').html(data.desc);
}
</script>
	<!-- layer : 바이어정보 -->
	<div id="layer-buyer" class="layer-buyer type-pc-layer">
		<div class="pc-dim"></div>
		<div class="layer-container">
			<h3>바이어 상세 정보</h3>
			<div class="layer-cont">
				<div class="buyer-cont">
					<div class="by-top">
						<div class="by-icon"></div>
						<div class="by-name" id="company_name_title"></div>
						<div class="btn-more"><a href="#" onclick="javascript:fnCopyUrl('/overseas/detail/<?php echo $req['nation_seq']; ?>/<?php echo $req['hscode']; ?>') return false;" class="btn-type5 btn-share">공유<span class="pc-only">하기</span></a></div>
					</div>
					<div class="by-info">
						<dl class="info-box">
							<dt>구매 희망 품목</dt>
							<dd>
								<dl>
									<dt>제품명</dt>
									<dd id="buy_product"></dd>
								</dl>
								<dl>
									<dt>상세내용</dt>
									<dd id="desc"></dd>
								</dl>
								<dl>
									<dt>거래조건</dt>
									<dd id="trade_condition"></dd>
								</dl>
								<dl>
									<dt>희망거래량</dt>
									<dd id="trade_volume"></dd>
								</dl>
							</dd>
						</dl>
						<dl class="info-box">
							<dt>바이어 정보</dt>
							<dd>
								<dl>
									<dt>기업명</dt>
									<dd id="company_name"></dd>
								</dl>
								<dl>
									<dt>주력 품목</dt>
									<dd id="main_product"></dd>
								</dl>
								<dl>
									<dt>주요 수입국</dt>
									<dd id="main_nation"></dd>
								</dl>
								<dl>
									<dt>한국과의 거래 경험</dt>
									<dd id="korea_relation"></dd>
								</dl>
							</dd>
						</dl>
						<dl class="info-box">
							<dt>KBC</dt>
							<dd>
								<dl>
									<dt>접촉방법</dt>
									<dd id="contact"></dd>
								</dl>
								<dl>
									<dt>무역관 담당자</dt>
									<dd id="trade_staff"></dd>
								</dl>
							</dd>
						</dl>
					</div>
					<div class="btn-area-center">
						<a href="javascipt:;" class="btn-close-tpc btn-type2">닫기</a>
					</div>
				</div>
			</div>
			<a href="javascript:;" class="btn-close-tpc"><span class="blind">닫기</span></a>
		</div>
	</div>

	<!-- layer : 수입지 관련법령 -->
	<div id="layer-restrict2" class="layer-buyer layer-restrict type-pc-layer">
		<div class="pc-dim"></div>
		<div class="layer-container">
			<h3>주요 내용</h3>
			<div class="layer-cont">
				<div class="buyer-cont">
					<div class="by-top">
						<div class="by-name" id="ei02_law"></div>
						<div class="btn-more"><a href="javascript:;" class="btn-type5 btn-share">공유<span class="pc-only">하기</span></a></div>
					</div>
					<div class="by-info">
						<dl class="info-box">
							<dt>주요 내용</dt>
							<dd id="ei02_desc">
							</dd>
						</dl>
					</div>
					<div class="btn-area-center">
						<a href="javascipt:;" class="btn-close-tpc btn-type2">닫기</a>
					</div>
				</div>
			</div>
			<a href="javascript:;" class="btn-close-tpc"><span class="blind">닫기</span></a>
		</div>
	</div>

	<!-- layer : 수입제한요건 상세 -->
	<div id="layer-restrict" class="layer-buyer layer-restrict type-pc-layer">
		<div class="pc-dim"></div>
		<div class="layer-container">
			<h3>상세 정보</h3>
			<div class="layer-cont">
				<div class="buyer-cont">
					<div class="by-top">
						<div class="by-name" id="ei01_title"></div>
						<div class="btn-more"><a href="javascript:;" class="btn-type5 btn-share">공유<span class="pc-only">하기</span></a></div>
					</div>
					<div class="by-info">
						<dl class="info-box">
							<dt>내용</dt>
							<dd>
								<dl>
									<dt>상세</dt>
									<dd id="ei01_desc">
									</dd>
								</dl>
								<dl>
									<dt>관련서류</dt>
									<dd id="ei01_document">
									</dd>
								</dl>
							</dd>
						</dl>
					</div>
					<div class="btn-area-center">
						<a href="javascipt:;" class="btn-close-tpc btn-type2">닫기</a>
					</div>
				</div>
			</div>
			<a href="javascript:;" class="btn-close-tpc"><span class="blind">닫기</span></a>
		</div>
	</div>

	<!-- layer : 수입제한요건 표준화서류 상세 -->
	<div id="layer-standard" class="layer-buyer layer-restrict type-pc-layer">
		<div class="pc-dim"></div>
		<div class="layer-container">
			<h3>상세 정보</h3>
			<div class="layer-cont">
				<div class="standard-cont">
					<div class="title">• 21 CFR part 1.500 <br>• The Bioterrorism Act</div>
					<div class="btn-more"><a href="javascript:;" class="btn-type5 btn-share">공유<span class="pc-only">하기</span></a></div>
					<div class="pdf-viewer pc-only">
						pdf 뷰어 영역
					</div>
					<div class="pdf-down mo-only">
						<p>아래의 pdf 파일을 확인해주세요.</p>
						<a href="javascript:;" class="btn-download"><span>파일명.pdf</span></a>
					</div>
					<div class="btn-area-center">
						<a href="javascipt:;" class="btn-close-tpc btn-type2">닫기</a>
					</div>
				</div>
			</div>
			<a href="javascript:;" class="btn-close-tpc"><span class="blind">닫기</span></a>
		</div>
	</div>
