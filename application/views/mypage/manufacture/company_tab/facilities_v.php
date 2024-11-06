								<div class="ibox ">
									<div class="ibox-title">
										<h5>설비정보</h5>
									</div>  
									<div class="ibox-content">
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">모델, 라인수</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="model_lines" value="<?php echo !empty($info) ? $info['model_lines'] : ''; ?>" placeholder="보유중인 모델, 라인수를 입력하세요." />
											</div>
										</div>
									</div>

								</div>

								<div class="ibox ">
									<div class="ibox-title">
										<h5>포장기계 보유 현황</h5>
									</div>  
									<div class="ibox-content">
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">밴드실러 기계</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="pack_bandsealer" value="<?php echo !empty($info) ? $info['pack_bandsealer'] : ''; ?>" placeholder="기계정보를 입력하세요. 보유하고 있지 않은경우 '없음'으로 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">용기용 포장 기계</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="pack_container" value="<?php echo !empty($info) ? $info['pack_container'] : ''; ?>" placeholder="기계정보를 입력하세요. 보유하고 있지 않은경우 '없음'으로 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">로타리 포장 기계</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="pack_rotary" value="<?php echo !empty($info) ? $info['pack_rotary'] : ''; ?>" placeholder="기계정보를 입력하세요. 보유하고 있지 않은경우 '없음'으로 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">파우치 형태</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="pack_pouch" value="<?php echo !empty($info) ? $info['pack_pouch'] : ''; ?>" placeholder="기계정보를 입력하세요. 보유하고 있지 않은경우 '없음'으로 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">롤 필름</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="pack_rollfilm" value="<?php echo !empty($info) ? $info['pack_rollfilm'] : ''; ?>" placeholder="기계정보를 입력하세요. 보유하고 있지 않은경우 '없음'으로 입력하세요." />
											</div>
										</div>
									</div>
								</div>

								<div class="ibox ">
									<div class="ibox-title">
										<h5>기타기계 보유 현황</h5>
									</div>  
									<div class="ibox-content">
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">냉동 기계</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="freeze_machine" value="<?php echo !empty($info) ? $info['freeze_machine'] : ''; ?>" placeholder="기계정보를 입력하세요. 보유하고 있지 않은경우 '없음'으로 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">기타 기계</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="etc_machine" value="<?php echo !empty($info) ? $info['etc_machine'] : ''; ?>" placeholder="기계정보를 입력하세요. 보유하고 있지 않은경우 '없음'으로 입력하세요." />
											</div>
										</div>
									</div>
								</div>								
								
								<div class="ibox ">
									<div class="ibox-title" style="border:none">
										<h5>이물질 검출기 보유 현황</h5>
									</div>  
									<div class="ibox-content">
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">엑스레이 검출기</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="detector_xray" value="<?php echo !empty($info) ? $info['detector_xray'] : ''; ?>" placeholder="기계정보를 입력하세요. 보유하고 있지 않은경우 '없음'으로 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">금속 검출기</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="detector_metal" value="<?php echo !empty($info) ? $info['detector_metal'] : ''; ?>" placeholder="기계정보를 입력하세요. 보유하고 있지 않은경우 '없음'으로 입력하세요." />
											</div>
										</div>
									</div>
								</div>

								<div class="ibox ">
									<div class="ibox-title row">
										<div class="col-lg-10">
											<h5>생산 설비 상세 정보 입력 및 이미지 등록 </h5>
										</div>
										<div class="col-lg-2 text-right">
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnAddFacilities();">설비정보추가</button>
										</div>
									</div>  
									<div class="ibox-content" id="facilities_list">
										<?php
											$idx = 1;
											foreach($facilities_list as $row) {
										?>
											<div id="facilities_wrap_<?php echo $idx; ?>">
												<div class="form-group  row">
													<label class="col-sm-2 col-form-label" id="facilities_title_<?php echo $idx; ?>">설비 정보 <?php echo $idx; ?></label>
													<div class="col-sm-4">
														<input type="hidden" name="facilities_idx[]" value="<?php echo $idx; ?>" />
														<input type="hidden" name="detail_seq_<?php echo $idx; ?>" value="<?php echo $row['detail_seq']; ?>" />
														<input type="text" class="form-control" name="facilities_name_<?php echo $idx; ?>" value="<?php echo $row['facilities_name']; ?>" placeholder="설비이름을 입력하세요." />
													</div>
													<div class="col-sm-4" id="facilities_img_wrap_<?php echo $idx; ?>">
														<?php
															if(!empty($row['facilities_img'])) {
																echo '<a href="/api/common/img_view?img_path=' . $row['facilities_img'] . '" target="_blank">';
																echo '<input type="text" style="color:blue;cursor:pointer" value="'  . $row['facilities_img_name'] . '" class="form-control" disabled >';
																echo '</a>';
															}
														?>
													</div>
													<div class="col-sm-1">
														<input type="file" id="facilites_img_file_<?php echo $idx; ?>" name="facilities_img_<?php echo $idx; ?>" data-target="facilities_img_wrap_<?php echo $idx; ?>" style="display:none"  accept="image/jpg, image/jpeg, image/png"  />
														<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#facilites_img_file_<?php echo $idx; ?>').click();">파일찾기</button>
													</div>
												</div>
												<div class="hr-line-dashed"></div>
												<div class="form-group  row">
													<label class="col-sm-2 col-form-label"></label>
													<div class="col-sm-2">
														<input type="text" class="form-control commifyNumber" name="facilities_cnt_<?php echo $idx; ?>" value="<?php echo number_format($row['facilities_cnt']); ?>" placeholder="보유대수를 입력하세요." />
													</div>
													<div class="col-sm-6">
														<input type="text" class="form-control" name="facilities_summary_<?php echo $idx; ?>" value="<?php echo $row['facilities_summary']; ?>" placeholder="설비에 대한 간단한 설명을 입력하세요." />
													</div>
													<div class="col-sm-1 text-right">
														<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnDelFacilities(<?php echo $idx; ?>);">설비정보삭제</button>
													</div>
												</div>
											</div>

										<?php
												$idx++;
											}

										?>
									</div>
								</div>
								<input type="hidden"  name="delete_seq" value=""  />
				
