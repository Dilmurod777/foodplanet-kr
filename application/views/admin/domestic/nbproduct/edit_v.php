<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>국내 데이터 - 자사제품 수정</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							<form id="frmSave">
								<input type="hidden" name="seq" value="<?php echo $info['seq']; ?>" />
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">사업자등록번호</label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="biz_no" class="form-control" maxlength="12" readonly value="<?php echo $info['biz_no']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">회사명<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="company_name" class="form-control" maxlength="50" readonly value="<?php echo $info['company_name']; ?>" />
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">제품명<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="product_name" class="form-control" maxlength="50" value="<?php echo $info['product_name']; ?>"  />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">제품설명</label>
										<div class="col-sm-10">
											<textarea name="summary" class="form-control" rows="5"><?php echo $info['summary']; ?></textarea>
	                                    </div>
	                                </div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-lg-2 col-form-label">카테고리<code>*</code></label>
										<div class="col-lg-10 row">
										<?php
											foreach($category as $row) {
												echo '<div class="col-lg-3 check_wrap">';
												echo '	<input type="radio" id="category_' .  $row['sub_code'] . '" name="category" value="' . $row['sub_code'] . '" ' . ($row['sub_code'] === $info['category'] ? 'checked' : '') . ' >';
												echo '	<label for="category_' .  $row['sub_code'] . '">' . $row['code_name'] . '</label>';
												echo '</div>';
											}
										?>
										</div>
										<label class="col-lg-2 col-form-label category_etc" style="display:<?php echo $row['sub_code'] === $info['category'] ? 'block' : 'none'; ?>;"></label>
										<div class="col-lg-10 category_etc" style="display:<?php echo $row['sub_code'] === $info['category'] ? 'block' : 'none'; ?>;">
											<input type="text" class="form-control" name="category_etc" value="" value="<?php echo $info['category_etc']; ?>" />
										</div>
									</div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">대표제품군<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="main_group" class="form-control" maxlength="100" value="<?php echo $info['main_group']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">태그<br>(콤마(,)로 구분하여 입력해주세요)</label>
										<div class="col-sm-4">
											<input type="text" name="tags" class="form-control" maxlength="100" value="<?php echo $info['tags']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">공급단가</label>
										<div class="col-sm-4">
											<input type="text" name="supply_price" class="form-control onlyNumber2" maxlength="50" value="<?php echo number_format($info['supply_price']); ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">MOQ</label>
										<div class="col-sm-4">
											<input type="text" name="moq" class="form-control onlyNumber2" maxlength="50" value="<?php echo number_format($info['moq']); ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">납기일자</label>
										<div class="col-sm-4">
											<input type="text" name="delivery_day" class="form-control onlyNumber" maxlength="50" value="<?php echo $info['delivery_day']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">식품유형</label>
										<div class="col-sm-4">
											<input type="text" name="product_type" class="form-control" maxlength="50" value="<?php echo $info['product_type']; ?>" />
	                                    </div>
	                                </div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-lg-2 col-form-label">무게</label>
										<div class="col-sm-4">
											<input type="text" name="weight" class="form-control " maxlength="20" value="<?php echo $info['weight']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">단위</label>
										<div class="col-sm-4">
											<input type="text" name="unit" class="form-control" maxlength="10" value="<?php echo $info['unit']; ?>" />
	                                    </div>
									</div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">보관방법</label>
										<div class="col-sm-4">
											<input type="text" name="storage" class="form-control" maxlength="50" value="<?php echo $info['storage']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">소비기한</label>
										<div class="col-sm-4">
											<input type="text" name="expire_day" class="form-control" maxlength="50" value="<?php echo $info['expire_day']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">입수</label>
										<div class="col-sm-4">
											<input type="text" name="qty" class="form-control onlyNumber2" maxlength="50" value="<?php echo number_format($info['qty']); ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">입수 단위</label>
										<div class="col-sm-4">
											<input type="text" name="qty_unit" class="form-control" maxlength="10" value="<?php echo $info['qty_unit']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">용기타입</label>
										<div class="col-sm-4">
											<input type="text" name="container_type" class="form-control" maxlength="50" value="<?php echo $info['container_type']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">채널별 납품현황</label>
										<div class="col-sm-4">
											<input type="text" name="channel_status" class="form-control" maxlength="100" value="<?php echo $info['channel_status']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">대표제품</label>
										<div class="col-sm-4 row">
											<div class="col-lg-3 check_wrap">
												<input type="radio" id="is_main_y" name="is_main" value="y" <?php echo $info['is_main'] === 'y' ? 'checked' : ''; ?>  >
												<label for="is_main_y">등록</label>
											</div>
											<div class="col-lg-3 check_wrap">
												<input type="radio" id="is_main_n" name="is_main" value="n" <?php echo $info['is_main'] === 'n' ? 'checked' : ''; ?> >
												<label for="is_main_n">미등록</label>
											</div>
	                                    </div>
	                                </div>

	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">제품이미지1<code>*</code><br>(대표이미지)</label>
	                                    <div class="col-sm-4 filebox" id="prod_img1_wrap">
										<?php 
											if(!empty($prodimg) && !empty($prodimg[0])) {
										?>
											<input type="text" value="<?php echo $prodimg[0]['img_url']; ?>" class="form-control upload-title" disabled />
											<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile('prod_img1', '');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
										<?php
											}
										?>
										</div>
										<div class="col-sm-1">
											<?php 
												if(!empty($prodimg) && !empty($prodimg[0])) {
													echo '<input type="hidden" name="prod_img1_seq" value="' . $prodimg[0]['seq'] . '" />';
													echo '<input type="hidden" name="prod_img1" value="' . $prodimg[0]['img_url'] . '" />';
												}
												else {
													echo '<input type="hidden" name="prod_img1_seq" value="" />';
													echo '<input type="hidden" name="prod_img1" value="" />';
												}
											?>
											<input type="file" id="prod_img1" name="prod_img1_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#prod_img1').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">제품이미지2</label>
	                                    <div class="col-sm-4 filebox" id="prod_img2_wrap">
										<?php 
											if(!empty($prodimg) && !empty($prodimg[1])) {
										?>
											<input type="text" value="<?php echo $prodimg[1]['img_url']; ?>" class="form-control upload-title" disabled />
											<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile('prod_img2', '');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
										<?php
											}
										?>
										</div>
										<div class="col-sm-1">
											<?php 
												if(!empty($prodimg) && !empty($prodimg[1])) {
													echo '<input type="hidden" name="prod_img2_seq" value="' . $prodimg[1]['seq'] . '" />';
													echo '<input type="hidden" name="prod_img2" value="' . $prodimg[1]['img_url'] . '" />';
												}
												else {
													echo '<input type="hidden" name="prod_img2_seq" value="" />';
													echo '<input type="hidden" name="prod_img2" value="" />';
												}
											?>
											<input type="file" id="prod_img2" name="prod_img2_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#prod_img2').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">제품이미지3</label>
	                                    <div class="col-sm-4 filebox" id="prod_img3_wrap">
										<?php 
											if(!empty($prodimg) && !empty($prodimg[2])) {
										?>
											<input type="text" value="<?php echo $prodimg[2]['img_url']; ?>" class="form-control upload-title" disabled />
											<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile('prod_img3', '');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
										<?php
											}
										?>
										</div>
										<div class="col-sm-1">
											<?php 
												if(!empty($prodimg) && !empty($prodimg[2])) {
													echo '<input type="hidden" name="prod_img3_seq" value="' . $prodimg[2]['seq'] . '" />';
													echo '<input type="hidden" name="prod_img3" value="' . $prodimg[2]['img_url'] . '" />';
												}
												else {
													echo '<input type="hidden" name="prod_img3_seq" value="" />';
													echo '<input type="hidden" name="prod_img3" value="" />';
												}
											?>
											<input type="file" id="prod_img3" name="prod_img3_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#prod_img3').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">제품이미지4</label>
	                                    <div class="col-sm-4 filebox" id="prod_img4_wrap">
										<?php 
											if(!empty($prodimg) && !empty($prodimg[3])) {
										?>
											<input type="text" value="<?php echo $prodimg[3]['img_url']; ?>" class="form-control upload-title" disabled />
											<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile('prod_img4', '');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
										<?php
											}
										?>
										</div>
											<?php 
												if(!empty($prodimg) && !empty($prodimg[2])) {
													echo '<input type="hidden" name="prod_img3_seq" value="' . $prodimg[2]['seq'] . '" />';
													echo '<input type="hidden" name="prod_img3" value="' . $prodimg[2]['img_url'] . '" />';
												}
												else {
													echo '<input type="hidden" name="prod_img3_seq" value="" />';
													echo '<input type="hidden" name="prod_img3" value="" />';
												}
											?>
										<div class="col-sm-1">
											<?php 
												if(!empty($prodimg) && !empty($prodimg[3])) {
													echo '<input type="hidden" name="prod_img4_seq" value="' . $prodimg[3]['seq'] . '" />';
													echo '<input type="hidden" name="prod_img4" value="' . $prodimg[3]['img_url'] . '" />';
												}
												else {
													echo '<input type="hidden" name="prod_img4_seq" value="" />';
													echo '<input type="hidden" name="prod_img4" value="" />';
												}
											?>
											<input type="file" id="prod_img4" name="prod_img4_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#prod_img4').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">제품이미지5</label>
	                                    <div class="col-sm-4 filebox" id="prod_img5_wrap">
										<?php 
											if(!empty($prodimg) && !empty($prodimg[4])) {
										?>
											<input type="text" value="<?php echo $prodimg[4]['img_url']; ?>" class="form-control upload-title" disabled />
											<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile('prod_img5', '');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
										<?php
											}
										?>
										</div>
										<div class="col-sm-1">
											<?php 
												if(!empty($prodimg) && !empty($prodimg[4])) {
													echo '<input type="hidden" name="prod_img5_seq" value="' . $prodimg[4]['seq'] . '" />';
													echo '<input type="hidden" name="prod_img5" value="' . $prodimg[4]['img_url'] . '" />';
												}
												else {
													echo '<input type="hidden" name="prod_img5_seq" value="" />';
													echo '<input type="hidden" name="prod_img5" value="" />';
												}
											?>
											<input type="file" id="prod_img5" name="prod_img5_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#prod_img5').click();">추가</button>
	                                    </div>
	                                </div>

	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">라벨이미지1</label>
	                                    <div class="col-sm-4 filebox" id="label_img1_wrap">
										<?php 
											if(!empty($labelimg) && !empty($labelimg[0])) {
										?>
											<input type="text" value="<?php echo $labelimg[0]['img_url']; ?>" class="form-control upload-title" disabled />
											<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile('label_img1', '');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
										<?php
											}
										?>
										</div>
										<div class="col-sm-1">
											<?php 
												if(!empty($labelimg) && !empty($labelimg[0])) {
													echo '<input type="hidden" name="label_img1_seq" value="' . $labelimg[0]['seq'] . '" />';
													echo '<input type="hidden" name="label_img1" value="' . $labelimg[0]['img_url'] . '" />';
												}
												else {
													echo '<input type="hidden" name="label_img1_seq" value="" />';
													echo '<input type="hidden" name="label_img1" value="" />';
												}
											?>
											<input type="file" id="label_img1" name="label_img1_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#label_img1').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">라벨이미지2</label>
	                                    <div class="col-sm-4 filebox" id="label_img2_wrap">
										<?php 
											if(!empty($labelimg) && !empty($labelimg[1])) {
										?>
											<input type="text" value="<?php echo $labelimg[1]['img_url']; ?>" class="form-control upload-title" disabled />
											<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile('label_img2', '');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
										<?php
											}
										?>
										</div>
										<div class="col-sm-1">
											<?php 
												if(!empty($labelimg) && !empty($labelimg[1])) {
													echo '<input type="hidden" name="label_img2_seq" value="' . $labelimg[1]['seq'] . '" />';
													echo '<input type="hidden" name="label_img2" value="' . $labelimg[1]['img_url'] . '" />';
												}
												else {
													echo '<input type="hidden" name="label_img2_seq" value="" />';
													echo '<input type="hidden" name="label_img2" value="" />';
												}
											?>
											<input type="file" id="label_img2" name="label_img2_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#label_img2').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">라벨이미지3</label>
	                                    <div class="col-sm-4 filebox" id="label_img3_wrap">
										<?php 
											if(!empty($labelimg) && !empty($labelimg[2])) {
										?>
											<input type="text" value="<?php echo $labelimg[2]['img_url']; ?>" class="form-control upload-title" disabled />
											<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile('label_img3', '');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
										<?php
											}
										?>
										</div>
										<div class="col-sm-1">
											<?php 
												if(!empty($labelimg) && !empty($labelimg[2])) {
													echo '<input type="hidden" name="label_img3_seq" value="' . $labelimg[2]['seq'] . '" />';
													echo '<input type="hidden" name="label_img3" value="' . $labelimg[2]['img_url'] . '" />';
												}
												else {
													echo '<input type="hidden" name="label_img3_seq" value="" />';
													echo '<input type="hidden" name="label_img3" value="" />';
												}
											?>
											<input type="file" id="label_img3" name="label_img3_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#label_img3').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">라벨이미지4</label>
	                                    <div class="col-sm-4 filebox" id="label_img4_wrap">
										<?php 
											if(!empty($labelimg) && !empty($labelimg[3])) {
										?>
											<input type="text" value="<?php echo $labelimg[3]['img_url']; ?>" class="form-control upload-title" disabled />
											<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile('label_img4', '');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
										<?php
											}
										?>
										</div>
										<div class="col-sm-1">
											<?php 
												if(!empty($labelimg) && !empty($labelimg[3])) {
													echo '<input type="hidden" name="label_img4_seq" value="' . $labelimg[3]['seq'] . '" />';
													echo '<input type="hidden" name="label_img4" value="' . $labelimg[3]['img_url'] . '" />';
												}
												else {
													echo '<input type="hidden" name="label_img4_seq" value="" />';
													echo '<input type="hidden" name="label_img4" value="" />';
												}
											?>
											<input type="file" id="label_img4" name="label_img4_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#label_img4').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">라벨이미지5</label>
	                                    <div class="col-sm-4 filebox" id="label_img5_wrap">
										<?php 
											if(!empty($labelimg) && !empty($labelimg[4])) {
										?>
											<input type="text" value="<?php echo $labelimg[4]['img_url']; ?>" class="form-control upload-title" disabled />
											<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile('label_img5', '');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
										<?php
											}
										?>
										</div>
										<div class="col-sm-1">
											<?php 
												if(!empty($labelimg) && !empty($labelimg[4])) {
													echo '<input type="hidden" name="label_img5_seq" value="' . $labelimg[4]['seq'] . '" />';
													echo '<input type="hidden" name="label_img5" value="' . $labelimg[4]['img_url'] . '" />';
												}
												else {
													echo '<input type="hidden" name="label_img5_seq" value="" />';
													echo '<input type="hidden" name="label_img5" value="" />';
												}
											?>
											<input type="file" id="label_img5" name="label_img5_attach" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#label_img5').click();">추가</button>
	                                    </div>
	                                </div>

	                            </div>
							</form>
                        </div>
                    </div>
			</div>


			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">저장</button>
	           	<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnDelete(); return false;">삭제</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/domestic/manufacture/list'; return false;">목록으로</button>
			</div>
		</div>
    </div>
