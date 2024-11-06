<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="data-detail overseas"><!-- 해외데이터 class="overseas" -->
				<div class="sub-visual" style="background:url(<?php echo $info['background_img']; ?>) center center no-repeat;background-size:cover;">
					<img src="<?php echo $info['background_img']; ?>" alt="해외데이터 국가 상세 bg" class="mo-only" />
				</div>
				<div class="inner">
					<div class="detail-area">
						<div class="detail-info">
							<div class="company-profile clear">
								<div class="profile-img"><img src="<?php echo $info['flag_img']; ?>" alt="{미국}국기이미지" /></div>
								<dl class="profie-info">
									<dt><?php echo $info['nation_name']; ?> <span><?php echo $info['nation_name_eng']; ?></span></dt>
									<dd>
										<!--<div>미합중국(美合衆國, United States of America) 또는 미국(美國)은 <br />북아메리카 대륙과 태평양 지역에 위치한 연방국이자 세계 유일의 초강대국이다.</div>-->
										<!--<a href="javascript:;" class="btn-type5 btn-est">종합 컨설팅 신청</a>-->
									</dd>
								</dl>
							</div>
							<!--a href="javascript:;" class="mo-only btn-toggle btn-detail">상세 정보</a-->
							<div class="detail-company clear">
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
							<a href="#" onclick="javascript:fnGoQna(); return false;" class="btn-inq">푸드플라넷에 <span>문의하기</span></a>
						</div>
						<div class="tab-area">
							<div class="swiper-container tabs">
								<ul class="tabs-wrapper swiper-wrapper">
									<li class="swiper-slide on"><a href="javascript:;">주요 품목</a></li>
									<li class="swiper-slide"><a href="javascript:;">유통채널</a></li>
									<li class="swiper-slide"><a href="javascript:;">주요 품목 요건</a></li>
									<li class="swiper-slide"><a href="javascript:;">바이어 정보</a></li>
									<li class="swiper-slide"><a href="javascript:;">시장 동향</a></li>
								</ul>
							</div>
							<div class="tab-container">
								<!-- 주요 수출 품목 (2022년) -->
								<div class="tab-cont on">
									<div class="cont-box">
										<h4>주요 수출 품목 (2022년)</h4>
										<div class="tb-type3">
											<ul class="detail-title clear">
												<li>번호</li>
												<li>품목 이름</li>
												<li>HSCODE</li>
												<li>금액(천불)</li>
											</ul>
											<div class="detail-cont">
											<?php
												$idx = 1;
												foreach($top as $row) {
											?>
												<ul>
													<li><?php echo $idx++; ?></li>
													<li><div class="ov-x"><a href="/overseas/product/detail/<?php echo $row['nation_seq']; ?>/<?php echo $row['product_seq']; ?>"><?php echo $row['product_name']; ?></a></div></li>
													<li><div class="ov-x"><?php echo $row['hscode']; ?></div></li>
													<li><div class="ov-x"><?php echo is_numeric($row['price']) ? number_format($row['price']) : $row['price']; ?></div></li>
												</ul>
											<?php
												}
											?>
											</div>
										</div>
									</div>
								</div>

								<!-- 유통채널 -->
								<div class="tab-cont">
									<ul class="dist-list">
									<?php
										foreach($channel as $row) {
									?>
										<li>
											<div class="img"><img src="<?php echo $row['url']; ?>" alt="{유통채널}이미지"></div>
											<div class="title-en"><?php echo $row['channel_name_eng']; ?></div>
											<div class="title-kr"><?php echo $row['channel_name']; ?></div>
											<div class="dist-pro"></div>
										</li>
									<?php
										}
									?>
									</ul>
								</div>

								<!-- 주요 품목 요건 -->
								<div class="tab-cont">
									<div class="cont-box mj-pro-box">
										<h4>주요 품목 요건</h4>
										<div class="tb-type4 type4">
											<ul class="tb-title clear">
												<li>구분</li>
												<li>품목명</li>
												<li>HS CODE</li>
												<li>수출국 요건</li>
											</ul>
											<ul class="tb-list-cont">
											<?php
												$idx = 1;
												foreach($require as $row) {
											?>
												<li>
													<dl>
														<dt>구분</dt>
														<dd><?php echo $idx++; ?></dd>
													</dl>
													<dl>
														<dt>품목명</dt>
														<dd><?php echo $row['product_name']; ?></dd>
													</dl>
													<dl>
														<dt>HS CODE</dt>
														<dd><?php echo $row['hscode']; ?></dd>
													</dl>
													<dl>
														<dt>수출국 요건</dt>
														<dd>
															<div class="ovf-box"><?php echo nl2br($row['export_requirement']); ?></div>
														</dd>
													</dl>
												</li>
											<?php
												}
											?>
											</ul>
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
												<li>해외기업명</li>
												<li>관심품목(분류)</li>
												<li>관심품목(상세)</li>
												<li>대표 품목</li>
												<li>홈페이지</li>
												<li>최근 수정일</li>
											</ul>
											<ul class="tb-list-cont" id="buyer_list">
												<!-- sample 반복 -->
												
												<!-- //sample 반복 -->
											</ul>
										</div>
										<div class="btn-more-box" id="buyer_more_box"><a href="#" onclick="javascript:fnGetBuyerList(); return false;" class="btn-type5">More</a></div>
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
											<div class="detail-cont" id="trends_list">
												
											</div>
										</div>
										<div class="btn-more-box" id="trends_more_box"><a href="#" onclick="javascript:fnGetTrendsList(); return false;" class="btn-type5">More</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<form id="frmBuyer">
	<input type="hidden" name="offset" value="0" />
	<input type="hidden" name="seq" value="<?php echo $info['seq']; ?>" />
