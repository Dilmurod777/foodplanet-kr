<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>QNA 상세</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                                <div class="ibox-content">
									<div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">문의자ID</label>
                                        <label class="col-lg-4 col-form-label"><?php echo $info['member_id']; ?></label>
                                        <label class="col-lg-2 col-form-label">회사명</label>
                                        <label class="col-lg-4 col-form-label"><?php echo $info['company_name']; ?></label>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">담당자명</label>
                                        <label class="col-lg-4 col-form-label"><?php echo $info['employee_name']; ?></label>
                                        <label class="col-lg-2 col-form-label">담당자 연락처</label>
                                        <label class="col-lg-4 col-form-label"><?php echo $info['employee_tel']; ?></label>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">담당자 이메일</label>
                                        <label class="col-lg-4 col-form-label"><?php echo $info['employee_email']; ?></label>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">내용</label>
                                        <label class="col-lg-10 col-form-label"><?php echo nl2br($info['contents']); ?></label>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">첨부파일</label>
	                                	<label class="col-sm-10 col-form-label">
										<?php
											foreach($files as $row) {
												echo '<div><a href="/api/common/file_download?file_path=' . $row['new_filepath'] . '&org_file=' . $row['org_filename'] . '">' . $row['org_filename'] . '</a></div>';
											}
										?>
										</label>
	                                </div>

	                            </div>
	                        
                        </div>

						<?php
							if($info['is_answer'] === 'y') {
						?>
                        <div class="ibox ">
                                <div class="ibox-content">
									<div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">답변자</label>
                                        <label class="col-lg-4 col-form-label"><?php echo $info['answered_by']; ?></label>
                                        <label class="col-lg-2 col-form-label">답변일시</label>
                                        <label class="col-lg-4 col-form-label"><?php echo $info['answered_at']; ?></label>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">제목</label>
                                        <label class="col-lg-10 col-form-label"><?php echo $info['answer_title']; ?></label>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">내용</label>
                                        <label class="col-lg-10 col-form-label"><?php echo nl2br($info['answer']); ?></label>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">첨부파일</label>
	                                	<label class="col-sm-10 col-form-label">
										<?php
											foreach($files2 as $row) {
												echo '<div><a href="/api/common/file_download?file_path=' . $row['new_filepath'] . '&org_file=' . $row['org_filename'] . '">' . $row['org_filename'] . '</a></div>';
											}
										?>
										</label>
	                                </div>

	                            </div>
	                        
                        </div>

						<?php
							}
						?>

					</div>
			</div>


			<div class="form-group text-center">
				<?php
					if($info['is_answer'] === 'n') {
				?>
					<button type="button" class="btn btn-w-m btn-success" onclick="javascript:location.href='/admin/board/qna_answer/<?php echo $info['qna_seq']; ?>'; return false;">답변등록</button>
				<?php
					}
				?>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/board/qna_list'; return false;">목록으로</button>
			</div>
		</div>
    </div>
</div>
				
