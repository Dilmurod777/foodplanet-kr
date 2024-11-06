<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>공지사항 관리</h2>
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
                                            <select name="notice_type" class="form-control">
                                                <option value="">전체</option>
                                                <option value="news" <?php echo !empty($req) && $req['notice_type'] == 'news' ? 'selected' : ''; ?>>뉴스</option>
                                                <option value="event" <?php echo !empty($req) && $req['notice_type'] == 'event' ? 'selected' : ''; ?>>이벤트</option>
                                            </select>
                                        </div>
										<div class="col-lg-4">
											<input type="text" placeholder="제목, 내용 검색" value="<?php echo !empty($req) ? $req['keyword'] : ''; ?>" name="keyword" id="keyword" class="form-control" />
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
		                                    <th class="text-center">구분</th>
		                                    <th class="text-center">제목</th>
		                                    <th class="text-center">조회수</th>
		                                    <th class="text-center">등록자</th>
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
													<td class="text-center"><?php echo $row['notice_type_name']; ?></td>
													<td class="text-center">
														<a href="/admin/notice/detail/<?php echo $row['notice_seq']; ?>">
															<?php echo $row['title']; ?>
														</a>
													</td>
													<td class="text-center"><?php echo number_format($row['hit_cnt']); ?></td>
													<td class="text-center"><?php echo $row['created_by']; ?></td>
                                                    <td class="text-center"><?php echo $row['created_at'] ?></td>
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


			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:location.href='/admin/notice/register'; return false;">공지사항등록</button>
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
	$('#frmSearch').attr('action', '/admin/notice/list');
	$('input[name=offset]').val(offset);
	$('#frmSearch').submit();
}

</script>