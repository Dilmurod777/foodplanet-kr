<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="data-detail overseas products"><!-- 해외데이터 class="overseas" --><!-- 품목 class="products" -->
				<div class="sub-visual" style="background:url(<?php echo $info['background_img']; ?>) center center no-repeat;background-size:cover;">
					<img src="<?php echo $info['background_img']; ?>" alt="해외데이터 품목 상세 bg" class="mo-only" />
				</div>
				<div class="inner">
					<div class="detail-area">
						<div class="detail-info">
							<div class="company-profile clear">
								<div class="profile-img"><img src="<?php echo $info['product_img']; ?>" alt="품목이미지" /></div>
								<dl class="profie-info">
									<dt><?php echo $info['product_name']; ?> <span><?php echo $info['product_name_eng']; ?></span></dt>
									<dd>
										<!--<div>HS1902는 파스타(조리한 것인지 또는 고기나 그 밖의 물품으로 속을 채운 것인지에 상관없으며 스파게티, 마카로니, 누들, 라자니아, 뇨키, 라비올리, 카넬로니 등과 같이 그 밖의 방법으로 조제한 것을 포함한다.)와 쿠스쿠스(조제한 것인지에 상관없다.)이며, 이 코드 안에 인스턴트 라면이 포함된다.</div>-->
									</dd>
								</dl>
							</div>
							<!--a href="javascript:;" class="mo-only btn-toggle btn-detail">상세 정보</a-->
							<div class="detail-company clear">
								<div>
									<dl>
										<dt>수출액 <span>(천불)</span></dt>
										<dd><?php echo number_format($info['export_price']); ?> (2022년 기준)</dd>
									</dl>
									<dl>
										<dt>HS Code</dt>
										<dd><?php echo $info['hscode']; ?></dd>
									</dl>
									<dl>
										<dt>FTA 현황</dt>
										<dd><?php echo $info['fta_status']; ?></dd>
									</dl>
								</div>
								<div class="btn-area mo-only">
									<a href="javascript:;" class="btn-type5 btn-chk-nat">수출 국가 선택</a>
								</div>
								<dl class="filter-nat">
									<dt>수출 국가 선택</dt>
									<dd>
										<ul class="clear">
										<?php
											foreach($nation as $row) {
										?>
											<li>
												<input type="radio" id="nat_<?php echo $row['seq']; ?>" name="filter_nat" value="<?php echo $row['seq']; ?>" <?php echo $row['seq'] === $info['nation_seq'] ? 'checked' : ''; ?> /><!-- 20230324 checkbox > radio 일괄변경  -->
												<label for="nat_<?php echo $row['seq']; ?>"><span class="nat-tag"><img src="<?php echo $row['flag_img']; ?>" /></span><span><?php echo $row['nation_name']; ?></span></label>
											</li>
										<?php
											}
										?>
										</ul>
										<a href="javascript:;" class="nat-reset"><span class="pc-only">초기화</span></a>
										<a href="javascript:;" class="btn-type4 btn-submit">완료</a><!-- D: 리스트필터와 동일하게 완료버튼에 닫기기능 연결했습니다. common.js 국가필터선택완료 -->
									</dd>
								</dl>
							</div>
							<a href="#" onclick="javascript:fnGoQna(); return false;" class="btn-inq">푸드플라넷에 <span>문의하기</span></a>
						</div>
						<div class="tab-area">
							<div class="swiper-container tabs">
								<ul class="tabs-wrapper swiper-wrapper">
									<li class="swiper-slide on"><a href="javascript:;">수입 요건</a></li>
									<li class="swiper-slide"><a href="javascript:;">유통 제품</a></li>
									<li class="swiper-slide"><a href="javascript:;">시장 동향</a></li>
									<li class="swiper-slide"><a href="javascript:;">바이어 정보</a></li>
								</ul>
							</div>
							<div class="tab-container">
								<!-- 수입제한조건 -->
								<div class="tab-cont on">
									<div class="cont-box">
										<h4>수입 요건 및 관련 서류</h4>
										<div class="tb-type4 type5">
											<ul class="tb-title clear">
												<li>구분</li>
												<li>품목 명</li>
												<li>관련 HS 요건</li>
												<li>제목</li>
											</ul>
											<ul class="tb-list-cont" id="laws_list">
											</ul>
										</div>
										<div class="btn-more-box" id="laws_more_box"><a href="#" onclick="javascript:fnGetLawsList(); return false;" class="btn-type5">More</a></div>
									</div>
									<div class="cont-box bot0">
										<h4>관련 법령</h4>
										<div class="tb-type4 type5">
											<ul class="tb-title clear">
												<li>구분</li>
												<li>국가명</li>
												<li>관련 HS CODE</li>
												<li>근거 법령</li>
											</ul>
											<ul class="tb-list-cont" id="document_list">
											</ul>
										</div>
										<div class="btn-more-box" id="document_more_box"><a href="#" onclick="javascript:fnGetDocumentList(); return false;" class="btn-type5">More</a></div>
									</div>
								</div>

								<!-- 유통제품 -->
								<div class="tab-cont">
									<div class="cont-box">
										<h4>유통 제품 순위</h4>
										<div class="tb-type3 type3">
											<ul class="detail-title clear">
												<li>순위</li>
												<li>제품명</li>
												<li>제조사</li>
												<li>점유율</li>
											</ul>
											<div class="detail-cont">
											<!--	<ul>
													<li>1</li>
													<li><div class="ov-x blur">김</div></li>
													<li><div class="ov-x blur">바이오</div></li>
													<li><div class="ov-x blur">10%</div></li>
												</ul>
												<ul>
													<li>2</li>
													<li><div class="ov-x blur">라면</div></li>
													<li><div class="ov-x blur">바이오</div></li>
													<li><div class="ov-x blur">10%</div></li>
												</ul>
												<ul>
													<li>3</li>
													<li><div class="ov-x blur">혼합조제식료품</div></li>
													<li><div class="ov-x blur">바이오</div></li>
													<li><div class="ov-x blur">10%</div></li>
												</ul>
												<ul>
													<li>4</li>
													<li><div class="ov-x">기타 어류</div></li>
													<li><div class="ov-x">바이오</div></li>
													<li><div class="ov-x">10%</div></li>
												</ul>
												<ul>
													<li>5</li>
													<li><div class="ov-x">김</div></li>
													<li><div class="ov-x">바이오</div></li>
													<li><div class="ov-x">5%</div></li>
												</ul>
												<ul>
													<li>6</li>
													<li><div class="ov-x">라면</div></li>
													<li><div class="ov-x">바이오</div></li>
													<li><div class="ov-x">8%</div></li>
												</ul>
												<ul>
													<li>7</li>
													<li><div class="ov-x">혼합조제식료품</div></li>
													<li><div class="ov-x">바이오</div></li>
													<li><div class="ov-x">10%</div></li>
												</ul>
												<ul>
													<li>8</li>
													<li><div class="ov-x">기타 어류</div></li>
													<li><div class="ov-x">바이오</div></li>
													<li><div class="ov-x">2%</div></li>
												</ul>
												<ul>
													<li>9</li>
													<li><div class="ov-x">김</div></li>
													<li><div class="ov-x">바이오</div></li>
													<li><div class="ov-x">4%</div></li>
												</ul>
												<ul>
													<li>10</li>
													<li><div class="ov-x">라면</div></li>
													<li><div class="ov-x">바이오</div></li>
													<li><div class="ov-x">5%</div></li>
												</ul> -->
											</div>
										</div>
										<div class="btn-more-box"><a href="javascript:;" class="btn-type5">More</a></div>
									</div>
								</div>

								<!-- 수입제한조건 표준화서류 -->
