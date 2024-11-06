<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>국내 데이터 - 제조사 등록</h2>
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
											<input type="text" name="biz_no" class="form-control" maxlength="12" />
											<input type="hidden" name="chk_biz_no" value="n" />
	                                    </div>
										<div class="col-lg-1">
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:fnCheckBizno();">중복확인</button>
										</div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">회사명<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="company_name" class="form-control" maxlength="50" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">회사명(영문)</label>
										<div class="col-sm-4">
											<input type="text" name="company_name_eng" class="form-control" maxlength="50" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">로고이미지<code>*</code></label>
	                                    <div class="col-sm-4" id="logo_img_wrap">
										</div>
										<div class="col-sm-1">
											<input type="file" id="logo_img" name="logo_img" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#logo-img').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">간략설명</label>
	                                    <div class="col-lg-10 ">
											<textarea class="form-control" name="summary" maxlength="200"></textarea>
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">대표자명<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="ceo_name" class="form-control" maxlength="50" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">대표연락처<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="company_tel" class="form-control" maxlength="13" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">주소</label>
										<div class="col-sm-10">
											<input type="text" name="addr" class="form-control" maxlength="500" value="" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">설립일<code>*</code></label>
										<div class="col-sm-4">
											<input type="date" pattern="\d{4}-\d{2}-\d{2}"  name="incorporation_at" placeholder="YYYY-MM-DD" class="form-control" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">홈페이지</label>
										<div class="col-sm-4">
											<input type="text" name="homepage" class="form-control" maxlength="256" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
										<label class="col-sm-2 col-form-label">산업분류코드<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="industrial_code" class="form-control" maxlength="100" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">태그<br>(콤마(,)로 구분하여 입력해주세요)</label>
										<div class="col-sm-4">
											<input type="text" name="tags" class="form-control" maxlength="100" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">회사소개서</label>
	                                    <div class="col-sm-4" id="introduce_file_wrap">
										</div>
										<div class="col-sm-1">
											<input type="file" id="introduce_file" name="introduce_file" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-primary" onclick="javascript:$('#introduce_file').click();">추가</button>
	                                    </div>
	                                </div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-lg-2 col-form-label">카테고리<code>*</code><br>(최대 5개까지 선택가능합니다.)</label>
										<div class="col-lg-10 row">
										<?php
//											$selected = explode(',', $info['main_product_cd']);
											foreach($category as $row) {
												echo '<div class="col-lg-3 check_wrap">';
												echo '	<input type="checkbox" id="category_' .  $row['sub_code'] . '" name="category[]" value="' . $row['sub_code'] . '"  >';
												echo '	<label for="category_' .  $row['sub_code'] . '">' . $row['code_name'] . '</label>';
												echo '</div>';
											}
										?>
										</div>
										<label class="col-lg-2 col-form-label category_etc" style="display:none;"></label>
										<div class="col-lg-10 category_etc" style="display:none">
											<input type="text" class="form-control" name="category_etc" value="" placeholder="콤마(,)로 구분하여 최대 5개까지 등록가능합니다." />
										</div>
									</div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">대표제품군<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="main_group" class="form-control" maxlength="100" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">주요제품<code>*</code></label>
										<div class="col-sm-4">
											<input type="text" name="main_product" class="form-control" maxlength="100" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">주요거래처</label>
										<div class="col-sm-10">
											<input type="text" name="main_client" class="form-control" maxlength="50" />
	                                    </div>
	                                </div>
									<div class="hr-line-dashed"></div>
									<div class="form-group  row">
										<label class="col-lg-2 col-form-label">주요기업 OEM 제조사<br>(최대 5개까지 선택가능합니다.)</label>
										<div class="col-lg-10 row">
										<?php
