<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>커뮤니티 상세</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">구분</label>
	                                    <div class="col-lg-4 "><?php echo $info['community_type_name']; ?></div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">제목</label>
                                        <label class="col-lg-10 col-form-label"><?php echo $info['title']; ?></label>
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
												if(!empty($files)) {
													echo '<a href="/api/common/file_download?file_path=' . $files[0]['new_filepath'] . '&org_file=' . $files[0]['org_filename'] . '" target="_blank">';
													echo $files[0]['org_filename'];
													echo '</a>';
												}
											?>
										</label>
	                                </div>

	                            </div>
	                        
                        </div>
						<?php
							if(count($reply) > 0) {
						?>
                        <div class="ibox ">
                            <div class="social-feed-box">
								<div class="social-footer">
								<?php
									foreach($reply as $row) {
								?>
										<div class="social-comment ">
											<a class="float-left">
												<?php
													if(!empty($row['profile_img'])) {
														echo '<img src="/api/common/img_view?img_path=' . $row['profile_img'] . '" alt="프로필이미지">';
													}
													else {
														echo '<img src="/assets/front/images/icon_profile_bg.svg" alt="프로필이미지">';
													}
												?>
											</a>
											<div class="media-body row">
												<div class="col-lg-1">
													<?php echo $row['nickname']; ?>
												</div>
												<div class="col-lg-1">
													<small class="text-muted"><?php echo $row['created_at']; ?></small>
												</div>
												<div class="col-lg-8">
													<?php echo nl2br($row['contents']); ?>
												</div>
												<div class="col-lg-1">
													<button class="btn btn-danger" type="button" onclick="javascript:fnReplyDelete('<?php echo $row['reply_seq']; ?>'); return false;">삭제</button>
												</div>
											</div>

										<?php
											if(count($row['list']) > 0) {
												foreach($row['list'] as $row2) {
										?>
												<div class="social-comment">
														<a class="float-left">
															<?php
																if(!empty($row['profile_img'])) {
																	echo '<img src="/api/common/img_view?img_path=' . $row['profile_img'] . '" alt="프로필이미지">';
																}
																else {
																	echo '<img src="/assets/front/images/icon_profile_bg.svg" alt="프로필이미지">';
																}
															?>
														</a>
														<div class="media-body row">
															<div class="col-lg-1">
																<?php echo $row['nickname']; ?>
															</div>
															<div class="col-lg-1">
																<small class="text-muted"><?php echo $row['created_at']; ?></small>
															</div>
															<div class="col-lg-8">
																<?php echo nl2br($row['contents']); ?>
															</div>
															<div class="col-lg-1">
																<button class="btn btn-danger" type="button" onclick="javascript:fnReplyDelete('<?php echo $row['reply_seq']; ?>'); return false;">삭제</button>
															</div>
														</div>
												</div>

										<?php
												}
											}
										?>
									</div>
								<?php
									}
								?>
								</div>
	                        </div>
                        </div>
						<?php
							}
						?>
					</div>
			</div>


			<div class="form-group text-center">
				<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnDelete(); return false;">삭제</button>
<!--	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:location.href='/admin/notice/edit/<?php echo $info['notice_seq']; ?>'; return false;">수정</button> -->
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/community/list'; return false;">목록으로</button>
			</div>
		</div>
    </div>
</div>
				
<script>
function fnDelete()
{
	if(!confirm('게시글을 삭제하시겠습니까?')) {
		return;
	}
	$.ajax({
       	type:'POST',
    	url:'/api/community/delete2',
		data : { community_seq : '<?php echo $info['community_seq']; ?>' },
		dataType:"json",
		success:function(data){
       		if(typeof(data.result) == 'login') {
       			alert('로그인이 필요합니다.')
                location.href='/admin/login';
       		}
       		else if(data.result== 'fail') {
                alert(data.msg);
       		}
       		else {
                alert(data.msg);
                location.href='/admin/community/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

function fnReplyDelete(seq)
{
	if(!confirm('댓글을 삭제하시겠습니까?')) {
		return;
	}
	$.ajax({
       	type:'POST',
    	url:'/api/community/reply_delete2',
		data : { reply_seq : seq },
		dataType:"json",
		success:function(data){
       		if(typeof(data.result) == 'login') {
       			alert('로그인이 필요합니다.')
                location.href='/admin/login';
       		}
       		else if(data.result== 'fail') {
                alert(data.msg);
       		}
       		else {
                alert(data.msg);
                location.reload();
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

</script>