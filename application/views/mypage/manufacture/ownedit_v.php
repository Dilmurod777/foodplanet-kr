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
				<input type="hidden"  name="detail_seq"  value="<?php echo $info['detail_seq']; ?>" />
				<input type="hidden"  name="delete_file"  value="" />

				<div class="row">
                    <div class="col-lg-12">
						<div class="tabs-container">
							<ul class="nav nav-tabs" role="tablist">
								<li><a class="nav-link" href="/mypage/product/own">자사제품 대표정보</a></li>
								<li><a class="nav-link active" href="/mypage/product/ownlist">자사제품 등록</a></li>
								<li><a class="nav-link" href="/mypage/product/oem">위탁생산제품 대표정보</a></li>
								<li><a class="nav-link" href="/mypage/product/oemlist">위탁생산제품 등록</a></li>
							</ul>
							<div class="tab-content">
								<div class="ibox ">
									<div class="ibox-title">
										<h5>자사 제품 수정</h5>
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
													<input type="text" class="form-control" name="product_name" value="<?php echo $info['product_name']; ?>" />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">대표태그</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="tags" value="<?php echo $info['tags']; ?>" placeholder="제품을 표현할 태그를 등록하세요. (최대 5개 등록 가능)" />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">한줄소개</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="product_summary" value="<?php echo $info['product_summary']; ?>" placeholder="간단한 제품 소개를 입력하세요. (최대 100자 입력 가능)" maxlength="100"/>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">공급단가(단위:원)</label>
												<div class="col-sm-10">
													<input type="text" class="form-control commifyNumber" name="supply_price" value="<?php echo number_format($info['supply_price']); ?>" placeholer="원 단위로 입력해주세요."/>
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">MOQ</label>
												<div class="col-sm-10">
													<input type="text" class="form-control commifyNumber" name="moq" value="<?php echo number_format($info['moq']); ?>" placeholder="1이상의 숫자를 입력해 주세요."  />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">식품유형</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="food_type" value="<?php echo $info['food_type']; ?>" placeholder="식품공전에 따른 유형을 입력해 주세요." />
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
												<div class="col-sm-10">
													<input type="text" class="form-control" name="brand" value="<?php echo $info['brand']; ?>" placeholder="해당 제품의 NB브랜드를 입력해 주세요. 입력하지 않는 경우 제조사명이 출력됩니다." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">유통기한</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="expire_day" value="<?php echo $info['expire_day']; ?>" placeholder="월 단위로 입력하세요." />
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
													<input type="text" class="form-control" name="channel_offline" value="<?php echo $info['channel_offline']; ?>" placeholder="납품 업체명을 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">온라인</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="channel_online" value="<?php echo $info['channel_online']; ?>" placeholder="납품 업체명을 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">납기일자</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="delivery_day" value="<?php echo $info['delivery_day']; ?>" placeholder="일 단위로 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">용기 타입 및 입수</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="type_cnt" value="<?php echo $info['type_cnt']; ?>" placeholder="용기 타입과 포장 입수를 입력하세요." />
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
													<input type="text" class="form-control" name="material_leadtime" value="<?php echo $info['material_leadtime']; ?>" placeholder="월 단위로 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">부자재 MOQ</label>
												<div class="col-sm-10">
													<input type="text" class="form-control commifyNumber" name="material_moq" value="<?php echo number_format($info['material_moq']); ?>" placeholder="1 이상의 숫자를 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">부자재별 단가(단위:원)</label>
												<div class="col-sm-10">
													<input type="text" class="form-control commifyNumber" name="material_price" value="<?php echo number_format($info['material_price']); ?>" placeholder="원 단위로 입력해 주세요." />
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
													<input type="text" class="form-control" name="export_nation" value="<?php echo $info['export_nation']; ?>" placeholder="수출 국가명을 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">수출 추가 진행 국가</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="export_progress" value="<?php echo $info['export_progress']; ?>" placeholder="수출 국가명을 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">ISO22000 인증 여부</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="is_ios22000" value="<?php echo $info['is_ios22000']; ?>" placeholder="인증내용을 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">FDA 공장 등록 여부</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="is_fda" value="<?php echo $info['is_fda']; ?>" placeholder="인증내용을 입력해 주세요." />
												</div>
											</div>
											<div class="hr-line-dashed"></div>
											<div class="form-group  row">
												<label class="col-sm-2 col-form-label">할랄 인증 여부</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" name="is_halal" value="<?php echo $info['is_halal']; ?>" placeholder="인증내용을 입력해 주세요." />
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
												<?php
													if(!empty($prod_thumb) && !empty($prod_thumb[0])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_thumb[0]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_thumb[0]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'product_img1\', \'' . $prod_thumb[0]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
												<?php
													if(!empty($prod_thumb) && !empty($prod_thumb[1])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_thumb[1]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_thumb[1]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'product_img2\', \'' . $prod_thumb[1]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
												<?php
													if(!empty($prod_thumb) && !empty($prod_thumb[2])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_thumb[2]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_thumb[2]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'product_img3\', \'' . $prod_thumb[2]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
												<?php
													if(!empty($prod_thumb) && !empty($prod_thumb[3])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_thumb[3]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_thumb[3]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'product_img4\', \'' . $prod_thumb[3]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
												<?php
													if(!empty($prod_thumb) && !empty($prod_thumb[4])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_thumb[4]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_thumb[4]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'product_img5\', \'' . $prod_thumb[4]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
												<?php
													if(!empty($prod_detail) && !empty($prod_detail[0])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_detail[0]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_detail[0]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'detail_img1\', \'' . $prod_detail[0]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
												<?php
													if(!empty($prod_detail) && !empty($prod_detail[1])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_detail[1]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_detail[1]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'detail_img2\', \'' . $prod_detail[1]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
												<?php
													if(!empty($prod_detail) && !empty($prod_detail[2])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_detail[2]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_detail[2]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'detail_img3\', \'' . $prod_detail[2]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
												<?php
													if(!empty($prod_detail) && !empty($prod_detail[3])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_detail[3]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_detail[3]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'detail_img4\', \'' . $prod_detail[3]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
												<?php
													if(!empty($prod_detail) && !empty($prod_detail[4])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_detail[4]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_detail[4]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'detail_img5\', \'' . $prod_detail[4]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
												<?php
													if(!empty($prod_label) && !empty($prod_label[0])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_label[0]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_label[0]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'label_img1\', \'' . $prod_label[0]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
												<?php
													if(!empty($prod_label) && !empty($prod_label[1])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_label[1]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_label[1]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'label_img2\', \'' . $prod_label[1]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
												<?php
													if(!empty($prod_label) && !empty($prod_label[2])) {
														echo '<a href="/api/common/img_view?img_path=' . $prod_label[2]['new_filepath'] . '" target="_blank">';
														echo '<input type="text" style="color:blue; cursor:pointer" value="'  . $prod_label[2]['org_filename'] . '" class="form-control upload-title" disabled>';
														echo '</a>';
														echo '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'label_img3\', \'' . $prod_label[2]['file_seq'] . '\');">';
														echo '<img src="/assets/front/images/btn_clear.svg" alt="파일초기화">';
														echo '</button>';
													}
												?>
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
				+ '<button type="button" class="file-btn-reset" onclick="javascipt:fnClearFile(\'' + id + '\', \'\');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>';
		$('#' + id + '_wrap').html(str);
	})

})

function fnClearFile(id, seq) {
	$('#' + id + '_wrap').html('');
	$('#' + id).val('');
	
	if(seq == '') return;

	var delete_file = new Array();
	if($('input[name=delete_file]').val() !== '') {
		delete_file = $('input[name=delete_file]').val().split(',');
	}
	delete_file.push(seq);
	$('input[name=delete_file]').val(delete_file.join(','));
}

function fnSave() {
	showConfirm('수정한 내용을 저장하시겠습니까?', function() {
		var form = $('#frmSave')[0];  
		var data = new FormData(form); 

		$.ajax({
			url: "/api/product/ownupdate",
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
					showAlert(data.msg, function() { location.href = '/mypage/product/ownlist'; })
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
	showConfirm('입력한 내용을 취소하시겠습니까?', function() { location.href = '/mypage/product/ownlist'; });
}
</script>