							<div class="ibox ">
								<div class="ibox-content pc-only">
									<div class="panel-body" >
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label"></label>
											<div class="col-sm-4 text-center">
												최근입력 <?php echo !empty($info['updated_at']) ? '(' . $info['updated_at'] . ')' : '' ?>
											</div>
											<div class="col-sm-4 text-center">
												새 데이터 입력
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">일일 생산 가능량</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" name="old_manufacture_day" value="<?php echo !empty($info) ? number_format($info['manufacture_day']) : '0'; ?>" readonly />
											</div>
											<div class="col-sm-4">
												<input type="text" class="form-control commifyNumber" name="manufacture_day" value="" />
											</div>
											<div class="col-sm-1">
												<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnCopyData('manufacture_day');">이전과동일</button>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">현재 월 생산 가능량</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" name="old_manufacture_month" value="<?php echo !empty($info) ? number_format($info['manufacture_month']) : '0'; ?>" readonly />
											</div>
											<div class="col-sm-4">
												<input type="text" class="form-control commifyNumber" name="manufacture_month" value="" />
											</div>
											<div class="col-sm-1">
												<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnCopyData('manufacture_month');">이전과동일</button>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">현재 일 창고 적재가능 수량</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" name="old_load_cnt" value="<?php echo !empty($info) ? number_format($info['load_cnt']) : '0'; ?>" readonly />
											</div>
											<div class="col-sm-4">
												<input type="text" class="form-control commifyNumber" name="load_cnt" value="" />
											</div>
											<div class="col-sm-1">
												<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnCopyData('load_cnt');">이전과동일</button>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">연간 생산 실적</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" name="old_manufacture_year" value="<?php echo !empty($info) ? number_format($info['manufacture_year']) :  '0'; ?>" readonly />
											</div>
											<div class="col-sm-4">
												<input type="text" class="form-control commifyNumber" name="manufacture_year" value="" />
											</div>
											<div class="col-sm-1">
												<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnCopyData('manufacture_year');">이전과동일</button>
											</div>
										</div>
										
									</div>
								</div>

								<div class="ibox-content mo-only">
									<div class="panel-body" >
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">일일 생산 가능량</label>
											<div class="col-sm-2">
												최근입력 <?php echo !empty($info['updated_at']) ? '(' . $info['updated_at'] . ')' : ''; ?>
											</div>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?php echo !empty($info) ? number_format($info['manufacture_day']) : '0'; ?>" readonly />
											</div>
											<div class="col-sm-2">
												새 데이터 입력
											</div>
											<div class="col-sm-10">
												<input type="text" class="form-control commifyNumber" id="manufacture_day" value="" />
											</div>
											<div class="col-sm-1 text-right">
												<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnCopyData('manufacture_day');">이전과동일</button>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">현재 월 생산 가능량</label>
											<div class="col-sm-2">
												최근입력 <?php echo !empty($info['updated_at']) ? '(' . $info['updated_at'] . ')' : ''; ?>
											</div>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?php echo !empty($info) ? number_format($info['manufacture_month']) : '0'; ?>" readonly />
											</div>
											<div class="col-sm-2">
												새 데이터 입력
											</div>
											<div class="col-sm-10">
												<input type="text" class="form-control commifyNumber" id="manufacture_month" value="" />
											</div>
											<div class="col-sm-1 text-right">
												<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnCopyData('manufacture_month');">이전과동일</button>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">현재 일 창고 적재가능 수량</label>
											<div class="col-sm-2">
												최근입력 <?php echo !empty($info['updated_by']) ? '(' . $info['updated_by'] . ')' : ''; ?>
											</div>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?php echo !empty($info) ? number_format($info['load_cnt']) : '0'; ?>" readonly />
											</div>
											<div class="col-sm-2">
												새 데이터 입력
											</div>
											<div class="col-sm-10">
												<input type="text" class="form-control commifyNumber" id="load_cnt" value="" />
											</div>
											<div class="col-sm-1 text-right">
												<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnCopyData('load_cnt');">이전과동일</button>
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-sm-2 col-form-label">연간 생산 실적</label>
											<div class="col-sm-2">
												최근입력 <?php echo !empty($info['updated_at']) ? '(' . $info['updated_at'] . ')' : ''; ?>
											</div>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?php echo !empty($info) ? number_format($info['manufacture_year']) : '0'; ?>" readonly />
											</div>
											<div class="col-sm-2">
												새 데이터 입력
											</div>
											<div class="col-sm-10">
												<input type="text" class="form-control commifyNumber" id="manufacture_year" value="" />
											</div>
											<div class="col-sm-1 text-right">
												<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnCopyData('manufacture_year');">이전과동일</button>
											</div>
										</div>
										
									</div>
								</div>
							</div>
<script>
function fnCopyData(data) {
	var val = $('input[name=old_' + data + ']').val();

	if(val == '') {
		showAlert('이전에 등록된 데이터가 없습니다.');
		return;
	}
	$('input[name=' + data + ']').val(val);
	$('#' + data).val(val);
}

</script>				

