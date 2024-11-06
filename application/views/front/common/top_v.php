<style>
.profile img {
    width: 100% !important;
    height: 100% !important;
    -o-object-fit: cover;
    object-fit: cover;
    -o-object-position: center center;
    object-position: center center;
}
</style>
	<header class="header scroll-x ">
		<div class="htop">
			<div class="htop-inner">
				<?php
					if(empty($member)) {
				?>
					<a href="javascript:;" data-link="#layer-login" class="btn-login btn-layer">로그인</a>
					<a href="/join/step1" class="btn-join">회원가입</a>
				<?php
					}
					else {
				?>
					<a href="/mypage/dashboard" class="btn-mem" ><!-- 로그인시 노출 -->
						<span class="mem-img profile"><img src="<?php echo !empty($member) && $member['profile_img'] != '' ? '/api/common/img_view?img_path=' . $member['profile_img'] : '/assets/front/images/icon_profile_bg2.png'; ?>" alt="프로필사진" /></span>
						<span class="mem-name"><?php echo $member['member_id']; ?></span>
					</a>
					<a href="/mypage/member/logout" class="btn-join">로그아웃</a>
				<?php				
					}
				?>
			</div>
		</div>
		<div class="header-inner">
			<h1><a href="/"><span class="blind">FOODPLANET</span></a></h1>
			<a href="javascript:;"class="btn-nav"><span class="blind">네비게이션 열기</span></a>
			<div id="gnb">
				<div class="gnb-inner">
<!--					<div class="search-btn mo-only">
						<a href="javascript:;" data-link="#layer-search" class="btn-layer"><span>검색어를 입력해주세요.</span></a>
					</div> -->
					<ul class="nav">
						<li class="<?php echo !empty($menu) && $menu === 'domestic' ? 'active' : ''; ?> depth1">
							<a >국내 데이터</a>
							<ul class="depth2">
								<li class="<?php echo !empty($menu) && $menu === 'domestic' && !empty($sub) && $sub === 'manufacture' ? 'current' : ''; ?>"><a href="/domestic/manufacture/list">국내 제조사</a></li>
								<li class="<?php echo !empty($menu) && $menu === 'domestic' && !empty($sub) && $sub === 'distribution' ? 'current' : ''; ?>"><a href="/domestic/distribution/list">국내 유통사</a></li>
							</ul>
						</li>
						<li class="<?php echo !empty($menu) && $menu === 'product' ? 'active' : ''; ?>"><a href="/product/list">제품 데이터</a></li>
						<li class="<?php echo !empty($menu) && $menu === 'overseas' ? 'active' : ''; ?>"><a href="/overseas/nation/list">해외 데이터</a></li>
						<li class="<?php echo !empty($menu) && $menu === 'report' ? 'active' : ''; ?>"><a href="/report/list">분석 리포트</a></li>
						<li class="<?php echo !empty($menu) && $menu === 'community' ? 'active' : ''; ?>"><a href="/community/list">커뮤니티</a></li>
						<li><a href="#" onclick="javascript:fnGoQna(); return false;">문의&middot;요청하기</a></li>
					</ul>
					<?php
						if(empty($member)) {
					?>
						<div class="mo-only btn-mem-area">
							<a href="javascript;;" data-link="#layer-login" class="btn-login btn-layer">로그인</a>
							<a href="/join/step1" class="">회원가입</a>
						</div>
					<?php
						}
						else {
					?>
						<div class="mo-only btn-mem-area">
							<a href="/mypage/dashboard" class="btn-mem">
								<span class="mem-img"><img src="<?php echo !empty($member) && $member['profile_img'] != '' ? $member['profile_img'] : '/assets/front/images/icon_profile_bg2.png'; ?>" alt="프로필사진" /></span>
								<span class="mem-name"><?php echo $member['nickname']; ?></span>
							</a>
							<a href="/mypage/member/logout" class="btn-logout">로그아웃</a>
						</div>
					<?php
						}
					?>
					<a href="javascript:;" class="mo-only gnb-close"><span class="blind">GNB닫기</span></a>
				</div>
			</div>
		</div>

	</header>
