<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>사용자 관리</h2>
                </div>
            </div>

        	<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
                	<div class="col-lg-12">
                    	<div class="ibox ">
							<form id="frmSearch" method="post" action="/admin/member/list" >
                               	<input type="hidden" name="seq" />
                               	<input type="hidden" name="offset" value="<?php echo !empty($req) ? $req['offset'] : ''; ?>" />

								<div class="ibox-content">
									<div class="row">
										<label class="col-lg-1 col-form-label">
											총 <?php echo number_format($total_rows); ?>건
										</label>
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-2">
                                        </div>
										<div class="col-lg-4">
											<input type="text" placeholder="아이디, 닉네임 검색" value="<?php echo !empty($req) ? $req['keyword'] : ''; ?>" name="keyword" id="keyword" class="form-control" />
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
                                	<thead>
                                		<tr>
											<th class="text-center">no</th>
		                                    <th class="text-center">타입</th>
		                                    <th class="text-center">아이디</th>
		                                    <th class="text-center">이름</th>
		                                    <th class="text-center">연락처</th>
		                                    <th class="text-center">이메일</th>
		                                    <th class="text-center">가입일</th>
		                                    <th class="text-center">회원상태</th>
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
													<td class="text-center"><?php echo $row['member_type_name']; ?></td>
													<td class="text-center">
                                                        <a href="#" onclick="javascript:goDetail('<?php echo $row['seq']; ?>'); return false;">
															<?php echo $row['member_id']; ?>
                                                        </a>
													</td>
													<td class="text-center">
														<a href="#" onclick="javascript:goDetail('<?php echo $row['seq']; ?>'); return false;">
															<?php echo $row['name']; ?>
														</a>
													</td>
													<td class="text-center"><?php echo $row['tel']; ?></td>
                                                    <td class="text-center"><?php echo $row['email'] ?></td>
                                                    <td class="text-center"><?php echo $row['joined_at']; ?></td>
                                                    <td class="text-center">
													<?php 
														if($row['is_leave'] === 'y') {
															echo '탈퇴회원<br>' . $row['leaved_at'];
														}
														else if($row['is_block'] === 'y') {
															echo '차단회원<br>' . $row['blocked_at'];
														}
														else if($row['is_dormant'] === 'y') {
															echo '휴면회원<br>' . $row['dormanted_at'];
														}
														else {
															echo '정상회원';
														}
													?>
													</td>
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
									<tfoot>
                                        <tr>
                                            <td colspan="100%" class="footable-visible">
                                               	<?php echo $pagination; ?>
                                           </td>
                                        </tr>
                                     </tfoot>       	
                            	</table>
                                								
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

    $('select[name=status]').on('change', function() {
        goPage(0);
    })

    $('select[name=level]').on('change', function() {
        goPage(0);
    })
});

function goPage(offset) {
	$('#frmSearch').attr('action', '/admin/member/list');
	$('input[name=offset]').val(offset);
	$('#frmSearch').submit();
}

function goDetail(seq) {
	$('input[name=seq]').val(seq);	
	$('#frmSearch').attr('action', '/admin/member/detail');
	$('#frmSearch').submit();
}

</script>