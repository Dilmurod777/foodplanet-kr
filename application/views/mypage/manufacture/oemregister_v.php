<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('mypage/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('mypage/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>제품 관리</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
			<form id="frmSave">
				<input type="hidden"  name="tab"  value="<?php echo $tab; ?>" />
				<input type="hidden"  name="member_cd"  value="<?php echo $member['member_cd']; ?>" />

				<div class="row">
                    <div class="col-lg-12">
						<div class="tabs-container">
							<ul class="nav nav-tabs" role="tablist">
								<li><a class="nav-link" href="/mypage/product/own">자사제품 대표정보</a></li>
								<li><a class="nav-link" href="/mypage/product/ownlist">자사제품 등록</a></li>
								<li><a class="nav-link" href="/mypage/product/oem">위탁생산제품 대표정보</a></li>
								<li><a class="nav-link active" href="/mypage/product/oemlist">위탁생산제품 등록</a></li>
							</ul>
							<div class="tab-content">
								<div class="ibox ">
									<div class="ibox-title">
										<h5>새 OEM 제품 등록</h5>
									</div>  
								</div>

								<div class="ibox ">
									<div class="ibox-title">
										<h5>제품 주요 노출 정보</h5>
									</div>  
									<div class="ibox-content ">

										<div class="panel-body" >
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">제품명</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="product_name" value="" />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">대표태그</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="tags" value="" placeholder="제품을 표현할 태그를 등록하세요. (최대 5개 등록 가능)" />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">한줄소개</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="product_summary" value="" placeholder="간단한 제품 소개를 입력하세요. (최대 100자 입력 가능)" maxlength="100"/>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">공급단가(단위:원)</label>
												<div class="col-sm-10">
													<input type="text" class="form-control commifyNumber" name="supply_price" value="" placeholer="원 단위로 입력해주세요."/>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">MOQ</label>
												<div class="col-sm-10">
													<input type="text" class="form-control commifyNumber" name="moq" value="" placeholder="1이상의 숫자를 입력해 주세요."  />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">식품유형</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="food_type" value="" placeholder="식품공전에 따른 유형을 입력해 주세요." />
												</div>
											</div>
										</div>
									</div>
								</div>


								<div class="ibox ">
									<div class="ibox-title">
										<h5>제품 주요 제조 정보</h5>
									</div>  
									<div class="ibox-content ">

										<div class="panel-body" >
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">브랜드</label>
												<div class="col-sm-4">
													<select name="brand" class="form-control">
														<option value="" selected disabled>해당 제품의 브랜드를 선택해 주세요</optoin>
													<?php
														foreach($company as $row) {
															echo '<option value="' . $row['sub_code'] . '">' . $row['code_name'] . '</option>';
														}
													?>
													</select>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">유통기한</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="expire_day" value="" placeholder="월 단위로 입력하세요." />
												</div>
											</div>
										</div>
									</div>
								</div>


								<div class="ibox ">
									<div class="ibox-title">
										<h5>채널별 납품현황</h5>
									</div>  
									<div class="ibox-content ">

										<div class="panel-body" >
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">오프라인</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="channel_offline" value="" placeholder="납품 업체명을 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">온라인</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="channel_online" value="" placeholder="납품 업체명을 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">납기일자</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="delivery_day" value="" placeholder="일 단위로 입력해 주세요." />
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="ibox ">
									<div class="ibox-title">
										<h5>타입별 상품정보</h5>
									</div>  
									<div class="ibox-content ">

										<div class="panel-body" >
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">A타입별 세부정보</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="type_a" value="" placeholder="용기 타입 및 입수 등 정보를 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">B타입별 세부정보</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="type_b" value="" placeholder="용기 타입 및 입수 등 정보를 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">C타입별 세부정보</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="type_c" value="" placeholder="용기 타입 및 입수 등 정보를 입력해 주세요." />
												</div>
											</div>
										</div>
									</div>
								</div>


								<div class="ibox ">
									<div class="ibox-title">
										<h5>제품 부자재 정보</h5>
									</div>  
									<div class="ibox-content ">

										<div class="panel-body" >
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">부자재 발주 리드타임</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="material_leadtime" value="" placeholder="월 단위로 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">부자재 MOQ</label>
												<div class="col-sm-10">
													<input type="text" class="form-control commifyNumber" name="material_moq" value="" placeholder="1 이상의 숫자를 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">부자재별 단가(단위:원)</label>
												<div class="col-sm-10">
													<input type="text" class="form-control commifyNumber" name="material_price" value="" placeholder="원 단위로 입력해 주세요." />
												</div>
											</div>
										</div>
									</div>
								</div>


								<div class="ibox ">
									<div class="ibox-title">
										<h5>제품 수출 정보</h5>
									</div>  
									<div class="ibox-content ">

										<div class="panel-body" >
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">수출국가</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="export_nation" value="" placeholder="수출 국가명을 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">수출 추가 진행 국가</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="export_progress" value="" placeholder="수출 국가명을 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">ISO22000 인증 여부</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="is_ios22000" value="" placeholder="인증내용을 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">FDA 공장 등록 여부</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="is_fda" value="" placeholder="인증내용을 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">할랄 인증 여부</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="is_halal" value="" placeholder="인증내용을 입력해 주세요." />
												</div>
											</div>
										</div>
									</div>
								</div>


								<div class="ibox ">
									<div class="ibox-title">
										<h5>대표 이미지</h5>
									</div>  
									<div class="ibox-content ">

										<div class="panel-body" >
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">대표 이미지1</label>
												<div class="col-sm-4 filebox" id="product_img1_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="product_img1" name="product_img1" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#product_img1').click();">파일찾기</button>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">대표 이미지2</label>
												<div class="col-sm-4 filebox" id="product_img2_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="product_img2" name="product_img2" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#product_img2').click();">파일찾기</button>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">대표 이미지3</label>
												<div class="col-sm-4 filebox" id="product_img3_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="product_img3" name="product_img3" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#product_img3').click();">파일찾기</button>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">대표 이미지4</label>
												<div class="col-sm-4 filebox" id="product_img4_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="product_img4" name="product_img4" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#product_img4').click();">파일찾기</button>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">대표 이미지5</label>
												<div class="col-sm-4 filebox" id="product_img5_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="product_img5" name="product_img5" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#product_img5').click();">파일찾기</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								
								<div class="ibox ">
									<div class="ibox-title">
										<h5>상세 이미지</h5>
									</div>  
									<div class="ibox-content ">

										<div class="panel-body" >
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">상세 이미지1</label>
												<div class="col-sm-4 filebox" id="detail_img1_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="detail_img1" name="detail_img1" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#detail_img1').click();">파일찾기</button>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">상세 이미지2</label>
												<div class="col-sm-4 filebox" id="detail_img2_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="detail_img2" name="detail_img2" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#detail_img2').click();">파일찾기</button>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">상세 이미지3</label>
												<div class="col-sm-4 filebox" id="detail_img3_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="detail_img3" name="detail_img3" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#detail_img3').click();">파일찾기</button>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">상세 이미지4</label>
												<div class="col-sm-4 filebox" id="detail_img4_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="detail_img4" name="detail_img4" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#detail_img4').click();">파일찾기</button>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">상세 이미지5</label>
												<div class="col-sm-4 filebox" id="detail_img5_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="detail_img5" name="detail_img5" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#detail_img5').click();">파일찾기</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="ibox ">
									<div class="ibox-title">
										<h5>라벨 이미지</h5>
									</div>  
									<div class="ibox-content ">

										<div class="panel-body" >
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">라벨 이미지1</label>
												<div class="col-sm-4 filebox" id="label_img1_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="label_img1" name="label_img1" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#label_img1').click();">파일찾기</button>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">라벨 이미지2</label>
												<div class="col-sm-4 filebox" id="label_img2_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="label_img2" name="label_img2" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#label_img2').click();">파일찾기</button>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">라벨 이미지3</label>
												<div class="col-sm-4 filebox" id="label_img3_wrap">
												</div>
												<div class="col-sm-1">
													<input type="file" id="label_img3" name="label_img3" style="display:none" />
													<button type="button" class="btn btn-w-m btn-primary" onclick="$('#label_img3').click();">파일찾기</button>
												</div>
											</div>
										</div>
									</div>
								</div>								

							</div>

						</div>
                    </div>
				</div>			


			</form>


			<div class="form-group text-center">
				<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">저장</button>
				<button type="button" class="btn btn-w-m btn-default" onclick="javascript:fnCancel(); return false;">취소</button>
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
		
		var file = $(this)[0].files[0];
		var ext = file.name.split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
			showAlert('JPG, PNG 파일만 업로드 가능합니다.');
			$(this).val('');
			return false;
		}

		if(file.size >= 5*1024*1024) {
			showAlert('5MB 이하로 등록해 주세요.');
			$(this).val('');
			return false;
		}
		var id=$(this).attr('id');
		var str = '<input type="text" value="' + file.name + '" class="form-control upload-title" disabled />'
				+ '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'' + id + '\');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>';
		$('#' + id + '_wrap').html(str);
	})

})

function fnClearFile(id) {
	$('#' + id + '_wrap').html('');
	$('#' + id).val('');
}

function fnSave() {
	showConfirm('입력한 내용을 저장하시겠습니까?', function() {
		var form = $('#frmSave')[0];  
		var data = new FormData(form); 

		$.ajax({
			url: "/api/product/oemregister",
			type: "POST",
			data: data,
			enctype: 'multipart/form-data',  
			processData: false,    
			contentType: false,      
			cache: false,           
			timeout: 600000,  
			success: function(data) {
				data = JSON.parse(data);
				if(data.result == 'succ') {
					showAlert(data.msg, function() { location.href = '/mypage/product/oemlist'; })
				}
				else if(data.result == 'login') {
					showAlert(data.msg, function() { location.href = '/'; });
				}
				else {
					showAlert(data.msg);
				}
			},
			error: function(result) {
				alert('오류가 발생했습니다. 관리자에게 문의해 주세요.');
			}
		});

	});
}

function fnCancel() {
	showConfirm('입력한 내용을 취소하시겠습니까?', function() { location.reload(); });
}
</script>