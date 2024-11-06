<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->

<div class="container">
		<div class="sub-container">
			<div class="data-list board-list community"><!-- 커뮤니티 class="board-list community" -->
				<div class="sub-visual  type2">
					<img src="/assets/front/images/bg_sv2_m.png" alt="커뮤니티 타이틀bg" class="mo-only" />
					<h2>
						<span>커뮤니티</span>
						<div>
							정보와 의견을 나누고, 구인/구직, 중고 식품설비 거래,
							<div>부자재 공동 구매 등을 진행할 수 있는 열린 공간입니다.</div>
						</div>
					</h2>
				</div>
				<div class="inner">
					<div class="list-area">
						<ul class="rp-list-cate">
							<li>
								<input type="radio" id="comCateAll" name="com-cate"  value="all" <?php echo $req['community_type'] === 'all' ? 'checked' : ''; ?>  />
								<label for="comCateAll">전체</label>
							</li>
							<?php
								foreach($types as $row) {
							?>
								<li>
									<input type="radio" id="comCate<?php echo $row['sub_code']; ?>" name="com-cate" value="<?php echo $row['sub_code']; ?>" <?php echo $req['community_type'] === $row['sub_code'] ? 'checked' : ''; ?>  />
									<label for="comCate<?php echo $row['sub_code']; ?>"><?php echo $row['code_name']; ?></label>
								</li>
							<?php
								}
							?>
						</ul>
						<div class="list-top">
							<div class="searchbox">
								<input type="text" id="keyword" value="<?php echo !empty($req['keyword']) ? $req['keyword'] : ''; ?>" placeholder="검색어를 입력해주세요." class="ip-search" />
								<button class="btn-reset" onclick="javascript:fnInit();"><img src="/assets/front/images/btn_clear.svg"  alt="검색어삭제" /></button>
							</div>
							<div class="total">총 <span><?php echo number_format($total_rows); ?></span>개</div>
							<a href="#" onclick="javascript:fnGoQna(); return false;" class="btn-inq" style="z-index:100;">푸드플라넷에 <span>문의하기</span></a>
						</div>
						<div class="list-wrap">
							<div class="community-list"><!-- 커뮤니티 class="community-list" -->
								<div class="tb-type-board">
									<ul class="detail-title clear">
										<li>번호</li>
										<li>분류</li>
										<li>제목</li>
										<li>작성자</li>
										<li>조회수</li>
									</ul>
									<div class="detail-cont">
									<?php
										if(count($list) > 0) {
											foreach($list as $row) {
									?>
											<a href="/community/detail/<?php echo $row['community_seq']; ?>">
												<ul>
													<li><?php echo $num--; ?></li>
													<li><?php echo $row['community_type_name']; ?></li>
													<li><div class="com-title"><?php echo $row['title']; ?></div><div class="rp-count">[<?php echo $row['reply_cnt']; ?>]</div></li>
													<li><?php echo $row['nickname']; ?></li>
													<li><?php echo number_format($row['hit_cnt']); ?></li>
												</ul>
											</a>
									<?php
											}
										}
										else {
											echo '<ul><li style="width:100%; text-align:center; padding:50px 0;">검색 결과가 없습니다.</li>';
										}
									?>
									</div>
								</div>
								<?php
									if(!empty($member)) {
								?>
									<a href="/community/write" class="btn-request">작성하기</a>
								<?php
									}
									else {
								?>
									<a href="#" onclick="javascript:fnShowLoginAlert(); return false;" class="btn-request">작성하기</a>
								<?php
									}
								?>
							</div>
							<div class="paging">
								<?php echo $pagination; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="layer-login2" class="layerpop type-center layer-nodata">
		<div class="layer-container">
			<dl class="nodata">
				<dt>로그인 후 이용해 주세요.</dt>
				<dd>
					<div>회원만 새 글 작성이 가능합니다.</div>
					<a href="#" onclick="javascript:fnShowLogin2(); return false;" class="btn-type2">로그인 하기</a>
				</dd>
			</dl>
			<a href="#" onclick="javascript:fnCloseLogin(); return false;" class="layer-close"><span class="blind">닫기</span></a>
		</div>
	</div>

<form id="frmSearch" method="get">
</form>
<script>
$(document).ready(function() {
	$('input[name=com-cate]').on('click', function() {
		$('#frmSearch').attr('action', '/community/list/' + $(this).val());
		$('#frmSearch').submit();
	})

	$('#keyword').on('keypress', function(event) {
		if(event.keyCode == 13) {
			var community_type = $('input[name=com-cate]:checked').val();
			$('#frmSearch').attr('action', '/community/list/' + community_type + '?keyword=' + $(this).val());
			$('#frmSearch').append('<input type="hidden" name="keyword" value="' + $(this).val() + '" />');
			$('#frmSearch').submit();
		}
	})

	<?php
		if(!empty($req['keyword']) && empty($list)) {
	?>
		openpop('.layer-nodata');
		$('#layer-nodata').show();
	<?php
		}
	?>
})

function fnInit() {
	<?php 
		if(!empty($req['keyword'])) {
	?>
	var community_type = $('input[name=com-cate]:checked').val();
	$('#frmSearch').attr('action', '/community/list/' + community_type);
	$('#frmSearch').submit();
	<?php
		}
	?>
}

<?php
	if(empty($member)) {
?>
function fnShowLoginAlert() {
	$('#layer-login2').addClass("is-opened");
	$("html").addClass("is-opened");
//	openpop('#layer-login2');
//	$('#layer-login2').show();
}

function fnCloseLogin() {
	$('#layer-login2').removeClass("is-opened");
	$("html").removeClass("is-opened");
//	closepop('#layer-login2');
//	$('#layer-login2').hide();
}

function fnShowLogin2() {
//	closepop('#layer-login2');
//	$('#layer-login2').hide();
	fnCloseLogin();
	$("html").addClass("open-login");
}

<?php
	}
?>
</script>