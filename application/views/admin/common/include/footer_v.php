				<div class="modal inmodal fade" id="MineChangePw" tabindex="-1" role="dialog"  aria-hidden="true">
	                <div class="modal-dialog modal-lg">
    	                <div class="modal-content">
        	                <div class="modal-header">
            	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">비밀번호 변경</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group  row">
									<label class="col-sm-2 col-form-label">관리자ID</label>
                                    <label class="col-sm-4 col-form-label"><?php echo $admin['admin_id']; ?></label>
                                	<label class="col-sm-2 col-form-label">관리자명</label>
                                    <label class="col-sm-4 col-form-label"><?php echo $admin['admin_name']; ?></label>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                	<label class="col-sm-2 col-form-label">현재 비밀번호</label>
                                    <div class="col-sm-10">
                                    	<input type="password" id="ch_admin_pw" maxlength="16"  class="form-control" />
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                	<label class="col-sm-2 col-form-label">새로운 비밀번호</label>
                                    <div class="col-sm-10">
                                    	<input type="password" id="ch_new_pw" maxlength="16"  class="form-control" />
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group  row">
                                	<label class="col-sm-2 col-form-label">비밀번호 확인</label>
                                    <div class="col-sm-10">
                                    	<input type="password" id="ch_confirm_pw" maxlength="16"  class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                            	<button type="button" class="btn btn-primary" onclick="javascript:fnSaveChangePw();" >변경</button>
                            	<button type="button" class="btn btn-white" data-dismiss="modal">취소</button>
                            </div>
                        </div>
                    </div>
                </div>

<script>
function fnLogout(){
	location.href="/admin/login/logout";
}
function fnShowLoad()
{
	$('#loader_wrap').show();
	$('#loader').css('animation', '	spin 2s linear infinite');
}
	
function fnHideLoad()
{
	$('#loader_wrap').hide();
	$('#loader').css('animation', '	unset');
}

$('.onlyNumber').on('input', function() {
	var str = $(this).val();
	str = str.replace(/\s/gi, "").replace(/[^0-9]/g, "");
	$(this).val(str);
})

$('.onlyNumber2').on('input', function() {
	var str = $(this).val();
	str = str.replace(/\s/gi, "").replace(/[^0-9]/g, "");
	$(this).val(commify(str));
})

function commify(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function fnMakePhone(value)
{
    if(value == '') return '';
    
	let result = [];
    let restNumber = "";

    // 지역번호와 나머지 번호로 나누기
    if (value.startsWith("02")) {
        // 서울 02 지역번호
        result.push(value.substr(0, 2));
        restNumber = value.substring(2);
    } 
    else if (value.startsWith("1")) {
        // 지역 번호가 없는 경우
        // 1xxx-yyyy
        restNumber = value;
    } 
    else {
        // 나머지 3자리 지역번호
        // 0xx-yyyy-zzzz
        result.push(value.substr(0, 3));
        restNumber = value.substring(3);
    }

    if (restNumber.length === 7) {
        // 7자리만 남았을 때는 xxx-yyyy
        result.push(restNumber.substring(0, 3));
        result.push(restNumber.substring(3));
    } 
    else {
        result.push(restNumber.substring(0, 4));
        result.push(restNumber.substring(4));
    }

    return result.filter((val) => val).join("-");
}

function fnShowChangePw() {
	$('#ch_admin_pw').val('');
	$('#ch_new_pw').val('');
	$('#ch_confirm_pw').val('');
	$('#MineChangePw').modal('show');
}

function fnSaveChangePw() {
	$.ajax({
       	type:'POST',
    	url:'/api/admin/admin/change_pw_mine',
		data : {old_pw : $('#ch_admin_pw').val()
				, admin_pw : $('#ch_new_pw').val()
				, admin_pw_confirm : $('#ch_confirm_pw').val()},
		dataType:"json",
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
					$('#MineChangePw').modal('hide');
				}
       	},
        error:function(data){
           	alert("오류가 발생하였습니다.");
        }
   });
}                      
</script>
    
<style>
#loader_wrap {
	width:100%;
	height:100%;
	position:fixed;
	top:0;
	left:0;
	background-color:#000;
	opacity:0.7;
	z-index:10000;
	display:none;
}
#loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
	top:50%;
	left:50%;
	margin-left:-60px;
	margin-top:-60px;
	position:absolute;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<div id="loader_wrap">
	<div id="loader">
    </div>
</div>
</body>
</html>
