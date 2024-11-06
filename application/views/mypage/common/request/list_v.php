<div id="wrapper">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('mypage/common/include/top_v'); ?>
        
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>의뢰/견적/문의 관리</h2>
                </div>
            </div>

        	<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
                	<div class="col-lg-12">
                    	<div class="ibox ">
							<form id="frmSearch" method="get" action="/mypage/request/list" >
                               	<input type="hidden" name="seq" />

								<div class="ibox-content">
									<div class="row">
										<label class="col-lg-1 col-form-label">
											총 <?php echo number_format($total_rows); ?>건
										</label>
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-2">
                                            <select name="req_type" class="form-control">
                                                <option value="">전체</option>
                                                <option value="1" <?php echo !empty($req['req_type']) && $req['req_type'] == '1' ? 'selected' : ''; ?>>의뢰</option>
                                                <option value="2" <?php echo !empty($req['req_type']) && $req['req_type'] == '2' ? 'selected' : ''; ?>>견적</option>
                                                <option value="3" <?php echo !empty($req['req_type']) && $req['req_type'] == '3' ? 'selected' : ''; ?>>문의</option>
                                            </select>
                                        </div>
										<div class="col-lg-4">
											<input type="text" placeholder="요청업체명 검색" value="<?php echo  !empty($req) ? $req['keyword'] : ''; ?>" name="keyword" id="keyword" class="form-control" />
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
                                        <col style="width:10%">
                                        <col style="width:10%" />
                                        <col />
                                        <col />
                                        <col />
                                    </colgroup>
                                	<thead>
                                		<tr>
											<th class="text-center">no</th>
		                                    <th class="text-center">분류</th>
		                                    <th class="text-center">제목</th>
		                                    <th class="text-center">요청업체</th>
		                                    <th class="text-center">작성일</th>
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
													<td class="text-center"><?php echo $row['req_type_name']; ?> </td>
													<td class="text-center">
                                                        <a href="/mypage/request/detail/<?php echo $row['request_seq']; ?>">
															<?php 
                                                                if($row['req_type'] == '1') {
                                                                    echo '<' . $row['req_title'] . '> 의뢰서';
                                                                } 
                                                                else if($row['req_type'] == '2') {
                                                                    echo '<' . $row['req_title'] . '> 견적서';
                                                                }
                                                                else {
                                                                    echo $row['req_title']; 
                                                                }
                                                            ?>
                                                        </a>
													</td>
													<td class="text-center">
                                                        <?php 
                                                            echo $row['req_member_cd'] === $member['member_cd'] ? $row['target_company_name'] : $row['req_company_name']; 
                                                        ?>
                                                    </td>
                                                    <td class="text-center"><?php echo $row['requested_at']; ?></td>
                                                </tr>
                                    <?php
												$idx++;
											}
										}
										else {
											echo '<tr><td colspan="5" class="text-center">검색된 요청이 없습니다.</td></tr>';	
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
<script>
$(document).ready(function () {
    $('#keyword').on('keypress', function(event) {
        if(event.keyCode == 13) { 
            $('#frmSearch').attr('action', '/mypage/request/list');
            $('#frmSearch').submit();
            event.preventDefault(); 
        }
    })

    $('select[name=req_type]').on('change', function() {
        $('#frmSearch').submit();
    })

});

function goPage(page) {
    $('#frmSearch').attr('action', '/mypage/request/list/' + page);
    $('#frmSearch').submit();
}
</script>