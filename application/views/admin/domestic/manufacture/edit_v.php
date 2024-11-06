<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>국내 데이터 - 제조사 수정</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							<form id="frmSave">
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">사업자등록번호<code>*</code></label>
	                                    <div class="col-lg-4 ">
											<input type="text" name="biz_no" class="form-control" maxlength="12" value="<?php echo $info['biz_no']; ?>" readonly />
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">회사명<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="company_name" class="form-control" maxlength="50" value="<?php echo $info['company_name']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">회사명(영문)</label>
										<div class="col-sm-4">
											<input type="text" name="company_name_eng" class="form-control" maxlength="50" value="<?php echo $info['company_name_eng']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">로고이미지<code>*</code></label>
	                                    <div class="col-sm-4" id="logo_img_wrap">
											<?php 
												if(!empty($info['logo_img'])) {
											?>
												<input type="text" value="<?php echo $info['logo_img']; ?>" class="form-control upload-title" disabled />
											<?php
												}
											?>
										</div>
										<div class="col-sm-1">
											<input type="file" id="logo_img" name="logo_img_attach" style="display:none"  />
											<input type="hidden" value="<?php echo $info['logo_img']; ?>" name="logo_img" />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#logo-img').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">간략설명</label>
	                                    <div class="col-lg-10 ">
											<textarea class="form-control" name="summary" maxlength="200" rows="5"><?php echo $info['summary']; ?></textarea>
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">대표자명<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="ceo_name" class="form-control" maxlength="50" value="<?php echo $info['ceo_name']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">대표연락처<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="company_tel" class="form-control" maxlength="13" value="<?php echo $info['company_tel']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">주소<code>*</code></label>
										<div class="col-sm-10">
											<input type="text" name="addr" class="form-control" maxlength="500" value="<?php echo $info['addr']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">설립일<code>*</code></label>
										<div class="col-sm-4">
											<input type="date" pattern="\d{4}-\d{2}-\d{2}"  name="incorporation_at" placeholder="YYYY-MM-DD" class="form-control" value="<?php echo $info['incorporation_at']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">홈페이지</label>
										<div class="col-sm-4">
											<input type="text" name="homepage" class="form-control" maxlength="256" value="<?php echo $info['homepage']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">산업분류코드<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="industrial_code" class="form-control" maxlength="100" value="<?php echo $info['industrial_code']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">태그<br>(콤마(,)로 구분하여 입력해주세요)</label>
										<div class="col-sm-4">
											<input type="text" name="tags" class="form-control" maxlength="100" value="<?php echo $info['tags']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">회사소개서</label>
	                                    <div class="col-sm-4" id="introduce_file_wrap">
										<?php 
												if(!empty($info['introduce_file'])) {
											?>
												<input type="text" value="<?php echo $info['introduce_file']; ?>" class="form-control upload-title" disabled />
												<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile('introduce_file', '');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>
											<?php
												}
											?>
										</div>
										<div class="col-sm-1">
											<input type="file" id="introduce_file" name="introduce_file_attach" style="display:none"  />
											<input type="hidden" value="<?php echo $info['introduce_file']; ?>" name="introduce_file" />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#introduce_file').click();">추가</button>
	                                    </div>
	                                </div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-lg-2 col-form-label">카테고리<code>*</code><br>(최대 5개까지 선택가능합니다.)</label>
										<div class="col-lg-10 row">
										<?php
											$selected = explode(',', $info['category']);
											foreach($category as $row) {
												echo '<div class="col-lg-3 check_wrap">';
												echo '	<input type="checkbox" id="category_' .  $row['sub_code'] . '" name="category[]" value="' . $row['sub_code'] . '" ' . (in_array($row['sub_code'], $selected) ? 'checked': '') . ' >';
												echo '	<label for="category_' .  $row['sub_code'] . '">' . $row['code_name'] . '</label>';
												echo '</div>';
											}
										?>
										</div>
										<label class="col-lg-2 col-form-label category_etc" style="display:<?php echo in_array('29', $selected) ? 'block' : 'none'; ?>"></label>
										<div class="col-lg-10 category_etc" style="display:<?php echo in_array('29', $selected) ? 'block' : 'none'; ?>">
											<input type="text" class="form-control" name="category_etc" value=""<?php echo $info['category_etc']; ?>" placeholder="콤마(,)로 구분하여 최대 5개까지 등록가능합니다." />
										</div>
									</div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">대표제품군<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="main_group" class="form-control" maxlength="100" value="<?php echo $info['main_group']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">주요제품<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="main_product" class="form-control" maxlength="100" value="<?php echo $info['main_product']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">주요거래처</label>
										<div class="col-sm-10">
											<input type="text" name="main_client" class="form-control" maxlength="100" value="<?php echo $info['main_client']; ?>"  />
	                                    </div>
	                                </div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-lg-2 col-form-label">주요기업 OEM 제조사<br>(최대 5개까지 선택가능합니다.)</label>
										<div class="col-lg-10 row">
										<?php
											$selected = explode(',', $info['main_oem']);
											for($i = 0; $i < count($selected); $i++) {
												$selected[$i] = trim($selected[$i]);
											}
											foreach($company as $row) {
												echo '<div class="col-lg-3 check_wrap">';
												echo '	<input type="checkbox" id="main_oem_' .  $row['sub_code'] . '" name="main_oem[]" value="' . $row['code_name'] . '" ' . (in_array($row['code_name'], $selected) ? 'checked': '') . ' >';
												echo '	<label for="main_oem_' .  $row['sub_code'] . '">' . $row['code_name'] . '</label>';
												echo '</div>';
											}
										?>
										</div>
									</div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">대표제품 일 생산 가능량</label>
										<div class="col-sm-4">
											<input type="text" name="production_day" class="form-control" maxlength="50" value="<?php echo $info['production_day']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">일 생산 단위</label>
										<div class="col-sm-4">
											<input type="text" name="unit_day" class="form-control" maxlength="5" value="<?php echo $info['unit_day']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">대표제품 월 생산 가능량</label>
										<div class="col-sm-4">
											<input type="text" name="production_month" class="form-control" maxlength="50" value="<?php echo $info['production_month']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">월 생산 단위</label>
										<div class="col-sm-4">
											<input type="text" name="unit_month" class="form-control" maxlength="5" value="<?php echo $info['unit_month']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">대표제품 년 생산 가능량</label>
										<div class="col-sm-4">
											<input type="text" name="production_year" class="form-control" maxlength="50" value="<?php echo $info['production_year']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">년 생산 단위</label>
										<div class="col-sm-4">
											<input type="text" name="unit_year" class="form-control" maxlength="5" value="<?php echo $info['unit_year']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">현재 가능 CAPA</label>
										<div class="col-sm-4">
											<input type="text" name="capa" class="form-control" maxlength="10" value="<?php echo $info['capa']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">CAPA 기준연도</label>
										<div class="col-sm-4">
											<input type="text" name="capa_at" placeholder="YYYY.MM" class="form-control" value="<?php echo $info['capa_at']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">설비정보</label>
										<div class="col-sm-4">
											<input type="text" name="facilities_info" class="form-control" maxlength="100" value="<?php echo $info['facilities_info']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">포장기계 보유현황</label>
										<div class="col-sm-4">
											<input type="text" name="packaging_machine" class="form-control" maxlength="100" value="<?php echo $info['packaging_machine']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">기타기계 보유현황</label>
										<div class="col-sm-4">
											<input type="text" name="etc_machine" class="form-control" maxlength="100" value="<?php echo $info['etc_machine']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">이물질 검출기 보유현황</label>
										<div class="col-sm-4">
											<input type="text" name="detection_machine" class="form-control" maxlength="100" value="<?php echo $info['detection_machine']; ?>" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">인증정보</label>
										<div class="col-sm-4">
											<input type="text" name="certi" class="form-control" maxlength="100" value="<?php echo $info['certi']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">FDA 공장등록여부</label>
										<div class="col-sm-4 row">
											<div class="col-lg-3 check_wrap">
												<input type="radio" id="is_fda_y" name="is_fda" value="y" <?php echo $info['is_fda'] === 'y' ? 'checked' : ''; ?> >
												<label for="is_fda_y">등록</label>
											</div>
											<div class="col-lg-3 check_wrap">
												<input type="radio" id="is_fda_n" name="is_fda" value="n" <?php echo $info['is_fda'] === 'n' ? 'checked' : ''; ?> >
												<label for="is_fda_n">미등록</label>
											</div>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">유통채널</label>
										<div class="col-sm-4">
											<input type="text" name="distribution_channel" class="form-control" maxlength="100" value="<?php echo $info['distribution_channel']; ?>" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">수출국가</label>
										<div class="col-sm-4">
											<input type="text" name="export_nation" class="form-control" maxlength="100" value="<?php echo $info['export_nation']; ?>" />
	                                    </div>
	                                </div>

	                            </div>
							</form>
                        </div>
                    </div>
			</div>


			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">수정</button>
	           	<button type="button" class="btn btn-w-m btn-danger" onclick="javascript:fnDelete(); return false;">삭제</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:$('#frmSearch').submit(); return false;">취소</button>
			</div>
		</div>
    </div>