<!--								<div class="tab-cont">
									<div class="cont-box">
										<h4>표준화 서류</h4>
										<div class="tb-type4 type3">
											<ul class="tb-title clear">
												<li>구분</li>
												<li>품목</li>
												<li>관련HS(6단위)</li>
												<li>유형</li>
												<li>제목</li>
											</ul>
											<ul class="tb-list-cont" id="document_list">
												
											</ul>
										</div>
										<div class="btn-more-box" id="document_more_box"><a href="#" onclick="javascript:fnGetDocumentList(); return false;" class="btn-type5">More</a></div>
									</div>
								</div> -->

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
											<div class="detail-cont" id="trends_list">
												
											</div>
										</div>
										<div class="btn-more-box" id="trends_more_box"><a href="#" onclick="javascript:fnGetTrendsList(); return false;" class="btn-type5">More</a></div>
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
												
											</ul>
										</div>
										<div class="btn-more-box" id="buyer_more_box"><a href="#" onclick="javascript:fnGetBuyerList(); return false;" class="btn-type5">More</a></div>
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
	<input type="hidden" name="nation_seq" value="<?php echo $info['nation_seq']; ?>" />
	<input type="hidden" name="product_seq" value="<?php echo $info['product_seq']; ?>" />
</form>

<form id="frmTrends">
	<input type="hidden" name="offset" value="0" />
	<input type="hidden" name="nation_seq" value="<?php echo $info['nation_seq']; ?>" />
	<input type="hidden" name="product_seq" value="<?php echo $info['product_seq']; ?>" />
