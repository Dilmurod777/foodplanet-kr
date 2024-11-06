								<div class="ibox ">
									<div class="ibox-content">
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">인증 현황</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="haccp" value="<?php echo !empty($info) ? $info['haccp'] : ''; ?>" placeholder="인증받은 HACCP 개수를 입력하세요. 없는 경우 '없음'으로 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">특허 현황</label>
											<div class="col-sm-10">
												<input type="text" class="form-control commifyNumber" name="patent_cnt" value="<?php echo !empty($info) ? $info['patent_cnt'] : ''; ?>" placeholder="특허의 개수를 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">FDA 공장 등록 여부</label>
											<div class="col-sm-10">
												<input type="text" class="form-control commifyNumber" name="patent_cnt" value="<?php echo !empty($info) ? $info['patent_cnt'] : ''; ?>" placeholder="특허의 개수를 입력하세요." />
											</div>
										</div>
									</div>
								</div>

								<div class="ibox ">
									<div class="ibox-title row">
										<div class="col-lg-10">
											<h5>인증 상세 정보 입력 및 이미지 등록 </h5>
										</div>
										<div class="col-lg-2 text-right">
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnAddCert();">인증정보추가</button>
										</div>
									</div>  
									<div class="ibox-content" id="cert_list">
										<?php
											$idx1 = 1;
											foreach($cert_list as $row) {
										?>
											<div id="cert_wrap_<?php echo $idx1; ?>">
												<div class="form-group  row">
													<label class="col-sm-2 col-form-label" id="cert_title_<?php echo $idx1; ?>">인증 정보 <?php echo $idx1; ?></label>
													<div class="col-sm-3">
														<input type="hidden" name="cert_idx[]" value="<?php echo $idx1; ?>" />
														<input type="hidden" name="cert_detail_seq_<?php echo $idx1; ?>" value="<?php echo $row['detail_seq']; ?>" />
														<input type="text" class="form-control" name="cert_name_<?php echo $idx1; ?>" value="<?php echo $row['cert_name']; ?>" placeholder="인증 이름을 입력하세요." />
													</div>
													<div class="col-sm-4" id="cert_img_wrap_<?php echo $idx1; ?>">
														<?php
															if(!empty($row['cert_img'])) {
																echo '<a href="/api/common/img_view?img_path=' . $row['cert_img'] . '" target="_blank">';
																echo '<input type="text" style="color:blue" value="'  . $row['cert_img_name'] . '" class="form-control" disabled style="cursor:pointer">';
																echo '</a>';
															}
														?>
													</div>
													<div class="col-sm-3 text-right form-group">
														<input type="file" id="cert_img_file_<?php echo $idx1; ?>" name="cert_img_<?php echo $idx1; ?>" data-target="cert_img_wrap_<?php echo $idx1; ?>" style="display:none"  accept="image/jpg, image/jpeg, image/png"  />
														<button type="button" class="btn btn-w-m btn-primary" onclick="$('#cert_img_file_<?php echo $idx1; ?>').click();">파일찾기</button>
														<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnDelelteCert(<?php echo $idx1; ?>);">인증정보삭제</button>
													</div>
												</div>
											</div>

										<?php
												$idx1++;
											}
										?>
									</div>
								</div>

								<div class="ibox ">
									<div class="ibox-title row">
										<div class="col-lg-10">
											<h5>특허 상세 정보 입력 및 이미지 등록 </h5>
										</div>
										<div class="col-lg-2 text-right">
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnAddPatent();">특허정보추가</button>
										</div>
									</div>  
									<div class="ibox-content" id="patent_list">
										<?php
											$idx2 = 1;
											foreach($patent_list as $row) {
										?>
											<div id="patent_wrap_<?php echo $idx2; ?>">
												<div class="form-group  row">
													<label class="col-sm-2 col-form-label" id="patent_title_<?php echo $idx2; ?>">특허 정보 <?php echo $idx2; ?></label>
													<div class="col-sm-3">
														<input type="hidden" name="patent_idx[]" value="<?php echo $idx2; ?>" />
														<input type="hidden" name="patent_detail_seq_<?php echo $idx2; ?>" value="<?php echo $row['detail_seq']; ?>" />
														<input type="text" class="form-control" name="patent_name_<?php echo $idx2; ?>" value="<?php echo $row['cert_name']; ?>" placeholder="인증 이름을 입력하세요." />
													</div>
													<div class="col-sm-4" id="patent_img_wrap_<?php echo $idx2; ?>">
														<?php
															if(!empty($row['cert_img'])) {
																echo '<a href="/api/common/img_view?img_path=' . $row['cert_img'] . '" target="_blank">';
																echo '<input type="text" style="color:blue" value="'  . $row['cert_img_name'] . '" class="form-control" disabled style="cursor:pointer">';
																echo '</a>';
															}
														?>
													</div>
													<div class="col-sm-3 text-right form-group">
														<input type="file" id="patent_img_file_<?php echo $idx2; ?>" name="patent_img_<?php echo $idx2; ?>" data-target="patent_img_wrap_<?php echo $idx2; ?>" style="display:none"  accept="image/jpg, image/jpeg, image/png"  />
														<button type="button" class="btn btn-w-m btn-primary" onclick="$('#patent_img_file_<?php echo $idx2; ?>').click();">파일찾기</button>
														<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnDeleltePatent(<?php echo $idx2; ?>);">특허정보삭제</button>
													</div>
												</div>
											</div>

										<?php
												$idx2++;
											}
										?>
									</div>
								</div>						
								<input type="hidden"  name="delete_seq" value="" />
