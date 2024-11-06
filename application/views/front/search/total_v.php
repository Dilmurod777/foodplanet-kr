<link rel="stylesheet" type="text/css" href="/assets/front/css/sub.css" /><!-- sub.css -->
    <div class="container">
		<div class="sub-container">
			<div class="search-result"><!-- 검색결과 class="search-result" -->
				<div class="search-result-top">
					<div class="searchbox">
						<input type="text" id="search_text" value="<?php echo !empty($req['search_text']) ? $req['search_text'] : ''; ?>" placeholder="" class="ip-search">
						<button class="btn-reset" style="display: none;"><img src="/assets/front/images/btn_clear.svg" alt="검색어삭제"></button>
					</div>
				</div>
				<div class="inner">
					<ul class="rp-list-cate">
						<li>
							<input type="radio" id="rpNotice1" name="rp-notice" value="" checked="">
							<label for="rpNotice1">통합 검색</label>
						</li>
						<li>
							<input type="radio" id="rpNotice2" name="rp-notice" value="domestic">
							<label for="rpNotice2">국내 데이터</label>
						</li>
						<li>
							<input type="radio" id="rpNotice3" name="rp-notice" value="overseas">
							<label for="rpNotice3">해외 데이터</label>
						</li>
						<li>
							<input type="radio" id="rpNotice4" name="rp-notice" value="community">
							<label for="rpNotice4">커뮤니티</label>
						</li>
					</ul>
					<dl class="result-total">
						<dt>국내 데이터 내 “<?php echo !empty($req['search_text']) ? $req['search_text'] : ''; ?>” 검색 결과</dt>
						<dd>
                        <?php
                            if(empty($domestic)) {
                                echo '<div class="cont-box"><div class="nodata"><div>국내 데이터 내 “' . (!empty($req['search_text']) ? $req['search_text'] : '') . '” <span>검색 결과가 존재하지 않습니다.</span></div></div></div>';
                            }
                            else {
                        ?>
                            <div class="data-list domestic">
                                <div class="list-area ">
                                        <!-- pc용 -->
                                    <div class="list-wrap pc-only">
                                        <ul class="list-cont">
                        <?php
                                foreach($domestic as $row) {
                        ?>
                                        <li>
											<dl>
												<dt class="btn-list">
													<?php echo $row['company_name']; ?>
													<dl class="mo-only">
														<dt>신용등급</dt>
														<dd><?php echo $row['credit_rating']; ?></dd>
													</dl>
													<a href="#" onclick="javascript:goDetailDomestic('<?php echo $row['biz_no']; ?>'); return false;" class="pc-only"><span class="blind">{제조사}상세</span></a>
												</dt>
												<dd>
													<a href="#" onclick="javascript:goDetailDomestic('<?php echo $row['biz_no']; ?>'); return false;" >
														<dl>
															<dt>대표 제품군</dt>
															<dd><?php echo !empty($row['main_product_name']) ? $row['main_product_name'] : '&nbsp;'; ?></dd>
														</dl>
														<dl>
															<dt>OEM 제조</dt>
															<dd>&nbsp;</dd>
														</dl>
														<dl>
															<dt>매출</dt>
															<dd>
																<?php  echo sprintf('%0.2f', $row['sales_year']) . '억';?>
															</dd>
														</dl>
														<dl class="pc-only">
															<dt>신용등급</dt>
															<dd><?php echo $row['credit_rating']; ?></dd>
														</dl>
														<dl>
															<dt>생산규모</dt>
															<dd><?php echo is_numeric($row['production_year']) ? number_format($row['production_year']) : $row['production_year']; ?><?php echo $row['unit_year']; ?></dd>
														</dl>
														<dl>
															<dt>수출 진행 국가</dt>
															<dd><?php echo $row['export_nation']; ?></dd>
														</dl>
													</a>
												</dd>
											</dl>
										</li>
                        <?php
                                }
                        ?>
                                        </ul>
                                    </div>
									<div class="list-wrap search-dom-swiper swiper mo-only">
										<ul class="list-cont swiper-wrapper">
											<!-- sample 반복 -->
                        <?php
                                        foreach($domestic as $row) {
                        ?>
                                        
											<li class="swiper-slide">
												<a href="#" onclick="javascript:goDetailDomestic('<?php echo $row['biz_no']; ?>'); return false;" class="sc-dom-box">
													<span class="sc-dom-img">
                                                    <?php
                                                        if(!empty($row['logo_img'])) {
										                    echo '<img src="' . $row['logo_img'] . '" alt="' . $row['company_name'] . ' 로고이미지" />';
									                    }                                                        
                                                    ?>
                                                    </span>
													<span class="sc-dom-cont">
														<span class="cate1"><span><?php echo !empty($row['main_product_name']) ? $row['main_product_name'] : '&nbsp;'; ?></span></span>
														<span class="title"><?php echo $row['company_name']; ?></span>
														<span class="cont"><?php echo $row['summary']; ?></span>
													</span>
												</a>
											</li>
                        <?php
                                        }
                        ?>
											<!-- //sample 반복 -->
										</ul>
										<script>
											var scswiper1 = new Swiper(".search-dom-swiper", {
											  observer: true,
											  observeParents: true,
											  slidesPerView: 1.8,
											  spaceBetween: 12,
											});
										  </script>
									</div>
                                </div>
                                <div class="btn-more-box"><a href="#" onclick="javascript:fnGoSearch('domestic'); return false;" class="btn-type5">More</a></div>
                            </div>
                        <?php

                            }
                        ?>
						</dd>
						<dt>해외 데이터 내 “<?php echo !empty($req['search_text']) ? $req['search_text'] : ''; ?>” 검색 결과</dt>
						<dd>
                        <?php
                            if(empty($overseas)) {
                                echo '<div class="cont-box"><div class="nodata"><div>해외 데이터 내 “' . (!empty($req['search_text']) ? $req['search_text'] : '') . '” <span>검색 결과가 존재하지 않습니다.</span></div></div></div>';
                            }
                            else {
                        ?>
							<div class="data-list overseas">
								<div class="list-area">
									<div class="list-wrap">
										<div class="list">
											<ul class="list-cont">
                        <?php
                                            foreach($overseas as $row) {
                        ?>
                                                <li>
                                                    <a href="/overseas/nation/detail/<?php echo $row['seq']; ?>">
                                                        <span class="flags"><img src="<?php echo empty($row['flag_img']) ? '/assets/front/images/icon_noprofile.svg' : $row['logo_img']; ?>" alt="<?php echo $row['nation_name']; ?> 국기이미지" /></span>
                                                        <span class="flags-cont">
                                                            <span class="title1"><?php echo $row['continent']; ?></span>
                                                            <span class="title2"><?php echo $row['nation_name']; ?></span>
                                                            <span class="items"><?php echo $row['product_name']; ?></span>
                                                        </span>
                                                    </a>
                                                </li>
                        <?php
                                            }
                        ?>

											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="btn-more-box"><a href="javascript:;" class="btn-type5">More</a></div>
                        <?php
                            }
                        ?>
						</dd>
						<dt>커뮤니티 내 “<?php echo !empty($req['search_text']) ? $req['search_text'] : ''; ?>” 검색 결과</dt>
						<dd>
                        <?php
                            if(empty($community)) {
                                echo '<div class="cont-box"><div class="nodata"><div>커뮤니티 내 “' . (!empty($req['search_text']) ? $req['search_text'] : '') . '” <span>검색 결과가 존재하지 않습니다.</span></div></div></div>';
                            }
                            else {
                        ?>
                            <div class="data-list community">
								<div class="search-cumm-swiper swiper">
									<ul class="swiper-wrapper">   
                        <?php
                                    foreach($community as $row) {
                        ?>
                                        <li class="swiper-slide">
											<a href="/community/detail/<?php echo $row['community_seq']; ?>">
												<span class="cate2"><?php echo $row['community_type_name']; ?></span>
												<span class="title"><?php echo $row['title']; ?></span>
												<span class="profile">
													<span class="mem-name">by <?php echo $row['nickname']; ?></span>
													<span class="mem-img">
                                                    <?php 
													if(!empty($member['profile_img'])) {
                                                    ?>
                                                        <img src="/api/common/img_view?img_path=<?php echo $member['profile_img']; ?>" alt="<?php echo $member['nickname']; ?> 프로필이미지">
                                                    <?php
                                                        }
                                                    ?>                                                        
                                                    </span>
												</span>
											</a>
										</li>                        
                        <?php
                                    }
                        ?>
									</ul>
									<script>
										var ww = $(window).width();
										var scswiper2 = undefined;
										function initSwiper2() {
										  if (ww <= 720 && scswiper2 == undefined) {
											scswiper2 = new Swiper(".search-cumm-swiper", {
												observer: true,
												observeParents: true,
												preventClicks: true,
												preventClicksPropagation: false,
												slidesPerView: 1.6,
												spaceBetween: 12,
											});
										  } else if (ww > 720 && scswiper2 != undefined) {
											scswiper2.destroy();
											scswiper2 = undefined;
										  }
										};

										initSwiper2();

										$(window).on('resize', function () {
										  ww = $(window).width();
										  initSwiper2();
										});
								    </script>
								</div>
							</div>
                            <div class="btn-more-box"><a href="#" onclick="javascript:fnGoSearch('community'); return false;" class="btn-type5">More</a></div>
                        <?php
                            }
                        ?>
						</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
