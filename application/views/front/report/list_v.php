<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="data-list board-list report"><!-- 분석레포트 class="board-list report" -->
				<div class="sub-visual">
					<img src="/assets/front/images/bg_sv2_m.png" alt="분석레포트 타이틀bg" class="mo-only" />
					<h2>
						<span>분석 리포트</span>
						<div>
							식품·수출·유통 전문가들이 작성한
							<div>시장 분석·전망 인사이트 리포트 , 제품 체험단 리뷰 등을 확인해 보세요.</div>
							프리미엄 서비스로 제품 카테고리 및 제조사별
							<div>심층 분석 리포트와 컨설팅 서비스를 받으실 수 있습니다. </div>
						</div>
					</h2>
				</div>
				<div class="inner">
					<div class="list-area">
						<form id="frmSearch">
							<input type="hidden"  name="offset" value="0" />
						<ul class="rp-list-cate">
							<li>
								<input type="radio" id="rpCate1" name="report_type"  checked value="" />
								<label for="rpCate1">전체</label>
							</li>
							<li>
								<input type="radio" id="rpCate2" name="report_type" value="1" />
								<label for="rpCate2">분석 리포트</label>
							</li>
							<li>
								<input type="radio" id="rpCate3" name="report_type" value="2" />
								<label for="rpCate3">뉴스레터</label>
							</li>
						</ul>
						<div class="list-top">
							<div class="sorting">
								<select id="report_type2" name="report_type2">
									<option value="">전체</option>
									<option value="1">국가별</option>
									<option value="2">제품별</option>
								</select>
							</div>
							<div class="searchbox">
								<input type="text" id="keyword" name="keyword" value="" placeholder="검색어를 입력해주세요." class="ip-search" />
								<button class="btn-reset"><img src="/assets/front/images/btn_clear.svg"  alt="검색어삭제" /></button>
							</div>
							<div class="total">총 <span id="total_rows"></span>개</div>
							<a href="#" onclick="javascript:fnGoQna(); return false;" class="btn-inq" style="z-index:100">푸드플라넷에 <span>문의하기</span></a>
						</div>
						</form>
						<div class="list-wrap">
							<div class="list">
								<ul class="list-cont" id="report_list">

								</ul>
								<div class="btn-more-box" id="btn_more"><a href="#" onclick="javascript:goPage(''); return false;" class="btn-type5">More</a></div>
							</div>
						</div>
					</div>
					</div>
			</div>
		</div>
	</div>

<script>
$(document).ready(function() {
	$('input[name=report_type]').on('change', function() {
		goPage(0);
	})

	$('input[name=keyword]').on('keypress', function(e) {
		if(e.keyCode == 13) {
			goPage(0);
		}
	})

	$('#report_type2').on('change', function() {
		goPage(0);
	})
	goPage(0);
})

function goPage(page) {
	if(page !== '') $('#frmSearch input[name=offset]').val(page);
	$.ajax({
			url: "/report/list_detail",
			type: "POST",
			data: $('#frmSearch').serialize(),
			async : false,
			dataType : 'json',
			success: function(data) {
				if($('#frmSearch input[name=keyword]').val() != '' && data.total_rows <= 0) {
					$('#btn_more').hide();
					openpop('.layer-nodata');
					$('#layer-nodata').show();
					return;
				}
				var str = '';
				$('#total_rows').html(commify(data.total_rows));
				for(var i = 0; i < data.list.length; i++) {
					str += '<li>'
						+	'	<a href="/report/detail/' + data.list[i].report_seq + '">'
						+	'		<span class="img"><img src="/api/common/img_view?img_path=' + data.list[i].thumbnail + '" alt="이미지"></span>'
						+	'		<span class="title">' + data.list[i].title + '</span>'
						+	'		<span class="cont">' + data.list[i].contents.replace(/<[^>]*>?/g, '') + '</span>'
						+	'	</a>'
						+	'	<div class="profile">'
						+	'		<div class="img"></div>'
						+	'		<div class="nick">' + data.list[i].created_by + '</div>'
						+	'	</div>'
						+	'	<a href="#" onclick="javascript:fnCopyUrl(\'/report/detail/' + data.list[i].report_seq + '\'); return false;" class="btn-share"><span>공유</span></a>'
						+	'</li>';
				}
				if($('#frmSearch input[name=offset]').val() == '0') {
					$('#report_list').html(str);
				}
				else {
					$('#report_list').append(str);
				}

				if(data.list.length >= 12) {
					var offset = psrseInt(data.req.offset);
					$('#frmSearch input[name=offset]').val(offset + 12);
					$('#btn_more').show();
				}
				else {
					$('#btn_more').hide();
				}

			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});

}
</script>