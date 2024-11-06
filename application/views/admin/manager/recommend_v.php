<div id="wrapper">
    	<?php 
			$this->load->view('/admin/common/include/nav_v'); 
		?>
		
        <div id="page-wrapper" class="gray-bg">
	    	<?php $this->load->view('/admin/common/include/top_v'); ?>
			
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>메인추천 관리</h2>
                </div>
            </div>

        	<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<form id="frmSave" style="width:100%">
						<div class="col-lg-12">

							<div class="ibox ">
								<div class="ibox-title">
									<h5>추천제조사</h5>
								</div>
								<div class="ibox-content">

									<div class="form-group  row">
										<label class="col-lg-2 col-form-label">제목</label>
										<div class="col-lg-10">
											<input type="hidden" name="recommend_seq[]" value="<?php echo $company['recommend_seq']; ?>" />
											<input type="text" class="form-control" name="title_<?php echo $company['recommend_seq']; ?>" value="<?php echo $company['title']; ?>" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-lg-2 col-form-label">내용</label>
										<div class="col-lg-10">
											<textarea class="form-control" name="desc_<?php echo $company['recommend_seq']; ?>" rows="5"><?php echo $company['desc']; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-sm-2 col-form-label">대표이미지</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="img_url_<?php echo $company['recommend_seq']; ?>" value="<?php echo $company['img_url']; ?>" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-sm-2 col-form-label">사업자등록번호</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="link_url_<?php echo $company['recommend_seq']; ?>" value="<?php echo $company['link_url']; ?>" />
										</div>
									</div>
																
								</div>
							</div>

							<div class="ibox ">
								<div class="ibox-title">
									<h5>추천공고</h5>
								</div>
								<div class="ibox-content">

									<div class="form-group  row">
										<label class="col-lg-2 col-form-label">제목</label>
										<div class="col-lg-10">
											<input type="hidden" name="recommend_seq[]" value="<?php echo $notice['recommend_seq']; ?>" />
											<input type="text" class="form-control" name="title_<?php echo $notice['recommend_seq']; ?>" value="<?php echo $notice['title']; ?>" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-lg-2 col-form-label">내용</label>
										<div class="col-lg-10">
											<textarea class="form-control" name="desc_<?php echo $notice['recommend_seq']; ?>" rows="5"><?php echo $notice['desc']; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-sm-2 col-form-label">대표이미지</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="img_url_<?php echo $notice['recommend_seq']; ?>" value="<?php echo $notice['img_url']; ?>" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-sm-2 col-form-label">링크URL</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="link_url_<?php echo $notice['recommend_seq']; ?>" value="<?php echo $notice['link_url']; ?>" />
										</div>
									</div>
																
								</div>
							</div>

							<?php
								$idx = 1;
								foreach($review as $row) {
							?>
							<div class="ibox ">
								<div class="ibox-title">
									<h5>생생리뷰<?php echo $idx++; ?></h5>
								</div>
								<div class="ibox-content">

									<div class="form-group  row">
										<label class="col-lg-2 col-form-label">제목</label>
										<div class="col-lg-10">
											<input type="hidden" name="recommend_seq[]" value="<?php echo $row['recommend_seq']; ?>" />
											<input type="text" class="form-control" name="title_<?php echo $row['recommend_seq']; ?>" value="<?php echo $row['title']; ?>" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-lg-2 col-form-label">내용</label>
										<div class="col-lg-10">
											<textarea class="form-control" name="desc_<?php echo $row['recommend_seq']; ?>" rows="5"><?php echo $row['desc']; ?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-sm-2 col-form-label">대표이미지</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="img_url_<?php echo $row['recommend_seq']; ?>" value="<?php echo $row['img_url']; ?>" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-sm-2 col-form-label">링크URL</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="link_url_<?php echo $row['recommend_seq']; ?>" value="<?php echo $row['link_url']; ?>" />
										</div>
									</div>
																
								</div>
							</div>

							<?php
								}
							?>


							
						</div>
					</form>
            	</div>
                
                <div class="form-group text-center">
                    <button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">저장</button>
                </div>
                                
        	</div>
        	
        </div>
    </div>

<script>
function fnSave() {
	$.ajax({
	   	type:'POST',
	   	url:'/api/admin/manager/main/register',
		data : $('#frmSave').serialize(),
		dataType:"json",
       	success:function(data){
       		if(typeof(data.result) == 'login') {
                alert(data.msg);
       			location.href = "/admin/login";
       		}
      		else {
                alert(data.msg);
	       		if(data.result == 'succ') {
	      			location.reload();
	       		}
	  		}
	   	},
	    error:function(data){
           	alert("오류가 발생하였습니다.");
	    }
	});
}
</script>