<form id="frmGoSearch2" method="post" action="">
    <input type="hidden" name="search_text" value="<?php echo !empty($req['search_text']) ? $req['search_text'] : ''; ?>" />
</form>
<form id="frmDetailDomestic" method="post" action="/domestic/manufacture/detail">
	<input type="hidden" name="biz_no" value="" />
</form>
<script>
$(document).ready(function() {
    $('input[name=rp-notice]').on('click', function(e) {
        if($(this).val() !== '') {
            $('#frmGoSearch2').attr('action', '/search/' + $(this).val());
            $('#frmGoSearch2').submit();
			e.preventDefault();
        }
    });

    $('#search_text').on('keypress', function(e) {
        if(e.keyCode == 13) {
			if($.trim($(this).val()) == '') {
				showAlert('검색어를 입력해주세요.');
				return;
			}
            $('#frmGoSearch2 input[name=search_text]').val($(this).val());
            $('#frmGoSearch2').attr('action', '/search');
            $('#frmGoSearch2').submit();
        }
    })

})

function fnGoSearch(stype) {
    $('#frmGoSearch2').attr('action', '/search/' + stype);
    $('#frmGoSearch2').submit();
}

function goDetailDomestic(no) {
	$('#frmDetailDomestic input[name=biz_no]').val(no);
	$('#frmDetailDomestic').submit();
}

</script>