</form>

<form id="frmTrends">
	<input type="hidden" name="offset" value="0" />
	<input type="hidden" name="seq" value="<?php echo $info['seq']; ?>" />
</form>

<script>
$(document).ready(function() {
	fnGetBuyerList();
	fnGetTrendsList();
})
function fnLink(seq, link) {
	window.open(link, '_blank');

	$.ajax({
			url: "/overseas/nation/hit_cnt",
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

function fnShowBuyer(idx) {
	data =  buyer[idx];

	$('#buyer_title').html(data.company_name);
	
	$('#buyer_company_name').html(data.company_name);
	$('#buyer_owner_name').html(data.owner_name);
	$('#buyer_product_name').html(data.product_name);
	$('#buyer_main_product').html(data.main_product);
	$('#buyer_category').html(data.main_product);
	$('#buyer_hscode').html(data.hscode);

	$('#db_company_name').html(data.company_name);
	$('#db_owner_name').html(data.owner_name);
	$('#db_hscode').html(data.hscode);
	$('#db_volume_order').html(data.volume_order);
	$('#db_available_period').html(data.available_period);
	$('#db_desc').html(nl2br(data.desc));
	$('#db_trade_condition').html(data.trade_condition);
	$('#db_trade_volume').html(data.trade_volume);
	$('#db_main_income').html(data.main_income);
	$('#db_is_korea').html(data.is_korea == 'y' ? '유' : (data.is_korea == 'n' ? '무' : ''));
	$('#db_concat').html(data.contact);
	$('#db_export_staff').html(data.export_staff);

	$('.type-pc-layer .layer-cont').scrollTop(0);

	$("html").addClass("open-pc-layer");
	$('#layer-buyer').addClass("is-opened");
}

var buyer = new Array();
function fnGetBuyerList() {
	$.ajax({
			url: "/api/common/buyer_list",
			type: "POST",
			data: $('#frmBuyer').serialize(),
			dataType : 'json',
			async : false,
			success: function(data) {
				var str = '';
				for(var i = 0;  i < data.list.length; i++) {
					buyer.push(data.list[i]);
					var product_name = $.trim(data.list[i].main_product);
					str += '<li>'
						+	'	<dl>'
						+	'		<dt class="btn-tb-list">'
						+	'			<div class="title blur" style="filter: blur(3px);">' + data.list[i].company_name + '</div>'
						+	'			<div class="cate1 mo-only blur">' + data.list[i].category + '</div>'
						+	'			<div class="cate2 mo-only blur">' + data.list[i].hscode + '</div>'
						+	'			<a href="#" onclick="javascript:fnShowBuyer(' + (buyer.length - 1) + '); return false;" data-link="#layer-buyer" class="btn-pc-layer pc-only"><span class="blind">바이어 정보</span></a>'
						+	'		</dt>'
						+	'		<dd>'
						+	'			<dl>'
						+	'				<dt>대한관심품목(분류)</dt>'
						+	'				<dd class="blur">' + data.list[i].category + '</dd>'
						+	'			</dl>'
						+	'			<dl>'
						+	'				<dt>대한관심품목(상세)</dt>'
						+	'				<dd class="blur">' + data.list[i].hscode + '</dd>'
						+	'			</dl>'
						+	'			<dl>'
						+	'				<dt>대표 품목</dt>'
						+	'				<dd class="blur">' + product_name.substring(0, 15) + (product_name.length > 15 ? '...' : '') + '</dd>'
						+	'			</dl>'
						+	'			<dl>'
						+	'				<dt>홈페이지</dt>'
						+	'				<dd class="blur"></dd>'
						+	'			</dl>'
						+	'			<dl>'
						+	'				<dt>최근 수정일</dt>'
						+	'				<dd class="blur">' + data.list[i].updated_at + '</dd>'
						+	'			</dl>'
						+	'			<a href="#" onclick="javascript:fnShowBuyer(' + (buyer.length - 1) + '); return false;" data-link="#layer-buyer" class="btn-pc-layer btn-layer blur"><span class="blind">바이어 정보</span></a>'
						+	'		</dd>'
						+	'	</dl>'
						+	'</li>';
				}

				if($('#frmBuyer input[name=offset]').val() == '0') {
					$('#buyer_list').html(str);
				}
				else {
					$('#buyer_list').append(str);
				}
				if(data.list.length < 10) {
					$('#buyer_more_box').hide();
				}
				var page = parseInt($('#frmBuyer input[name=offset]').val());
				page += 10;
				$('#frmBuyer input[name=offset]').val(page);

				if($(".btn-tb-list").length){
					var ww = $(window).width();
					if(ww<= 900){
						$(".tb-list-cont .btn-tb-list").each(function(e){
							$(this).off("click").on("click" , function(e){
								e.preventDefault();
								$(this).toggleClass("on");
								$(this).next("dd").slideToggle(300);
							});
						});
					};	
				};
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

function fnGetTrendsList() {
	$.ajax({
			url: "/api/common/trends_list",
			type: "POST",
			data: $('#frmTrends').serialize(),
			dataType : 'json',
			async : false,
			success: function(data) {
				var str = '';
				var page = parseInt($('#frmTrends input[name=offset]').val());
				for(var i = 0;  i < data.list.length; i++) {
					str += '<ul>'
						+	'	<li>' + (page + (i + 1)) + '</li>'
						+	'	<li><a href="#" onclick="javascript:fnLink(' + data.list[i].seq + ', \'' + data.list[i].link_url + '\'); return false;">' +  data.list[i].title + '</a></li>'
						+	'	<li>' +  commify(data.list[i].hit_cnt) + '</li>'
						+	'</ul>';
				}

				if($('#frmTrends input[name=offset]').val() == '0') {
					$('#trends_list').html(str);
				}
				else {
					$('#trends_list').append(str);
				}
				if(data.list.length < 10) {
					$('#trends_more_box').hide();
				}
				page += 10;
				$('#frmTrends input[name=offset]').val(page);
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});

}

</script>

	<!-- layer : 바이어정보 -->
	<div id="layer-buyer" class="layer-buyer type-pc-layer">
		<div class="pc-dim"></div>
		<div class="layer-container">
			<h3>바이어 정보</h3>
			<div class="layer-cont">
				<div class="buyer-cont">
					<div class="by-top">
						<div class="by-icon"></div>
						<div class="by-name blur" id="buyer_title" style="line-height:35px"></div>
						<div class="btn-more"><a href="javascript:;" class="btn-type5 btn-share">공유<span class="pc-only">하기</span></a></div>
					</div>
					<div class="by-info">
						<dl class="info-box">
							<dt>기본 정보</dt>
							<dd>
								<dl>
									<dt>바이어명(영문)</dt>
									<dd id="buyer_company_name" class="blur"></dd>
								</dl>
								<dl>
									<dt>대표자명(영문)</dt>
									<dd id="buyer_owner_name" class="blur"></dd>
								</dl>
								<dl>
									<dt>해외기업 국가</dt>
									<dd class="blur"><?php echo $info['nation_name']; ?></dd>
								</dl>
								<dl>
									<dt>홈페이지</dt>
									<dd class="blur"></dd>
								</dl>
								<dl>
									<dt>대표 품목</dt>
									<dd id="buyer_product_name" class="blur"></dd>
								</dl>
								<dl>
									<dt>대표 품목</dt>
									<dd id="buyer_main_product" class="blur"></dd>
								</dl>
								<dl>
									<dt>대한 관심품목<span>(분류)</span></dt>
									<dd id="buyer_category" class="blur"></dd>
								</dl>
								<dl>
									<dt>대한 관심품목<span>(상세)</span></dt>
									<dd id="buyer_hscode" class="blur"></dd>
								</dl>
							</dd>
						</dl>
						<dl class="info-box">
							<dt>외부 DB 정보</dt>
							<dd>
								<dl>
									<dt>기업명</dt>
									<dd id="db_company_name" class="blur"></dd>
								</dl>
								<dl>
									<dt>국가명</dt>
									<dd class="blur"><?php echo $info['nation_name']; ?></dd>
								</dl>
								<dl>
									<dt>대표자</dt>
									<dd id="db_owner_name" class="blur"></dd>
								</dl>
								<dl>
									<dt>HS Code</dt>
									<dd id="db_hscode" class="blur"></dd>
								</dl>
								<dl>
									<dt>Volume of order</dt>
									<dd id="db_volume_order" class="blur"></dd>
								</dl>
								<dl>
									<dt>Available Period</dt>
									<dd id="db_available_period" class="blur"></dd>
								</dl>
								<dl>
									<dt>상세내용</dt>
									<dd id="db_desc" class="blur"></dd>
								</dl>
								<dl>
									<dt>거래조건</dt>
									<dd id="db_trade_condition" class="blur"></dd>
								</dl>
								<dl>
									<dt>희망거래량</dt>
									<dd id="db_trade_volume" class="blur"></dd>
								</dl>
								<dl>
									<dt>주요 수입국</dt>
									<dd id="db_main_income" class="blur"></dd>
								</dl>
								<dl class="by-intro">
									<dt>한국과의 거래 경험</dt>
									<dd id="db_is_korea" class="blur"></dd>
								</dl>
								<dl>
									<dt>접촉방법</dt>
									<dd id="db_contact" class="blur"></dd>
								</dl>
								<dl>
									<dt>무역관 담당자</dt>
									<dd id="db_export_staff" class="blur"></dd>
								</dl>
							</dd>
						<dl>
					</div>
					<div class="btn-area-center">
						<a href="javascipt:;" class="btn-close-tpc btn-type2">닫기</a>
					</div>
				</div>
			</div>
			<a href="javascript:;" class="btn-close-tpc"><span class="blind">닫기</span></a>
		</div>
	</div>     