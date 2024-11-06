<div id="wrapper" style="min-height:800px">
        
        <?php $this->load->view('mypage/common/include/nav_v'); ?>
		
        <div id="page-wrapper" class="gray-bg">
            <?php $this->load->view('mypage/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>관심기업/제품 관리</h2>
                </div>
            </div>

        	<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
                	<div class="col-lg-12">
                    	<div class="ibox ">
							<form id="frmSearch" method="post" action="/mypage/wish/list">

								<div class="ibox-content">
									<div class="row">
										<label class="col-lg-2 col-form-label">
											총 <?php echo number_format($total_rows); ?>건
										</label>
                                        <div class="col-lg-6"></div>
										<div class="col-lg-4">
											<input type="text" placeholder="업체명 검색" value="<?php echo  !empty($req)  ? $req['keyword'] : ''; ?>" name="keyword" id="keyword" class="form-control" />
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
                                        <col />
                                        <col />
                                        <col />
                                        <col style="width:15%" />
                                        <col style="width:15%" />
                                    </colgroup>
                                	<thead>
                                		<tr>
											<th class="text-center">no</th>
		                                    <th class="text-center">분류</th>
		                                    <th class="text-center">업체명</th>
		                                    <th class="text-center">제품명</th>
		                                    <th class="text-center">등록일</th>
		                                    <th class="text-center">관리</th>
		                                </tr>
        	                        </thead>
            	                    <tbody>
                                    <?php
										if(count($list) > 0) {
											foreach($list as $row) {
									?>
                                                <tr>
													<td class="text-center"><?php echo $num--; ?></td>
													<td class="text-center">
														<?php
															if($row['target_type'] === '1') {
														?>
															<a href="#" onclick="javascript:goDetail('<?php echo $row['target_cd']; ?>'); return false;">
														<?php

															}
															else {
														?>
															<a href="/product/detail/<?php echo $row['target_type'] === '2' ? 'nb' : 'oem'; ?>/<?php echo $row['target_cd'];?>">
														<?php
															}
														?>
															<?php echo $row['target_type_name']; ?>
														</a>
													</td>
													<td class="text-center">
													<?php
															if($row['target_type'] === '1') {
														?>
															<a href="#" onclick="javascript:goDetail('<?php echo $row['target_cd']; ?>'); return false;">
														<?php
															}
															else {
														?>
															<a href="/product/detail/<?php echo $row['target_type'] === '2' ? 'nb' : 'oem'; ?>/<?php echo $row['target_cd'];?>">
														<?php
															}
														?>
															<?php echo $row['company_name']; ?>
														</a>
													</td>
													<td class="text-center">
															<?php echo $row['product_name']; ?>
													</td>
													<td class="text-center"><?php echo $row['updated_at']; ?></td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnUpdateWish('<?php echo $row['target_type']; ?>', '<?php echo $row['target_cd']; ?>');">삭제</button>
													</td>
                                                </tr>
                                    <?php
											}
										}
										else {
											echo '<tr><td colspan="5" class="text-center">검색된 내용이 없습니다.</td></tr>';	
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
<form id="frmDetail" method="post" action="/domestic/manufacture/detail">
	<input type="hidden" name="member_cd" value="" />
	<input type="hidden" name="biz_no" value="" />
</form>
<script>
function fnUpdateWish(stype, cd) {
	$.ajax({
			url: "/api/wish/update",
			type: "POST",
			data: {source_cd : '<?php echo $member['seq']; ?>', target_type : stype,  target_cd : cd, is_wish: 'n'},
			dataType : 'json',
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					showAlert(data.msg, function(){ location.reload(); });
				}
				else if(data.result == 'login') {
					showAlert(data.msg, function() { location.href='/'; });
				}
				else {
					showAlert(data.msg);
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}

function goDetail(no) {
	$('#frmDetail input[name=biz_no]').val(no);
	$('#frmDetail').submit();
}

</script>