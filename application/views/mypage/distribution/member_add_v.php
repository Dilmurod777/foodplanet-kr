				<div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
								<div class="ibox-title">
		                            <h5>회사 추가 정보</h5>
	    	                    </div>  
                                <div class="ibox-content">
	                                <div class="form-group  row">

	                                	<label class="col-lg-2 col-form-label">설립일</label>
	                                    <div class="col-lg-4">
										<input type="date" pattern="\d{4}-\d{2}-\d{2}" name="incorporation_at" value="<?php echo $info['incorporation_at']; ?>" class="form-control" />
										</div>
	                                	<label class="col-lg-2 col-form-label">표준산업 분류코드</label>
	                                    <div class="col-lg-4">
											<input type="text" name="industrial_code" value="<?php echo $info['industrial_code']; ?>" class="form-control onlyNumber" maxlength="5" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">국가 비즈니스 유형</label>
	                                    <div class="col-lg-4">
											<input type="text" name="nation_biz_type" value="<?php echo $info['nation_biz_type']; ?>" placeholder="국가별로 콤마(,) 구분하여 입력해 주세요" class="form-control" maxlength="200" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">국가 코트라 무역관 검증 유무</label>
	                                    <div class="col-lg-4">
											<input type="text" name="kotra_apply" value="<?php echo $info['kotra_apply']; ?>" class="form-control" placeholder="국가별 검증유무 입력해주세요." maxlength="200" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">직원수</label>
	                                    <div class="col-sm-4">
											<input type="text" class="form-control commifyNumber" name="staff_number" value="<?php echo !empty($info['staff_number']) ? number_format($info['staff_number']) : ''; ?>" maxlength="100" />
										</div>
	                                	<label class="col-sm-2 col-form-label">순이익(단위:천원)</label>
	                                    <div class="col-sm-4">
											<input type="text" class="form-control commifyNumber" name="net_profit" value="<?php echo !empty($info['net_profit']) ? number_format($info['net_profit']) : ''; ?>" maxlength="100" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">선하증권 및 기타 문서</label>
	                                    <div class="col-sm-4" id="etc_file_wrap">
											<?php
												if(!empty($info['etc_file'])) {
													echo '<a href="/api/common/file_download?file_path=' . $info['etc_file'] . '&org_file=' . $info['etc_file_name'] . '" target="_blank">';
													echo '<input type="text" style="color:blue;cursor:pointer" value="'  . $info['etc_file_name'] . '" class="form-control" disabled>';
													echo '</a>';
												}
											?>
										</div>
										<div class="col-sm-1">
											<input type="file" id="etc_file" name="etc_file" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="$('#etc_file').click();">파일찾기</button>
	                                    </div>
	                                </div>


	                            </div>
	                        
                        </div>
                    </div>
				</div>				
