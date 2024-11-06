				<div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
								<div class="ibox-title">
		                            <h5>회사 추가 정보</h5>
	    	                    </div>  
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">주소</label>
	                                    <div class="col-lg-10">
											<div class="col-sm-3 input-group">
												<input type="text" class="form-control" name="zonecode" id="zonecode" readonly placeholder="우편번호" value="<?php echo $info['zonecode']; ?>" onclick="javascript:execDaumPostcode($('#zonecode'), $('#addr'));"/>
												<span class="input-group-append">
													<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:execDaumPostcode($('#zonecode'), $('#addr'));">검색</button>
												</span>
											</div>
											<div class="col-sm-12" style="margin-top:10px;">
												<input type="text" class="form-control" name="addr" id="addr" placeholder="기본주소" value="<?php echo $info['addr']; ?>" readonly onclick="javascript:execDaumPostcode($('#zonecode'), $('#addr'));"/>
												<input type="text" class="form-control" name="addr_detail" placeholder="상세주소" value="<?php echo $info['addr_detail']; ?>" style="margin-top:10px" maxlength="100" />
											</div>
										</div>
									</div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">

	                                	<label class="col-lg-2 col-form-label">설립일</label>
	                                    <div class="col-lg-4">
										<input type="date" pattern="\d{4}-\d{2}-\d{2}" name="incorporation_at" value="<?php echo $info['incorporation_at']; ?>" class="form-control" />
										</div>
	                                	<label class="col-lg-2 col-form-label">표준산업 분류코드</label>
	                                    <div class="col-lg-4">
											<input type="text" name="industrial_code" value="<?php echo preg_replace('/[^0-9]*/s', '', $info['industrial_code']); ?>" class="form-control onlyNumber" maxlength="5" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-lg-2 col-form-label">시설규모(단위:천원)</label>
	                                    <div class="col-lg-4">
											<input type="text" name="facilities_scale" value="<?php echo !empty($info['facilities_scale']) ? number_format($info['facilities_scale']) : ''; ?>" class="form-control commifyNumber" maxlength="45" />
										</div>
	                                	<label class="col-lg-2 col-form-label">직원수</label>
	                                    <div class="col-lg-4">
											<input type="text" name="staff_number" value="<?php echo !empty($info['staff_number']) ? number_format($info['staff_number']) : ''; ?>" class="form-control commifyNumber" />
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">연매출(단위:천원)</label>
	                                    <div class="col-sm-4">
											<input type="text" class="form-control commifyNumber" name="year_sales" value="<?php echo !empty($info['year_sales']) ? number_format($info['year_sales']) : ''; ?>" maxlength="100" />
										</div>
	                                	<label class="col-sm-2 col-form-label">영업이익(단위:천원)</label>
	                                    <div class="col-sm-4">
											<input type="text" class="form-control commifyNumber" name="biz_profit" value="<?php echo !empty($info['biz_profit']) ? number_format($info['biz_profit']) :''; ?>" maxlength="100" />
										</div>
									</div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">순이익(단위:천원)</label>
	                                    <div class="col-sm-4">
											<input type="text" class="form-control commifyNumber" name="net_profit" value="<?php echo !empty($info['net_profit'])  ? number_format($info['net_profit']) : ''; ?>" maxlength="100" />
										</div>
									</div>


	                            </div>
	                        
                        </div>
                    </div>
				</div>				

	            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
								<div class="ibox-title">
		                            <h5>회사 페이지 정보</h5>
	    	                    </div>  
                                <div class="ibox-content">
								<div class="form-group  row">
										<label class="col-sm-2 col-form-label">회사 대표이미지(로고 등)</label>
	                                    <div class="col-sm-4" id="logo_img_wrap">
											<?php
												if(!empty($info['logo_img'])) {
													echo '<a href="/api/common/img_view?img_path=' . $info['logo_img'] . '" target="_blank">';
													echo '<input type="text" style="color:blue;cursor:pointer" value="'  . $info['logo_img_name'] . '" class="form-control" disabled>';
													echo '</a>';
												}
											?>
										</div>
										<div class="col-sm-1">
											<input type="file" id="logo_img_file" name="logo_img" style="display:none"  accept="image/jpg, image/jpeg, image/png"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="$('#logo_img_file').click();">파일찾기</button>
	                                    </div>
	                                </div>

									<div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">페이지 상단 배경이미지</label>
	                                    <div class="col-sm-4" id="top_img_wrap">
											<?php
												if(!empty($info['bizcard_file'])) {
													echo '<a href="/api/common/img_view?img_path=' . $info['top_img'] . '" target="_blank">';
													echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $info['top_img_name'] . '" class="form-control" disabled>';
													echo '</a>';
												}
											?>
										</div>
										<div class="col-sm-1">
											<input type="file" id="top_img_file" name="top_img" style="display:none"  accept="image/jpg, image/jpeg, image/png"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="$('#top_img_file').click();">파일찾기</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">

	                                	<label class="col-lg-2 col-form-label">회사 영문명</label>
	                                    <div class="col-lg-10">
											<input type="text" name="company_name_eng" value="<?php echo $info['company_name_eng']; ?>" class="form-control" />
										</div>
									</div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">

	                                	<label class="col-lg-2 col-form-label">대표태그 입력</label>
	                                    <div class="col-lg-10">
											<input type="text" name="tags" value="<?php echo $info['tags']; ?>" class="form-control" placeholder="회사를 표현할 태그를 쉼표 단위로 동륵하세요. (최대 5개 등록 가능)" />
										</div>
									</div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">

	                                	<label class="col-lg-2 col-form-label">한줄 소개</label>
	                                    <div class="col-lg-10">
											<input type="text" name="summary" value="<?php echo $info['summary']; ?>" class="form-control" placeholder="간단한 회사 소개를 압력하세요. (최대 100자 입력가능)" maxlength="100" />
										</div>
									</div>


	                            </div>
	                        
                        </div>
                    </div>
				</div>			

