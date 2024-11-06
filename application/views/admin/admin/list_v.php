<style>
td.box {white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:450px;}
</style>
	<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>관리자 관리</h2>
                </div>
            </div>

        	<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
                	<div class="col-lg-12">
                    	<div class="ibox ">
							<form id="frmSearch" method="post" action="/admin/overseas/document/list" >
                               	<input type="hidden" name="seq" />
                               	<input type="hidden" name="offset" value="<?php echo !empty($req) ? $req['offset'] : ''; ?>" />

								<div class="ibox-content">
									<div class="row">
										<label class="col-lg-1 col-form-label">
											총 <?php echo number_format($total_rows); ?>건
										</label>
                                        <div class="col-lg-7"></div>
										<div class="col-lg-4">
											<input type="text" placeholder="관리자ID, 관리자명 검색" value="<?php echo !empty($req) ? $req['keyword'] : ''; ?>" name="keyword" id="keyword" class="form-control" />
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
									<a href="/admin/admin/register" class="btn btn-primary">관리자등록</a>
								</div>

                            	<table class="footable table table-stripped">
                                	<thead>
                                		<tr>
											<th class="text-center">no</th>
		                                    <th class="text-center">관리자ID</th>
		                                    <th class="text-center">관리자명</th>
		                                    <th class="text-center">연락처</th>
		                                    <th class="text-center">이메일</th>
		                                    <th class="text-center">마지막 로그인</th>
		                                    <th class="text-center">최종 수정일</th>
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
                                                        <a href="#" onclick="javascript:goDetail('<?php echo $row['admin_seq']; ?>'); return false;">
															<?php echo $row['admin_id']; ?>
                                                        </a>
													</td>
													<td class="text-center">
                                                        <a href="#" onclick="javascript:goDetail('<?php echo $row['admin_seq']; ?>'); return false;">
															<?php echo $row['admin_name']; ?>
                                                        </a>
													</td>
													<td class="text-center">
                                                        <a href="#" onclick="javascript:goDetail('<?php echo $row['admin_seq']; ?>'); return false;">
															<?php echo $row['admin_tel']; ?>
                                                        </a>
													</td>
													<td class="text-center box">
                                                        <a href="#" onclick="javascript:goDetail('<?php echo $row['admin_seq']; ?>'); return false;">
															<?php echo $row['admin_email']; ?>
                                                        </a>
													</td>
													<td class="text-center"><?php echo $row['last_logined_at']; ?></td>
													<td class="text-center"><?php echo $row['updated_at']; ?></td>
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
	$('#frmSearch').attr('action', '/admin/admin/list');
	$('input[name=offset]').val(offset);
	$('#frmSearch').submit();
}

function goDetail(seq) {
	$('#frmSearch').attr('action', '/admin/admin/edit');
	$('input[name=seq]').val(seq);
	$('#frmSearch').submit();
}

</script>