<script>
var index1 = <?php echo $idx1; ?>;
var index2 = <?php echo $idx2; ?>;
function fnAddCert() {
	var len = $('input[name="cert_idx[]"]').length;

	var str = '<div id="cert_wrap_' + index1 + '">'
			+ '		<div class="hr-line-dashed"></div>'
			+ '		<div class="form-group  row">'
			+ '			<label class="col-sm-2 col-form-label" id="cert_title_' + index1 + '">인증 정보 ' + (len + 1) + '</label>'
			+ '			<div class="col-sm-3">'
			+ '				<input type="hidden" name="cert_idx[]" value="' + index1 + '" />'
			+ '				<input type="hidden" name="cert_detail_seq_' + index1 + '" value="" />'
			+ '				<input type="text" class="form-control" name="cert_name_' + index1 + '" value="" placeholder="인증 이름을 입력하세요." />'
			+ '			</div>'
			+ '			<div class="col-sm-4" id="cert_img_wrap_' + index1 + '">'
			+ '				<input type="text" class="form-control" disabled placeholder="대표이미지 1장을 선택하세요." />'
			+ '			</div>'
			+ '			<div class="col-sm-3 text-right form-group">'
			+ '				<input type="file" id="cert_img_file_' + index1 + '" name="cert_img_' + index1 + '" data-target="cert_img_wrap_' + index1 + '" style="display:none"  accept="image/jpg, image/jpeg, image/png"  />'
		 	+ '				<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$(\'#cert_img_file_' + index1 + '\').click();">파일찾기</button>'
			+ '				<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnDelelteCert(' + index1 + ');">인증정보삭제</button>'
			+ '			</div>'
			+ '		</div>'
			+ '</div>';
	$('#cert_list').append(str);
	index1++;
}

function fnDelCert(idx) {
	$('#cert_wrap_' + idx).remove();
	$('input[name="cert_idx[]"]').each(function(i) {
		var val = $(this).val();
		$('#cert_title_' + val).html('인증 정보 ' + (i + 1));
	});
}

function fnAddPatent() {
	var len = $('input[name="patent_idx[]"]').length;

	var str = '<div id="patent_wrap_' + index2 + '">'
			+ '		<div class="hr-line-dashed"></div>'
			+ '		<div class="form-group  row">'
			+ '			<label class="col-sm-2 col-form-label" id="patent_title_' + index2 + '">특허 정보 ' + (len + 1) + '</label>'
			+ '			<div class="col-sm-3">'
			+ '				<input type="hidden" name="patent_idx[]" value="' + index2 + '" />'
			+ '				<input type="hidden" name="patent_detail_seq_' + index2 + '" value="" />'
			+ '				<input type="text" class="form-control" name="patent_name_' + index2 + '" value="" placeholder="특허 이름을 입력하세요." />'
			+ '			</div>'
			+ '			<div class="col-sm-4" id="patent_img_wrap_' + index2 + '">'
			+ '				<input type="text" class="form-control" disabled placeholder="대표이미지 1장을 선택하세요." />'
			+ '			</div>'
			+ '			<div class="col-sm-3 text-right form-group">'
			+ '				<input type="file" id="patent_img_file_' + index2 + '" name="patent_img_' + index2 + '" data-target="patent_img_wrap_' + index2 + '" style="display:none"  accept="image/jpg, image/jpeg, image/png"  />'
		 	+ '				<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$(\'#patent_img_file_' + index2 + '\').click();">파일찾기</button>'
			+ '				<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnDeleltePatent(' + index2 + ');">특허정보삭제</button>'
			+ '			</div>'
			+ '		</div>'
			+ '</div>';
	$('#patent_list').append(str);
	index2++;
}

function fnDelelteCert(idx) {
	if($('input[name=cert_detail_seq_' + idx + ']').val()  !== '') {
		var seq = new Array();
		if($('input[name=delete_seq]').val() !== '') {
			seq = $('input[name=delete_seq]').val().split(',');
		}
		seq.push($('input[name=cert_detail_seq_' + idx + ']').val());
		$('input[name=delete_seq]').val(seq.join(','));
	}

	$('#cert_wrap_' + idx).remove();
	$('input[name="patent_idx[]"]').each(function(i) {
		var val = $(this).val();
		$('#patent_title_' + val).html('특허 정보 ' + (i + 1));
	});
}

function fnDeleltePatent(idx) {
	if($('input[name=patent_detail_seq_' + idx + ']').val()  !== '') {
		var seq = new Array();
		if($('input[name=delete_seq]').val() !== '') {
			seq = $('input[name=delete_seq]').val().split(',');
		}
		seq.push($('input[name=patent_detail_seq_' + idx + ']').val());
		$('input[name=delete_seq]').val(seq.join(','));
	}

	$('#patent_wrap_' + idx).remove();
	$('input[name="patent_idx[]"]').each(function(i) {
		var val = $(this).val();
		$('#patent_title_' + val).html('특허 정보 ' + (i + 1));
	});
}
</script>