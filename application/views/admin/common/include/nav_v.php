    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold"><?php echo $admin['admin_name'] . '(' . $admin['admin_id'] . ')'; ?><b class="caret"></b></span>
                            <span class="text-muted text-xs block"></span>
                        </a>
						<ul class="dropdown-menu animated fadeInRight m-t-xs" x-placement="bottom-start" style="position: absolute; top: 91px; left: 0px; will-change: top, left;">
                            <li><a class="dropdown-item" href="#" onclick="javascript:fnShowChangePw(); return false;">비밀번호변경</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="#" onclick="javascript:fnLogout(); return false;">로그아웃</a></li>
                        </ul>
                    </div>
					<div class="logo-element">
                        <img src="/assets/img/logo.png" style="max-width:90%">
                    </div>
                </li>
                <li class="<?php echo $menu === 'dashboard' ? 'active' : ''; ?>">
                    <a href="/admin/dashboard"><i class="fa fa-area-chart"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                <li class="<?php echo $menu === 'member' ? 'active' : ''; ?>">
                    <a href="/admin/member/list"><i class="fa fa-user-circle"></i> <span class="nav-label">회원관리</span></a>
                </li>
                <li class="<?php echo $menu === 'domestic' ? 'active' : ''; ?>">
                    <a href="#"><i class="fa fa-barcode"></i> <span class="nav-label">국내 데이터 관리</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo $sub === 'manufacture' ? 'active' : ''; ?>"><a href="/admin/domestic/manufacture/list">제조사관리</a></li>
                        <li class="<?php echo $sub === 'distribution' ? 'active' : ''; ?>"><a href="/admin/domestic/distribution/list">유통사관리</a></li>
                        <li class="<?php echo $sub === 'finance' ? 'active' : ''; ?>"><a href="/admin/domestic/finance/list">제조사재무관리</a></li>
                        <li class="<?php echo $sub === 'facilities' ? 'active' : ''; ?>"><a href="/admin/domestic/facilities/list">제조사설비관리</a></li>
                        <li class="<?php echo $sub === 'cert' ? 'active' : ''; ?>"><a href="/admin/domestic/cert/list">제조사인증관리</a></li>
                        <li class="<?php echo $sub === 'patent' ? 'active' : ''; ?>"><a href="/admin/domestic/patent/list">제조사특허관리</a></li>
                        <li class="<?php echo $sub === 'nbproduct' ? 'active' : ''; ?>"><a href="/admin/domestic/nbproduct/list">자사제품관리</a></li>
                        <li class="<?php echo $sub === 'oemproduct' ? 'active' : ''; ?>"><a href="/admin/domestic/oemproduct/list">OEM제품관리</a></li>
                        <li class="<?php echo $menu === 'domestic' && $sub === 'excelupload' ? 'active' : ''; ?>"><a href="/admin/domestic/excelupload">엑셀일괄업로드</a></li>
                    </ul>
                </li>
                <li class="<?php echo $menu === 'overseas' ? 'active' : ''; ?>">
                    <a href="#"><i class="fa fa-paper-plane"></i> <span class="nav-label">해외 데이터 관리</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo $sub === 'nation' ? 'active' : ''; ?>"><a href="/admin/overseas/nation/list">국가관리</a></li>
                        <li class="<?php echo $sub === 'channel' ? 'active' : ''; ?>"><a href="/admin/overseas/channel/list">국가별채널관리</a></li>
                        <li class="<?php echo $sub === 'product' ? 'active' : ''; ?>"><a href="/admin/overseas/product/list">품목관리</a></li>
                        <li class="<?php echo $sub === 'np' ? 'active' : ''; ?>"><a href="/admin/overseas/np/list">국가별품목관리</a></li>
                        <li class="<?php echo $sub === 'top' ? 'active' : ''; ?>"><a href="/admin/overseas/top/list">국가대표품목관리</a></li>
                        <li class="<?php echo $sub === 'hscode' ? 'active' : ''; ?>"><a href="/admin/overseas/hscode/list">국가별품목HSCODE관리</a></li>
                        <li class="<?php echo $sub === 'buyer' ? 'active' : ''; ?>"><a href="/admin/overseas/buyer/list">바이어관리</a></li>
                        <li class="<?php echo $sub === 'trends' ? 'active' : ''; ?>"><a href="/admin/overseas/trends/list">시장동향관리</a></li>
                        <li class="<?php echo $sub === 'requirement' ? 'active' : ''; ?>"><a href="/admin/overseas/requirement/list">수입요건관리</a></li>
                        <li class="<?php echo $sub === 'document' ? 'active' : ''; ?>"><a href="/admin/overseas/document/list">관련서류관리</a></li>
                        <li class="<?php echo $sub === 'laws' ? 'active' : ''; ?>"><a href="/admin/overseas/laws/list">법령관리</a></li>
                        <li class="<?php echo  $menu === 'overseas' && $sub === 'excelupload' ? 'active' : ''; ?>"><a href="/admin/overseas/excelupload">엑셀일괄업로드</a></li>
                    </ul>
                </li>
                <li class="<?php echo $menu === 'report' ? 'active' : ''; ?>">
                    <a href="/admin/report/list"><i class="fa fa-list-ol"></i> <span class="nav-label">분석 리포트 관리</span></a>
                </li>
                <li class="<?php echo $menu === 'community' ? 'active' : ''; ?>">
                    <a href="/admin/community/list"><i class="fa fa-comments"></i> <span class="nav-label">커뮤니티 관리</span></a>
                </li>
                <li class="<?php echo $menu === 'notice' ? 'active' : ''; ?>">
                    <a href="/admin/notice/list"><i class="fa fa-file-text-o"></i> <span class="nav-label">공지사항 관리</span></a>
                </li>
                <li class="<?php echo $menu === 'manager' ? 'active' : ''; ?>">
                    <a href="#"><i class="fa fa-gears"></i> <span class="nav-label">운영 관리</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo $sub === 'search10' ? 'active' : ''; ?>"><a href="/admin/manager/search10">검색어 TOP10</a></li>
                        <li class="<?php echo $sub === 'product10' ? 'active' : ''; ?>"><a href="/admin/manager/product10">추천신제품 TOP10</a></li>
                        <li class="<?php echo $sub === 'keyword1' ? 'active' : ''; ?>"><a href="/admin/manager/keyword1">인기키워드 TOP10(제품)</a></li>
                        <li class="<?php echo $sub === 'keyword2' ? 'active' : ''; ?>"><a href="/admin/manager/keyword2">인기키워드 TOP10(태그)</a></li>
                        <li class="<?php echo $sub === 'manufacture10' ? 'active' : ''; ?>"><a href="/admin/manager/manufacture10">제조사 TOP10</a></li>
                        <li class="<?php echo $sub === 'recommend' ? 'active' : ''; ?>"><a href="/admin/manager/recommend">추천정보(제품,공고,리뷰)</a></li>
                    </ul>
                </li>
                <li class="<?php echo $menu === 'board' ? 'active' : ''; ?>">
                    <a href="#"><i class="fa fa-pencil"></i> <span class="nav-label">문의 관리</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo $sub === 'category' ||  $sub === 'faq' ? 'active' : ''; ?>"><a href="/admin/board/category">FAQ 관리</a></li>
                        <li class="<?php echo $sub === 'qna_list' || $sub === 'qna_detail' ? 'active' : ''; ?>"><a href="/admin/board/qna_list">QNA 관리</a></li>
                    </ul>
                </li>
                <?php
                    if(!empty($admin) && $admin['admin_grade'] === '01') {
                ?>
                    <li class="<?php echo $menu === 'admin' ? 'active' : ''; ?>">
                        <a href="/admin/admin/list"><i class="fa fa-university"></i> <span class="nav-label">관리자 관리</span></a>
                    </li>
                <?php
                    }
                ?>
            </ul>

        </div>
    </nav>