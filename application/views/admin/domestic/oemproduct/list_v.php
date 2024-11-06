	<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>국내 데이터 - OEM제품 관리</h2>
                </div>
            </div>

        	<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
                	<div class="col-lg-12">
                    	<div class="ibox ">
							<form id="frmSearch" method="post" action="/admin/domestic/oemproduct/list" >
                               	<input type="hidden" name="seq" />
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
											<input type="text" placeholder="제조사명, 제품명 검색" value="<?php echo !empty($req) ? $req['keyword'] : ''; ?>" name="keyword" id="keyword" class="form-control" />
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
									<a href="/admin/domestic/oemproduct/register" class="btn btn-primary">OEM제품등록</a>
								</div>

                            	<table class="footable table table-stripped">
                                	<thead>
                                		<tr>
											<th class="text-center">no</th>
		                                    <th class="text-center">제조사명</th>
		                                    <th class="text-center">제품명</th>
		                                    <th class="text-center">카테고리</th>
		                                    <th class="text-center">Tags</th>
		                                    <th class="text-center">식품유형</th>
		                                    <th class="text-center">대표제품</th>
		                                    <th class="text-center">등록일</th>
		                                    <th class="text-center">조회수</th>
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
                                                        <a href="#" onclick="javascript:goDetail('<?php echo $row['seq']; ?>'); return false;">
															<?php echo $row['company_name']; ?>
                                                        </a>
													</td>
													<td class="text-center">
                                                        <a href="#" onclick="javascript:goDetail('<?php echo $row['seq']; ?>'); return false;">
															<?php echo $row['product_name']; ?>
                                                        </a>
													</td>
													<td class="text-center"><?php echo $row['category_name']; ?></td>
													<td class="text-center"><?php echo $row['tags']; ?></td>
													<td class="text-center"><?php echo $row['product_type']; ?></td>
													<td class="text-center"><?php echo $row['is_main'] === 'y' ? 'O' : ''; ?></td>
													<td class="text-center"><?php echo $row['created_at']; ?></td>
													<td class="text-center"><?php echo number_format($row['hit_cnt']); ?></td>
                                                </tr>
                                    <?php
												$idx++;
											}
										}
										else {
											echo '<tr><td colspan="100%" class="text-center">검색된 사용자가 없습니다.</td></tr>';	
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

    $('select[name=is_matching]').on('change', function() {
        goPage(0);
    })

});

function goPage(offset) {
	$('#frmSearch').attr('action', '/admin/domestic/oemproduct/list');
	$('input[name=offset]').val(offset);
	$('#frmSearch').submit();
}

function goDetail(seq) {
	$('input[name=seq]').val(seq);	
	$('#frmSearch').attr('action', '/admin/domestic/oemproduct/edit');
	$('#frmSearch').submit();
}

</script>