</form>

<form id="frmLaws">
	<input type="hidden" name="offset" value="0" />
	<input type="hidden" name="nation_seq" value="<?php echo $info['nation_seq']; ?>" />
	<input type="hidden" name="product_seq" value="<?php echo $info['product_seq']; ?>" />
</form>

<form id="frmDocument">
	<input type="hidden" name="offset" value="0" />
	<input type="hidden" name="nation_seq" value="<?php echo $info['nation_seq']; ?>" />
	<input type="hidden" name="product_seq" value="<?php echo $info['product_seq']; ?>" />
</form>

<script>
$(document).ready(function() {
	$('input[name=filter_nat]').on('click', function() {
		var selected = '<?php echo $info['nation_seq']; ?>';
		if(selected == $(this).val()) {
			return;
		}

		location.href = '/overseas/product/detail/' + $(this).val() + '/<?php echo $info['product_seq']; ?>';
	});

	fnGetLawsList();
	fnGetDocumentList();
	fnGetBuyerList();
	fnGetTrendsList();
});

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

function fnShowLaws(idx) {
	data =  laws[idx];

	$('#laws_title').html(data.laws);
	$('#laws_desc').html(nl2br(data.desc));

	$("html").addClass("open-pc-layer");
	$('#layer-restrict').addClass("is-opened");
}

function fnShowDocument(idx) {
	data =  docs[idx];

	$('#docs_title').html(data.title);
	$('#docs_desc').html(nl2br(data.document));

	$("html").addClass("open-pc-layer");
	$('#layer-standard').addClass("is-opened");
}

