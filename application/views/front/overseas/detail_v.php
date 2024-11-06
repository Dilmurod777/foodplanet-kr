<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="data-detail overseas"><!-- 해외데이터 class="overseas" -->
				<div class="sub-visual" style="background:url(../resources/images/bg_sv_detail_ov1.jpg) center center no-repeat;background-size:cover;">
					<img src="../resources/images/bg_sv_detail_ov1_m.jpg" alt="해외데이터 국가 상세 bg" class="mo-only" />
				</div>
				<div class="inner">
					<div class="detail-area">
						<div class="detail-info">
							<div class="company-profile clear">
								<div class="profile-img">
									<?php echo (!empty($info['nation_img']) ? '<img src="/api/common/img_view?img_path=' . $info['nation_img'] . '" alt="국기이미지" />': ''); ?>
								</div>
								<dl class="profie-info">
									<dt><?php echo $info['nation_name']; ?></dt>
									<dd>
										<?php
											echo nl2br($info['summary']); 
										?>
										<a href="javascript:;" class="btn-type5 btn-est">유통 컨설팅 의뢰</a>
									</dd>
								</dl>
							</div>
							<a href="javascript:;" class="mo-only btn-toggle btn-detail">상세 정보</a>
							<div class="pc-only detail-company clear">
								<div>
									<dl>
										<dt>화폐</dt>
										<dd><?php echo $info['currency']; ?></dd>
									</dl>
									<dl>
										<dt>언어</dt>
										<dd><?php echo $info['language']; ?></dd>
									</dl>
									<dl>
										<dt>FTA 현황</dt>
										<dd><?php echo $info['fta_status']; ?></dd>
									</dl>
								</div>
							</div>
						</div>
						<div class="tab-area">
							<div class="swiper-container tabs">
								<ul class="tabs-wrapper swiper-wrapper">
									<li class="swiper-slide on"><a href="javascript:;">상위 수출 품목<span class="pc-only"></span></a></li>
									<li class="swiper-slide"><a href="javascript:;">시장 동향</a></li>
									<li class="swiper-slide"><a href="javascript:;">주요 품목 요건<span class="pc-only"></span><span class="mo-only">품목</span></a></li>
									<li class="swiper-slide"><a href="javascript:;">바이어 정보</a></li>
								</ul>
							</div>
							<div class="tab-container">
								<!-- 상위 수출 품목 -->
								<div class="tab-cont on">
									<div class="cont-box">
										<h4>수출 상위 품목 (2022년)</h4>
										<div class="tb-type3">
											<ul class="detail-title clear">
												<li>번호</li>
												<li>품목(가공식품)</li>
												<li>HS CODE(대표)</li>
												<li>금액(천불)</li>
											</ul>
											<div class="detail-cont">
											<?php 
												foreach($ni02 as $row) {
													echo '<ul>';
													echo '	<li>' . $row['order_no'] . '</li>';
													echo '	<li><div class="ov-x"><a href="/overseas/product/' . $info['nation_seq'] . '/' . $row['hscode'] . '">' . $row['product_name'] . '</a></div></li>';
													echo '	<li><div class="ov-x">' . $row['hscode'] . '</div></li>';
													echo '	<li><div class="ov-x">' . number_format($row['product_price']) . '</div></li>';
													echo '</ul>';
												}
											?>
											</div>
										</div>
									</div>
								</div>

								<!-- 시장 동향 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>최근 시장 동향</h4>
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

								<!-- 수입금지 원재료 정보 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>주요 품목 요건</h4>
										<div class="tb-type5">
											<ul class="tb-title clear">
												<li>품목명</li>
												<li>HS CODE</li>
												<li>수출국 요건</li>
											</ul>
											<ul class="tb-list-cont">
												<!-- sample 반복 -->
												<?php 
													foreach($ei00 as $row) {
												?>
												<li>
													<dl>
														<dt class="btn-tb-list">
															<div class="code"><b><?php echo $row['product_name']; ?></b></div>
															<div class="title"><b><?php echo $row['hscode']; ?></b></div>
														</dt>
														<dd>
															<dl>
																<dt>수출국 요건</dt>
																<dd><?php echo nl2br($row['desc']); ?></dd>														
															</dl>
														</dd>
													</dl>
												</li>
												<?php
													}
												?>
												<!-- sample 반복 -->

											</ul>
										</div>
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
						<div class="btn-more"><a href="#" onclick="javascript:fnCopyUrl('/overseas/detail/<?php echo $info['nation_seq']; ?>') return false;" class="btn-type5 btn-share">공유<span class="pc-only">하기</span></a></div>
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