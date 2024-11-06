                                <div class="ibox ">
									<div class="ibox-content">
										<div class="form-group  row">
											<label class="col-lg-2 col-form-label">주요 제품</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" name="own_product" value="<?php echo !empty($info) ? $info['own_product']  : ''; ?>" placeholder="주요 제품들을 입력하세요." />
											</div>
										</div>
									</div>

								</div>

								<div class="ibox ">
									<div class="ibox-content">
										<div class="ibox-title">
											<h5>채널별 납품 형황 및 납품처</h5>
										</div>  
                                        <div class="form-group  row pc-only">
    										<label class="col-lg-12 col-form-label text-center">아래 각 채널별 납품처를 입력하세요.</label>
										</div>
										<div class="form-group  row">
											<label class="col-lg-2 col-form-label">온라인</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" name="channel_online" value="<?php echo !empty($info) ? $info['channel_online'] : ''; ?>" placeholder="온라인 채널명을 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-lg-2 col-form-label">오프라인</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" name="channel_offline" value="<?php echo !empty($info) ? $info['channel_offline'] : ''; ?>" placeholder="오프라인 채널명을 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-lg-2 col-form-label">오더 납기일자</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" name="delivery_day" value="<?php echo !empty($info) ? $info['delivery_day'] : ''; ?>" placeholder="오더 후 납기에 걸리는 일자를 일 단위로 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-lg-2 col-form-label">제품별 오더 MOQ</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" name="order_moq" value="<?php echo !empty($info) ? $info['order_moq'] : ''; ?>" placeholder="MOQ 수량을 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-lg-2 col-form-label">NB제품 현황</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" name="nb_product" value="<?php echo !empty($info) ? $info['nb_product'] : ''; ?>" placeholder="현재 취급중인 자사 브랜드를 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-lg-2 col-form-label">제품별 공급단가</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" name="supply_price" value="<?php echo !empty($info) ? $info['supply_price'] : ''; ?>" placeholder="주요 상품의 제품별 공금단가를 입력하세요. 너무 많은 제품이 있는 경우 '제품별상이'로 입력하여도 무방합니다." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-lg-2 col-form-label">용기 타입 및 입수</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" name="type_cnt" value="<?php echo !empty($info) ? $info['type_cnt'] : ''; ?>" placeholder="제품의 용기 타입 및 입수를 입력하세요. 너무 많은 제품이 있는 경우 '제품별상이'로 입력하여도 무방합니다." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-lg-2 col-form-label">유통기한</label>
											<div class="col-lg-10">
												<input type="text" class="form-control" name="expire_day" value="<?php echo !empty($info) ? $info['expire_day'] : ''; ?>" placeholder="제품의 유통기한을 입력하세요." />
											</div>
										</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group  row">
											<label class="col-lg-2 col-form-label">싱품유형 (최대 5개까지 선택가능합니다.)</label>
											<div class="col-lg-10 row">
											<?php
												$selected = explode(',', $info['main_product_cd']);
												foreach($category as $row) {
													echo '<div class="col-lg-3 check_wrap">';
													echo '	<input type="checkbox" id="main_product_cd_' .  $row['sub_code'] . '" name="main_product_cd[]" value="' . $row['sub_code'] . '"  ' . (in_array($row['sub_code'], $selected) ? 'checked': '') . '>';
													echo '	<label for="main_product_cd_' .  $row['sub_code'] . '">' . $row['code_name'] . '</label>';
													echo '</div>';
												}
											?>
											</div>
											<label class="col-lg-2 col-form-label main_product_etc" style="display:<?php echo in_array('29', $selected) ? 'block' : 'none'; ?>"></label>
											<div class="col-lg-10 main_product_etc" style="display:<?php echo in_array('029', $selected) ? 'block' : 'none'; ?>">
												<input type="text" class="form-control" name="main_product_etc" value="<?php echo $info['main_product_etc']; ?>" placeholder="콤마(,)로 구분하여 최대 5개까지 등록가능합니다." />
											</div>
										</div>
									</div>
								</div>

<script>
$(document).ready(function() {
	$('input[name="main_product_cd[]"]').on('click', function(e) {
		var cnt = 0;
		$('input[name="main_product_cd[]"]').each(function() {
			if($(this).is(':checked')) {
				cnt++;
			}
		})

		if(cnt > 5) {
			showAlert('최대 5개까지만 선택가능합니다.');
			e.preventDefault();
			return;
		}
		else {
			if($(this).val() == '029') {
				if($(this).is(':checked')) {
					$('.main_product_etc').show();
				}
				else {
					$('.main_product_etc').hide();
					$('input[name=main_product_etc]').val('');
				}
			}

		}
	});

	$('input[name=main_product_etc').on('input', function() {
		var str = $(this).val().split(',');

		if(str.length > 5)  {
			showAlert('최대 5개까지만 등록이 가능합니다.');
			str.pop();
		}
		$(this).val(str.join(','));
	})
})
</script>