var buyer = new Array();
function fnGetBuyerList() {
	$.ajax({
			url: "/api/common/buyer_list2",
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
						+	'				<dt>관심품목(분류)</dt>'
						+	'				<dd class="blur">' + data.list[i].category + '</dd>'
						+	'			</dl>'
						+	'			<dl>'
						+	'				<dt>관심품목(상세)</dt>'
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
						+	'			<a href="#" onclick="javascript:fnShowBuyer(' + (buyer.length - 1) + '); return false;" data-link="#layer-buyer" class="btn-pc-layer btn-layer"><span class="blind">바이어 정보</span></a>'
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
			url: "/api/common/trends_list2",
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

var laws = new Array();
function fnGetLawsList() {
	$.ajax({
			url: "/api/common/laws_list",
			type: "POST",
			data: $('#frmLaws').serialize(),
			dataType : 'json',
			async : false,
			success: function(data) {
				var str = '';
				var page = parseInt($('#frmLaws input[name=offset]').val());
				for(var i = 0;  i < data.list.length; i++) {
					laws.push(data.list[i]);
					str += '<li>'
						+	'	<div class="tb-wrap">'
						+	'		<div class="num">' + (page + i + 1) + '</div>'
						+	'		<div class="pro1">' + data.list[i].product_name + '</div>'
						+	'		<div class="title"><a href="#" onclick="javascript:fnShowLaws(' + (laws.length - 1) + '); return false;" data-link="#layer-standard" class="btn-pc-layer">' + data.list[i].laws + '</a></div>'
						+	'		<div class="hs-num">' + data.list[i].hscode + '</div>'
						+	'	</div>'
						+	'</li>';
				}

				if($('#frmLaws input[name=offset]').val() == '0') {
					$('#laws_list').html(str);
				}
				else {
					$('#laws_list').append(str);
				}
				if(data.list.length < 10) {
					$('#laws_more_box').hide();
				}
				page += 10;
				$('#frmLaws input[name=offset]').val(page);
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});

}

var docs = new Array();
function fnGetDocumentList() {
	$.ajax({
			url: "/api/common/document_list",
			type: "POST",
			data: $('#frmDocument').serialize(),
			dataType : 'json',
			async : false,
			success: function(data) {
				var str = '';
				var page = parseInt($('#frmDocument input[name=offset]').val());
				for(var i = 0;  i < data.list.length; i++) {
					docs.push(data.list[i]);
					str += '<li>'
						+	'	<div class="tb-wrap">'
						+	'		<div class="num">' + data.list[i].document_kind + '</div>'
						+ 	'		<div class="pro1">' + data.list[i].nation_name + '</div>'
						+	'		<div class="title"><a href="#" onclick="javascript:fnShowDocument(' + (docs.length - 1) + '); return false;" data-link="#layer-standard" class="btn-pc-layer">' + data.list[i].title + '</a></div>'
						+	'		<div class="hs-num">' + data.list[i].hscode + '</div>'
						+	'	</div>'
						+	'</li>';
				}

				if($('#frmDocument input[name=offset]').val() == '0') {
					$('#document_list').html(str);
				}
				else {
					$('#document_list').append(str);
				}
				if(data.list.length < 10) {
					$('#document_more_box').hide();
				}
				page += 10;
				$('#frmDocument input[name=offset]').val(page);
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});

}

</script>

	<div id="layer-buyer" class="layer-buyer type-pc-layer">
		<div class="pc-dim"></div>
		<div class="layer-container">
			<h3>바이어 정보</h3>
			<div class="layer-cont">
				<div class="buyer-cont">
					<div class="by-top">
						<div class="by-icon"></div>
						<div class="by-name blur" id="buyer_title"></div>
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

	<!-- layer : 수입제한요건 상세 -->
	<div id="layer-restrict" class="layer-buyer layer-restrict type-pc-layer">
		<div class="pc-dim"></div>
		<div class="layer-container">
			<h3>상세 정보</h3>
			<div class="layer-cont">
				<div class="buyer-cont">
					<div class="by-top">
						<div class="by-name" id="laws_title"></div>
						<div class="btn-more"><a href="javascript:;" class="btn-type5 btn-share">공유<span class="pc-only">하기</span></a></div>
					</div>
					<div class="by-info">
						<dl class="info-box">
							<dt>내용</dt>
							<dd id="laws_desc">

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
					<div class="title" id="docs_title"></div>
					<div class="btn-more"><a href="javascript:;" class="btn-type5 btn-share">공유<span class="pc-only">하기</span></a></div>
					<div class="pdf-viewer" id="docs_desc" style="padding:24px;  background-color:#fff;">
					</div>
<!--					<div class="pdf-down mo-only" id="docs_desc2">
					</div> -->
<!--					<div class="by-top">
						<div class="by-name" id="docs_tittle"></div>
						<div class="btn-more"><a href="javascript:;" class="btn-type5 btn-share">공유<span class="pc-only">하기</span></a></div>
					</div>
					<div class="by-info">
						<dl class="info-box">
							<dd id="docs_desc">

							</dd>
						</dl>
					</div> -->
					<div class="btn-area-center">
						<a href="javascipt:;" class="btn-close-tpc btn-type2">닫기</a>
					</div>
				</div>
			</div>
			<a href="javascript:;" class="btn-close-tpc"><span class="blind">닫기</span></a>
		</div>
	</div>