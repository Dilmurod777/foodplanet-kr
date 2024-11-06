<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('mypage/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><?php echo $info['company_name']; ?> 상세 정보</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							   <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">업체명</label>
										<label class="col-lg-4 col-form-label"><?php echo $info['company_name']; ?></label>
                                        <label class="col-lg-2 col-form-label">분류</label>
										<label class="col-lg-4 col-form-label"><?php echo $info['member_type_name']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">사업자등록번호</label>
										<label class="col-lg-4 col-form-label"><?php echo $info['biz_no']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">주소</label>
										<label class="col-lg-10 col-form-label "><?php echo $info['addr'] . ' ' . $info['addr_detail']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">대표자</label>
										<label class="col-lg-4 col-form-label"><?php echo $info['owner_name']; ?></label>
	                                	<label class="col-lg-2 col-form-label">대표 전화번호</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['company_tel']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">담당자명</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['employee_name']; ?></label>
	                                	<label class="col-lg-2 col-form-label">담당자 연락처</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['employee_tel']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">담당자 이메일</label>
										<label class="col-lg-4 col-form-label "><?php echo $info['employee_email']; ?></label>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">회사소개서</label>
	                                    <label class="col-sm-10 col-form-label">
											<?php
												if(!empty($info['introduce_file'])) {
													echo '<a href="/api/common/file_download?file_path=' . $info['introduce_file'] . '&org_file=' . $info['introduce_file_name'] . '" target="_blank">' . $info['introduce_file_name'] . '</a>';
												}
											?>
										</label>
	                                </div>
	                            </div>
	                        
                        </div>
                    </div>
			</div>

			<div class="form-group text-center">
				<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnUpdateWish(); return false;">관심기업 해제</button>
<!--	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:location.href='/mypage/wish/request/<?php echo $info['member_cd']; ?>'; return false;">문의하기</button> -->
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/mypage/wish/list'; return false;">목록으로</button>
			</div>
		</div>
    </div>
</div>
<script>
function fnUpdateWish() {
	$.ajax({
			url: "/api/wish/update",
			type: "POST",
			data: {source_cd : '<?php echo $member['member_cd']; ?>', target_cd : '<?php echo $info['member_cd']; ?>', is_wish: 'n'},
			dataType : 'json',
			async : false,
			success: function(data) {
				if(data.result == 'succ') {
					showAlert(data.msg, function() { location.href='/mypage/wish/list'; });
				}
				else if(data.result == 'login') {
					showAlert(data.msg, function() { location.href='/'});
				}
				else {
					showAlert(data.msg);
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
	});
}
</script>