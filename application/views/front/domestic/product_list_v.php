<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

    <div class="container">
		<div class="sub-container">
			<div class="data-list domestic product"><!-- 국내데이터 class="domestic" 제품 class="product" -->
				<div class="sub-visual">
					<img src="/assets/front/images/bg_sv1_m.png" alt="국내데이터 타이틀bg" class="mo-only" />
					<h2>제품</h2>
				</div>
				<div class="inner">
					<div class="list-area">
						<div class="list-top">
							<div class="searchbox">
								<input type="text" id="keyword" value="" placeholder="검색어를 입력해주세요." class="ip-search" />
								<button class="btn-reset"><img src="/assets/front/images/btn_clear.svg"  alt="검색어삭제" /></button>
							</div>
							<div class="sorting">
								<select name="">
									<option value="">인기순</option>
									<option value="">가나다순</option>
									<option value="">제조사 가나다순</option>
								</select>
							</div>
							<div class="total">총 <span id="total_rows">0</span>개</div>
						</div>
						<div class="list-wrap clear">
							<div class="product-list-wrap">
								<ul class="product-list clear" id="product_list">
									
								</ul>
								<div class="btn-more-box"><a href="#" onclick="javascript:fnGetList(); return false;" class="btn-type5">More</a></div>
							</div>
						</div>
					</div>
					</div>
			</div>
		</div>
	</div>
<form id="frmSearch">
	<input type="hidden" name="member_cd"  value="<?php  echo $req['member_cd']; ?>" />
	<input type="hidden"  name="biz_no" value="<?php echo $req['biz_no']; ?>" />
	<input type="hidden" name="prod_type" value="<?php echo $req['prod_type']; ?>" />
	<input type="hidden" name="keyword"  value="" />
	<input type="hidden" name="offset" value="0" />
	<input type="hidden" name="detail_seq" value="" />
</form>
<script>
$(document).ready(function() {
	$('#keyword').on('keypress', function(e) {
		if(e.keyCode == 13) {
			$('#frmSearch input[name=keyword]').val($('#keyword').val());
			$('#frmSearch input[name=offset]').val('0');
			fnGetList();
		}
	})

	fnGetList(0);
})

function fnGetList() {
	$.ajax({
			url: "/api/common/product_list",
			type: "POST",
			data: $('#frmSearch').serialize(),
			dataType : 'json',
			async : false,
			success: function(data) {
				console.log(data);
				$('#domestic_list').html(data);
				var str = '';
				for(var i = 0;  i < data.list.length; i++) {
					str += '<li>'
						+	'	<a href="#" onclick="javascript:goDetail(\'' + data.list[i].detail_seq + '\'); return false;">'
						+	'		<span class="img">' + (data.list[i].thumbnail_img == '' ? '<img src="/assets/front/images/icon_noprofile.svg" alt="제품 이미지" />' : '<img src="/api/common/img_view?img_path=' + data.list[i].thumbnail_img + '"  alt="' + data.list[i].product_name + ' 이미지" />') + '</span>'
						+	'		<span class="cate">#' + data.list[i].food_type + '</span>'
						+	'		<span class="title">' +  data.list[i].product_name + '</span>'
						+	'		<span class="factory">' + data.list[i].brand + '</span>'
						+	'	</a>'
						+	'</li>';
				}

				if($('#frmSearch input[name=offset]').val() == '0') {
					$('#product_list').html(str);
				}
				else {
					$('#product_list').append(str);
				}
				if(data.list.length < 16) {
					$('.btn-more-box').hide();
				}
				$('#total_rows').html(commify(data.total_rows));
				var page = parseInt($('#frmSearch input[name=offset]').val());
				page += 16;
				$('#frmSearch input[name=offset]').val(page);
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});

}

function goDetail(seq) {
	$('#frmSearch').attr('method', 'post');
	$('#frmSearch').attr('action', '/domestic/product_detail');
	$('#frmSearch input[name=detail_seq]').val(seq);
	$('#frmSearch').submit();
}
</script>