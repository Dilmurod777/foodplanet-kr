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
											<input type="text" name="industrial_code" value="<?php echo $info['industrial_code']; ?>" class="form-control" maxlength="5" />
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
	                                	<label class="col-lg-2 col-form-label">직원수</label>
	                                    <div class="col-lg-4">
											<input type="text" name="staff_number" value="<?php echo !empty($info['staff_number']) ? number_format($info['staff_number']) : ''; ?>" class="form-control commifyNumber" />
										</div>
	                                	<label class="col-sm-2 col-form-label">순이익(단위:천원)</label>
	                                    <div class="col-sm-4">
											<input type="text" class="form-control commifyNumber" name="net_profit" value="<?php echo !empty($info['net_profit']) ? number_format($info['net_profit']) : ''; ?>" maxlength="100" />
										</div>
									</div>


	                            </div>
	                        
                        </div>
                    </div>
				</div>				