//											$selected = explode(',', $info['main_product_cd']);
											foreach($company as $row) {
												echo '<div class="col-lg-3 check_wrap">';
												echo '	<input type="checkbox" id="main_oem_' .  $row['sub_code'] . '" name="main_oem[]" value="' . $row['code_name'] . '"  >';
												echo '	<label for="main_oem_' .  $row['sub_code'] . '">' . $row['code_name'] . '</label>';
												echo '</div>';
											}
										?>
										</div>
										<label class="col-lg-2 col-form-label category_etc" style="display:none;"></label>
										<div class="col-lg-10 category_etc" style="display:none">
											<input type="text" class="form-control" name="category_etc" value="" placeholder="콤마(,)로 구분하여 최대 5개까지 등록가능합니다." />
										</div>
									</div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">대표제품 일 생산 가능량</label>
										<div class="col-sm-4">
											<input type="text" name="production_day" class="form-control" maxlength="50" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">일 생산 단위</label>
										<div class="col-sm-4">
											<input type="text" name="unit_day" class="form-control" maxlength="5" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">대표제품 월 생산 가능량</label>
										<div class="col-sm-4">
											<input type="text" name="production_month" class="form-control" maxlength="50" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">월 생산 단위</label>
										<div class="col-sm-4">
											<input type="text" name="unit_month" class="form-control" maxlength="5" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">대표제품 년 생산 가능량</label>
										<div class="col-sm-4">
											<input type="text" name="production_year" class="form-control" maxlength="50" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">년 생산 단위</label>
										<div class="col-sm-4">
											<input type="text" name="unit_year" class="form-control" maxlength="5" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">현재 가능 CAPA</label>
										<div class="col-sm-4">
											<input type="text" name="capa" class="form-control" maxlength="10" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">CAPA 기준연도</label>
										<div class="col-sm-4">
											<input type="text" name="capa_at" placeholder="YYYY.MM" class="form-control" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">설비정보</label>
										<div class="col-sm-4">
											<input type="text" name="facilities_info" class="form-control" maxlength="100" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">포장기계 보유현황</label>
										<div class="col-sm-4">
											<input type="text" name="packaging_machine" class="form-control" maxlength="100" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">기타기계 보유현황</label>
										<div class="col-sm-4">
											<input type="text" name="etc_machine" class="form-control" maxlength="100" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">이물질 검출기 보유현황</label>
										<div class="col-sm-4">
											<input type="text" name="detection_machine" class="form-control" maxlength="100" />
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">인증정보</label>
										<div class="col-sm-4">
											<input type="text" name="certi" class="form-control" maxlength="100" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">FDA 공장등록여부</label>
										<div class="col-sm-4 row">
											<div class="col-lg-3 check_wrap">
												<input type="radio" id="is_fda_y" name="is_fda" value="y"  >
												<label for="is_fda_y">등록</label>
											</div>
											<div class="col-lg-3 check_wrap">
												<input type="radio" id="is_fda_n" name="is_fda" value="n" checked >
												<label for="is_fda_n">미등록</label>
											</div>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">유통채널</label>
										<div class="col-sm-4">
											<input type="text" name="distribution_channel" class="form-control" maxlength="100" />
	                                    </div>
	                                	<label class="col-sm-2 col-form-label">수출국가</label>
										<div class="col-sm-4">
											<input type="text" name="export_nation" class="form-control" maxlength="100" />
	                                    </div>
	                                </div>

	                            </div>
							</form>
                        </div>
                    </div>
			</div>


			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">저장</button>
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
}

function fnSave()
{
	var form = $('#frmSave')[0];  
	var data = new FormData(form); 

	$.ajax({
		url: "/api/admin/domestic/manufacture/register",
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
                location.href='/admin/domestic/manufacture/list';
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

function fnCheckBizno() {
	$.ajax({
		url: "/api/admin/domestic/manufacture/chk_bizno",
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
				$('input[name=chk_biz_no]').val('n');
       		}
       		else {
                alert(data.msg);
				$('input[name=chk_biz_no]').val('y');
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}
</script>