
<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('mypage/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>제품 정보 관리</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">

				<div class="row">
                    <div class="col-lg-12">
						<div class="tabs-container">
							<ul class="nav nav-tabs" role="tablist">
								<li><a class="nav-link" href="/mypage/product/own">자사제품 대표정보</a></li>
								<li><a class="nav-link" href="/mypage/product/ownlist">자사제품 등록</a></li>
								<li><a class="nav-link" href="/mypage/product/oem">위탁생산제품 대표정보</a></li>
								<li><a class="nav-link active" href="/mypage/product/oemlist">위탁생산제품 등록</a></li>
							</ul>
							<div class="tab-content">
								<div class="wrapper wrapper-content animated fadeInRight">
									<div class="row">
										<div class="col-lg-12">
											<div class="ibox ">
												<form id="frmSearch" method="get" action="/mypage/product/ownlist">
													<div class="ibox-content">
														<div class="row">
															<label class="col-lg-1 col-form-label">
																총 <?php echo number_format($total_rows); ?>건
															</label>
															<div class="col-lg-8"></div>
															<div class="col-lg-3">
																<input type="text" placeholder="상품명 검색" value="<?php echo $req['keyword']; ?>" name="keyword" id="keyword" class="form-control" />
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="ibox ">
												<div class="ibox-content">

													<table class="footable table table-stripped">
														<colgroup>
															<col style="width:10%" />
															<col style="width:30%" />
															<col />
															<col style="width:20%" />
														</colgroup>
														<thead>
															<tr>
																<th class="text-center">no</th>
																<th class="text-center">브랜드명</th>
																<th class="text-center">제품명</th>
																<th class="text-center">등록일</th>
															</tr>
														</thead>
														<tbody>
														<?php
															if(count($list) > 0) {
																foreach($list as $row) {
														?>
																	<tr>
																		<td class="text-center"><?php echo $num--; ?></td>
																		<td class="text-center"><?php echo $row['brand_name']; ?></td>
																		<td class="text-center">
																			<a href="/mypage/product/oemedit/<?php  echo $row['detail_seq']; ?>">
																				<?php echo $row['product_name']; ?>
																			</a>
																		</td>
																		<td class="text-center"><?php echo $row['created_at']; ?></td>
																	</tr>
														<?php
																}
															}
															else {
																echo '<tr><td colspan="4" class="text-center">검색된 내용이 없습니다.</td></tr>';	
															}
														?>
														</tbody>
													</table>
													<div class="footable-visible">
														<?php echo $pagination; ?>
													</div>
																					
												</div>
											</div>
										</div>
									</div>
									
													
								</div>
							</div>


						</div>
                    </div>
				</div>			




			<div class="form-group text-center">
					<button type="button" class="btn btn-w-m btn-success" onclick="location.href='/mypage/product/oemregister'">제품등록</button>
			</div>
		</div>
    </div>
</div>
        	
<script>
$(document).ready(function () {
    $('#keyword').on('keypress', function(event) {
        if(event.keyCode == 13) { 
            $('#frmSearch').attr('action', '/mypage/product/ownlist');
            $('#frmSearch').submit();
            event.preventDefault(); 
        }
    })

});

function goPage(page) {
    $('#frmSearch').attr('action', '/mypage/product/ownlist/' + page);
    $('#frmSearch').submit();
}
</script>