</div>

<form id="frmSearch" method="post" action="/admin/domestic/manufacture/list" >
   	<input type="hidden" name="biz_no" value="<?php echo !empty($req) ? $req['biz_no'] : ''; ?>" />
   	<input type="hidden" name="offset" value="<?php echo !empty($req) ? $req['offset'] : ''; ?>" />
    <input type="hidden" name="is_matching" value="<?php echo !empty($req) ? $req['is_matching'] : ''; ?>" />
	<input type="hidden" value="<?php echo !empty($req) ? $req['keyword'] : ''; ?>" name="keyword" />
</form>

<script>
$(document).ready(function() {
	$('input[type=file]').on('change', function() {
		if($(this).val() == '') {
			return;
		}
		
		var id=$(this).attr('id');
		
		var file = $(this)[0].files[0];
		if(id == 'logo_img') {
			var ext = file.name.split('.').pop().toLowerCase();
			if($.inArray(ext, ['jpg', 'png', 'jpeg']) == -1) {
				alert('JPG, PNG 파일만 업로드 가능합니다.');
				$(this).val('');
				return false;
			}
		}

		if(file.size >= 10*1024*1024) {
			alert('10MB 이하로 등록해 주세요.');
			$(this).val('');
			return false;
		}

		if(id == 'logo_img') {
			var str = '<input type="text" value="' + file.name + '" class="form-control upload-title" disabled />';
		}
		else {
			var str = '<input type="text" value="' + file.name + '" class="form-control upload-title" disabled />'
					+ '<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile(\'' + id + '\', \'\');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>';
		}
		$('#' + id + '_wrap').html(str);
	})

	$('input[name="category[]"]').on('click', function(e) {
		var cnt = 0;
		$('input[name="category[]"]').each(function() {
			if($(this).is(':checked')) {
				cnt++;
			}
		})

		if(cnt > 5) {
			alert('최대 5개까지만 선택가능합니다.');
			e.preventDefault();
			return;
		}
		else {
			if($(this).val() == '029') {
				if($(this).is(':checked')) {
					$('.category_etc').show();
				}
				else {
					$('.category_etc').hide();
					$('input[name=category_etc]').val('');
				}
			}

		}
	});

	$('input[name=category_etc').on('input', function() {
		var str = $(this).val().split(',');

		if(str.length > 5)  {
			alert('최대 5개까지만 입력이 가능합니다.');
			str.pop();
		}
		$(this).val(str.join(','));
	})

	$('input[name="main_oem[]"]').on('click', function(e) {
		var cnt = 0;
		$('input[name="main_oem[]"]').each(function() {
			if($(this).is(':checked')) {
				cnt++;
			}
		})

		if(cnt > 5) {
			alert('최대 5개까지만 선택가능합니다.');
			e.preventDefault();
			return;
		}
	});

})

function fnClearFile(id, seq) {
	$('#' + id + '_wrap').html('');
	$('#' + id).val('');
	$('input[name=' + id + '_attach]').val('');
}

function fnSave()
{
	var form = $('#frmSave')[0];  
	var data = new FormData(form); 

	$.ajax({
		url: "/api/admin/domestic/manufacture/edit",
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
                location.reload();
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

function fnDelete() {
	if(!confirm('삭제하시겠습니까?')) {
		return;
	}
	$.ajax({
		url: "/api/admin/domestic/manufacture/delete",
		type: "POST",
		data: {biz_no : $('input[name=biz_no]').val()},
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
				location.href='/admin/domestic/manufacture/list';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}

</script>