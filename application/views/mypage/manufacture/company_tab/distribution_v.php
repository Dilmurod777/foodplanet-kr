								<div class="ibox ">
									<div class="ibox-title">
										<h5>유통 현황</h5>
									</div>  
									<div class="ibox-content">
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">입점 채널 현황</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="channel_info" value="<?php echo !empty($info) ? $info['channel_info'] : ''; ?>" placeholder="온/오프라인 입점 채널 정보를 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">채널별 경쟁제품 현황</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="competitive_product" value="<?php echo !empty($info) ? $info['competitive_product'] : ''; ?>" placeholder="경쟁제품이 있는 경우 해당 제품의 판매 채널을 입력하세요." />
											</div>
										</div>
									</div>

								</div>

								<div class="ibox ">
									<div class="ibox-title">
										<h5>수출 현황</h5>
									</div>  
									<div class="ibox-content">
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">수출 국가</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="export_nation" value="<?php echo !empty($info) ? $info['export_nation'] : ''; ?>" placeholder="현재 수출중인 국가를 입력하세요. 없는 경우 '없음'을 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">수출 진행사항</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="export_progress" value="<?php echo !empty($info) ? $info['export_progress'] : ''; ?>" placeholder="수출 예정중인 국가를 입력하세요. 없는 경우 '없음'을 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">자사제품 수출 국가</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="own_nation" value="<?php echo !empty($info) ? $info['own_nation'] : ''; ?>" placeholder="현재 자사제품이 수출 중인 국가를 입력하세요. 없는 경우 '없음'을 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">OEM제품 수출 국가</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="oem_nation" value="<?php echo !empty($info) ? $info['oem_nation'] : ''; ?>" placeholder="현재 OEM제품이 수출 중인 국가를 입력하세요. 없는 경우 '없음'을 입력하세요." />
											</div>
										</div>
									</div>
								</div>
				
