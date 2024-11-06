<div id="wrapper" style="min-height:800px">
    <?php $this->load->view('admin/common/include/nav_v'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('admin/common/include/top_v'); ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>공지사항 수정</h2>
            </div>
        </div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
							<form id="frmSave">
								<input type="hidden" name="report_seq" value="<?php echo $info['report_seq']; ?>" />
								<input type="hidden"  name="delete_file" />
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">구분</label>
	                                    <div class="col-lg-2 ">
											<select name="report_type" class="form-control">
												<option value="1" <?php echo $info['report_type'] === '1' ? 'selected' : ''; ?>>분석리포트</option>
												<option value="2" <?php echo $info['report_type'] === '2' ? 'selected' : ''; ?>>뉴스레터</option>
											</select>
	                                    </div>
	                                    <div class="col-lg-2 ">
											<select name="report_type2" class="form-control">
												<option value="1" <?php echo $info['report_type2'] === '1' ? 'selected' : ''; ?>>국가별</option>
												<option value="2" <?php echo $info['report_type2'] === '2' ? 'selected' : ''; ?>>제품별</option>
											</select>
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">썸네일이미지</label>
	                                    <div class="col-sm-4" id="thumbnail_file_wrap">
										<?php
											echo '<a href="/api/common/file_download?file_path=' . $info['thumbnail_img'] . '&org_file=' . $info['thumbnail_img_name'] . '" target="_blank">';
											echo '<input type="text" value="' . $info['thumbnail_img_name'] . '" class="form-control upload-title" disabled style="cursor:pointer;" />';
											echo '</a>';
										?>
										</div>
										<div class="col-sm-1">
											<input type="file" id="thumbnail_file" name="thumbnail_file" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:$('#thumbnail_file').click();">추가</button>
	                                    </div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">제목</label>
	                                    <div class="col-lg-10 ">
											<input type="text" name="title"  value="<?php echo $info['title']; ?>" class="form-control" />
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
                                    <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">TAG</label>
	                                    <div class="col-lg-10 ">
											<input type="text" name="tags"  value="<?php echo $info['tags']; ?>" class="form-control" placeholder="콤마(,)로 구분하여 최대 5개까지 등록가능합니다." />
	                                    </div>
                                    </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
                                        <label class="col-lg-2 col-form-label">내용</label>
	                                    <div class="col-lg-10">
	                                        <textarea name="contents" id="contents"><?php echo $info['contents']; ?></textarea>
										</div>
	                                </div>
	                                <div class="hr-line-dashed"></div>
	                                <div class="form-group  row">
	                                	<label class="col-sm-2 col-form-label">첨부파일</label>
	                                    <div class="col-sm-4" id="attach_file_wrap">
										<?php
											if(!empty($files)) {
												echo '<a href="/api/common/file_download?file_path=' . $files[0]['new_filepath'] . '&org_file=' . $files[0]['org_filename'] . '" target="_blank">';
												echo '<input type="text" value="' . $files[0]['org_filename'] . '" class="form-control upload-title" disabled style="cursor:pointer;" />';
												echo '</a>';
												echo '<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile(\'attach_file\', \'' . $files[0]['file_seq'] . '\');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>';
											}
										?>
										</div>
										<div class="col-sm-1">
											<input type="file" id="attach_file" name="attach_file" style="display:none"  />
											<button type="button" class="btn btn-w-m btn-success" onclick="javascript:$('#attach_file').click();">추가</button>
	                                    </div>
	                                </div>

	                            </div>
							</form>
                        </div>
                    </div>
			</div>


			<div class="form-group text-center">
	           	<button type="button" class="btn btn-w-m btn-success" onclick="javascript:fnSave(); return false;">저장</button>
	           	<button type="button" class="btn btn-w-m btn-default" onclick="javascript:location.href='/admin/report/detail/<?php echo $info['report_seq']; ?>'; return false;">취소</button>
			</div>
		</div>
    </div>
</div>

<script>
var contentUpImg = [];
var callbackImg = function(file,el){

    // ajax 콜
    data = new FormData();
    data.append('file', file);
    $.ajax({
        type:'POST',
        url:'/api/common/uploadTemp',
        processData: false,
        mimeType: "multipart/form-data",
        contentType: false,
        data: data,
        dataType: 'json',
        success:function(data) {

            if (data.result.resultCode == 'S') {
                //이미지 경로 푸시
                contentUpImg.push(data.result.resultData.filePath + '/' + data.result.resultData.fileName);
                $(el).summernote('insertImage', data.result.resultData.filePath + '/' + data.result.resultData.fileName, function (images) {
                    images.attr('data-filename', file.name);
                    images.attr('class', 'content-up-img');
                });
                
            } else {
                alert(data.result.message);
            }
        },
        error:function(data){
            alert("ajax 통신 오류");
        }
    });
}

$(document).ready(function() {
	$('#contents').summernote({
		height: 350,
		lang: "ko-KR",
		toolbar: [
		    ['fontsize', ['fontsize']],
		    ['font', ['bold', 'italic', 'underline', 'clear']],
		    ['fontname', ['fontname']],
		    ['color', ['color']],
		    ['para', ['ul', 'ol', 'paragraph']],
		    ['height', ['height']],
		    ['table', ['table']],
		    ['insert', ['picture']],
		    ['view', []],
		    ['help', []]
		  ],
		  fontSizes: ['8','9','10','11','12','13','14','15','16','17','18','19','20','24','30','36','48','64','82','150'],
//		  callbacks : {
//	 			 onImageUpload: function(files) {
//	                 callbackImg(files[0],this);
//	             }
//			}
	});               

	$('input[type=file]').on('change', function() {
		if($(this).val() == '') {
			return;
		}
		
		var id=$(this).attr('id');
		
		var file = $(this)[0].files[0];
		if(id == 'thumbnail_file') {
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

		if(id == 'thumbnail_file') {
			var str = '<input type="text" value="' + file.name + '" class="form-control upload-title" disabled />';
		}
		else {
			var str = '<input type="text" value="' + file.name + '" class="form-control upload-title" disabled />'
				+ '<button type="button" class="btn btn-default file-btn-reset" onclick="javascipt:fnClearFile(\'' + id + '\', \'\');"><img src="/assets/front/images/btn_clear.svg" alt="파일초기화"></button>';
		}
		$('#' + id + '_wrap').html(str);
	})

	$('input[name=tags]').on('input', function() {
		var str = $(this).val();
//		str = str.replace(/\s/gi, "");
		
		var tags = str.split(',');
		if(tags.length > 5) {
			alert('최대 5개까지만 등록가능합니다.');
			tags.pop();			
		}

/*		for(var i = 0; i < tags.length; i++) {
			tags[i] = $.trim(tags[i]);
		} */
		$(this).val(tags.join(','));
	});

})

function fnClearFile(id, seq) {
	$('#' + id + '_wrap').html('');
	$('#' + id).val('');
	
	if(seq == '') return;

	$('input[name=delete_file]').val(seq);
}

function fnSave()
{
	if($.trim($('input[name=title]').val()) == '') {
		alert('제목을 입력해주세요.');
		return;
	}
	if($.trim($('textarea[name=contents]').val()) == '') {
		alert('내용을 입력해주세요.');
		return;
	}

	var form = $('#frmSave')[0];  
	var data = new FormData(form); 

	$.ajax({
		url: "/api/report/update",
		type: "POST",
		data: data,
		enctype: 'multipart/form-data',  
		processData: false,    
		contentType: false,      
		cache: false,           
		timeout: 600000,  
		success:function(data){
			data = JSON.parse(data);
       		if(typeof(data.result) == 'login') {
       			alert('로그인이 필요합니다.')
                location.href='/admin/login';
       		}
       		else if(data.result== 'fail') {
                alert(data.msg);
       		}
       		else {
                alert(data.msg);
                location.href='/admin/report/detail/<?php echo $info['report_seq']; ?>';
       		}
       	},
        error:function(data){
    		fnHideLoad();
           	alert("오류가 발생하였습니다.");
        }
   });
}


</script>