</div>

<script>
$(document).ready(function() {
	$('input[type=file]').on('change', function() {
		if($(this).val() == '') {
			return;
		}
		
		var id=$(this).attr('id');
		
		var file = $(this)[0].files[0];
		var ext = file.name.split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
			alert('JPG, PNG 파일만 업로드 가능합니다.');
			$(this).val('');
			return false;
		}

		if(file.size >= 10*1024*1024) {
			alert('10MB 이하로 등록해 주세요.');
			$(this).val('');
			return false;
		}

		var str = '<input type="text" value="' + file.name + '" class="form-control upload-title" disabled />'
				+ '<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile(\'' + id + '\', \'\');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>';
		$('#' + id + '_wrap').html(str);
		$('input[name=' + id + ']').val('');
	})

	$('input[name=category]').on('click', function(e) {
		if($(this).val() == '029') {
			if($(this).is(':checked')) {
				$('.category_etc').show();
			}
			else {
				$('.category_etc').hide();
				$('input[name=category_etc]').val('');
			}
		}
	});

})

function fnClearFile(id, seq) {
	$('#' + id + '_wrap').html('');
	$('#' + id).val('');
	$('input[name=' + id + ']').val('');
}

function fnSave()
{
	var form = $('#frmSave')[0];  
	var data = new FormData(form); 

	$.ajax({
		url: "/api/admin/domestic/nbproduct/edit",
		type: "POST",
		data: data,
		enctype: 'multipart/form-data',  
		processData: false,    
		contentType: false,      
		cache: false,           
		timeout: 600000,  
		success:function(data){
			data = JSON.parse(data);
       		if(data.result == 'login') {
       			alert('로그인이 필요합니다.')
                location.href='/admin/login';
       		}
       		else if(data.result== 'fail') {
                alert(data.msg);
       		}
       		else {
                alert(data.msg);
                location.href='/admin/domestic/nbproduct/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });

   $('input[name=biz_no]').on('input', function() {
		$('input[name=chk_biz_no]').val('n');
   })
}

function fnDelete() {
	if(!confirm('삭제하시겠습니까?')) {
		return;
	}
	$.ajax({
		url: "/api/admin/domestic/nbproduct/delete",
		type: "POST",
		data: {seq : $('input[name=seq]').val() },
		dataType : 'JSON',
		async : false,
		success:function(data){
       		if(data.result == 'login') {
       			alert('로그인이 필요합니다.')
                location.href='/admin/login';
       		}
       		else if(data.result== 'fail') {
                alert(data.msg);
       		}
       		else {
                alert(data.msg);
				location.href='/admin/domestic/nbproduct/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

</script>