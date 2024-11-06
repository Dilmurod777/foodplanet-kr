<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>공지사항 상세</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">구분</label>
	                                    <div class="col-lg-4 "><?php echo $info['notice_type_name']; ?></div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">썸네일이미지</label>
	                                	<label class="col-sm-10 col-form-label">
											<?php echo '<img src="/api/common/img_view?img_path=' . $info['thumbnail_img'] . '">'; ?>
										</label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">제목</label>
                                        <label class="col-lg-10 col-form-label"><?php echo $info['title']; ?></label>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">내용</label>
                                        <label class="col-lg-10 col-form-label"><?php echo $info['contents']; ?></label>
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
                    </div>
			</div>


			<div class="form-group text-center">
				<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnDelete(); return false;">삭제</button>
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:location.href='/admin/notice/edit/<?php echo $info['notice_seq']; ?>'; return false;">수정</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/notice/list'; return false;">목록으로</button>
			</div>
		</div>
    </div>
</div>
				
<script>
function fnDelete()
{
	if(!confirm('공지사항을 삭제하시겠습니까?')) {
		return;
	}
	$.ajax({
       	type:'POST',
    	url:'/api/notice/delete',
		data : { notice_seq : '<?php echo $info['notice_seq']; ?>' },
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
                location.href='/admin/notice/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

</script>