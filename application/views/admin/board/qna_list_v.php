<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>QNA 관리</h2>
                </div>
            </div>

        	<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
                	<div class="col-lg-12">
                    	<div class="ibox ">
							<form id="frmSearch" method="post" action="/admin/notice/detail" >
                               	<input type="hidden" name="notice_seq" />
                               	<input type="hidden" name="offset" value="<?php echo !empty($req) ? $req['offset'] : ''; ?>" />

								<div class="ibox-content">
									<div class="row">
										<label class="col-lg-1 col-form-label">
											총 <?php echo number_format($total_rows); ?>건
										</label>
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-2">
                                            <select name="is_answer" class="form-control">
                                                <option value="">답변여부전체</option>
                                                <option value="y" <?php echo !empty($req) && $req['is_answer'] == 'y' ? 'selected' : ''; ?>>답변완료</option>
                                                <option value="n" <?php echo !empty($req) && $req['is_answer'] == 'n' ? 'selected' : ''; ?>>미답변</option>
                                            </select>
                                        </div>
										<div class="col-lg-4">
											<input type="text" placeholder="문의 제목, 내용 검색" value="<?php echo !empty($req) ? $req['keyword'] : ''; ?>" name="keyword" id="keyword" class="form-control" />
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
		                                    <th class="text-center">작성자ID</th>
		                                    <th class="text-center">회사</th>
		                                    <th class="text-center">담당자 이름</th>
		                                    <th class="text-center">담당자 연락처</th>
		                                    <th class="text-center">담당자 이메일</th>
		                                    <th class="text-center">문의일</th>
		                                    <th class="text-center">답변여부</th>
		                                    <th class="text-center">답변자</th>
		                                    <th class="text-center">답변일</th>
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
													<td class="text-center"><?php echo $row['member_id']; ?></td>
													<td class="text-center"><a href="/admin/board/qna_detail/<?php echo $row['qna_seq']; ?>"><?php echo $row['company_name']; ?></a></td>
													<td class="text-center"><a href="/admin/board/qna_detail/<?php echo $row['qna_seq']; ?>"><?php echo $row['employee_name']; ?></a></td>
													<td class="text-center"><a href="/admin/board/qna_detail/<?php echo $row['qna_seq']; ?>"><?php echo $row['employee_tel']; ?></a></td>
													<td class="text-center"><a href="/admin/board/qna_detail/<?php echo $row['qna_seq']; ?>"><?php echo $row['employee_email']; ?></a></td>
                                                    <td class="text-center"><?php echo $row['question_at'] ?></td>
													<td class="text-center"><?php echo $row['is_answer'] === 'y' ? '답변완료' : '미답변'; ?></td>
                                                    <td class="text-center"><?php echo $row['answered_by'] ?></td>
                                                    <td class="text-center"><?php echo $row['answered_at'] ?></td>
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
			</form>

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

    $('select[name=is_answer]').on('change', function() {
        goPage(0);
    })

});

function goPage(offset) {
	$('#frmSearch').attr('action', '/admin/notice/list');
	$('input[name=offset]').val(offset);
	$('#frmSearch').submit();
}

</script>