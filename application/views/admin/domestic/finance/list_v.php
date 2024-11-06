	<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>국내 데이터 - 제조사재무 관리</h2>
                </div>
            </div>

        	<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
                	<div class="col-lg-12">
                    	<div class="ibox ">
							<form id="frmSearch" method="post" action="/admin/domestic/distribution/list" >
                               	<input type="hidden" name="biz_no" />
                               	<input type="hidden" name="base_year" />
                               	<input type="hidden" name="offset" value="<?php echo !empty($req) ? $req['offset'] : ''; ?>" />

								<div class="ibox-content">
									<div class="row">
										<label class="col-lg-1 col-form-label">
											총 <?php echo number_format($total_rows); ?>건
										</label>
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-2">
                                        </div>
										<div class="col-lg-4">
											<input type="text" placeholder="제조사명 검색" value="<?php echo !empty($req) ? $req['keyword'] : ''; ?>" name="keyword" id="keyword" class="form-control" />
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
								<div class="form-group float-right text-right col-lg-6">
									<a href="/admin/domestic/finance/register" class="btn btn-primary">재무정보등록</a>
								</div>

                            	<table class="footable table table-stripped">
                                	<thead>
                                		<tr>
											<th class="text-center">no</th>
		                                    <th class="text-center">제조사명</th>
		                                    <th class="text-center">사업자등록번호</th>
		                                    <th class="text-center">기준연도</th>
		                                    <th class="text-center">연매출</th>
		                                    <th class="text-center">신용등급</th>
		                                    <th class="text-center">등록일</th>
		                                </tr>
        	                        </thead>
            	                    <tbody>
                                    <?php
										if(count($list) > 0) {
											$idx = 0;
											foreach($list as $row) {
									?>
                                                <tr>
													<td class="text-center"><?php echo $num--; ?></td>
													<td class="text-center">
                                                        <a href="#" onclick="javascript:goDetail('<?php echo $row['biz_no']; ?>','<?php echo $row['base_year']; ?>'); return false;">
															<?php echo $row['company_name']; ?>
                                                        </a>
													</td>
													<td class="text-center">
                                                        <a href="#" onclick="javascript:goDetail('<?php echo $row['biz_no']; ?>','<?php echo $row['base_year']; ?>'); return false;">
															<?php echo $row['biz_no']; ?>
                                                        </a>
													</td>
													<td class="text-center"><?php echo $row['base_year']; ?></td>
													<td class="text-center"><?php echo $row['sales_year']; ?></td>
													<td class="text-center"><?php echo $row['credit_rating']; ?></td>
													<td class="text-center"><?php echo $row['created_at']; ?></td>
													</td>
                                                </tr>
                                    <?php
												$idx++;
											}
										}
										else {
											echo '<tr><td colspan="100%" class="text-center">검색된 내용이 없습니다.</td></tr>';	
										}
									?>
                                	</tbody>
                            	</table>
								<div class="footable-visible">
                                    <?php echo $pagination; ?>
                                </td>
                                								
                        	</div>
                    	</div>
                	</div>
            	</div>
                
                                
        	</div>
        	
        </div>
    </div>
<script>
$(document).ready(function () {
    $('#keyword').on('keypress', function(event) {
        if(event.keyCode == '13') { 
            goPage(0); 
            event.preventDefault(); 
        }
    })

});

function goPage(offset) {
	$('#frmSearch').attr('action', '/admin/domestic/finance/list');
	$('input[name=offset]').val(offset);
	$('#frmSearch').submit();
}

function goDetail(seq, year) {
	$('input[name=biz_no]').val(seq);	
	$('input[name=base_year]').val(year);	
	$('#frmSearch').attr('action', '/admin/domestic/finance/edit');
	$('#frmSearch').submit();
}

</script>