<script>
var index = <?php echo $idx; ?>;
function fnAddFacilities() {
	var len = $('input[name="facilities_idx[]"]').length;

	var str = '<div id="facilities_wrap_' + index + '">'
			+ '		<div class="hr-line-dashed"></div>'
			+ '		<div class="form-group  row">'
			+ '			<label class="col-sm-2 col-form-label" id="facilities_title_' + index + '">설비 정보 ' + (len + 1) + '</label>'
			+ '			<div class="col-sm-4">'
			+ '				<input type="hidden" name="facilities_idx[]" value="' + index + '" />'
			+ '				<input type="hidden" name="detail_seq_' + index + '" value="" />'
			+ '				<input type="text" class="form-control" name="facilities_name_' + index + '" value="" placeholder="설비이름을 입력하세요." />'
			+ '			</div>'
			+ '			<div class="col-sm-4" id="facilities_img_wrap_' + index + '">'
			+ '				<input type="text" class="form-control" disabled placeholder="대표이미지 1장을 선택하세요." />'
			+ '			</div>'
			+ '			<div class="col-sm-1 text-right">'
			+ '				<input type="file" id="facilities_img_file_' + index + '" name="facilities_img_' + index + '" data-target="facilities_img_wrap_' + index + '" style="display:none"  accept="image/jpg, image/jpeg, image/png"  />'
		 	+ '				<button type="button" class="btn btn-w-m btn-primary" onclick="$(\'#facilities_img_file_' + index + '\').click();">파일찾기</button>'
			+ '			</div>'
			+ '		</div>'
			+ '		<div class="hr-line-dashed"></div>'
			+ '		<div class="form-group  row">'
			+ '			<label class="col-sm-2 col-form-label"></label>'
			+ '			<div class="col-sm-2">'
			+ '				<input type="text" class="form-control commifyNumber" name="facilities_cnt_' + index + '" value="" placeholder="보유대수를 입력하세요." />'
			+ '			</div>'
			+ '			<div class="col-sm-6">'
			+ '				<input type="text" class="form-control" name="facilities_summary_' + index + '" value="" placeholder="설비에 대한 간단한 설명을 입력하세요." />'
			+ '			</div>'
			+ '			<div class="col-sm-1 text-right">'
			+ '				<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnDelFacilities(' + index + ');">설비정보삭제</button>'
			+ '			</div>'
			+ '		</div>'
			+ '</div>';
	$('#facilities_list').append(str);
	index++;
}

function fnDelFacilities(idx) {
	if($('input[name=detail_seq_' + idx + ']').val()  !== '') {
		var seq = new Array();
		if($('input[name=delete_seq]').val() !== '') {
			seq = $('input[name=delete_seq]').val().split(',');
		}
		seq.push($('input[name=detail_seq_' + idx + ']').val());
		$('input[name=delete_seq]').val(seq.join(','));
	}

	$('#facilities_wrap_' + idx).remove();
	$('input[name="facilities_idx[]"]').each(function(i) {
		var val = $(this).val();
		$('#facilities_title_' + val).html('설비 정보 ' + (i + 1));
	});
}
</script>